@extends('admin.layout.master')                
@section('main_content')

<style type="text/css">
  .ui-autocomplete
  {
    max-width: 26% !important;
  }
  .mass_min {
    background: #fcfcfc none repeat scroll 0 0;
    border: 1px dashed #d0d0d0;
    float: left;
    margin-bottom: 20px;
    margin-right: 21px;
    margin-top: 10px;
    padding: 5px;
  }
  .mass_addphoto {
    display: inline-block;
    margin: 0 10px;
    padding-top: 27px;
    text-align: center;
    vertical-align: top;
  }
  .mass_addphoto {
    text-align: center;
  }
  .upload_pic_btn {
    cursor: pointer;
    font-size: 14px;
    height: 100% !important;
    left: 0;
    margin: 0;
    opacity: 0;
    padding: 0;
    position: absolute;
    right: 0;
    top: 0;
  }
</style>

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
      <i class="fa fa-users faa-vertical animated-hover"></i>
      <?php
         $usertype= isset($arr_consumer['user_type']) ?$arr_consumer['user_type']:"consumer";
       ?>

      <a href="{{ url($module_url_path) }}/manage/{{$usertype}}/" class="call_loader">{{ $module_title or ''}}
      </a>
    </span> 
    <span class="divider">
      <i class="fa fa-angle-right"></i>
      <i class="fa fa-file"></i>
    </span> 
    <li class="active">{{ $page_title .' [ '. ucfirst($usertype) .' ]' }}</li>
  </ul>
</div>
<!-- END Breadcrumb -->
<!-- BEGIN Main Content -->
<div class="row">
  <div class="col-md-12">
    <div class="box ">
      <div class="box-title">
        <h3>
          <i class="fa fa-file"></i> {{ $page_title .' [ '. ucfirst($usertype) .' ]' }} 
        </h3>
        <div class="box-tool">
        </div>
      </div>
      <div class="box-content">
       
        <div class="box">
          <div class="box-content studt-padding">
            <div class="row">
            
                        
            <div class="form-group" style="margin-top: 15px;">
                <label class="col-sm-8 col-lg-8 control-label" style="text-align:left">
                  <h3>Uploaded Files 
                  </h3>
                </label>
              </div>
              <div class="col-md-8">
                <table class="table table-bordered">
                <tbody>
                  @if(isset($arr_consumer['my_files']) && sizeof($arr_consumer['my_files'])>0)
                   @foreach($arr_consumer['my_files'] as $data)
                  <tr>
                    <th style="width: 30%"><a target="blank" href="{{url('').'/'.$data['filepath']}}" >{{ $data['filename']}}</a>
                    </th>
                    <td>
                      {{ $data['num_pages']}} Pages
                    </td>
                  </tr>
                  @endforeach
                  @else
                   No file Found
                  @endif
                 
          </tbody>
        </table>  
            </div>            

            </div>
          </div>
        </div>
        
      </div>
    </div>
  </div>
  <!-- END Main Content --> 
  @endsection
