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
    <li >  <a href="{{$module_url_path}}">{{ isset($module_title)?$module_title:"" }}</a>
    </li>
    <span class="divider">
      <i class="fa fa-angle-right">
      </i>
      <i class="fa {{$create_icon}}">
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
          <i class="fa {{$create_icon}}">
          </i>{{ isset($page_title)?$page_title:"" }} 
        </h3>
        <div class="box-tool">
        </div>
      </div>
      <div class="box-content studt-padding">
        
        @include('admin.layout._operation_status')
   
         
          <form method="POST" id="validation-form" class="form-horizontal" action="{{$module_url_path}}/store" enctype="multipart/form-data">
                
                {{ csrf_field() }}

                  
                  @if(isset($arr_lang) && sizeof($arr_lang)>0)                  
                  
                  <input type="hidden" id="arr_lang" name="arr_lang" value="{{ (isset($arr_lang))? json_encode($arr_lang): json_encode(array()) }}">                  
                   
                      <div class="lang_div" > 

                      @foreach($arr_lang as $lang)                       
                            
                          <div class="form-group">
                              <label class="col-sm-3 col-lg-2 control-label" for="state">{{isset($lang['title']) ? $lang['title'] : ''}}  @if($lang['locale'] == 'en') <i class="red">*</i> @endif </label>

                              <div class="col-sm-6 col-lg-8 controls">
                                  <input type="text" class="form-control"
                                  @if($lang['locale'] == 'en')  name="english[]" 
                                  @else name="{{isset($lang['title']) ? str_slug($lang['title'],'_') : ''}}[]" 
                                  @endif 
                                  @if($lang['locale'] == 'en')  @endif 
                                  @if($lang['locale'] == 'en')  @endif />
                              </div>

                                <span class='help-block'>{{ $errors->first(str_slug($lang['title'],'_')) }}</span>  
                          </div>
                      @endforeach

                    </div>

                    <!-- <div class="form-group add_data" id="add_data">
                       <div class="col-sm-6 col-lg-7 controls"></div>
                       <div class="col-sm-3 col-lg-1 control-label" >
                          <button type="button" id="append_new_html_data" title="" class="btn btn-success btn-sm show-tooltip" ><i class="fa fa-plus-circle"></i></button>
                        </div>
                    </div> -->
                  
                    @endif                

                    <div class="form-group">
                          <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                            <input type="submit" id="save_btn" class="btn btn btn-primary" value="Save "/>
                          </div>
                    </div>
                
              </form>
             

      </div>
    </div>
  </div>
  <!-- END Main Content --> 

  

  <script type="text/javascript">
  
  $(document).ready(function()
  {  


    $("#autocomplete").bind('keypress',function(event)
    {
    });


   $('#append_new_html_data').click(function()
   { 
      var div =  $('.add_data:last');
      var new_html = '';
      

      var length = $('.lang_div').length;
      
      if(length == 1)
      {
          $('.lang_div').clone().insertAfter(div);

          new_html = '<div class="form-group" >'+
                          '<div class="col-sm-3 col-lg-2 control-label">&nbsp;</div>'+
                          '<div class="col-sm-6 col-lg-6 control-label">'+                       
                            '<button type="button" onclick="removeDynamicKeyword(this)" id="remove_data" title="Remove Keyword" class="btn btn-danger btn-sm show-tooltip" ><i class="fa fa-minus-circle"></i></button>'+
                           '</div> '+
                      '</div>';  
          
          $('.lang_div:last').append(new_html); 
      }
      else
      {
        $('.lang_div:last').clone().insertAfter('.lang_div:last');
      }
      
   }); 

  }); 

function removeDynamicKeyword(ref)
{
    $(ref).parent().parent().parent().remove();
}
  </script>
 <script type="text/javascript">

    function saveTinyMceContent()
    {
      tinyMCE.triggerSave();
    }

    $(document).ready(function()
    {
      tinymce.init({
        selector: 'input[type="text"]',
        height:350,
        theme: "modern",
        paste_data_images: false,
        /*plugins: [
        'advlist autolink lists link image charmap print preview anchor',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media table contextmenu paste code'
        ],*/
        plugins: ['link'],
        valid_elements : '*[*]',
        /*toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image ',*/
        toolbar: 'link',
        image_advtab: false,
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
        content_css: ['//fonts.googleapis.com/css?family=Lato:300,300i,400,400i','//www.tinymce.com/css/codepen.min.css']
      });  
    });
  </script>

  @endsection
