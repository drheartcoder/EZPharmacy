<style>
    .header {
        background: #fff;
        background: rgba(255, 255, 255, 1);
        box-shadow: 0 0 2px rgba(0, 0, 0, 0.24);
        position: relative;
    }
    
    .min-menu li.dash-show {
        display: none;
    }
    /*    .min-menu li{display: none;}.min-menu li.lang, .min-menu li.call-no-block, .min-menu li.dash-show{display: inline-block;}#dd .dropdown li{display: block;}*/
</style>
<div class="banner-block-inner">
    <div class="about-overlay"></div>
    <div class="container main-content-head">
        <div class="row">
            <div class="col-sm-6 col-md-6 col-lg-6">
                <div class="page-head-block">
                    <?php echo $resDocumentType[0]->documentType; ?><?php echo (preg_replace('#<[^>]+>#',' ',translation('pdetailp')));?>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-6">
                <div class="bread-cum-block">
                    <ul>
                        <li><a href="{{url('').'/products/'}}"><?php echo (preg_replace('#<[^>]+>#',' ',translation('products')));?></a></li>
                        <li><?php echo $resDocumentType[0]->documentType; ?><?php echo (preg_replace('#<[^>]+>#',' ',translation('pdetailp')));?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="product-detail-main row">
        <div class="productdetails-block-img col-lg-4 col-md-4 col-sm-12 col-xs-12">
          <?php
            $filePath = url('').'/front-assets/images/our-vision-img.jpg';
            if(!empty($resDocumentType[0]->documentImg) && file_exists('uploads/document_type/'.$resDocumentType[0]->documentImg)){
                $filePath = url('').'/uploads/document_type/'.$resDocumentType[0]->documentImg;
            }

          ?>
            <img src="{{$filePath}}" alt="{{$resDocumentType[0]->documentType}}" class="img-responsive" />
        </div>
        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
            <div class="product-head">
                <?php echo $resDocumentType[0]->documentType; ?>
            </div>
            <div class="product-content">
                <?php echo $resDocumentType[0]->documentDesc; ?>
            </div>
        </div>
        <div class="clr"></div>
    </div>
    <div class="prodoption">
        <h3><?php echo (preg_replace('#<[^>]+>#',' ',translation('paper_options')));?></h3>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 prodSpecification">
                <h4><?php echo (preg_replace('#<[^>]+>#',' ',translation('paper_size')));?>:</h4>
                <ul>
                    @if(count($arrAttributes['htmlSize']))
                      @foreach($arrAttributes['htmlSize'] as $row)
                        <li><?php echo $row['name'].' ('.$row['description'].')'; ?></li>
                      @endforeach
                    @endif
                </ul>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 prodSpecification">
                <h4><?php echo (preg_replace('#<[^>]+>#',' ',translation('paper_weight')));?>:</h4>
                <ul>
                    @if(count($arrAttributes['htmlGsm']))
                      @foreach($arrAttributes['htmlGsm'] as $row)
                        <li><?php echo $row['name'].' GSM ('.$row['description'].')'; ?></li>
                      @endforeach
                    @endif
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 prodSpecification">
                <h4><?php echo (preg_replace('#<[^>]+>#',' ',translation('paper_type')));?>:</h4>
                <ul>
                    @if(count($arrAttributes['htmlType']))
                      @foreach($arrAttributes['htmlType'] as $row)
                        <li><?php echo $row['name'].' ('.$row['description'].')'; ?></li>
                      @endforeach
                    @endif
                </ul>
            </div>
        </div>
    </div>
    <div class="prodoption">
        <h3><?php echo (preg_replace('#<[^>]+>#',' ',translation('color')));?></h3>
        <div class="prodSpecification">
            <ul>
                @if(count($arrAttributes['htmlColor']))
                  @foreach($arrAttributes['htmlColor'] as $row)
                    <li><?php echo $row['name']; ?></li>
                  @endforeach
                @endif
            </ul>
        </div>
    </div>
    <div class="prodoption">
        <h3><?php echo (preg_replace('#<[^>]+>#',' ',translation('side')));?></h3>
        <div class="prodSpecification">
            <ul>
                @if(count($arrAttributes['htmlSides']))
                  @foreach($arrAttributes['htmlSides'] as $row)
                    <li><?php echo $row['name']; ?></li>
                  @endforeach
                @endif
            </ul>
        </div>
    </div>
    <div class="prodcategories-main-block">
        <div class="prodcategories-head-block wow fadeInDown" data-wow-delay="0.5s">
           <?php echo (preg_replace('#<[^>]+>#',' ',translation('binding_options')));?>
        </div>

        <div class="section-catego-block row">
            @if(count($arrAttributes['htmlBindings']))
              @foreach($arrAttributes['htmlBindings'] as $key => $row)
                <div class="col-sm-4 col-md-3 col-lg-3">
                  <div class="main-block-cate grid nomrbtm">
                      <a href="javascript:void(0);">
                          <span class="effect-oscar">
                            <img src="<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>">
                          </span>
                          <span class="cate-block-main-txt">
                          <?php echo $row['name']; ?>
                       </span>
                      </a>
                  </div>
              </div>
                
              @endforeach
            @endif
            <div class="clr"></div>
        </div>

    </div>
    <div class="prodcategories-main-block nobrdr">
        <div class="prodcategories-head-block wow fadeInDown" data-wow-delay="0.5s">
           <?php echo (preg_replace('#<[^>]+>#',' ',translation('folding_options')));?>
        </div>
        <div class="section-catego-block row">
            @if(count($arrAttributes['htmlFoldings']))
              @foreach($arrAttributes['htmlFoldings'] as $row)
                <div class="col-sm-4 col-md-3 col-lg-3">
                  <div class="main-block-cate grid nomrbtm">
                      <a href="javascript:void(0);">
                          <span class="effect-oscar">
                            <img src="<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>">
                          </span>
                          <span class="cate-block-main-txt">
                          <?php echo $row['name']; ?>
                       </span>
                      </a>
                  </div>
              </div>
              @endforeach
            @endif
            
        </div>

    </div>
