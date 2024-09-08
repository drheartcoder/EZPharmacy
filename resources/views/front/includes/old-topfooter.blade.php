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
                 <?php echo (preg_replace('#<[^>]+>#',' ',translation('printing_manager')));?>
               </div>
               <div class="menu_name">
                  <div class="footer-content-block">
                     {{$arr_site_settings['meta_desc'] or config('app.project.name') }}
                     <a class="more-txt-block" href="{{url('')}}/page/about-us"><?php echo (preg_replace('#<[^>]+>#',' ',translation('more')));?>...</a>
                  </div>
               </div>
            </div>
            <div class="col-sm-12 col-md-3 col-lg-3">
               <div class="footer_heading footer-col-head">
                  <?php echo (preg_replace('#<[^>]+>#',' ',translation('internal_links')));?>
               </div>
               <div class="menu_name points-footer">
                  <ul>
                     <li><a class="<?php echo Request::segment(2) == 'about-us'?'active':'';  ?>" href="{{url('')}}/page/about-us/"><?php echo (preg_replace('#<[^>]+>#',' ',translation('about_us')));?></a></li>
                     <li><a class="<?php echo Request::segment(2) == 'how-it-works'?'active':'';  ?>" href="{{url('')}}/page/how-it-works/"><?php echo (preg_replace('#<[^>]+>#',' ',translation('how_it_works')));?></a></li>
                     <li><a onclick="location.href='{{url('')}}/products/';" class="<?php echo Request::segment(2) == 'products'?'active':'';  ?>" href="{{url('').'/products/'}}"><?php echo (preg_replace('#<[^>]+>#',' ',translation('our_products')));?></a></li>
                     <li><a class="<?php echo Request::segment(2) == 'corporate-solutions'?'active':'';  ?>" href="{{url('')}}/page/corporate-solutions/"><?php echo (preg_replace('#<[^>]+>#',' ',translation('corporate_solutions')));?></a></li>
                     <li><a class="<?php echo Request::segment(1) == 'faq'?'active':'';  ?>" href="{{url('')}}/faq/"><?php echo (preg_replace('#<[^>]+>#',' ',translation('faqs')));?></a></li>

                     <li><a class="<?php echo Request::segment(1) == 'privacy-policy'?'active':''; ?>" href="{{url('')}}/page/privacy-policy/"><?php echo (preg_replace('#<[^>]+>#',' ',translation('privacy_policy')));?></a></li>
                     <li><a class="<?php echo Request::segment(1) == 'terms-and-conditions'?'active':'';?>" href="{{url('')}}/page/terms-and-conditions/"><?php echo (preg_replace('#<[^>]+>#',' ',translation('terms_and_conditions')));?></a></li>
                     <li><a class="<?php  echo Request::segment(2) == 'contact-us'?'active':'';  ?>" href="{{url('')}}/page/contact-us/"><?php echo (preg_replace('#<[^>]+>#',' ',translation('contact_us')));?></a></li>
                  </ul>
               </div>
            </div>
            <div class="col-sm-12 col-md-3 col-lg-3">
               <div class="footer_heading footer-col-head">
                 <?php echo (preg_replace('#<[^>]+>#',' ',translation('social_media')));?>
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
                 <?php echo (preg_replace('#<[^>]+>#',' ',translation('subscribe')));?>
               </div>
               <div class="menu_name">
                  <div class="points-footer content-subsc">
                    <?php echo (preg_replace('#<[^>]+>#',' ',translation('sign_up_for_our_mailing_list_to_get_latest_updates_and_offers')));?>
                  </div>
                  <div class="confide-txt">
                    <?php echo (preg_replace('#<[^>]+>#',' ',translation('your_mail_id_is_confidential')));?>
                  </div>
                  
                  <form name="subscripeForm" novalidate method="post" >
                    {{csrf_field()}}
                    <div class="subscri-block-new subscri-new-block">
                        <input type="text" name="email_subscribe" id="email_subscribe" placeholder="<?php echo (preg_replace('#<[^>]+>#',' ',translation('enter_your_email_address')));?>" />
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
      <i class="fa fa-copyright"></i><?php echo (preg_replace('#<[^>]+>#',' ',translation('copyright')));?> {{date('Y')}} <a href="{{url('/')}}"> {{config('app.project.name')}}</a><?php echo (preg_replace('#<[^>]+>#',' ',translation('all_rights_reserved')));?><a href="{{url('')}}/page/privacy-policy"><?php echo (preg_replace('#<[^>]+>#',' ',translation('privacy_policy')));?></a>
   </div>
