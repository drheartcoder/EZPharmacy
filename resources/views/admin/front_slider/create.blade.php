@extends('admin.layout.master')                
@section('main_content')
<link  href="{{ url('/assets/datepicker/datepicker.css') }}" rel="stylesheet">
<script src="{{ url('/assets/datepicker/datepicker.js') }}">
</script>
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
      <a class=" call_loader" href="{{ url($admin_panel_slug.'/dashboard') }}">Dashboard
      </a>
    </li>
    <span class="divider">
      <i class="fa fa-angle-right">
      </i>
      <i class="fa {{$module_icon}}">
      </i>
      <a class=" call_loader" href="{{ $module_url_path }}">{{ $module_title or ''}}
      </a>
    </span> 
    <span class="divider">
      <i class="fa fa-angle-right">
      </i>
      <i class="fa {{$create_icon}}">
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
          
    <div class="box box-navi_blue">
      <div class="box-title">
        <h3>
          <i class="fa {{$create_icon}}">
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
        <div class="tabbable">
          {!! Form::open([ 'url' => $module_url_path.'/store',
          'method'=>'POST',
          'enctype' =>'multipart/form-data',   
          'class'=>'form-horizontal', 
          'id'=>'validation-form' 
          ]) !!} 
          
          <ul  class="nav nav-tabs">
            @include('admin.layout._multi_lang_tab')
          </ul>
          <div  class="tab-content">
            @if(isset($arr_lang) && sizeof($arr_lang)>0)                       
            @foreach($arr_lang as $lang)
            <div class="tab-pane fade {{ $lang['locale']=='en'?'in active':'' }}" id="{{ $lang['locale'] }}">
               
              @if($lang['locale']=="en")      
              
              <div class="form-group">
                <label class="col-sm-3 col-lg-2 control-label" for="state">{{ $lang['title'] }} Text1 
                </label>
                <div class="col-sm-6 col-lg-4 controls">
                  @if($lang['locale'] == 'en')        
                  {!! Form::textarea('text1_'.$lang['locale'],old('text1'.$lang['locale']),['class'=>'form-control','data-rule-required'=>'true','data-rule-maxlength'=>'80', 'placeholder'=>'Enter Text 1']) !!}
                  @else
                  {!! Form::textarea('text1'.$lang['locale'],old('text1'.$lang['locale'])) !!}
                  @endif    
                </div>
                <span class='help-block'>{{ $errors->first('text1'.$lang['locale']) }}
                </span>  
              </div>
              <div class="form-group">
                <label class="col-sm-3 col-lg-2 control-label" for="state">{{ $lang['title'] }} Text2 
                </label>
                <div class="col-sm-6 col-lg-4 controls">
                  @if($lang['locale'] == 'en')        
                  {!! Form::textarea('text2_'.$lang['locale'],old('text2'.$lang['locale']),['class'=>'form-control','data-rule-required'=>'true','data-rule-maxlength'=>'77', 'placeholder'=>'Enter Text 2']) !!}
                  @else
                  {!! Form::textarea('text2'.$lang['locale'],old('text2'.$lang['locale'])) !!}
                  @endif    
                </div>
                <span class='help-block'>{{ $errors->first('text2'.$lang['locale']) }}
                </span>  
              </div>
              <div class="form-group">
                <label class="col-sm-3 col-lg-2 control-label" for="state">{{ $lang['title'] }}  Text3 
                </label>
                <div class="col-sm-6 col-lg-4 controls">
                  @if($lang['locale'] == 'en')        
                  {!! Form::textarea('text3_'.$lang['locale'],old('text3'.$lang['locale']),['class'=>'form-control','data-rule-required'=>'true','data-rule-maxlength'=>'254', 'placeholder'=>'Enter Text 3'  ]) !!}
                  @else
                  {!! Form::textarea('text3'.$lang['locale'],old('text3'.$lang['locale'])) !!}
                  @endif    
                </div>
                <span class='help-block'>{{ $errors->first('text3'.$lang['locale']) }}
                </span>  
              </div> 

              <div class="form-group">
                <label class="col-sm-3 col-lg-2 control-label"> Image 
                  <i style="color:red;">*
                  </i> 
                </label>
                <div class="col-sm-9 col-lg-10 controls">
                  <div class="fileupload fileupload-new" data-provides="fileupload">
                    <div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">
                      <img src="" alt="img" name="img">
                    </div>
                    <div class="fileupload-preview fileupload-exists img-thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;">
                    </div>
                    <div>
                      <span class="btn btn-default btn-file">
                        <span class="fileupload-new" >Select image
                        </span> 
                        <span class="fileupload-exists">Change
                        </span>
                        {!! Form::file('image',['id'=>'image','class'=>'file-input news-image','data-rule-required'=>'true']) !!}
                      </span> 
                      <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove
                      </a>
                      <span>
                      </span> 
                    </div>
                  </div>
                  <span class='help-block'>{{ $errors->first('image') }}
                  </span>  
                  <div style="color:red;">Note: Please upload an image in jpg,jpeg,png format  & <br/>
                  For best quality picture please upload image having 1920 X 640 dimensions </div>
                </div>
              </div>
                  @endif
              
          
            </div>
            @endforeach
            @endif
            <br>
            <div class="form-group">
              <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                {!! Form::submit('Save',['class'=>'btn btn btn-primary','value'=>'true'])!!}
              </div>
            </div>
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
    </div>
    <!-- END Main Content -->
    <script type="text/javascript">
       $(document).on("change", ".news-image", function()
    {            
        var file=this.files;
        traverseLogo(this.files);
    });   
    
    function traverseLogo (files) 
    {

      if (typeof files !== "undefined") 
      {
        for (var i=0, l=files.length; i<l; i++) 
        {
              var blnValid = false;
              var ext = files[0]['name'].substring(files[0]['name'].lastIndexOf('.') + 1);
              if(ext == "gif" || ext == "GIF" || ext == "JPEG" || ext == "jpeg" || ext == "jpg" || ext == "JPG" || ext == "png" || ext == "PNG")
              {
                          blnValid = true;
              }
              
              if(blnValid ==false) 
              {
                  swal("Sorry, " + files[0]['name'] + " is invalid, allowed extensions are: gif , jpeg , jpg , png");
                  $(".fileupload-preview").html("");
                  $(".fileupload").attr('class',"fileupload fileupload-new");
                  $("#image").val();
                  return false;
              }
              else
              {              
                
                    var reader = new FileReader();
                    reader.readAsDataURL(files[0]);
                    reader.onload = function (e) 
                    {
                            var image = new Image();
                            image.src = e.target.result;
                               
                            image.onload = function () 
                            {
                                var height = this.height;
                                var width = this.width;
                                if (height !=640 || width !=1920) 
                                {
                                    swal("Height and Width must be equal to  1920 X 640 .");
                                    $(".fileupload-preview").html("");
                                    $(".fileupload").attr('class',"fileupload fileupload-new");
                                    $("#image").val();
                                    return false;


                               
                                }
                                else
                                {
                                   swal("Uploaded image has valid Height and Width.");
                                   return true;
                                }

                               
                            };
         
                    }
                  
              }                
         
          }
        
      }
      else
      {
        swal("No support for the File API in this web browser");
      } 
    }
    </script>
    @endsection                    
