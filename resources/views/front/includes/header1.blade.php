<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta property="og:title" content="printing" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="http://www.webwingtechnologies.com/" />
    <meta property="og:image" content="{{url('').'/front-assets/'}}images/logo.png" />
    <meta property="og:description" content="printing" />
    <meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700" rel="stylesheet">
    <link href="{{url('front-assets')}}/css/slick.css" rel="stylesheet">
    <link href="{{url('front-assets')}}/css/style.css" rel="stylesheet">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="{{url('front-assets')}}/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="{{url('front-assets')}}/images/favicon-16x16.png">
    <link rel="manifest" href="/manifest.json">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="theme-color" content="#ffffff">
   <!-- ==============================New files========================================== -->
      <link rel="apple-touch-icon" sizes="180x180" href="{{url('front-assets')}}/images/apple-touch-icon.png">
      <link rel="icon" type="image/png" sizes="32x32" href="{{url('front-assets')}}/images/favicon-32x32.png">
      <link rel="icon" type="image/png" sizes="16x16" href="{{url('front-assets')}}/images/favicon-16x16.png">
      <link rel="manifest" href="{{url('').'/'}}manifest.json"> 
      <link rel="mask-icon" href="{{url('front-assets')}}/images/safari-pinned-tab.svg" color="#5bbad5">
      <!-- ======================================================================== -->
      <link rel="icon" href="{{url('').'/'}}favicon.png" type="image/x-icon" />
      <!-- Bootstrap Core CSS -->
      <link href="{{url('front-assets')}}/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
      <!--font-awesome-css-start-here-->
      <link href="{{url('front-assets')}}/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
      <link href="{{url('front-assets')}}/css/animate.css" rel="stylesheet" type="text/css" />
      <link href="{{url('front-assets')}}/css/printing.css" rel="stylesheet" type="text/css" />
      @if(\App::getLocale() == 'ar')
      <link href="{{url('front-assets')}}/css/rtl.css" rel="stylesheet" type="text/css" />
      @endif
      <link href="{{url('front-assets')}}/css/set1.css" rel="stylesheet" type="text/css" />
      <link href="{{url('front-assets')}}/css/dropzone.css" rel="stylesheet" type="text/css" />
      <link href="{{ url('/') }}/assets/alert/css/alert.css" rel="stylesheet" />
      <link href="{{ url('/') }}/assets/alert/themes/default/theme.css" rel="stylesheet" />
      <script type="text/javascript" language="javascript" src="{{url('front-assets')}}/js/jquery-1.11.3.min.js"></script>
      <script type="text/javascript"> var SITE_URL = "{{ url('/') }}"; </script>


  <script src="{{url('front-assets')}}/js/angular/angular.js"></script>
  <script src="{{url('front-assets')}}/js/angular/angular-route.js"></script>
  <!--angular message js-->
  
  <script src="{{url('front-assets')}}/js/angular/main.js" type="text/javascript"></script>
  <script src="{{url('front-assets')}}/js/angular/angular-messages.js" type="text/javascript"></script>
  <!-- Angular assets start -->
  <script src="{{url('front-assets')}}/js/angular/angular-assets/ng-file-upload.js" type="text/javascript"></script>
  <script src="{{url('front-assets')}}/js/angular/angular-assets/ng-file-upload-shim.js" type="text/javascript"></script>      
  <!-- Angular assets ends -->
  <!-- Angular Controller JS starts -->
  <script src="{{url('front-assets')}}/js/angular/angular-controllers/LoginCtrl.js" type="text/javascript"></script>
  <script src="{{url('front-assets')}}/js/angular/angular-controllers/CMSCtrl.js" type="text/javascript"></script>
  <script src="{{url('front-assets')}}/js/angular/angular-controllers/UserCtrl.js" type="text/javascript"></script>
  <script src="{{url('front-assets')}}/js/angular/angular-controllers/AddressBookCtrl.js" type="text/javascript"></script>
  <!-- Angular Controller JS ends -->
  <!--  Capcha start -->
  <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.28/angular.js"></script>
  <script src="{{url('front-assets')}}/js/angular/angular-assets/angular-recaptcha.js"></script>
  <script src="{{url('front-assets')}}/js/angular/angular-assets/captcha-service.js"></script>
  <!--  Capcha end -->
  <script src="{{url('front-assets')}}/js/dropzone.min.js" type="text/javascript"></script>

  <style type="text/css">
     .modal.container { max-width: none; }
     .modal-backdrop { z-index: 8 !important; }
     .ng-cloak { display: none; }
  </style>
  <script type="text/javascript" src="{{ url('/') }}/assets/alert/js/alert.js"></script>
  <script type="text/javascript">
     var site_url    = "{{url('/')}}";
     var csrf_token  = "{{csrf_token()}}";  
  </script>

  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body ng-app="printingStore">