</div>


<footer class="container-fluid footer">
  <div class="row">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-sm-4">
          <div class="footer-logo">
            <img src="{{url("front-assets")}}/images/logo.svg" alt="Logo">
            <p>
              {{$arr_site_settings['meta_desc'] or config('app.project.name') }}
            </p>
          </div>
        </div>
        <div class="col-lg-3 col-sm-4 col-lg-offset-1 footer-internal-links">
          <h3><?php echo translation('internal_links');?></h3>
          <ul>
            <li><a class="<?php  echo Request::segment(2) == 'about-us'?'active':'';  ?>" href="{{url('')}}/page/about-us/"><?php echo translation('about_us');?></a></li>
            <li><a class="<?php  echo Request::segment(1) == 'faq'?'active':'';  ?>" href="{{url('')}}/faq/"><?php echo translation('faqs');?></a></li>
            <li><a class="<?php  echo Request::segment(1) == 'privacy-policy'?'active':''; ?>" href="{{url('')}}/page/privacy-policy/"><?php echo translation('privacy_policy');?></a></li>
            <li><a href="">Pickup Locations</a></li>
            <li><a class="<?php  echo Request::segment(1) == 'terms-and-conditions'?'active':'';?>" href="{{url('')}}/page/terms-and-conditions/"><?php echo translation('terms_and_conditions');?></a></li>
            <li><a class="<?php  echo Request::segment(2) == 'contact-us'?'active':'';  ?>" href="{{url('')}}/page/contact-us/"><?php echo translation('contact_us');?></a></li>
          </ul>
        </div>
        <div class="col-lg-4 col-sm-4">
          <div class="footer-print">
            <h4>Print</h4>
            <p>{{$arr_site_settings['site_name'] or ''}},{{$arr_site_settings['site_address'] or ''}}</p>
            <p>For Suggestions and Complaints, you can reach us via WhatsApp {{$arr_site_settings['site_contact_number'] or ''}}</p>
            <ul class="footer-social">
              <li><a target="blank" href="{{$arr_site_settings['fb_url'] or 'https://www.facebook.com'}}" class="icon-facebook"></a></li>
              <li><a target="blank" href="{{$arr_site_settings['twitter_url'] or 'https://twitter.com'}}" class="icon-twitter"></a></li>
              <li><a target="blank" href="{{$arr_site_settings['youtube_url'] or 'https://youtube.com'}}" class="icon-youtube"></a></li>
              <li><a target="blank" href="{{$arr_site_settings['linked_in_url'] or 'https://www.linkedin.com'}}" class="icon-linkedin"></a></li>
              <li><a target="blank" href="{{$arr_site_settings['instagram_url'] or 'https://www.instagram.com'}}" class="icon-instagram"></a></li>
            </ul>
          </div>
        </div>
        <div class="col-xs-12 text-center footer-copy">
          <span><?php echo translation('copyright');?> {{date('Y')}}<a href="{{url('/')}}">  {{config('app.project.name')}}</a> <?php echo translation('all_rights_reserved');?> <a href="{{url('')}}/page/privacy-policy"><?php echo translation('privacy_policy');?></a></span>
          <span class="footer-designed"><span class="text-yellow">Designed</span> <a href="http://celerart.com">by Webwing</a></span>
        </div>
      </div>
    </div>
  </div>
</footer>

<?php
  $_action = app('request')->route()->getAction(); 
  echo $isController = class_basename($_action['controller']);
  $expl = explode('@',$isController);
