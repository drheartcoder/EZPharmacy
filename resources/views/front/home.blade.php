<!-- CONTENT BEGIN -->
<!-- OUR PRODUCTS BEGIN -->
<div class="clearfix"></div>
<section class="container our-products" id="our-products">
  <div class="row">
   @include('admin.layout._operation_status')
    <div class="text-center">
      <h2><?php echo (preg_replace('#<[^>]+>#',' ',translation('our_products')));?></h2>
    </div>
    <div class="text-center">
      <p><?php echo (preg_replace('#<[^>]+>#',' ',translation('pour_product_descriptionp')));?></p>
    </div>
    <div class="col-lg-10 col-md-10 col-sm-10 col-sm-offset-1 col-md-offset-1 col-lg-offset-1">
      <hr>
    </div>
    <div class="col-md-4 col-xs-12">
      <div class="our-products-block">
        <div class="our-products-block-top">
          <img src="{{url('front-assets')}}/images/normal-format-icon.jpg" alt="">
          <h3><?php echo (preg_replace('#<[^>]+>#',' ',translation('pnormal_documentp')));?></h3>
        </div>
        <ul>
          <li><?php echo (preg_replace('#<[^>]+>#',' ',translation('peconomy_value_amp_premium_white_paperp')));?></li>
          <li><?php echo (preg_replace('#<[^>]+>#',' ',translation('ppremium_white_paper_100_recycledp')));?></li>
          <li><?php echo (preg_replace('#<[^>]+>#',' ',translation('pcolored_paperp')));?></li>
        </ul>
      </div>
    </div>
    <div class="col-md-4 col-xs-12">
      <div class="our-products-block">
        <div class="our-products-block-top">
          <img src="{{url('front-assets')}}/images/large-format-icon.jpg" alt="">
          <h3><?php echo (preg_replace('#<[^>]+>#',' ',translation('plarge_formatp')));?></h3>
        </div>
        <ul>
          <li><?php echo (preg_replace('#<[^>]+>#',' ',translation('pstaplep')));?></li>
          <li><?php echo (preg_replace('#<[^>]+>#',' ',translation('pcombp')));?></li>
          <li><?php echo (preg_replace('#<[^>]+>#',' ',translation('pspiralp')));?></li>
          <li><?php echo (preg_replace('#<[^>]+>#',' ',translation('psaddle_stitchp')));?></li>
          <li><?php echo (preg_replace('#<[^>]+>#',' ',translation('pring_bindersp')));?></li>
        </ul>
      </div>
    </div>
    <div class="col-md-4 col-xs-12">
      <div class="our-products-block">
        <div class="our-products-block-top">
          <img src="{{url('front-assets')}}/images/presentation-format-icon.jpg" alt="">
          <h3><?php echo (preg_replace('#<[^>]+>#',' ',translation('ppresentation_documentp')));?></h3>
        </div>
        <ul>
          <li><?php echo (preg_replace('#<[^>]+>#',' ',translation('pstam_plep')));?></li>
          <li><?php echo (preg_replace('#<[^>]+>#',' ',translation('pco_mbp')));?></li>
          <li><?php echo (preg_replace('#<[^>]+>#',' ',translation('psp_iralp')));?></li>
          <li><?php echo (preg_replace('#<[^>]+>#',' ',translation('psaddlep')));?></li>
          <li><?php echo (preg_replace('#<[^>]+>#',' ',translation('pbindersp')));?></li>
        </ul>
      </div>
    </div>
  </div>
</section>
<!-- OUR PRODUCT EOF -->

