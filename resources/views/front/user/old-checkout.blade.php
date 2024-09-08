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
            <div class="col-sm-8 col-md-9 col-lg-9">
                <div class="row form-group">
                    <div class="col-xs-12">
                        <ul class="nav nav-pills nav-justified thumbnail setup-panel">

                            <li class="_success">
                                <a href="javascript:void(0);">
                                    <h4 class="list-group-item-heading"><?php echo translation('step_1');?></h4>
                                    <p class="list-group-item-text"><?php echo translation('upload_file');?></p>
                                </a>
                            </li>
                            <li class="_success">
                                <a href="javascript:void(0);">
                                    <h4 class="list-group-item-heading"><?php echo translation('step_2');?></h4>
                                    <p class="list-group-item-text"><?php echo translation('document');?> &amp; <?php echo translation('its_attributes');?></p>
                                </a>
                            </li>
                            <li class="_success">
                                <a href="javascript:void(0);">
                                    <h4 class="list-group-item-heading"><?php echo translation('step_3');?></h4>
                                    <p class="list-group-item-text"><?php echo translation('cart');?></p>
                                </a>
                            </li>
                            
                            <li class="active">
                                <a href="javascript:void(0);">
                                    <h4 class="list-group-item-heading"><?php echo translation('step_4');?></h4>
                                    <p class="list-group-item-text"><?php echo translation('checkout_button');?></p>
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

                                    <?php echo translation('total_price');?> <small>SAR</small>

                                    <span style="font-weight: bold;"> {{number_format($actualAmount,2,'.','')}}</span>
                                </p>
                                <p>
                                    <?php echo translation('processing_fee');?><small>({{$processingFee}}%)</small> <small>SAR</small>
                                    <span style="font-weight: bold;"> {{number_format($processingCharge,2,'.','')}}</span>
                                </p>
                                <p class="deliveryCharges" style="display: none;"></p>
                                <p>
                                    <?php echo translation('total_price');?>
                                    <small>SAR</small>
                                    <span style="font-weight: bold;" class="grossTotal"> {{number_format($grossTotal,2,'.','')}}</span>
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-12" id="radioOptions">

                            <div class="payment-method-redio color-radio-btns">
                                <div class="mrg-tpspay">
                                    <div class="radio-btn">
                                        <div class="paymt-radio box-color-radio">
                                            <input type="radio" id="rdbPickup" name="rdbOrderOption" value="pickup">
                                            <label for="rdbPickup"><?php echo translation('pickup');?></label>
                                            <div class="check"></div>
                                        </div>
                                    </div>
                                    <div class="radio-btn">
                                       <div class="paymt-radio box-color-radio">
                                            <input type="radio" id="rdbDelivery" name="rdbOrderOption" value="delivery">
                                            <label for="rdbDelivery"><?php echo translation('delivery');?></label>
                                            <div class="check">
                                                <div class="inside"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="radio-btn">
                                       <div class="paymt-radio box-color-radio">
                                            <input type="radio" id="rdbAramex" name="rdbOrderOption" value="aramex" checked="checked">
                                            <label for="rdbAramex"><?php echo translation('aramex');?></label>
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
                            <?php
                                $myLocation = urlencode('125 George Street, The Rocks, New South Wales, Australia');
                                $myLocation = urlencode('Pune - Mumbai Road, Sidhivinayak Nagari, Chinchwad, Maharashtra, India');
                            ?>
                            
                            <div class="email-title"><?php echo translation('choose_your_pickup_location');?></div>

                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="email-box-2">
                                    <div class="email-title errorCountry"><?php echo translation('country');?></div>
                                    <div class="select-bock-container">
                                        <select id="optCountry" name="optCountry">
                                            <option value=""><?php echo translation('select');?></option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="email-box-2">
                                    <div class="email-title errorCity"><?php echo translation('city');?></div>
                                    <div class="select-bock-container">
                                        <select id="optCity" name="optCity">
                                            <option value=""><?php echo translation('select');?></option>
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
                                    <a class="print-deliver-btn account btnPickup" href="javascript:void(0);" style="display: none;"><?php echo translation('continue');?></a>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-12" id="infoDelivery" style="display: none;">

                            <div class="email-title"><?php echo translation('choose_your_delivery_location');?></div>

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
                                        <div class="book-add-name" style="margin-top: 10px;font-size: 14px;"><?php echo translation('deivery_not_available');?></div>
                                    @elseif($userData[0]->same_day_delivery == "yes")
                                        <div class="book-add-name" style="margin-top: 10px;font-size: 14px;"><?php echo translation('same_day_deivery_available');?></div>
                                    @elseif($userData[0]->same_day_delivery == "no")
                                        <div class="book-add-name" style="margin-top: 10px;font-size: 14px;"><?php echo translation('delivery_available_on_next_business_day');?></div>
                                    @endif
                                    
                                    <div class="book-add-name" style="margin-top: 10px;font-size: 14px;">SAR {{$userData[0]->delivery_price}}</div>
                                </div>

                            </div>
                            <div id="userAddresses"></div>

                            <div class="clearfix"></div>
                            <div class="col-sm-12 col-md-12 col-lg-12 userNewAddress">
                                <div style="position: relative;" >
                                    <button style="top:-25px !important;" type="button" href="#collapse1" class="btn btn-default new-add-btn-block nav-toggle" ><i class="fa fa-plus"></i><?php echo translation('new_address');?></button>
                                    <div id="collapse1" style="display: none;">
                                        <div class="white-block">
                                            <div class="col-sm-6 col-md-6 col-lg-6">
                                                <div class="email-box-2">
                                                    <div class="email-title errorName"><?php echo translation('name');?></div>
                                                    <div class="input-block">

                                                        <input type="text" id="txtFullName" name="txtFullName" placeholder="<?php echo translation('enter_your_fullname');?>" onkeypress="removeError(this.value,'errorName',this.id);" onblur="removeError(this.value,'errorName',this.id);" />

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-6">
                                                <div class="email-box-2">
                                                    <div class="email-title errorStreetAddress"><?php echo translation('street_address');?></div>
                                                    <div class="input-block">

                                                        <input type="text" id="streetAddress" name="streetAddress" onkeypress="removeError(this.value,'errorStreetAddress',this.id);" onblur="removeError(this.value,'errorStreetAddress',this.id);" placeholder="<?php echo translation('enter_your_street_address');?>" />

                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-12 col-md-6 col-lg-6">
                                                <div class="email-box-2">
                                                    <div class="email-title errorCountryDelivery"><?php echo translation('country');?></div>
                                                    <div class="select-bock-container">

                                                        <select id="optCountryDelivery" name="optCountryDelivery" onchange="removeError(this.value,'errorCountryDelivery',this.id);" placeholder="<?php echo translation('select');?>">
                                                            <option value=""><?php echo translation('select');?></option>

                                                        </select>
                                                    </div>
                                                </div>                                                    
                                            </div>
                                            <div class="col-sm-12 col-md-6 col-lg-6">
                                                <div class="email-box-2">
                                                    <div class="email-title errorCityDelivery"><?php echo translation('city');?></div>
                                                    <div class="select-bock-container">

                                                        <select id="optCityDelivery" name="optCityDelivery" onchange="removeError(this.value,'errorCityDelivery',this.id)" placeholder="<?php echo translation('select');?>">
                                                            <option value="" disabled="disabled" selected="selected"><?php echo translation('select');?></option>

                                                        </select>
                                                    </div>
                                                </div>                                                    
                                            </div>
                                            
                                            <div class="col-sm-6 col-md-6 col-lg-6">
                                                <div class="email-box-2">
                                                    <div class="email-title errorPostalcode"><?php echo translation('postal_code');?></div>
                                                    <div class="input-block">

                                                        <input type="text" id="txtPostalCode" name="txtPostalCode" onkeypress="removeError(this.value,'errorPostalcode',this.id);" onblur="removeError(this.value,'errorPostalcode',this.id);" placeholder="<?php echo translation('enter_your_postal_code');?>" />

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-md-6 col-lg-6">
                                                <div class="email-box-2">
                                                    <div class="email-title errorPhoneNum"><?php echo translation('phone_number');?></div>
                                                    <div class="input-block">

                                                        <input type="text" id="txtPhoneNum" name="txtPhoneNum" onkeypress="removeError(this.value,'errorPhoneNum',this.id);" onblur="removeError(this.value,'errorPhoneNum',this.id);" placeholder="<?php echo translation('enter_your_contact_number');?>" />

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="col-sm-12 col-md-12 col-lg-12">
                                                
                                                    {{-- <button class="continue-btn-form" type="button" id="btnSaveAddress" name="btnSaveAddress"> --}}
                                                    <div class="btn-block-print account margin">
                                                    <button type="button" class="print-deliver-btn" id="btnSaveAddress" name="btnSaveAddress">
                                                    <?php echo translation('save');?></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="btn-block-print account margin" style="margin-top: 10px;">
                                    <a class="print-deliver-btn account btnDelivery" href="javascript:void(0);"><?php echo translation('continue');?></a>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-12" id="infoAramex" style="display: none;">
                            <pre>
                                {{dump($userData)}}
                            </pre>
                            <!-- <div class="pro-picture-title line"><?php //echo translation('aramex');?></div> -->

                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="pro-picture-title">Sender's Details</div>

                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="email-box-2">
                                        <div class="email-title errorFromName"><?php echo translation('from_name');?></div>
                                        <div class="input-block">
                                            <input type="text" id="txtFromName" name="txtFromName" placeholder="<?php echo translation('enter_senders_name');?>" value="{{ucwords(strtolower($userData[0]->full_name))}}" onkeypress="removeError(this.value,'errorFromName',this.id);" onblur="removeError(this.value,'errorFromName',this.id);" />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="email-box-2">
                                        <div class="email-title errorFromContact"><?php echo translation('contact_number');?></div>
                                        <div class="input-block">
                                            <input type="text" id="txtFromContact" name="txtFromContact" placeholder="<?php echo translation('enter_senders_contact_number');?>" value="{{$userData[0]->mobile_number}}" onkeypress="removeError(this.value,'errorFromContact',this.id);" onblur="removeError(this.value,'errorFromContact',this.id);" />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="email-box-2">
                                        <div class="email-title errorFromEmail"><?php echo translation('email_address');?></div>
                                        <div class="input-block">
                                            <input type="text" id="txtFromEmail" name="txtFromEmail" placeholder="<?php echo translation('enter_senders_email');?>" value="{{$userData[0]->email_address}}" onkeypress="removeError(this.value,'errorFromEmail',this.id);" onblur="removeError(this.value,'errorFromEmail',this.id);" />
                                        </div>
                                    </div>
                                </div>

                                @if(Session('userLogged.userType') == "corporate")
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="email-box-2">
                                        <div class="email-title errorFromCompany"><?php echo translation('company_name');?></div>
                                        <div class="input-block">
                                            <input type="text" id="txtFromCompany" name="txtFromCompany" placeholder="<?php echo translation('enter_senders_company_name');?>" value="{{$userData[0]->company_name}}" onkeypress="removeError(this.value,'errorFromCompany',this.id);" onblur="removeError(this.value,'errorFromCompany',this.id);"/>
                                        </div>
                                    </div>
                                </div>
                                @else
                                <div class="col-sm-6 col-md-6 col-lg-6" style="display: block;">
                                    <div class="email-box-2">
                                        <div class="email-title errorFromCompany"><?php echo translation('company_name');?></div>
                                        <div class="input-block">
                                            <input type="text" id="txtFromCompany" name="txtFromCompany" value="not-required" readonly="readonly" />
                                        </div>
                                    </div>
                                </div>
                                @endif

                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="email-box-2">
                                        <div class="email-title errorFromAddress"><?php echo translation('address');?></div>
                                        <div class="input-block">
                                            <input type="text" id="txtFromAddress" name="txtFromAddress" placeholder="<?php echo translation('street_address');?>" value="{{$userData[0]->address}}" onkeypress="removeError(this.value,'errorFromAddress',this.id);" onblur="removeError(this.value,'errorFromAddress',this.id);" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="email-box-2">
                                        <div class="email-title errorFromCountry"><?php echo translation('country');?></div>
                                        <div class="select-bock-container">
                                            <select id="optFromCountryAramex" name="optFromCountryAramex">
                                                <option value=""><?php echo translation('select');?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="clearfix"></div> -->
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="email-box-2">
                                        <div class="email-title errorFromCity"><?php echo translation('city');?></div>
                                        <div class="select-bock-container">
                                            <select id="optFromCityAramex" name="optFromCityAramex">
                                                <option value=""><?php echo translation('select');?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="email-box-2">
                                        <div class="email-title errorFromPostCode"><?php echo translation('postal_code');?></div>
                                        <div class="input-block">
                                            <input type="text" id="txtFromPostCode" name="txtFromPostCode" value="{{$userData[0]->zipcode}}" onkeypress="removeError(this.value,'errorFromPostCode',this.id);" onblur="removeError(this.value,'errorFromPostCode',this.id);" placeholder="<?php echo translation('enter_your_postal_code');?>" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="pro-picture-title">Receiver's Details</div>

                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="email-box-2">
                                        <div class="email-title errorToName"><?php echo translation('to_name');?></div>
                                        <div class="input-block">
                                            <input type="text" id="txtToName" name="txtToName" placeholder="<?php echo translation('enter_receivers_name');?>" value="" onkeypress="removeError(this.value,'errorToName',this.id);" onblur="removeError(this.value,'errorToName',this.id);" />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="email-box-2">
                                        <div class="email-title errorToContact"><?php echo translation('contact_number');?></div>
                                        <div class="input-block">
                                            <input type="text" id="txtToContact" name="txtToContact" placeholder="<?php echo translation('enter_receivers_contact_number');?>" value="" onkeypress="removeError(this.value,'errorToContact',this.id);" onblur="removeError(this.value,'errorToContact',this.id);" />
                                        </div>
                                    </div>
                                </div>

                                 <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="email-box-2">
                                        <div class="email-title errorToEmail"><?php echo translation('email_address');?></div>
                                        <div class="input-block">
                                            <input type="text" id="txtToEmail" name="txtToEmail" placeholder="<?php echo translation('enter_receivers_email');?>" value="" onkeypress="removeError(this.value,'errorToEmail',this.id);" onblur="removeError(this.value,'errorToEmail',this.id);" />
                                        </div>
                                    </div>
                                </div>
                                @if(Session('userLogged.userType') == "corporate")
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="email-box-2">
                                        <div class="email-title errorToCompany"><?php echo translation('company_name');?></div>
                                        <div class="input-block">
                                            <input type="text" id="txtToCompany" name="txtToCompany" placeholder="<?php echo translation('enter_receivers_company_name');?>" value="" onkeypress="removeError(this.value,'errorToCompany',this.id);" onblur="removeError(this.value,'errorToCompany',this.id);"/>
                                        </div>
                                    </div>
                                </div>
                                @else
                                <div class="col-sm-6 col-md-6 col-lg-6" style="display: block;">
                                    <div class="email-box-2">
                                        <div class="email-title errorToCompany"><?php echo translation('company_name');?></div>
                                        <div class="input-block">
                                            <input type="text" id="txtToCompany" name="txtToCompany" value="not-required" readonly="readonly" />
                                        </div>
                                    </div>
                                </div>
                                @endif

                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="email-box-2">
                                        <div class="email-title errorToAddress"><?php echo translation('address');?></div>
                                        <div class="input-block">
                                            <input type="text" id="txtToAddress" name="txtToAddress" placeholder="<?php echo translation('street_address');?>" onkeypress="removeError(this.value,'errorToAddress',this.id);" onblur="removeError(this.value,'errorToAddress',this.id);" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="email-box-2">
                                        <div class="email-title errorToCountry"><?php echo translation('country');?></div>
                                        <div class="select-bock-container">
                                            <select id="optToCountryAramex" name="optToCountryAramex">
                                                <option value=""><?php echo translation('select');?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="clearfix"></div> -->
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="email-box-2">
                                        <div class="email-title errorToCity"><?php echo translation('city');?></div>
                                        <div class="select-bock-container">
                                            <select id="optToCityAramex" name="optToCityAramex">
                                                <option value=""><?php echo translation('select');?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="email-box-2">
                                        <div class="email-title errorToPostCode"><?php echo translation('postal_code');?></div>
                                        <div class="input-block">
                                            <input type="text" id="txtToPostCode" name="txtToPostCode" onkeypress="removeError(this.value,'errorToPostCode',this.id);" onblur="removeError(this.value,'errorToPostCode',this.id);" placeholder="<?php echo translation('enter_your_postal_code');?>" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="btn-block-print account margin">
                                    <input type="text" name="order_id" id="order_id" value="<?php if(isset($resCartItems[0]->id) && $resCartItems[0]->id!= ''){ echo base64_encode($resCartItems[0]->id); } ?>">
                                    <a class="print-deliver-btn account btnAramex" href="javascript:void(0);"><?php echo translation('continue');?></a>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-12" style="display: none;" id="infoPayment" >
                           <div class="email-title"><?php echo translation('choose_your_payment_method');?></div>
                            <div class="payment-method-redio color-radio-btns">
                                <div class="mrg-tpspay">
                                    <div class="radio-btn updateWallet">
                                        @if($remainWallet > $grossTotal)
                                            <form id="frmWallet" name="frmWallet" action="{{url('').config('services.paytabs.cart_success_url')}}" method="post">
                                                <input type="hidden" name="txtGrossTotal" value="{{$grossTotal}}">
                                                <input type="hidden" name="txtActive" value="1">

                                                <div class="payment-btn-block-main" style="width: 250px;">
                                                    <a href="javascript:void(0);" id="payViaWallet" class="wallet-btn-block">
                                                        <span class="img-span-block"><img src="{{url('')}}/front-assets/images/wallet-icon-img.png" alt=""> </span>
                                                        <span class="text-span-block">
                                                            <span class="text-wallet"><?php echo translation('wallet');?></span><br>
                                                            <span class="wallet-cash-block">SAR {{number_format($remainWallet,2,'.','')}}</span>
                                                        </span>
                                                    </a>
                                                </div>
                                            </form>
                                        @else
                                            <div class="payment-btn-block-main" style="width: 250px;">
                                                <a href="javascript:void(0);" id="unableToPay" class="wallet-btn-block">
                                                    <span class="img-span-block"><img src="{{url('')}}/front-assets/images/wallet-icon-img.png" alt=""> </span>
                                                    <span class="text-span-block">
                                                        <span class="text-wallet"><?php echo translation('wallet');?></span><br>
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
                                        <a class="print-deliver-btn account btnCancelPayment" href="javascript:void(0);"><?php echo translation('cancel');?></a>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-sm-12 col-md-12 col-lg-12" style="display:none ;" id="paymentLoader">
                            <div class="email-title"><?php echo translation('please_wait');?></div>
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
<script type="text/javascript">
var deivery_not_available = "<?php echo translation('deivery_not_available');?>";
var same_day_deivery_available = "<?php echo translation('same_day_deivery_available');?>";
var delivery_available_on_next_business = "<?php echo translation('delivery_available_on_next_business');?>";
var select = "<?php echo translation('select');?>";
var in_progress = "<?php echo translation('in_progress');?>";
var message = "<?php echo translation('message');?>";
var select = "<?php echo translation('select');?>";
var please_select_delivery_location = "<?php echo translation('please_select_delivery_location');?>"
var we_do_not_deliver_in_selected_location = "<?php echo translation('we_do_not_deliver_in_selected_location');?>";
var please_select_other_location_or_add_new_location = "<?php echo translation('please_select_other_location_or_add_new_location');?>";
var warning = "<?php echo translation('warning');?>";
$(document).ready(function(){

    $('#_pickupLocations').html('');
    $('select[name="optCity"]').attr('disabled','disabled');
    $('input[name="rdbOrderOption"]:checked').trigger('change');
    fillCountry();
    getAddresses('no');
});
$('body').on('change','input[name="rdbOrderOption"]',function(){
    var _value = $('input[name="rdbOrderOption"]:checked').val();
    switch(_value)
    {
        case 'pickup':
            $('#infoPickup').slideDown(200);
            $('#infoDelivery,#infoAramex').slideUp(600);
        break;
        case 'delivery':
            $('#infoDelivery').slideDown(200);
            $('#infoPickup,#infoAramex').slideUp(600);
        break;
        case 'aramex':
            $('#infoAramex').slideDown(200);
            $('#infoDelivery,#infoPickup').slideUp(600);
        break;
    }
});
/*Delivery addresses List*/
var isAddresses = null;
function getAddresses(_isActive)
{
    var totalAddresses = 0;
    isAddresses = $.ajax({
        headers:{'X-CSRF-Token': $('input[name="_token"]').val()},
        url : SITE_URL+'/user/get_addresses/',
        type : "POST",
        dataType: 'JSON',
        data : '',
        beforeSend:function(data, statusText, xhr, wrapper){
            if(isAddresses != null){
                return false;
            }
        },
        success:function(data, statusText, xhr, wrapper)
        {
            isAddresses = null;
            var _addressList = [''];
            totalAddresses = data.arr_addresses.length;
            if(totalAddresses == 5){
                $('.userNewAddress').html('');
            }
            if(data.arr_addresses.length > 0)
            {
                var _output = data.arr_addresses;
                var cnt = 2;
                $.each(_output, function(i, val)
                {
                    var sameDay = '';
                    var price = '';
                    var obj = _output[i];
                    if(obj.same_day_delivery == "na"){
                       sameDay = '<div class="book-add-name" style="margin-top: 10px;font-size: 14px;">'+deivery_not_available+'</div>';
                    }
                    else if(obj.same_day_delivery == "yes"){
                       sameDay = '<div class="book-add-name" style="margin-top: 10px;font-size: 14px;">'+same_day_deivery_available+'</div>';
                    }
                    else{
                        sameDay = '<div class="book-add-name" style="margin-top: 10px;font-size: 14px;">'+delivery_available_on_next_business+'</div>';
                    }
                    
                    price = '<div class="book-add-name" style="margin-top: 10px;font-size: 14px;">SAR '+parseFloat(obj.delivery_price).toFixed(2)+'</div>';
                    var _activeClass = '';
                    var _opacity = '';
                    /*if(_isActive == "yes" && cnt == 2){
                        applyActive();
                    }*/
                    var deliveryLocation = obj.name+'<br>'+obj.phone_number+'<br>'+obj.address+'<br>'+obj.city_title+'<br>'+obj.country_name+' - '+obj.zipcode+'<br>';

                    _addressList.push('<div class="col-sm-4 col-md-4 col-lg-4"><div class="address-block defaultClass '+_activeClass+' new_'+cnt+'" '+_opacity+' data-id="'+cnt+'"><input type="hidden" name="txtDeliveryAddress_'+cnt+'" value="'+deliveryLocation+'" ><input type="hidden" name="txtDeliveryAvailable_'+cnt+'" value="'+obj.same_day_delivery+'" ><input type="hidden" name="txtDeliveryCharges_'+cnt+'" value="'+obj.delivery_price+'" ><input type="hidden" name="txtDeliveryCity_'+cnt+'" value="'+obj.cityID+'" ><input type="hidden" name="txtDeliveryCountry_'+cnt+'" value="'+obj.countryID+'" ><div class="book-add-name">'+obj.name+'</div><div class="add-sml-text" style="margin-right: 0px;line-height: 20px;"><i class="fa fa-phone"></i> '+obj.phone_number+'<br><i class="fa fa-map-marker"></i> '+obj.address+'<br>'+obj.city_title+'<br>'+obj.country_name+' - '+obj.zipcode+'</div>'+sameDay+''+price+'</div></div>');
                    cnt++;
                });
            }

            $("#userAddresses").html(_addressList.join(''));
        },
        error:function(data, statusText, xhr, wrapper){
            isAddresses = null;  
        }
    });
}
/* End of Delivery addresses List */
var isCountries = null;
function fillCountry()
{
    isCountries = $.ajax({
        headers:{'X-CSRF-Token': $('input[name="_token"]').val()},
        url : SITE_URL+'/user/get_countries/',
        type : "POST",
        dataType: 'JSON',
        data : '',
        beforeSend:function(data, statusText, xhr, wrapper){
            if(isCountries != null){
                return false;
            }
        },
        success:function(data, statusText, xhr, wrapper)
        {
            isCountries = null;
            var countriesList = ['<option value="" disabled="disabled" selected="selected">'+select+'</option>'];

            if(data.arr_countries.length > 0)
            {
                var _output = data.arr_countries;
                var _optionsList = '';
                $.each(_output, function(i, val)
                {
                    var obj = _output[i];
                    _optionsList += '<option value="'+obj.id+'">'+obj.country_name+'</option>';
                });
                countriesList.push(_optionsList);
            }
            $("#optCountry,#optCountryDelivery,#optFromCountryAramex,#optToCountryAramex").html(countriesList.join(''));
        },
        error:function(data, statusText, xhr, wrapper){
            isCountries = null;  
        }
    });
}
/*************************PICKUP**********************************/
$('body').on('change','select[name="optCountry"]',function(){
    var id = $('select[name="optCountry"] option:selected').val();
    var citiesList = ['<option value="">'+select+'</option>'];
    $('#_pickupLocations').html('');
    $("#optCity").html(citiesList.join(''));
    $('select[name="optCity"]').attr('disabled','disabled');
    if(id > 0){
        fillCities(id);
        $('.errorCountry').removeClass('error-text-color');
    }
    else{
        $('.errorCountry').addClass('error-text-color');
    }
});

