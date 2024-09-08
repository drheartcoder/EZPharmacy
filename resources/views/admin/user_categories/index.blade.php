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
      <i class="fa fa-home">
      </i>
      <a href="{{ url($admin_panel_slug.'/dashboard') }}">Dashboard
      </a>
    </li>
    <span class="divider">
      <i class="fa fa-angle-right">
      </i>
      <i class="fa {{$module_icon or ''}}">
      </i>
      <a href="{{ $module_url_path }}">Manage {{ $module_title or ''}}
      </a>
    </span> 
   {{--  <span class="divider">
      <i class="fa fa-angle-right">
      </i>
      <i class="fa {{$module_icon or ''}}">
      </i>
    </span>
    <li class="active">{{ isset($page_title)?$page_title:"" }}
    </li> --}}
  </ul>
</div>
<!-- END Breadcrumb -->
<!-- BEGIN Main Content -->
<div class="row">
  <div class="col-md-12">
    <div class="box {{ $theme_color }}">
      <div class="box-title">
        <h3>
          <i class="fa {{$module_icon or ''}}">
          </i>
          {{ isset($page_title)?$page_title:"" }}
        </h3>
        <div class="box-tool">
          <a data-action="collapse" href="#">
          </a>
          <a data-action="close" href="#">
          </a>
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
          <div id="ajax_op_status">
          </div>
          <div class="alert alert-danger" id="no_select" style="display:none;">
          </div>
          <div class="alert alert-warning" id="warning_msg" style="display:none;">
          </div>
        </div>
        <div class="btn-toolbar pull-right clearfix">
          <div class="btn-group">
            <a href="{{ $module_url_path.'/create'}}" class="btn btn-primary btn-add-new-records">Add {{str_singular($module_title) }}
            </a>
          </div>
         {{--  <div class="btn-group">
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
          </div> --}}
            <div class="btn-group">
            <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" 
               title="Multiple Delete" 
               href="javascript:void(0);" 
               onclick="javascript : return check_multi_action('frm_manage','delete');"  
               style="text-decoration:none;">
                <i class="fa fa-trash"></i>
            </a> 
          </div>
          <div class="btn-group"> 
            <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" 
               title="Refresh" 
               href="{{ $module_url_path }}"
               style="text-decoration:none;">
              <i class="fa fa-repeat">
              </i>
            </a> 
          </div>
        </div>
        <br/>
        <div class="clearfix">
        </div>

        <div class="table-responsive" style="border:0">
          <input type="hidden" name="multi_action" value="" />
          <table class="table table-advance"  id="table1" >
            <thead>
              <tr>
                <th style="width:18px"> 
                  <input type="checkbox" name="mult_change" id="mult_change" />
                </th>
                <th>
                  Category Name
                </th>                 
                <th>
                  Action
                </th>
              </tr>
            </thead>
            <tbody>
              @if(isset($arr_data) && sizeof($arr_data)>0)
              @foreach($arr_data as $key => $data )
              <tr>
                <td> 
                  @if($data->id != 0)
                    <input type="checkbox" name="checked_record[]" value="{{ base64_encode($data->id) }}" />
                  @endif
                </td>

                <td> {{ $data->name or '-' }} </td>
               
                <td>
                  @if($data->id != 0)
                    <a class="btn btn-primary btn-sm show-tooltip" href="{{ $module_url_path.'/edit/'.base64_encode($data->id) }}"  title="Edit"><i class="fa fa-edit" ></i></a>  
                    <a class="btn btn-sm btn-danger show-tooltip" href="{{ $module_url_path.'/delete/'.base64_encode($data->id)}}" onclick="return confirm_action(this,event,'If you delete Category then consumers associated with the category will get set to Default category. Delete category ?')" title="Delete"><i class="fa fa-trash" ></i></a>
                  @endif
                  <div class="btn-group">
                      <a href="javascript:void(0);" class="btn"><i class="fa fa-align-justify"></i> View</a>
                      <a href="javascript:void(0);" data-toggle="dropdown" class="btn dropdown-toggle" aria-expanded="false"><span class="caret"></span></a>
                      <ul class="dropdown-menu">
                          <li><a href="{{ url('/').'/'.$admin_panel_slug.'/users/all/'.$data->id.'/'}}" target="_blank"><i class="fa fa-external-link"></i> All Users</a></li>
                          <li><a href="{{ url('/').'/'.$admin_panel_slug.'/prices/size/manage/'.$data->id.'/'}}" target="_blank"><i class="fa fa-external-link"></i> All Paper Price</a></li>
                          <li><a href="{{ url('/').'/'.$admin_panel_slug.'/prices/printing/manage/'.$data->id.'/'}}" target="_blank"><i class="fa fa-external-link"></i> All Printing Price</a></li>
                          <!-- <li class="divider"></li> -->
                          <li><a href="{{ url('/').'/'.$admin_panel_slug.'/prices/binding/manage/'.$data->id.'/'}}" target="_blank"><i class="fa fa-external-link"></i> All Binding Price</a></li>
                          <li><a href="{{ url('/').'/'.$admin_panel_slug.'/prices/brochure/manage/'.$data->id.'/'}}" target="_blank"><i class="fa fa-external-link"></i> All Brochure Price</a></li>
                      </ul>
                  </div>
                </td>
              </tr>
              @endforeach
              @endif
            </tbody>
          </table>
        </div>
        <div>   
        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
  <!-- END Main Content -->
  
@stop                    