<!-- HOW IT WORKS BEGIN -->
<section class="container-fluid how-it-works">
  <div class="row">
    <div class="container">
      <div class="row">
        <!-- HOW IT WORKS TITLE BEGIN -->
        <div class="col-xs-12">
          <h2 class="text-center"><?php echo (preg_replace('#<[^>]+>#',' ',translation('how_it_works')));?></h2>
        </div>
        <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 col-sm-offset-0 col-md-offset-0 col-lg-offset-4 text-center">
          <p>
            <?php echo (preg_replace('#<[^>]+>#',' ',translation('get_the_job_done_right')));?>
          </p>
          <hr>
        </div>
        <!-- HOW IT WORKS TITLE EOF -->
        <div class="col-xs-12 how-it-works-steps-wrap text-center">
          <div class="row">
            <div class="how-it-works-line"></div>
            <div class="col-xs-12 col-lg-3 col-md-3 col-sm-3">
              <img src="{{url('front-assets')}}/images/how-it-work-one.jpg" alt="">
        
              <div class="how-it-works-line-boll"></div>
              <b><?php echo (preg_replace('#<[^>]+>#',' ',translation('how_it_works_section1_title')));?></b>
              <p class="p-text-home"><?php echo (preg_replace('#<[^>]+>#',' ',translation('home_how_it_works_desc_1')));?></p>
            </div>
            <div class="col-xs-12 col-lg-3 col-md-3 col-sm-3">
              <img src="{{url('front-assets')}}/images/how-it-work-two.jpg" alt="">
              
              <div class="how-it-works-line-boll"></div>
              <b> <?php echo (preg_replace('#<[^>]+>#',' ',translation('how_it_works_section2_title')));?></b>
              <p class="p-text-home">
                 <?php echo (preg_replace('#<[^>]+>#',' ',translation('home_how_it_works_desc_2')));?></p>
            </div>
            <div class="col-xs-12 col-lg-3 col-md-3 col-sm-3">
              <img src="{{url('front-assets')}}/images/how-it-work-three.jpg" alt="">
           
              <div class="how-it-works-line-boll"></div>
              <b><?php echo (preg_replace('#<[^>]+>#',' ',translation('how_it_works_section3_title')));?></b>
              <p class="p-text-home">
                <?php echo (preg_replace('#<[^>]+>#',' ',translation('home_how_it_works_desc_3')));?></p>
            </div>
            <div class="col-xs-12 col-lg-3 col-md-3 col-sm-3">
              <img src="{{url('front-assets')}}/images/how-it-work-four.jpg" alt="">
              <div class="how-it-works-line-boll"></div>
              <b> <?php echo (preg_replace('#<[^>]+>#',' ',translation('how_it_works_section4_title')));?></b>
              <p class="p-text-home">
                <?php echo (preg_replace('#<[^>]+>#',' ',translation('home_how_it_works_desc_4')));?></p>
            </div>
          </div>
        </div>
        <div class="col-xs-12 text-center">
        @if(!\Session::has('userLogged'))
          <button data-toggle="modal" data-target="#login-modal" class="btn-art"><?php echo (preg_replace('#<[^>]+>#',' ',translation('pstart_printingp')));?></button>
        @else
           <a href="{{url('/')}}/user/create-document/" class="btn-art"><?php echo (preg_replace('#<[^>]+>#',' ',translation('pstart_printingp')));?></a>
        @endif
        </div>
      </div>
    </div>
  </div>
</section>
<!-- HOW IT WORKS EOF -->

<!-- VIDEO BEGIN -->
<section class="container main-video-wrap">

<video  controls>
  <source src="video/print.mp4" type="video/mp4">
  <source src="video/print-ipad.mp4" type="video/mp4">
</video>


   <!--  <video id="styled_video">
      <source src="video/print.mp4" type="video/mp4">
      <source src="video/print-ipad.mp4" type="video/mp4">
    </video>
    <button type="button" class="video-play" id="style_it"><i class="icon-play"></i></button>
    <button type="button" class="video-stop" id="stop_style_it"><?php echo (preg_replace('#<[^>]+>#',' ',translation('pstop_itp')));?></button> -->

</section>
<!-- VIDEO EOF -->