</div>
@if(isset($arr_testimonials) && count($arr_testimonials) > 0)
<div class="borderTop">
    <div class="container">
        <div class="main-testi-block" >
          <div class="container wow fadeInLeft" data-wow-delay="0.1s">
             <div class="testimonila-block-container">
                <div class="categories-head-block">
                   <div class="browes-cate-block">
                       <?php echo (preg_replace('#<[^>]+>#',' ',translation('testimonial')));?>
                   </div>
                   @if(isset($arr_testimonials) && count($arr_testimonials) > 0)
                   <div class="head-cate-block">
                     <?php echo (preg_replace('#<[^>]+>#',' ',translation('kind_words_from_happy_candidates')));?>
                   </div>
                   @endif
                </div>

                @if(isset($arr_testimonials) && count($arr_testimonials) > 0)

                <div id="carousel-example-generic-one" class="carousel slide">

                   <!-- Indicators -->
                   <ol class="carousel-indicators">
                   @foreach($arr_testimonials as $key =>  $testimonial)
                      <li data-target="#carousel-example-generic-one" data-slide-to="{{$key}}" @if($key == 0) class="active" @endif ></li>
                   @endforeach
                   </ol>
                   <!-- Wrapper for slides -->
                   <div class="carousel-inner">

                      @foreach($arr_testimonials as  $key => $testimonial)
                         <div class="item @if($key == 0)active @endif">
                            <div class="carousel-caption">
                               <div class="testi-content-block">
                                  <p>{{$testimonial->description or '-'}}</p>
                               </div>
                               <div class="testi-profile-pic">
                                  <img src="{{url('/')}}/uploads/testimonial_images/thumb_107X107_{{$testimonial->user_image or ''}}" alt="{{$testimonial->user_image or ''}}" />
                               </div>
                               <div class="name-testi-block">
                                  <h3>{{$testimonial->user_name or '-'}}</h3>
                               </div>
                            </div>
                         </div>
                      @endforeach
                      
                   </div>
                </div>
               @else
               <h4 style="color: red;" > <center><?php echo (preg_replace('#<[^>]+>#',' ',translation('no_records_found')));?></center> </h4>
            @endif
         </div>
      </div>
   </div>
@else
<div class="main-testi-block" >&nbsp;</div><div class="clr"></div>
@endif

</div>
<!-- cd-section -->