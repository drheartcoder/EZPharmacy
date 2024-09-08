<style>.header{background: #fff;background:rgba(255,255,255,1); box-shadow: 0 0 2px rgba(0, 0, 0, 0.24); position: relative;}
    .min-menu li.dash-show{display: block;float: right;}
/*    .min-menu li{display: none;}.min-menu li.lang, .min-menu li.call-no-block, .min-menu li.dash-show{display: inline-block;}#dd .dropdown li{display: block;}*/
</style>
<!-- CONTENT BEGIN -->
<section class="container faq">
  <div class="row">
    <div class="col-xs-12 faq-accordion">
      <h2 class="text-center"><?php echo translation('frequently_asked_questions');?></h2>
      
      <form class="faq-form text-center" method="GET" action="">
        <label for="faq-input">
          <input id="faq-input" name="q" type="text" placeholder="<?php echo translation('search');?>" value="{{\Request::get('q')}}">
        </label>
        <label for="faq-search" class="faq-form-send-label">
          <input id="faq-search" type="submit" value="">
        </label>
      </form>

      <div class="panel-group" id="accordion">
        <!-- PANEL 1 BEGIN -->
         @if(isset($arr_faq) && count($arr_faq) > 0)
               <?php $atrrCnt = 1; ?>
               @foreach($arr_faq as $key => $faq)
                 <div class="panel faq-panel">
                   <!-- Panel title -->
                   <div class="panel-header">
                     <h3 class="panel-title panel-title-plus">
                       <a data-toggle="collapse" data-parent="#accordion" href=".<?php echo $atrrCnt; ?>">  {!! $faq->question or '' !!}</a>
                     </h3>
                   </div>
                   <div id="<?php echo $atrrCnt; ?>" class="panel-collapse collapse <?php echo $atrrCnt; ?>">
                     <!-- Panel content -->
                     <div class="panel-content">
                       {!! $faq->answer or '' !!}
                     </div>
                   </div>
                 </div>
                 <?php $atrrCnt++; ?>
               @endforeach
         @else
         <h4 style="color: red;"> <center><?php echo (preg_replace('#<[^>]+>#',' ',translation('no_records_found')));?></center> </h4>
        @endif
        <!-- PANEL 1 EOF -->
      </div>
    </div>
   <!--  <div class="col-xs-12 text-center">
      <button class="btn-art faq-show-hidden-content"><?php echo (preg_replace('#<[^>]+>#',' ',translation('pshow_morep')));?></button>
    </div> -->
  </div>
</section>
<!-- CONTENT EOF -->

<!--Accordian start-->
<script type="text/javascript" language="javascript" src="{{url('/')}}/front-assets/js/accordian.js"></script>



<!-- <script src="{{url('/')}}/front-assets/js/bootstrap.min.js"></script>
<script src="{{url('/')}}/front-assets/js/custom.js"></script> -->