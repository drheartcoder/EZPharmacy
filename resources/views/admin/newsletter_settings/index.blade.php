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
      <a href="{{ url($admin_panel_slug.'/dashboard') }}">Dashboard
      </a>
    </li>
    <span class="divider">
      <i class="fa fa-angle-right">
      </i>
      <i class="fa {{$module_icon}}">
      </i>
    </span> 
    <li class="active">  {{ isset($page_title)?$page_title:"" }}
    </li>
  </ul>
</div>
<!-- END Breadcrumb -->
<!-- BEGIN Main Content -->
<div class="row">
  <div class="col-md-12">
    <div class="box {{ $theme_color }}">
      <div class="box-title">
        <h3>
          <i class="fa {{$module_icon}}">
          </i>{{ isset($page_title)?$page_title:"" }} 
        </h3>
        <div class="box-tool">
        </div>
      </div>
      <div class="box-content">
        @include('admin.layout._operation_status')
        {!! Form::open([ 'url' => $module_url_path.'/update/'.base64_encode($arr_data['id']),
        'method'=>'POST',   
        'class'=>'form-horizontal', 
        'id'=>'validation-form' 
        ]) !!}
        <div class="form-group">
          <label class="col-sm-3 col-lg-2 control-label">MailChimp API Key
            <i class="red">*
            </i>
          </label>
          <div class="col-sm-9 col-lg-4 controls">
            {!! Form::text('mailchimp_api_key',$arr_data['mailchimp_api_key'],['class'=>'form-control','id'=>'api_key','data-rule-required'=>'true','data-rule-maxlength'=>'255', 'placeholder'=>'MailChimp API Key']) !!}
            <span class='help-block'>{{ $errors->first('mailchimp_api_key') }}
            </span>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-lg-2 control-label">MailChimp List Id
            <i class="red">*
            </i>
          </label>
          <div class="col-sm-9 col-lg-4 controls">
            {!! Form::text('mailchimp_list_id',$arr_data['mailchimp_list_id'],['class'=>'form-control','id'=>'list_id','data-rule-required'=>'true','data-rule-maxlength'=>'255', 'placeholder'=>'MailChimp List Id']) !!}
            <span class='help-block'>{{ $errors->first('mailchimp_list_id') }}
            </span>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
            <input type="submit" value="Update" class="btn btn btn-primary" />
          </div>
        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
  <!-- END Main Content --> 
  @endsection
<script type="text/javascript">

// function no_spaces() 
// { 
//   if (/^\S{3,}$/.test(String($("#api_kjey").val()))) 
//   {
//      alert('Please add valid api-key');
//      return false;
//   } 
//   else
//   {
//      alert('123'); 
//      return true;
//   }
// }
</script>