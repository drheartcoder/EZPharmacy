<?php

return [
    
    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'mandrill' => [
        'secret' => env('MANDRILL_SECRET'),
    ],

    'ses' => [
        'key'    => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'stripe' => [
        'model'  => App\User::class,
        'key'    => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'aramex' => [
        'AccountCountryCode'    => 'SA',
        'AccountEntity'         => 'RUH',
        'AccountNumber'         => '126228',
        'AccountPin'            => '665165',
        'UserName'              => 'kbamohamad@extreme.sa',
        'Password'              => 'Print@123',
        'Version'               => 'v1.0',
    ],

    'paytabs' => [
        /*'secret_key'         => env('PAYTABS_SECRET_KEY','JISRQ5KCxDF3lJBJTeJjcvJ3d0th1bpLThCKnmmU02XlLz4FOOZ0jJ3xJxOLIdwCv9mSwJMwMKSxkXd9Ld95XdCGLrsuFY7a7t2E'),
        'merchant_id'        => env('PAYTABS_MERCHANT_ID','10016166'),*/
        'secret_key'         => env('PAYTABS_SECRET_KEY','qV3fiewrZKpV7GF8wvs92Fd7G5zFDT53P8j7nQznAYiHEYQbuilxYyEFEdkh6qlVzF3XvCk6BDOfCEr6WNDVmhA0vVhCmDyViBSO'),
        'merchant_id'        => env('PAYTABS_MERCHANT_ID','10015804'),
        'currency'           => "SAR",
        'wallet_success_url' => "/user/my-wallet/?recharge=done",
        'cart_success_url'   => "/user/my-orders/?status=done",
        'refund_url'         => 'https://www.paytabs.com/apiv2/refund_process',
        'merchant_email'     => 'khaled@print.sa',
        'refund_reason'      => 'Payment made but shipment is failed',
    ],

];
