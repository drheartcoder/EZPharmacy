<!-- FOOTER BEGIN -->
{{csrf_field()}}
  <footer id="footer" class="container-fluid footer">
    <div class="row">
      <div class="container">
        <div class="row">
          <div class="col-lg-4 col-sm-4 col-xs-12">
            <div class="footer-logo">
              <img src="{{url('front-assets')}}/images/logo.svg" alt="Logo">
              <p>{{$arr_site_settings['meta_desc'] or ''}}</p>
            </div>
          </div>
          <div class="col-lg-3 col-sm-4 col-xs-12 col-lg-offset-1 footer-internal-links">
            <h3><?php echo translation('internal_links');?></h3>
            <ul>
              <li><a class="<?php  echo Request::segment(2) == 'about-us'?'active':'';  ?>" href="{{url('')}}/page/about-us/"><?php echo (preg_replace('#<[^>]+>#',' ',translation('about_us')));?></a></li>
              <li><a class="<?php  echo Request::segment(1) == 'faq'?'active':'';  ?>" href="{{url('')}}/faq/"><?php echo (preg_replace('#<[^>]+>#',' ',translation('faqs')));?></a></li>
              <li><a class="<?php  echo Request::segment(1) == 'privacy-policy'?'active':''; ?>" href="{{url('')}}/page/privacy-policy/"><?php echo (preg_replace('#<[^>]+>#',' ',translation('privacy_policy')));?></a></li>
              <li><a href="{{url('')}}/pick_up_locations/"><?php echo (preg_replace('#<[^>]+>#',' ',translation('ppickup_locationsp')));?></a></li>
              <li><a class="<?php  echo Request::segment(1) == 'terms-and-conditions'?'active':'';?>" href="{{url('')}}/page/terms-and-conditions/"><?php echo (preg_replace('#<[^>]+>#',' ',translation('terms_and_conditions')));?></a></li>
              <li><a class="<?php  echo Request::segment(2) == 'contact-us'?'active':'';  ?>" href="{{url('')}}/page/contact-us/"><?php echo (preg_replace('#<[^>]+>#',' ',translation('contact_us')));?></a></li>
            </ul>
          </div>
          <div class="col-lg-4 col-sm-4 col-xs-12">
            <div class="footer-print">
              <h4><?php echo (preg_replace('#<[^>]+>#',' ',translation('pprintp')));?></h4>
              <p>{{$arr_site_settings['site_name'] or ''}},{{$arr_site_settings['site_address'] or ''}}</p>
              <p><?php echo (preg_replace('#<[^>]+>#',' ',translation('pfor_suggestions_and_complaints_you_can_reach_us_via_whatsappp')));?> {{$arr_site_settings['site_contact_number'] or ''}}</p>
<!--
              <ul class="footer-social">
                <li><a target="blank" href="{{$arr_site_settings['fb_url'] or ''}}" class="icon-facebook"></a></li>
                <li><a target="blank" href="{{$arr_site_settings['twitter_url'] or ''}}" class="icon-twitter"></a></li>
                <li><a target="blank" href="{{$arr_site_settings['instagram_url'] or ''}}" class="icon-instagram"></a></li>
              </ul>
              
-->
              
              <ul class="footer-social">
                <li><a target="blank" href="{{$arr_site_settings['fb_url'] or ''}}"><i class="fa fa-facebook"></i> </a></li>
                <li><a target="blank" href="{{$arr_site_settings['twitter_url'] or ''}}" ><i class="fa fa-twitter"></i></a></li>
              <!--  <li><a target="blank" href="{{$arr_site_settings['youtube_url'] or 'https://www.youtube.com'}}" class="icon-youtube"></a></li>
                <li><a target="blank" href="{{$arr_site_settings['linked_in_url'] or ''}}" class="icon-linkedin"></a></li>-->
                <li><a target="blank" href="{{$arr_site_settings['instagram_url'] or ''}}"> <i class="fa fa-instagram"></i></a></li>
              </ul>
              
              
            </div>
          </div>
           <div class="col-xs-12 text-center footer-copy">

          <span>© <?php echo translation('copyright');?> {{date('Y')}}<a href="{{url('/')}}">  {{$arr_site_settings['site_name'] or ''}}</a> <?php echo translation('all_rights_reserved');?> <a href="{{url('')}}/page/privacy-policy"><?php echo translation('privacy_policy');?></a></span>

          {{--  <span>© Copyright {{date('Y')}} <a href="{{url('/')}}">  {{config('app.project.name')}}</a> All rights reserved. <a href="{{url('')}}/page/privacy-policy/">Privacy Policy.</a></span> --}}
        </div>
        </div>
      </div>
    </div>
<!--Start of Zendesk Chat Script-->
<script type="text/javascript">
window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
$.src="https://v2.zopim.com/?5ExxvCTfSZbP9dD7IR6FmwiXXOuqJ4BM";z.t=+new Date;$.
type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
</script>
<!--End of Zendesk Chat Script-->
</footer>
          
<!-- FOOTER EOF -->