var isCities = null;
function fillCities(_id)
{
    isCities = $.ajax({
        headers:{'X-CSRF-Token': $('input[name="_token"]').val()},
        url : SITE_URL+'/user/get_cities/?country_id='+_id,
        type : "POST",
        dataType: 'JSON',
        data : '',
        beforeSend:function(data, statusText, xhr, wrapper){
            if(isCities != null){
                isCities.abort();
            }
            $('select[name="optCity"]').attr('disabled','disabled');
        },
        success:function(data, statusText, xhr, wrapper)
        {
            isCities = null;
            var citiesList = ['<option value="" disabled="disabled" selected="selected">'+select+'</option>'];
            if(data.arr_cities.length > 0)
            {
                var _output = data.arr_cities;
                var _optionsList = '';
                $.each(_output, function(i, val)
                {
                    var obj = _output[i];
                    _optionsList += '<option value="'+obj.city_id+'">'+obj.city_title+'</option>';
                });
                citiesList.push(_optionsList);
            }
            $("#optCity").html(citiesList.join(''));
            $('select[name="optCity"]').removeAttr('disabled');
        },
        error:function(data, statusText, xhr, wrapper){
            isCities = null;
            $('select[name="optCity"]').removeAttr('disabled');
        }
    });
}

$('body').on('change','select[name="optCity"]',function(){
    var id = $('select[name="optCity"] option:selected').val();
    if(id > 0){
        fillLocations(id);
        $('.errorCity').removeClass('error-text-color');
    }
    else{
        $('.errorCity').addClass('error-text-color');
    }
});

