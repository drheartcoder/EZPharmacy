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
      <i class="fa {{$module_icon or ''}}"></i>
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
                <i class="fa {{$module_icon or ''}}"></i>
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
            <div id="ajax_op_status"></div>
            <div class="alert alert-danger" id="no_select" style="display:none;"></div>
            <div class="alert alert-warning" id="warning_msg" style="display:none;"></div>
          </div>

          <div class="btn-toolbar pull-right clearfix">
          
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
          <br/>
          <div class="clearfix"></div>

           <div class="table-responsive" style="border:0">      
              <input type="hidden" name="multi_action" value="" />
                <table class="table table-advance table-condensed">
                  <thead>
                    <tr>                          
                        <th style="width: 18px; vertical-align: initial;"><input type="checkbox"/></th>
                        <th>State</th> 
                        <th>Country</th>
                        <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(count($arr_data))
                  @foreach($arr_data as $data)
                  <tr>
                    <td> 
                      <input type="checkbox" name="checked_record[]" value="{{ base64_encode($data->id) }}" />
                    </td>
                    <td> {{ $data->state_title }} </td> 
                    <td> {{ $data->country_name }} </td> 
                    <td>
                        @if($data->is_active==1)
                        <a href="{{ $module_url_path.'/deactivate/'.base64_encode($data->id) }}" class="btn btn-sm btn-success show-tooltip" onclick="return confirm_action(this,event,'Do you really want to Deactivate this record ?')" title="Deactivate" ><i class="fa fa-unlock"></i></a>
                        @else
                        <a href="{{ $module_url_path.'/activate/'.base64_encode($data->id) }}" class="btn btn-sm btn-danger show-tooltip" onclick="return confirm_action(this,event,'Do you really want to Activate this record ?')" title="Activate" ><i class="fa fa-lock"></i></a>
                        @endif
                     </td>
                  </tr>
                  @endforeach
                    @if(!empty($arr_data->links()))
                      <tr><td colspan="4" style="text-align: right;">
                      {{$arr_data->links()}}
                      </td></tr>
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
<script type="text/javascript">

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
      'url':'{{ $module_url_path.'/load_table_data'}}',
      'data': function(d)
        {
          d['column_filter[q_state_name]']    = $("input[name='q_state_name']").val()
          d['column_filter[q_country_name]']  = $("input[name='q_country_name']").val()
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
      {data: 'state_title', "orderable": true, "searchable":true},
      {data: 'country_name', "orderable": true, "searchable":true},
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

</script>

@stop                    