<!-- PRICE CALCULATOR BEGIN -->
<div class="documentLoader"></div>
<section class="container-fluid price-calc">
  <div class="row">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-xs-12 col-sm-12 col-md-12">
          <h2 class="text-center"><?php echo (preg_replace('#<[^>]+>#',' ',translation('pprice_calculatorp')));?></h2>
        </div>
        <div class="col-lg-8 col-xs-12 col-sm-12 col-md-12 col-lg-offset-2 col-md-offset-0 col-sm-offset-0 col-xs-offset-0">
          <div class="col-xs-12 calc-wrap">
            <div class="row">
                <!-- Document Type BEGIN -->
                <div class="col-xs-12 calc-row calc-row-30">
                  <h4><?php echo (preg_replace('#<[^>]+>#',' ',translation('home_document_type')));?></h4>
                   @if(count($resDocumentType))
                        @foreach($resDocumentType as $key => $value)
                          <?php
                          $_checked = '';
                            if($key == 0){
                              $_checked = 'checked="checked"';
                            }
                          ?>
                          <input name="optDocumentType" id="optDocumentType{{$value->primaryKey}}" class="calc-radio" {{$_checked}} type="radio" value="{{$value->primaryKey}}">
                          <label for="optDocumentType{{$value->primaryKey}}">{{$value->documentType}}</label>
                        @endforeach
                   @endif
                </div>
                <!-- Document Type EOF -->
                <!-- Paper Size * Paper Weight WRAP BEGIN -->
                <div class="col-xs-12 calc-row">
                   <div class="row">
                    <!-- Paper Size BEGIN -->
                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 calc-row home-print-strs" id="paperSizeHTML">
                    </div>
                    <!-- Paper Size EOF -->
                    <!-- Paper Weight BEGIN -->
                    <div class="col-lg-8 col-md-6 col-sm-6 col-xs-12 calc-row calc-row-30" id="paperWeightHTML">
                      <h4></h4>
                    </div>
                    <!-- Paper Weight EOF -->
                    </div>
                </div>
                <!-- Paper Size * Paper Weight WRAP EOF -->
                <!-- Paper Type BEGIN -->
                <div class="col-xs-12 calc-row calc-row-30" id="paperTypeHTML">
                </div>
                <!-- Paper Type EOF -->
                <!-- Color & Side WRAP BEGIN -->
                <div class="col-xs-12">
                  <div class="row">
                    <!-- Color BEGIN -->
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 calc-row calc-row-25" id="paperColorHTML">
                    </div>
                    <!-- Color EOF -->
                    <!-- Side BEGIN -->
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 calc-row calc-row-10" id="paperSideHTML">
                    </div>
                    <!-- Side EOF -->
                  </div>
                </div>
                <!-- Color & Side WRAP EOF -->
                <!-- Binding Option & No. of Pages WRAP BEGIN -->
                <div class="col-xs-12">
                  <div class="row">
                    <!-- Binding Option BEGIN -->
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 calc-row">
                      <label for="binding-option"><h4><?php echo (preg_replace('#<[^>]+>#',' ',translation('home_binding_options')));?></h4>
                        <select class="calc-select" id="optBindingOptions" name="optBindingOptions">
                       <option value="" selected="selected" disabled="disabled"><?php echo (preg_replace('#<[^>]+>#',' ',translation('select')));?></option>
                     </select>
                      </label>
                    </div>
                    <!--Binding Option EOF -->
                    <!-- No. of Pages BEGIN -->
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 calc-row">
                      <h4><?php echo (preg_replace('#<[^>]+>#',' ',translation('h4no_of_pagesh4')));?></h4>
                      <!--<label for="no-of-pages"><input id="no-of-pages" type="number"></label>-->
                      <div class="quantity">
                        <span class="quantity-down quantity-field updatePages" data-mode="decrease"><i class="icon-minus"></i></span>
                        <input id="txtTotalPages" name="txtTotalPages" class="quantity-field" type="text"  value="1">
                        <span class="quantity-up quantity-field updatePages" data-mode="increase"><i class="icon-plus"></i></span>
                      </div>
                    </div>
                    <!-- No. of Pages EOF -->
                  </div>
                </div>
                <!-- Binding Option & No. of Pages WRAP EOF -->
                <!-- Quantity BEGIN -->
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 calc-row">
                  <h4><?php echo (preg_replace('#<[^>]+>#',' ',translation('quantity')));?></h4>
                  <div class="quantity">
                    <span class="quantity-down quantity-field updateQuantity" data-mode="decrease"><i class="icon-minus"></i></span>
                    <input id="txtQuantity" name="txtQuantity" class="quantity-field" type="text" value="1">
                    <span class="quantity-up quantity-field updateQuantity" data-mode="increase"><i class="icon-plus"></i></span>
                  </div>
                </div>
                <!-- Quantity EOF -->
                <!-- Price BEGIN -->
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 calc-row">
                  <h4 style="visibility: hidden" class="hidden-xs">Price</h4>
                  <h3 class="calc-price"><?php echo (preg_replace('#<[^>]+>#',' ',translation('price')));?>:<span name="txtTotalCost" id="txtTotalCost">$ 0.00</span>
                  </h3>
                </div>
                <!-- Price EOF -->

            <div class="col-sm-3 col-md-3 col-lg-3 padd-none">
              <input type="hidden" name="txtPaperCost" value="0">
              <input type="hidden" name="txtPrintingCost" value="0">
              <input type="hidden" name="txtBindingCost" value="0">
              <input type="hidden" name="txtFoldingCost" value="0">
              <input type="hidden" name="txtFinalPrice" value="0">
            </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- PRICE CALCULATOR EOF -->
