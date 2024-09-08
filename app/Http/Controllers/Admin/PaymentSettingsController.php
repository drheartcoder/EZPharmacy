<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\UserModel;
use App\Events\ActivityLogEvent;
use App\Models\PaymentSettingsModel;

use Validator;
use Flash;
use Sentinel;
use Hash;
 
class PaymentSettingsController extends Controller
{

    public function __construct(
                                UserModel $user,
                                PaymentSettingsModel $payment
                               )
    {
        $this->UserModel            = $user;
        $this->PaymentSettingsModel = $payment;
        $this->BaseModel            = $this->PaymentSettingsModel;
        
        $this->arr_view_data        = [];
        $this->admin_url_path       = url(config('app.project.admin_panel_slug'));
        $this->module_url_path      = $this->admin_url_path."/payment_settings";

        $this->module_title         = "Payment Settings";
        $this->module_view_folder   = "admin.payment_settings";
        
        $this->theme_color          = theme_color();

        $this->module_icon          = "fa-cc-mastercard";
    }


    public function index()
    {
        $arr_account_settings = array();

        $arr_data  = [];
        
        $obj_data  = $this->BaseModel->first();
        
        if($obj_data)
        {
           $arr_data = $obj_data->toArray();    
        }

        $this->arr_view_data['arr_data']        = $arr_data;
        $this->arr_view_data['page_title']      = str_plural($this->module_title);
        $this->arr_view_data['module_title']    = str_plural($this->module_title);
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['theme_color']     = $this->theme_color;
        $this->arr_view_data['module_icon']     = $this->module_icon;

        return view($this->module_view_folder.'.index',$this->arr_view_data);
    }
 

    public function update(Request $request)
    {
        $arr_rules                       = array();
        $arr_rules['freelancer_website_commission'] = "required|numeric|min:0.1|max:100";
        
        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {       
            Flash::error('Please Enter the valid Field..!!');
            return redirect()->back()->withErrors($validator)->withInput();  
        }

        $obj_data  = Sentinel::getUser();
        
        if($obj_data)
        {
           $arr_data = $obj_data->toArray();    
        }
        
        $arr_data['freelancer_website_commission'] = $request->input('freelancer_website_commission');

        $obj_settings = $this->PaymentSettingsModel->first();
        
        if(isset($obj_settings) && $obj_settings!="")
        {
            $obj_update = $obj_settings->update($arr_data);
        }

        if($obj_update)
        {
            /*-------------------------------------------------------
            |   Activity log Event
            --------------------------------------------------------*/
                /*$arr_event                 = [];
                $arr_event['ACTION']       = 'EDIT';
                $arr_event['MODULE_TITLE'] = $this->module_title;

                $this->save_activity($arr_event);*/
            /*----------------------------------------------------------------------*/
            Flash::success(str_singular($this->module_title).' Updated Successfully'); 
        }
        else
        {
            Flash::error('Problem Occurred, While Updating '.str_singular($this->module_title));  
        } 
      
        return redirect()->back();
    }
}
