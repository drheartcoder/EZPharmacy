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
      <a href="{{ $module_url_path }}">{{ $page_title or ''}}</a>
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
                {{ isset($page_title)?$page_title:"" }}
            </h3>
            <div class="box-tool">
                <a data-action="collapse" href="#"></a>
                <a data-action="close" href="#"></a>
            </div>
        </div>
        <div class="box-content">
          
            

          @include('admin.layout._operation_status')  
          
          <form action="{{ $module_url_path.'/multi_action'}}" method="POST" enctype="multipart/form-data" class="form-horizontal" id="frm_manage">
            {{ csrf_field() }}

            <div class="col-md-10">
            

            <div id="ajax_op_status">
                
            </div>
            <div class="alert alert-danger" id="no_select" style="display:none;"></div>
            <div class="alert alert-warning" id="warning_msg" style="display:none;"></div>
          </div>

          <div class="btn-toolbar pull-right clearfix">

              <div class="btn-group">
                {{-- <a class="btn btn-primary btn-add-new-records" onclick="javascript: return actionUserCategory('frm_manage');">Assign User Category</a> --}}
              </div>
          
              <div class="btn-group">
                <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" 
                    title="Multiple Active/Unblock" 
                    href="javascript:void(0);" 
                    onclick="javascript : return check_multi_action('frm_manage','activate');" 
                    style="text-decoration:none;">

                    <i class="fa fa-unlock"></i>
                </a> 
              </div>
              <div class="btn-group">
                <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" 
                   title="Multiple Deactive/Block" 
                   href="javascript:void(0);" 
                   onclick="javascript : return check_multi_action('frm_manage','deactivate');"  
                   style="text-decoration:none;">
                    <i class="fa fa-lock"></i>
                </a> 
              </div>
              <div class="btn-group">
                
                <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" 
                   title="Multiple Delete" 
                   href="javascript:void(0);" 
                   onclick="javascript : return check_multi_action('frm_manage','delete');"  
                   style="text-decoration:none;">
                   <i class="fa fa-trash-o"></i>
                </a>
              </div>  
              <div class="btn-group"> 
                <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" 
                   title="Refresh" 
                   href="{{ $module_url_path }}"
                   style="text-decoration:none;">
                   <i class="fa fa-repeat"></i>
                </a> 
              </div>
              <br>

          </div>

          <div class="row">
            <div class="col-sm-4 col-lg-2 controls">
              <select name="user_category" id="user_category" class="form-control column_filter">
                <option value="">Select User Category</option>
                @if(isset($arr_categories) && count($arr_categories) > 0)
                  @foreach($arr_categories as $key => $category)  
                    <option value="{{$category->id or ''}}">{{$category->name or ''}}</option>
                  @endforeach
                @endif                                            
              </select>
            </div>

            <div class="col-sm-4 col-lg-2 controls">
              <a class="btn btn-primary btn-add-new-records" onclick="javascript: return actionUserCategory('frm_manage','ASSIGN');">Assign User Category</a>
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

                        <th><a class="sort-desc" href="#">Name </a>
                            <input type="text" name="q_name" placeholder="Search" class="search-block-new-table column_filter" />
                        </th> 

                        <th><a class="sort-desc" href="#">Email </a>
                            <input type="text" name="q_email" placeholder="Search" class="search-block-new-table column_filter" />
                        </th> 

                        <th><a class="sort-desc" href="#">Mobile Number </a>
                            <input type="text" name="q_mobile_number" placeholder="Search" class="search-block-new-table column_filter" />
                        </th> 

                        <th><a class="sort-desc" href="#">Category </a>
                            <input type="text" name="q_category_name" placeholder="Search" class="search-block-new-table column_filter" />
                        </th> 

                        <th>Status</th>
                        <th>Action</th>
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
      ajax: {
      'url':'{{ $module_url_path.'/loadConsumers'}}',
      'data': function(d)
        {
          d['column_filter[q_name]']          = $("input[name='q_name']").val()
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
      {data: 'email_address', "orderable": true, "searchable":true},
      {data: 'mobile_number', "orderable": true, "searchable":true},
      {data: 'category_name', "orderable": true, "searchable":true},
      {
        render : function(data, type, row, meta) 
        {
          return row.build_status_btn;
        },
        "orderable": false, "searchable":false
      },
      {
        render : function(data, type, row, meta) 
        {
          return row.build_action_btn;
        },
        "orderable": false, "searchable":false
      }
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

  function actionUserCategory(frm_id , action)
  {
    var category_id;
    category_id = $('#user_category').val();

    if(action == "ASSIGN")
    {
      if(category_id == "") {
        showAlert('Please select user to assign user category.','warning');
        return false;
      }
    }

    var len = $('input[name="checked_record[]"]:checked').length;
    var flag=1;
    var frm_ref = $("#"+frm_id);
    
    if(len<=0) {
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
      confirmation_msg =  "Do you really want to assign category to selected consumers ?";
    }

    if(action == "REMOVE")
    {
      confirmation_msg =  "Do you really want to remove category from selected consumers ?";
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
      function(isConfirm) {
        if(isConfirm) {
           var event_null = null;

           event_null = $.ajax({
            url:url+'/'+admin_panel_slug+'/consumers/action_user_category',
            type:'POST',
            data:{  arr_user:arr_user,
                    category_id:category_id,
                    perform_action:action,
                    _token:"{{csrf_token()}}" },
            dataType:'json',
            beforeSend:function() {
              if(event_null != null){
                console.log("Action in progress.");
                return false;
              }
            },
            success:function(response) {
                if(response.status == "SUCCESS") {
                  window.location.reload();
                  return;
                } else {
                  showAlert(response.msg,'error');
                }
                return false;
            }
          });
        } else {
         return false;
        }
      }); 
    }
</script>

@stop                    


