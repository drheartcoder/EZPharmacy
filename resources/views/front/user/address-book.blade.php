@include('front.user._inner-breadcrumbs')
<div class="dash-main-block">
    <div class="container">
        <div class="row">
            <div>
                @include('front.user.left-navigation')
            </div>

            <style type="text/css">.add-sml-text {width: 100%;}
            #parent-address-book{
                display: none;
                }</style>
            <div class="col-xs-12 col-sm-8 col-md-9 col-lg-9">
                
                <div id="status_msg"></div>

                <div class="row"
                    ng-controller="AddressBookCtrl"
                    ng-init='module_url="{{url('/user/')}}"; getCountries(); loadAddresses();'>

                    <div id="parent-address-book">
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3" ng-repeat="address in arr_addresses">
                        <div class="address-block">
                            <div class="edit-dlt">
                                <a ng-click="getAddressDetails(address.address_id)"><i class="fa fa-pencil-square-o"></i></a>
                                <a ng-click="deleteAddress(address.address_id)" > <i class="icon-rubbish-bin"></i></a>
                            </div>
                            <div class="book-add-name">[[address.name]]</div>
                            <div class="add-sml-text">[[address.address]] , [[address.city_title]] , [[address.country_name]] , [[address.zipcode]] . PH: [[address.phone_number]] <br/>
                           <?php echo (preg_replace('#<[^>]+>#',' ',translation('same_day_delivery')));?>: [[address.same_day_delivery]],<br/><?php echo (preg_replace('#<[^>]+>#',' ',translation('delivery_price')));?>: [[address.delivery_price]]</div>
                        </div>
                    </div>
                    </div>


                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" ng-hide="addressLimitReached">
                        <div class="full-white-box" id="test">
                            <div class="address-name-txt" ng-if="EditMode == false"><?php echo (preg_replace('#<[^>]+>#',' ',translation('new_address_book')));?></div>
                            <div class="address-name-txt" ng-if="EditMode == true"><?php echo (preg_replace('#<[^>]+>#',' ',translation('edit_address_book')));?></div>
                                <form class="login-form-block" 
                                      name="addressForm" 
                                      ng-submit="addressForm.$valid && storeAddress();"
                                      novalidate>

                                    <input type="hidden" ng-model="address.edit_address_id" name="edit_address_id" readonly=""/>

                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                            <div class="email-box-2">
                                                <div class="email-title"><?php echo (preg_replace('#<[^>]+>#',' ',translation('user_name')));?></div>
                                                <div class="input-block" ng-class="{ 'has-error': addressForm.name.$touched && addressForm.name.$invalid }">
                                                    <input type="text" name="name" ng-model="address.name" ng-maxlength="100" ng-required="true" placeholder="<?php echo (preg_replace('#<[^>]+>#', ' ', translation('user_name'))); ?>"/>
                                                    <div class="error-new-block ng-cloak" ng-messages="addressForm.name.$error" ng-if="addressForm.$submitted || addressForm.name.$touched">
                                                        @include('front.includes.message' ,['maxlength'=>100])
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                            <div class="email-box-2">
                                                <div class="email-title abc"><?php echo (preg_replace('#<[^>]+>#',' ',translation('street_address')));?> </div>
                                                <div class="input-block" ng-class="{ 'has-error': addressForm.street.$touched && addressForm.street.$invalid }">
                                                    <input type="text" name="street" ng-model="address.address" ng-maxlength="500" ng-required="true" placeholder="<?php echo (preg_replace('#<[^>]+>#',' ',translation('street_address')));?>" />
                                                    <div class="error-new-block ng-cloak" ng-messages="addressForm.street.$error" ng-if="addressForm.$submitted || addressForm.street.$touched">
                                                        @include('front.includes.message', ['maxlength' => 500])
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div style="clear: both;"></div>

                                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                            <div class="email-box-2">
                                                <div class="email-title"><?php echo (preg_replace('#<[^>]+>#',' ',translation('country')));?></div>
                                                <div class="select-bock-container" ng-class="{ 'has-error': addressForm.country.$touched && addressForm.country.$invalid }">
                                                    <select ng-model="address.country" name="country" ng-change="getCities()" ng-required="true" >
                                                        <option value=""><?php echo (preg_replace('#<[^>]+>#',' ',translation('select_country')));?></option>
                                                        <option ng-repeat="country in arr_countries" value="[[country.id]]" 
                                                                ng-selected="country.id == address.country"
                                                         >[[country.country_name]]</option>
                                                    </select>
                                                    <div class="error-new-block ng-cloak" ng-messages="addressForm.country.$error" ng-if="addressForm.$submitted || addressForm.country.$touched">
                                                        @include('front.includes.message')
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                            <div class="email-box-2">
                                            <div class="email-title"><?php echo (preg_replace('#<[^>]+>#',' ',translation('city')));?></div>
                                            <div class="select-bock-container" ng-class="{ 'has-error': addressForm.city.$touched && addressForm.city.$invalid }">
                                                <select ng-model="address.city"  name="city" ng-required="true" >
                                                    <option value=""><?php echo (preg_replace('#<[^>]+>#',' ',translation('select_city')));?> </option>
                                                    <option ng-repeat="city in arr_cities"
                                                            value="[[city.city_id]]" ng-selected="city.city_id == address.city" >[[city.city_title]]</option>
                                                </select>
                                                <div class="error-new-block ng-cloak" ng-messages="addressForm.city.$error" ng-if="addressForm.$submitted || addressForm.city.$touched">
                                                    @include('front.includes.message')
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                        
                                       
                                       <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                            <div class="email-box-2">
                                                <div class="email-title"><?php echo (preg_replace('#<[^>]+>#',' ',translation('postal_code')));?></div>
                                                <div class="input-block">
                                                    <input type="text" name="zipcode" ng-model="address.zipcode" ng-minlength="5" ng-maxlength="50" placeholder="<?php echo (preg_replace('#<[^>]+>#',' ',translation('postal_code')));?>" />
                                                    <div class="error-new-block ng-cloak" ng-messages="addressForm.zipcode.$error" ng-if="addressForm.$submitted || addressForm.zipcode.$touched">
                                                        @include('front.includes.message',['minlength' => 6 , 'maxlength' => 10])
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                            <div class="email-box-2">
                                                <div class="email-title"><?php echo (preg_replace('#<[^>]+>#',' ',translation('phone_number'))); ?></div>
                                                <div class="input-block" ng-class="{ 'has-error': addressForm.phone_number.$touched && addressForm.phone_number.$invalid }">
                                                    <input type="text" name="phone_number" 
                                                            ng-pattern="/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/"
                                                            ng-model="address.phone_number" ng-minlength="10" ng-maxlength="16" ng-required="true" placeholder="<?php echo (preg_replace('#<[^>]+>#',' ',translation('phone_number'))); ?>" />
                                                                                                                                                                
                                                            <?php 
                                                            $invalid_number= translation("must_be_a_valid_phone_number");
                                                            ?>
                                                    <div class="error-new-block ng-cloak" ng-messages="addressForm.phone_number.$error" ng-if="addressForm.$submitted || addressForm.phone_number.$touched">
                                                        @include('front.includes.message',['minlength' => 10 , 'maxlength' => 16 , 'pattern' => "$invalid_number" ])
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <div class="btn-block-print account margin address-book-space">
                                                <button type="submit" class="print-deliver-btn account">
                                                    <span ng-if="EditMode == false" ><?php echo (preg_replace('#<[^>]+>#',' ',translation('save'))); ?></span>
                                                    <span ng-if="EditMode == true" ><?php echo (preg_replace('#<[^>]+>#',' ',translation('update'))); ?></span>
                                                </button>
                                                <button type="button" class="print-deliver-btn account" ng-if="EditMode == true" ng-click="CancelEditMode()"><?php echo (preg_replace('#<[^>]+>#',' ',translation('cancel'))); ?></button>
                                            </div>
                                        </div>
                                    </div>
                                </form> 
                            <div class="clr"></div>
                        </div>
                    </div> 

                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" ng-if="addressLimitReached == true;">
                        <h5 style="color: red;"><?php echo (preg_replace('#<[^>]+>#',' ',translation('note_you_can_only_add_upto_6_addresses'))); ?></h5>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var are_you_sure_you_want_to_delete_address = "<?php echo (preg_replace('#<[^>]+>#',' ',translation('are_you_sure_you_want_to_delete_address'))); ?>";    
</script>