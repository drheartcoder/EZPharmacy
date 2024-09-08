<style type="text/css">
    /*.header {
        background: #fff;
        background: rgba(255, 255, 255, 1);
        box-shadow: 0 0 2px rgba(0, 0, 0, 0.24);
        position: relative;
    }    
    .min-menu li {
        display: none;
    }    
    .min-menu li.lang,    
    .min-menu li.dash-show {
        display: inline-block;
    }    
    #dd .dropdown li {
        display: block;
    }*/
</style>

@include('front.user._inner-breadcrumbs')
<div class="dash-main-block">
    <div class="container">
        <div class="row">
            <div>
                @include('front.user.left-navigation')
            </div>
            <div class="col-xs-12 col-sm-8 col-md-9 col-lg-9">
                <div class="full-white-box">
                    <div id="profile_status_msg"></div>
                    <div class="row"
                            ng-controller="UserCtrl"
                            ng-init='module_url="{{url('/user/')}}";getCountries();'
                            >

                        <form class="login-form-block new-blocks" 
                              name="updateProfileForm" 
                              ng-submit="updateProfileForm.$valid && updateProfile()"
                              novalidate >

                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="upload-block">
                                   <div class="profile-pic">
                                        <div class="profile-img"><img ng-src="[[filepreview]]" class="img-responsive" ng-show="filepreview" alt="" /></div>
                                        <div class="upload-btn2">
                                            <input type="file" class="upload-btn" fileinput="file" 
                                                    filepreview="filepreview" 
                                                    ng-model="user.profile_image" 
                                                    attach-file-input="user.profile_image" />
                                            <button class="upload-btn-block"><i class="fa fa-picture-o"></i><?php echo (preg_replace('#<[^>]+>#',' ',translation('upload_photo')));?></button>
                                       </div>
                                       
                                    </div>
                                </div>
                                <div class="pro-picture-title line">    <?php echo (preg_replace('#<[^>]+>#',' ',translation('personal_information')));?></div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                <div class="email-box-2">
                                    <div class="email-title"><?php echo (preg_replace('#<[^>]+>#',' ',translation('first_name')));?><i class="red">*</i></div>
                                    <div class="input-block" ng-class="{ 'has-error': updateProfileForm.first_name.$touched && updateProfileForm.first_name.$invalid }">
                                        <input  id="name" type="text" 
                                                name="first_name" 
                                                ng-model="user.first_name"  
                                                placeholder="<?php echo (preg_replace('#<[^>]+>#',' ',translation('first_name')));?>" 
                                                ng-maxlength="100" 
                                                ng-required="true" />
                                        <div class="error-new-block ng-cloak" ng-messages="updateProfileForm.first_name.$error" ng-if="updateProfileForm.$submitted || updateProfileForm.first_name.$touched">
                                            @include('front.includes.message',['maxlength'=>100])
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                <div class="email-box-2">
                                    <div class="email-title"><?php echo (preg_replace('#<[^>]+>#',' ',translation('last_name')));?><i class="red">*</i></div>
                                    <div class="input-block" ng-class="{ 'has-error': updateProfileForm.last_name.$touched && updateProfileForm.last_name.$invalid }">
                                        <input id="name" type="text" 
                                                name="last_name" 
                                                ng-model="user.last_name"
                                                ng-maxlength="100" 
                                                ng-required="true" 
                                                placeholder="<?php echo (preg_replace('#<[^>]+>#',' ',translation('last_name')));?>" />
                                        <div class="error-new-block ng-cloak" ng-messages="updateProfileForm.last_name.$error" ng-if="updateProfileForm.$submitted || updateProfileForm.last_name.$touched">
                                            @include('front.includes.message',['maxlength'=>100])
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="clear: both;"></div>
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                <div class="email-box-2">
                                    <div class="email-title">@if(isset($userType) && $userType == 'corporate')<?php echo (preg_replace('#<[^>]+>#',' ',translation('company_email_address')));?><i class="red">*</i>@else<?php echo (preg_replace('#<[^>]+>#',' ',translation('email_address')));?><i class="red">*</i>@endif </div>
                                    <div class="input-block" ng-class="{ 'has-error': updateProfileForm.email.$touched && updateProfileForm.email.$invalid }">
                                        <input type="email" name="email" 
                                            ng-model="user.email" placeholder="<?php echo (preg_replace('#<[^>]+>#',' ',translation('email_address')));?>"
                                            ng-pattern="/^[a-z]+[a-z0-9._]+@[a-z0-9._]+\.[a-z.]{2,5}$/" 
                                            ng-required="true" />
                                        <div class="error-new-block ng-cloak" ng-messages="updateProfileForm.email.$error" ng-if="updateProfileForm.$submitted || updateProfileForm.email.$touched">
                                            @include('front.includes.message')
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                <div class="email-box-2">
                                    <div class="email-title"><?php echo (preg_replace('#<[^>]+>#',' ',translation('mobile_number')));?><i class="red">*</i></div>
                                    <div class="input-block" ng-class="{ 'has-error': updateProfileForm.mobile_number.$touched && updateProfileForm.mobile_number.$invalid }" >
                                        <input type="text" name="mobile_number" 
                                            ng-model="user.mobile_number" placeholder="<?php echo (preg_replace('#<[^>]+>#',' ',translation('mobile_number')));?>" 
                                            ng-minlength="10" 
                                            ng-maxlength="16" 
                                            numbers-only
                                            ng-required="true" />
                                        <div class="error-new-block ng-cloak"  ng-messages="updateProfileForm.mobile_number.$error" ng-if="updateProfileForm.$submitted || updateProfileForm.mobile_number.$touched">
                                            @include('front.includes.message',['minlength' => 10 , 'maxlength' => 16])
                                        </div>
                                    </div>
                                </div>
                            </div>

                             @if(isset($userType) && $userType == 'corporate')
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="email-box-2">
                                    <div class="email-title"><?php echo (preg_replace('#<[^>]+>#',' ',translation('company_name')));?></div>
                                    <div class="input-block" ng-class="{ 'has-error': updateProfileForm.company_name.$touched && updateProfileForm.company_name.$invalid }">
                                        <input type="text" name="company_name" 
                                            ng-model="user.company_name" placeholder="<?php echo (preg_replace('#<[^>]+>#',' ',translation('company_name')));?>" 
                                            ng-required="true" />
                                        <div class="error-new-block ng-cloak" ng-messages="updateProfileForm.company_name.$error" ng-if="updateProfileForm.$submitted || updateProfileForm.company_name.$touched">
                                            @include('front.includes.message')
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif

                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="email-box-2">
                                    <div class="email-title"><?php echo (preg_replace('#<[^>]+>#',' ',translation('address')));?><i class="red">*</i></div>
                                    <div class="input-block" ng-class="{ 'has-error': updateProfileForm.address.$touched && updateProfileForm.address.$invalid }">
                                        <input type="text" name="address"        placeholder="<?php echo (preg_replace('#<[^>]+>#',' ',translation('address')));?>" 
                                                ng-model="user.address" 
                                                ng-maxlength="500" 
                                                ng-required="true" />
                                        <div class="error-new-block ng-cloak" ng-messages="updateProfileForm.address.$error" ng-if="updateProfileForm.$submitted || updateProfileForm.address.$touched">
                                            @include('front.includes.message', ['maxlength' => 500])
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="email-box-2">
                                    <div class="email-title"><?php echo (preg_replace('#<[^>]+>#',' ',translation('country')));?><i class="red">*</i></div>
                                    <div class="select-bock-container" ng-class="{ 'has-error': updateProfileForm.country.$touched && updateProfileForm.country.$invalid }">
                                        <select ng-model="user.country" name="country" ng-change="getCities()" ng-required="true" >
                                            <option value=""><?php echo (preg_replace('#<[^>]+>#',' ',translation('select_country')));?> </option>
                                            <option ng-repeat="country in arr_countries" value="[[country.id]]" >[[country.country_name]]</option>
                                        </select>
                                        <div class="error-new-block ng-cloak" ng-messages="updateProfileForm.country.$error" ng-if="updateProfileForm.$submitted || updateProfileForm.country.$touched">
                                            @include('front.includes.message')
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="email-box-2">
                             <div class="email-title" ><?php echo (preg_replace('#<[^>]+>#',' ',translation('city')));?><i class="red">*</i></div>
                                    <div class="select-bock-container" ng-class="{ 'has-error': updateProfileForm.city.$touched && updateProfileForm.city.$invalid }">
                                        <select ng-model="user.city"  name="city" ng-required="true" >
                                            <option value=""><?php echo (preg_replace('#<[^>]+>#',' ',translation('select_city')));?></option>
                                            <option ng-repeat="city in arr_cities" value="[[city.city_id]]">[[city.city_title]]</option>
                                        </select>
                                        <div class="error-new-block ng-cloak" ng-messages="updateProfileForm.city.$error" ng-if="updateProfileForm.$submitted || updateProfileForm.city.$touched">
                                            @include('front.includes.message')
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                <div class="email-box-2">
                                    <div class="email-title"><?php echo (preg_replace('#<[^>]+>#',' ',translation('postal_code')));?><i class="red">*</i></div>
                                    <div class="input-block" ng-class="{ 'has-error': updateProfileForm.zipcode.$touched && updateProfileForm.zipcode.$invalid }">
                                        <input type="text" name="zipcode"       placeholder="<?php echo (preg_replace('#<[^>]+>#',' ',translation('postal_code')));?>" 
                                            ng-model="user.zipcode" 
                                            ng-minlength="3" 
                                            ng-maxlength="10" />
                                        <div class="error-new-block ng-cloak" ng-messages="updateProfileForm.zipcode.$error" ng-if="updateProfileForm.$submitted || updateProfileForm.zipcode.$touched">
                                            @include('front.includes.message',['minlength' => 3 , 'maxlength' => 10])
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="btn-block-print account">
                                    <button type="submit" class="print-deliver-btn account"><?php echo (preg_replace('#<[^>]+>#',' ',translation('save')));?></button>
                                </div>
                            </div>
                        </form>
                        

                        <form class="login-form-block new-blocks" 
                          name="changePasswordForm" 
                          ng-submit="changePasswordForm.$valid && updatePassword()"
                          ng-init="passwords.msg1 = '<?php echo (preg_replace('#<[^>]+>#',' ',translation('pare_you_sure_to_change_your_passwordp')));?>'";
                          novalidate >
                             
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                              <div id="password_status_msg"></div>
                              <div class="pro-picture-title line"><?php echo (preg_replace('#<[^>]+>#',' ',translation('change_password')));?></div>
                            </div>

                            <input type="hidden" name="msg1"
                                    ng-model="passwords.msg1" 
                                    value="<?php echo (preg_replace('#<[^>]+>#',' ',translation('pare_you_sure_to_change_your_passwordp')));?>" />
                            
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="email-box-2">
                                    <div class="email-title"><?php echo (preg_replace('#<[^>]+>#',' ',translation('old_password')));?><i class="red">*</i></div>
                                    <div class="input-block" ng-class="{ 'has-error': changePasswordForm.current_password.$touched && changePasswordForm.current_password.$invalid }">
                                        <input type="password" name="current_password" placeholder="<?php echo (preg_replace('#<[^>]+>#',' ',translation('old_password')));?>" 
                                                ng-model="passwords.current_password" 
                                                ng-minlength="6" 
                                                {{-- ng-pattern="/^(?=.*[A-Za-z])(?=.*\d)(?=.*[$@$!%*#?&])[A-Za-z\d$@$!%*#?&]{6,}$/" --}}
                                                {{-- ng-pattern="/^(?=.*[a-z])(?=.*\d)(?=.*[$@$!%*#?&])[a-z\d$@$!%*#?&]{6,}$/" --}}
                                                ng-required="true" />
                                        <?php 
                                            $password_pattern=translation('password_pattern');
                                        ?>
                                        <div class="error-new-block ng-cloak" ng-messages="changePasswordForm.current_password.$error" ng-if="changePasswordForm.$submitted || changePasswordForm.current_password.$touched">
                                            @include('front.includes.message' ,['minlength'=> 6])
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                <div class="email-box-2">
                                    <div class="email-title"><?php echo (preg_replace('#<[^>]+>#',' ',translation('new_password')));?><i class="red">*</i></div>
                                    <div class="input-block" ng-class="{ 'has-error': changePasswordForm.new_password.$touched && changePasswordForm.new_password.$invalid }">
                                        <input type="password" name="new_password" id="new_password"  placeholder="<?php echo (preg_replace('#<[^>]+>#',' ',translation('new_password')));?>" 
                                            ng-model="passwords.new_password" 
                                            ng-minlength="6"
                                            {{-- ng-pattern="/^(?=.*[A-Za-z])(?=.*\d)(?=.*[$@$!%*#?&])[A-Za-z\d$@$!%*#?&]{6,}$/" --}}
                                            {{-- ng-pattern="/^(?=.*[a-z])(?=.*\d)(?=.*[$@$!%*#?&])[a-z\d$@$!%*#?&]{6,}$/" --}}
                                            ng-required="true" />
                                            <?php 
                                            $password_pattern=translation('password_pattern'); ?>
                                        
                                        <div class="error-new-block ng-cloak" ng-messages="changePasswordForm.new_password.$error" ng-if="changePasswordForm.$submitted || changePasswordForm.new_password.$touched">
                                            @include('front.includes.message' ,['minlength'=> 6])
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                <div class="email-box-2">
                                    <div class="email-title"><?php echo (preg_replace('#<[^>]+>#',' ',translation('confirm_password')));?><i class="red">*</i></div>
                                    <div class="input-block" ng-class="{ 'has-error': changePasswordForm.confirm_password.$touched && changePasswordForm.confirm_password.$invalid }">
                                        <input type="password" name="confirm_password" placeholder="<?php echo (preg_replace('#<[^>]+>#',' ',translation('confirm_password')));?>" 
                                                ng-model="passwords.confirm_password"
                                                ng-required="true"
                                                pw-check="new_password"/>

                                        <div class="error-new-block ng-cloak" ng-messages="changePasswordForm.confirm_password.$error" ng-if="changePasswordForm.$submitted || changePasswordForm.confirm_password.$touched">
                                            @include('front.includes.message' ,['minlength'=> 6])
                                            <p ng-show="changePasswordForm.confirm_password.$error.pwmatch" class="error"><?php echo (preg_replace('#<[^>]+>#',' ',translation('passwords_do_not_match')));?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="btn-block-print account margin">
                                    <button type="submit" class="print-deliver-btn account"><?php echo (preg_replace('#<[^>]+>#',' ',translation('save')));?></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>