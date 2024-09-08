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
      <i class="fa {{$module_icon}}"></i>
      <a href="{{ $module_url_path }}/change-user-type">{{ $page_title }}</a>
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
                <i class="fa {{$module_icon}}"></i>
                {{ $page_title}}
            </h3>
            <div class="box-tool">
                <a data-action="collapse" href="#"></a>
                <a data-action="close" href="#"></a>
            </div>
        </div>
        <div class="box-content">
          @include('admin.layout._operation_status')  
          
          <form method="POST" enctype="multipart/form-data" class="form-horizontal" id="frm_switch_user" name="frm_switch_user">
            {{ csrf_field() }}

            <div class="col-md-10">
              <div id="ajax_op_status"></div>
              <div class="alert alert-danger" id="no_select" style="display:none;"></div>
              <div class="alert alert-warning" id="warning_msg" style="display:none;"></div>
            </div>

          <div class="btn-toolbar pull-right clearfix">              
              <div class="btn-group"> 
                <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" 
                   title="Refresh" href="{{ $module_url_path }}/change-user-type/" style="text-decoration:none;">
                   <i class="fa fa-repeat"></i>
                </a> 
              </div>
          </div>

          <div class="col-sm-4 col-lg-2 controls">
              <a class="btn btn-primary btn-add-new-records">Change User Type</a>
          </div>

          <div class="row">
            <div class="col-sm-4 col-lg-2 controls">
              <select name="user_type" id="user_type" class="form-control column_filter">

                <option value="">Select User Type</option>
                @if(isset($arr_user_type) && count($arr_user_type) > 0)
                  @foreach($arr_user_type as $key => $user)  
                    <option value="{{$user['user_type'] or ''}}">{{$user['user_type'] or ''}}</option>
                  @endforeach
                @endif                                            
              </select>
            </div>

            <div class="col-sm-4 col-lg-2 controls">
              {{-- <a class="btn btn-primary btn-add-new-records" onclick="javascript: return actionChangeUser('frm_manage','ASSIGN');">Switch To</a> --}}
              <button class="btn btn-primary btn-add-new-records"  type="button" name="btn_switch_user" id="btn_switch_user" onclick="return validate('frm_switch_user','ASSIGN');">Switch To </button>
            </div>
{{-- 
            <div class="col-sm-4 col-lg-2 controls">
              <a class="btn btn-primary btn-add-new-records" onclick="javascript: return actionUserCategory('frm_manage','REMOVE');">Remove User Category</a>
            </div> --}}
          </div>
          <br/>
          <div class="clearfix"></div>

           <div class="table-responsive" style="border:0">      
              <input type="hidden" name="multi_action" value="" />
                <table class="table table-advance"  id="table_module">
                  <thead>
                    <tr>     

                        <th style="width: 18px; vertical-align: initial;"><input type="checkbox"/></th> 
                        
                        <th><a class="sort-desc" href="javascript:void(0);">Name </a>
                            <input type="text" name="q_name" placeholder="Search" class="search-block-new-table column_filter" />
                        </th> 

                        <th><a class="sort-desc" href="javascript:void(0);">User Type</a>
                            <input type="text" name="q_user_type" placeholder="Search" class="search-block-new-table column_filter" />
                            
                        </th> 


                        <th><a class="sort-desc" href="javascript:void(0);">Email </a>
                            <input type="text" name="q_email" placeholder="Search" class="search-block-new-table column_filter" />
                        </th> 

                        <th><a class="sort-desc" href="javascript:void(0);">Mobile Number </a>
                            <input type="text" name="q_mobile_number" placeholder="Search" class="search-block-new-table column_filter" />
                        </th> 

                        <th><a class="sort-desc" href="javascript:void(0);">Category </a>
                            <input type="text" name="q_category_name" placeholder="Search" class="search-block-new-table column_filter" />
                        </th> 

                        <th><a class="sort-desc" href="javascript:void(0);"> My Wallet </a></th>
                    </tr>
                  </thead>
               </table>
            </div>

            <div></div>
         
           </form>
      </div>
  </div>
</div>


<!-- END Main Content -->
<!-- Admin Role Access -->

@if($check_admin_role=='admin')
  <script type="text/javascript">
        var admin_panel_slug = "{{$admin_panel_slug}}";
        var url = "{{ url('/') }}";
        
        /*Script to show table data*/

        var table_module = false;
        $(document).ready(function()
        {
          table_module = $('#table_module').DataTable({ 
            processing: true,
            serverSide: true,
            autoWidth: false,
            bFilter: false ,
            pageLength: 50,
            ajax: {
            'url':'{{ $module_url_path.'/loadSwitchUsers/'}}',
            'data': function(d)
              {
                d['column_filter[q_name]']          = $("input[name='q_name']").val()
                d['column_filter[q_user_type]']          = $("input[name='q_user_type']").val()
                d['column_filter[q_email]']         = $("input[name='q_email']").val()
                d['column_filter[q_mobile_number]'] = $("input[name='q_mobile_number']").val()
                d['column_filter[q_category_name]'] = $("input[name='q_category_name']").val()
              }
            },
            columns: [
            {
                  render : function(data, type, row, meta) 
                  {
                  return '<input type="checkbox" '+
                  ' name="checked_record[]" '+  
                  ' value="'+row.enc_id+'"/>';
                  },
                  "orderable": false,
                  "searchable":false
            },
            {data: 'full_name', "orderable": true, "searchable":true},
            {data: 'user_type', "orderable": true, "searchable":true},
            {data: 'email_address', "orderable": true, "searchable":true},
            {data: 'mobile_number', "orderable": true, "searchable":true},
            {data: 'category_name', "orderable": true, "searchable":true},
            {data: 'my_wallet'    , "orderable": true, "searchable":false},
            ]
          });

          $('input.column_filter').on( 'keyup click', function () 
          {
              filterData();
          });

          $('#table_module').on('draw.dt',function(event)
          {
            var oTable = $('#table_module').dataTable();
            var recordLength = oTable.fnGetData().length;
            $('#record_count').html(recordLength);
          });
        });

        function filterData()
        {
          table_module.draw();
        }
  </script>
  <script type="text/javascript">
    function validate(frm_id,action)
    {
        var user_id;
        user_id = $('#user_type').val();
        if(action == "ASSIGN")
        {
            if(user_id == "") 
            {
                showAlert('Please select user type.','warning');
                return false;
            }
        }

        var len = $('input[name="checked_record[]"]:checked').length;
        var flag=1;
        var frm_ref = $("#"+frm_id);
        if(len<=0) 
        {
            swal("Oops..","Please select the record to perform this Action.");
            return false;
        }

        var arr_user = [];
        $('input[name="checked_record[]"]:checked').map(function(){
          arr_user.push($(this).val())
        });

        var confirmation_msg =  "Do you really want to perform this action ?";

        if(action == "ASSIGN")
        {
          confirmation_msg =  "Do you really want to change user type to selected user ?";
        }
     swal({
          title: "Are you sure ?",
          text: confirmation_msg,
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Yes",
          cancelButtonText: "No",
          closeOnConfirm: true,
          closeOnCancel: true
        },
        function(){
        $('#frm_switch_user').submit();
      });
     
    }
  </script>
@endif

@stop                    


