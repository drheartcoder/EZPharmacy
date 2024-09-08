<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'user/my-wallet/',
        'user/my-orders',
        'user/paytabs',
        'userRegister',
        'userLogin',
        'createOrder',
        'verifyOTP',
        'orderHistory',
        'getPharmacies',
        'get_Pharmacies',
        'proceedOrder',
        'completeOrder',
        'previewPrescription',
    ];
}
