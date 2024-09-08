@extends('admin.layout.master')
@section('main_content')
<link rel="stylesheet" type="text/css" href="{{ url('/assets/data-tables/latest/') }}/dataTables.bootstrap.min.css">
<!-- BEGIN Breadcrumb -->
<div id="breadcrumbs">
   <ul class="breadcrumb">
      <li>
         <i class="fa fa-home"></i>
         <a href="{{ url($admin_panel_slug.'/dashboard') }}">Dashboard</a>
      </li>
      <span class="divider">
      <i class="fa fa-angle-right"></i>
      <i class="fa {{$module_icon or ''}}" ></i>
      <a href="{{ $module_url_path }}/manage">{{ $page_title or ''}}</a>
      </span>
   </ul>
</div>
<!-- END Breadcrumb -->

<!-- BEGIN Main Content -->
<div class="row">
   <div class="col-md-12">
      <div class="box">
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

            <form name="frm_manage" id="frm_manage" method="POST" class="form-horizontal" action="{{$module_url_path}}/multi_action">
               {{ csrf_field() }}
               
               <div class="btn-toolbar pull-right clearfix">
                  <div class="btn-group">
                     <a href="{{ $module_url_path.'/create'}}" class="btn btn-primary btn-add-new-records"  title="Add {{$module_title or ''}}">Add {{$module_title or ''}}</a>                      
                  </div>
                  <div class="btn-group">    
                     <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Multiple Delete" href="javascript:void(0);" onclick="javascript : return check_multi_action('frm_manage','delete');"  style="text-decoration:none;"><i class="fa fa-trash-o"></i></a>
                  </div>
                  <div class="btn-group"> 
                     <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Refresh" href="{{ $module_url_path }}/manage" style="text-decoration:none;"><i class="fa fa-repeat"></i>
                     </a> 
                  </div>
               </div>
               <br/>
               <br/>
               <div class="clearfix"></div>
               <div class="table-responsive" style="border:0">
                  <input type="hidden" name="multi_action" value="" />
                  <table class="table table-advance" id="table_module"  >
                     <thead>
                        <tr>
                           <th style="width:18px"> <input type="checkbox" name="mult_change" id="mult_change" value="delete" /></th>
                           <th><a class="sort-desc" href="#">Price </a>
                            <input type="text" name="q_price" placeholder="Search" class="search-block-new-table column_filter" /></th>
                           <th><a class="sort-desc" href="#">Category </a>
                            <input type="text" name="q_category" placeholder="Search" class="search-block-new-table column_filter" /></th>
                           <th><a class="sort-desc" href="#">Brouchure </a>
                            <input type="text" name="q_option_name" placeholder="Search" class="search-block-new-table column_filter" /></th>
                           {{-- <th>Status</th> --}}
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                      
                     </tbody>
                  </table>
               </div>
            </form>
         </div>
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
      'url':'{{ $module_url_path.'/loadAllPriceBrouchure/'}}',
      'data': function(d)
        {
          d['column_filter[q_price]'] = $("input[name='q_price']").val()
          d['column_filter[q_category]']          = $("input[name='q_category']").val()
          d['column_filter[q_option_name]']         = $("input[name='q_option_name']").val()
          <?php if($catId != ''){ ?>
          d['column_filter[cat_id]'] = {{$catId}}
          <?php } ?>
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
      {data: 'price', "orderable": true, "searchable":true},
      {data: 'category_name', "orderable": true, "searchable":true},
      {data: 'option_name', "orderable": true, "searchable":true},
      {
        render : function(data, type, row, meta) 
        {
          return row.build_action;
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