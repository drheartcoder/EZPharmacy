@extends('admin.layout.master') @section('main_content')
<!-- BEGIN Breadcrumb -->
<div id="breadcrumbs">
  <ul class="breadcrumb">
      <li>
          <i class="fa fa-home"></i>
          <a href="{{ url($admin_panel_slug.'/dashboard') }}">Dashboard</a>
      </li>
      <span class="divider">
      <i class="fa fa-angle-right"></i>
      <i class="fa {{$module_icon or ''}}"></i>
      <a href="{{ $module_url_path or '' }}/">{{ $page_title or '' }}</a> 
    </span> 
  </ul>
</div>
<!-- END Breadcrumb -->

<!-- BEGIN Main Content -->
<div class="row">
  <div class="col-md-12">
      <div class="box ">
        <div class="box-title">
            <h3>
                <i class="fa {{$module_icon or ''}}"></i> @if(isset($id) && $id != false) {{ 'Manage Orders' }} @else {{ $page_title or '' }} @endif
            </h3>
            <div class="box-tool">
                <a data-action="collapse" href="#"></a>
                <a data-action="close" href="#"></a>
            </div>
        </div>
        <div class="box-content">
            @include('admin.layout._operation_status')
            <form action="{{ $module_url_path.'/multi_action'}}" method="POST" enctype="multipart/form-data" class="form-horizontal" id="frm_manage">
                {{csrf_field()}}
                <div class="col-md-10">
                    <div class="alert alert-danger" id="no_select" style="display:none;"></div>
                    <div class="alert alert-warning" id="warning_msg" style="display:none;"></div>
                </div>

                <div class="btn-toolbar pull-right clearfix">
                    <div class="btn-group">
                        <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Refresh" href="{{ $module_url_path or '' }}" style="text-decoration:none;"><i class="fa fa-repeat"></i></a>
                    </div>
                </div>
                <div class="clearfix"></div>
                <br>

                <div class="table-responsive replaceableContent" style="border:0">
                    <input type="hidden" name="multi_action" value="" />
                    <table class="table table-advance table-condensed ">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Sent By</th>
                                <th>Sent To</th>
                                <th>Pharmacy</th>
                                <th>Order Type</th>
                                <th>Order Value (<i class="fa fa-inr"></i>)</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                          @if(count($dataOrders))
                            @foreach($dataOrders as $key => $value)
                              <?php
                                $acceptUrl = url('').'/superadmin/order_history/order/accept?id='.$value->orderKey;
                                $rejectUrl   = url('').'/superadmin/order_history/order/reject?id='.$value->orderKey;
                                $viewUrl   = url('').'/superadmin/order_history/order/view?id='.$value->orderKey;
                                $completeUrl = url('').'/superadmin/order_history/order/complete?id='.$value->orderKey;
                              ?>
                              <tr>
                                <td>{{$value->order_id}}</td>
                                <td>{{ucwords($value->senderFullName)}}</td>
                                @if($value->is_doctor_unverified == '1')
                                <td>{{ucwords($value->docsentForFullName)}}</td>
                                @else
                                <td>{{ucwords($value->sentForFullName)}}</td>
                                @endif
                                <td>{{ucwords($value->receiverFullName)}}</td>
                                <td>{{ucwords($value->order_type)}}</td>
                                <td>{{number_format($value->totalPrice,'2','.','')}}</td>
                                <td>{{ucwords($value->orderStatus)}}</td>
                                <td>{{$value->orderedSentOn}}</td>
                                <td>
                                  @if($value->orderStatus == "pending" OR $value->orderStatus == "accepted")
                                    <div class="dropdown">
                                      <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Action<span class="caret"></span></button>
                                      <ul class="dropdown-menu">
                                          @if($value->orderStatus == "pending")
                                            <li><a class="clsAcceptOrder" data-origin="no" href="{{$acceptUrl}}">Accept</a></li>
                                            <li><a class="clsViewOrder" href="{{$viewUrl}}">View</a></li>
                                            <li><a class="clsRejectOrder" data-origin="no" href="{{$rejectUrl}}">Reject</a></li>
                                          @endif
                                          @if($value->orderStatus == "accepted")
                                            <li><a class="clsCompleteOrder" href="{{$completeUrl}}">Complete</a></li>
                                            <li><a class="clsRejectOrder" data-origin="no" href="{{$rejectUrl}}">Reject</a></li>
                                          @endif
                                      </ul>
                                    </div>
                                  @endif
                                </td>
                              </tr>
                            @endforeach
                                @if(!empty($dataOrders->links()))
                                  <tr><td colspan="9">&nbsp;</td></tr>
                                  <tr>
                                      <td colspan="9" style="text-align: right;">
                                          {{$dataOrders->links()}}
                                      </td>
                                  </tr>
                                @endif
                          @endif
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END Main Content -->
<div id="prescriptionModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog">
    <div class="modal-dialog ">
        <!-- modal-lg -->
        <form class="form-horizontal" method="POST" id="frmProcessPrescription" name="frmProcessPrescription" action="" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Prescription Details</h4>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="box-content">
                            <div class="row">
                                <div class="col-md-1"></div>
                                <div class="col-md-10 ">
                                    <!-- BEGIN Left Side -->
                                    <div class="form-group">
                                        <label style="text-align:left;" for="txtSenderName" class="col-xs-4 col-lg-4 control-label clsSenderName">*****</label>
                                        <div class="col-sm-8 col-lg-8 controls">
                                            <input type="text" disabled="disabled" style="background-color: #FFF;border-color: #FFF;" name="txtSenderName" id="txtSenderName" placeholder="" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label style="text-align:left;" for="txtSentForName" class="col-xs-4 col-lg-4 control-label clsSentForName">*****</label>
                                        <div class="col-sm-8 col-lg-8 controls">
                                            <input type="text" disabled="disabled" style="background-color: #FFF;border-color: #FFF;" name="txtSentForName" id="txtSentForName" placeholder="" class="form-control">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label style="text-align:left;" for="txtMobileNumber" class="col-xs-4 col-lg-4 control-label">Mobile Number</label>
                                        <div class="col-sm-8 col-lg-8 controls">
                                            <input type="text" disabled="disabled" style="background-color: #FFF;border-color: #FFF;" name="txtMobileNumber" id="txtMobileNumber" placeholder="" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label style="text-align:left;" for="fileName" class="col-xs-4 col-lg-4 control-label">Prescription</label>
                                        <div class="col-sm-8 col-lg-8 controls">
                                          <img src="{{url('')}}/images/img-not-found.png" class="clsPrescriptionImage" style="height: 100px;width:100px;">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1"></div>
                            </div>
                        </div>
                    </div>
                    <div style="clear: both;"></div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="txtOrderId" value="">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" data-origin="yes" name="btnRejectPrescription">Reject</button>
                    <button type="button" class="btn btn-primary" data-origin="yes" name="btnAcceptPrescription">Accept</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div id="completeModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog">
    <div class="modal-dialog ">
        <!-- modal-lg -->
        <form class="form-horizontal" method="POST" id="frmCompletePrescription" name="frmCompletePrescription" action="" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Order Value</h4>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="box-content">
                            <div class="row">
                                <div class="col-md-1"></div>
                                <div class="col-md-10 ">
                                    <!-- BEGIN Left Side -->
                                    <div class="form-group">
                                        <label style="text-align:left;" for="txtOrderValue" class="col-xs-4 col-lg-4 control-label">Order Value</label>
                                        <div class="col-sm-8 col-lg-8 controls">
                                            <input type="text" name="txtOrderValue" id="txtOrderValue" placeholder="" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1"></div>
                            </div>
                        </div>
                    </div>
                    <div style="clear: both;"></div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="_txtOrderId" value="">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="btnCompletePrescription">Send</button>
                </div>
            </div>
        </form>
    </div>
</div>
@stop