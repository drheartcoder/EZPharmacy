<style>
.PT_express_checkout .PT_open_popup{background-size: 270px; color: #fff;display: block;width: 280px !important; height: 80px !important;}
    .PT_express_checkout {padding: 20px;border: 1px solid #5c1382;width: 290px;}
    @media (max-width: 767px){a#en_button {background-size: 260px;}}
</style>
@include('front.user._inner-breadcrumbs')
<div class="dash-main-block">
    <div class="container">
        <div class="row">
            <div>
                @include('front.user.left-navigation')
            </div>
            <div class="col-xs-12 col-sm-8 col-md-9 col-lg-9">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="table-block-dash my-order-block-table">
                            <div class="left-bar-head get-uploading">
                                <?php echo (preg_replace('#<[^>]+>#',' ',translation('checkout_details')));?>
                            </div>                            
                            <div class="table-responsive">
                                <table class="table table-striped ">
                                    <thead>
                                        <tr>
                                            <th><?php echo (preg_replace('#<[^>]+>#',' ',translation('your_details')));?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <p><?php echo (preg_replace('#<[^>]+>#',' ',translation('wallet_amount')));?>: <span style="font-weight: bold;"><small>SAR</small> {{session('dataWallet.beforeFee')}}</span></p>
                                                <p><?php echo (preg_replace('#<[^>]+>#',' ',translation('processing_fee')));?><small style="font-weight: bold;">({{session('dataWallet.processingFee')}}%)</small>: <small style="font-weight: bold;">SAR {{number_format(session('dataWallet.processingCharge'),2,'.','')}}</small></p>
                                                <p><?php echo (preg_replace('#<[^>]+>#',' ',translation('wallet_amount')));?>: <span style="font-weight: bold;"><small>SAR</small> {{number_format(session('dataWallet.price'),2,'.','')}}</span></p>
                                                <p><?php echo (preg_replace('#<[^>]+>#',' ',translation('first_name')));?>: {{$userData[0]->first_name}}</p>
                                                <p><?php echo (preg_replace('#<[^>]+>#',' ',translation('last_name')));?>: {{$userData[0]->last_name}}</p>
                                                <p><?php echo (preg_replace('#<[^>]+>#',' ',translation('mobile_number')));?>: {{$userData[0]->mobile_number}}</p>
                                                <p><?php echo (preg_replace('#<[^>]+>#',' ',translation('address')));?>: {{$userData[0]->address}}</p>
                                                <p><?php echo (preg_replace('#<[^>]+>#',' ',translation('city')));?>: {{$userData[0]->city_title}}</p>
                                                <p><?php echo (preg_replace('#<[^>]+>#',' ',translation('country')));?>: {{$userData[0]->country_name}}</p>
                                                <p><?php echo (preg_replace('#<[^>]+>#',' ',translation('zipcode')));?>: {{$userData[0]->zipcode}}</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <!--<div class="left-bar-head">
                               <br/>
                                    <?php echo (preg_replace('#<[^>]+>#',' ',translation('pplease_click_for_paymentp')));?>
                                </div>-->  
                                <!-- NOTE BEGIN -->
                                  <div class="col-xs-12">
                                    <div class="row">
                                      <div class="note">
                                        <i class="icon-note"></i><span><?php echo (preg_replace('#<[^>]+>#',' ',translation('pnotep')));?></span> <p><?php echo (preg_replace('#<[^>]+>#',' ',translation('pplease_click_for_paymentp')));?></p>
                                      </div>
                                    </div>
                                  </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="btn-block-print account margin">
                                        <div class="PT_express_checkout"></div>
                                        {{-- <img src="{{url('/')}}/front-assets/images/visa.png"> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" href="https://www.paytabs.com/express/express.css">
<script src="https://www.paytabs.com/theme/express_checkout/js/jquery-1.11.1.min.js"></script>
<script src="https://www.paytabs.com/express/express_checkout_v3.js"></script>
<script type="text/javascript">
    
@if(\App::getLocale() == 'ar')
var _language = 'ar';
@else
var _language = 'en';
@endif

    Paytabs("#express_checkout_v3").expresscheckout({
    settings:{
        secret_key: "{{config('services.paytabs.secret_key')}}",
        merchant_id: "{{config('services.paytabs.merchant_id')}}",
        amount: "{{session('dataWallet.price')}}",
        currency: "{{config('services.paytabs.currency')}}",
        language: _language,
        title: "Wallet Recharge",
        product_names: "Wallet Amount SAR {{session('dataWallet.price')}}",
        order_id: "{{strtoupper(uniqid())}}",
        url_redirect: "{{url('').config('services.paytabs.wallet_success_url')}}",
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
        width: 514,
        height: 142,
        img_url: "{{url('')}}/front-assets/images/visa.png"
    },
    /*pay_button:{
        width: 150,
        height: 30,
        img_url: "https://www.paytabs.com/seals/06.png"
    }*/
});
</script>