?>
<script type="text/javascript" language="javascript" src="{{url('front-assets')}}/js/bootstrap.min.js"></script>
<a class="cd-top hidden-xs hidden-sm" href="#0"><?php echo (preg_replace('#<[^>]+>#',' ',translation('top')));?></a>
<script type="text/javascript" language="javascript" src="{{url('front-assets')}}/js/backtotop.js"></script>
<script type="text/javascript" language="javascript" src="{{url('front-assets')}}/js/wow.min.js"></script>
<script type="text/javascript" src="{{url('front-assets')}}/js/md5.js"></script>
<script src="{{url('front-assets')}}/js/custom_common.js" type="text/javascript"></script>
<!--Sticky Menu-->

@if($isController == "HomeController@index")
<script type="text/javascript">
  var pprice_not_available_for_selected_optionp = "<?php echo (preg_replace('#<[^>]+>#',' ',translation('pprice_not_available_for_selected_optionp')));?>";
  var warning = "<?php echo preg_replace('#<[^>]+>#',' ',translation('warning'));?>";
    var pprice_for_selected_folding_option_is_not_availablep = "<?php echo (preg_replace('#<[^>]+>#',' ',translation('pprice_for_selected_folding_option_is_not_availablep')));?>";
</script>
<script type="text/javascript" src="{{url('')}}/front-assets/js/home-calculate-price.js"></script>
@endif

@if($isController == "UserController@printing_options" || $isController == "UserController@printing_options_edit")
<script type="text/javascript" src="{{url('front-assets')}}/js/jquery.easing.1.3.js"></script>
<script type="text/javascript">
  $(function(){
    $(document).on({
      ajaxStart: function() { $(".ajaxLoader").show();},
      ajaxStop: function() { $(".ajaxLoader").hide(); }    
    });
  });
</script>
@endif
@if($isController == "UserController@order_tracking")
  <script type="text/javascript" src="{{url('')}}/front-assets/js/track-order.js"></script>

  <script type="text/javascript">
  var message = "{{translation('message')}}";
  var pshipment_statusp = "<?php echo (preg_replace('#<[^>]+>#',' ',translation('pshipment_statusp')));?>";
  var pplease_enter_id_for_trackingp = "<?php echo (preg_replace('#<[^>]+>#',' ',translation('pplease_enter_id_for_trackingp')));?>";
  </script>
@endif




@if($isController == "UserController@printing_options_edit")
<script type="text/javascript">
  var please_select_document_type = "<?php echo (preg_replace('#<[^>]+>#',' ',translation('please_select_document_type')));?>";
  var please_wait_server_is_busy = "<?php echo (preg_replace('#<[^>]+>#',' ',translation('please_wait_server_is_busy')));?>";
  var redirecting_to_cart = "<?php echo (preg_replace('#<[^>]+>#',' ',translation('redirecting_to_cart')));?>";
  var add_to_cart = "<?php echo (preg_replace('#<[^>]+>#',' ',translation('add_to_cart')));?>";
  var you_can_not_proceed_this_document = "<?php echo (preg_replace('#<[^>]+>#',' ',translation('you_can_not_proceed_this_document')));?>";
  var warning = "<?php echo (preg_replace('#<[^>]+>#',' ',translation('warning')));?>";
  var paper_type = "<?php echo (preg_replace('#<[^>]+>#',' ',translation('paper_type')));?>";
  var paper_options = "<?php echo (preg_replace('#<[^>]+>#',' ',translation('paper_options')));?>";
  var paper_size = "<?php echo preg_replace('#<[^>]+>#',' ',translation('paper_size'));?>";
  var paper_weight = "<?php echo preg_replace('#<[^>]+>#',' ',translation('paper_weight'));?>";
  var paper_price = "<?php echo preg_replace('#<[^>]+>#',' ',translation('paper_price'));?>";
  var select_size = "<?php echo preg_replace('#<[^>]+>#',' ',translation('select_size'));?>";
  var select_type = "<?php echo preg_replace('#<[^>]+>#',' ',translation('select_type'));?>";
  var select_weight = "<?php echo preg_replace('#<[^>]+>#',' ',translation('select_weight'));?>";
  var binding_options = "<?php echo preg_replace('#<[^>]+>#',' ',translation('binding_options'));?>";
  var add_to_cart = "<?php echo preg_replace('#<[^>]+>#',' ',translation('add_to_cart'));?>";
  var color = "<?php echo preg_replace('#<[^>]+>#',' ',translation('color'));?>";
  var side = "<?php echo preg_replace('#<[^>]+>#',' ',translation('side'));?>";
  var total_price = "<?php echo preg_replace('#<[^>]+>#',' ',translation('total_price'));?>";
  var folding_options = "<?php echo preg_replace('#<[^>]+>#',' ',translation('folding_options'));?>";
  var total_price = "<?php echo preg_replace('#<[^>]+>#',' ',translation('total_price'));?>";
  var edit = "<?php echo preg_replace('#<[^>]+>#',' ',translation('edit'));?>";
  var updating_cart = "<?php echo preg_replace('#<[^>]+>#',' ',translation('updating_cart'));?>";
  var save = "<?php echo preg_replace('#<[^>]+>#',' ',translation('save'));?>";
  var pprice_for_selected_binding_option_is_not_availablep = "<?php echo (preg_replace('#<[^>]+>#',' ',translation('pprice_for_selected_binding_option_is_not_availablep')));?>";
  var pprice_for_selected_folding_option_is_not_availablep = "<?php echo (preg_replace('#<[^>]+>#',' ',translation('pprice_for_selected_folding_option_is_not_availablep')));?>";

  var pprice_not_available_for_selected_optionp = " <?php echo (preg_replace('#<[^>]+>#',' ',translation('pprice_not_available_for_selected_optionp')));?>";
