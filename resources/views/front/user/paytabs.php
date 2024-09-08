<!DOCTYPE html>
<html>
<head>
    <title>Paytabs</title>
</head>
<link rel="stylesheet" href="https://www.paytabs.com/express/express.css">

<body>
<!--Button Code for PayTabs Express Checkout-->
<div class="PT_express_checkout" style="width: 50%;height: 150px;"></div>
<script src="https://www.paytabs.com/theme/express_checkout/js/jquery-1.11.1.min.js"></script>
<script src="https://www.paytabs.com/express/express_checkout_v3.js"></script>
<script type="text/javascript">
    Paytabs("#express_checkout_v3").expresscheckout({
        settings: {
            secret_key: "qV3fiewrZKpV7GF8wvs92Fd7G5zFDT53P8j7nQznAYiHEYQbuilxYyEFEdkh6qlVzF3XvCk6BDOfCEr6WNDVmhA0vVhCmDyViBSO",
            merchant_id: "10015804",
            /*secret_key: "JISRQ5KCxDF3lJBJTeJjcvJ3d0th1bpLThCKnmmU02XlLz4FOOZ0jJ3xJxOLIdwCv9mSwJMwMKSxkXd9Ld95XdCGLrsuFY7a7t2E",
            merchant_id: "10016166",*/
            /*secret_key: "nNqPdDtMxoj6ZxHOcqvejQk2v3YFlTNIGeyUS1Gpq0vqxdeJDKYXAiZ6lYLGRzpyNXsFZ95q9AQHO5rrPpoqIow4niLeRbNF8gk8",
            merchant_id: "10016407",*/
            amount: 1.00,
            currency: "SAR",
            title: "Test Express Checkout Transaction",
            product_names: "Product1,Product2,Product3",
            order_id: 25,
            url_redirect: "<?php echo url(''); ?>/user/paytabs",
            display_billing_fields: 1,
            display_shipping_fields: 1,
            display_customer_info: 1,
            language: "ar",
            redirect_on_reject: 1,
            /*style: {
                css: "custom",
                linktocss: "https://www.yourstore.com/css/style.css",
            },
            is_iframe: {
                load: "onbodyload",
                show: 1,
            },*/
        },
        customer_info: {
            first_name: "EBRAHIM",
            last_name: "MANSOOR SAEED",
            phone_number: "5486253",
            country_code: "973",
            email_address: "ibrahim@print.sa"
        },
        billing_address: {
            full_address: "Manama, Bahrain",
            city: "Manama",
            state: "Manama",
            country: "BHR",
            postal_code: "00973"
        },
        shipping_address: {
            shipping_first_name: "EBRAHIM",
            shipping_last_name: "MANSOOR SAEED",
            full_address_shipping: "Manama, Bahrain",
            city_shipping: "Manama",
            state_shipping: "Manama",
            country_shipping: "BHR",
            postal_code_shipping: "00973"
        },
        checkout_button: {
            width: 514,
            height: 142,
            img_url: "<?php echo url('')?>/front-assets/images/visa.png"
        },
        /*pay_button: {
            width: 150,
            height: 30,
            img_url: "<?php echo url('')?>/front-assets/images/visa.png"
        }*/
    });
</script>
</body>
</html>


<!-- <link rel="stylesheet" href="https://www.paytabs.com/express/express.css">
<script src="https://www.paytabs.com/theme/express_checkout/js/jquery-1.11.1.min.js"></script>
<script src="https://www.paytabs.com/express/express_checkout_v3.js"></script>

<div class="PT_express_checkout"></div> -->