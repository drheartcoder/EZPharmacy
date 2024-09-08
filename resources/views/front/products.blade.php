<style>.header{background: #fff;background:rgba(255,255,255,1); box-shadow: 0 0 2px rgba(0, 0, 0, 0.24);position: relative;}
    .min-menu li.dash-show{display: block;float: right;}
/*    .min-menu li{display: none;}.min-menu li.lang, .min-menu li.call-no-block, .min-menu li.dash-show{display: inline-block;}#dd .dropdown li{display: block;}*/
</style>
<div class="banner-block-inner">
   <div class="about-overlay"></div>
   <div class="container main-content-head">
      <div class="row">
         <div class="col-sm-6 col-md-6 col-lg-6">
            <div class="page-head-block">
               <?php echo $resDocumentType[0]->documentType; ?><?php echo (preg_replace('#<[^>]+>#',' ',translation('our_products')));?>
            </div>
         </div>
         <div class="col-sm-6 col-md-6 col-lg-6">
            <div class="bread-cum-block">
               <ul>
                  <li><a href="{{url('')}}"><?php echo (preg_replace('#<[^>]+>#',' ',translation('home')));?></a></li>
                  <li><?php echo (preg_replace('#<[^>]+>#',' ',translation('our_products')));?></li>
               </ul>
            </div>
         </div>
      </div>
   </div>
</div>

<div class="middel-container">
   <div class="main-cate-container">
      <div class="container">
         <div class="categories-main-block">
            <div class="categories-head-block wow fadeInDown" data-wow-delay="0.5s">
               <div class="head-cate-block">
                  <?php echo (preg_replace('#<[^>]+>#',' ',translation('our_products')));?>
               </div>
            </div>
            <div class="section-catego-block">
                @if(isset($document_type) && sizeof($document_type)>0)
                  @foreach($document_type as $data)
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
                           <a href="{{url('').'/product/'.$data->id.'/'.$string}}" style="cursor: pointer;">
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
         </div>
      </div>
   </div>

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