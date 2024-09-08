<style type="text/css">
  .error-text-color{color: #F00 !important;}
.error-text-color::-webkit-input-placeholder {
color: red !important;
}
.error-text-color:-moz-placeholder { /* Firefox 18- */
color: red !important;  
}
.error-text-color::-moz-placeholder {  /* Firefox 19+ */
color: red !important;  
}

.error-text-color:-ms-input-placeholder {  
color: red !important;  
}
.documentLoader {
    display:    none;
    position:   absolute;
    z-index:    1000;
    top:        0;
    left:       0;
    height:     100%;
    width:      100%;
    background: rgba( 255, 255, 255, .8 ) 
                url('{{url('')}}/front-assets/images/trans-loader.gif') 
                50% 50% 
                no-repeat;
}

</style>
<div class="blank-div-menu"></div>
<div class="banner-main-block">
   <div id="carousel-example-generic" class="carousel slide homepage-slider" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
      @if(isset($arr_front_slider) && sizeof($arr_front_slider)>0)  
         @foreach($arr_front_slider as $key =>$data)
         <li data-target="#carousel-example-generic" data-slide-to="{{$key}}" class="@if($key=='0') active @endif"></li>
         @endforeach
      @endif
        {{--  <li data-target="#carousel-example-generic" data-slide-to="1"></li>
         <li data-target="#carousel-example-generic" data-slide-to="2"></li> --}}
      </ol>
      <!-- Wrapper for slides -->

     @if(isset($arr_front_slider) && sizeof($arr_front_slider)>0)     
     
      <div class="carousel-inner">
      @foreach($arr_front_slider as $key =>$data)

         <div class="item @if($key=='0') active @endif">

          @if($data['image']!='')
                 @if(file_exists(base_path('').'/uploads/front_slider/'.$data['image']))
                    <img class="img-s" src="{{ url('').'/uploads/front_slider/'.$data['image'] }}" alt="Slider Image">
                 @else
                     <img src="{{url('')}}/uploads/default.png" alt="{{$data['image']}}">
                    
                 @endif   
          @endif
           
             <div class="banner-content">
               <div class="container">
                  <div class="banner-head-block wow flipInX" data-wow-delay="0.1s">
                     {{ isset($data['text1'])?$data['text1']:''}}
                  </div>
                  <div class="banner-semihead wow flipInX" data-wow-delay="0.3s">
                      {{ isset($data['text2'])?$data['text2']:''}}
                  </div>
                  <div class="banner-content-txt wow flipInX" data-wow-delay="0.5s">
                     {{ isset($data['text3'])?$data['text3']:''}}
                  </div>
                
               </div>
            </div>

         </div>
       @endforeach
      </div>
      @endif
   </div>

</div>

<div class="clearfix"></div>
<div class="middel-container">
<div class="container">
    <div class="main-howitworks">
       <div class="categories-head-block wow fadeInDown" data-wow-delay="0.5s">
          <div class="browes-cate-block">
             <?php echo (preg_replace('#<[^>]+>#',' ',translation('how_it_works')));?>
          </div>
          <div class="head-cate-block">
            <?php echo (preg_replace('#<[^>]+>#',' ',translation('get_the_job_done_right')));?>
          </div>
       </div>
       <div class="steps-mian-block">
          <div class="col-sm-3 col-md-3 col-lg-3">
             <div class="section-round-main">
                <div class="icon-round-block wow rotateIn" data-wow-delay="0.5s">
                   <img src="{{url('front-assets')}}/images/post-project-icon.png" class="wow zoomIn" data-wow-delay="0.6s" alt="" />
                   <img src="{{url('front-assets')}}/images/post-project-icon.png" class="wow zoomIn" data-wow-delay="0.6s" alt="" />
                </div>
                <div class="head-block-work wow fadeInDown" data-wow-delay="0.7s">
                    <?php echo (preg_replace('#<[^>]+>#',' ',translation('how_it_works_section1_title')));?>
                </div>
                <div class="works-content-blcok wow fadeInDown" data-wow-delay="0.7s">
                   <?php echo (preg_replace('#<[^>]+>#',' ',translation('home_how_it_works_desc_1')));?>
                </div>
                <img class="diver-img-block wow fadeInLeft" data-wow-delay="0.8s" src="{{url('front-assets')}}/images/diver-img.png" alt="" />
             </div>
          </div>
          <div class="col-sm-3 col-md-3 col-lg-3">
             <div class="section-round-main">
                <div class="icon-round-block wow rotateIn" data-wow-delay="0.5s">
                   <img src="{{url('front-assets')}}/images/expert.png" class="wow zoomIn" data-wow-delay="0.6s" alt="" />
                </div>
                <div class="head-block-work wow fadeInDown" data-wow-delay="0.7s">
                     <?php echo (preg_replace('#<[^>]+>#',' ',translation('how_it_works_section2_title')));?>
                </div>
                <div class="works-content-blcok wow fadeInDown" data-wow-delay="0.8s">
                    <?php echo (preg_replace('#<[^>]+>#',' ',translation('home_how_it_works_desc_2')));?>
                </div>
                <img class="diver-img-block wow fadeInLeft" data-wow-delay="0.8s" src="{{url('front-assets')}}/images/diver-img.png" alt="" />
             </div>
          </div>
          <div class="col-sm-3 col-md-3 col-lg-3">
             <div class="section-round-main">
                <div class="icon-round-block wow rotateIn" data-wow-delay="0.5s">
                   <img src="{{url('front-assets')}}/images/work-on-project.png" class="wow zoomIn" data-wow-delay="0.6s" alt="" />
                </div>
                <div class="head-block-work wow fadeInDown" data-wow-delay="0.7s">
                     <?php echo (preg_replace('#<[^>]+>#',' ',translation('how_it_works_section3_title')));?>
                   
                </div>
                <div class="works-content-blcok wow fadeInDown" data-wow-delay="0.8s">
                   <?php echo (preg_replace('#<[^>]+>#',' ',translation('home_how_it_works_desc_3')));?>
                </div>
                <img class="diver-img-block wow fadeInLeft" data-wow-delay="0.8s" src="{{url('front-assets')}}/images/diver-img.png" alt="" />
             </div>
          </div>
          <div class="col-sm-3 col-md-3 col-lg-3">
             <div class="section-round-main">
                <div class="icon-round-block wow rotateIn" data-wow-delay="0.5s">
                   <img src="{{url('front-assets')}}/images/Satisfied.png" class="wow zoomIn" data-wow-delay="0.6s" alt="" />
                </div>
                <div class="head-block-work wow fadeInDown" data-wow-delay="0.7s">
                    <?php echo (preg_replace('#<[^>]+>#',' ',translation('how_it_works_section4_title')));?>
                 </div>
                <div class="works-content-blcok wow fadeInDown" data-wow-delay="0.8s">
                 <?php echo (preg_replace('#<[^>]+>#',' ',translation('home_how_it_works_desc_4')));?>
                </div>
             </div>
          </div>
       </div>
    </div>
    <div class="clr"></div>
</div>
<div class="main-testi-block" >
    <div class="main-how-it-video">
      <embed src="https://www.youtube.com/embed/ym06S7kYnFA?ecver=2" allowfullscreen="true" style="height: 500px;width: 100%;">
      <div class="clr"></div>
    </div>
</div>
   <div class="main-cate-container">
      <div class="container">
         <div class="categories-main-block">
            <div class="categories-head-block wow fadeInDown" data-wow-delay="0.5s">
               <div class="head-cate-block">
                  <?php echo (preg_replace('#<[^>]+>#',' ',translation('our_products')));?>
               </div>
            </div>
            <div class="section-catego-block">
            @if(isset($multipleArray['document_type']) && sizeof($multipleArray['document_type'])>0)
              @foreach($multipleArray['document_type'] as $data)
              <?php
                /*$string = '';
                if(!empty($data->type_name))
                {
                  $replace = '-';
                  $string = strtolower($data->type_name);
                  $string = preg_replace("/[\/\.]/", " ", $string);
                  $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
                  $string = preg_replace("/[\s-]+/", " ", $string);
                  $string = preg_replace("/[\s_]/", $replace, $string);
                  $string = substr($string, 0, 100);
                  $string = $string.'.html';
                }*/
                  $string = urlencode($data->type_name).'.html';
              ?>
               <div class="col-sm-4 col-md-3 col-lg-3">
                  <div class="main-block-cate {{--grid--}}">
                     <a href="{{url('').'/product/'.$data->id.'/'.$string}}">
                     <span class="effect-oscar">
                          @if($data->image!='')
                                @if(file_exists(base_path('').'/uploads/document_type/'.$data->image))
                                   <img class="img-s" src="{{ url('').'/uploads/document_type/thumb_255X179_'.$data->image }}" alt="Product Image">
                                @else
                                    <img src="{{url('')}}/uploads/default.png" style="width:270px !important;height:179px !important;" alt="{{$data->image or ''}}">
                                   
                                @endif   
                         @else
                             <img src="{{url('')}}/uploads/default.png" style="width:270px !important;height:179px !important;" />
                         @endif 

                   {{--   <span class="over-txt-block">                             
                       <span class="view-txt-more"> {{ $data->type_name or '' }}</span>
                     </span> --}}
                     </span>
                     <span class="cate-block-main-txt">
                     {{ $data->type_name  or ''}}
                     </span>
                     </a>
                  </div>
               </div>
               @endforeach
               @endif
              
               <div class="clr"></div>
            </div>
           {{--  <div class="btn-block-all wow fadeInDown" data-wow-delay="0.1s">
               <a href="#" class="btn-view-all">View All Services</a>
            </div> --}}
         </div>
      </div>
   </div>
   
   <div class="main-tab-block wow fadeInLeft">
   <!-- <div style="position: absolute; width: 100%; height: 100%; top: 0px; left: 0px; background: rgb(204, 204, 204);">Loading...</div> -->
   <div class="documentLoader"></div>
      <div class="container">
         <div class="quality-bg-block">
            <div class="col-sm-3 col-md-3 col-lg-3 padd-none">
               <div class="no-of-page-block res-no-page">
                  <div class="no-of-page-txt"> <?php echo (preg_replace('#<[^>]+>#',' ',translation('home_document_type')));?> <!-- <span><i class="fa fa-info-circle"></i></span> -->
                  </div>
                  <div class="select-bock-container">
                     <select id="optDocumentType" name="optDocumentType">
                      <option value="" selected="selected" disabled="disabled"> <?php echo (preg_replace('#<[^>]+>#',' ',translation('our_products')));?><?php echo (preg_replace('#<[^>]+>#',' ',translation('select')));?></option>
                      @if(count($resDocumentType))
                        @foreach($resDocumentType as $row)
                          <option value="{{$row->primaryKey}}">{{$row->documentType}}</option>
                        @endforeach
                      @endif
                     </select>
                  </div>
               </div>
            </div>
            <div class="col-sm-3 col-md-3 col-lg-3 padd-none">
               <div class="no-of-page-block res-no-page">
                  <div class="no-of-page-txt"><?php echo (preg_replace('#<[^>]+>#',' ',translation('home_paper_size')));?><!-- <span><i class="fa fa-info-circle"></i></span> -->
                  </div>
                  <div class="select-bock-container">
                     <select id="optPaperSize" name="optPaperSize" class="clsPaperOptions" data-select-opt="size">
                       <option value="" selected="selected" disabled="disabled"><?php echo (preg_replace('#<[^>]+>#',' ',translation('select')));?></option>
                     </select>
                  </div>
               </div>
            </div>

            <div class="col-sm-3 col-md-3 col-lg-3 padd-none">
               <div class="no-of-page-block res-no-page">
                  <div class="no-of-page-txt"><?php echo (preg_replace('#<[^>]+>#',' ',translation('home_paper_type')));?><!-- <span><i class="fa fa-info-circle"></i></span> -->
                  </div>
                  <div class="select-bock-container">
                     <select id="optPaperType" name="optPaperType" class="clsPaperOptions" data-select-opt="type">
                       <option value="" selected="selected" disabled="disabled"><?php echo (preg_replace('#<[^>]+>#',' ',translation('select')));?></option>
                     </select>
                  </div>
               </div>
            </div>

            <div class="col-sm-3 col-md-3 col-lg-3 padd-none">
               <div class="no-of-page-block res-no-page">
                  <div class="no-of-page-txt"><?php echo (preg_replace('#<[^>]+>#',' ',translation('home_paper_weight')));?><!-- <span><i class="fa fa-info-circle"></i></span> -->
                  </div>
                  <div class="select-bock-container">
                     <select id="optPaperWeight" name="optPaperWeight" class="clsPaperOptions" data-select-opt="weight">
                       <option value="" selected="selected" disabled="disabled"><?php echo (preg_replace('#<[^>]+>#',' ',translation('select')));?></option>
                     </select>
                  </div>
               </div>
            </div>


            <div class="col-sm-3 col-md-3 col-lg-3 padd-none">
              <div class="no-of-page-block res-no-page">
                  <div class="no-of-page-txt"><?php echo (preg_replace('#<[^>]+>#',' ',translation('home_color')));?><!-- <span><i class="fa fa-info-circle"></i></span> -->
                  </div>
                  <div class="select-bock-container">
                     <select id="optPaperColor" name="optPaperColor">
                       <option value="" selected="selected" disabled="disabled"><?php echo (preg_replace('#<[^>]+>#',' ',translation('select')));?></option>
                     </select>
                  </div>
               </div>
            </div>

            <div class="col-sm-3 col-md-3 col-lg-3 padd-none">
               <div class="no-of-page-block res-no-page">
                  <div class="no-of-page-txt"><?php echo (preg_replace('#<[^>]+>#',' ',translation('home_side')));?> <!-- <span><i class="fa fa-info-circle"></i></span> -->
                  </div>
                  <div class="select-bock-container">
                     <select id="optPaperSide" name="optPaperSide">
                       <option value="" selected="selected" disabled="disabled"><?php echo (preg_replace('#<[^>]+>#',' ',translation('select')));?></option>
                     </select>
                  </div>
               </div>
            </div>

            <div class="col-sm-3 col-md-3 col-lg-3 padd-none">
               <div class="no-of-page-block res-no-page">
                  <div class="no-of-page-txt"><?php echo (preg_replace('#<[^>]+>#',' ',translation('home_binding_options')));?><!-- <span><i class="fa fa-info-circle"></i></span> -->
                  </div>
                  <div class="select-bock-container">
                     <select id="optBindingOptions" name="optBindingOptions">
                       <option value="" selected="selected" disabled="disabled"><?php echo (preg_replace('#<[^>]+>#',' ',translation('select')));?></option>
                     </select>
                  </div>
               </div>
            </div>

            <div class="col-sm-3 col-md-3 col-lg-3 padd-none">
               <div class="no-of-page-block res-no-page">
                  <div class="no-of-page-txt"><?php echo (preg_replace('#<[^>]+>#',' ',translation('home_folding_options')));?><!-- <span><i class="fa fa-info-circle"></i></span> -->
                  </div>
                  <div class="select-bock-container">
                     <select id="optFoldingOptions" name="optFoldingOptions">
                       <option value="" selected="selected" disabled="disabled"><?php echo (preg_replace('#<[^>]+>#',' ',translation('select')));?></option>
                     </select>
                  </div>
               </div>
            </div>

            <div class="clearfix"></div>

            <div class="col-sm-3 col-md-3 col-lg-3 padd-none">
               <div class="no-of-page-block res-no-page">
                  <div class="no-of-page-txt"><?php echo (preg_replace('#<[^>]+>#',' ',translation('number_of_pages_in_your_document')));?><!-- <span><i class="fa fa-info-circle"></i></span> -->
                  </div>
                  <div class="input-block-num input-bx">
                     <input type="text" id="txtTotalPages" name="txtTotalPages" placeholder="<?php echo (preg_replace('#<[^>]+>#',' ',translation('number_of_pages_in_your_document')));?>" value="100" />
                  </div>
               </div>
            </div>
            <div class="col-sm-3 col-md-3 col-lg-3 padd-none">
               <div class="no-of-page-block res-no-page ext-margin">
                  <div class="no-of-page-txt"><?php echo (preg_replace('#<[^>]+>#',' ',translation('quantity')));?><!-- <span><i class="fa fa-info-circle"></i></span> -->
                  </div>
                  <div class="input-block-num input-bx">
                     <input type="text" name="txtQuantity" placeholder="<?php echo (preg_replace('#<[^>]+>#',' ',translation('quantity')));?>" value="1" />
                  </div>
               </div>
            </div>

            <div class="col-sm-3 col-md-3 col-lg-3 padd-none">
              <input type="hidden" name="txtPaperCost" value="0">
              <input type="hidden" name="txtPrintingCost" value="0">
              <input type="hidden" name="txtBindingCost" value="0">
              <input type="hidden" name="txtFoldingCost" value="0">
              <input type="hidden" name="txtFinalPrice" value="0">
               <div class="no-of-page-block res-no-page ext-margin">
                  <div class="no-of-page-txt"><?php echo (preg_replace('#<[^>]+>#',' ',translation('price')));?><!-- <span><i class="fa fa-info-circle"></i></span> -->
                  </div>
                  <div class="input-block-num input-bx">
                     <input type="text" name="txtTotalCost" placeholder="0.00" readonly="readonly" disabled="disabled" />
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="quality-block-main" style="height: 100%;"></div>
      
   </div>
   <div class="clr"></div>
   @if(isset($arr_testimonials) && count($arr_testimonials) > 0)
   <div class="main-testi-block" >
      <div class="container wow fadeInLeft" data-wow-delay="0.1s">
         <div class="testimonila-block-container">
            <div class="categories-head-block">
               <div class="browes-cate-block">
                   <?php echo (preg_replace('#<[^>]+>#',' ',translation('testimonial')));?>
               </div>
               @if(isset($arr_testimonials) && count($arr_testimonials) > 0)
               <div class="head-cate-block">
                 <?php echo (preg_replace('#<[^>]+>#',' ',translation('kind_words_from_happy_candidates')));?>
               </div>
               @endif
            </div>

            @if(isset($arr_testimonials) && count($arr_testimonials) > 0)

            <div id="carousel-example-generic-one" class="carousel slide">

               <!-- Indicators -->
               <ol class="carousel-indicators">
               @foreach($arr_testimonials as $key =>  $testimonial)
                  <li data-target="#carousel-example-generic-one" data-slide-to="{{$key}}" @if($key == 0) class="active" @endif ></li>
               @endforeach
               </ol>
               <!-- Wrapper for slides -->
               <div class="carousel-inner">

                  @foreach($arr_testimonials as  $key => $testimonial)
                     <div class="item @if($key == 0)active @endif">
                        <div class="carousel-caption">
                           <div class="testi-content-block">
                              <p>{{$testimonial->description or '-'}}</p>
                           </div>
                           <div class="testi-profile-pic">
                              <img src="{{url('/')}}/uploads/testimonial_images/thumb_107X107_{{$testimonial->user_image or ''}}" alt="{{$testimonial->user_image or ''}}" />
                           </div>
                           <div class="name-testi-block">
                              <h3>{{$testimonial->user_name or '-'}}</h3>
                           </div>
                        </div>
                     </div>
                  @endforeach
                  
               </div>
            </div>
            @else
               <h4 style="color: red;" > <center><?php echo (preg_replace('#<[^>]+>#',' ',translation('no_records_found')));?></center> </h4>
            @endif
         </div>
      </div>
   </div>
@else
<div class="main-testi-block" >&nbsp;</div><div class="clr"></div>
@endif

</div>
<!-- cd-section -->