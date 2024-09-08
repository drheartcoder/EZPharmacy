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
      {{-- <span class="divider">
        <i class="fa fa-angle-right">
        </i>
        <i class="fa fa-users faa-vertical animated-hover">
        </i>
          <a href="{{ url($module_url_path) }}/manage/{{$usertype}}/" class="call_loader">{{ $page_title }}
        </a>
      </span> --}} 
      <span class="divider">
      <i class="fa fa-angle-right"></i>
      <i class="fa {{$module_icon}}"></i>
      <a href="{{ $module_url_path }}/manage/{{$usertype}}/">{{ $page_title .' [ '. ucfirst($usertype) .' ]' }}</a>
      </span> 
      <span class="divider">
        <i class="fa fa-angle-right">
        </i>
        <i class="fa fa-google-wallet">
        </i>
      </span> 
      <li class="active">{{ $page_title1 }}</li> 
    
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
                {{ 'Manage '.ucfirst($user_info->full_name).' '.' [ '. ucfirst($usertype) .' ] Wallet' }}
                
            </h3>
            <div class="box-tool">
                <a data-action="collapse" href="#"></a>
                <a data-action="close" href="#"></a>
            </div>
        </div>
        <div class="box-content">
          
            

          @include('admin.layout._operation_status')  
          
          <form  method="POST" enctype="multipart/form-data" class="form-horizontal" id="frm_manage">
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
            
              @if($check_admin_role=='admin')
              {{-- <div class="btn-group"> <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Multiple Active/Unblock" href="javascript:void(0);" style="text-decoration:none;"><i class="fa fa-plus"></i></a> </div> --}}
              @endif
              <div class="btn-group"> <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Refresh" href="{{ $module_url_path }}/{{$usertype}}/wallet_details/{{ base64_encode($user_id) }}"style="text-decoration:none;"><i class="fa fa-repeat"></i></a> </div><br></div>
              <input type="hidden" name="usertype" id="usertype" value="{{ $usertype }}">
              <input type="hidden" name="userid" id="userid" value="{{ $user_id }}">
              @if($check_admin_role=='admin')
                <div class="row">
                @if($check_admin_role=='admin')

                 <div class="col-sm-4 col-lg-2 controls">
                    <input type="text" name="amount" id="amount" class="form-control">
                    <span class='help-block' id="err_amount">{{ $errors->first('amount') }}</span>
                  </div>

                  <div class="col-sm-4 col-lg-2 controls">
                    <button class="btn btn-primary btn-add-new-records" type="submit" name="btn_add_wallet_amount" id="btn_add_wallet_amount">Add Wallet Amount</button>
                  </div>
                  @endif


      {{-- 
                  <div class="col-sm-4 col-lg-2 controls">
                    <a class="btn btn-primary btn-add-new-records" onclick="javascript: return actionUserCategory('frm_manage','REMOVE');">Remove User Category</a>
                  </div> --}}
                </div>
              @endif
              <br/>

          <div class="clearfix"></div>

           <div class="table-responsive" style="border:0">      
              <input type="hidden" name="multi_action" value="" />
                <table class="table table-advance"  id="table_module">
                  <thead>
                    <tr>      
                        {{-- @if($check_admin_role=='admin')                     --}}
                          <th style="width: 18px; vertical-align: initial;">{{-- <input type="checkbox"/> --}}</th>
                        {{-- @endif --}}

                        <th>Transaction ID</th> 

                        <th>Amount</th> 

                        <th>Date</th> 

                        <th>Status</th>
                        
                       @if($check_admin_role=='admin')      
                        <th>Action</th>
                        @endif

                    </tr>
                  </thead>
               </table>
            </div>

            
         
           </form>
      </div>
  </div>
</div>


<!-- END Main Content -->
<!-- Admin Role Access -->
{{-- @if($check_admin_role=='admin') --}}

  <script type="text/javascript">

    $("#btn_add_wallet_amount").on('click', function(){
      var amount  = $("#amount").val();
      flag        = 1;

      $("#err_amount").html('');

      if(amount == '')
      {
        $("#err_amount").html('Please enter wallet amount.');
        flag = 0;
      }
      else if(isNaN(amount))
      {
        $("#err_amount").html('Enter invalid wallet amount.');
        flag = 0;
      }
      else if(amount <= 0)
      {
        $("#err_amount").html('Wallet amount must be greater than zero.');
        flag = 0;
      }

      if(flag == 1)
      {
        return true;
      }
      else
      {
        return false;
      }
    });

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
            'url':'{{ $module_url_path.'/loadUserWallet/'}}{{$usertype.'/'}}{{$user_id}}',
            'data': function(d)
              {
                /*d['column_filter[q_name]']          = $("input[name='q_name']").val()
                d['column_filter[q_email]']         = $("input[name='q_email']").val()
                d['column_filter[q_mobile_number]'] = $("input[name='q_mobile_number']").val()
                d['column_filter[q_category_name]'] = $("input[name='q_category_name']").val()*/
              }
            },
            columns: [
            {
              render : function(data, type, row, meta) 
              {
              return '<input type="checkbox" '+
              ' name="checked_record[]" '+  
              ' value="'+row.enc_id+'"/>';
              return '';
              },
              "orderable": false,
              "searchable":false
            },
            {data: 'txn_id', "orderable": true, "searchable":false},
            {data: 'amount', "orderable": true, "searchable":false},
            {data: 'txn_date', "orderable": true, "searchable":false},
            {data: 'txn_status', "orderable": true, "searchable":false},
            {data: 'wallet_status', "orderable": false, "searchable":false}
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
                  url:url+'/'+admin_panel_slug+'/users/action_user_category',
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

{{-- @else

@endif --}}
@stop