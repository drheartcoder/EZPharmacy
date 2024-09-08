<style type="text/css">
    .radio-btn.updateWallet.wallet-btn{max-width: 100%;}
a#en_button{/*max-width: 330px !important;*/ width: 100% !important;background-position: center;}
.error {font-size: 11px;color: red;position: relative;}
.error-text-color{color: #F00 !important;}
.error-text-color::-webkit-input-placeholder {color: red !important;}
.error-text-color:-moz-placeholder { /* Firefox 18- */color: red !important;  }
.error-text-color::-moz-placeholder {  /* Firefox 19+ */color: red !important;  }
.error-text-color:-ms-input-placeholder {  color: red !important;  }
.activeClass{border: 1px solid #5c1382;}
.payment-method-redio.color-radio-btns .radio-btn{    width: 100%;}
.defaultClass{cursor: pointer;}
.PT_express_checkout {padding: 0px;border: 1px solid #5c1382;/*width: 310px;*/}
.nav-pills>li._success>a, .nav-pills>li._success>a:focus, .nav-pills>li._success>a:hover {color: #fff;background-color: #7eb858;}
.PT_express_checkout .PT_open_popup{background-size: 250px; color: #fff;display: inline-block; background-position: center center;margin: 9px 0;height: 96px !important;}
.payment-btn-block-main .img-span-block{display: block;text-align: center;}
.text-wallet p{color: #fff;font-size: 12px;margin-top: 5px;}
.payment-btn-block-main .text-span-block.btn_wallet_center{text-align: center;}
@media all and (max-width:700px){
.PT_express_checkout{margin: 0 auto; /*width: 290px;*/}
.payment-method-redio .radio-btn{float: none;}
.radio-btn.updateWallet.wallet-btn{    max-width: 100%;}
.updateWallet.wallet-btn{margin-right: 0px;}
/*.payment-method-redio.color-radio-btns .radio-btn {width: 42%;}     */
}
    @media all and (max-width:1200px){.radio-btn.updateWallet.wallet-btn{max-width: 100%;}}
</style>
<script src="{{ url("front-assets") }}/js/validation.js"></script>
<script src="{{ url("front-assets") }}/js/jquery.validate.min.js"></script>
<script src="{{ url("front-assets") }}/js/additional-methods.js"></script>
@include('front.user._inner-breadcrumbs')
<section class="container simple-page">
  <div class="row">
    <div class="col-md-12  col-xs-12 text-center"><!-- col-md-offset-4 -->
      <h2><?php echo (preg_replace('#<[^>]+>#',' ',translation('create_document')));?></h2>
    </div>
    <!-- MENU BEGIN -->
    <div>
        @include('front.user.left-navigation')
    </div>

    <!-- ADD ADDRESS MODAL BEGIN -->
    <div class="modal fade" id="add-address-modal" tabindex="10" role="dialog" aria-labelledby="addAddressModal">
      <div class="modal-dialog modal-md" role="document">
      
        <div class="modal-content">
         <div class="butn-close"> <button type="button" class="close" data-dismiss="modal">&times;</button></div>
          <div class="modal-body">
            <h3><?php echo (preg_replace('#<[^>]+>#',' ',translation('padd_delivery_locationp')));?></h3>
            <form name="validation-form" id="frm_address" method="post" class="add-address-form">
            {{csrf_field()}}
              <input type="text" name="name" id="name" placeholder="<?php echo (preg_replace('#<[^>]+>#',' ',translation('penter_receivers_namep')));?>" data-rule-required="true"><span class="error"></span>

              <input type="text" name="address" id="address" placeholder="<?php echo (preg_replace('#<[^>]+>#',' ',translation('penter_addressp')));?>" data-rule-required="true"><span class="error"></span>

              <select id="optCountryDelivery" name="optCountryDelivery" data-rule-required="true">
                <option value=""><?php echo (preg_replace('#<[^>]+>#',' ',translation('select_country')));?></option>
              </select>

              <select id="optCityDelivery" name="optCityDelivery">
                <option value=""><?php echo (preg_replace('#<[^>]+>#',' ',translation('select_city')));?></option>
              </select>

              <input type="text" name="zipcode" id="zipcode" placeholder="<?php echo (preg_replace('#<[^>]+>#',' ',translation('penter_postal_codep')));?>">

              <input type="text" name="phone_no" id="phone_no" placeholder="<?php echo (preg_replace('#<[^>]+>#',' ',translation('penter_phone_numberp')));?>" data-rule-required="true"  data-rule-pattern="[- +()0-9]+" data-rule-maxlength="17" data-rule-minlength="6">
              <button type="button" name="btnSaveAddress" id="btnSaveAddress"><?php echo (preg_replace('#<[^>]+>#',' ',translation('save')));?></button>
            </form>
          </div>
        </div>
      </div>
    </div>
<!-- ADD ADDRESS MODAL EOF -->
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
          <div class="chevron chevron-right chevron-done">
            <span><?php echo (preg_replace('#<[^>]+>#',' ',translation('step_3')));?></span>
            <div class="text-center">
              <i class="icon-done-in-circle">
                <span class="cart-count" id="myCartCount">{{$cartCount or '0'}}</span>
              </i>
              <p><?php echo (preg_replace('#<[^>]+>#',' ',translation('cart')));?></p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-xs-3">
        <div class="row">
          <div class="chevron last-step chevron-active">
            <span><?php echo (preg_replace('#<[^>]+>#',' ',translation('step_4')));?></span>
            <div class="text-center">
              <i class="icon-card"></i>
              <p><?php echo (preg_replace('#<[^>]+>#',' ',translation('checkout')));?></p>
            </div>
          </div>
        </div>
      </div>
      <!-- STEPS EOF -->
<!--
       <div class="col-xs-12">
        <div class="row">
          <div class="back-forward">
             <a href=""><i class="icon-back"></i> Back</a>
            <a href="">Forward <i class="icon-next"></i></a> 
          </div>
        </div>
      </div>
-->
      <!-- BACK & FORWARD EOF -->
      
      <!-- ORDER INFORMATION -->
      <div class="col-xs-12">
        <div class="row">
          <table class="create-table checkout-table" style="margin-top:20px;">
            <thead>
                <tr>
                  <td colspan="2"><?php echo (preg_replace('#<[^>]+>#',' ',translation('porder_informationp')));?>:</td>
                </tr>
            </thead>
            <tbody>
                <?php 
                /*<tr>
                  <td><?php echo (preg_replace('#<[^>]+>#',' ',translation('subtotal')));?>:</td>
                  <td><small>SAR</small><span> {{number_format($actualAmount,2,'.','')}}</span></td>
                </tr>
                <tr>
                  <td><?php echo (preg_replace('#<[^>]+>#',' ',translation('processing_fee')));?>:</td>
                  <td><small>SAR</small><span> {{number_format($processingCharge,2,'.','')}}</span></td>
                </tr>
                */
                ?>
                <tr style="border-top: 0px solid #d5d5d5;">
                  <td style="border-bottom: 0px #FFF solid;"><span class="deliveryfee" style="display: none;">:</span></td>
                  <td style="border-bottom: 0px #FFF solid;"><span class="deliveryCharges" style="display: none;"> {{number_format(0.00,2,'.','')}}</span></td>
                </tr> 
                <tr style="border-top: 0px solid #d5d5d5;">
                  <td><?php echo (preg_replace('#<[^>]+>#',' ',translation('total_payable')));?>:</td>
                  <td><small>SAR</small> <span style="font-weight: bold;" class="grossTotal"> {{number_format($grossTotal,2,'.','')}}</span></td>
                </tr>
            </tbody>
          </table>
        </div>
      </div>
    <!-- ORDER INFORMATION EOF -->
        <!-- DELIVERY METHOD BEGIN -->
        <div class=" calc-row" id="radioOptions">
          <div class="row create-doc-type delivery-methods">
              <div class="col-md-12 col-sm-12 col-xs-12">  <h4><?php echo (preg_replace('#<[^>]+>#',' ',translation('pdelivery_methodp')));?>:</h4></div>

            <div class="col-md-4 col-sm-6 col-xs-12">
              <div class="create-doc-type-start text-center">
                <input type="radio" class="calc-radio" id="rdbPickup" name="rdbOrderOption" value="pickup" checked="checked">
                 <label for="rdbPickup">
                    <i class="icon-pickup"></i><br>
                    <?php echo (preg_replace('#<[^>]+>#',' ',translation('pickup')));?>
                    <p><?php echo (preg_replace('#<[^>]+>#',' ',translation('ppickup_infop')));?></p>
                  </label>
                  <div class="check"></div>
              </div>
            </div>

            <div class="col-md-4 col-sm-6 col-xs-12">
              <div class="create-doc-type-center text-center">
                <input type="radio" id="rdbDelivery" class="calc-radio" name="rdbOrderOption" value="delivery">
                 <label for="rdbDelivery">
                    <i class="icon-delivery"></i><br>
                    <?php echo (preg_replace('#<[^>]+>#',' ',translation('delivery')));?>
                    <p><?php echo (preg_replace('#<[^>]+>#',' ',translation('pdelivery_infop')));?></p>
                  </label>
                  <div class="check">
                      <div class="inside"></div>
                  </div>
              </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
              <div class="create-doc-type-end text-center">
               <input type="radio" id="rdbAramex" class="calc-radio" name="rdbOrderOption" value="aramex" >
                <label for="rdbAramex">
                  <i class="icon-aramex"></i><br>
                  <?php echo (preg_replace('#<[^>]+>#',' ',translation('aramex')));?>
                  <p><?php echo (preg_replace('#<[^>]+>#',' ',translation('paramax_infop')));?></p>
                </label>
                <div class="check">
                    <div class="inside"></div>
                </div>
              </div>
            </div>

          </div>
        </div>
        <!-- DELIVERY METHOD EOF -->
        <!-- Pickup Location BEGIN -->
          <div id="infoPickup" style="display: none;">
              <div class="col-xs-12 col-sm-12">
                  <div class="note">
                    <i class="icon-note"></i><span><?php echo (preg_replace('#<[^>]+>#',' ',translation('pnotep')));?></span> <p><?php echo (preg_replace('#<[^>]+>#',' ',translation('pplease_add_notep')));?></p>
                  </div>
              </div>
             <h4 style="color: #646464 !important"><?php echo (preg_replace('#<[^>]+>#',' ',translation('choose_your_pickup_location')));?>:</h4>
                  <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xs-12">
                        <div class="email-box-2">
                            <div class="email-title errorCountry"><?php echo (preg_replace('#<[^>]+>#',' ',translation('country')));?></div>
                            <div class="select-bock-container">
                                <select id="optCountry" name="optCountry">
                                    <option value=""><?php echo (preg_replace('#<[^>]+>#',' ',translation('pselect_your_countryp')));?></option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-12">
                        <div class="email-box-2">
                            <div class="email-title errorCity"><?php echo (preg_replace('#<[^>]+>#',' ',translation('city')));?></div>
                            <div class="select-bock-container">
                                <select id="optCity" name="optCity">
                                    <option value=""><?php echo (preg_replace('#<[^>]+>#',' ',translation('pselect_your_cityp')));?></option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="payment-method-redio">
                            <div class="row">
                                <div id="_pickupLocations" style="margin-top: 15px;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><hr></div>
                <div class="">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="btn-block-print account margin">
                            <a class="create-btn-fill account btnPickup" href="javascript:void(0);" style="display: none;"><?php echo (preg_replace('#<[^>]+>#',' ',translation('continue')));?></a>
                            <a class="create-btn-fill" href="{{url('/')}}/user/my-cart/"><?php echo (preg_replace('#<[^>]+>#',' ',translation('cancel')));?></a>
                        </div>
                    </div>
                </div>
            </div>
          </div>


        <!-- Delivery Location BEGIN -->

         <div class="row" id="infoDelivery" style="display: none;">
            <div class="col-xs-12 col-sm-12">
           
                  <div class="note">
                    <i class="icon-note"></i><span><?php echo (preg_replace('#<[^>]+>#',' ',translation('pnotep')));?></span> <p><?php echo (preg_replace('#<[^>]+>#',' ',translation('pplease_add_note_for_deliveryp')));?></p>
                  </div>
                
              </div>
             <div class="col-xs-12 col-sm-12"> <h4 style="color: #646464 !important"><?php echo (preg_replace('#<[^>]+>#',' ',translation('pplease_add_note_for_deliveryp')));?>:</h4></div>

              <div class="clearfix"></div>
              <div class="col-xs-12 col-sm-12 col-lg-6">
                  <div class="address-block defaultClass new_1" data-id="1">
              
                      <?php
                          $deliveryLocation = $userData[0]->first_name.' '.$userData[0]->last_name.'<br>'.$userData[0]->mobile_number.'<br>'.$userData[0]->address.'<br>'.$userData[0]->city_title.'<br>'.$userData[0]->country_name.' - '.$userData[0]->zipcode;
                      ?>
                      <input type="hidden" name="txtDeliveryAddress_1" value="{{$deliveryLocation}}" >
                      <input type="hidden" name="txtDeliveryAvailable_1" value="{{$userData[0]->same_day_delivery}}" >
                      <input type="hidden" name="txtDeliveryCharges_1" value="{{$userData[0]->delivery_price}}" >
                      <input type="hidden" name="txtDeliveryCity_1" value="{{$userData[0]->cityID}}" >
                      <input type="hidden" name="txtDeliveryCountry_1" value="{{$userData[0]->countryID}}" >

                      <label for="defaultClass" class="">
                        <p class="delivery-address-block-address">{{$userData[0]->first_name.''.$userData[0]->last_name}},{{$userData[0]->address}},{{$userData[0]->city_title}},{{$userData[0]->country_name.' - '.$userData[0]->zipcode}}</p>
                        <p class="delivery-address-block-phone">{{$userData[0]->mobile_number}}</p>
                        <hr>  
                        <p class="delivery-address-block-price"><?php echo (preg_replace('#<[^>]+>#',' ',translation('delivery_price')));?>:<span>SAR {{isset($userData[0]->delivery_price)?$userData[0]->delivery_price:'0.00'}}</span></p>
                      </label>

                      @if($userData[0]->same_day_delivery == "na")
                          <div class="book-add-name" style="margin-top: 10px;font-size: 14px;"><?php echo (preg_replace('#<[^>]+>#',' ',translation('pdeivery_not_availablep')));?></div>
                      @elseif($userData[0]->same_day_delivery == "yes")
                          <div class="book-add-name" style="margin-top: 10px;font-size: 14px;"><?php echo (preg_replace('#<[^>]+>#',' ',translation('same_day_deivery_available')));?></div>
                      @elseif($userData[0]->same_day_delivery == "no")
                          <div class="book-add-name" style="margin-top: 10px;font-size: 14px;"><?php echo (preg_replace('#<[^>]+>#',' ',translation('pdelivery_available_on_next_business_dayp')));?></div>
                      @endif
                  </div>
              </div>
              
              <div id="userAddresses"></div>

              <div class="col-xs-12 col-sm-12 col-lg-6">
              <div class="margin-left-none">
                <div class="delivery-address-block">
                  <input type="button" id="add-address">
                  <label for="add-address" class="">
                    <button class="add-address-btn" type="button" data-toggle="modal" data-target="#add-address-modal">
                      <i class="icon-big-plus"></i>
                      <p><?php echo (preg_replace('#<[^>]+>#',' ',translation('padd_addressp')));?></p>
                    </button>
                  </label>
                </div>
              </div>
            </div>
             <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><hr></div>
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                  <div class="btn-block-print account margin" style="margin-top: 10px;">
                      <a class="create-btn-fill account btnDelivery" href="javascript:void(0);"><?php echo (preg_replace('#<[^>]+>#',' ',translation('continue')));?></a>
                      <a class="create-btn-fill" href="{{url('/')}}/user/my-cart/"><?php echo (preg_replace('#<[^>]+>#',' ',translation('cancel')));?></a>
                  </div>
              </div>
          </div>
        <!-- Delivery Location EOF -->

        <div id="infoAramex" style="display: none;">

              <input type="hidden" id="txtFromName" name="txtFromName" value="{{ ucwords(strtolower($admin_address_info->first_name)).' '.ucwords(strtolower($admin_address_info->last_name)) }}" readonly />
              <input type="hidden" id="txtFromContact" name="txtFromContact" value="{{$admin_address_info->mobile_no}}" readonly />
              <input type="hidden" id="txtFromEmail" name="txtFromEmail" value="{{$admin_address_info->email}}" readonly />
              <input type="hidden" id="txtFromCompany" name="txtFromCompany" value="print-sa" readonly="readonly" />
              <input type="hidden" id="txtFromAddress" name="txtFromAddress" value="{{$admin_address_info->address}}" readonly />
              <input type="hidden" id="optFromCountryAramex" name="optFromCountryAramex" value="{{$admin_address_info->country}}" readonly />
              <input type="hidden" id="optFromCityAramex" name="optFromCityAramex" value="{{$admin_address_info->city}}" readonly />
              <input type="hidden" id="txtFromPostCode" name="txtFromPostCode" value="{{$admin_address_info->zip_code}}" readonly />

              <div class="userShippingDetails row">
                  <div class="col-xs-12 col-sm-12">
           
                  <div class="note">
                    <i class="icon-note"></i><span><?php echo (preg_replace('#<[^>]+>#',' ',translation('pnotep')));?></span> <p><?php echo (preg_replace('#<[^>]+>#',' ',translation('pplease_add_note_for_aramaxp')));?></p>
                  </div>
                
              </div>
                 <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                  <h4 style="color: #646464 !important"><?php echo  (preg_replace('#<[^>]+>#',' ',translation('preceivers_detailsp')));?>:</h4>
                  </div>
                  <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                      <div class="email-box-2">
                          <div class="input-block">
                              <input class="create-input" type="text" id="txtToName" name="txtToName" placeholder="<?php echo (preg_replace('#<[^>]+>#',' ',translation('penter_receivers_namep')));?>" value="" onkeypress="removeError(this.value,'errorToName',this.id);" onblur="removeError(this.value,'errorToName',this.id);" />
                          </div>
                      </div>
                  </div>

                  <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                      <div class="email-box-2">
                          <div class="input-block">
                              <input class="create-input" type="text" id="txtToContact" name="txtToContact" placeholder="<?php echo  (preg_replace('#<[^>]+>#',' ',translation('penter_receivers_contact_numberp')));?>" value="" onkeypress="removeError(this.value,'errorToContact',this.id);" onblur="removeError(this.value,'errorToContact',this.id);" />
                          </div>
                      </div>
                  </div>

                   <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                      <div class="email-box-2">
                          <div class="email-title errorToEmail"></div>
                          <div class="input-block">
                              <input class="create-input" type="text" id="txtToEmail" name="txtToEmail" placeholder="<?php echo  (preg_replace('#<[^>]+>#',' ',translation('penter_receivers_emailp')));?>" value="" onkeypress="removeError(this.value,'errorToEmail',this.id);" onblur="removeError(this.value,'errorToEmail',this.id);" />
                          </div>
                      </div>
                  </div>
                  @if(Session('userLogged.userType') == "corporate")
                  <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                      <div class="email-box-2">
                          <div class="email-title errorToCompany"></div>
                          <div class="input-block">
                              <input class="create-input" type="text" id="txtToCompany" name="txtToCompany" placeholder="<?php echo  (preg_replace('#<[^>]+>#',' ',translation('enter_receivers_company_name')));?>" value="" onkeypress="removeError(this.value,'errorToCompany',this.id);" onblur="removeError(this.value,'errorToCompany',this.id);"/>
                          </div>
                      </div>
                  </div>
                  @else
                  <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6" style="display: none;">
                      <div class="email-box-2">
                          <div class="email-title errorToCompany"></div>
                          <div class="input-block">
                              <input class="create-input" type="text" id="txtToCompany" name="txtToCompany" value="not-required" readonly="readonly" />
                          </div>
                      </div>
                  </div>
                  @endif

                  <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                      <div class="email-box-2">
                          <div class="email-title errorToAddress"></div>
                          <div class="input-block">
                              <input class="create-input" type="text" id="txtToAddress" name="txtToAddress" placeholder="<?php echo  (preg_replace('#<[^>]+>#',' ',translation('penter_addressp')));?>" onkeypress="removeError(this.value,'errorToAddress',this.id);" onblur="removeError(this.value,'errorToAddress',this.id);" />
                          </div>
                      </div>
                  </div>
                  <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                      <div class="email-box-2">
                          <div class="email-title errorToCountry"></div>
                          <div class="select-bock-container">
                              <select id="optToCountryAramex" name="optToCountryAramex">
                                  <option value=""><?php echo (preg_replace('#<[^>]+>#',' ',translation('pselect_your_countryp')));?></option>
                              </select>
                          </div>
                      </div>
                  </div>
                  <!-- <div class="clearfix"></div> -->
                  <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                      <div class="email-box-2">
                          <div class="email-title errorToCity"></div>
                          <div class="select-bock-container">
                              <select id="optToCityAramex" name="optToCityAramex">
                                  <option value=""><?php echo (preg_replace('#<[^>]+>#',' ',translation('pselect_your_cityp')));?></option>
                              </select>
                          </div>
                      </div>
                  </div>

                  <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                      <div class="email-box-2">
                          <div class="email-title errorToPostCode"></div>
                          <div class="input-block">
                              <input class="create-input" type="text" id="txtToPostCode" name="txtToPostCode" onkeypress="removeError(this.value,'errorToPostCode',this.id);" onblur="removeError(this.value,'errorToPostCode',this.id);" placeholder="<?php echo (preg_replace('#<[^>]+>#',' ',translation('penter_postal_codep')));?>" value="11221" />
                          </div>
                      </div>
                  </div>
              </div>

              <div class="row">
                  <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <!--   <p class="deliveryCharges" style="display: none;margin-top: 35px;"></p> -->
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><hr></div>
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                      <div class="btn-block-print account margin afterRateSuccess checkout-prints">
                          <a class="create-btn-fill print-deliver-btn account btnAramex" href="javascript:void(0);"><?php echo (preg_replace('#<[^>]+>#',' ',translation('continue')));?></a>
                          <a class="create-btn-fill" href="{{url('/')}}/user/my-cart/"><?php echo (preg_replace('#<[^>]+>#',' ',translation('cancel')));?></a>
                      </div>
                  </div>
              </div>
          </div>
        <div class="row">
              <div style="display: none;" id="infoPayment" >
                   <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                     <h4 style="color: #646464 !important"><?php echo (preg_replace('#<[^>]+>#',' ',translation('choose_your_payment_method')));?></h4>
                  </div>
                  <div class="payment-method-redio color-radio-btns">
                      <div class="mrg-tpspay">
                         <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                          <div class="radio-btn updateWallet wallet-btn">
                                        @if($remainWallet > $grossTotal)
                                            <form id="frmWallet" name="frmWallet" action="{{url('').config('services.paytabs.cart_success_url')}}" method="post">
                                                <input type="hidden" name="txtGrossTotal" value="{{$grossTotal}}">
                                                <input type="hidden" name="txtActive" value="1">

                                                <div class="payment-btn-block-main" >
                                                    <a href="javascript:void(0);" id="payViaWallet" class="wallet-btn-block new-wallet-btn paywallet">
                                                        <span class="img-span-block"><img src="{{url('')}}/front-assets/images/wallet-icon-img.png" alt=""> </span>
                                                        <span class="text-span-block">
                                                            <span class="text-wallet"><?php echo (preg_replace('#<[^>]+>#',' ',translation('wallet')));?></span>
                                                            <span class="wallet-cash-block">SAR {{number_format($remainWallet,2,'.','')}}</span>
                                                        </span>
                                                    </a>
                                                </div>
                                            </form>
                                        @else
                                            <div class="payment-btn-block-main" >
                                                <a href="javascript:void(0);" id="unableToPay" class="wallet-btn-block">
                                                    <span class="img-span-block"><img src="{{url('')}}/front-assets/images/wallet-icon-img.png" alt=""> </span>
                                                    <span class="text-span-block">
                                                        <span class="text-wallet"><?php echo (preg_replace('#<[^>]+>#',' ',translation('wallet')));?></span>
                                                        <span class="wallet-cash-block">SAR {{number_format($remainWallet,2,'.','')}}</span>
                                                    </span>
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                          </div>
                              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                                    <div class="radio-btn">
                                        <div class="PT_express_checkout"></div>
                                    </div>
                              </div>
                      </div>
                      <div class="clearfix"></div>
                      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><hr></div>
                      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                          <div class="btn-block-print account margin">
                              <a class="create-btn account btnCancelPayment" href="javascript:void(0);"><?php echo (preg_replace('#<[^>]+>#',' ',translation('cancel')));?></a>
                          </div>
                      </div>
                  </div>
              </div>
        
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="display:none ;" id="paymentLoader">
                  <div class="email-title"><?php echo (preg_replace('#<[^>]+>#',' ',translation('please_wait')));?></div>
                  <div class="payment-method-redio color-radio-btns" style="text-align: center;">
                      <img src="{{url('').'/front-assets/images/order-processing.gif'}}" alt="order-processing">
                      <div class="clearfix"></div>
                  </div>
              </div>
       </div>

    </div>
    <!-- CREATE CONTENT EOF -->
  </div>

</section>
<script type="text/javascript">
  $(document).ready(function() 
    { 
       jQuery('#frm_address').validate({
           
      });
    });
</script>  