</script>
<script type="text/javascript" src="{{url('')}}/front-assets/js/printing-options-edit.js"></script>
@endif

@if($isController == "UserController@printing_options")
<script type="text/javascript">
  
  var please_select_document_type = "<?php echo preg_replace('#<[^>]+>#',' ',translation('please_select_document_type'));?>";
  var please_wait_server_is_busy = "<?php echo preg_replace('#<[^>]+>#',' ',translation('please_wait_server_is_busy'));?>";
  var redirecting_to_cart = "<?php echo preg_replace('#<[^>]+>#',' ',translation('redirecting_to_cart'));?>";
  var adding_to_cart = "<?php echo preg_replace('#<[^>]+>#',' ',translation('adding_to_cart'));?>";
  var you_can_not_proceed_this_document = "<?php echo preg_replace('#<[^>]+>#',' ',translation('you_can_not_proceed_this_document'));?>";
  var warning = "<?php echo preg_replace('#<[^>]+>#',' ',translation('warning'));?>";
  var paper_type = "<?php echo preg_replace('#<[^>]+>#',' ',translation('paper_type'));?>";
  var paper_options = "<?php echo preg_replace('#<[^>]+>#',' ',translation('paper_options'));?>";
  var paper_size = "<?php echo preg_replace('#<[^>]+>#',' ',translation('paper_size'));?>";
  var paper_weight = "<?php echo preg_replace('#<[^>]+>#',' ',translation('paper_weight'));?>";
  var paper_price = "<?php echo preg_replace('#<[^>]+>#',' ',translation('paper_price'));?>";
  var select_size = "<?php echo preg_replace('#<[^>]+>#',' ',translation('select_size'));?>";
  var select_type = "<?php echo preg_replace('#<[^>]+>#',' ',translation('select_type'));?>";
  var select_weight = "<?php echo preg_replace('#<[^>]+>#',' ',translation('select_weight'));?>";
  var binding_options = "<?php echo preg_replace('#<[^>]+>#',' ',translation('binding_options'));?>";
  var add_to_cart = "<?php echo preg_replace('#<[^>]+>#',' ',translation('add_to_cart'));?>";
  var color = "<?php echo preg_replace('#<[^>]+>#',' ',translation('color'));?>";
  var side = "<?php echo preg_replace('#<[^>]+>#',' ',translation('side'));?>";
  var total_price = "<?php echo preg_replace('#<[^>]+>#',' ',translation('total_price'));?>";
  var folding_options = "<?php echo preg_replace('#<[^>]+>#',' ',translation('folding_options'));?>";
  var save = "<?php echo preg_replace('#<[^>]+>#',' ',translation('save'));?>";
  var edit = "<?php echo preg_replace('#<[^>]+>#',' ',translation('edit'));?>";
  var pprice_not_available_for_selected_optionp = "<?php echo (preg_replace('#<[^>]+>#',' ',translation('pprice_not_available_for_selected_optionp')));?>";
  var pprice_for_selected_binding_option_is_not_availablep = "<?php echo (preg_replace('#<[^>]+>#',' ',translation('pprice_for_selected_binding_option_is_not_availablep')));?>";
  var pprice_for_selected_folding_option_is_not_availablep = "<?php echo (preg_replace('#<[^>]+>#',' ',translation('pprice_for_selected_folding_option_is_not_availablep')));?>";


