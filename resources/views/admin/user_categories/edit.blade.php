@extends('admin.layout.master')            
@section('main_content')
<!-- BEGIN Page Title -->
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
      <a href="{{ url($admin_panel_slug.'/dashboard') }}">Dashboard</a>
    </li>
    <span class="divider">
      <i class="fa fa-angle-right">
      </i>
      <i class="fa {{$module_icon or ''}}">
      </i>
      <a href="{{ $module_url_path }}"> Manage {{ $module_title or ''}}
      </a>
    </span> 
    <span class="divider">
      <i class="fa fa-angle-right">
      </i>
      <i class="fa fa-edit">
      </i>
    </span>
    <li class="active">{{ $page_title or ''}}
    </li>
  </ul>
</div>
<!-- END Breadcrumb -->
<!-- BEGIN Main Content -->
<div class="row">
    <div class="col-md-12">
      <div class="box">
          <div class="box-title">
              <h3><i class="fa fa-edit"></i> {{ isset($page_title)?$page_title:"" }}</h3>
              <div class="box-tool"></div>
          </div>
          <div class="box-content">
              @include('admin.layout._operation_status')
              <form name="validation-form" id="validation-form" method="POST" class="form-horizontal" enctype="multipart/form-data">  
                  
                  <input type="hidden" name="enc_id"  value="{{$enc_id or ''}}"  readonly="" />  

                  {{ csrf_field() }}

                  <div class="form-group">
                      <label class="col-sm-3 col-lg-2 control-label">Category Name<i class="red">*</i></label>
                      <div class="col-sm-9 col-lg-4 controls">
                          <input  type="text" name="name" data-rule-required="true" value="{{$arr_data->name or ''}}" class="form-control" data-rule-maxlength="100" />
                          <span class='help-block'>{{ $errors->first('name') }}</span>
                      </div>
                  </div>
                  
                  <div class="form-group">
                      <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                          <input type="submit" id="btn_edit_user_category" name="btn_edit_user_category" value="Save"  class="btn btn btn-primary" />
                          <input type="button" value="Back" class="btn btn btn-primary" onclick='window.location.href="{{ $module_url_path }}"'>
                      </div>
                 </div>
              </form>
          </div>
      </div>
    </div>
  <!-- END Main Content -->
@stop                    