var isLocation = null;
function fillLocations(_id)
{
    isLocation = $.ajax({
        headers:{'X-CSRF-Token': $('input[name="_token"]').val()},
        url : SITE_URL+'/user/get_locations/?city_id='+_id,
        type : "POST",
        dataType: 'JSON',
        data : '',
        beforeSend:function(data, statusText, xhr, wrapper){
            if(isLocation != null){
                isLocation.abort();
            }
            $("#_pickupLocations").html('<div class="col-sm-12 col-md-12 col-lg-12"><div class="radio-btn mr-tp" style="text-align:center;"><img src="'+SITE_URL+'/front-assets/images/globe_animated.gif" alt="globe_animated" style="height:150px;width:150px;"></div></div>');/*globe_animated*/
            $('.btnPickup').hide();
        },
        success:function(data, statusText, xhr, wrapper)
        {
            isLocation = null;
            var locationsList = [''];
            console.log(data.arr_locations.length);
            if(data.arr_locations.length > 0)
            {
                $('.btnPickup').show();
                var _output = data.arr_locations;
                var _optionsList = '';
                $.each(_output, function(i, val)
                {
                    var obj = _output[i];
                    locationsList.push('<div class="col-sm-12 col-md-6 col-lg-6"><div class="radio-btn mr-tp"><div class="paymt-radio clsPickupLoactions"><input style="display: none;" type="radio" data-location_id="'+obj.locationID+'" id="option-one-'+obj.locationID+'" name="rdbPickUpLocations" value="'+obj.locationGoogle+'"><label style="cursor:pointer;display: inline-block;" for="option-one-'+obj.locationID+'"><span class="img-label-block" style="width: auto;"><img src="'+obj.locationImage+'" alt="'+obj.myLocation+'"></span><span class="label-conent-block"><span class="radio-head-block">'+obj.locationName+'</span><span class="radio-content-block"><a href="http://maps.google.com/maps?q='+obj.myLocation+'" target="_blank">'+obj.locationGoogle+'</a></span><span class="label-content-block"><span>'+obj.locationDesc+'</span></span></span></label><div class="check"></div></div></div></div>');

                });
            }
            else{
                locationsList.push('<div class="col-sm-12 col-md-12 col-lg-12"><div class="radio-btn mr-tp" style="text-align:center;"><span style="font-size: 25px;font-weight: lighter;color: #F00;font-style: italic;">Location(s) Not Available.</span></div></div>');
            }
            $("#_pickupLocations").html(locationsList.join(''));
        },
        error:function(data, statusText, xhr, wrapper){
            $('.btnPickup').hide();
            isLocation = null;
            $("#_pickupLocations").html('<div class="col-sm-12 col-md-12 col-lg-12"><div class="radio-btn mr-tp" style="text-align:center;"><span style="font-size: 25px;font-weight: lighter;color: #F00;font-style: italic;">Location(s) Not Available.</span></div></div>');
        }
    });
}