</script>
<script type="text/javascript" src="{{url('')}}/front-assets/js/printing-options.js"></script>
@endif

@if($isController == "UserController@my_cart")
<script type="text/javascript">
  $(function(){
    $(document).on({
      ajaxStart: function() { $(".ajaxLoader").show();},
      ajaxStop: function() { $(".ajaxLoader").hide(); }    
    });
  });
  var isCartItems = null;
  var add_more_items = "<?php echo preg_replace('#<[^>]+>#',' ',translation('add_more_items'));?>";
  var checkout = "<?php echo preg_replace('#<[^>]+>#',' ',translation('checkout'));?>";
  var subtotal = "<?php echo preg_replace('#<[^>]+>#',' ',translation('subtotal'));?>";
  var your_cart_is_empty = "<?php echo preg_replace('#<[^>]+>#',' ',translation('your_cart_is_empty'));?>";
  var add_items = "<?php echo preg_replace('#<[^>]+>#',' ',translation('add_items'));?>";
  var error_in_loading_your_cart = "<?php echo preg_replace('#<[^>]+>#',' ',translation('error_in_loading_your_cart'));?>";
  var updating_cart = "<?php echo preg_replace('#<[^>]+>#',' ',translation('updating_cart'));?>";
  var error = "<?php echo preg_replace('#<[^>]+>#',' ',translation('error'));?>";
  var error_in_updating_your_cart = "<?php echo preg_replace('#<[^>]+>#',' ',translation('error_in_updating_your_cart'));?>";
  var warning = "<?php echo preg_replace('#<[^>]+>#',' ',translation('warning'));?>";
  var quantity_should_be_between_1_to_99 = "<?php echo preg_replace('#<[^>]+>#',' ',translation('quantity_should_be_between_1_to_99'));?>";
  var are_you_sure_want_to_remove_this_item_from_cart = "<?php echo preg_replace('#<[^>]+>#',' ',translation('are_you_sure_want_to_remove_this_item_from_cart'));?>";
  var removing_item = "<?php echo preg_replace('#<[^>]+>#',' ',translation('removing_item'));?>";
  var error_in_removing_item_from_cart = "<?php echo preg_replace('#<[^>]+>#',' ',translation('error_in_removing_item_from_cart'));?>";
  var processing_fee = "<?php echo preg_replace('#<[^>]+>#',' ',translation('processing_fee'));?>";
  var total_payable = "<?php echo preg_replace('#<[^>]+>#',' ',translation('total_payable'));?>";
  var pconfirmp = "<?php echo preg_replace('#<[^>]+>#',' ',translation('pconfirmp'));?>";
</script>
<script type="text/javascript" src="{{url('')}}/front-assets/js/my-cart.js"></script>
@endif

