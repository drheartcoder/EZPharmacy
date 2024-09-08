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
          <i class="fa fa-sitemap"></i>
          <a href="{{ $module_url_path }}">{{ $module_title or ''}}</a>
        </span> 
        <span class="divider">
          <i class="fa fa-angle-right"></i>
          <i class="fa fa-edit"></i>
        </span>
        <li class="active">{{ $page_title or ''}}</li>
      </ul>
    </div>
    <!-- END Breadcrumb -->


    <!-- BEGIN Main Content -->
    <div class="row">
      <div class="col-md-12">

        <div class="box ">
          <div class="box-title">
            <h3>
              <i class="fa fa-edit"></i>
              {{ isset($page_title)?$page_title:"" }}
            </h3>
            <div class="box-tool">
              <a data-action="collapse" href="#"></a>
              <a data-action="close" href="#"></a>
            </div>
          </div>
          <div class="box-content">

            @include('admin.layout._operation_status') 

            <div class="tabbable">

              {!! Form::open([ 'url' => $module_url_path.'/update/'.$enc_id,
               'method'=>'POST',
               'enctype' =>'multipart/form-data',   
               'class'=>'form-horizontal', 
               'id'=>'validation-form' 
               ]) !!} 

               <ul  class="nav nav-tabs">
                @include('admin.layout._multi_lang_tab')
              </ul>                                
              <div id="myTabContent1" class="tab-content">

                <input name="image" type="file" class="hidden tinymce_upload" onchange="">
              
                @if(isset($arr_lang) && sizeof($arr_lang)>0)
                @foreach($arr_lang as $key => $lang)
                 <?php 
                      /* Locale Variable */  
                      $locale_text1 = "";
                      $locale_text2 = "";
                      $locale_text3 = "";
                      
                      

                      if(isset($arr_slider['translations'][$lang['locale']]))
                      {
                          $locale_text1 = $arr_slider['translations'][$lang['locale']]['text1'];
                          $locale_text2 = $arr_slider['translations'][$lang['locale']]['text2'];
                          $locale_text3 = $arr_slider['translations'][$lang['locale']]['text3'];
                          
                       }
                  ?>

                

                <div class="tab-pane fade {{ $lang['locale']=='en'?'in active':'' }}"
                id="{{ $lang['locale'] }}">

                <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label" for="page_title">Text 1
                       @if($lang['locale'] == 'en') 
                          <i class="red">*</i>
                       @endif
                  </label>
                  <div class="col-sm-6 col-lg-4 controls">

                    @if($lang['locale'] == 'en') 
                           
                        {!! Form::textarea('text1_'.$lang['locale'],$locale_text1,['class'=>'form-control','data-rule-required'=>'true','data-rule-maxlength'=>'80','placeholder'=>'Enter Text 1']) !!}
                    @else
                        {!! Form::textarea('text1_'.$lang['locale'],$locale_text1,['class'=>'form-control','placeholder'=>'Enter Text 1','data-rule-maxlength'=>'80']) !!}
                    @endif    


                    <span class='help-block'>{{ $errors->first('text1_en') }}</span>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label" for="meta_keyword">Text 2
                       @if($lang['locale'] == 'en') 
                          <i class="red">*</i>
                       @endif
                  </label>
                  
                  <div class="col-sm-6 col-lg-4 controls">
                    

                    @if($lang['locale'] == 'en')        
                        {!! Form::textarea('text2_'.$lang['locale'],$locale_text2,['class'=>'form-control','data-rule-required'=>'true','data-rule-maxlength'=>'77','placeholder'=>'Enter Text 2']) !!}
                    @else
                        {!! Form::textarea('text2_'.$lang['locale'],$locale_text2,['class'=>'form-control','placeholder'=>'Enter Text 2','data-rule-maxlength'=>'77']) !!}
                    @endif  
                    <span class='help-block'>{{ $errors->first('text2_en') }}</span>
                  </div>
                </div>


                <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label" for="meta_keyword">Text 3
                       @if($lang['locale'] == 'en') 
                          <i class="red">*</i>
                       @endif
                  </label>
                  <div class="col-sm-6 col-lg-4 controls">
                    

                    @if($lang['locale'] == 'en')        
                        {!! Form::textarea('text3_'.$lang['locale'],$locale_text3,['class'=>'form-control','data-rule-required'=>'true','data-rule-maxlength'=>'254','placeholder'=>'Enter Text 3']) !!}
                    @else
                        {!! Form::textarea('text3_'.$lang['locale'],$locale_text3,['class'=>'form-control','placeholder'=>'Enter Text 3','data-rule-maxlength'=>'254']) !!}
                    @endif  
                    <span class='help-block'>{{ $errors->first('text3_en') }}</span>
                  </div>
                </div>


               <div class="form-group">
                    <label class="col-sm-3 col-lg-2 control-label"> Image <i style="color:red;">*</i> </label>
                    <div class="col-sm-9 col-lg-10 controls">
                       <div class="fileupload fileupload-new" data-provides="fileupload">

                     {{--   @foreach($arr_slider['translations'] as $key=>$value) --}}    
                       @if(isset($arr_slider['translations']['en']['locale']) && $arr_slider['translations']['en']['locale'] == $lang['locale'])

                         <div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">
                            <img src={{ $front_slider_public_img_path.'/'.$arr_slider['image']}} alt="" />

                    
                        </div>
                          <div class="fileupload-preview fileupload-exists img-thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;">

                               <img src={{ $front_slider_public_img_path.$arr_slider['image']}} alt="" />  
                          </div>
                        @else
                         <?php 
                          $new_image = isset($arr_slider['translations'][$lang['locale']]['image']) ? $arr_slider['translations'][$lang['locale']]['image'] : '';
                         ?>
                        <div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">

                            <img src={{ $front_slider_public_img_path.'/'.$new_image}} alt="" />  
                        </div>
                          <div class="fileupload-preview fileupload-exists img-thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;">
                               <img src={{ $front_slider_public_img_path.$new_image}} alt="" />  
                          </div>
                           @endif 
                         {{--  @endforeach --}}
                          <div>
                             <span class="btn btn-default btn-file"><span class="fileupload-new" >Select image</span> 
                             <span class="fileupload-exists">Change</span>
                             
                              @if($lang['locale'] == 'en')  

                                  {!! Form::file('image_'.$lang['locale'],['id'=>'image'.$lang['locale'],'class'=>'file-input news-image','data-rule-required'=>'']) !!}
                              @else
                                  {!! Form::file('image_'.$lang['locale'],['id'=>'image'.$lang['locale'],'class'=>'file-input news-image','data-rule-required'=>'']) !!}
                              @endif


                             </span> 
                             <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                             <span>
                             </span> 
                          </div>
                       </div>
                        <span class='help-block'>{{ $errors->first('image') }}</span>  
                              <div style="color:red;">Note: Please upload an image in jpg,jpeg,png format  & <br/>
                  For best quality picture please upload image having 1920 X 640 dimensions </div>
                    </div>
                </div>
               
            
              </div>
              @endforeach
              @endif
            </div><br>
            <div class="form-group">
              <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                {!! Form::submit('Update',['class'=>'btn btn btn-primary','value'=>'true'])!!}
              </div>
            </div>
            {!! Form::close() !!}
          </div>

        </div>
      </div>
    </div>
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

  <!-- END Main Content -->



  @stop
