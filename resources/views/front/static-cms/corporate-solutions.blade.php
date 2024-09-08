<style>.header{background: #fff;background:rgba(255,255,255,1); box-shadow: 0 0 2px rgba(0, 0, 0, 0.24);position: relative;}
    .min-menu li.dash-show{display: block;float: right;}
    .how-it-work-main::before{background: none;}
/*    .min-menu li{display: none;}.min-menu li.lang, .min-menu li.call-no-block, .min-menu li.dash-show{display: inline-block;}#dd .dropdown li{display: block;}*/
</style>
<div class="banner-block-inner">
   <div class="about-overlay"></div>
   <div class="container main-content-head">
      <div class="row">
         <div class="col-sm-6 col-md-6 col-lg-6">
            <div class="page-head-block">
               <?php echo (preg_replace('#<[^>]+>#',' ',translation('corporate_solutions')));?>
            </div>
         </div>
         <div class="col-sm-6 col-md-6 col-lg-6">
            <div class="bread-cum-block">
               <ul>
                  <li><a href="{{url('')}}"><?php echo (preg_replace('#<[^>]+>#',' ',translation('enter_your_phone_number')));?><?php echo translation('home');?></a></li>
                  <li><?php echo (preg_replace('#<[^>]+>#',' ',translation('corporate_solutions')));?></li>
               </ul>
            </div>
         </div>
      </div>
   </div>
</div>

<div class="container">
   <div class="row">
      <div class="about-us-content">
      
         <div class="content-content-block">
            <?php echo (preg_replace('#<[^>]+>#',' ',translation('corporate_solutions_brief_description')));?>
         </div>
      </div>
      <div class="how-it-work-main" style="background: none;margin-bottom: 35px;">
         <div class="col-sm-6 col-md-6 col-lg-6 mission-block">
            <div class="how-it-block-img">
               <div class="inner-img-block">
                  <img class="img-content-how" src="{{url('front-assets')}}/images/how-it-works-content-img.png" alt="" />
               </div>
            </div>
         </div>
         <div class="col-sm-6 col-md-6 col-lg-6">
            <div class="our-vision-head" style="font-size: 25px;">
               <?php echo (preg_replace('#<[^>]+>#',' ',translation('corporate_solutions_section1_title')));?>
            </div>
            <div class="our-vision-content">
               <?php echo (preg_replace('#<[^>]+>#',' ',translation('corporate_solutions_section1_description')));?>
            </div>
         </div>
         <div class="clr"></div>
      </div>
      <!-- <div class="img-arrow-how-it">&nbsp;</div> -->
      <div class="how-it-work-main" style="background: none;">
         <div class="col-sm-6 col-md-6 col-lg-6">
            <div class="how-it-block-img howitblock-arrow">
               <div class="inner-img-block">
                  <img class="img-content-how" src="{{url('front-assets')}}/images/how-it-works-content-img2.png" alt="" />
               </div>
            </div>
         </div>
         <div class="col-sm-6 col-md-6 col-lg-6">
            <div class="our-vision-head" style="font-size: 25px;">
               <?php echo (preg_replace('#<[^>]+>#',' ',translation('corporate_solutions_section2_title')));?>
            </div>
            <div class="our-vision-content"><?php echo translation('corporate_solutions_section2_description');?>
               
            </div>
         </div>
         <div class="clr"></div>
      </div>
      <div class="btn-block-print">
         <?php echo (preg_replace('#<[^>]+>#',' ',translation('feel_free_to_contact_us_on')));?>
      </div>
   </div>
</div>