@if($isController == "UserController@order_checkout")
<link rel="stylesheet" href="https://www.paytabs.com/express/express.css">
<script src="https://www.paytabs.com/express/express_checkout_v3.js"></script>
<script type="text/javascript">
  var deivery_not_available = "<?php echo preg_replace('#<[^>]+>#',' ',translation('deivery_not_available'));?>";
  var same_day_deivery_available = "<?php echo preg_replace('#<[^>]+>#',' ',translation('same_day_deivery_available'));?>";
  var pdelivery_available_on_next_business_dayp = "<?php echo (preg_replace('#<[^>]+>#',' ',translation('pdelivery_available_on_next_business_dayp')));?>";
  var select = "<?php echo (preg_replace('#<[^>]+>#',' ',translation('select')));?>";
  var in_progress = "<?php echo (preg_replace('#<[^>]+>#',' ',translation('in_progress')));?>";
  var message = "<?php echo (preg_replace('#<[^>]+>#',' ',translation('message')));?>";
  var please_select_delivery_location = "<?php echo (preg_replace('#<[^>]+>#',' ',translation('please_select_delivery_location')));?>";
  var we_do_not_deliver_in_selected_location = "<?php echo (preg_replace('#<[^>]+>#',' ',translation('we_do_not_deliver_in_selected_location')));?>";
  var please_select_other_location_or_add_new_location = "<?php echo (preg_replace('#<[^>]+>#',' ',translation('please_select_other_location_or_add_new_location')));?>";
   var warning = "<?php echo (preg_replace('#<[^>]+>#',' ',translation('warning')));?>";

  var pdelivery = "<?php echo (preg_replace('#<[^>]+>#',' ',translation('pdelivery_chargep')));?>";
  var pdelivery_chargep = $(pdelivery).text();
 
  var please_fill_required_details = "<?php echo (preg_replace('#<[^>]+>#',' ',translation('please_fill_required_details')));?>";
  var warning = "<?php echo preg_replace('#<[^>]+>#',' ',translation('warning'));?>";
  var you_dont_have_sufficient_amount_in_your_wallet = "<?php echo (preg_replace('#<[^>]+>#',' ',translation('you_dont_have_sufficient_amount_in_your_wallet')));?>";
  var new_address = "<?php echo (preg_replace('#<[^>]+>#',' ',translation('new_address')));?>";
  var close = "<?php echo (preg_replace('#<[^>]+>#',' ',translation('close')));?>";
  var please_wait = "<?php echo (preg_replace('#<[^>]+>#',' ',translation('please_wait')));?>";
  var please_use_paytabs_to_pay = "<?php echo (preg_replace('#<[^>]+>#',' ',translation('please_use_paytabs_to_pay')));?>";
  var _continue = "<?php echo (preg_replace('#<[^>]+>#',' ',translation('continue')));?>";
  function loadPaytabs(_finalPrice)
  {
    Paytabs("#express_checkout_v3").expresscheckout({
        settings:{
            secret_key: "{{config('services.paytabs.secret_key')}}",
            merchant_id: "{{config('services.paytabs.merchant_id')}}",
            amount: _finalPrice,
            currency: "{{config('services.paytabs.currency')}}",
            language: "en",
            title: "Prinitng Amount",
            product_names: "Prinitng Amount SAR "+_finalPrice,
            order_id: "{{strtoupper(uniqid())}}",
            url_redirect: SITE_URL+"{{config('services.paytabs.cart_success_url')}}",
            show:1,
            display_customer_info:0,
            display_billing_fields:0,
            display_shipping_fields:0,
            redirect_on_reject:1,
        },
        customer_info:{
            first_name: "{{$userData[0]->first_name}}",
            last_name: "{{$userData[0]->last_name}}",
            phone_number: "{{$userData[0]->mobile_number}}",
            country_code: "{{$userData[0]->phone_code}}",
            email_address: "{{$userData[0]->email_address}}"            
        },
        billing_address:{
            full_address: "{{$userData[0]->address}}",
            city: "{{$userData[0]->city_title}}",
            state: "{{$userData[0]->city_title}}",
            country: "{{$userData[0]->country_code}}",
            postal_code: "{{$userData[0]->zipcode}}"
        },
        checkout_button:{
            width: 255,
            height: 100,
            img_url: "https://www.paytabs.com/seals/08.png"
        },
        /*pay_button:{
            width: 150,
            height: 30,
            img_url: "https://www.paytabs.com/seals/06.png"
        }*/
    });
  }

</script>
<script type="text/javascript" src="{{url('')}}/front-assets/js/order-checkout.js"></script>
<script type="text/javascript">
  var pshipment_chargep = "<?php echo (preg_replace('#<[^>]+>#',' ',translation('pshipment_chargep')));?>";
  var pplease_wait_calculating_shipment_chargesp = "<?php echo (preg_replace('#<[^>]+>#',' ',translation('pplease_wait_calculating_shipment_chargesp')));?>";
  var pplease_wait_while_we_are_creating_shipmentp = "<?php echo (preg_replace('#<[^>]+>#',' ',translation('pplease_wait_while_we_are_creating_shipmentp')));?>";
  var pcontinue_shippingp = "<?php echo (preg_replace('#<[^>]+>#',' ',translation('pcontinue_shippingp')));?>";
  var pchange_detailsp = "<?php echo (preg_replace('#<[^>]+>#',' ',translation('pchange_detailsp')));?>";