<!-- LOGIN MODAL BEGIN -->
<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg login-modal" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div class="row">
          <div class="display-flex">
            <div class="col-md-6 col-sm-6 col-sm-12 col-xs-12 display-flex" ng-controller="LoginCtrl"
            ng-init='module_url="{{url('/')}}/login";'>
              <div class="row login-left-side">
                <a class="close-login-modal visible-mobile-flex" data-dismiss="modal"><i class="icon-close"></i></a>
                <h2>Login</h2>
                <form name="loginForm" 
                          ng-submit="loginForm.$valid && storeLogin()"
                           novalidate class="login-modal-form">
                   <div id="login_status_msg"></div>

                   <div class="mobile-nu-block input-first" ng-class="{ 'has-error': loginForm.email.$touched && loginForm.email.$invalid }">
                    <input type="text" name="email" 
                                ng-model="user.email"
                                ng-pattern="/^[a-z]+[a-z0-9._]+@[a-z0-9._]+\.[a-z.]{2,5}$/"
                                ng-required="true"
                                placeholder="Email">
                     <span class="highlight"></span> 
                     <div class="error-new-block ng-cloak" ng-messages="loginForm.email.$error" ng-if="loginForm.$submitted || loginForm.email.$touched">
                        @include('front.includes.message')
                     </div>
                     </div>
              
                     <div class="mobile-nu-block input-first" ng-class="{ 'has-error': loginForm.password.$touched && loginForm.password.$invalid }">
                    <input type="password" name="password"
                            ng-model="user.password" 
                            ng-required="true" 
                            placeholder="Password">
                            <span class="highlight"></span>  
                       <div class="error-new-block ng-cloak" ng-messages="loginForm.password.$error" ng-if="loginForm.$submitted || loginForm.password.$touched">
                          @include('front.includes.message')
                       </div>
                       </div>
            
                 <button class="login-btn" type="submit"><?php echo (preg_replace('#<[^>]+>#',' ',translation('login')));?></button>
                  <p><a onclick="openForgetModal(event)" class="recover-pass-link">Recover Password</a></p>
                </form>
              </div>
            </div>
            <div class="col-md-6 col-sm-6 col-sm-12 display-flex hidden-xs">
              <div class="row login-right-side">
                <a class="close-login-modal" data-dismiss="modal"><i class="icon-close"></i></a>
                <h3>Sign Up</h3>
                <p>Don't have an account ? Create Your Account, It takes less than a minute.</p>
                <button onclick="openSignUpModal()">Sign Up</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- LOGIN MODAL EOF -->
