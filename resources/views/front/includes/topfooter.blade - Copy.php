<style type="text/css">
  .error{color: red;}
  .success{color: green;}
  .info{color: pink;}
</style>
<div class="footer-main-block">
   <div class="container">
      <div class="row">
         <div class="footer-col-block">
            <div class="col-sm-12 col-md-3 col-lg-3">
               <div class="footer_heading footer-col-head">
                 <?php echo translation('printing_manager');?>
               </div>
               <div class="menu_name">
                  <div class="footer-content-block">
                     {{$arr_site_settings['meta_desc'] or config('app.project.name') }}
                     <a class="more-txt-block" href="{{url('')}}/page/about-us"><?php echo translation('more');?>...</a>
                  </div>
               </div>
            </div>
            <div class="col-sm-12 col-md-3 col-lg-3">
               <div class="footer_heading footer-col-head">
                  <?php echo translation('internal_links');?>
               </div>
               <div class="menu_name points-footer">
                  <ul>
                     <li><a class="<?php  echo Request::segment(2) == 'about-us'?'active':'';  ?>" href="{{url('')}}/page/about-us/"><?php echo translation('about_us');?></a></li>
                     <li><a class="<?php  echo Request::segment(2) == 'how-it-works'?'active':'';  ?>" href="{{url('')}}/page/how-it-works/"><?php echo translation('how_it_works');?></a></li>
                     <li><a class="<?php  echo Request::segment(2) == 'our-products'?'active':'';  ?>" href="{{url('')}}/our-products/"><?php echo translation('our_products');?></a></li>
                     <li><a class="<?php  echo Request::segment(2) == 'corporate-solutions'?'active':'';  ?>" href="{{url('')}}/page/corporate-solutions/"><?php echo translation('corporate_solutions');?></a></li>
                     <li><a class="<?php  echo Request::segment(1) == 'faq'?'active':'';  ?>" href="{{url('')}}/faq/"><?php echo translation('faqs');?></a></li>

                     <li><a class="<?php  echo Request::segment(1) == 'privacy-policy'?'active':''; ?>" href="{{url('')}}/page/privacy-policy/"><?php echo translation('privacy_policy');?></a></li>
                     <li><a class="<?php  echo Request::segment(1) == 'terms-and-conditions'?'active':'';?>" href="{{url('')}}/page/terms-and-conditions/"><?php echo translation('terms_and_conditions');?></a></li>
                     <!-- <li><a class="<?php  //echo Request::segment(2) == 'help'?'active':'';  ?>" href="{{url('')}}/page/help"><?php echo translation('help');?></a></li> -->
                     <li><a class="<?php  echo Request::segment(2) == 'contact-us'?'active':'';  ?>" href="{{url('')}}/page/contact-us/"><?php echo translation('contact_us');?></a></li>
                  </ul>
               </div>
            </div>
            <div class="col-sm-12 col-md-3 col-lg-3">
               <div class="footer_heading footer-col-head">
                 <?php echo translation('social_media');?> 
               </div>
               <div class="menu_name points-footer btn-footer">
                  <ul>
                     <li>
                       <a  target="blank" href="{{$arr_site_settings['fb_url'] or 'https://www.facebook.com'}}"><img src="{{url('front-assets')}}/images/fb-btn.png" alt="" /></a>
                     </li>
                     <li>
                        <a target="blank" href="{{$arr_site_settings['twitter_url'] or 'https://twitter.com'}}"><img src="{{url('front-assets')}}/images/twitter.png" alt="" /></a>
                     </li>
                     <li>
                        <a target="blank" href="{{$arr_site_settings['linked_in_url'] or 'https://www.linkedin.com'}}"><img src="{{url('front-assets')}}/images/linkedin.png" alt="" /></a>
                     </li>
                     <li>
                        <a target="blank" href="{{$arr_site_settings['instagram_url'] or 'https://www.instagram.com'}}"><img src="{{url('front-assets')}}/images/instagram.png" alt="" /></a>
                     </li>
                  </ul>
               </div>
            </div>
            <div class="col-sm-12 col-md-3 col-lg-3" ng-controller="PageCtrl">
               <div class="footer_heading footer-col-head last-subscribe">
                 <?php echo translation('subscribe');?>
               </div>
               <div class="menu_name">
                  <div class="points-footer content-subsc">
                    <?php echo translation('sign_up_for_our_mailing_list_to_get_latest_updates_and_offers');?>
                  </div>
                  <div class="confide-txt">
                    <?php echo translation('your_mail_id_is_confidential');?> 
                  </div>
                  
                  <form name="subscripeForm" novalidate method="post" >
                    {{csrf_field()}}
                    <div class="subscri-block-new subscri-new-block">
                        <input type="text" name="email_subscribe" id="email_subscribe" placeholder="<?php echo translation('enter_your_email_address');?>" />
                        <button type="button" id="btnSubscribe" name="btnSubscribe"><i class="fa fa-paper-plane"></i></button>
                        <div class="error" id="err_email_subscribe"></div>
                        <div class="success" id="success_email_subscribe"></div>
                        <div class="info" id="info_email_subscribe"></div>
                        
                     </div>
                  </form>
                  <br/>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="copyright-block">
      <i class="fa fa-copyright"></i><?php echo translation('copyright');?> {{date('Y')}} <a href="{{url('/')}}"> {{config('app.project.name')}}</a> <?php echo translation('all_rights_reserved');?> <a href="{{url('')}}/page/privacy-policy"><?php echo translation('privacy_policy');?></a>
   </div>