/*************************PICKUP**********************************/

/*************************ARAMEX**********************************/
$('body').on('change','select[name="optFromCountryAramex"]',function(){
    var id = $('select[name="optFromCountryAramex"] option:selected').val();
    var citiesList = ['<option value="" selected="selected" disabled="disabled">'+select+'</option>'];
    //$('#_pickupLocations').html('');
    $("#optFromCityAramex").html(citiesList.join(''));
    $('select[name="optFromCityAramex"]').attr('disabled','disabled');
    if(id > 0){
        fillCities3(id,'optFromCityAramex');
        $('.errorFromCountry').removeClass('error-text-color');
    }
    else{
        $('.errorFromCountry').addClass('error-text-color');
    }
});

$('body').on('change','select[name="optToCountryAramex"]',function(){
    var id = $('select[name="optToCountryAramex"] option:selected').val();
    var citiesList = ['<option value="" selected="selected" disabled="disabled">'+select+'</option>'];
    //$('#_pickupLocations').html('');
    $("#optToCityAramex").html(citiesList.join(''));
    $('select[name="optToCityAramex"]').attr('disabled','disabled');
    if(id > 0){
        fillCities3(id,'optToCityAramex');
        $('.errorToCountry').removeClass('error-text-color');
    }
    else{
        $('.errorToCountry').addClass('error-text-color');
    }
});