<!-- SIGN UP MODAL BEGIN -->
<div class="modal fade" id="sign-up-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg login-modal" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div class="row">
          <div class="display-flex">
            <div class="col-md-6 col-sm-6 col-xs-12 display-flex" ng-controller="LoginCtrl" ng-init='module_url="{{url('/')}}";'>
              <div class="row login-left-side">
                <a class="close-login-modal visible-mobile-flex" data-dismiss="modal"><i class="icon-close"></i></a>
                <h2>Let’s Get Started</h2>
                <form class="login-modal-form" name="signupForm" ng-submit="signupForm.$valid && storeSignup()" novalidate>

                <div id="signup_status_msg"></div>

                    <div class="mobile-nu-block input-first" ng-class="{ 'has-error': signupForm.firstname.$touched && signupForm.firstname.$invalid }">
                            <input type="text" name="firstname" 
                             ng-model="signupuser.firstname" 
                             ng-maxlength="100"   
                             ng-pattern="/^[a-zA-Z]+$/"                       
                             ng-required="true" placeholder="First Name">
                       <span class="highlight"></span>
                        <div class="error-new-block ng-cloak" ng-messages="signupForm.firstname.$error" ng-if="signupForm.$submitted || signupForm.firstname.$touched">
                            @include('front.includes.message',['maxlength'=>'100'])
                        </div>
                    </div>

                    <div class="mobile-nu-block input-first" ng-class="{ 'has-error': signupForm.lastname.$touched && signupForm.lastname.$invalid }">
                            <input type="text" name="lastname" ng-model="signupuser.lastname" ng-maxlength="100" ng-pattern="/^[a-zA-Z]+$/" ng-required="true" placeholder="Last Name">
                            <span class="highlight"></span>
                            <div class="error-new-block ng-cloak" ng-messages="signupForm.lastname.$error" ng-if="signupForm.$submitted || signupForm.lastname.$touched">
                                @include('front.includes.message',['maxlength'=>'100'])
                            </div>
                    </div>


                   <div class="mobile-nu-block input-first" ng-class="{ 'has-error': signupForm.email.$touched && signupForm.email.$invalid }">
                          <input type="email" name="email" ng-model="signupuser.email" ng-required="true" ng-pattern="/^[a-z]+[a-z0-9._]+@[a-z0-9._]+\.[a-z.]{2,5}$/" ng-blur="checkEmailExist()" placeholder="Email">
                           <span class="highlight"></span>
                            <div class="error-new-block ng-cloak"  ng-messages="signupForm.email.$error" ng-if="signupForm.$submitted || signupForm.email.$touched">
                                @include('front.includes.message')
                                <p id="err_email" class="error"></p>
                            </div>
                    </div>


                    <div class="mobile-nu-block input-first" ng-class="{ 'has-error': signupForm.phone.$touched && signupForm.phone.$invalid }">
                        <input type="text" name="phone" ng-model="signupuser.phone" ng-minlength="6" ng-maxlength="16" ng-required="true" ng-pattern="/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/" ng-blur="checkMobileExist()" placeholder="Contact Number">
                         <?php 
                                  $invalid_number= translation("must_be_a_valid_phone_number");
                                ?>
                          <span class="highlight"></span>
                          <div class="error-new-block ng-cloak" ng-messages="signupForm.phone.$error" ng-if="signupForm.$submitted || signupForm.phone.$touched">
                              @include('front.includes.message',['minlength'=>'6','maxlength'=>'16' , 'pattern' => "$invalid_number"])
                               <p id="err_mobile" class="error"></p>
                          </div>
                    </div>


                  <div class="mobile-nu-block input-first" ng-class="{ 'has-error': signupForm.password.$touched && signupForm.password.$invalid }">
                      <input type="password" name="password"  
                                id="password" 
                                ng-model="signupuser.password"
                                ng-minlength="6"
                                ng-required="true" placeholder="Password">
                         <span class="highlight"></span>
                        <div class="error-new-block ng-cloak" ng-messages="signupForm.password.$error" ng-if="signupForm.$submitted || signupForm.password.$touched">
                        <?php 
                        $password_pattern = preg_replace('#<[^>]+>#',' ',translation('password_pattern'));
                        ?>
                          {{--   @include('front.includes.message',['minlength'=>'6','pattern'=>"$password_pattern"]) --}}
                             @include('front.includes.message',['minlength'=>'6'])
                           
                        </div>
                  </div>


                   <div class="mobile-nu-block input-first" ng-class="{ 'has-error': signupForm.confirmpassword.$touched && signupForm.confirmpassword.$invalid }">
                  <input  type="password" name="confirmpassword" id="confirmpassword" 
                            ng-model="signupuser.confirmpassword" 
                            ng-required="true" 
                            pw-check="password" placeholder="Confirm Password">
                    <span class="highlight"></span>
                    <div class="error-new-block ng-cloak" ng-messages="signupForm.confirmpassword.$error" ng-if="signupForm.$submitted || signupForm.confirmpassword.$touched">
                        @include('front.includes.message')
                        <p ng-show="signupForm.confirmpassword.$error.pwmatch" class="error"><?php echo (preg_replace('#<[^>]+>#',' ',translation('passwords_do_not_match')));?></p>

                    </div>
                    </div>
                  <button class="login-btn" type="submit"><?php echo (preg_replace('#<[^>]+>#',' ',translation('register')));?></button>

                </form>
              </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 display-flex hidden-xs">
              <div class="row login-right-side">
                <a class="close-login-modal" data-dismiss="modal">
                  <i class="icon-close"></i>
                </a>
                <h3>Login</h3>
                <p>Sed ut perspiciatis unde omnis iste natus voluptatem accusantium doloremque laudantium.</p>
                <button onclick="openLoginModal()">Login</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- SIGN UP MODAL EOF -->
<!-- FORGET MODAL BEGIN -->
<div class="modal fade" id="forget-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg login-modal" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div class="row">
          <div class="display-flex">
            <div class="col-md-6 col-sm-6 col-xs-12 display-flex" class="col-sm-6 col-md-6 col-lg-6"
            ng-controller="LoginCtrl"
            ng-init='module_url="{{url('/')}}";'>
              <div class="row login-left-side">
                <a class="close-login-modal visible-mobile-flex" data-dismiss="modal"><i class="icon-close"></i></a>
                <p class="forget-field-back"><a href=""><i class="icon-back"></i> Back</a></p>
                <h2>Forget Password</h2>
                <p>Don't worry if you forget your password?
                  It takes few minutes to recover your password.</p>
                <form class="login-modal-form" name="forgetPasswordForm" ng-submit="forgetPasswordForm.$valid && storeForgetPassword()" novalidate>
                 <div class="mobile-nu-block input-first" ng-class="{ 'has-error': forgetPasswordForm.forgetemail.$touched && forgetPasswordForm.forgetemail.$invalid }">
                  <input  type="email" 
                          name="forgetemail" 
                          ng-pattern="/^[a-z]+[a-z0-9._]+@[a-z0-9._]+\.[a-z.]{2,5}$/"
                          ng-model="forgetuser.forgetemail"
                          ng-required="true" placeholder="Email">
                   <span class="highlight"></span> 
                   <div class="error-new-block ng-cloak" ng-messages="forgetPasswordForm.forgetemail.$error" ng-if="forgetPasswordForm.$submitted || forgetPasswordForm.forgetemail.$touched">
                      @include('front.includes.message')
                   </div>
                  </div>
                  <button>Submit</button>
                </form>
              </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 display-flex hidden-xs">
              <div class="row login-right-side">
                <a class="close-login-modal" data-dismiss="modal"><i class="icon-close"></i></a>
                <h3>Sign Up</h3>
                <p>Don't have an account ? Create Your Account,
                  It takes less than a minute.</p>
                <button onclick="openSignUpModal()">Sign Up</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- FORGET MODAL EOF -->
