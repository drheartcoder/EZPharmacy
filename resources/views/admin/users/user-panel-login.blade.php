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
         <i class="fa fa-home"></i>
         <a href="{{ url($admin_panel_slug.'/dashboard') }}">Dashboard</a>
      </li>
      <span class="divider">
      <i class="fa fa-angle-right"></i>
      <i class="fa {{$module_icon}}"></i>
      <a href="{{ $module_url_path }}/manage/consumer/">{{ $page_title }}</a>
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
            
        </div>
        <div class="box-content" style="text-align: center;padding: 55px;">
        <img src="{{url('').'/front-assets/images/process_login.gif'}}" alt="process_login">

          <div class="clearfix"></div>
        </div>
  </div>
</div>
<!-- END Main Content -->
<!-- Admin Role Access -->
@stop