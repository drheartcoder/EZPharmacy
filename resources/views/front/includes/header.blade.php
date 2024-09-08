
<!DOCTYPE html>
@if(\App::getLocale() == 'ar')
<html lang="ar">
@else
<html lang="eng">
@endif
<head>
    <?php
  $_action = app('request')->route()->getAction(); 
  $isController = class_basename($_action['controller']);
  $expl = explode('@',$isController);
?>
<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Print {{$pageTitle}}</title>
  
  <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-109254566-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-109254566-1');
</script>

  
  <!--font-awesome-css-start-here-->
  <link href="{{url('front-assets')}}/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
  <link href="{{url('front-assets')}}/css/animate.css" rel="stylesheet" type="text/css" />

  @if($isController != "HomeController@index")
    <link href="{{url('front-assets')}}/css/printing.css" rel="stylesheet" type="text/css" />
    
    
  @endif
    <link href="{{ url('/') }}/assets/alert/css/alert.css" rel="stylesheet" />
    <link href="{{ url('/') }}/assets/alert/themes/default/theme.css" rel="stylesheet" />
  <!--previous css used starts-->

    <link href="{{url('front-assets')}}/css/dropzone.css" rel="stylesheet" type="text/css" />

     <?php

    $css_folder = 'en';
  ?>
  @if(\App::getLocale() == 'ar')
  <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700" rel="stylesheet">
  <link href="{{url('front-assets')}}/css/ar/bootstrap.min.css" rel="stylesheet">
  <link href="{{url('front-assets')}}/css/ar/slick.css" rel="stylesheet">
  <link href="{{url('front-assets')}}/css/ar/style.css" rel="stylesheet">
  <link href="{{url('front-assets')}}/css/rtl.css" rel="stylesheet" type="text/css" />
  @else
  <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700" rel="stylesheet">
  <link href="{{url('front-assets')}}/css/en/bootstrap.min.css" rel="stylesheet">
  <link href="{{url('front-assets')}}/css/en/slick.css" rel="stylesheet">
  <link href="{{url('front-assets')}}/css/en/style.css" rel="stylesheet">
  @endif

  <!--previous css used ends-->
  <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="{{url('front-assets')}}/images/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="{{url('front-assets')}}/images/favicon-16x16.png">