</script>
@endif

@if($isController == "UserController@create_document")
<script type="text/javascript">
  var are_you_sure_want_to_cancel = "<?php echo (preg_replace('#<[^>]+>#',' ',translation('are_you_sure_want_to_cancel')));?>";
  var filename_already_exists_please_change_filename = "<?php echo (preg_replace('#<[^>]+>#',' ',translation('filename_already_exists_please_change_filename')));?>";
  var unable_to_convert_file = "<?php echo (preg_replace('#<[^>]+>#',' ',translation('unable_to_convert_file')));?>";
  var please_check_your_file = "<?php echo (preg_replace('#<[^>]+>#',' ',translation('please_check_your_file')));?>";
  var try_again = "<?php echo (preg_replace('#<[^>]+>#',' ',translation('try_again')));?>";
  var something_went_wrong_please_try_again = "<?php echo (preg_replace('#<[^>]+>#',' ',translation('something_went_wrong_please_try_again')));?>";
  var error_in_uploading_your_file_please_try_again = "<?php echo (preg_replace('#<[^>]+>#',' ',translation('error_in_uploading_your_file_please_try_again')));?>";
  var articles_could_not_be_loaded = "<?php echo (preg_replace('#<[^>]+>#',' ',translation('articles_could_not_be_loaded')));?>";
  var error = "<?php echo (preg_replace('#<[^>]+>#',' ',translation('error')));?>";
  var warning = "<?php echo preg_replace('#<[^>]+>#',' ',translation('warning'));?>";
  var click_here_to_upload_your_file_for_printing = "<?php echo preg_replace('#<[^>]+>#',' ',translation('click_here_to_upload_your_file_for_printing'));?>";
  var pyour_file_must_be_convertare_you_sure_want_to_continuep = "<?php echo (preg_replace('#<[^>]+>#',' ',translation('pyour_file_must_be_convertare_you_sure_want_to_continuep')));?>";
  var pconfirmp = "<?php echo preg_replace('#<[^>]+>#',' ',translation('pconfirmp'));?>";
 
  var pconverted_file_might_be_different_from_actual_filep = "<?php echo (preg_replace('#<[^>]+>#',' ',translation('pconverted_file_might_be_different_from_actual_filep')));?>";

</script>
<script type="text/javascript" src="{{url('')}}/front-assets/js/create-document.js"></script>
@endif

@if($isController == "UserController@my_wallet")
<script type="text/javascript">
  var payTabAmt = 0;
  var warning = "<?php echo preg_replace('#<[^>]+>#',' ',translation('warning'));?>";
  var error = "<?php echo preg_replace('#<[^>]+>#',' ',translation('error'));?>";
  var wallet_amount_must_be_greater_than_0zero = "<?php echo preg_replace('#<[^>]+>#',' ',translation('wallet_amount_must_be_greater_than_0zero'));?>";
</script>
<script type="text/javascript" src="{{url('')}}/front-assets/js/my-wallet.js"></script>
@endif
<!--   Home Slider Start Here-->
<script type="text/javascript">

 var this_field_needs_to_be_a_valid_email = "<?php echo preg_replace('#<[^>]+>#',' ',translation('this_field_needs_to_be_a_valid_email'));?>";
 var error_occured_while_sending_request = "<?php echo preg_replace('#<[^>]+>#',' ',translation('error_occured_while_sending_request'));?>";
   $('#carousel-example-generic').carousel({
       interval: 4100
   });
   $('#carousel-example-generic-one').carousel({
       interval: 4100
   });

    //CLICK ENTER THEN SEND MESSAGE
    /*$("#email_subscribe").keydown(function(e)
    {
        if(e.which === 13){
            $("#btnSubscribe").trigger('click');
        }
    });*/

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