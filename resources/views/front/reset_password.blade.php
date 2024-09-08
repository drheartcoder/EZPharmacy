<style>.header{background: #fff;background:rgba(255,255,255,1); box-shadow: 0 0 2px rgba(0, 0, 0, 0.24); position: relative;}
    .min-menu li.dash-show{display: block;float: right;}
    .send-btn-contact-us {  margin: 22px !important;}
    .send-msg-mess-btn {    text-align: left !important;}
/* .min-menu li{display: none;}.min-menu li.lang, .min-menu li.call-no-block, .min-menu li.dash-show{display: inline-block;}#dd .dropdown li{display: block;} */
</style>
<div class="container" ng-controller="LoginCtrl" ng-init="module_url = '{{url('/')}}';enc_id= '{{Request::segment(3)}}';" style="min-height:193px;">
   <div class="row">
      <form name="resetPasswordForm" 
            ng-submit="resetPasswordForm.$valid && storeResetPassword()"
            novalidate
            >

         <div class="col-sm-6 col-md-6 col-lg-12">

    

            <div class="send-mess-head">
               <?php echo (preg_replace('#<[^>]+>#',' ',translation('reset_password')));?>
            </div>
            <div id="status_msg"></div>
            <div class="row">

               <div class="col-sm-12 col-md-6 col-lg-4">
                  <div class="filed-lable">
                    <?php echo (preg_replace('#<[^>]+>#',' ',translation('new_password')));?>
                  </div>
                  <?php 
                    $password_pattern=translation('password_pattern');
                    ?>
                  <div class="input-box-block" ng-class="{ 'has-error': resetPasswordForm.new_password.$touched && resetPasswordForm.new_password.$invalid }">
                     <input type="password" name="new_password" id="new_password" placeholder="<?php echo (preg_replace('#<[^>]+>#',' ',translation('enter_your_new_password')));?>"
                            ng-model="resetpassword.new_password" 
                            ng-minlength="6"
                            ng-required="true"
                            {{-- ng-pattern="/^(?=.*[A-Za-z])(?=.*\d)(?=.*[$@$!%*#?&])[A-Za-z\d$@$!%*#?&]{6,}$/" --}}
                            {{-- ng-pattern="/^(?=.*[a-z])(?=.*\d)(?=.*[$@$!%*#?&])[a-z\d$@$!%*#?&]{6,}$/" --}}
                            />
                     <div ng-messages="resetPasswordForm.new_password.$error" ng-if="resetPasswordForm.$submitted || resetPasswordForm.new_password.$touched">
                        @include('front.includes.message',['minlength' => 6])
                     </div>
                  </div>
               </div>
               <div class="col-sm-12 col-md-6 col-lg-4">
                  <div class="filed-lable">
                    <?php echo (preg_replace('#<[^>]+>#',' ',translation('confirm_password')));?>
                  </div>
                  <div class="input-box-block" ng-class="{ 'has-error': resetPasswordForm.confirm_password.$touched && resetPasswordForm.confirm_password.$invalid }">
                     <input type="password" name="confirm_password" id="confirm_password" placeholder="<?php echo (preg_replace('#<[^>]+>#',' ',translation('enter_your_new_password_again')));?>" 
                            ng-model="resetpassword.confirm_password" 
                            pw-check="new_password"
                            ng-required="true" />
                     <div ng-messages="resetPasswordForm.confirm_password.$error" ng-if="resetPasswordForm.$submitted || resetPasswordForm.confirm_password.$touched">
                        @include('front.includes.message',[])
                         <p ng-show="resetPasswordForm.confirm_password.$error.pwmatch" class="error"><?php echo (preg_replace('#<[^>]+>#',' ',translation('passwords_do_not_match')));?></p> 
                     </div>
                  </div>
               </div>
                <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="filed-lable">
                     
                  </div>
                  <div class="send-msg-mess-btn">
                     <button class="send-btn-contact-us" type="submit"><?php echo (preg_replace('#<[^>]+>#',' ',translation('submit')));?></button>
                  </div>
               </div>
              
              
            </div>
         </div>
      </form>
   
    
      <div class="clr"></div>
   </div>
</div>