<!--  RTL-->
 <!--   -->
  
  <link rel="manifest" href="/manifest.json">
  <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
  <meta name="theme-color" content="#ffffff">

  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script type="text/javascript" src="{{url('front-assets')}}/js/bootstrap.min.js"></script>
  <script type="text/javascript">
    var SITE_URL = '{{url('')}}';
  </script>


  <!--previous JS used starts-->
  
  <script src="{{url('front-assets')}}/js/angular/angular.js"></script>
  <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.28/angular.js"></script>
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
  
  <script src="{{url('front-assets')}}/js/angular/angular-assets/angular-recaptcha.js"></script>
  <script src="{{url('front-assets')}}/js/angular/angular-assets/captcha-service.js"></script>
  <!--  Capcha end -->
  <script src="{{url('front-assets')}}/js/dropzone.min.js" type="text/javascript"></script>
  <!-- Angular Controller JS starts -->

  <style type="text/css">
    @if($isController == "HomeController@index")
  /*back to top btn css start here*/
  .img-block-user {border-radius: 50%; display: inline-block; height: 35px; margin-right: 10px; overflow: hidden; width: 35px;vertical-align: middle;}
  .cd-top.cd-is-visible {opacity: 1; visibility: visible;}
  .cd-top.cd-is-visible, .cd-top.cd-fade-out, .no-touch .cd-top:hover {transition: opacity 0.3s ease 0s, visibility 0s ease 0s;}
  .cd-top {background-color: #000000; background-image: url("{{url('front-assets')}}/images/up-arrow.png"); background-repeat: no-repeat; background-position: center 50%; border-radius: 100px; bottom: 40px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.05); display: inline-block; height: 36px; opacity: 0; outline: medium none; overflow: hidden; position: fixed; right: 30px; text-indent: 100%; transition: opacity 0.3s ease 0s, visibility 0s ease 0.3s; visibility: hidden; white-space: nowrap; width: 36px; z-index: 99;}
  /*back to top btn css end here*/
  @endif
     .modal.container { max-width: none; }
     .modal-backdrop { z-index: 8 !important; }
     .ng-cloak { display: none; }
  </style>
  
  <script type="text/javascript">
     var site_url    = "{{url('/')}}";
     var csrf_token  = "{{csrf_token()}}";  
  </script>

  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <style type="text/css">
.img-block-user {
  border-radius: 50%;
  display: inline-block;
  height: 35px;
  margin-right: 10px;
  overflow: hidden;
  width: 35px;vertical-align: middle !important;
}
   .languag-head {
    margin-top: 30px;
    float: left;
}
    .languag-head a{color: #fff;cursor: pointer;}
    .languag-head a:hover{color: #631383;}
</style>
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
              <div class=" login-left-side">
                <a class="close-login-modal visible-mobile-flex" data-dismiss="modal"><i class="icon-close"></i></a>
                <h2><?php echo (preg_replace('#<[^>]+>#',' ',translation('login')));?></h2>
                <form name="loginForm" 
                          ng-submit="loginForm.$valid && storeLogin()"
                           novalidate class="login-modal-form">
                   <div id="login_status_msg"></div>

                   <div class="mobile-nu-block input-first" ng-class="{ 'has-error': loginForm.email.$touched && loginForm.email.$invalid }">
                    <input type="text" name="email" 
                                ng-model="user.email"
                                ng-pattern="/^[a-z]+[a-z0-9._]+@[a-z0-9._]+\.[a-z.]{2,5}$/"
                                ng-required="true"
                                placeholder="<?php echo (preg_replace('#<[^>]+>#',' ',translation('pemailp')));?>">
                     <span class="highlight"></span> 
                     <div class="error-new-block ng-cloak" ng-messages="loginForm.email.$error" ng-if="loginForm.$submitted || loginForm.email.$touched">
                        @include('front.includes.message')
                     </div>
                     </div>
              
                     <div class="mobile-nu-block input-first" ng-class="{ 'has-error': loginForm.password.$touched && loginForm.password.$invalid }">
                    <input type="password" name="password"
                            ng-model="user.password" 
                            ng-required="true" 
                            placeholder="<?php echo (preg_replace('#<[^>]+>#',' ',translation('password')));?>">
                            <span class="highlight"></span>  
                       <div class="error-new-block ng-cloak" ng-messages="loginForm.password.$error" ng-if="loginForm.$submitted || loginForm.password.$touched">
                          @include('front.includes.message')
                       </div>
                       </div>
            
                 <button class="login-btn" type="submit"><?php echo (preg_replace('#<[^>]+>#',' ',translation('login')));?></button>
                  <p><a onclick="openForgetModal(event)" class="recover-pass-link"><?php echo (preg_replace('#<[^>]+>#',' ',translation('recover_password')));?></a></p>
                </form>
              </div>
            </div>
            <div class="col-md-6 col-sm-6 col-sm-12 display-flex hidden-xs">
              <div class="login-right-side">
                <a class="close-login-modal" data-dismiss="modal"><i class="icon-close"></i></a>
                <h3><?php echo (preg_replace('#<[^>]+>#',' ',translation('sign_up')));?></h3>
                <p><?php echo (preg_replace('#<[^>]+>#',' ',translation('pdont_have_an_account_create_your_account_it_takes_less_than_a_minutep')));?></p>
                <button onclick="openSignUpModal()"><?php echo (preg_replace('#<[^>]+>#',' ',translation('sign_up')));?></button>
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
              <div class="login-left-side">
                <a class="close-login-modal visible-mobile-flex" data-dismiss="modal"><i class="icon-close"></i></a>
                <h2><?php echo (preg_replace('#<[^>]+>#',' ',translation('lets_get_started')));?></h2>
                <form class="login-modal-form" name="signupForm" ng-submit="signupForm.$valid && storeSignup();" novalidate>

                <div id="signup_status_msg"></div>
                    <div class="mobile-nu-block input-first" ng-class="{ 'has-error': signupForm.firstname.$touched && signupForm.firstname.$invalid }">
                            <input type="text" name="firstname" 
                             ng-model="signupuser.firstname" 
                             ng-maxlength="100"                         
                             ng-required="true" placeholder="<?php echo (preg_replace('#<[^>]+>#',' ',translation('first_name')));?>">
                       <span class="highlight"></span>
                        <div class="error-new-block ng-cloak" ng-messages="signupForm.firstname.$error" ng-if="signupForm.$submitted || signupForm.firstname.$touched">
                            @include('front.includes.message',['maxlength'=>'100'])
                        </div>
                    </div>

                    <div class="mobile-nu-block input-first" ng-class="{ 'has-error': signupForm.lastname.$touched && signupForm.lastname.$invalid }">
                            <input type="text" name="lastname" ng-model="signupuser.lastname" ng-maxlength="100"  ng-required="true" placeholder="<?php echo (preg_replace('#<[^>]+>#',' ',translation('last_name')));?>">
                            <span class="highlight"></span>
                            <div class="error-new-block ng-cloak" ng-messages="signupForm.lastname.$error" ng-if="signupForm.$submitted || signupForm.lastname.$touched">
                                @include('front.includes.message',['maxlength'=>'100'])
                            </div>
                    </div>


                   <div class="mobile-nu-block input-first" ng-class="{ 'has-error': signupForm.email.$touched && signupForm.email.$invalid }">
                          <input type="email" name="email" ng-model="signupuser.email" ng-required="true" ng-pattern="/^[a-z]+[a-z0-9._]+@[a-z0-9._]+\.[a-z.]{2,5}$/" ng-blur="checkEmailExist()" placeholder="<?php echo (preg_replace('#<[^>]+>#',' ',translation('pemailp')));?>">
                           <span class="highlight"></span>
                            <div class="error-new-block ng-cloak"  ng-messages="signupForm.email.$error" ng-if="signupForm.$submitted || signupForm.email.$touched">
                                @include('front.includes.message')
                                <p id="err_email" class="error"></p>
                            </div>
                    </div>


                    <div class="mobile-nu-block input-first" ng-class="{ 'has-error': signupForm.phone.$touched && signupForm.phone.$invalid }">
                        <input type="text" name="phone" ng-model="signupuser.phone" ng-minlength="6" ng-maxlength="16" ng-required="true" ng-pattern="/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/" ng-blur="checkMobileExist()" placeholder="<?php echo (preg_replace('#<[^>]+>#',' ',translation('contact_number')));?>">
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
                                ng-required="true" placeholder="<?php echo (preg_replace('#<[^>]+>#',' ',translation('password')));?>">
                         <span class="highlight"></span>
                        <div class="error-new-block ng-cloak" ng-messages="signupForm.password.$error" ng-if="signupForm.$submitted || signupForm.password.$touched">
                        <?php 
                        $password_pattern = preg_replace('#<[^>]+>#',' ',translation('password_pattern'));
                        ?>
                        @include('front.includes.message',['minlength'=>'6'])
                        </div>
                  </div>

                   <div class="mobile-nu-block input-first" ng-class="{ 'has-error': signupForm.confirmpassword.$touched && signupForm.confirmpassword.$invalid }">
                  <input  type="password" name="confirmpassword" id="confirmpassword" 
                            ng-model="signupuser.confirmpassword" 
                            ng-required="true" 
                            pw-check="password" placeholder="<?php echo (preg_replace('#<[^>]+>#',' ',translation('confirm_password')));?>">
                    <span class="highlight"></span>
                    <div class="error-new-block ng-cloak" ng-messages="signupForm.confirmpassword.$error" ng-if="signupForm.$submitted || signupForm.confirmpassword.$touched">
                        @include('front.includes.message')
                        <p ng-show="signupForm.confirmpassword.$error.pwmatch" class="error"><?php echo (preg_replace('#<[^>]+>#',' ',translation('passwords_do_not_match')));?></p>

                    </div>
                    </div>

                    [[ signupForm.$errors ]]

                  <button class="login-btn" type="submit"><?php echo (preg_replace('#<[^>]+>#',' ',translation('register')));?></button>

                </form>
              </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 display-flex hidden-xs">
              <div class="login-right-side">
                <a class="close-login-modal" data-dismiss="modal">
                  <i class="icon-close"></i>
                </a>
                <h3><?php echo (preg_replace('#<[^>]+>#',' ',translation('login')));?></h3>
                <p><?php echo (preg_replace('#<[^>]+>#',' ',translation('psed_ut_perspiciatis_unde_omnis_iste_natus_voluptatem_accusantium_doloremque_laudantiump')));?></p>
                <button onclick="openLoginModal()"><?php echo (preg_replace('#<[^>]+>#',' ',translation('login')));?></button>
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
              <div class="login-left-side">
                <a class="close-login-modal visible-mobile-flex" data-dismiss="modal"><i class="icon-close"></i></a>
                <form class="login-modal-form" name="forgetPasswordForm" ng-submit="forgetPasswordForm.$valid && storeForgetPassword()" novalidate>
                <p class="forget-field-back"><a onclick="openLoginModal()"><i class="icon-back"></i><?php echo (preg_replace('#<[^>]+>#',' ',translation('back')));?></a></p>
                 <h2><?php echo translation('forget_password');?></h2>
                <p><?php echo (preg_replace('#<[^>]+>#',' ',translation('pdont_worry_if_you_forget_your_password_it_takes_few_minutes_to_recover_your_passwordp')));?></p>
                 <div id="forget_status_msg"></div>
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
                  <button><?php echo translation('submit');?></button>
                </form>
              </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 display-flex hidden-xs">
              <div class="login-right-side">
                <a class="close-login-modal" data-dismiss="modal"><i class="icon-close"></i></a>
                <h3><?php echo translation('sign_up');?></h3>
                <p><?php echo (preg_replace('#<[^>]+>#',' ',translation('pdont_have_an_account_create_your_account_it_takes_less_than_a_minutep')));?></p>
                <button onclick="openSignUpModal()"><?php echo translation('sign_up');?></button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- FORGET MODAL EOF -->
  <!-- HEADER BEGIN -->
  <header class="container-fluid header <?php echo $isController == "HomeController@index"?"first-screen":"" ?>">
    @if($isController == "HomeController@index")
    <div class="scroll-down scroll"><a href="#our-products"><i class="icon-long-arrow-down"></i></a></div>
    @endif
    <!--<div class="header-wave-one"></div>-->
    

    
    <!--<div class="header-wave-two"></div>-->
    <div class="header-overlay"></div>   
    <div class="row">
      <div class="container">
        <div class="row">
        @if(!\Session::has('userLogged'))
        <!--Before login starts here-->
          <div class="col-xs-12 animate-top-menu">
            <nav class="navbar navbar-art">
              <!-- Brand and toggle get grouped for better mobile display -->
              <div class="navbar-header">
                <ul class="nav navbar-nav navbar-right visible-mobile-flex">
                  <li class="lang">
                     <div class="wrapper-dropdown-1" id="dd">
                        <span id="new_word">
                           @if(App::getLocale()=='en')
                            <a class="font-size-a" onclick="changeLanguage('ar');">
                              العربية
                            </a>
                            @elseif(App::getLocale()=='ar')
                             <a onclick="changeLanguage('en');" class="hidden-xs">
                              English
                              </a>
                              <a onclick="changeLanguage('en');" class="hidden-lg hidden-md hidden-sm">
                              Eng
                              </a>
                            @endif
                        </span>
                     </div>
                  </li> 
                  <li class="login-button"><a href="#" data-toggle="modal" data-target="#login-modal"><?php echo translation('login');?></a></li>
                  <li class="sign-up-button"><a href="#" data-toggle="modal" data-target="#sign-up-modal"><?php echo translation('sign_up');?></a></li>
                </ul>
                <a class="navbar-brand hidden-xs" href="{{url('/')}}"><img src="{{url('front-assets')}}/images/logo.svg" alt="Logo"></a>
                <a class="navbar-brand visible-mobile-flex" href="#"><img src="{{url('front-assets')}}/images/logo.svg" alt="Logo"></a>
              </div>
              <!-- Collect the nav links, forms, and other content for toggling -->
              <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                   <li class="lang">
                     <div class="wrapper-dropdown-1" id="dd">
                        <span id="new_word">
                           @if(App::getLocale()=='en')
                           <a class="font-size-a" onclick="changeLanguage('ar');">
                              العربية
                            </a>
                            @elseif(App::getLocale()=='ar')
                            <a onclick="changeLanguage('en');" class="hidden-xs">
                              English
                              </a>
                              <a onclick="changeLanguage('en');" class="hidden-lg hidden-md hidden-sm">
                              Eng
                              </a>
                            @endif
                        </span>
                     </div>
                  </li> 
                  <li class="login-button"><a href="#" data-toggle="modal" data-target="#login-modal"><?php echo translation('login');?></a></li>
                  <li class="sign-up-button"><a href="#" data-toggle="modal" data-target="#sign-up-modal"><?php echo translation('sign_up');?></a></li>
                </ul>
              </div><!-- /.navbar-collapse -->
            </nav>
          </div>
          <!--Before login ends here-->
          @else
          <!--After login starts here-->
          <div class="col-xs-12">
            <nav class="navbar navbar-art">
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
              <div class="navbar-header">
                <ul class="nav navbar-nav navbar-right visible-mobile-flex">
                  <li class="lang">
                     <div class="wrapper-dropdown-1" id="dd">
                        <span id="new_word">
                           @if(App::getLocale()=='en')
                           <a class="font-size-a" onclick="changeLanguage('ar');">
                              العربية
                            </a>
                            @elseif(App::getLocale()=='ar')
                            <a onclick="changeLanguage('en');" class="hidden-xs">
                              English
                              </a>
                              <a onclick="changeLanguage('en');" class="hidden-lg hidden-md hidden-sm">
                              Eng
                              </a>
                            @endif
                        </span>
                     </div>
                  </li> 
                  <li><a href="{{url('').'/user/my-cart/'}}"><i class="icon-shopping-cart"><span id="myCartCount">{{$cartCount or '0'}}</span></i></a></li>
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                       <span class="img-block-user">
                         @if($profile_image !='')
                         <img  id="header_profile_img" src="{{ url('/').'/uploads/all_users/'.$loginId.'/profile/thumb_107X107_'.$profile_image}}"/>
                          @endif
                    </span> <span class="hidden-xs">{{$arr_logged_user['full_name'] or ''}} </span><span class="icon-arrow_down"></span>
                    </a>
                    <ul class="dropdown-menu">
                      <li><a href="{{url('/user/dashboard')}}"><i class="icon-home"></i><?php echo translation('dashboard');?></a></li>
                        <li><a href="{{url('/user/account')}}"><i class="icon-account-settings"></i><?php echo translation('account_settings');?></a></li>
                        <li><a href="{{url('/user/logout')}}"><i class="icon-logout"></i><?php echo translation('logout');?></a></li>
                    </ul>
                  </li>
                </ul>
                <a class="navbar-brand" href="{{url('/')}}"><img src="{{url('front-assets')}}/images/logo.svg" alt="Logo"></a>
              <div class="languag-head">
               
                </div>
               </div>
              
              <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                  <li class="lang">
                     <div class="wrapper-dropdown-1" id="dd">
                    <span id="new_word">
                       @if(App::getLocale()=='en')
                       <a onclick="changeLanguage('ar');">
                          العربية
                        </a>
                        @elseif(App::getLocale()=='ar')
                        <a onclick="changeLanguage('en');">
                          English
                          </a>
                        @endif
                    </span>
                 </div>
                  </li> 
                  <li><a href="{{url('').'/user/my-cart/'}}"><i class="icon-shopping-cart"><span id="myCartCount">{{$cartCount or '0'}}</span></i></a></li>
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">

                    <span class="img-block-user">
                         @if($profile_image !='')
                         <img  id="header_profile_img" src="{{ url('/').'/uploads/all_users/'.$loginId.'/profile/thumb_107X107_'.$profile_image}}"/>
                          @endif
                        </span><span class="hidden-xs">{{$arr_logged_user['full_name'] or ''}}</span> <span class="icon-arrow_down"></span>
                     
                    </a>
                    <ul class="dropdown-menu">
                       <li><a href="{{url('/user/dashboard')}}"><i class="icon-home"></i><?php echo translation('dashboard');?></a></li>
                        <li><a href="{{url('/user/account')}}"><i class="icon-account-settings"></i><?php echo translation('account_settings');?></a></li>
                        <li><a href="{{url('/user/logout')}}"><i class="icon-logout"></i><?php echo translation('logout');?></a></li>
                    </ul>
                  </li>
                </ul>
              </div>
            </nav>
          </div>
          <!--After login ends here-->
          @endif
          @if($isController == "HomeController@index")
            <div class="col-lg-10 col-lg-offset-1 col-xs-12 first-screen-desc text-center">
              <h1 class="element"></h1>
              <p><?php echo (preg_replace('#<[^>]+>#',' ',translation('pnbspnor_again_is_there_anyone_who_loves_or_pursues_or_desires_to_obtain_pain_of_itself_because_it_is_pain_but_because_occasionally_circumstances_occur_in_which_toilp')));?></p>
              <!--<p class="hidden-xs printer-pic">-->
                <!--<img src="{{url('front-assets')}}/images/icon-print.png" alt="">-->
              <!--</p>-->
            </div>
          @endif
        </div>
      </div>
    </div>
  </header>
  <!-- HEADER EOF -->
  <script type="text/javascript">
    function changeLanguage(lang) {
    window.location.href=site_url+'/set_lang/'+lang;
  }
</script>