var isCities = null;
function fillCities3(_id,eleID)
{
    isCities = $.ajax({
        headers:{'X-CSRF-Token': $('input[name="_token"]').val()},
        url : SITE_URL+'/user/get_cities/?country_id='+_id,
        type : "POST",
        dataType: 'JSON',
        data : '',
        beforeSend:function(data, statusText, xhr, wrapper){
            if(isCities != null){
                isCities.abort();
            }
            $('select[name="'+eleID+'"]').attr('disabled','disabled');
        },
        success:function(data, statusText, xhr, wrapper)
        {
            isCities = null;
            var citiesList = ['<option value="" disabled="disabled" selected="selected">'+select+'</option>'];
            if(data.arr_cities.length > 0)
            {
                var _output = data.arr_cities;
                var _optionsList = '';
                $.each(_output, function(i, val)
                {
                    var obj = _output[i];
                    _optionsList += '<option value="'+obj.city_id+'">'+obj.city_title+'</option>';
                });
                citiesList.push(_optionsList);
            }
            $("#"+eleID).html(citiesList.join(''));
            $('select[name="'+eleID+'"]').removeAttr('disabled');
        },
        error:function(data, statusText, xhr, wrapper){
            isCities = null;
            $('select[name="'+eleID+'"]').removeAttr('disabled');
        }
    });
}

$('body').on('change','select[name="optFromCityAramex"]',function(){
    var id = $('select[name="optFromCityAramex"] option:selected').val();
    if(id > 0){
        $('.errorFromCity').removeClass('error-text-color');
    }
    else{
        $('.errorFromCity').addClass('error-text-color');
    }
});

$('body').on('change','select[name="optToCityAramex"]',function(){
    var id = $('select[name="optToCityAramex"] option:selected').val();
    if(id > 0){
        $('.errorToCity').removeClass('error-text-color');
    }
    else{
        $('.errorToCity').addClass('error-text-color');
    }
});

var isLocation = null;
function fillLocations3(_id)
{
    isLocation = $.ajax({
        headers:{'X-CSRF-Token': $('input[name="_token"]').val()},
        url : SITE_URL+'/user/get_locations_aramex/?city_id='+_id,
        type : "POST",
        dataType: 'JSON',
        data : '',
        beforeSend:function(data, statusText, xhr, wrapper){
            if(isLocation != null){
                isLocation.abort();
            }
            $('select[name="optLocationAramex"]').attr('disabled','disabled');
        },
        success:function(data, statusText, xhr, wrapper)
        {
            isLocation = null;
            var locationList = ['<option value="" disabled="disabled" selected="selected">'+select+'</option>'];
            if(data.arr_locations.length > 0)
            {
                var _output = data.arr_locations;
                var _optionsList = '';
                $.each(_output, function(i, val)
                {
                    var obj = _output[i];
                    _optionsList += '<option value="'+obj.id+'">'+obj.location+'</option>';
                });
                locationList.push(_optionsList);
            }
            $("#optLocationAramex").html(locationList.join(''));
            $('select[name="optLocationAramex"]').removeAttr('disabled');
        },
        error:function(data, statusText, xhr, wrapper){
            isLocation = null;
            $('select[name="optLocationAramex"]').removeAttr('disabled');
        }
    });
}
var isContinueAramex = null;
$('body').on('click','.btnAramex',function(){
    
    var _type  = $('input[name="rdbOrderOption"]:checked').val();
    var isVlaidated = validateForm(_type);

    if(isVlaidated)
    {
        var paramName = [];
        paramName.push(isVlaidated);
        isContinueAramex = $.ajax({
            headers:{'X-CSRF-Token': $('input[name="_token"]').val()},
            url : SITE_URL+'/user/validate-address/',
            type : "POST",
            dataType: 'JSON',
            data : {paramName},
            beforeSend:function(data, statusText, xhr, wrapper)
            {
                if(isContinueAramex != null){
                    return false;
                }
                $('#infoPayment').hide();
                $('.btnAramex').css('width','185px').html('<i class="fa fa-spinner fa-spin fa-fw"></i><span> please wait, calculating delivery price</span>');
                $('.deliveryCharges').hide();
                $('.updateWallet').html('');
            },
            success:function(data, statusText, xhr, wrapper)
            {
                isContinueAramex = null;
                if(data.status == "done")
                {
                    loadPaytabs(data.grossTotal);
                    /*if(_type == 'delivery'){}*/
                        $('.deliveryCharges').html('Delivery Charge <small>SAR</small><span style="font-weight: bold;"> '+parseFloat(data.deliveryCharges).toFixed(2)+'</span>').show();
                    
                    $('.grossTotal').html(parseFloat(data.grossTotal).toFixed(2));
                    $('.updateWallet').html(data.walletBox);
                    $('#infoPayment').show();
                    $('#radioOptions,#infoPickup,#infoDelivery,#infoAramex').hide();
                }
                else{
                    $('.btnAramex').css('width','142px').html('Continue');
                    $('#infoPayment').hide();
                    $('#radioOptions').show();
                    $('input[name="rdbOrderOption"]:checked').trigger('change');
                }
            },
            error:function(data, statusText, xhr, wrapper)
            {
                $('.btnAramex').css('width','142px').html('Continue');
                $('#infoPayment').hide();
                $('#radioOptions').show();
                $('input[name="rdbOrderOption"]:checked').trigger('change');
                isContinueAramex = null;  
            }
        });
    }
});

