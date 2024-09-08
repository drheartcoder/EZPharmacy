<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

$admin_path 		= config('app.project.admin_panel_slug');

Route::group(['middleware' => ['web']], function ()  use($admin_path) 
{	

	/* Admin Routes */
	Route::group(['prefix' => $admin_path,'middleware'=>['admin']], function () 
	{
		Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
		Route::group(array('prefix' => '/common'), function()
		{
			Route::get('get_cities',	['as' => 'get_cities' ,'uses' => 'Common\CommonDataController@get_cities']);
			Route::get('get_states/{country_id}',	['as' => 'get_states' ,'uses' => 'Common\LocationController@get_states']);
		});

		$route_slug        = "admin_auth_";
		$module_controller = "Admin\AuthController@";

		/* Admin Auth Routes Starts */
		Route::get('/',               ['as'=>$route_slug.'login',          'uses'=>$module_controller.'login']);
		Route::get('login',           ['as'=>$route_slug.'login',          'uses'=>$module_controller.'login']);
		Route::post('process_login',  ['as'=>$route_slug.'process_login',  'uses'=>$module_controller.'process_login']);
		Route::get('change_password', ['as'=>$route_slug.'change_password','uses'=>$module_controller.'change_password']);
		Route::post('update_password',['as'=>$route_slug.'change_password','uses'=>$module_controller.'update_password']);
		Route::post('process_forgot_password',['as'=>$route_slug.'forgot_password','uses'=>$module_controller.'process_forgot_password']);
		Route::get('validate_admin_reset_password_link/{enc_id}/{enc_reminder_code}', 	['as'=>$route_slug.'validate_admin_reset_password_link', 'uses' => $module_controller.'validate_reset_password_link']);
		Route::post('reset_password',['as'=>$route_slug.'reset_passsword','uses'=>$module_controller.'reset_password']);
		
		/* Dashboard */
		Route::get('/dashboard',['as'=>$route_slug.'dashboard',  'uses'=>'Admin\DashboardController@index']);	
		Route::get('/logout',   ['as'=>$route_slug.'logout',     'uses'=>$module_controller.'logout']);	
		Route::get('/clear_cache',['as'=>$route_slug.'logout',   'uses'=>$module_controller.'clear_cache']);
		
		/*Account Settings*/
		$account_setting_controller = "Admin\AccountSettingsController@";

		Route::get('account_settings', ['as' => $route_slug.'account_settings_show',   'uses' => $account_setting_controller.'index']);
		Route::post('account_settings/update/{enc_id}', ['as' => $route_slug.'account_settings_update', 'uses' => $account_setting_controller.'update']);
		Route::any('get_city', ['as' => $route_slug.'get_city', 'uses' => $account_setting_controller.'get_city']);
		


		Route::group(array('prefix' => '/countries'), function()
		{
			$route_slug       = "admin_countries_";
			$module_controller = "Admin\CountryController@";

			Route::get('/',					 ['as' => $route_slug.'manage',	  'uses' => $module_controller.'index']);
			Route::get('show/{enc_id}',		 ['as' => $route_slug.'show',		  'uses' => $module_controller.'show']);
			Route::get('edit/{enc_id}',		 ['as' => $route_slug.'edit',	      'uses' => $module_controller.'edit']);
			Route::post('update/{enc_id}',	 ['as' => $route_slug.'update',	  'uses' => $module_controller.'update']);
			Route::get('create',			 ['as' => $route_slug.'create', 	  'uses' => $module_controller.'create']);
			Route::any('store',				 ['as' => $route_slug.'store',	  	  'uses' => $module_controller.'store']);
			Route::get('delete/{enc_id}',	 ['as' => $route_slug.'delete',	  'uses' => $module_controller.'delete']);
			Route::get('activate/{enc_id}',  ['as' => $route_slug.'activate',    'uses' => $module_controller.'activate']);	
			Route::get('deactivate/{enc_id}',['as' => $route_slug.'deactivate',  'uses' => $module_controller.'deactivate']);
			Route::post('multi_action',		 ['as' => $route_slug.'multi_action','uses' => $module_controller.'multi_action']);
		});

		/*-----------------------------------------------------------------------------*/

		/*------------------------- Admin states Related ------------------------------*/

		Route::group(array('prefix' => '/states'), function()
		{
			$route_slug       = "admin_states_";
			$module_controller = "Admin\StateController@";
			
			Route::get('/',					 ['as' => $route_slug.'manage',	  'uses' => $module_controller.'index']);
			Route::get('show/{enc_id}',		 ['as' => $route_slug.'show',		  'uses' => $module_controller.'show']);
			Route::get('edit/{enc_id}',		 ['as' => $route_slug.'edit',		  'uses' => $module_controller.'edit']);
			Route::post('update/{enc_id}',	 ['as' => $route_slug.'update',	  'uses' => $module_controller.'update']);
			Route::get('create',		     ['as' => $route_slug.'create',	  'uses' => $module_controller.'create']);
			Route::post('/store',['as' => $route_slug.'store', 'uses' => $module_controller.'store']);
			Route::get('delete/{enc_id}',	 ['as' => $route_slug.'delete',	  'uses' => $module_controller.'delete']);
			Route::get('activate/{enc_id}',  ['as' => $route_slug.'activate',    'uses' => $module_controller.'activate']);	
			Route::get('deactivate/{enc_id}',['as' => $route_slug.'deactivate',  'uses' => $module_controller.'deactivate']);
			Route::post('multi_action',		 ['as' => $route_slug.'multi_action','uses' => $module_controller.'multi_action']);
			Route::get('load_table_data', 	 ['as' => $route_slug.'manage',	  'uses' => $module_controller.'load_table_data']);
			
		}); 

		/*-----------------------------------------------------------------------------------*/

		/*------------------------- Admin Cities Related ------------------------------*/

		Route::group(array('prefix' => '/cities'), function()
		{
			$route_slug        = "admin_cities_";
			$module_controller = "Admin\CityController@";

			Route::get('/',					 ['as' => $route_slug.'manage',	  'uses' => $module_controller.'index']);
			Route::get('show/{enc_id}',		 ['as' => $route_slug.'show',		  'uses' => $module_controller.'show']);
			Route::get('edit/{enc_id}',		 ['as' => $route_slug.'edit',		  'uses' => $module_controller.'edit']);
			Route::post('update/{enc_id}',	 ['as' => $route_slug.'update',	  'uses' => $module_controller.'update']);
			Route::get('create',			 ['as' => $route_slug.'create',	  'uses' => $module_controller.'create']);
			Route::any('store',			 	 ['as' => $route_slug.'store',		  'uses' => $module_controller.'store']);
			Route::get('delete/{enc_id}',	 ['as' => $route_slug.'delete',	  'uses' => $module_controller.'delete']);
			Route::get('activate/{enc_id}',	 ['as' => $route_slug.'activate', 	  'uses' => $module_controller.'activate']);	
			Route::get('deactivate/{enc_id}',['as' => $route_slug.'deactivate',  'uses' => $module_controller.'deactivate']);
			Route::post('multi_action',		 ['as' => $route_slug.'multi_action','uses' => $module_controller.'multi_action']);
	 		
		});

		/*-----------------------------------------------------------------------------------*/

		/*------------------------- Admin Cities Related ------------------------------*/

		Route::group(array('prefix' => '/area'), function()
		{
			$route_slug        = "admin_area_";
			$module_controller = "Admin\AreaController@";

			Route::get('/',					 ['as' => $route_slug.'manage',	  'uses' => $module_controller.'index']);
			Route::get('show/{enc_id}',		 ['as' => $route_slug.'show',		  'uses' => $module_controller.'show']);
			Route::get('edit/{enc_id}',		 ['as' => $route_slug.'edit',		  'uses' => $module_controller.'edit']);
			Route::post('update/{enc_id}',	 ['as' => $route_slug.'update',	  'uses' => $module_controller.'update']);
			Route::get('create',			 ['as' => $route_slug.'create',	  'uses' => $module_controller.'create']);
			Route::any('store',			 	 ['as' => $route_slug.'store',		  'uses' => $module_controller.'store']);
			Route::get('delete/{enc_id}',	 ['as' => $route_slug.'delete',	  'uses' => $module_controller.'delete']);
			Route::get('activate/{enc_id}',	 ['as' => $route_slug.'activate', 	  'uses' => $module_controller.'activate']);	
			Route::get('deactivate/{enc_id}',['as' => $route_slug.'deactivate',  'uses' => $module_controller.'deactivate']);
			Route::post('multi_action',		 ['as' => $route_slug.'multi_action','uses' => $module_controller.'multi_action']);
	 		
		}); 

		/*-----------------------------------------------------------------------------------*/


		/*------------------------- Admin Speciality Related ------------------------------*/

		Route::group(array('prefix' => '/speciality'), function()
		{
			$route_slug        = "admin_speciality_";
			$module_controller = "Admin\SpecialityController@";

			Route::get('/',					 ['as' => $route_slug.'manage',	  'uses' => $module_controller.'index']);
			Route::get('show/{enc_id}',		 ['as' => $route_slug.'show',		  'uses' => $module_controller.'show']);
			Route::get('edit/{enc_id}',		 ['as' => $route_slug.'edit',		  'uses' => $module_controller.'edit']);
			Route::post('update/{enc_id}',	 ['as' => $route_slug.'update',	  'uses' => $module_controller.'update']);
			Route::get('create',			 ['as' => $route_slug.'create',	  'uses' => $module_controller.'create']);
			Route::any('store',			 	 ['as' => $route_slug.'store',		  'uses' => $module_controller.'store']);
			Route::get('delete/{enc_id}',	 ['as' => $route_slug.'delete',	  'uses' => $module_controller.'delete']);
			Route::get('activate/{enc_id}',	 ['as' => $route_slug.'activate', 	  'uses' => $module_controller.'activate']);	
			Route::get('deactivate/{enc_id}',['as' => $route_slug.'deactivate',  'uses' => $module_controller.'deactivate']);
			Route::post('multi_action',		 ['as' => $route_slug.'multi_action','uses' => $module_controller.'multi_action']);
	 		
		}); 

		/*-----------------------------------------------------------------------------------*/


		/*-----------------------Contact Enquiry---------------------------------------*/

		Route::group(array('prefix'=>'/contact_enquiry'), function () 
		{
			$route_slug       = "admin_contact_enquiry_";
			$route_controller = "Admin\ContactEnquiryController@";

			Route::get('/',['as' => $route_slug.'index',					'uses' => $route_controller.'index']);
			Route::get('/view/{enc_id}',['as' => $route_slug.'details',	    'uses' => $route_controller.'view']);
			Route::get('delete/{enc_id}',['as' => $route_slug.'delete',		 'uses' => $route_controller.'delete']);
			Route::post('multi_action',['as'=> $route_slug.'multi_action',	'uses'=> $route_controller.'multi_action']);
			Route::any('reply/{enc_id}',['as'=> $route_slug.'reply',	'uses'=> $route_controller.'reply']);		

		});


		/*----------------------------------------------------------------------------------------
			Users
		----------------------------------------------------------------------------------------*/

	Route::group(array('prefix' => '/users'), function()
	{
		$route_slug       = "users";
		$module_controller = "Admin\UserController@";
		Route::get('/',['as' => $route_slug.'manage','uses' => $module_controller.'index']);
		Route::get('manage/unverified-doctor', ['as' => $route_slug.'unverified-doctor','uses' => $module_controller.'unverifiedDoctor']);
		Route::get('manage/{usertype?}', ['as' => $route_slug.'manage','uses' => $module_controller.'manage']);
		Route::get('retrieve/',			 ['as' => $route_slug.'retrieve','uses' => $module_controller.'getUserData']);
		Route::post('process/',			 ['as' => $route_slug.'process','uses' => $module_controller.'setUserData']);
		Route::get('status/{userStatus}',['as' => $route_slug.'status','uses' => $module_controller.'setUserStatus']);
		Route::post('create-order',		 ['as' => $route_slug.'create-order','uses' => $module_controller.'createOrder']);
		Route::post('complete-order',	 ['as' => $route_slug.'create-order','uses' => $module_controller.'completeOrder']);
		Route::get('delete/',		 	 ['as' => $route_slug.'delete','uses' => $module_controller.'deleteUser']);
		Route::get('get-pharmacies/',	 ['as' => $route_slug.'get-pharmacies','uses' => $module_controller.'getPharmacies']);
		Route::post('get-cities/',		 ['as' => $route_slug.'get-cities','uses' => $module_controller.'getCities']);
		Route::any('orders/',		 	 ['as' => $route_slug.'orders','uses' => $module_controller.'ordersList']);
		Route::get('loadUsers/{usertype?}',['as' => $route_slug.'manage','uses' => $module_controller.'loadAll']);

		Route::get('all/{cat_id?}',['as' => $route_slug.'manage','uses' => $module_controller.'all']);
		Route::get('loadAllUsers/{cat_id?}',['as' => $route_slug.'manage','uses' => $module_controller.'loadAllUsers']);

		Route::any('change-user-type/',['as' => $route_slug.'manage','uses' => $module_controller.'switch_all']);
		Route::get('loadSwitchUsers/',['as' => $route_slug.'manage','uses' => $module_controller.'loadSwitchUsers']);

		Route::get('loadUserWallet/{usertype}/{enc_id}',['as' => $route_slug.'loadUserWallet',	'uses' => $module_controller.'loadUserWallet']);

		Route::any('{usertype}/wallet_details/{enc_id}',['as' => $route_slug.'wallet_details',	'uses' => $module_controller.'wallet_details']);
		Route::any('wallet-revert',['as' => $route_slug.'walletRevert',	'uses' => $module_controller.'walletRevert']);

		Route::get('view/{enc_id}',	     			['as' => $route_slug.'view',	  			'uses' => $module_controller.'view']);	
		Route::get('my_files/{enc_id}',	   		 	['as' => $route_slug.'view',	  			'uses' => $module_controller.'my_files']);	
		Route::get('delete/{enc_id}',	 			['as' => $route_slug.'delete',	 			'uses' => $module_controller.'delete']);	
		Route::get('activate/{enc_id}',  			['as' => $route_slug.'activate',	 		'uses' => $module_controller.'activate']);	
		Route::get('deactivate/{enc_id}',			['as' => $route_slug.'deactivate',  		'uses' => $module_controller.'deactivate']);	
		Route::get('verify/{enc_id}',				['as' => $route_slug.'verify',  			'uses' => $module_controller.'verify']);	
		Route::get('unverify/{enc_id}',				['as' => $route_slug.'unverify',  			'uses' => $module_controller.'unverify']);	
		Route::post('multi_action',		 			['as' => $route_slug.'multi_action',		'uses' => $module_controller.'multi_action']);	
		Route::post('action_user_category',   		['as' => $route_slug.'action_user_category','uses' => $module_controller.'action_user_category']);
		
		Route::any('authenticating/{id?}',['as' => $route_slug.'authenticating','uses' => $module_controller.'loginAsUser']);
		Route::get('verified/',		 	 ['as' => $route_slug.'verified','uses' => $module_controller.'verifiedDoctor']);

	});

		/*---------------------------------------------------------------------------------------
			End
		-----------------------------------------------------------------------------------------*/

		

		/*----------------------------------------------------------------------------------------
			Static Pages - CMS
		----------------------------------------------------------------------------------------*/

			Route::group(array('prefix' => '/static_pages'), function()
			{
				$route_slug       = "static_pages_";
				$module_controller = "Admin\StaticPageController@";

				Route::get('/', 				 ['as' => $route_slug.'manage',	  'uses' => $module_controller.'index']);
				Route::get('create',			 ['as' => $route_slug.'create',	  'uses' => $module_controller.'create']);
				Route::get('edit/{enc_id}',		 ['as' => $route_slug.'edit',		  'uses' => $module_controller.'edit']);
				Route::any('store',				 ['as' => $route_slug.'store',		  'uses' => $module_controller.'store']);
				Route::post('update/{enc_id}',	 ['as' => $route_slug.'update',	  'uses' => $module_controller.'update']);
				Route::get('delete/{enc_id}',	 ['as' => $route_slug.'delete',	  'uses' => $module_controller.'delete']);	
				Route::get('activate/{enc_id}',  ['as' => $route_slug.'activate',	  'uses' => $module_controller.'activate']);
				Route::get('deactivate/{enc_id}',['as' => $route_slug.'deactivate',  'uses' => $module_controller.'deactivate']);
				Route::post('multi_action',		 ['as' => $route_slug.'multi_action','uses' => $module_controller.'multi_action']);	
			});


		/*---------------------------------------------------------------------------------------
			End
		-----------------------------------------------------------------------------------------*/

		/*----------------------------------------------------------------------------------------
			Site Settings
		----------------------------------------------------------------------------------------*/

			Route::get('site_settings',	['as' => 'site_settings', 'uses' => 'Admin\SiteSettingController@index']);
			Route::post('site_settings/update/{enc_id}', ['as' => 'site_settings', 'uses' => 'Admin\SiteSettingController@update']);

		/*---------------------------------------------------------------------------------------
		|	End
		-----------------------------------------------------------------------------------------*/

		/*---------------------------------------------------------------------------------------
		|	Email Template
		-----------------------------------------------------------------------------------------*/

		Route::group(array('prefix' => '/email_template'), function()
		{
			$route_slug        = "admin_email_template_";
			$module_controller = "Admin\EmailTemplateController@";
			Route::get('create',['as' => $route_slug.'create','uses' => $module_controller.'create']);
			Route::post('store/',['as' => $route_slug.'store','uses' => $module_controller.'store']);
			Route::get('edit/{enc_id}',['as' => $route_slug.'edit','uses' => $module_controller.'edit']);
			Route::get('view/{enc_id}/{act_lng}',['as' => $route_slug.'edit','uses' => $module_controller.'view']);
			Route::post('update/{enc_id}',['as' => $route_slug.'update','uses' => $module_controller.'update']);
			Route::get('/',['as' => $route_slug.'index', 'uses' => $module_controller.'index']);
		});

		/*---------------------------------------------------------------------------------------
		|	End
		-----------------------------------------------------------------------------------------*/
		
		/*------------------------Order History Routes Starts--------------------------------------------*/
		Route::group(['prefix' => 'order_history'], function () 
		{
			$route_slug        = "admin_order_history_";
			$module_controller = "Admin\OrderHistoryController@";
			Route::any('/',				[ 'as' => $route_slug.'index' , 'uses' => $module_controller.'index']);
			Route::get('send_sms',		[ 'as' => $route_slug.'send_sms' , 'uses' => $module_controller.'send_sms']);
			Route::get('get_records',	[ 'as' => $route_slug.'get_records' , 'uses'=> $module_controller.'get_records']);
			Route::get('view/{enc_id}', ['as' => $route_slug.'view' , 'uses' => $module_controller.'view']); 
			Route::post('complete-order',	 ['as' => $route_slug.'create-order','uses' => $module_controller.'completeOrder']);
			Route::get('view_order_details/{enc_id}', ['as' => $route_slug.'view' , 'uses' => $module_controller.'view_order_details']); 
			Route::any('change_order_status',	[ 'as' => $route_slug.'change_order_status' , 'uses'=> $module_controller.'change_order_status']);
			Route::any('order/{mode}',	[ 'as' => $route_slug.'' , 'uses'=> $module_controller.'proceedOrder']);
		});
		/*------------------------Order History Routes Ends--------------------------------------------*/
	});

	/*------------	Ends ---------------*/
	include(app_path('Http/Routes/Front/front.php'));
	
});