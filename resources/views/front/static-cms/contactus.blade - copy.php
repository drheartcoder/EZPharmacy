<style>.header{background: #fff;background:rgba(255,255,255,1); box-shadow: 0 0 2px rgba(0, 0, 0, 0.24); position: relative;}
    .min-menu li.dash-show{display: block;float: right;}
/* .min-menu li{display: none;}.min-menu li.lang, .min-menu li.call-no-block, .min-menu li.dash-show{display: inline-block;}#dd .dropdown li{display: block;} */
</style>
<div class="banner-block-inner">
   <div class="about-overlay"></div>
   <div class="container main-content-head">
      <div class="row">
         <div class="col-sm-6 col-md-6 col-lg-6">
            <div class="page-head-block">
               <?php echo (preg_replace('#<[^>]+>#',' ',translation('contact_us')));?>
            </div>
         </div>
         <div class="col-sm-6 col-md-6 col-lg-6">
            <div class="bread-cum-block">
               <ul>
                  <li><a href="{{url('/')}}"><?php echo (preg_replace('#<[^>]+>#',' ',translation('home')));?></a></li>
                  <li><?php echo (preg_replace('#<[^>]+>#',' ',translation('contact_us')));?></li>
               </ul>
            </div>
         </div>
      </div>
   </div>
</div>

<div class="container" ng-controller="CMSCtrl" ng-init="module_url = '{{url('/')}}/store_contact_enquiry'">
   <div class="row">
      <form name="contactUsForm" 
            ng-submit="contactUsForm.$valid && storeContactEnquiry()"
            novalidate
            >

         <div class="col-sm-6 col-md-6 col-lg-7">

            <div id="status_msg"></div>

            <div class="send-mess-head">
               <?php echo (preg_replace('#<[^>]+>#',' ',translation('send_us_a_message')));?>
            </div>

            <div class="row">
               <div class="col-sm-12 col-md-6 col-lg-6">
                  <div class="filed-lable">
                     <?php echo (preg_replace('#<[^>]+>#',' ',translation('first_name')));?>
                  </div>
                  <div class="input-box-block" ng-class="{ 'has-error': contactUsForm.first_name.$touched && contactUsForm.first_name.$invalid }">
                     <input type="text" name="first_name" placeholder="<?php echo (preg_replace('#<[^>]+>#',' ',translation('enter_your_first_name')));?>"
                            ng-model="enquiry.first_name" 
                            ng-maxlength="100"
                            ng-required="true"/>
                     <div class="ng-cloak" ng-messages="contactUsForm.first_name.$error" ng-if="contactUsForm.$submitted || contactUsForm.first_name.$touched">
                        @include('front.includes.message',['maxlength' => 100])
                     </div>
                  </div>
               </div>
               <div class="col-sm-12 col-md-6 col-lg-6">
                  <div class="filed-lable">
                 <?php echo (preg_replace('#<[^>]+>#',' ',translation('last_name')));?>                 
                  </div>
                  <div class="input-box-block" ng-class="{ 'has-error': contactUsForm.last_name.$touched && contactUsForm.last_name.$invalid }">
                     <input type="text" name="last_name" placeholder="<?php echo (preg_replace('#<[^>]+>#',' ',translation('enter_your_last_name')));?>" 
                            ng-model="enquiry.last_name" 
                            ng-maxlength="100" 
                            ng-required="true" />
                     <div class="ng-cloak" ng-messages="contactUsForm.last_name.$error" ng-if="contactUsForm.$submitted || contactUsForm.last_name.$touched">
                        @include('front.includes.message',['maxlength' => 100]) 
                     </div>
                  </div>
               </div>
               <div class="col-sm-12 col-md-6 col-lg-6">
                  <div class="filed-lable">
                     <?php echo (preg_replace('#<[^>]+>#',' ',translation('email_address')));?>
                  </div>
                  <div class="input-box-block" ng-class="{ 'has-error': contactUsForm.email.$touched && contactUsForm.email.$invalid }">
                     <input type="email" name="email" placeholder="<?php echo (preg_replace('#<[^>]+>#',' ',translation('enter_your_email_address')));?>" 
                            ng-model="enquiry.email"
                            ng-required="true" />
                     <div class="ng-cloak" ng-messages="contactUsForm.email.$error" ng-if="contactUsForm.$submitted || contactUsForm.email.$touched">
                        @include('front.includes.message') 
                     </div>
                  </div>
               </div>
               <div class="col-sm-12 col-md-6 col-lg-6">
                  <div class="filed-lable">
                     <?php echo (preg_replace('#<[^>]+>#',' ',translation('phone_number')));?>
                  </div>
                  <div class="input-box-block" ng-class="{ 'has-error': contactUsForm.phone.$touched && contactUsForm.phone.$invalid }">
                     <input type="text" name="phone" placeholder="<?php echo (preg_replace('#<[^>]+>#',' ',translation('enter_your_phone_number')));?>"
                            ng-model="enquiry.phone"
                            numbers-only
                            ng-pattern="/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/" 
                            ng-minlength="6"
                            ng-maxlength="16"
                            ng-required="true" />
                            <?php 
                            $invalid_number= translation("must_be_a_valid_phone_number");
                            ?>
                     <div class="ng-cloak" ng-messages="contactUsForm.phone.$error" ng-if="contactUsForm.$submitted || contactUsForm.phone.$touched">
                        @include('front.includes.message',['maxlength' => 6 , 'minlength' => 10 ,'pattern' => "$invalid_number"])
                     </div>
                  </div>
               </div>
               <div class="col-sm-12 col-md-12 col-lg-12">
                  <div class="filed-lable">
                     <?php echo (preg_replace('#<[^>]+>#',' ',translation('message')));?>
                  </div>
                  <div class="input-box-block" ng-class="{ 'has-error': contactUsForm.message.$touched && contactUsForm.message.$invalid }">
                     <textarea rows="10" cols="" name="message" placeholder="<?php echo (preg_replace('#<[^>]+>#',' ',translation('enter_your_message')));?>" 
                                 ng-model="enquiry.message" 
                                 ng-maxlength="1000"
                                 ng-required="true"
                                 ></textarea>
                     <div class="ng-cloak"  ng-messages="contactUsForm.message.$error" ng-if="contactUsForm.$submitted || contactUsForm.message.$touched">
                        @include('front.includes.message',['maxlength' => 1000 ]) 
                     </div>
                  </div>
               </div>
               <div class="col-sm-12 col-md-12 col-lg-12">
                  <div class="send-msg-mess-btn">
                     <button class="send-btn-contact-us" type="submit"><?php echo (preg_replace('#<[^>]+>#',' ',translation('send_message')));?></button>
                  </div>
               </div>
            </div>
         </div>
      </form>
      <div class="col-sm-6 col-md-6 col-lg-5">
         <div class="contact-info-block">
            <div class="overlay-blue"></div>
            <div class="info-main">
               
               <div class="contact-info-head">
                 <?php echo (preg_replace('#<[^>]+>#',' ',translation('contact_info')));?> 
               </div>
               
               <div class="info-block-container">
                  <span class="img-contact-block"><img src="{{url('front-assets')}}/images/contact-message-img.png" alt="" /> </span><span>{{$arr_site_settings['site_email_address'] or '-'}}</span>
               </div>
               <div class="info-block-container">
                  <span class="call-img-block"><img src="{{url('front-assets')}}/images/contact-call-img.png" alt="" /> </span><span>{{$arr_site_settings['site_contact_number'] or '-'}}</span>
               </div>
               <div class="info-block-container">
                  <span class="img-contact-block"><img src="{{url('front-assets')}}/images/contact-map-img.png" alt="" /> </span>
                  <span>{{$arr_site_settings['site_address'] or '-'}}</span>
                  <div class="clr"></div>
               </div>
               <div class="social-icon-block">
                  <ul>
                     <li><a target="blank" href="{{$arr_site_settings['fb_url'] or 'https://www.facebook.com'}}"> <i class="fa fa-facebook"></i> </a></li>
                     <li><a target="blank" href="{{$arr_site_settings['twitter_url'] or 'https://twitter.com'}}"><i class="fa fa-twitter"></i></a></li>
                     <li><a target="blank" href="{{$arr_site_settings['linked_in_url'] or 'https://www.linkedin.com'}}"><i class="fa fa-linkedin"></i></a></li>
                     <li><a target="blank" href="{{$arr_site_settings['instagram_url'] or 'https://www.instagram.com'}}"><i class="fa fa-instagram"></i></a></li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
      <div class="col-sm-12 col-md-12 col-lg-12">
         <div class="map-block">
            {{-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7010.673388385852!2d77.22197766923573!3d28.529597894093683!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390ce1f0adb989f9%3A0xd7b634f1086a782c!2sDistrict+Court+Saket!5e0!3m2!1sen!2sin!4v1485424825713" width="100%" height="400" frameborder="0" style="border:0"></iframe> --}}
            <iframe src="https://maps.google.it/maps?q=<?php echo $arr_site_settings['site_address']; ?>&output=embed" width="100%" height="400" frameborder="0" style="border:0"></iframe>
         </div>
      </div>
      <div class="clr"></div>
   </div>
</div>