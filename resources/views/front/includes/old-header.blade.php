<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <meta property="og:title" content="printing" />
      <meta property="og:type" content="website" />
      <meta property="og:url" content="http://www.webwingtechnologies.com/" />
      <meta property="og:image" content="{{url('').'/front-assets/'}}images/logo.png" />
      <meta property="og:description" content="printing" />
      <meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />

      <title><?php echo $pageTitle; ?> | <?php echo (preg_replace('#<[^>]+>#',' ',translation('printing')));?></title>
      <!-- ==============================New files========================================== -->
        <link href="{{url('front-assets')}}/css/slick.css" rel="stylesheet">
        <link href="{{url('front-assets')}}/css/style.css" rel="stylesheet">
        <link href="{{url('front-assets')}}/css/googleapis.css" rel="stylesheet">
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
      <link href="{{ url('/') }}/assets/alert/css/alert.css" rel="stylesheet" />
      <link href="{{ url('/') }}/assets/alert/themes/default/theme.css" rel="stylesheet" />
      <script type="text/javascript" language="javascript" src="{{url('front-assets')}}/js/jquery-1.11.3.min.js"></script>
      <script type="text/javascript"> var SITE_URL = "{{ url('/') }}"; </script>

      <link href="{{url('front-assets')}}/css/dropzone.css" rel="stylesheet" type="text/css" />
      <!-- <script src="js/ui-bootstrap-tpls-2.4.0.min.js" type="text/javascript"></script>-->
     



      <!--   Angular Start Here-->
      <script src="{{url('front-assets')}}/js/angular/angular.js"></script>
      <script src="{{url('front-assets')}}/js/angular/angular-route.js"></script>
      <!--angular message js-->
       <script src="{{url('front-assets')}}/js/bootstrap.min.js"></script>
      
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
      <script src="{{url('front-assets')}}/js/dropzone.min.js" type="text/javascript"></script>

      <!--  Capcha end -->
      <!--   Angular End Here-->
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
   </head>
   <body ng-app="printingStore">      
   <div id="main"></div>
    <?php
        $url1 =$url2 = '';
        $url1 = Request::segment(1);
        $url2 = Request::segment(2);

    ?>
    <script type="text/javascript">
      var your_are_verified_successfully  = '<?php echo (preg_replace('#<[^>]+>#',' ',translation('your_are_verified_successfully')));?>';
      var success                         = '<?php echo (preg_replace('#<[^>]+>#',' ',translation('psuccessp')));?>';
      var pdangerp                        = '<?php echo (preg_replace('#<[^>]+>#',' ',translation('pdangerp')));?>';
      var your_have_already_verified_your_account = '<?php echo (preg_replace('#<[^>]+>#',' ',translation('your_have_already_verified_your_account')));?>';
      var you_have_already_verified_your_account_please_sign_in_enjoy_our_services = '<?php echo (preg_replace('#<[^>]+>#',' ',translation('you_have_already_verified_your_account_please_sign_in_enjoy_our_services')));?>';
      var your_password_has_been_reset_successfully = '<?php echo (preg_replace('#<[^>]+>#',' ',translation('your_password_has_been_reset_successfully')));?>';

      var your_unsubscribe_successfully = '<?php echo (preg_replace('#<[^>]+>#',' ',translation('your_unsubscribe_successfully')));?>';
      var error_occure_while_unsubscribe_your_email = '<?php echo (preg_replace('#<[^>]+>#',' ',translation('error_occure_while_unsubscribe_your_email')));?>';
      var your_unsubscribe_allready = '<?php echo (preg_replace('#<[^>]+>#',' ',translation('your_unsubscribe_allready')));?>';
        /*CHECK USER VERIFICATION */
            $(document).ready(function(){
                var url1 = '<?php echo $url1; ?>';
                
                if(url1 != '' && url1 == 'verified')
                {
                  var str = makeStatusMessageHtml(success,your_are_verified_successfully);
                   $("#login_status_msg").html(str);
                   $("#login-model").modal();
                }
                else if(url1 != '' && url1 == 'preverified')
                {
                   var str = makeStatusMessageHtml(pdangerp,your_have_already_verified_your_account);
                   $("#login_status_msg").html(str);
                   $("#login-model").modal();
                }
                else if(url1 != '' && url1 == 'link_error')
                {
                   var str = makeStatusMessageHtml(pdangerp,you_have_already_verified_your_account_please_sign_in_enjoy_our_services);
                   $("#login_status_msg").html(str);
                   $("#login-model").modal();
                }
                else if(url1 != '' && url1 == 'success-resetpassword')
                {
                   var str = makeStatusMessageHtml(success,your_password_has_been_reset_successfully);
                   $("#login_status_msg").html(str);
                   $("#login-model").modal();
                   //alert(str+"helllo   ....................!");
                }
                else if(url1 !='' && url1=="success-unsubscribe")
                {
                  var str = makeStatusMessageHtml(success,your_unsubscribe_successfully);
                   $("#popup_status_msg").html(str);
                   $("#popup-status-model").modal();
                }
                else if(url1 !='' && url1=="error-unsubscribe")
                {
                   var str = makeStatusMessageHtml(pdangerp,error_occure_while_unsubscribe_your_email);
                   $("#popup_status_msg").html(str);
                   $("#popup-status-model").modal();
                }
                else if(url1 !='' && url1=="allready-unsubscribe")
                {
                   var str = makeStatusMessageHtml(pdangerp,your_unsubscribe_allready);
                   $("#popup_status_msg").html(str);
                   $("#popup-status-model").modal();
                }
                else if(url1 !='' && url1=="blocked")
                {
                   var blocked_msg = '';
                   blocked_msg = '<?php echo (preg_replace('#<[^>]+>#',' ',translation('your_account_is_blocked_by_admin_please_contact_to_admin')));?>';
                   var str_html = makeStatusMessageHtml('danger',blocked_msg);
                   $("#login_status_msg").html(str_html);
                   setTimeout(function(){ $("#login_status_msg").html(''); }, 10000);
                   $("#login-model").modal();
                }
                
            });
            function makeStatusMessageHtml(status, message)
            {
                str = '<div class="alert alert-'+status+'">'+
                '<a aria-label="close" data-dismiss="alert" class="close" href="#">'+'×</a>'+message+
                '</div>';
                return str;
            }
    </script>

   @include('front.includes.topmenu')
   
   

   