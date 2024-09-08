<?php

$routeSlug       = "user";
$moduleController = "Front\UserController@";
Route::any('', 				[ 'as' => 'index',			'uses' => $moduleController.'index']);
Route::any('userRegister', 	['as' => 'userRegister',		'uses' => $moduleController.'register']);
Route::any('userLogin',		['as' => 'userLogin',		'uses' => $moduleController.'login']);
Route::post('verifyOTP',	['as' => 'verifyOTP',		'uses' => $moduleController.'verifyOTP']);
Route::any('createOrder',	['as' => 'createOrder',		'uses' => $moduleController.'createOrder']);
Route::any('getPharmacies',	['as' => 'getPharmacies',	'uses' => $moduleController.'getPharmacies']);
Route::any('get_Pharmacies',	['as' => 'get_Pharmacies',	'uses' => $moduleController.'get_Pharmacies']);
Route::any('previewPrescription/{id}',	['as' => 'previewPrescription',	'uses' => $moduleController.'previewPrescription']);
Route::any('getCityList',	['as' => 'getCityList',	'uses' => $moduleController.'getCityList']);
Route::any('getAreaList',	['as' => 'getAreaList',	'uses' => $moduleController.'getAreaList']);
Route::any('getSpecialityList',	['as' => 'getSpecialityList',	'uses' => $moduleController.'getSpecialityList']);
Route::any('getDoctorList',	['as' => 'getDoctorList',	'uses' => $moduleController.'getDoctorList']);
Route::any('getPharmacyList',	['as' => 'getPharmacyList',	'uses' => $moduleController.'getPharmacyList']);

/* Order History*/
$OrderHistoryController = "Front\OrderHistoryController@";
Route::any('orderHistory',	['as' => 'index',			'uses' => $OrderHistoryController.'index']);
Route::any('proceedOrder',	['as' => 'proceedOrder',	'uses' => $OrderHistoryController.'proceedOrder']);
Route::any('completeOrder',	['as' => 'completeOrder',	'uses' => $OrderHistoryController.'completeOrder']);
Route::any('getOrder',		['as' => 'getOrder',		'uses' => $OrderHistoryController.'getOrder']);
?>