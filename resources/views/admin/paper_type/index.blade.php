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

                   {{-- <div class="btn-group">
                     <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" 
                        title="Add {{ $module_title or ''}}" 
                        href="{{ $module_url_path.'/create'}}" 
                        style="text-decoration:none;">
                     <i class="fa fa-plus"></i>
                     </a> 
                  </div> --}}

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

                  @if(isset($arr_data) && sizeof($arr_data)>0)
                  {{-- <div class="btn-group"> 
                  <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" 
                         title="Export Skills" 
                         style="text-decoration:none;"
                         href="{{$module_url_path}}/export" 
                          >
                         <i class="fa fa-file"></i>
                  </a>
                  </div> --}}
                  @endif

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
               </div>
               <br/>
               <br/>
               <div class="clearfix"></div>
               <div class="table-responsive" style="border:0">
                  <input type="hidden" name="multi_action" value="" />
                  <table class="table table-advance"  id="table1" >
                     <thead>
                        <tr>
                           <th style="width:18px"> <input type="checkbox" name="mult_change" id="mult_change" value="delete" /></th>

                           <th>Name</th>
                           <th>Description</th>

                           <th>Status</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>

                        @if(isset($type_arr) && sizeof($type_arr)>0)
                          @foreach($type_arr as $data)
                          <?php
                          $is_used = array();
                          $is_used = \DB::table('order_master as OM')->select('paper_type')->where('paper_type', '=', $data->primaryKey)->get();
                          ?>
                          <tr>
                             <td><input type="checkbox" name="checked_record[]" value="{{ base64_encode($data->primaryKey) }}" /></td>
                             <td>{{ isset($data->name)?$data->name:'' }}</td>
                             <td>{{ isset($data->description)?str_limit($data->description,120):'' }}</td>
                             <td>
                                @if($data->list_status=='yes')
                                <a href="{{ $module_url_path.'/action/deactivate/'.base64_encode($data->primaryKey) }}" class="btn btn-sm btn-success show-tooltip" onclick="return confirm_action(this,event,'Do you really want to Deactivate this record ?')" title="Deactivate" ><i class="fa fa-unlock"></i></a>
                                @else
                                <a href="{{ $module_url_path.'/action/activate/'.base64_encode($data->primaryKey) }}" class="btn btn-sm btn-danger show-tooltip" onclick="return confirm_action(this,event,'Do you really want to Activate this record ?')" title="Activate" ><i class="fa fa-lock"></i></a>
                                @endif
                             </td>

                             <td> 
                                <a class="btn btn-sm btn-primary show-tooltip" href="{{ $module_url_path.'/edit/'.base64_encode($data->primaryKey) }}"  title="Edit">
                                <i class="fa fa-edit" ></i>
                                </a>  
                                &nbsp;  
                                @if(count($is_used) == 0)
                                  <a class="btn btn-sm btn-danger show-tooltip" href="{{ $module_url_path.'/action/delete/'.base64_encode($data->primaryKey)}}" onclick="return confirm_action(this,event,'Do you really want to delete this record ?')" title="Delete"><i class="fa fa-trash" ></i></a>
                                @else
                                  <a class="btn btn-sm btn-danger show-tooltip" href="javascript:void(0);" onclick="javascript:swal('Type already used,You can\'t delete it.')" title="Used"><i class="fa fa-close" ></i></a>
                                @endif
                             </td>
                             
                          </tr>
                          @endforeach
                        @endif
                     </tbody>
                  </table>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<!-- END Main Content -->
<script type="text/javascript" src="{{ url('/assets/data-tables/latest') }}/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="{{ url('/assets/data-tables/latest') }}/dataTables.bootstrap.min.js"></script>

@stop