</div>

<script type="text/javascript" language="javascript" src="{{url('front-assets')}}/js/bootstrap.min.js"></script>
<a class="cd-top hidden-xs hidden-sm" href="#0"><?php echo translation('top');?></a>
<script type="text/javascript" language="javascript" src="{{url('front-assets')}}/js/backtotop.js"></script>
<script type="text/javascript" language="javascript" src="{{url('front-assets')}}/js/wow.min.js"></script>
<script type="text/javascript" src="{{url('front-assets')}}/js/md5.js"></script>
<script src="{{url('front-assets')}}/js/custom_common.js" type="text/javascript"></script>
<!--Sticky Menu-->

@if($isController == "UserController@printing_options")
<script type="text/javascript">
  var please_select_document_type = "<?php echo translation('please_select_document_type');?>";
  var please_wait_server_is_busy = "<?php echo translation('please_wait_server_is_busy');?>";
  var redirecting_to_cart = "<?php echo translation('redirecting_to_cart');?>";
  var adding_to_cart = "<?php echo translation('adding_to_cart');?>";
  var you_can_not_proceed_this_document = "<?php echo translation('you_can_not_proceed_this_document');?>";
  var warning = "<?php echo translation('warning');?>";
  var paper_type = "<?php echo translation('paper_type');?>";
  var paper_options = "<?php echo translation('paper_options');?>";
  var paper_size = "<?php echo translation('paper_size');?>";
  var paper_weight = "<?php echo translation('paper_weight');?>";
  var paper_price = "<?php echo translation('paper_price');?>";
  var select_size = "<?php echo translation('select_size');?>";
  var select_type = "<?php echo translation('select_type');?>";
  var select_weight = "<?php echo translation('select_weight');?>";
  var binding_options = "<?php echo translation('binding_options');?>";
  var add_to_cart = "<?php echo translation('add_to_cart');?>";
  var color = "<?php echo translation('color');?>";
  var side = "<?php echo translation('side');?>";
  var total_price = "<?php echo translation('total_price');?>";
  var folding_options = "<?php echo translation('folding_options');?>";
  var total_price = "<?php echo translation('total_price');?>";
  var save = "<?php echo translation('save');?>";
  var edit = "<?php echo translation('edit');?>";
</script>
@endif
printing-options.js

