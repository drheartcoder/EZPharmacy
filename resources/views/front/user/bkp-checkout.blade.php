<style type="text/css">
.error-text-color{color: #F00 !important;}
.error-text-color::-webkit-input-placeholder {
color: red !important;
}
.error-text-color:-moz-placeholder { /* Firefox 18- */
color: red !important;  
}
.error-text-color::-moz-placeholder {  /* Firefox 19+ */
color: red !important;  
}

.error-text-color:-ms-input-placeholder {  
color: red !important;  
}
.activeClass{border: 1px solid green;}
.defaultClass{cursor: pointer;}
.nav-pills>li._success>a, .nav-pills>li._success>a:focus, .nav-pills>li._success>a:hover {
    color: #fff;
    background-color: #7eb858;
    }
</style>
@include('front.user._inner-breadcrumbs')
<div class="dash-main-block">
    <div class="container">
        <div class="row">
            <div>
                @include('front.user.left-navigation')
            </div>
            <div class="col-xs-12 col-sm-8 col-md-9 col-lg-9">
                <div class="row form-group">
                    <div class="col-xs-12">
                        <ul class="nav nav-pills nav-justified thumbnail setup-panel">

                            <li class="_success">
                                <a href="javascript:void(0);">
                                    <h4 class="list-group-item-heading"><?php echo (preg_replace('#<[^>]+>#',' ',translation('step_1'))); ?></h4>
                                    <p class="list-group-item-text"><?php echo (preg_replace('#<[^>]+>#',' ',translation('upload_file'))); ?></p>
                                </a>
                            </li>
                            <li class="_success">
                                <a href="javascript:void(0);">
                                    <h4 class="list-group-item-heading"><?php echo (preg_replace('#<[^>]+>#',' ',translation('step_2'))); ?></h4>
                                    <p class="list-group-item-text"><?php echo (preg_replace('#<[^>]+>#',' ',translation('document'))); ?> &amp; <?php echo (preg_replace('#<[^>]+>#',' ',translation('its_attributes'))); ?></p>
                                </a>
                            </li>
                            <li class="_success">
                                <a href="javascript:void(0);">
                                    <h4 class="list-group-item-heading"><?php echo (preg_replace('#<[^>]+>#',' ',translation('step_3'))); ?></h4>
                                    <p class="list-group-item-text"><?php echo (preg_replace('#<[^>]+>#',' ',translation('cart'))); ?></p>
                                </a>
                            </li>
                            
                            <li class="active">
                                <a href="javascript:void(0);">
                                    <h4 class="list-group-item-heading"><?php echo (preg_replace('#<[^>]+>#',' ',translation('step_4'))); ?></h4>
                                    <p class="list-group-item-text"><?php echo (preg_replace('#<[^>]+>#',' ',translation('checkout_button'))); ?></p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="full-white-box">

                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="email-title" style="text-align: right;">
                                <p>
                                    <?php echo (preg_replace('#<[^>]+>#',' ',translation('total_price'))); ?> <small>SAR</small>
                                    <span style="font-weight: bold;"> {{number_format($actualAmount,2,'.','')}}</span>
                                </p>
                                <p>
                                    <?php echo (preg_replace('#<[^>]+>#',' ',translation('processing_fee'))); ?><small>({{$processingFee}}%)</small>: <small>SAR</small>
                                    <span style="font-weight: bold;"> {{number_format($processingCharge,2,'.','')}}</span>
                                </p>
                                <p class="deliveryCharges" style="display: none;"></p>
                                <p>
                                    <?php echo (preg_replace('#<[^>]+>#',' ',translation('total_price'))); ?>:
                                    <small>SAR</small>
                                    <span style="font-weight: bold;" class="grossTotal"> {{number_format($grossTotal,2,'.','')}}</span>
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-12" id="radioOptions">

                            <div class="payment-method-redio color-radio-btns pay-radio">
                                <div class="mrg-tpspay">
                                    <div class="radio-btn">
                                        <div class="paymt-radio box-color-radio">
                                            <input type="radio" id="rdbPickup" name="rdbOrderOption" value="pickup">
                                            <label for="rdbPickup"><?php echo (preg_replace('#<[^>]+>#',' ',translation('pickup'))); ?></label>
                                            <div class="check"></div>
                                        </div>
                                    </div>
                                    <div class="radio-btn">
                                       <div class="paymt-radio box-color-radio">
                                            <input type="radio" id="rdbDelivery" name="rdbOrderOption" value="delivery">
                                            <label for="rdbDelivery"><?php echo (preg_replace('#<[^>]+>#',' ',translation('delivery'))); ?></label>
                                            <div class="check">
                                                <div class="inside"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="radio-btn">
                                       <div class="paymt-radio box-color-radio">
                                            <input type="radio" id="rdbAramex" name="rdbOrderOption" value="aramex" checked="checked">
                                            <label for="rdbAramex"><?php echo (preg_replace('#<[^>]+>#',' ',translation('aramex'))); ?></label>
                                            <div class="check">
                                                <div class="inside"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        
                        <div class="col-sm-12 col-md-12 col-lg-12" id="infoPickup" style="display: none;">
                            
                            <div class="email-title"><?php echo (preg_replace('#<[^>]+>#',' ',translation('choose_your_pickup_location'))); ?></div>

                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="email-box-2">
                                    <div class="email-title errorCountry"><?php echo (preg_replace('#<[^>]+>#',' ',translation('country'))); ?></div>
                                    <div class="select-bock-container">
                                        <select id="optCountry" name="optCountry">
                                            <option value=""><?php echo (preg_replace('#<[^>]+>#',' ',translation('select'))); ?></option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="email-box-2">
                                    <div class="email-title errorCity"><?php echo (preg_replace('#<[^>]+>#',' ',translation('city'))); ?></div>
                                    <div class="select-bock-container">
                                        <select id="optCity" name="optCity">
                                            <option value=""><?php echo (preg_replace('#<[^>]+>#',' ',translation('select'))); ?></option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="payment-method-redio">
                                    <div class="row">
                                        <div id="_pickupLocations" style="margin-top: 15px;"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="btn-block-print account margin">
                                    <a class="print-deliver-btn account btnPickup" href="javascript:void(0);" style="display: none;"><?php echo (preg_replace('#<[^>]+>#',' ',translation('continue'))); ?></a>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-12" id="infoDelivery" style="display: none;">

                            <div class="email-title"><?php echo (preg_replace('#<[^>]+>#',' ',translation('choose_your_delivery_location'))); ?></div>

                            <div class="clearfix"></div>
                            <div class="col-sm-4 col-md-4 col-lg-4">
                                <div class="address-block defaultClass new_1" data-id="1">
                            
                                    <?php
                                        $deliveryLocation = $userData[0]->first_name.' '.$userData[0]->last_name.'<br>'.$userData[0]->mobile_number.'<br>'.$userData[0]->address.'<br>'.$userData[0]->city_title.'<br>'.$userData[0]->country_name.' - '.$userData[0]->zipcode;
                                    ?>
                                    <input type="hidden" name="txtDeliveryAddress_1" value="{{$deliveryLocation}}" >
                                    <input type="hidden" name="txtDeliveryAvailable_1" value="{{$userData[0]->same_day_delivery}}" >
                                    <input type="hidden" name="txtDeliveryCharges_1" value="{{$userData[0]->delivery_price}}" >
                                    <input type="hidden" name="txtDeliveryCity_1" value="{{$userData[0]->cityID}}" >
                                    <input type="hidden" name="txtDeliveryCountry_1" value="{{$userData[0]->countryID}}" >
                                    <div class="book-add-name">{{$userData[0]->first_name.''.$userData[0]->last_name}}</div>
                                    <div class="add-sml-text" style="margin-right: 0px;line-height: 20px;">
                                        <i class="fa fa-phone"></i> {{$userData[0]->mobile_number}}<br><i class="fa fa-map-marker"></i> {{$userData[0]->address}}<br>{{$userData[0]->city_title}}<br>{{$userData[0]->country_name.' - '.$userData[0]->zipcode}}
                                    </div>

                                    @if($userData[0]->same_day_delivery == "na")
                                        <div class="book-add-name" style="margin-top: 10px;font-size: 14px;"><?php echo translation('pdeivery_not_availablep');?></div>
                                    @elseif($userData[0]->same_day_delivery == "yes")
                                        <div class="book-add-name" style="margin-top: 10px;font-size: 14px;"><?php echo translation('same_day_deivery_available');?></div>
                                    @elseif($userData[0]->same_day_delivery == "no")
                                        <div class="book-add-name" style="margin-top: 10px;font-size: 14px;"><?php echo translation('pdelivery_available_on_next_business_dayp');?></div>
                                    @endif
                                    
                                    <div class="book-add-name" style="margin-top: 10px;font-size: 14px;">SAR {{$userData[0]->delivery_price}}</div>
                                </div>

                            </div>
                            <div id="userAddresses"></div>

                            <div class="clearfix"></div>
                            <div class="col-sm-12 col-md-12 col-lg-12 userNewAddress">
                                <div style="position: relative;" >
                                    <button style="top:-25px !important;" type="button" href="#collapse1" class="btn btn-default new-add-btn-block nav-toggle" ><i class="fa fa-plus"></i><?php echo (preg_replace('#<[^>]+>#',' ',translation('new_address'))); ?></button>
                                    <div id="collapse1" style="display: none;">
                                        <div class="white-block">
                                            <div class="col-sm-6 col-md-6 col-lg-6">
                                                <div class="email-box-2">
                                                    <div class="email-title errorName"><?php echo (preg_replace('#<[^>]+>#',' ',translation('name'))); ?></div>
                                                    <div class="input-block">

                                                        <input type="text" id="txtFullName" name="txtFullName" placeholder="<?php echo (preg_replace('#<[^>]+>#',' ',translation('enter_your_fullname'))); ?>" onkeypress="removeError(this.value,'errorName',this.id);" onblur="removeError(this.value,'errorName',this.id);" />

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-6">
                                                <div class="email-box-2">
                                                    <div class="email-title errorStreetAddress"><?php echo (preg_replace('#<[^>]+>#',' ',translation('street_address'))); ?></div>
                                                    <div class="input-block">

                                                        <input type="text" id="streetAddress" name="streetAddress" onkeypress="removeError(this.value,'errorStreetAddress',this.id);" onblur="removeError(this.value,'errorStreetAddress',this.id);" placeholder="<?php echo (preg_replace('#<[^>]+>#',' ',translation('enter_your_street_address'))); ?>" />

                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-12 col-md-6 col-lg-6">
                                                <div class="email-box-2">
                                                    <div class="email-title errorCountryDelivery"><?php echo (preg_replace('#<[^>]+>#',' ',translation('country'))); ?></div>
                                                    <div class="select-bock-container">

                                                        <select id="optCountryDelivery" name="optCountryDelivery" onchange="removeError(this.value,'errorCountryDelivery',this.id);" placeholder="<?php echo (preg_replace('#<[^>]+>#',' ',translation('select'))); ?>">
                                                            <option value=""><?php echo (preg_replace('#<[^>]+>#',' ',translation('select'))); ?></option>

                                                        </select>
                                                    </div>
                                                </div>                                                    
                                            </div>
                                            <div class="col-sm-12 col-md-6 col-lg-6">
                                                <div class="email-box-2">
                                                    <div class="email-title errorCityDelivery"><?php echo (preg_replace('#<[^>]+>#',' ',translation('city'))); ?></div>
                                                    <div class="select-bock-container">

                                                        <select id="optCityDelivery" name="optCityDelivery" onchange="removeError(this.value,'errorCityDelivery',this.id)" placeholder="<?php echo (preg_replace('#<[^>]+>#',' ',translation('select'))); ?>">
                                                            <option value="" disabled="disabled" selected="selected"><?php echo (preg_replace('#<[^>]+>#',' ',translation('select'))); ?></option>

                                                        </select>
                                                    </div>
                                                </div>                                                    
                                            </div>
                                            
                                            <div class="col-sm-6 col-md-6 col-lg-6">
                                                <div class="email-box-2">
                                                    <div class="email-title errorPostalcode"><?php echo (preg_replace('#<[^>]+>#',' ',translation('postal
                                                    _code'))); ?></div>
                                                    <div class="input-block">

                                                        <input type="text" id="txtPostalCode" name="txtPostalCode" onkeypress="removeError(this.value,'errorPostalcode',this.id);" onblur="removeError(this.value,'errorPostalcode',this.id);" placeholder="<?php echo (preg_replace('#<[^>]+>#',' ',translation('enter_your_postal_code'))); ?>" />

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-md-6 col-lg-6">
                                                <div class="email-box-2">
                                                    <div class="email-title errorPhoneNum"><?php echo (preg_replace('#<[^>]+>#',' ',translation('phone_number'))); ?></div>
                                                    <div class="input-block">

                                                        <input type="text" id="txtPhoneNum" name="txtPhoneNum" onkeypress="removeError(this.value,'errorPhoneNum',this.id);" onblur="removeError(this.value,'errorPhoneNum',this.id);" placeholder="<?php echo (preg_replace('#<[^>]+>#',' ',translation('enter_your_contact_number'))); ?>" />

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="col-sm-12 col-md-12 col-lg-12">
                                                
                                                    {{-- <button class="continue-btn-form" type="button" id="btnSaveAddress" name="btnSaveAddress"> --}}
                                                    <div class="btn-block-print account margin">
                                                    <button type="button" class="print-deliver-btn" id="btnSaveAddress" name="btnSaveAddress">
                                                    <?php echo (preg_replace('#<[^>]+>#',' ',translation('save'))); ?></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="btn-block-print account margin" style="margin-top: 10px;">
                                    <a class="print-deliver-btn account btnDelivery" href="javascript:void(0);"><?php echo (preg_replace('#<[^>]+>#',' ',translation('continue'))); ?></a>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-12" id="infoAramex" style="display: none;">

                         
                  
                        


                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="pro-picture-title"> <?php echo  (preg_replace('#<[^>]+>#',' ',translation('psenders_detailsp')));?></div>

                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="email-box-2">
                                        <div class="email-title errorFromName"> <?php echo  (preg_replace('#<[^>]+>#',' ',translation('pfrom_namep')));?></div>
                                        <div class="input-block">
                                            <input type="text" id="txtFromName" name="txtFromName" placeholder="<?php echo  (preg_replace('#<[^>]+>#',' ',translation('penter_senders_namep')));?>" value="{{ucwords(strtolower($userData[0]->full_name))}}" onkeypress="removeError(this.value,'errorFromName',this.id);" onblur="removeError(this.value,'errorFromName',this.id);" />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="email-box-2">
                                        <div class="email-title errorFromContact"><?php echo (preg_replace('#<[^>]+>#',' ',translation('contact_number'))); ?></div>
                                        <div class="input-block">
                                            <input type="text" id="txtFromContact" name="txtFromContact" placeholder="<?php echo (preg_replace('#<[^>]+>#',' ',translation('enter_senders_contact_number'))); ?>" value="{{$userData[0]->mobile_number}}" onkeypress="removeError(this.value,'errorFromContact',this.id);" onblur="removeError(this.value,'errorFromContact',this.id);" />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="email-box-2">

                                        <div class="email-title errorFromEmail"><?php echo (preg_replace('#<[^>]+>#',' ',translation('email_address'))); ?></div>
                                        <div class="input-block">
                                            <input type="text" id="txtFromEmail" name="txtFromEmail" placeholder="<?php echo (preg_replace('#<[^>]+>#',' ',translation('enter_senders_email'))); ?>" value="{{$userData[0]->email_address}}" onkeypress="removeError(this.value,'errorFromEmail',this.id);" onblur="removeError(this.value,'errorFromEmail',this.id);" />
                                        </div>
                                    </div>
                                </div>

                                @if(Session('userLogged.userType') == "corporate")
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="email-box-2">
                                        <div class="email-title errorFromCompany"><?php echo (preg_replace('#<[^>]+>#',' ',translation('company_name'))); ?></div>
                                        <div class="input-block">
                                            <input type="text" id="txtFromCompany" name="txtFromCompany" placeholder="<?php echo (preg_replace('#<[^>]+>#',' ',translation('enter_senders_company_name'))); ?>" value="{{$userData[0]->company_name}}" onkeypress="removeError(this.value,'errorFromCompany',this.id);" onblur="removeError(this.value,'errorFromCompany',this.id);"/>
                                        </div>
                                    </div>
                                </div>
                                @else
                                <div class="col-sm-6 col-md-6 col-lg-6" style="display: block;">
                                    <div class="email-box-2">
                                        <div class="email-title errorFromCompany"><?php echo (preg_replace('#<[^>]+>#',' ',translation('company_name'))); ?></div>
                                        <div class="input-block">
                                            <input type="text" id="txtFromCompany" name="txtFromCompany" value="not-required" readonly="readonly" />
                                        </div>
                                    </div>
                                </div>
                                @endif

                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="email-box-2">
                                        <div class="email-title errorFromAddress"><?php echo (preg_replace('#<[^>]+>#',' ',translation('address'))); ?></div>
                                        <div class="input-block">
                                            <input type="text" id="txtFromAddress" name="txtFromAddress" placeholder="<?php echo (preg_replace('#<[^>]+>#',' ',translation('street_address'))); ?>" value="{{$userData[0]->address}}" onkeypress="removeError(this.value,'errorFromAddress',this.id);" onblur="removeError(this.value,'errorFromAddress',this.id);" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="email-box-2">
                                        <div class="email-title errorFromCountry"><?php echo (preg_replace('#<[^>]+>#',' ',translation('country'))); ?></div>
                                        <div class="select-bock-container">
                                            <select id="optFromCountryAramex" name="optFromCountryAramex">
                                                <option value=""><?php echo (preg_replace('#<[^>]+>#',' ',translation('select'))); ?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="clearfix"></div> -->
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="email-box-2">
                                        <div class="email-title errorFromCity"><?php echo (preg_replace('#<[^>]+>#',' ',translation('city'))); ?></div>
                                        <div class="select-bock-container">
                                            <select id="optFromCityAramex" name="optFromCityAramex">
                                                <option value=""><?php echo (preg_replace('#<[^>]+>#',' ',translation('select'))); ?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="email-box-2">
                                        <div class="email-title errorFromPostCode"><?php echo (preg_replace('#<[^>]+>#',' ',translation('postal_code'))); ?></div>
                                        <div class="input-block">
                                            <input type="text" id="txtFromPostCode" name="txtFromPostCode" value="{{$userData[0]->zipcode}}" onkeypress="removeError(this.value,'errorFromPostCode',this.id);" onblur="removeError(this.value,'errorFromPostCode',this.id);" placeholder="<?php echo (preg_replace('#<[^>]+>#',' ',translation('enter_your_postal_code'))); ?>" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="pro-picture-title"> <?php echo  (preg_replace('#<[^>]+>#',' ',translation('preceivers_detailsp')));?></div>

                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="email-box-2">
                                        <div class="email-title errorToName">   <?php echo  (preg_replace('#<[^>]+>#',' ',translation('pto_namep')));?></div>
                                        <div class="input-block">
                                            <input type="text" id="txtToName" name="txtToName" placeholder="    <?php echo  (preg_replace('#<[^>]+>#',' ',translation('penter_receivers_namep')));?>" value="" onkeypress="removeError(this.value,'errorToName',this.id);" onblur="removeError(this.value,'errorToName',this.id);" />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="email-box-2">
                                        <div class="email-title errorToContact"><?php echo translation('contact_number');?></div>
                                        <div class="input-block">
                                            <input type="text" id="txtToContact" name="txtToContact" placeholder="  <?php echo  (preg_replace('#<[^>]+>#',' ',translation('penter_receivers_contact_numberp')));?>" value="" onkeypress="removeError(this.value,'errorToContact',this.id);" onblur="removeError(this.value,'errorToContact',this.id);" />
                                        </div>
                                    </div>
                                </div>

                                 <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="email-box-2">
                                        <div class="email-title errorToEmail"><?php echo (preg_replace('#<[^>]+>#',' ',translation('email_address'))); ?></div>
                                        <div class="input-block">
                                            <input type="text" id="txtToEmail" name="txtToEmail" placeholder="  <?php echo  (preg_replace('#<[^>]+>#',' ',translation('penter_receivers_emailp')));?>" value="" onkeypress="removeError(this.value,'errorToEmail',this.id);" onblur="removeError(this.value,'errorToEmail',this.id);" />
                                        </div>
                                    </div>
                                </div>
                                @if(Session('userLogged.userType') == "corporate")
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="email-box-2">
                                        <div class="email-title errorToCompany"><?php echo (preg_replace('#<[^>]+>#',' ',translation('company_name'))); ?></div>
                                        <div class="input-block">
                                            <input type="text" id="txtToCompany" name="txtToCompany" placeholder="<?php echo translation('enter_receivers_company_name');?>" value="" onkeypress="removeError(this.value,'errorToCompany',this.id);" onblur="removeError(this.value,'errorToCompany',this.id);"/>
                                        </div>
                                    </div>
                                </div>
                                @else
                                <div class="col-sm-6 col-md-6 col-lg-6" style="display: block;">
                                    <div class="email-box-2">
                                        <div class="email-title errorToCompany"><?php echo (preg_replace('#<[^>]+>#',' ',translation('company_name'))); ?></div>
                                        <div class="input-block">
                                            <input type="text" id="txtToCompany" name="txtToCompany" value="not-required" readonly="readonly" />
                                        </div>
                                    </div>
                                </div>
                                @endif

                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="email-box-2">

                                        <div class="email-title errorToAddress"><?php echo (preg_replace('#<[^>]+>#',' ',translation('address'))); ?></div>
                                        <div class="input-block">
                                            <input type="text" id="txtToAddress" name="txtToAddress" placeholder="<?php echo (preg_replace('#<[^>]+>#',' ',translation('street_address'))); ?>" onkeypress="removeError(this.value,'errorToAddress',this.id);" onblur="removeError(this.value,'errorToAddress',this.id);" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="email-box-2">
                                        <div class="email-title errorToCountry"><?php echo (preg_replace('#<[^>]+>#',' ',translation('country'))); ?></div>
                                        <div class="select-bock-container">
                                            <select id="optToCountryAramex" name="optToCountryAramex">
                                                <option value=""><?php echo (preg_replace('#<[^>]+>#',' ',translation('select'))); ?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="clearfix"></div> -->
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="email-box-2">
                                        <div class="email-title errorToCity"><?php echo (preg_replace('#<[^>]+>#',' ',translation('city'))); ?></div>
                                        <div class="select-bock-container">
                                            <select id="optToCityAramex" name="optToCityAramex">
                                                <option value=""><?php echo (preg_replace('#<[^>]+>#',' ',translation('select'))); ?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="email-box-2">
                                        <div class="email-title errorToPostCode"><?php echo (preg_replace('#<[^>]+>#',' ',translation('postal_code'))); ?></div>
                                        <div class="input-block">
                                            <input type="text" id="txtToPostCode" name="txtToPostCode" onkeypress="removeError(this.value,'errorToPostCode',this.id);" onblur="removeError(this.value,'errorToPostCode',this.id);" placeholder="<?php echo (preg_replace('#<[^>]+>#',' ',translation('enter_your_postal_code'))); ?>" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <p class="deliveryCharges" style="display: none;margin-top: 35px;"></p>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="btn-block-print account margin afterRateSuccess">
                                        <a class="print-deliver-btn account btnAramex" href="javascript:void(0);"><?php echo (preg_replace('#<[^>]+>#',' ',translation('continue'))); ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-12" style="display: none;" id="infoPayment" >
                           <div class="email-title"><?php echo translation('choose_your_payment_method');?></div>
                            <div class="payment-method-redio color-radio-btns">
                                <div class="mrg-tpspay">
                                    <div class="radio-btn updateWallet wallet-btn">
                                        @if($remainWallet > $grossTotal)
                                            <form id="frmWallet" name="frmWallet" action="{{url('').config('services.paytabs.cart_success_url')}}" method="post">
                                                <input type="hidden" name="txtGrossTotal" value="{{$grossTotal}}">
                                                <input type="hidden" name="txtActive" value="1">

                                                <div class="payment-btn-block-main" >
                                                    <a href="javascript:void(0);" id="payViaWallet" class="wallet-btn-block new-wallet-btn">
                                                        <span class="img-span-block"><img src="{{url('')}}/front-assets/images/wallet-icon-img.png" alt=""> </span>
                                                        <span class="text-span-block">
                                                            <span class="text-wallet"><?php echo (preg_replace('#<[^>]+>#',' ',translation('wallet'))); ?></span>
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
                                                        <span class="text-wallet"><?php echo (preg_replace('#<[^>]+>#',' ',translation('wallet'))); ?></span>
                                                        <span class="wallet-cash-block">SAR {{number_format($remainWallet,2,'.','')}}</span>
                                                    </span>
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="radio-btn">
                                        <div class="PT_express_checkout"></div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <div class="btn-block-print account margin">
                                        <a class="print-deliver-btn account btnCancelPayment" href="javascript:void(0);"><?php echo (preg_replace('#<[^>]+>#',' ',translation('cancel'))); ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-sm-12 col-md-12 col-lg-12" style="display:none ;" id="paymentLoader">
                            <div class="email-title"><?php echo (preg_replace('#<[^>]+>#',' ',translation('please_wait'))); ?>;?></div>
                            <div class="payment-method-redio color-radio-btns" style="text-align: center;">
                                <img src="{{url('').'/front-assets/images/order-processing.gif'}}" alt="order-processing">
                                <div class="clearfix"></div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