function createShipment()
{
    isContinueAramex = $.ajax({
            headers:{'X-CSRF-Token': $('input[name="_token"]').val()},
            url : SITE_URL+'/user/validate-address/',
            type : "POST",
            dataType: 'JSON',
            data : {paramName},
            beforeSend:function(data, statusText, xhr, wrapper)
            {
                if(isContinueAramex != null){
                    return false;
                }
                $('#infoPayment').hide();
                $('.btnAramex').css('width','185px').html('<i class="fa fa-spinner fa-spin fa-fw"></i><span> please wait, calculating delivery price</span>');
                $('.deliveryCharges').hide();
                $('.updateWallet').html('');
            },
            success:function(data, statusText, xhr, wrapper)
            {
                isContinueAramex = null;
                if(data.status == "done")
                {
                    loadPaytabs(data.grossTotal);
                    /*if(_type == 'delivery'){}*/
                        $('.deliveryCharges').html('Delivery Charge <small>SAR</small><span style="font-weight: bold;"> '+parseFloat(data.deliveryCharges).toFixed(2)+'</span>').show();
                    
                    $('.grossTotal').html(parseFloat(data.grossTotal).toFixed(2));
                    $('.updateWallet').html(data.walletBox);
                    $('#infoPayment').show();
                    $('#radioOptions,#infoPickup,#infoDelivery,#infoAramex').hide();
                }
                else{
                    $('.btnAramex').css('width','142px').html('Continue');
                    $('#infoPayment').hide();
                    $('#radioOptions').show();
                    $('input[name="rdbOrderOption"]:checked').trigger('change');
                }
            },
            error:function(data, statusText, xhr, wrapper)
            {
                $('.btnAramex').css('width','142px').html('Continue');
                $('#infoPayment').hide();
                $('#radioOptions').show();
                $('input[name="rdbOrderOption"]:checked').trigger('change');
                isContinueAramex = null;  
            }
        });
}
/*************************ARAMEX**********************************/

/*************************DELIVERY********************************/

