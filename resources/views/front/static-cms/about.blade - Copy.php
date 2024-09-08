<style>.header{background: #fff;background:rgba(255,255,255,1); box-shadow: 0 0 2px rgba(0, 0, 0, 0.24); position: relative;}
    .min-menu li.dash-show{display: block;float: right;}
/*    .min-menu li{display: none;}.min-menu li.lang, .min-menu li.call-no-block, .min-menu li.dash-show{display: inline-block;}#dd .dropdown li{display: block;}*/
</style>
<div class="banner-block-inner">
   <div class="about-overlay"></div>
   <div class="container main-content-head">
      <div class="row">
         <div class="col-sm-6 col-md-6 col-lg-6">
            <div class="page-head-block">
              <?php echo translation('about_us');?>
            </div>
         </div>
         <div class="col-sm-6 col-md-6 col-lg-6">
            <div class="bread-cum-block">
               <ul>
                  <li><a href="{{url('')}}"><?php echo (preg_replace('#<[^>]+>#',' ',translation('home')));?></a></li>
                  <li><?php echo (preg_replace('#<[^>]+>#',' ',translation('about_us')));?></li>
               </ul>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="container">
   <div class="about-us-content">
      <!-- <div class="content-head-block"> -->
         <!--translation('about_top_text') -->
      <!-- </div> -->
      <div class="content-content-block">
         <?php echo (preg_replace('#<[^>]+>#',' ',translation('about_top_description')));?>
      </div>
   </div>
   <div class="our-vision-main">
      <div class="aboutus-block-img">
         <img src="{{url('front-assets')}}/images/our-vision-img.jpg" alt="" />
      </div>
      <div class="content-block-about">
         <div class="our-vision-head">
         <?php echo (preg_replace('#<[^>]+>#',' ',translation('our_vision')));?>
         </div>
         <div class="our-vision-content">
           <?php echo (preg_replace('#<[^>]+>#',' ',translation('our_vision_description')));?>
         </div>
      </div>
      <div class="clr"></div>
   </div>
   <div class="our-vision-main">
      <div class="aboutus-block-img mission-block">
         <img src="{{url('front-assets')}}/images/our-mission-img.jpg" alt="" />
      </div>
      <div class="our-vision-head">
         <?php echo (preg_replace('#<[^>]+>#',' ',translation('our_mission')));?>        
      </div>
      <div class="our-vision-content">
         <?php echo (preg_replace('#<[^>]+>#',' ',translation('our_mission_description')));?>       
      </div>
      <div class="clr"></div>
   </div>
</div>
<div class="main-howitworks why-choose-main">
   <div class="container">
      <div class="head-cate-block">
         <?php echo (preg_replace('#<[^>]+>#',' ',translation('why_choose_printing_manager')));?>
      </div>
      <div class="steps-mian-block">
         <div class="col-sm-6 col-md-3 col-lg-3">
            <div class="section-round-main">
               <div class="why-img-block">
                  <img src="{{url('front-assets')}}/images/why-choose-img-1.png" alt="" />
               </div>
               <div class="head-block-work">
                  <?php echo (preg_replace('#<[^>]+>#',' ',translation('printing_quality')));?>
               </div>
               <div class="works-content-blcok"><?php echo (preg_replace('#<[^>]+>#',' ',translation('printing_quality_text')));?>
                </div>
            </div>
         </div>
         <div class="col-sm-6 col-md-3 col-lg-3">
            <div class="section-round-main">
               <div class="why-img-block">
                  <img src="{{url('front-assets')}}/images/why-choose-img-2.png" alt="" />
               </div>
               <div class="head-block-work">
                  <?php echo (preg_replace('#<[^>]+>#',' ',translation('about_printing_price')));?>
               </div>
               <div class="works-content-blcok">
                 <?php echo (preg_replace('#<[^>]+>#',' ',translation('about_printing_price_text')));?>
               </div>
            </div>
         </div>
         <div class="col-sm-6 col-md-3 col-lg-3">
            <div class="section-round-main">
               <div class="why-img-block">
                  <img src="{{url('front-assets')}}/images/why-choose-img-3.png" alt="" />
               </div>
               <div class="head-block-work">
                 <?php echo (preg_replace('#<[^>]+>#',' ',translation('about_printing_options')));?>
               </div>
               <div class="works-content-blcok">
                  <?php echo (preg_replace('#<[^>]+>#',' ',translation('about_printing_options_text')));?>
               </div>
            </div>
         </div>
         <div class="col-sm-6 col-md-3 col-lg-3">
            <div class="section-round-main">
               <div class="why-img-block">
                  <img src="{{url('front-assets')}}/images/why-choose-img-4.png" alt="" />
               </div>
               <div class="head-block-work">
                  <?php echo (preg_replace('#<[^>]+>#',' ',translation('about_printing_uptime')));?>
               </div>
               <div class="works-content-blcok">
                 <?php echo (preg_replace('#<[^>]+>#',' ',translation('about_printing_uptime_text')));?>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="clr"></div>
</div>

@if(isset($arr_testimonials) && count($arr_testimonials) > 0)
<div class="container">
   <div class="main-testi-block">
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
</div>
@endif