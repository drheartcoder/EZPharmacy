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
      <a href="{{ url($admin_panel_slug.'/dashboard') }}"> Dashboard </a>
    </li>
    <span class="divider">
      <i class="fa fa-angle-right"></i>
      <i class="fa fa-envelope"></i>
      <a href="{{ $module_url_path }}"> {{ $module_title or ''}} </a>
    </span> 
    <span class="divider">
      <i class="fa fa-angle-right"></i>
      <i class="fa fa-edit"></i>
    </span>
    <li class="active"> {{ $page_title or ''}} </li>
  </ul>
</div>
<!-- END Breadcrumb -->
<!-- BEGIN Main Content -->
<div class="row">
  <div class="col-md-12">
    <div class="box {{ $theme_color }}">
      <div class="box-title">
        <h3>
          <i class="fa fa-edit"></i>
          {{ $page_title or ''}}
        </h3>
        <div class="box-tool">
          <a data-action="collapse" href="#"></a>
          <a data-action="close" href="#"></a>
        </div>
      </div>

            <div class="box-content">
        
        @include('admin.layout._operation_status')
   
          <div class="tabbable">
          <form method="POST" id="form_validation" class="form-horizontal" data-parsley-validate="" action="{{$module_url_path}}/update/{{base64_encode($arr_data['id'])}}" enctype="multipart/form-data">
                
                {{ csrf_field() }}              

                <ul  class="nav nav-tabs">
                    @include('admin.layout._multi_lang_tab')
                </ul>

                <div  class="tab-content">


                  @if(isset($arr_lang) && sizeof($arr_lang)>0)
                        @foreach($arr_lang as $lang)

                              <?php 
                                    /* Locale Variable */  
                                    $template_name = "";
                                    
                                    if(isset($arr_data['translations'][$lang['locale']]))
                                    { 
                                      $template_name = $arr_data['translations'][$lang['locale']]['template_name'];
                                    }
                                  
                              ?>
                            <div class="tab-pane fade {{ $lang['locale']=='en'?'in active':'' }}"     id="{{ $lang['locale'] }}">
                             
                            <div class="form-group">
                              <label class="col-sm-3 col-lg-2 control-label" for="email"> Email Template Name 
                               @if($lang['locale'] == 'en')<i class="red">*</i>@endif
                              </label>
                              <div class="col-sm-6 col-lg-4 controls">
                              @if($lang['locale'] == 'en')       
                                <input type="text" name="template_name_{{$lang['locale']}}" required=""  placeholder="Email Template Name" value="{{$template_name}}"  class="form-control add-stundt"/>
                              @else
                                <input type="text" name="template_name_{{$lang['locale']}}" placeholder="Email Template Name" value="{{$template_name}}"  class="form-control add-stundt"/>
                              @endif
                              </div>
                              <span class='help-block'> {{ $errors->first('template_name_'.$lang['locale']) }} </span>  
                            </div>

                         </div>     
                      @endforeach
                  @endif

                </div>
                <br>
                <div class="form-group">
                      <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                      <input type="submit" id="save_btn" class="btn btn btn-primary" value="Update"/>
                  
                    </div>
                </div>
                
              </form>
                
            </div>  
  

      </div>

    </div>
  </div>
  <!-- END Main Content -->
  <script type="text/javascript">
    
    $('#form_validation').submit(function(){
        tinyMCE.triggerSave();
     });

    $(document).ready(function()
    {
      tinymce.init({
        selector: 'textarea',
        relative_urls: false,
        remove_script_host:false,
        convert_urls:false,
        plugins: [
          'advlist autolink lists link image charmap print preview anchor',
          'searchreplace visualblocks code fullscreen',
          'insertdatetime media table contextmenu paste code'
        ],
        toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        content_css: [
          /*'//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',*/
          '//www.tinymce.com/css/codepen.min.css'
        ]
      });
    });
    
  </script>
  @stop