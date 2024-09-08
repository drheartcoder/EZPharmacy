<div ng-controller="MainCtrl"  ng-init='site_url="{{url('/')}}";'>
   
   <div class="header header-home gradintcolr">
      <div class="logo-block wow fadeInDown" data-wow-delay="0.2s">
         <a href="{{url('')}}">
         <img src="{{url('front-assets')}}/images/logo.svg" alt="" class="main-logo" />
         </a>
      </div>
      <span class="menu-icon" onclick="openNav()">&#9776;</span>
      <!--Menu Start-->
      <div id="mySidenav" class="sidenav">
         <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
         <div class="banner-img-block">
            <img src="{{url('front-assets')}}/images/logo-icon.png" alt="" />
         </div>
         
         <ul class="min-menu">
          
            @if(!\Session::has('userLogged'))            
          
            <li class="lang">
               <div class="wrapper-dropdown-1" id="dd">
                  <span id="new_word">
                     @if(App::getLocale()=='en')
                     <a  class="font-size-a" onclick="changeLanguage('ar');">
                        عربى
                      </a>
                      @elseif(App::getLocale()=='ar')
                      <a onclick="changeLanguage('en');">
                        English
                        </a>
                      @endif
                  </span>
               </div>
            </li> 

              <!-- <li class="drop-block-new"><a class="<?php  echo Request::segment(2) == 'how-it-works'?'active':'';  ?>" data-hover="How it Works" href="{{url('')}}/page/how-it-works/" ><?php echo (preg_replace('#<[^>]+>#',' ',translation('how_it_works')));?></a></li>
              <li class="drop-block-new"><a onclick="location.href='{{url('')}}/products/';" href="{{url('')}}/products/" class="drop-block"><?php echo (preg_replace('#<[^>]+>#',' ',translation('products')));?> </a></li>
              <li><a class="<?php  echo Request::segment(2) == 'corporate-solutions'?'active':'';  ?>" href="{{url('')}}/page/corporate-solutions/"><?php echo (preg_replace('#<[^>]+>#',' ',translation('corporate_solutions')));?></a></li>
              -->           
            @endif
            @if(!\Session::has('userLogged'))
            <li><a class="logi-link-block fornt-none" onclick="closeNav()" ng-click="toggleLogin()" ><?php echo (preg_replace('#<[^>]+>#',' ',translation('login')));?></a></li>
            <li><a class="logi-link-block fornt-none" onclick="closeNav()" ng-click="toggleSignup()" ><?php echo (preg_replace('#<[^>]+>#',' ',translation('sign_up')));?></a></li>
           
            @endif



         </ul>
         <div class="clr"></div>
      </div>
      
      @if(!\Session::has('userLogged'))
      <div class="login-regis-btn-menu">
       <span><a class="logi-link-block" ng-click="toggleLogin()" ><?php echo (preg_replace('#<[^>]+>#',' ',translation('login')));?></a></span>
       <span><a class="logi-link-block"  ng-click="toggleSignup()" ><?php echo (preg_replace('#<[^>]+>#',' ',translation('sign_up')));?></a></span>
      </div>
      @else
      <div class="login-regis-btn-menu">
      <ul class="min-menu">
      <li class="name-block-user bell-block">
         <a href="{{url('').'/user/my-cart/'}}">
         <img src="{{url('front-assets')}}/images/cart-icon-header.png" alt="" />
         <span class="badge" id="myCartCount">{{$cartCount or '0'}}</span>
         </a>
      </li>
      <li class="sub-menu name-block-user dash-show">
      <?php 
      $profile_image='';
      $loginId='';
      //dd($arr_logged_user);
       if(isset($arr_logged_user))
       {
            $profile_image=$arr_logged_user['profile_image'];
            $loginId=$arr_logged_user['loginId'];
       }
      ?>
        <a href="#" class="drop-block block-drop-new">
         <span class="img-block-user">
           @if($profile_image !='')
           <img  id="header_profile_img" src="{{ url('/').'/uploads/all_users/'.$loginId.'/profile/thumb_107X107_'.$profile_image}}"/>
            @endif
          </span><span class="name-client-container">{{$arr_logged_user['full_name'] or ''}}<i class="fa fa-angle-down"></i></span>
         </a>
         <ul class="su-menu">
            <img class="img-arrow-menu" src="{{url('front-assets')}}/images/menu-arrow-ul.png" alt="" />
             <li><a class="<?php  echo Request::segment(2) == 'dashboard'?'active':'';  ?>" href="{{url('/user/dashboard')}}"><i class="fa fa-home"></i><?php echo (preg_replace('#<[^>]+>#',' ',translation('dashboard')));?> </a></li>
            <li><a class="<?php  echo Request::segment(2) == 'account'?'active':'';  ?>" href="{{url('/user/account')}}"><i class="fa fa-cog"></i><?php echo (preg_replace('#<[^>]+>#',' ',translation('account_settings')));?></a></li>
            <li><a href="{{url('/user/logout')}}"><i class="fa fa-sign-out"></i><?php echo (preg_replace('#<[^>]+>#',' ',translation('logout')));?></a></li>
         </ul>
      </li>
      </ul>
      </div>
      @endif

      @if(\Session::has('userLogged'))
      <ul class="responsive-block-show">
         <li class="name-block-user bell-block res-show">
            <a href="#">
            <img src="{{url('front-assets')}}/images/cart-icon-header.png" alt="" />
            <span class="badge">{{$cartCount or '0'}}</span>
            </a>
         </li>
      </ul>
      @endif
      <div class="clr"></div>
   </div>


   @if(!\Session::has('userLogged'))
   <!--modal start here-->
