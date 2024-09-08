@extends('admin.layout.master')                
@section('main_content')
<!-- BEGIN Page Title -->
<!-- END Page Title -->

<!-- BEGIN Breadcrumb -->
<div id="breadcrumbs">
    <ul class="breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="{{ url($admin_panel_slug.'/dashboard') }}">Dashboard</a>
        </li>
        <span class="divider">
      <i class="fa fa-angle-right"></i>
      <i class="fa {{$module_icon}}"></i>
      <a class="clsUserType" data-usertype="{{$usertype}}" href="{{ $module_url_path }}/manage/{{$usertype}}/">{{ $page_title .' [ '. ucfirst($usertype) .' ]' }}</a>
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
                    <i class="fa {{$module_icon}}"></i> {{ $page_title .' [ '. ucfirst($usertype) .' ]' }}
                </h3>
                <div class="box-tool">
                    <a data-action="collapse" href="#"></a>
                    <a data-action="close" href="#"></a>
                </div>
            </div>
            @if($usertype != 'switch_user')
            <div class="box-content">
                @include('admin.layout._operation_status')

                <form action="{{ $module_url_path.'/multi_action'}}" method="POST" class="form-horizontal" id="frm_manage">
                    {{ csrf_field() }}
                    <!-- <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-3 col-lg-3 control-label">Name</label>
                                <div class="col-sm-9 col-lg-4 controls">
                                    <input type="text" name="fullName" id="fullName" class="form-control" value="{{$fullName}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-3 col-lg-3 control-label">Mobile Number</label>
                                <div class="col-sm-9 col-lg-4 controls">
                                    <input type="text" name="mobileNumber" id="mobileNumber" class="form-control" value="{{$mobileNumber}}">
                                </div>
                            </div>
                        </div>
                    </div> -->

                    <div class="col-md-10">
                        <div id="ajax_op_status"></div>
                        <div class="alert alert-danger" id="no_select" style="display:none;"></div>
                        <div class="alert alert-warning" id="warning_msg" style="display:none;"></div>
                    </div>

                    <div class="btn-toolbar pull-right clearfix" style="margin-bottom: 10px;">
                        <!-- <div class="btn-group">
                            <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Multiple Active/Unblock" href="javascript:void(0);" onclick="javascript : return check_multi_action('frm_manage','activate');" style="text-decoration:none;"><i class="fa fa-unlock"></i></a>
                        </div>
                        <div class="btn-group">
                            <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Multiple Deactive/Block" href="javascript:void(0);" onclick="javascript : return check_multi_action('frm_manage','deactivate');" style="text-decoration:none;"><i class="fa fa-lock"></i></a>
                        </div>
                        <div class="btn-group">
                            <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Multiple Delete" href="javascript:void(0);" onclick="javascript : return check_multi_action('frm_manage','delete');" style="text-decoration:none;"><i class="fa fa-trash-o"></i></a>
                        </div> -->

                        <div class="btn-group">
                            <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Refresh" href="{{ $module_url_path }}/manage/{{$usertype}}/" style="text-decoration:none;"><i class="fa fa-repeat"></i></a>
                        </div>
                    </div>

                    <div class="clearfix"></div>

                    @if($usertype == "pharmacy")
                    <form name="frmSearchPharmacyName" id="frmSearchPharmacyName" class="form-horizontal" method="get">
                    <div class="form-group">
                      <label class="control-label col-lg-2">Pharmacy Name</label>
                      <div class="col-lg-6">
                        <input type="text" name="txtPharmacyName" id="txtPharmacyName" class="form-control" value="{{ $pharmacy_name }}">
                        <label id="error-txtPharmacyName" for="txtPharmacyName"></label>
                      </div>
                      <div class="col-lg-4">
                        <button type="button" class="btn btn-sm btn-primary btn-labeled" data-rule-required ="true" name="btnSearchPharmacyName" id="btnSearchPharmacyName"><b><i class="icon-search4"></i></b> Search</button>
                         <div class="btn-group">
                            <a href="{{ $module_url_path }}/manage/{{$usertype}}/" class="btn btn-sm btn-primary btn-labeled">Cancel</a> 
                        </div>
                      </div>
                    </div>
                    </form>
                    @endif

                    <div class="table-responsive replaceableContent" style="border:0">
                        <input type="hidden" name="multi_action" value="" />
                        <table class="table table-advance table-condensed">
                            <thead>
                                <tr>
                                    <th style="width: 5%; vertical-align: initial;"><input type="checkbox" /></th>
                                    @if($usertype == "pharmacy")
                                        <th>Pharmacy Name</th>
                                    @endif
                                    <th>Name</th>
                                    <th>Mobile Number</th>
                                    @if($usertype == "patient")
                                        <th>Earned Points</th>
                                    @endif
                                    @if($usertype == "doctor" || $usertype == "unverified-doctor")
                                        <th>Registration No.</th>
                                        <th>Speciality</th>
                                    @endif
                                    <th>Date Of Birth</th>
                                    @if($usertype == "pharmacy")
                                        <th>Address</th>
                                    @endif
                                    <th>Status</th>
                                    <th>Reg<sup>n</sup> Date</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($arr_data)) @foreach($arr_data as $key => $value)
                                <?php
                                      $modalUrl = url('').'/superadmin/users/retrieve?id='.$value->priKey;
                                      $deleteUrl = url('').'/superadmin/users/delete?id='.$value->priKey;
                                      if($value->status == "active")
                                      {
                                        $statusUrl = url('').'/superadmin/users/status/blocked?id='.$value->priKey;
                                      }
                                      else
                                      {
                                        $statusUrl = url('').'/superadmin/users/status/active?id='.$value->priKey;
                                      }
                                      $orderUrl = url('').'/superadmin/users/create-order?id='.$value->priKey;
                                  ?>
                                    <tr>
                                        <td><input type="checkbox" /></td>
                                        @if($usertype == "pharmacy")
                                            <td>
                                                <?php
                                                    echo $value->pharmacy_name;
                                                ?>
                                            </td>
                                        @endif
                                        <td>{{ucwords($value->fullName)}}</td>
                                        <td>{{$value->mobile_number}}</td>
                                        @if($usertype == "patient")
                                            <td>
                                                <?php
                                                    if(count($value->userPoints))
                                                    {
                                                       echo $value->userPoints[0]->earnedPoints;
                                                    }
                                                ?>
                                            </td>
                                        @endif
                                        @if($usertype == "doctor")
                                            <th>{{ $value->registration_no }}</th>
                                            <th>
                                                <?php
                                                $temp_arr = explode(',', $value->speciality);
                                                if(count($temp_arr)>0)
                                                {
                                                    $spe_arr = [];
                                                    foreach ($temp_arr as $temp_key) 
                                                    {
                                                       $data = DB::table('speciality')->select('name')->where('id',$temp_key)->first();
                                                       array_push($spe_arr, $data);
                                                    }
                                                }
                                                $array = array_map(function ($spe_arr) { return (array) $spe_arr; }, $spe_arr);
                                                
                                                foreach ($array as $key_val) {
                                                    foreach ($key_val as $new_val) {
                                                        echo $new_val.'<br/>';
                                                    }
                                                }
                                                ?>
                                            </th>
                                        @endif
                                        <td>{{$value->dateOfbirth}}</td>
                                        @if($usertype == "pharmacy")
                                            <td>
                                                <?php
                                                    echo $value->address.'<br>'.$value->area_title.'<br>'.$value->city_title.', '.$value->state_title.'<br>'.$value->country_name.' - '.$value->zipcode;
                                                ?>
                                            </td>
                                        @endif
                                        <td>{{ucwords($value->status)}}</td>
                                        <td>{{$value->regSince}}</td>
                                        <td style="text-align: center;">
                                            <div class="dropdown">
                                                <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Action<span class="caret"></span></button>
                                                <ul class="dropdown-menu">
                                                    @if($value->status == "active")
                                                    <li><a class="changeStatus" href="{{$statusUrl}}">Deactivate</a></li>
                                                    @else
                                                    <li><a class="changeStatus" href="{{ $statusUrl }}">Activate</a></li>
                                                    @endif
                                                    <!-- data-toggle="modal" data-target="#userModal" -->
                                                    <li><a class="open-user-modal" data-url="{{$modalUrl}}">Edit</a></li>
                                                    @if($usertype != "pharmacy")
                                                        <li><a class="open-order-modal" data-sender-id="{{$value->priKey}}" >Create Order</a></li>
                                                    @endif
                                                    <li><a class="deleteUser" href="{{$deleteUrl}}">Delete</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach @if(!empty($arr_data->links()))
                                    <?php
                                        $colspan = 9;
                                        if($usertype == "pharmacy" || $usertype == "patient")
                                        {
                                            $colspan = 8;
                                        }
                                    ?>
                                    <tr><td colspan="{{$colspan}}">&nbsp;</td></tr>
                                    <tr>
                                        <td colspan="{{$colspan}}" style="text-align: right;">
                                            {{$arr_data->links()}}
                                        </td>
                                    </tr>
                                    @endif @endif
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
            @endif
        </div>
    </div>

