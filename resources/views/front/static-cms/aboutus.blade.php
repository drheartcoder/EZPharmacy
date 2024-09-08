<style>.header{background: #fff;background:rgba(255,255,255,1); box-shadow: 0 0 2px rgba(0, 0, 0, 0.24); position: relative;}
    
    @media (max-width: 991px){
        article, aside, details, figcaption, figure, footer, header, hgroup, main, menu, nav, section, summary{min-height: auto;}
    }
    
    .min-menu li.dash-show{display: block;float: right;}
/*    .min-menu li{display: none;}.min-menu li.lang, .min-menu li.call-no-block, .min-menu li.dash-show{display: inline-block;}#dd .dropdown li{display: block;}*/
</style>
<!-- CONTENT BEGIN -->
<!--  <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700" rel="stylesheet"> -->
 

<!-- ABOUT BEGIN -->
<section class="container about">
 
 <div class="about-txt-centers">
    <h2 class="text-center"><?php echo (preg_replace('#<[^>]+>#',' ',translation('about_us')));?></h2>
    <p><?php echo (preg_replace('#<[^>]+>#',' ',translation('about_top_description')));?></p>
 </div>
 
  <div class="row">
    <div class="col-md-10 col-sm-12 col-xs-12 col-md-offset-1 about-sections">
      <div class="about-sections-block about-sections-block-eye text-center">
        <h3><?php echo (preg_replace('#<[^>]+>#',' ',translation('our_vision')));?></h3>
        <p><?php echo (preg_replace('#<[^>]+>#',' ',translation('our_vision_description')));?></p>
      </div>
      <div class="about-sections-block about-sections-block-dart text-center">
        <h3><?php echo (preg_replace('#<[^>]+>#',' ',translation('our_mission')));?></h3>
        <p><?php echo (preg_replace('#<[^>]+>#',' ',translation('our_mission_description')));?></p>
      </div>
    </div>
    <div class="col-xs-12 text-center">
        @if(!\Session::has('userLogged'))
          <button data-toggle="modal" data-target="#login-modal" class="btn-art"><?php echo (preg_replace('#<[^>]+>#',' ',translation('pmake_an_orderp')));?></button>
        @else
           <a href="{{url('/')}}/user/create-document/" class="btn-art"><?php echo (preg_replace('#<[^>]+>#',' ',translation('pstart_printingp')));?></a>
        @endif
        </div>
  </div>
</section>
<!-- ABOUT EOF -->

<!-- WHY CHOOSE PRINT BEGIN -->
<section class="container-fluid why-print">
  <div class="row">
    <div class="container text-center">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 why-print-title">
          <h2> <?php echo (preg_replace('#<[^>]+>#',' ',translation('why_choose_printing_manager')));?></h2>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <div class="why-print-icon">
            <img src="{{url('front-assets')}}/images/icon_like.png" alt="">
          </div>
          <p><b><?php echo (preg_replace('#<[^>]+>#',' ',translation('printing_quality')));?></b>
          <p class="abt-p-txt">
            <?php echo (preg_replace('#<[^>]+>#',' ',translation('printing_quality_text')));?>
          </p>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <div class="why-print-icon">
            <img src="{{url('front-assets')}}/images/icon_wallet.png" alt="">
          </div>
          <p><b><?php echo (preg_replace('#<[^>]+>#',' ',translation('about_printing_price')));?></b>
          <p class="abt-p-txt">
            <?php echo (preg_replace('#<[^>]+>#',' ',translation('about_printing_price_text')));?>
          </p>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <div class="why-print-icon">
            <img src="{{url('front-assets')}}/images/icon_settings.png" alt="">
          </div>
          <p><b><?php echo (preg_replace('#<[^>]+>#',' ',translation('about_printing_options')));?></b>
          <p class="abt-p-txt">
            <?php echo (preg_replace('#<[^>]+>#',' ',translation('about_printing_options_text')));?>
          </p>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <div class="why-print-icon">
            <img src="{{url('front-assets')}}/images/icon_clock.png" alt="">
          </div>
          <p><b><?php echo (preg_replace('#<[^>]+>#',' ',translation('about_printing_uptime')));?></b>
          <p class="abt-p-txt">
            <?php echo (preg_replace('#<[^>]+>#',' ',translation('about_printing_uptime_text')));?>
          </p>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- WHY CHOOSE PRINT EOF -->

<!-- TESTIMONIALS BEGIN -->
<section class="container-fluid testimonials">
  <div class="row">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <h2 class="text-center"><?php echo (preg_replace('#<[^>]+>#',' ',translation('testimonial')));?></h2>
        </div>
        <!-- TESTIMONIALS SLIDER BEGIN -->
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 slider text-center">
          <!-- SLIDE 1 BEGIN -->
          @if(isset($arr_testimonials) && count($arr_testimonials) > 0)
           @foreach($arr_testimonials as  $key => $testimonial)
              <div class="col-lg-4 col-sm-6 col-xs-12">
                <div class="testimonial-slider-block">
                  <div class="testimonial-img">
                   <div class="about-avatar">
                     <img src="{{url('/')}}/uploads/testimonial_images/thumb_107X107_{{$testimonial->user_image or ''}}" alt="{{$testimonial->user_image or ''}}" />
                    </div>
                  </div>
                  <p>
                  <h4>{{$testimonial->user_name or '-'}}</h4>
                  <p>
                    {{$testimonial->description or '-'}}
                  </p>
                  <div class="testimonial-line"></div>
                </div>
              </div>
            @endforeach
          @endif
        </div>
        <!-- TESTIMONIALS SLIDER BEGIN -->
        <!-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
          <button class="btn-art"><?php echo (preg_replace('#<[^>]+>#',' ',translation('pmake_an_orderp')));?></button>
        </div> -->
        <div class="col-xs-12 text-center">
        @if(!\Session::has('userLogged'))
          <button data-toggle="modal" data-target="#login-modal" class="btn-art"><?php echo (preg_replace('#<[^>]+>#',' ',translation('pmake_an_orderp')));?></button>
        @else
           <a href="{{url('/')}}/user/create-document/" class="btn-art"><?php echo (preg_replace('#<[^>]+>#',' ',translation('pmake_an_orderp')));?></a>
        @endif
        </div>

      </div>
    </div>
  </div>
</section>

<!-- TESTIMONIALS EOF -->
<!-- CONTENT EOF -->