$('body').on('change','select[name="optCountryDelivery"]',function(){
    var id = $('select[name="optCountryDelivery"] option:selected').val();

    var citiesList = ['<option value="" disabled="disabled" selected="selected">'+select+'</option>'];
   $("#optCityDelivery").html(citiesList.join(''));
    $('select[name="optCityDelivery"]').attr('disabled','disabled');
    if(id > 0){
        fillCities2(id);
        $('.errorCountryDelivery').removeClass('error-text-color');
    }
    else{
        $('.errorCountryDelivery').addClass('error-text-color');
    }
});
$('body').on('change','select[name="optCityDelivery"]',function(){
    var id = $('select[name="optCityDelivery"] option:selected').val();
    if(id > 0){
        $('.errorCityDelivery').removeClass('error-text-color');
    }
    else{
        $('.errorCityDelivery').addClass('error-text-color');
    }
});
var isCities2 = null;
function fillCities2(_id)
{
    isCities2 = $.ajax({
        headers:{'X-CSRF-Token': $('input[name="_token"]').val()},
        url : SITE_URL+'/user/get_cities/?country_id='+_id,
        type : "POST",
        dataType: 'JSON',
        data : '',
        beforeSend:function(data, statusText, xhr, wrapper){
            if(isCities2 != null){
                isCities2.abort();
            }
            $('select[name="optCityDelivery"]').attr('disabled','disabled');
        },
        success:function(data, statusText, xhr, wrapper)
        {
            isCities2 = null;
        var citiesList = ['<option value="" disabled="disabled" selected="selected">'+select+'</option>'];
        if(data.arr_cities.length > 0)
            {
                var _output = data.arr_cities;
                var _optionsList = '';
                $.each(_output, function(i, val)
                {
                    var obj = _output[i];
                    _optionsList += '<option value="'+obj.city_id+'">'+obj.city_title+'</option>';
                });
                citiesList.push(_optionsList);
            }
            $("#optCityDelivery").html(citiesList.join(''));
            $('select[name="optCityDelivery"]').removeAttr('disabled');
        },
        error:function(data, statusText, xhr, wrapper){
            isCities2 = null;
            $('select[name="optCityDelivery"]').removeAttr('disabled');
        }
    });
}
/*************************DELIVERY********************************/
function validateForm(_type)
{
    if(_type == "pickup")
    {
        var _country  = $('select[name="optCountry"] option:selected').val();
        var _city     = $('select[name="optCity"] option:selected').val();
        var _location = $('input[name="rdbPickUpLocations"]:checked').val();
        if(_country == '')
        {
            $('.errorCountry').addClass('error-text-color');
            return false;
        }
        else if(_city == '')
        {
            $('.errorCity').addClass('error-text-color');
            return false;
        }
        else if(_location == '' || _location == undefined)
        {
            /*$('.errorLocation').addClass('error-text-color');*/
            $.alert.open('warning','Warning','Please select your pickup location.');
            return false;
        }
        else{
            var allData = {'order_type':_type,'same_day_delivery':'na','delivery_charges':0,'address':_location,'city':_city,'country':_country,'shipping_from':null,'shipping_to':null};
            return allData;
        }    
    }
    else if(_type == "delivery")
    {
        if($('.defaultClass').hasClass('activeClass')){
            var _elePrefix      = $('.activeClass').data('id');
            var _location       = $('input[name="txtDeliveryAddress_'+_elePrefix+'"]').val();
            var _availability   = $('input[name="txtDeliveryAvailable_'+_elePrefix+'"]').val();
            var _charges        = $('input[name="txtDeliveryCharges_'+_elePrefix+'"]').val();
            var _city           = $('input[name="txtDeliveryCity_'+_elePrefix+'"]').val();
            var _country        = $('input[name="txtDeliveryCountry_'+_elePrefix+'"]').val();

            if(_location == '' && _availability == '' && _charges == '' && _city == '' && _country == '')
            {
                $.alert.open('warning',warning,please_select_delivery_location);
                return false;    
            }
            else if(_availability == "na" || _availability == ""){
                $.alert.open('warning',warning,we_do_not_deliver_in_selected_location+'<br>'+please_select_other_location_or_add_new_location);
                return false;
            }
            else if(_city == '')
            {
                $.alert.open('warning',warning,we_do_not_deliver_in_selected_location+'<br>'+please_select_other_location_or_add_new_location);
                return false;
            }
            else if(_country == ''){
                $.alert.open('warning',warning,we_do_not_deliver_in_selected_location+'<br>'+please_select_other_location_or_add_new_location);
                return false;
            }
            else{
                var allData = {'order_type':_type,'same_day_delivery':_availability,'delivery_charges':_charges,'address':_location,'city':_city,'country':_country,'shipping_from':null,'shipping_to':null};
                return allData;
            }
        }
        else{
            $.alert.open('warning',warning,please_select_delivery_location);
        }
    }
    else if(_type == "aramex")
    {
        var _fromName     = $('input[name="txtFromName"]').val();
        var _fromContact  = $('input[name="txtFromContact"]').val();
        var _fromEmail    = $('input[name="txtFromEmail"]').val();
        var _fromCompany  = $('input[name="txtFromCompany"]').val();

        var _fromAddress  = $('input[name="txtFromAddress"]').val();
        var _fromCountry  = $('select[name="optFromCountryAramex"]').val();
        var _fromCity     = $('select[name="optFromCityAramex"]').val();
        var _fromPostcode = $('input[name="txtFromPostCode"]').val();

        var _toName       = $('input[name="txtToName"]').val();
        var _toContact    = $('input[name="txtToContact"]').val();
        var _toEmail      = $('input[name="txtToEmail"]').val();
        var _toCompany    = $('input[name="txtToCompany"]').val();

        var _toAddress    = $('input[name="txtToAddress"]').val();
        var _toCountry    = $('select[name="optToCountryAramex"]').val();
        var _toCity       = $('select[name="optToCityAramex"]').val();
        var _toPostcode   = $('input[name="txtToPostCode"]').val();

       var regEmail =  /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/igm;


        if(_fromName == ''){
            $('.errorFromName,input[name="txtFromName"]').addClass('error-text-color');
            $('input[name="txtFromName"]').focus();
        }
        else if(_fromContact == ''){
            $('.errorFromContact,input[name="txtFromContact"]').addClass('error-text-color');
            $('input[name="txtFromContact"]').focus();
        }
        else if(_fromEmail == '' || !regEmail.test(_fromEmail)){
            $('.errorFromEmail,input[name="txtFromEmail"]').addClass('error-text-color');
            $('input[name="txtFromEmail"]').focus();
        }
        else if(_fromCompany == ''){
            $('.errorFromCompany,input[name="txtFromCompany"]').addClass('error-text-color');
            $('input[name="txtFromCompany"]').focus();
        }
        else if(_fromAddress == ''){
            $('.errorFromAddress,input[name="txtFromAddress"]').addClass('error-text-color');
            $('input[name="txtFromAddress"]').focus();
        }
        else if(_fromCountry == '' || _fromCountry == undefined){
            $('.errorFromCountry,input[name="optFromCountryAramex"]').addClass('error-text-color');
        }
        else if(_fromCity == '' || _fromCity == undefined){
            $('.errorFromCity,input[name="optFromCityAramex"]').addClass('error-text-color');
        }
        else if(_fromPostcode == ''){
            $('.errorFromPostCode,input[name="txtFromPostCode"]').addClass('error-text-color');
            $('input[name="txtFromPostCode"]').focus();
        }
        else if(_toName == ''){
            $('.errorToName,input[name="txtToName"]').addClass('error-text-color');
            $('input[name="txtToName"]').focus();
        }
        else if(_toContact == ''){
            $('.errorToContact,input[name="txtToContact"]').addClass('error-text-color');
            $('input[name="txtToContact"]').focus();
        }
        else if(_toEmail == '' || !regEmail.test(_toEmail)){
            $('.errorToEmail,input[name="txtToEmail"]').addClass('error-text-color');
            $('input[name="txtToEmail"]').focus();
        }
        else if(_toCompany == ''){
            $('.errorToCompany,input[name="txtToCompany"]').addClass('error-text-color');
            $('input[name="txtToCompany"]').focus();
        }
        else if(_toAddress == ''){
            $('.errorToAddress,input[name="txtToAddress"]').addClass('error-text-color');
            $('input[name="txtToAddress"]').focus();
        }
        else if(_toCountry == '' || _toCountry == undefined){
            $('.errorToCountry,input[name="optToCountryAramex"]').addClass('error-text-color');
        }
        else if(_toCity == '' || _toCity == undefined){
            $('.errorToCity,input[name="optToCityAramex"]').addClass('error-text-color');
        }
        else if(_toPostcode == ''){
            $('.errorToPostCode,input[name="txtToPostCode"]').addClass('error-text-color');
            $('input[name="txtToPostCode"]').focus();
        }
        else
        {        
            var allData = {'_fromName':_fromName,'_fromContact':_fromContact,'_fromEmail':_fromEmail,'_fromCompany':_fromCompany,'_fromAddress':_fromAddress,'_fromCountry':_fromCountry,'_fromCity':_fromCity,'_fromPostcode':_fromPostcode,'_toName':_toName,'_toContact':_toContact,'_toEmail':_toEmail,'_toCompany':_toCompany,'_toAddress':_toAddress,'_toCountry':_toCountry,'_toCity':_toCity,'_toPostcode':_toPostcode,'same_day_delivery':'na','delivery_charges':0};
                return allData;
        }
    }
}

