<style>.header{background: #fff;background:rgba(255,255,255,1); box-shadow: 0 0 2px rgba(0, 0, 0, 0.24); position: relative;}
    .min-menu li.dash-show{display: block;float: right;}
/*    .min-menu li{display: none;}.min-menu li.lang, .min-menu li.call-no-block, .min-menu li.dash-show{display: inline-block;}#dd .dropdown li{display: block;}*/
</style>
<div class="banner-block-inner">
   <div class="about-overlay"></div>
   <div class="container main-content-head">
      <div class="row">
         <div class="col-sm-6 col-md-8 col-lg-6">
            <div class="page-head-block">
            <span><?php echo translation('frequently_asked_questions');?></span>
            </div>
         </div>
         <div class="col-sm-6 col-md-4 col-lg-6">
            <div class="bread-cum-block">
               <ul>
                  <li><a href="{{url('/')}}"><?php echo (preg_replace('#<[^>]+>#',' ',translation('home')));?></a></li>
                  <li><?php echo (preg_replace('#<[^>]+>#',' ',translation('faqs')));?></li>
               </ul>
            </div>
         </div>
      </div>
   </div>
</div>

<div class="container">
   <div class="row">
      <div class="col-sm-12 col-md-8 col-lg-8">
         
         <form method="GET" action="" >
            <div class="search-main-faq">
               <input type="text" name="q" placeholder="<?php echo (preg_replace('#<[^>]+>#',' ',translation('search_faqs')));?>" value="{{\Request::get('q')}}" />
               <button class="btn-search-container" type="submit"><img src="{{url('/')}}/front-assets/images/search-icon-img.png" alt="" /> </button>
            </div>
         </form>

         @if(isset($arr_faq) && count($arr_faq) > 0)

         <div id='faq_acc'>
            <ul>
               @foreach($arr_faq as $key => $faq)
               <li class='has-sub'>
                  <a href='#'><span>{{$faq->question  or ''}}</span>
                  </a>
                  <ul>
                     <li>
                        <div class="row">
                           <div class="faq-text">{!! $faq->answer  or '' !!}</div>
                        </div>
                     </li>
                  </ul>
               </li>
               @endforeach
            </ul>
         </div>
         
         @else
         <h4 style="color: red;"> <center><?php echo (preg_replace('#<[^>]+>#',' ',translation('no_records_found')));?></center> </h4>
         @endif

      </div>
      <div class="col-sm-12 col-md-4 col-lg-4">
         <div class="faq-get-a-free">
            <div class="overlay-raq"></div>
            <div class="content-quote-main">
               <div class="free-quote-head"><?php echo (preg_replace('#<[^>]+>#',' ',translation('get_a_free_quote')));?></div>
               <div class="free-quote-content"><?php echo (preg_replace('#<[^>]+>#',' ',translation('free_quote_text')));?></div>
               <div class="free-quote-btn"><a class="start-quote-btn" href="#"><?php echo (preg_replace('#<[^>]+>#',' ',translation('start_a_quote')));?></a></div>
            </div>
         </div>
         <div class="faq-get-a-free have-a-question">
            <div class="content-quote-main">
               <div class="free-quote-head"><?php echo (preg_replace('#<[^>]+>#',' ',translation('have_a_question')));?></div>
               <div class="free-quote-content"><?php echo (preg_replace('#<[^>]+>#',' ',translation('have_a_question_text')));?></div>
             <div class="send-msg-mess-btn faq">
                     <form method="get" action="{{url('')}}/page/help" >
                        <button class="send-btn-contact-us" type="submit"><?php echo (preg_replace('#<[^>]+>#',' ',translation('send_message')));?></button>
                    </form>
                  </div>
            </div>
         </div>
      </div>
   </div>
</div>

<!--Accordian start-->
<script type="text/javascript" language="javascript" src="{{url('/')}}/front-assets/js/accordian.js"></script>