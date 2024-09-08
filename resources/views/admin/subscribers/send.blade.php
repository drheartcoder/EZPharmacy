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
                  <i class="fa fa-users"></i>
                  <a href="{{ $module_url_path }}">{{ $module_title or ''}}</a>
                </span> 
            <span class="divider">
                <i class="fa fa-angle-right"></i>
                <i class="fa fa-envelope"></i>
            </span> 
            <li class="active">  {{ isset($page_title)?$page_title:"" }}</li>
        </ul>
    </div>
    <!-- END Breadcrumb -->

    <!-- BEGIN Main Content -->
    
    
    <div class="row">
        <div class="col-md-12">
            <div class="box  ">
                <div class="box-title">
                    <h3><i class="fa fa-envelope"></i> {{ isset($page_title)?$page_title:"" }}</h3>
                    <div class="box-tool">
                    </div>
                </div>
                <div class="box-content">
                 @include('admin.layout._operation_status') 

                <form name="validation-form" id="validation-form" action="{{ $module_url_path }}/store" method="POST" class="form-horizontal" enctype="multipart/form-data">
                {{ csrf_field() }}
                  <br>
                      <input name="image" type="file" class="hidden tinymce_upload" onchange="">
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-2 control-label">All Usres   <i class="red">*</i> </label>
                        <div class="col-sm-9 col-lg-6 controls">                            
                            <select class="form-control " name="users[]" multiple="multiple" id="users"  tabindex="6" data-rule-required="true">    
                                <option value="">--Select User--</option>
                                <?php if(count($arr_user_rec)> 0) 
                                    { 
                                        foreach($arr_user_rec as $row) 
                                        { ?>
                                            <option value="{{$row['email']}}">
                                                {{ $row['email'] }}
                                            </option>
                                  <?php } 
                                    } ?>
                            </select>  
                            <span class='help-block' id="err_users"> {{ $errors->first('users') }} </span>                           
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 col-lg-2 control-label" for="email">Content
                        <i class="red">*</i> 
                        </label>
                        <div class="col-sm-6 col-lg-7 controls">   
                            <textarea class="form-control ckeditor" name="description" id="description" rows="10" data-rule-required="true" placeholder="Description"></textarea>
                            <span class='help-block' id="err_description"> {{ $errors->first('description') }} </span> 

                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                            <input type="submit" name="btn_send" id="btn_send" value="Send" onclick="saveTinyMceContent();" class="btn btn btn-primary">
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>

      <script type="text/javascript">
    function saveTinyMceContent()
    {
      tinyMCE.triggerSave();
    }
  
    $(document).ready(function()
    {
    
      tinymce.init({
        selector: 'textarea',
        height:350,
        theme: "modern",
        paste_data_images: true,
        plugins: [
        'advlist autolink lists link image charmap print preview anchor',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media table contextmenu paste code'
        ],
        valid_elements : '*[*]',
        toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image ',
        image_advtab: true,
        file_picker_callback: function(callback, value, meta) {
          if (meta.filetype == 'image') {
            $('.tinymce_upload').trigger('click');
            $('.tinymce_upload').on('change', function() {
              var file = this.files[0];
              var reader = new FileReader();
              reader.onload = function(e) {
                callback(e.target.result, {
                  alt: ''
                });
              };
              reader.readAsDataURL(file);
            });
          }
        },
        content_css: [
        /*'//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',*/
        '//www.tinymce.com/css/codepen.min.css'
        ]
      });  
    });
    </script>
    <!-- END Main Content --> 
@stop