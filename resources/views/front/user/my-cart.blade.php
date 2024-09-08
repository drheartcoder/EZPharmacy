@include('front.user._inner-breadcrumbs')
<section class="container simple-page">
  <div class="row">
    <div class="col-md-12 col-xs-12 text-center"><!-- col-md-offset-4 -->
      <h2><?php echo (preg_replace('#<[^>]+>#',' ',translation('create_document')));?></h2>
    </div>
    <!-- MENU BEGIN -->
    <div>
        @include('front.user.left-navigation')
    </div>
    <!-- MENU BEGIN -->
    <!-- CREATE CONTENT BEGIN -->
    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12"><!-- col-lg-offset-1 -->
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
          <div class="chevron chevron-right chevron-done">
            <span><?php echo (preg_replace('#<[^>]+>#',' ',translation('step_2')));?></span>
            <div class="text-center">
              <i class="icon-done-in-circle"></i>
              <p><?php echo  (preg_replace('#<[^>]+>#',' ',translation('document')));?> &amp; <?php echo (preg_replace('#<[^>]+>#',' ',translation('its_attributes')));?></p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-xs-3">
        <div class="row">
          <div class="chevron chevron-right chevron-active">
            <span><?php echo (preg_replace('#<[^>]+>#',' ',translation('step_3')));?></span>
            <div class="text-center">
              <i class="icon-shopping-cart">
                <span class="cart-count" id="myCartCount"> {{$cartCount or '0'}} </span>
              </i>
              <p><?php echo (preg_replace('#<[^>]+>#',' ',translation('cart')));?></p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-xs-3">
        <div class="row">
          <div class="chevron last-step">
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
           {{--  <a href=""><i class="icon-back"></i> Back</a>
            <a href="">Forward <i class="icon-next"></i></a> --}}
          </div>
        </div>
      </div>
      <!-- BACK & FORWARD EOF -->
      <!-- LIST OF FILES BEGIN -->
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
              <div class="table-block-dash shopping-cart-block-main">
                  <div class="main-content-more-total">
                      <div class="ajaxLoader"></div>
                      <div class="table-responsive">
                          <table class="table table-striped dashboard shoping-cart my-cart-tabels">
                              <thead>
                                  <tr>
                                      <th ><?php echo  (preg_replace('#<[^>]+>#',' ',translation('description')));?></th>
                                      <th><?php echo  (preg_replace('#<[^>]+>#',' ',translation('pdetailsp')));?></th>
                                      <th style="text-align: center;"><?php echo (preg_replace('#<[^>]+>#',' ',translation('price')));?> (SAR)</th>
                                      <th style="text-align: center;"><?php echo (preg_replace('#<[^>]+>#',' ',translation('quantity')));?> </th>
                                      <th width="100px" style="text-align: center;"><?php echo (preg_replace('#<[^>]+>#',' ',translation('total')));?>(SAR)</th>
                                      <th width="170px" style="text-align: center"><?php echo (preg_replace('#<[^>]+>#',' ',translation('action')));?></th>
                                  </tr>
                              </thead>
                              <tbody id="cartItemsList">
                                  <tr>
                                      <td colspan="6" style="text-align: center;"><img src="{{url('').'/front-assets/images/cart-loader.gif'}}" style="width: 190px;"></td>
                                  </tr>
                              </tbody>
                          </table>
                      </div><div class="clearfix"></div>
                      <div class="add-more-btn-total-main" id="subtotal-block-txt"> <div class="clearfix"></div></div>
                  </div>                            
              </div>
          </div>
      </div>
    </div>
    <!-- CREATE CONTENT EOF -->
  </div><style>.create-btn{    display: inline-block;}</style>
</section>