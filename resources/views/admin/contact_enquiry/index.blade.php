    @extends('admin.layout.master')                

    @section('main_content')

    <!-- BEGIN Page Title -->
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/assets/data-tables/latest/dataTables.bootstrap.min.css">

    <div class="page-title">
        <div>

        </div>
    </div>
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
              <i class="fa fa-info-circle"></i>
              <a href="{{ $module_url_path }}">{{ $module_title or ''}}</a>
          </span> 
          <span class="divider">
              <i class="fa fa-angle-right"></i>
                <i class="fa fa-list"></i>
          </span>
          <li class="active">{{ $page_title or ''}}</li>
      </ul>
    </div>
    <!-- END Breadcrumb -->

    <!-- BEGIN Main Content -->
    <div class="row">
      <div class="col-md-12">

          <div class="box">
            <div class="box-title">
              <h3>
                <i class="fa fa-list"></i>
                {{ isset($page_title)?$page_title:"" }}
            </h3>
            <div class="box-tool">
                <a data-action="collapse" href="#"></a>
                <a data-action="close" href="#"></a>
            </div>
        </div>
        <div class="box-content">
        
          @include('admin.layout._operation_status')  

          {!! Form::open([ 'url' => $module_url_path.'/multi_action',
                                 'method'=>'POST',
                                 'enctype' =>'multipart/form-data',   
                                 'class'=>'form-horizontal', 
                                 'id'=>'frm_manage' 
                                ]) !!} 

            {{ csrf_field() }}

          <div class="col-md-10">
            <div id="ajax_op_status"></div>
             <div class="alert alert-danger" id="no_select" style="display:none;"></div>
              <div class="alert alert-warning" id="warning_msg" style="display:none;"></div>
          </div>
          <div class="btn-toolbar pull-right clearfix">
            <div class="btn-group"> 
                <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" 
                   title="Multiple Delete" 
                   href="javascript:void(0);" 
                   onclick="javascript : return check_multi_action('frm_manage','delete');"  
                   style="text-decoration:none;">
                   <i class="fa fa-trash-o"></i>
                </a>
            
                <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" 
                   title="Refresh" 
                   href="javascript:void(0)"
                   onclick="javascript:location.reload();" 
                   style="text-decoration:none;">
                   <i class="fa fa-repeat"></i>
                </a> 
            </div>
          </div>
          <br/>
          <div class="clearfix"></div>
          <div class="table-responsive" style="border:0">

            <input type="hidden" name="multi_action" value="" />

            <table class="table table-advance"  id="table_module" >
              <thead>
                <tr>
                  <th style="width:18px"> <input type="checkbox" /></th>
                  <th>First Name</th> 
                  <th>Last Name</th> 
                  <th>Email</th> 
                  <th>Phone</th> 
                  <th style="width: 450px;">Message</th> 
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
        
                @if(sizeof($arr_contact_enquiry)>0)
                  @foreach($arr_contact_enquiry as $contact_enquiry)
              
                  <tr>
                    <td> 
                      <input type="checkbox" 
                             name="checked_record[]"  
                             value="{{ base64_encode($contact_enquiry['id']) }}" /> 
                    </td>
                    <td > {{ $contact_enquiry['first_name'] }} </td> 
                    <td > {{ $contact_enquiry['last_name'] }} </td> 
                    <td > {{ $contact_enquiry['email'] }} </td>   
                    <td > {{ $contact_enquiry['phone'] }} </td> 
                    <td > {{ str_limit($contact_enquiry['subject'],125) }} </td> 
                    <td>
                        @if($contact_enquiry['is_view']==0)
                         <a class="btn btn-sm btn-primary show-tooltip" href="{{ $module_url_path.'/view/'.base64_encode($contact_enquiry['id']) }}" 
                        title="View"> Un-Read  </a>
                        @else
                         <a class="btn btn-sm btn-primary show-tooltip" href="{{ $module_url_path.'/view/'.base64_encode($contact_enquiry['id']) }}" 
                          title="View">Read </a>
                        @endif
                    </td>                   
                    <td> 
                        <a class="btn btn-sm btn-primary show-tooltip" href="{{ $module_url_path.'/reply/'.base64_encode($contact_enquiry['id']) }}" 
                        title="Reply"><i class="fa fa-paper-plane" aria-hidden="true"></i></a>
                   

                        <a class="btn btn-sm btn-primary show-tooltip" href="{{ $module_url_path.'/view/'.base64_encode($contact_enquiry['id']) }}" 
                        title="View">
                        <i class="fa fa-eye" ></i>
                        </a>
                        
                        &nbsp;  
                        <a class="btn btn-sm btn-danger show-tooltip" href="{{ $module_url_path.'/delete/'.base64_encode($contact_enquiry['id'])}}" 
                        onclick="return confirm_action(this,event,'Do you really want to delete this record ?')"
                        title="Delete">
                        <i class="fa fa-trash" ></i>
                        </a>
                    </td>
                  </tr>
                  @endforeach
                @endif
                 
              </tbody>
            </table>
          </div>
        <div> </div>
         
          {!! Form::close() !!}
      </div>
  </div>
</div>


<!-- END Main Content -->
<script type="text/javascript">
  $(document).ready(function() {
    $('#table_module').DataTable( {
        "aoColumns": [
          { "bSortable": false },
          { "bSortable": true },
          { "bSortable": true },
          { "bSortable": true },
          { "bSortable": true },
          { "bSortable": true },
          { "bSortable": false }
          { "bSortable": false }
        ]
    });
  });
</script>

@stop                    