<!--   Home Slider Start Here-->
<script type="text/javascript">
 var this_field_needs_to_be_a_valid_email = "<?php echo translation('this_field_needs_to_be_a_valid_email');?>";
 var error_occured_while_sending_request = "<?php echo translation('error_occured_while_sending_request');?>";
   $('#carousel-example-generic').carousel({
       interval: 4100
   });
   $('#carousel-example-generic-one').carousel({
       interval: 4100
   });


    $("#email_subscribe").keydown(function(e)
    {
      if(e.which === 13)
      {
          $("#btnSubscribe").trigger('click');
      }
    });

   $(document).on("click",'#btnSubscribe',function()
   {
    var email_subscribe = $('#email_subscribe').val();
    var flag=1;
    var filter            = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    
    $("#err_email_subscribe").html("");
    $("#success_email_subscribe").html("");
    $("#info_email_subscribe").html("");
    
    if(email_subscribe =='')
    {
     
      $("#err_email_subscribe").html(this_field_needs_to_be_a_valid_email);
      $("#email_subscribe").focus();
      $("#email_subscribe").keyup(function() {   $("#err_email_subscribe").html(''); });
      flag = 0;
    }
    else if(!filter.test(email_subscribe))
    {
      $("#err_email_subscribe").html(this_field_needs_to_be_a_valid_email);
      $("#email_subscribe").focus();
      $("#email_subscribe").keyup(function() {    $("#err_email_subscribe").html(''); });
      flag = 0;
    }
    if(flag==0)
    {
      return false;
    }
    else
    {
        $.ajax({
        headers:{'X-CSRF-Token': $('input[name="_token"]').val()},
        dataType: 'json',
        type:'post',
        url:SITE_URL+'/subscribe',
        data:{email:email_subscribe},  
        beforeSend:function(){console.log("loading ..........!");
          showProcessingOverlay();
        },
        success: function(data) 
        { 
            hideProcessingOverlay();

            if(data.status == "success" )
            {
              $("#success_email_subscribe").html(data.msg);
            }
            else if(data.status == "exist")
            {
              $("#info_email_subscribe").html(data.msg);
            }
            else
            {
              $("#err_email_subscribe").html(data.msg);
            }
            setTimeout(function() {
              $("#err_email_subscribe").html("");
              $("#success_email_subscribe").html("");
              $("#info_email_subscribe").html("");
            }, 3000);
            $('#email_subscribe').val("");
        },
        error: function() 
        {
          hideProcessingOverlay();
          $('#email_subscribe').val("");
          $("#err_email_subscribe").html(error_occured_while_sending_request);
        }
      });
    }
   });

    function showProcessingOverlay()
    {      
       $("body").append("<div  id='global_processing_overlay' class='loading'></div>");    
       $("#global_processing_overlay");                          
    }
    function hideProcessingOverlay()
    {
      $("#global_processing_overlay").remove();
    }
</script>
<!--   Home Slider End Here-->
<!--   Home Tab Start Here-->
<script type="text/javascript" src="{{url('front-assets')}}/js/responsivetabs.js"></script>
<script type="text/javascript">
   $(document).ready(function () {
       $(document).on('responsive-tabs.initialised', function (event, el) {                
       });
       $(document).on('responsive-tabs.change', function (event, el, newPanel) {                
       });
       $('[data-responsive-tabs]').responsivetabs({
           initialised: function () {                    
           },
           change: function (newPanel) {                    
           }
       });
   });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        function checkImg(img) {
            if (img.naturalHeight <= 1 && img.naturalWidth <= 1) {
                // undersize image here
                img.src = "{{url('').'/uploads/default.png' }}";
            }
        }
        $("img").each(function() {
            // if image already loaded, we can check it's height now
            if (this.complete) {
                checkImg(this);
            } else {
                // if not loaded yet, then set load and error handlers
                $(this).load(function() {
                    checkImg(this);
                }).error(function() {
                    // img did not load correctly
                    // set new .src here
                    this.src = "{{url('').'/uploads/default.png' }}";
                });
            }
        });
    });
</script>
<!--Sticky Menu-->
<!--country-language-js-start-here-->
<script type="text/javascript" src="{{url('front-assets')}}/js/language_custom.js"></script>
<script type="text/javascript">
   function DropDown(el) {
       this.dd = el;
       this.placeholder = this.dd.children('span');
       this.opts = this.dd.find('ul.dropdown > li');
       this.val = '';
       this.index = -1;
       this.initEvents();
   }
   DropDown.prototype = {
       initEvents: function () {
           var obj = this;
           obj.dd.on('click', function (event) {
               $(this).toggleClass('active');
               return false;
           });
           obj.opts.on('click', function () {
               var opt = $(this);
               var obj_a = opt.find("a");
               var language_text = obj_a.text();
               $("#new_word").html(obj_a.html());
               //changeLanguage(obj_a);
           });
       },
       getValue: function () {
           return this.val;
       },
       getIndex: function () {
           return this.index;
       }
   }
   $(function () {
   
       var dd = new DropDown($('#dd'));
   
       $(document).click(function () {
           // all dropdowns
           $('.wrapper-dropdown-1').removeClass('active');
       });
   
   });