<div id="userModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog">
    <div class="modal-dialog ">
        <!-- modal-lg -->
        <form class="form-horizontal" method="POST" id="frmProcessUser" name="frmProcessUser" action="">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Modify Details of : <span class="userName"></span></h4>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="box-content">
                            <div class="row">
                                <div class="col-md-1"></div>
                                <div class="col-md-10 ">
                                    <!-- BEGIN Left Side -->
                                    <div class="form-group">
                                        <label style="text-align:left;" for="firstName" class="col-xs-4 col-lg-4 control-label">First Name</label>
                                        <div class="col-sm-8 col-lg-8 controls">
                                            <input type="text" name="firstName" id="firstName" placeholder="" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label style="text-align:left;" for="lastName" class="col-xs-4 col-lg-4 control-label">Last Name</label>
                                        <div class="col-sm-8 col-lg-8 controls">
                                            <input type="text" name="lastName" id="lastName" placeholder="" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label style="text-align:left;" for="txtDOB" class="col-xs-4 col-lg-4 control-label">Date Of Birth</label>
                                        <div class="col-sm-8 col-lg-8 controls">
                                            <input type="text" name="txtDOB" id="txtDOB" placeholder="" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label style="text-align:left;" for="mobileNumber" class="col-xs-4 col-lg-4 control-label">Mobile Number</label>
                                        <div class="col-sm-8 col-lg-8 controls">
                                            <input type="text" name="mobileNumber" id="mobileNumber" placeholder="" class="form-control">
                                        </div>
                                    </div>
                                    @if($usertype == "doctor" || $usertype == "unverified-doctor")
                                        <div class="form-group">
                                            <label style="text-align:left;" for="txtRegistrationNo" class="col-xs-4 col-lg-4 control-label">Registration No.</label>
                                            <div class="col-sm-8 col-lg-8 controls">
                                                <input type="text" name="txtRegistrationNo" id="txtRegistrationNo" placeholder="" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label style="text-align:left;" for="selSpeciality" class="col-xs-4 col-lg-4 control-label">Speciality</label>
                                            <div class="col-sm-8 col-lg-8 controls">
                                                <select name="selSpeciality[]" id="selSpeciality" placeholder="" class="form-control" multiple>
                                                    <option value="">select Speciality</option>
                                                    @if(count($dataSpeciality))
                                                        @foreach($dataSpeciality as $key => $value)
                                                            <option value="{{$value->id}}">{{$value->name}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    @endif
                                    @if($usertype == "pharmacy")
                                        <div class="form-group">
                                            <label style="text-align:left;" for="txtAddress" class="col-xs-4 col-lg-4 control-label">Address</label>
                                            <div class="col-sm-8 col-lg-8 controls">
                                                <input type="text" name="txtAddress" id="txtAddress" placeholder="" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label style="text-align:left;" for="selState" class="col-xs-4 col-lg-4 control-label">State</label>
                                            <div class="col-sm-8 col-lg-8 controls">
                                                <select name="selState" id="selState" placeholder="" class="form-control">
                                                    <option value="">select state</option>
                                                    @if(count($dataState))
                                                        @foreach($dataState as $key => $value)
                                                            <option value="{{$value->id}}">{{$value->state_title}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label style="text-align:left;" for="selCity" class="col-xs-4 col-lg-4 control-label">City</label>
                                            <div class="col-sm-8 col-lg-8 controls">
                                                <select type="text" name="selCity" id="selCity" placeholder="" class="form-control">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label style="text-align:left;" for="txtPostcode" class="col-xs-4 col-lg-4 control-label">Postcode</label>
                                            <div class="col-sm-8 col-lg-8 controls">
                                                <input type="text" name="txtPostcode" id="txtPostcode" placeholder="" class="form-control">
                                            </div>
                                        </div>
                                    @endif
                                    <!-- END Left Side -->
                                </div>
                                <div class="col-md-1"></div>
                            </div>
                        </div>
                    </div>
                    <div style="clear: both;"></div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="txtId" value="">
                    <input type="hidden" name="userType" value="{{$usertype}}">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" name="btnContinue">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>


<div id="orderModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog">
    <div class="modal-dialog ">
        <!-- modal-lg -->
        <form class="form-horizontal" method="POST" id="frmProcessOrder" name="frmProcessOrder" action="" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Send Prescription</h4>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="box-content">
                            <div class="row">
                                <div class="col-md-1"></div>
                                <div class="col-md-10 ">
                                    <!-- BEGIN Left Side -->
                                    <div class="form-group">
                                        <label style="text-align:left;" for="fileName" class="col-xs-4 col-lg-4 control-label">Attach File</label>
                                        <div class="col-sm-8 col-lg-8 controls">
                                            <input type="file" name="fileName" id="fileName" placeholder="" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label style="text-align:left;" for="txtName" class="col-xs-4 col-lg-4 control-label">{{$usertype == "patient"?"Doctor Name":"Patient Name"}}</label>
                                        <div class="col-sm-8 col-lg-8 controls">
                                            <input type="text" name="txtName" id="txtName" placeholder="" class="form-control">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label style="text-align:left;" for="txtMobileNumber" class="col-xs-4 col-lg-4 control-label">Mobile Number</label>
                                        <div class="col-sm-8 col-lg-8 controls">
                                            <input type="text" name="txtMobileNumber" id="txtMobileNumber" placeholder="" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label style="text-align:left;" for="selPharmacy" class="col-xs-4 col-lg-4 control-label">Pharmacy</label>
                                        <div class="col-sm-8 col-lg-8 controls">
                                            <select name="selPharmacy" id="selPharmacy" class="form-control">
                                                <option value="">select paharmacy</option>
                                                
                                            </select>
                                        </div>
                                    </div>
                                    <!-- END Left Side -->
                                </div>
                                <div class="col-md-1"></div>
                            </div>
                        </div>
                    </div>
                    <div style="clear: both;"></div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="txtSenderId" value="">
                    <input type="hidden" name="txtUserType" value="{{$usertype == 'patient'?'doctor':'patient'}}">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" name="btnCreateOrder">Send</button>
                </div>
            </div>
        </form>
    </div>
</div>
    <!-- END Main Content -->

<script type="text/javascript">
$(document).on('click', '#btnSearchPharmacyName', function(){
    var txtPharmacyName = $("#txtPharmacyName").val();
   
    if(txtPharmacyName != '')
    {
      window.location.href=SITE_URL+'/users/manage/pharmacy?pharmacy-name='+txtPharmacyName;
    }
    else
    {
       $('#error-search').show();
       $('#error-search').html('<div class="alert alert-danger no-border"><button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button><span class="text-semibold">Fail!</span> Please enter brand for search</div>');
       setTimeout(function() {
            $('#error-search').html('');
            $('#error-search').hide('');
            }, 5000);
    }
});
</script>

@stop
