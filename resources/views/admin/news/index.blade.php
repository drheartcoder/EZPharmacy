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
      <i class="fa {{$module_icon}}"></i>
      <a href="{{ $module_url_path }}">{{ $page_title or ''}}</a>
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

            <form name="frm_manage" id="frm_manage" method="POST" class="form-horizontal" action="{{$module_url_path}}/multi_action">
               {{ csrf_field() }}
               
               <div class="btn-toolbar pull-right clearfix">
                  {{-- <div class="btn-group">
                     <a href="{{ $module_url_path.'/create'}}" class="btn btn-primary btn-add-new-records"  title="Add CMS">Add skill</a>                      
                  </div> --}}

                   <div class="btn-group">
                     <a class="btn btn-primary  btn-add-new-records" 
                        title="Add {{ $module_title or ''}}" 
                        href="{{ $module_url_path.'/create'}}" 
                        style="text-decoration:none;">
                    Add {{$module_title}}
                     </a> 
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
                           <th>{{ $module_title or ''}} Title</th>
                           <th>{{ $module_title or ''}} Description</th>
                           <th>Status</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        @if(isset($arr_data) && sizeof($arr_data)>0)
                          @foreach($arr_data as $data)
                          <tr>
                             <td> 
                                <input type="checkbox" 
                                   name="checked_record[]"  
                                   value="{{ base64_encode($data['id']) }}" /> 
                             </td>
                             <td> {{ isset($data['title'])?$data['title']:'' }} </td>
                            
                             <td> {{ isset($data['description'])? substr(strip_tags($data['description']), 0,60).'...':'' }} </td>
                             

                             <td>
                                @if($data['is_active']==1)
                                <a href="{{ $module_url_path.'/deactivate/'.base64_encode($data['id']) }}" class="btn btn-sm btn-success show-tooltip" onclick="return confirm_action(this,event,'Do you really want to Deactivate this record ?')" title="Deactivate" ><i class="fa fa-unlock"></i></a>
                                @else
                                <a href="{{ $module_url_path.'/activate/'.base64_encode($data['id']) }}" class="btn btn-sm btn-danger show-tooltip" onclick="return confirm_action(this,event,'Do you really want to Activate this record ?')" title="Activate" ><i class="fa fa-lock"></i></a>
                                @endif
                             </td>


                             <td> 
                                <a class="btn btn-sm btn-primary show-tooltip" href="{{ $module_url_path.'/edit/'.base64_encode($data['id']) }}"  title="Edit">
                                <i class="fa fa-edit" ></i>
                                </a>  
                                &nbsp;  
                                <a class="btn btn-sm btn-danger show-tooltip" href="{{ $module_url_path.'/delete/'.base64_encode($data['id'])}}" 
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
            </form>
         </div>
      </div>
   </div>
</div>
<!-- END Main Content -->
<script type="text/javascript" src="{{ url('/assets/data-tables/latest') }}/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="{{ url('/assets/data-tables/latest') }}/dataTables.bootstrap.min.js"></script>

@stop