<modal id="login-model" title="Login form" visible="showLogin" >


      <div class="col-sm-6 col-md-6 col-lg-6 padd-l-no">
         <div class="login-left-block">
            <div class="login-overlay"></div>
            <div class="main-block-login">
               <div class="logo-block-login">
                  <img src="{{url('front-assets')}}/images/logo-login.png" alt="" />
               </div>
               <div class="quickly-txt-login">
                  <?php echo translation('quickly_find_top_printing_solution_with_a_different_variety');?> 
               </div>
            </div>
         </div>
      </div>
      
      <div class="col-sm-6 col-md-6 col-lg-6"
            ng-controller="LoginCtrl"
            ng-init='module_url="{{url('/')}}/login";' >

            <button type="button" class="close" data-dismiss="modal" ng-click="resetForm();" ><img src="{{url('front-assets')}}/images/popup-close-btn.png" alt="" /> </button>                    
           <form class="login-form-block"  name="loginForm" 
            ng-submit="loginForm.$valid && storeLogin()"
            novalidate >            

                  <div id="login_status_msg"></div>
                  <div class="login-head-block">
                     <?php echo translation('login');?> 
                  </div>
                  <div class="login-content-block">
                     <?php echo translation('dont_have_an_account');?> <a class="logi-link-block" ng-click="toggleSignup()"><?php echo translation('create_your_account');?>,</a><?php echo translation('it_takes_less_than_a_minute');?>
                  </div>

                  <div class="mobile-nu-block input-first" ng-class="{ 'has-error': loginForm.email.$touched && loginForm.email.$invalid }">
                     <input type="email" 
                            name="email" 
                            ng-model="user.email"
                            ng-pattern="/^[a-z]+[a-z0-9._]+@[a-z0-9._]+\.[a-z.]{2,5}$/"
                            ng-required="true"                    
                            />
                            
                     <span class="highlight"></span> 
                     <div class="error-new-block ng-cloak" ng-messages="loginForm.email.$error" ng-if="loginForm.$submitted || loginForm.email.$touched">
                        @include('front.includes.message')
                     </div>
                     <label><?php echo translation('email_address');?></label>
                     <span class="icon-block"><i class="fa fa-envelope"></i></span>
                  </div>

                  <div class="mobile-nu-block input-first" ng-class="{ 'has-error': loginForm.password.$touched && loginForm.password.$invalid }">
                     
                     <input type="password" name="password"
                            ng-model="user.password" 
                            ng-required="true" />

                     <span class="highlight"></span>  
                       <div class="error-new-block ng-cloak" ng-messages="loginForm.password.$error" ng-if="loginForm.$submitted || loginForm.password.$touched">
                          @include('front.includes.message')
                       </div>
                     <label><?php echo translation('password');?></label>
                     <span class="icon-block"><i class="fa fa-key"></i></span>
                  </div>

                  <div class="btn-block-main-login">
                     <div class="btn-login-block">
                        <button class="login-btn" type="submit"><?php echo translation('login');?></button>
                     </div>
                     <div class="recover-pass-block">
                        <a href="javascript:void(0);" ng-click="toggleForgetPassword()"><?php echo translation('recover_password');?></a>
                     </div>
                     <div class="clr"></div>
                  </div>
         </form>

      </div>

      <div class="clr"></div>
      <!--
         <form role="form">                       
             <div class="form-group">
                 <label for="email">Email address</label>
                 <input type="email" class="form-control" id="email" placeholder="Enter email" />
             </div>
             <div class="form-group">
                 <label for="password">Password</label>
                 <input type="password" class="form-control" id="password" placeholder="Password" />
             </div>
             <button type="submit" class="btn btn-default">Submit</button>
             <h5 ng-click="toggleSignup()" class="open-modal">signup</h5>                        
         </form>
         -->
    </modal>
   <!--modal login end here-->

   <!--modal signup start here-->
    <modal id="signup-model" title="signup form" visible="showSignup" style="display: none;" >
        <div class="col-sm-6 col-md-6 col-lg-6 padd-l-no">
            <div class="login-left-block">
                <div class="login-overlay"></div>
                <div class="main-block-login">
                    <div class="logo-block-login">
                        <img src="{{url('front-assets')}}/images/logo-login.png" alt="" />
                    </div>
                    <div class="quickly-txt-login">
                        <?php echo (preg_replace('#<[^>]+>#',' ',translation('quickly_find_top_printing_solution_with_a_different_variety')));?>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-sm-6 col-md-6 col-lg-6" ng-controller="LoginCtrl" ng-init='module_url="{{url('/')}}";'>
            <button type="button" class="close"  ng-click="resetSignupForm();" data-dismiss="modal"><img src="{{url('front-assets')}}/images/popup-close-btn.png" alt="" /> </button>
            
            <form class="login-form-block" name="signupForm" ng-submit="signupForm.$valid && storeSignup()" novalidate >

                <div id="signup_status_msg"></div>
                <div class="login-head-block">
                    <?php echo (preg_replace('#<[^>]+>#',' ',translation('lets_get_started')));?>
                </div>
                <div class="login-content-block login-block-radio">
                   <?php echo (preg_replace('#<[^>]+>#',' ',translation('create_account_or')));?><a class="logi-link-block" ng-click="toggleLogin()"><?php echo (preg_replace('#<[^>]+>#',' ',translation('login_now')));?></a>
                </div>
                
                <div class="radio-btns">
                    
                    <div class="radio-btn">
                        <input  type="radio" id="f-option" ng-model="signupuser.usertype" name="usertype" value="consumer" ng-required="true" checked="checked" >
                        
                        <label for="f-option"><?php echo (preg_replace('#<[^>]+>#',' ',translation('consumer')));?></label>
                        <div class="check"></div>
                    </div>

                    <div class="radio-btn">
                        <input  type="radio" id="s-option" ng-model="signupuser.usertype" name="usertype" ng-model="usertype" value="corporate" ng-required="true" >

                        <label for="s-option"><?php echo (preg_replace('#<[^>]+>#',' ',translation('corporate')));?></label>
                        <div class="check">
                            <div class="inside"></div>
                        </div>
                    </div>

                    
                  <div class="clr"></div>
                   <span class="highlight"></span>
                    <div class="error-new-block ng-cloak" ng-messages="signupForm.usertype.$error" ng-if="signupForm.$submitted || signupForm.usertype.$touched">
                        @include('front.includes.message')
                    </div>
                </div>
                
                <div class="mobile-nu-block input-first" ng-class="{ 'has-error': signupForm.firstname.$touched && signupForm.firstname.$invalid }">
                    <input type="text" name="firstname" 
                           ng-model="signupuser.firstname" 
                           ng-maxlength="100"   
                           ng-pattern="/^[a-zA-Z]+$/"                       
                           ng-required="true" />

                    <span class="highlight"></span>
                    <div class="error-new-block ng-cloak" ng-messages="signupForm.firstname.$error" ng-if="signupForm.$submitted || signupForm.firstname.$touched">
                        @include('front.includes.message',['maxlength'=>'100'])
                    </div>
                    <label><?php echo (preg_replace('#<[^>]+>#',' ',translation('first_name')));?></label>
                    <span class="icon-block"><i class="fa fa-user"></i></span>
                </div>
                <div class="mobile-nu-block input-first" ng-class="{ 'has-error': signupForm.lastname.$touched && signupForm.lastname.$invalid }">
                    <input type="text" name="lastname" ng-model="signupuser.lastname" ng-maxlength="100" ng-pattern="/^[a-zA-Z]+$/" ng-required="true" />
 
                    <span class="highlight"></span>
                    <div class="error-new-block ng-cloak" ng-messages="signupForm.lastname.$error" ng-if="signupForm.$submitted || signupForm.lastname.$touched">
                        @include('front.includes.message',['maxlength'=>'100'])
                    </div>
                    <label><?php echo (preg_replace('#<[^>]+>#',' ',translation('last_name')));?></label>
                    <span class="icon-block"><i class="fa fa-user"></i></span>
                </div>

                <div class="mobile-nu-block input-first" ng-class="{ 'has-error': signupForm.email.$touched && signupForm.email.$invalid }">
                    <input type="email" name="email" ng-model="signupuser.email" ng-required="true" ng-pattern="/^[a-z]+[a-z0-9._]+@[a-z0-9._]+\.[a-z.]{2,5}$/" ng-blur="checkEmailExist()" />
                    
                    <span class="highlight"></span>
                    <div class="error-new-block ng-cloak"  ng-messages="signupForm.email.$error" ng-if="signupForm.$submitted || signupForm.email.$touched">
                        @include('front.includes.message')
                        <p id="err_email" class="error"></p>
                    </div>
                      
                      <label ng-if="showEmailLabel" ><?php echo (preg_replace('#<[^>]+>#',' ',translation('email_address')));?></label>
                      <label ng-if="showCompanyEmailLabel" ><?php echo (preg_replace('#<[^>]+>#',' ',translation('company_email_id')));?></label>

                    <span class="icon-block"><i class="fa fa-envelope"></i></span>
                </div>

                <div class="mobile-nu-block input-first" ng-class="{ 'has-error': signupForm.phone.$touched && signupForm.phone.$invalid }">
                    <input type="text" name="phone" ng-model="signupuser.phone" ng-minlength="6" ng-maxlength="16" ng-required="true" ng-pattern="/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/" ng-blur="checkMobileExist()" />
                          
                          <?php 
                            $invalid_number= translation("must_be_a_valid_phone_number");
                          ?>
                    <span class="highlight"></span>
                    <div class="error-new-block ng-cloak" ng-messages="signupForm.phone.$error" ng-if="signupForm.$submitted || signupForm.phone.$touched">
                        @include('front.includes.message',['minlength'=>'6','maxlength'=>'16' , 'pattern' => "$invalid_number"])
                         <p id="err_mobile" class="error"></p>
                    </div>
                    <label><?php echo (preg_replace('#<[^>]+>#',' ',translation('contact_number')));?></label>
                    <span class="icon-block"><i class="fa fa-phone"></i></span>
                </div>

                        <div ng-if="showCompanyName" class="mobile-nu-block input-first" ng-class="{ 'has-error': signupForm.companyname.$touched && signupForm.companyname.$invalid }">
                            <input type="text" name="companyname" 
                                  ng-model="signupuser.companyname" 
                                  ng-maxlength="100" 
                                  ng-required="true" />
                                
                            <span class="highlight"></span>
                            <div class="error-new-block ng-cloak" ng-messages="signupForm.companyname.$error" ng-if="signupForm.$submitted || signupForm.companyname.$touched">
                                @include('front.includes.message',['maxlength'=>'100'])
                            </div>
                            <label><?php echo (preg_replace('#<[^>]+>#',' ',translation('company_name')));?></label>
                            <span class="icon-block"><i class="fa fa-user"></i></span>
                        </div>

                <div class="mobile-nu-block input-first" ng-class="{ 'has-error': signupForm.password.$touched && signupForm.password.$invalid }">
                    <input type="password" name="password"  
                            id="password" 
                            ng-model="signupuser.password"
                            ng-minlength="6"
                            ng-required="true" 
                            {{-- ng-pattern="/^(?=.*[a-z])(?=.*\d)(?=.*[$@$!%*#?&])[a-z\d$@$!%*#?&]{6,}$/" --}}
                            />

                    <span class="highlight"></span>
                    <div class="error-new-block ng-cloak" ng-messages="signupForm.password.$error" ng-if="signupForm.$submitted || signupForm.password.$touched">
                    <?php 
                    $password_pattern = preg_replace('#<[^>]+>#',' ',translation('password_pattern'));
                    ?>
                      {{--   @include('front.includes.message',['minlength'=>'6','pattern'=>"$password_pattern"]) --}}
                         @include('front.includes.message',['minlength'=>'6'])
                       
                    </div>
                    <label><?php echo (preg_replace('#<[^>]+>#',' ',translation('password')));?></label>
                    <span class="icon-block"><i class="fa fa-key"></i></span>
                </div>

                <div class="mobile-nu-block input-first" ng-class="{ 'has-error': signupForm.confirmpassword.$touched && signupForm.confirmpassword.$invalid }">
                    <input type="password" name="confirmpassword" id="confirmpassword" 
                            ng-model="signupuser.confirmpassword" 
                            ng-required="true" 
                            pw-check="password" />

                    <span class="highlight"></span>
                    <div class="error-new-block ng-cloak" ng-messages="signupForm.confirmpassword.$error" ng-if="signupForm.$submitted || signupForm.confirmpassword.$touched">
                        @include('front.includes.message')
                        <p ng-show="signupForm.confirmpassword.$error.pwmatch" class="error"><?php echo (preg_replace('#<[^>]+>#',' ',translation('passwords_do_not_match')));?></p>

                    </div>
                    <label><?php echo (preg_replace('#<[^>]+>#',' ',translation('confirm_password')));?></label>

                    <span class="icon-block"><i class="fa fa-key"></i></span>
                </div>

                <div class="btn-block-main-login">
                    <div class="btn-login-block">
                        <button class="login-btn" type="submit"><?php echo (preg_replace('#<[^>]+>#',' ',translation('register')));?></button>
                    </div>
                    <div class="clr"></div>
                </div>
            </form>
        </div>
        <div class="clr"></div>
    </modal>
   <!--modal signup end here-->

   <!--modal login start here-->
    <modal id="forgetpassword-model" title="Login form" visible="showForgetPassword" style="display: none;">

      <div class="col-sm-6 col-md-6 col-lg-6 padd-l-no">
         <div class="login-left-block">
            <div class="login-overlay"></div>
            <div class="main-block-login">
               <div class="logo-block-login">
                  <img src="{{url('front-assets')}}/images/logo-login.png" alt="" />
               </div>
               <div class="quickly-txt-login">
                  <?php echo (preg_replace('#<[^>]+>#',' ',translation('quickly_find_top_printing_solution_with_a_different_variety')));?>
               </div>
            </div>
         </div>
      </div>

      
      <div class="col-sm-6 col-md-6 col-lg-6"
            ng-controller="LoginCtrl"
            ng-init='module_url="{{url('/')}}";' >

            <button type="button" class="close" data-dismiss="modal" ng-click="resetForgetForm();" ><img src="{{url('front-assets')}}/images/popup-close-btn.png" alt="" /> </button>                    
         <form class="login-form-block"  name="forgetPasswordForm"
           ng-submit="forgetPasswordForm.$valid && storeForgetPassword()"
           novalidate >

                <div id="forget_status_msg"></div>
                <div class="login-head-block">
                    <?php echo (preg_replace('#<[^>]+>#',' ',translation('forget_password')));?>
                </div>
                <div class="login-content-block">
                   <?php echo (preg_replace('#<[^>]+>#',' ',translation('dont_worry_if_you_forget_your_password')));?> <br/> <?php echo (preg_replace('#<[^>]+>#',' ',translation('it_takes_few_minutes_to_recover_your_password')));?>
                </div>

                <div class="mobile-nu-block input-first" ng-class="{ 'has-error': forgetPasswordForm.forgetemail.$touched && forgetPasswordForm.forgetemail.$invalid }">
                   <input type="email" 
                          name="forgetemail" 
                          ng-pattern="/^[a-z]+[a-z0-9._]+@[a-z0-9._]+\.[a-z.]{2,5}$/"
                          ng-model="forgetuser.forgetemail"
                          ng-required="true"                    
                          />
                          
                   <span class="highlight"></span> 
                   <div class="error-new-block ng-cloak" ng-messages="forgetPasswordForm.forgetemail.$error" ng-if="forgetPasswordForm.$submitted || forgetPasswordForm.forgetemail.$touched">
                      @include('front.includes.message')
                   </div>
                   <label><?php echo (preg_replace('#<[^>]+>#',' ',translation('email_address')));?></label>
                   <span class="icon-block"><i class="fa fa-envelope"></i></span>
                </div>

              

                <div class="btn-block-main-login">
                   <div class="btn-login-block">
                      <button class="login-btn" type="submit"><?php echo (preg_replace('#<[^>]+>#',' ',translation('submit')));?></button>
                   </div>
                   
                   <div class="clr"></div>
                </div>
         </form>

      </div>

      <div class="clr"></div>
      
    </modal>
   <!--modal login end here-->

    <!--main modal start here-->         
   <!--main modal end here-->
   
   @endif


      <!--modal login start here-->
    <modal id="popup-status-model" title="Login form" visible>

      <div class="col-sm-6 col-md-6 col-lg-6 padd-l-no"  >
         <div class="login-left-block">
            <div class="login-overlay"></div>
            <div class="main-block-login">
               <div class="logo-block-login">
                  <img src="{{url('front-assets')}}/images/logo-login.png" alt="" />
               </div>
               <div class="quickly-txt-login">
                  <?php echo (preg_replace('#<[^>]+>#',' ',translation('quickly_find_top_printing_solution_with_a_different_variety')));?>
               </div>
            </div>
         </div>
      </div>
      <div class="col-sm-6 col-md-6 col-lg-6" >
       <button type="button" class="close"  ng-click="resetPopupModel();" data-dismiss="modal"><img src="{{url('front-assets')}}/images/popup-close-btn.png" alt="" /> </button>
            
       <div class="login-left-block">
            <div class="login-overlay"></div>
            <div class="main-block-login">
               
               <div class="quickly-txt-login">
                  <div id="popup_status_msg"></div>
               </div>
            </div>
         </div>
      </div>

      
      
      <div class="clr"></div>
      
    </modal>
   <!--modal login end here-->
</div>
<script type="text/javascript">
    function changeLanguage(lang) {
    window.location.href=site_url+'/set_lang/'+lang;
  }
</script>