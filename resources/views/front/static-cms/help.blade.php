<style>.header{background: #fff;background:rgba(255,255,255,1); box-shadow: 0 0 2px rgba(0, 0, 0, 0.24); position: relative;}
    .min-menu li.dash-show{display: block;float: right;}
/*    .min-menu li{display: none;}.min-menu li.lang, .min-menu li.call-no-block, .min-menu li.dash-show{display: inline-block;}#dd .dropdown li{display: block;}*/
</style>

  

  {{-- <script src="{{url('front-assets')}}/js/angular/angular-assets/captcha-directive.js"></script> --}}


<div class="container" ng-controller="CMSCtrl" ng-init="module_url = '{{url('/')}}/store_help'">
   <div class="row">

   <form name="helpPageForm"  
         ng-submit="helpPageForm.$valid && storeHelpEnquiry()" 
         novalidate>
            <div class="col-sm-7 col-md-8 col-lg-8 bor-right-block">

               <div class="send-mess-head help-sami-content">
                  <?php echo (preg_replace('#<[^>]+>#',' ',translation('were_always_here_for_you')));?>
               </div>
               
                  <div class="row">
                   <div class="col-sm-12 col-md-12 col-lg-12">
                     <div id="status_msg"></div>
                     </div>
                     <div class="col-sm-12 col-md-6 col-lg-6">

                      

                        <div class="filed-lable">
                         <?php echo (preg_replace('#<[^>]+>#',' ',translation('first_name')));?>
                        </div>
                        <div class="input-box-block" ng-class="{ 'has-error': helpPageForm.first_name.$touched && helpPageForm.first_name.$invalid }">
                           <input type="text" name="first_name" placeholder="<?php echo (preg_replace('#<[^>]+>#',' ',translation('enter_your_first_name')));?>" 
                                    ng-model="help.first_name" 
                                    ng-maxlength="100" 
                                    ng-required="true" />
                           
                           <div class="ng-cloak" ng-messages="helpPageForm.first_name.$error" ng-if="helpPageForm.$submitted || helpPageForm.first_name.$touched">
                             @include('front.includes.message',['maxlength' => 100])
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="filed-lable">
                       <?php echo (preg_replace('#<[^>]+>#',' ',translation('last_name')));?>
                        </div>
                        <div class="input-box-block" ng-class="{ 'has-error': helpPageForm.last_name.$touched && helpPageForm.last_name.$invalid }">
                           <input type="text" name="last_name" placeholder="<?php echo (preg_replace('#<[^>]+>#',' ',translation('enter_your_last_name')));?>" 
                                     ng-model="help.last_name"
                                     ng-maxlength="100" 
                                     ng-required="true" />

                           <div class="ng-cloak" ng-messages="helpPageForm.last_name.$error" ng-if="helpPageForm.$submitted || helpPageForm.last_name.$touched">
                                 @include('front.includes.message',['maxlength' => 100])
                         
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="filed-lable">
                           <?php echo (preg_replace('#<[^>]+>#',' ',translation('email_address')));?>
                        </div>
                        <div class="input-box-block" ng-class="{ 'has-error': helpPageForm.email.$touched && helpPageForm.email.$invalid }">
                           <input type="email" name="email" placeholder="<?php echo (preg_replace('#<[^>]+>#',' ',translation('enter_your_email_address')));?>" 
                                    ng-model="help.email"
                                    ng-required="true" />
                           <div class="ng-cloak" ng-messages="helpPageForm.email.$error" ng-if="helpPageForm.$submitted || helpPageForm.email.$touched">
                                 @include('front.includes.message')
                         
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="filed-lable">
                         <?php echo (preg_replace('#<[^>]+>#',' ',translation('select_subject')));?>                </div>
                        <div class="input-box-block select-block-new">
                           <select name="subject" id="subject" 
                           ng-model="help.subject"
                           ng-required="true"
                           >
                              <option value="support"><?php echo (preg_replace('#<[^>]+>#',' ',translation('support')));?></option>
                              <option value="sale"><?php echo (preg_replace('#<[^>]+>#',' ',translation('sale')));?></option>
                           </select>
                           <div class="ng-cloak" ng-messages="helpPageForm.subject.$error" ng-if="helpPageForm.$submitted || helpPageForm.subject.$touched">
                                 @include('front.includes.message',[])
                         
                           </div>
                        </div>

                     </div>
                     <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="filed-lable">
                          <?php echo (preg_replace('#<[^>]+>#',' ',translation('company_name')));?>( <?php echo (preg_replace('#<[^>]+>#',' ',translation('optional')));?>) 
                        </div>
                        <div class="input-box-block" ng-class="{ 'has-error': helpPageForm.comp_name.$touched && helpPageForm.comp_name.$invalid }">
                           <input type="text" name="comp_name" placeholder="<?php echo (preg_replace('#<[^>]+>#',' ',translation('enter_your_company_name')));?>" 
                                  ng-model="help.comp_name" 
                                  ng-minlenght="5"
                                  ng-maxlenght="30" 
                                  ng-required="true" />
                           <div class="ng-cloak" ng-messages="helpPageForm.comp_name.$error" ng-if="helpPageForm.$submitted || helpPageForm.comp_name.$touched">
                              @include('front.includes.message',['minlength'=>5,'maxlength' => 50])
                         
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="filed-lable">
                         <?php echo (preg_replace('#<[^>]+>#',' ',translation('phone_number')));?>
                        </div>
                        <div class="input-box-block" ng-class="{ 'has-error': helpPageForm.comp_name.$touched && helpPageForm.phone.$invalid }">
                           <input type="text" name="phone" placeholder="<?php echo (preg_replace('#<[^>]+>#',' ',translation('enter_your_phone_number')));?>"
                                  ng-model="help.phone"
                                  ng-minlenght="10"
                                  ng-maxlenght="16"
                                  ng-required="true"
                                  numbers-only
                                  ng-pattern="/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/" />
                                   <?php 
                            $invalid_number= translation("must_be_a_valid_phone_number");

                            ?>

                           <div class="ng-cloak" ng-messages="helpPageForm.phone.$error" ng-if="helpPageForm.$submitted || helpPageForm.phone.$touched">
                              @include('front.includes.message',['minlength'=>10,'maxlength' => 16,'pattern'=>"$invalid_number"])
                         
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="filed-lable">
                           <?php echo (preg_replace('#<[^>]+>#',' ',translation('ask_question')));?>                        </div>
                        <div class="input-box-block help-textarea" ng-class="{ 'has-error': helpPageForm.message.$touched && helpPageForm.message.$invalid }">
                           <textarea rows="" cols="" name="message" placeholder="<?php echo (preg_replace('#<[^>]+>#',' ',translation('your_question')));?>" 
                                    ng-model="help.message" 
                                    ng-minlenght="5"
                                    ng-maxlenght="30"
                                    ng-required="true">
                              
                           </textarea>
                           <div class="ng-cloak" ng-messages="helpPageForm.message.$error" ng-if="helpPageForm.$submitted || helpPageForm.message.$touched">
                             @include('front.includes.message',['minlength'=>5,'maxlength' => 50])
                         
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-12 col-md-12 col-lg-12" >
                        <div
                            vc-recaptcha
                            theme="'light'"
                            key="model.key"
                            on-create="setWidgetId(widgetId)"
                            on-success="setResponse(response)"
                            on-expire="cbExpiration()"
                          ></div>
                        
                        {{-- <div class="filed-lable">
                           Captcha
                        </div>
                        <div class="input-box-block help-textarea">
                            <img src="{{url('front-assets')}}/images/captcha-img.png" alt="" />
                       
                        </div> --}}
                     </div>


                     <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="send-msg-mess-btn submit-req-btn">
                           <button class="send-btn-contact-us" type="submit"><?php echo (preg_replace('#<[^>]+>#',' ',translation('submit_your_request')));?></button>
                        </div>
                     </div>
                  </div>
              
            </div>
    </form>


      <div class="col-sm-5 col-md-4 col-lg-4">
         <div class="services-main-block">
            <div class="help-service-main-block">
               <div class="call-image-block">
                  <img src="{{url('front-assets')}}/images/help-call-icon.png" alt="" />
               </div>
               <div class="head-ans-question">
                  <span>{{$arr_site_settings['site_contact_number'] or '-'}}</span>
               </div>
               <div class="content-ans-question">
                <?php echo (preg_replace('#<[^>]+>#',' ',translation('right_side_help_phone_below_text')));?>
               </div>
            </div>
            <div class="help-service-main-block">
               <div class="call-image-block">
                  <img src="{{url('front-assets')}}/images/help-mail-icon.png" alt="" />
               </div>
               <div class="head-ans-question">
                  <?php echo (preg_replace('#<[^>]+>#',' ',translation('email_us_at')));?><br/> {{$arr_site_settings['site_email_address'] or '-'}}
               </div>
               <div class="content-ans-question">
                  <?php echo (preg_replace('#<[^>]+>#',' ',translation('right_side_help_email_below_text')));?>
               </div>
            </div>
            <div class="help-service-main-block">
               <div class="call-image-block">
                  <img src="{{url('front-assets')}}/images/help-icon.png" alt="" />
               </div>
               <div class="head-ans-question">
                  <?php echo (preg_replace('#<[^>]+>#',' ',translation('start_an_online_chat')));?>
               </div>
               <div class="content-ans-question">
                <?php echo (preg_replace('#<[^>]+>#',' ',translation('right_side_help_chat_below_text')));?>
              
               </div>
            </div>
         </div>
      </div>
      <div class="clr"></div>
   </div>
</div>