<!-- TESTIMONIALS BEGIN -->
<section class="container-fluid testimonials">
  <div class="row">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-xs-12 col-ms-12 col-sm-12">
          <h2 class="text-center"><?php echo (preg_replace('#<[^>]+>#',' ',translation('testimonial')));?></h2>
        </div>
        <!-- TESTIMONIALS SLIDER BEGIN -->
        <div class="col-lg-12 col-xs-12 col-ms-12 col-sm-12 slider text-center">
          <!-- SLIDE 1 BEGIN -->
          @if(isset($arr_testimonials) && count($arr_testimonials) > 0)
           @foreach($arr_testimonials as  $key => $testimonial)
              <div class="col-lg-4 col-sm-6">
                <div class="testimonial-slider-block">
                  <div class="testimonial-img">
                   <div class="about-avatar">
                    <img src="{{url('/')}}/uploads/testimonial_images/thumb_107X107_{{$testimonial->user_image or ''}}" alt="{{$testimonial->user_image or ''}}" />
                    </div>
                  </div>
                  <p>
                  <h4>{{$testimonial->user_name or '-'}}</h4>
                  <p>
                    {{$testimonial->description or '-'}}
                  </p>
                  <div class="testimonial-line"></div>
                </div>
              </div>
            @endforeach
          @endif
        </div>
        <!-- TESTIMONIALS SLIDER BEGIN -->
        <div class="col-xs-12 text-center">
        @if(!\Session::has('userLogged'))
          <button data-toggle="modal" data-target="#login-modal" class="btn-art"><?php echo (preg_replace('#<[^>]+>#',' ',translation('pmake_an_orderp')));?></button>
        @else
           <a href="{{url('/')}}/user/create-document/" class="btn-art"><?php echo (preg_replace('#<[^>]+>#',' ',translation('pstart_printingp')));?></a>
        @endif
        </div>
      </div>
    </div>
  </div>
</section>
<!-- TESTIMONIALS EOF -->
<!-- CONTENT EOF -->
{{-- <script type="text/javascript">
$( document ).ready(function() {
    if()
});
</script> --}}