</script>
<!--country-language-js-close-here-->

<!-- Animation Start Here  -->
<script type="text/javascript">
   $(document).ready(function () {
       /*  Animation */
       wow = new WOW({
           animateClass: 'animated',
           offset: 100,
           callback: function (box) {
               console.log("WOW: animating <" + box.tagName.toLowerCase() + ">")
           }
       });
       wow.init();
       if ($("#moar").length > 0) {
           document.getElementById('moar').onclick = function () {
               var section = document.createElement('section');
               section.className = 'section--purple wow fadeInDown';
               this.parentNode.insertBefore(section, this);
           };
       }
       // footer dropdown links start 
       var min_applicable_width = 991;
   
       $(document).ready(function () {
           applyResponsiveSlideUp($(this).width(), min_applicable_width);
       });
       function applyResponsiveSlideUp(current_width, min_applicable_width) {
           /* Set For Initial Screen */
           initResponsiveSlideUp(current_width, min_applicable_width);
   
           /* Listen Window Resize for further changes */
           $(window).bind('resize', function () {
               if ($(this).width() <= min_applicable_width) {
                   unbindResponsiveSlideup();
                   bindResponsiveSlideup();
               } else {
                   unbindResponsiveSlideup();
               }
           });
       }
       function initResponsiveSlideUp(current_width, min_applicable_width) {
           if (current_width <= min_applicable_width) {
               unbindResponsiveSlideup();
               bindResponsiveSlideup();
           } else {
               unbindResponsiveSlideup();
           }
       }
       function bindResponsiveSlideup() {
           $(".menu_name").hide();
           $(".footer_heading").bind('click', function () {
               var $ans = $(this).parent().find(".menu_name");
               $ans.slideToggle();
               $(".menu_name").not($ans).slideUp();
               $('.menu_name').removeClass('active');
   
               $('.footer_heading').not($(this)).removeClass('active');
               $(this).toggleClass('active');
               $(this).parent().find(".menu_name").toggleClass('active');
           });
       }
       function unbindResponsiveSlideup() {
           $(".footer_heading").unbind('click');
           $(".menu_name").show();
       }
       // footer dropdown links end
   });
</script>

   <!-- Min Top Menu Start Here  -->
<script type="text/javascript">
    
   var doc_width = $(window).width();
   if (doc_width < 1180) {
       
       function openNav() {
           
           document.getElementById("mySidenav").style.width = "250px";
           $("body").css({
               "margin-left": "250px",
               "overflow-x": "hidden",
               "transition": "margin-left .5s",
               "position": "fixed"
           });
           $("#main").addClass("overlay");
       }
       function closeNav() {
           document.getElementById("mySidenav").style.width = "0";
           $("body").css({
               "margin-left": "0px",
               "transition": "margin-left .5s",
               "position": "relative"
           });
           $("#main").removeClass("overlay");
       }
   }
   //  Min Top Sub Menu Start Here
   $(".min-menu > li > .drop-block").click(function () {
       if (false == $(this).next().hasClass('menu-active')) {
           $('.sub-menu > ul').removeClass('menu-active');
       }
       $(this).next().toggleClass('menu-active');
   
       return false;
   });
   // script for hide show of sub menu
   
   //     $('.main-content').click(function(){
   //         $(this).next('.sub-menu').slideToggle('1000');
   //         $(this).find('.arrow i').toggleClass('fa-angle-down fa-angle-up')
   //         });
   $("body").click(function () {
       $('.sub-menu > ul').removeClass('menu-active');
   });
   //  Min Top Sub Menu End Here
</script>
<!-- Animation End Here  -->
<link href="{{url('/')}}/front-assets/css/custom_loader.css" rel="stylesheet" type="text/css" />
<div ng-if="GLOBAL.request_inprogress"
   class="loading">
</div>