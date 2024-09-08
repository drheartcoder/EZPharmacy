
@include('front.user._inner-breadcrumbs')
<section class="simple-page footer-o">
 <div class="container">
  <div class="row">
    <div class="col-md-12 col-xs-12 text-center"><!-- col-md-offset-3  -->
      <h2><?php echo (preg_replace('#<[^>]+>#',' ',translation('create_document')));?></h2>
    </div>
    <!-- MENU BEGIN -->
    <div>
        @include('front.user.left-navigation')
    </div>
    <!-- MENU BEGIN -->
    <!-- CREATE CONTENT BEGIN -->
    <div class="col-lg-9 col-md-9 col-sm-8  col-xs-12"><!-- col-lg-offset-1 -->
      <!-- STEPS BEGIN -->
      <div class="col-lg-3 col-xs-3">
        <div class="row">
          <div class="chevron first-step chevron-done">
            <span><?php echo (preg_replace('#<[^>]+>#',' ',translation('step_1')));?></span>
            <div class="text-center">
              <i class="icon-done-in-circle"></i>
              <p><?php echo (preg_replace('#<[^>]+>#',' ',translation('upload_file')));?></p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-xs-3">
        <div class="row">
          <div class="chevron chevron-right chevron-active">
            <span><?php echo (preg_replace('#<[^>]+>#',' ',translation('step_2')));?></span>
            <div class="text-center">
              <i class="icon-order"></i>
              <p><?php echo  (preg_replace('#<[^>]+>#',' ',translation('document')));?> &amp; <?php echo (preg_replace('#<[^>]+>#',' ',translation('its_attributes')));?></p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-xs-3">
        <div class="row">
          <div class="chevron chevron-right chevron-right">
            <span><?php echo (preg_replace('#<[^>]+>#',' ',translation('step_3')));?></span>
            <div class="text-center">
              <i class="icon-shopping-cart">
                <span class="cart-count" id="myCartCount">{{$cartCount or '0'}}</span>
              </i>
              <p><?php echo (preg_replace('#<[^>]+>#',' ',translation('cart')));?></p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-xs-3">
        <div class="row">
          <div class="chevron last-step last-step">
            <span><?php echo (preg_replace('#<[^>]+>#',' ',translation('step_4')));?></span>
            <div class="text-center">
              <i class="icon-card"></i>
              <p><?php echo (preg_replace('#<[^>]+>#',' ',translation('checkout')));?></p>
            </div>
          </div>
        </div>
      </div>
      <!-- STEPS EOF -->
       <div class="col-xs-12">
        <div class="row">
          <div class="back-forward">
            {{-- <a href="{{url('/user/create-document/')}}"><i class="icon-back"></i>Back</a>
            <a href="">Forward <i class="icon-next"></i></a> --}}
          </div>
        </div>
      </div>

      <div class="col-xs-12">
        <div class="row title-block clsTotalPages" data-num-page="{{$_numOfPages}}" data-file-id="{{$_fileId}}">
          <span><?php echo (preg_replace('#<[^>]+>#',' ',translation('document_type')));?></span>
        </div>
      </div>

        <div>
          <!-- <div id="divPrice"><?php echo (preg_replace('#<[^>]+>#',' ',translation('total_price')));?><small>(SAR)</small> 0.00</div> -->
         <div class="calc-row">
                  <div class="row create-doc-type text-center spacebootns">
                    @if(count($resDocumentType))
                      @foreach($resDocumentType as $row)
                        <div class="col-xs-12 col-sm-6 col-md-4">
                          <div class="create-doc-type-start">
                            <input class="calc-radio" type="radio" id="option-one-{{$row->primaryKey}}" name="rdbDocumentType" value="{{$row->primaryKey}}">
                                <?php
                                    $filePath = url('').'/front-assets/images/net-banking.png';
                                    if(!empty($row->documentImg))
                                    {
                                        if(file_exists('uploads/document_type/'.$row->documentImg)){
                                            $filePath = url('').'/uploads/document_type/thumb_150X145_'.$row->documentImg;
                                        }
                                    }
                                ?>
                            <label for="option-one-{{$row->primaryKey}}">
                               <span class="img-label-block"><img src="{{$filePath}}" alt="{{$row->documentImg}}"> </span>
                                <span class="label-conent-block">
                                    <span class="radio-head-block">
                                        {{$row->documentType}}
                                    </span>
                                    <span class="radio-content-block">
                                        <!-- <?php if(strlen($row->documentDesc) <= 200) { echo $row->documentDesc; } else { echo substr($row->documentDesc, 0, 100).'.....'; } ?> -->
                                    </span>
                                </span>
                            </label>
                            <div class="check"></div>
                          </div>
                        </div>
                      @endforeach
                    @else
                      <label><?php echo (preg_replace('#<[^>]+>#',' ',translation('sorry_no_document_type_available')));?></label>
                   @endif
                  </div>
                  <div class="clearfix"></div>
                </div>
         
              <div class="col-sm-12 col-md-12 col-lg-12" id="loadingAttributes" style="display: none;">
                  <div class="mrg-tpspay" style="text-align: center;">
                      <img src="{{url('').'/front-assets/images/loading.gif'}}">
                  </div>
                  <div class="clearfix"></div>
              </div>
              <div class="">
                  
                  <div id="documentPaperOptions"></div>
                  <div id="documentColorOptions"></div>
                  <div id="documentSideOptions"></div>
                  <div id="documentBindingOptions"></div>
                  <div id="documentFoldingOptions"></div>
                  <div class="col-sm-12 col-md-12 col-lg-12" id="nextButton"></div>
              </div>

              <p><input type="hidden" name="txtPaperCost" value="0"></p>
              <p><input type="hidden" name="txtPrintingCost" value="0"></p>
              <p><input type="hidden" name="txtBindingCost" value="0"></p>
              <p><input type="hidden" name="txtFoldingCost" value="0"></p>
              <p><input type="hidden" name="txtFinalPrice" value="0"></p>

        </div>   
    </div>
    <!-- CREATE CONTENT EOF -->
  </div>

    </div>
     <div class="total-price-in-footer" id="total-price-in-footer">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-lg-offset-4 col-md-8 col-md-offset-4 col-sm-8 col-sm-offset-4 col-xs-12">
            <div class="row" id="showPrice">
            </div>
          </div>
        </div>
      </div>
    </div>
</section>

<!--<div id="total-price-in-footer">-->
<!--<div class="total-price-in-footer" id="showPrice"></div>-->
<!--</div>-->


 <style>
     .simple-page.footer-o{margin-bottom:0px;position: relative;}
     
</style>