isContinue = null;
    $('body').on('click','.btnPickup,.btnDelivery',function(){
        var _type  = $('input[name="rdbOrderOption"]:checked').val();
        var isVlaidated = validateForm(_type);
        if(isVlaidated)
        {
            console.log(isVlaidated);
            var paramName = [];
            paramName.push(isVlaidated);
            isContinue = $.ajax({
                headers:{'X-CSRF-Token': $('input[name="_token"]').val()},
                url : SITE_URL+'/user/update-order-details/',
                type : "POST",
                dataType: 'JSON',
                data : {paramName},
                beforeSend:function(data, statusText, xhr, wrapper)
                {
                    if(isContinue != null){
                        return false;
                    }
                    $('#infoPayment').hide();
                    $('.btnPickup,.btnDelivery').css('width','145px').html('<i class="fa fa-spinner fa-spin fa-fw"></i><span>'+please_wait+'</span>');
                    $('.deliveryCharges').hide();
                    $('.updateWallet').html('');
                },
                success:function(data, statusText, xhr, wrapper)
                {
                    isContinue = null;
                    if(data.status == "done")
                    {
                        loadPaytabs(data.grossTotal);
                        if(_type == 'delivery'){
                            $('.deliveryCharges').html('Delivery Charge <small>SAR</small><span style="font-weight: bold;"> '+parseFloat(data.deliveryCharges).toFixed(2)+'</span>').show();
                        }
                        $('.grossTotal').html(parseFloat(data.grossTotal).toFixed(2));
                        $('.updateWallet').html(data.walletBox);
                        $('#infoPayment').show();
                        $('#radioOptions,#infoPickup,#infoDelivery,#infoAramex').hide();
                    }
                    else{
                        $('.btnPickup,.btnDelivery').css('width','142px').html('Continue');
                        $('#infoPayment').hide();
                        $('#radioOptions').show();
                        $('input[name="rdbOrderOption"]:checked').trigger('change');
                    }
                },
                error:function(data, statusText, xhr, wrapper)
                {
                    $('.btnPickup,.btnDelivery').css('width','142px').html('Continue');
                    $('#infoPayment').hide();
                    $('#radioOptions').show();
                    $('input[name="rdbOrderOption"]:checked').trigger('change');
                    isContinue = null;  
                }
            });
        }
    });

</script>
<link rel="stylesheet" href="https://www.paytabs.com/express/express.css">
<script src="https://www.paytabs.com/express/express_checkout_v3.js"></script>
<script type="text/javascript">
var select = "<?php echo translation('select');?>";
var please_fill_required_details = "<?php echo translation('please_fill_required_details');?>";
var warning = "<?php echo translation('warning');?>";
var you_dont_have_sufficient_amount_in_your_wallet = "<?php echo translation('you_dont_have_sufficient_amount_in_your_wallet');?>";
var new_address = "<?php echo translation('new_address');?>";
var close = "<?php echo translation('close');?>";
var please_wait = "<?php echo translation('please_wait');?>";
var please_use_paytabs_to_pay = "<?php echo translation('please_use_paytabs_to_pay');?>";

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
            url_redirect: "{{url('').config('services.paytabs.cart_success_url')}}",
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

$("body").on("click","#payViaWallet",function(e){
    var _type  = $('input[name="rdbOrderOption"]:checked').val();
    var isVlaidated = validateForm(_type);
    if(isVlaidated){
        $('#paymentLoader').show();
        $('#radioOptions,#infoPickup,#infoDelivery,#infoAramex,#infoPayment').hide();
        $('form[name="frmWallet"]').submit();
    }
    else{
        $.alert.open('warning',warning,please_fill_required_details);
        $('input[name="rdbOrderOption"]:checked').trigger('click');
    }
});
$("body").on("click","#unableToPay",function(e){
    $.alert.open('warning',warning,you_dont_have_sufficient_amount_in_your_wallet+'<br>'+please_use_paytabs_to_pay);
});

$('.nav-toggle').click(function(){
    $('.defaultClass').removeClass('activeClass').css('opacity',5);
    /*get collapse content selector*/
    var collapse_content_selector = $(this).attr('href');

    /*make the collapse content to be shown or hide*/
    var toggle_switch = $(this);
    $(collapse_content_selector).toggle(function(){
      if($(this).css('display')=='none'){
        toggle_switch.html('<i class="fa fa-plus"></i>'+new_address);
        $('.btnDelivery').show();
      }else{
        toggle_switch.html('<i class="fa fa-minus"></i>'+close);
        $('.btnDelivery').hide();
      }
    });
});

$('body').on('click','.btnCancelPayment',function(){
    location.href='';
});
$('body').on('click','.defaultClass',function(){
    $('.defaultClass').removeClass('activeClass').css('opacity',.4);
    $(this).addClass('activeClass').css('opacity',5);
});
var addAddress = null;
$('body').on('click','button[name="btnSaveAddress"]',function(){
    var txtFullName     = $('input[name="txtFullName"]').val();
    var streetAddress    = $('input[name="streetAddress"]').val();
    var optCountryDelivery = $('select[name="optCountryDelivery"] option:selected').val();
    var optCityDelivery    = $('select[name="optCityDelivery"] option:selected').val();
    var txtPostalCode      = $('input[name="txtPostalCode"]').val();
    var txtPhoneNum        = $('input[name="txtPhoneNum"]').val();

/*alert(optCountryDelivery);*/
    if(txtFullName == ''){
        $('.errorName,input[name="txtFullName"]').addClass('error-text-color');
        $('input[name="txtFullName"]').focus();
    }
    else if(streetAddress == ''){
        $('.errorStreetAddress,input[name="streetAddress"]').addClass('error-text-color');
        $('input[name="streetAddress"]').focus();
    }
    else if(optCountryDelivery == ''){
        $('.errorCountryDelivery,input[name="optCountryDelivery"]').addClass('error-text-color');
    }
    else if(optCityDelivery == ''){
        $('.errorCityDelivery,input[name="optCityDelivery"]').addClass('error-text-color');
    }
    else if(txtPostalCode == ''){
        $('.errorPostalcode,input[name="txtPostalCode"]').addClass('error-text-color');
        $('input[name="txtPostalCode"]').focus();
    }
    else if(txtPhoneNum == ''){
        $('.errorPhoneNum,input[name="txtPhoneNum"]').addClass('error-text-color');
        $('input[name="txtPhoneNum"]').focus();
    }
    else{

        var dataStr = {name:txtFullName,address:streetAddress,country:optCountryDelivery,city:optCityDelivery,phone_number:txtPhoneNum,zipcode:txtPostalCode};

        addAddress = $.ajax({
            headers:{'X-CSRF-Token': $('input[name="_token"]').val()},
            url : SITE_URL+'/user/save_address/',
            type : "POST",
            dataType: 'JSON',
            data : dataStr,
            beforeSend:function(data, statusText, xhr, wrapper){
                if(addAddress != null){
                    return false
                }
                $('button[name="btnSaveAddress"]').html('<i class="fa fa-spinner fa-spin fa-fw"></i><span>'+please_wait+'</span>');
            },
            success:function(data, statusText, xhr, wrapper)
            {
                addAddress = null;
                getAddresses('yes');
                $('.nav-toggle').trigger('click');
                $('button[name="btnSaveAddress"]').html('Save');
            },
            error:function(data, statusText, xhr, wrapper){
                $('button[name="btnSaveAddress"]').html('Save');
                addAddress = null;
            }
        });
    }
});

function removeError(_value,_class,_eleId){
    if(_value != ''){
        $('.'+_class+',#'+_eleId).removeClass('error-text-color');
        $().removeClass('error-text-color')
    }
    else{
        $('.'+_class+',#'+_eleId).addClass('error-text-color');
    }
}

function applyActive()
{
    var _len = $('.defaultClass').length;
    for(var i = 1;i <= _len; i++){
        if(i == 2){
            $('.new_'+i).addClass('activeClass').css('opacity',5);
        }
        else{
            $('.new_'+i).removeClass('activeClass').css('opacity',.4);
        }
    }
}
</script>