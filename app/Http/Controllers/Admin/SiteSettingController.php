<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\SiteSettingModel;
use App\Events\ActivityLogEvent;
use App\Models\ActivityLogsModel;

use Validator;
use Flash;
use Input;
use Sentinel;
 
class SiteSettingController extends Controller
{
    
    public function __construct(SiteSettingModel $siteSetting,
                                ActivityLogsModel $activity_logs)
    {
        $this->SiteSettingModel   = $siteSetting;
        $this->arr_view_data      = [];
        $this->BaseModel          = $this->SiteSettingModel;
        $this->ActivityLogsModel  = $activity_logs;
        
        $this->module_title       = "Site Settings";
        $this->module_view_folder = "admin.site_settings";
        $this->module_url_path    = url(config('app.project.admin_panel_slug')."/site_settings");
        $this->theme_color        = theme_color();
    }

    /*
    | Index  : Display Website settings page
    | auther : Nitesh Acharya
    | Date   : 03/11/2016
    | @return \Illuminate\Http\Response
    */ 
 
    public function index()
    {
        return redirect(url('').'/'.config('app.project.admin_panel_slug')."/dashboard/");
        $arr_data = array();   

        $obj_data =  $this->BaseModel->first();

        if($obj_data != FALSE)
        {
            $arr_data = $obj_data->toArray();    
        }

        $this->arr_view_data['arr_data']        = $arr_data;
        $this->arr_view_data['page_title']      = str_singular($this->module_title);
        $this->arr_view_data['module_title']    = str_plural($this->module_title);
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['theme_color']     = $this->theme_color;

        return view($this->module_view_folder.'.index',$this->arr_view_data);
    }
 

    /*
    | update() : Update the Website Settings
    | auther : Nitesh Acharya
    | Date   : 03/11/2016
    | @param  int  $enc_id
    | @return \Illuminate\Http\Response
    */ 

    public function update(Request $request, $enc_id)
    {
        $id = base64_decode($enc_id);

        $arr_rules = array();

        $arr_data['site_name']            = "required";
        $arr_rules['site_email_address']  = "email|required";
        $arr_rules['site_contact_number'] = "required|min:6|max:15";
        $arr_rules['site_address']        = "required";
        $arr_rules['fb_url']              = "required";
        //$arr_rules['linked_in_url']       = "required";
        $arr_rules['twitter_url']         = "required";
        $arr_rules['instagram_url']       = "required";
        $arr_rules['site_status']         = "required";
        $arr_rules['processing_charge']   = "required";
        $arr_rules['lat']                 = "required";
        $arr_rules['lng']                 = "required";
        $arr_rules['transcation_email_address']= "required";
        $arr_rules['support_email_address']= "required";

        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {       
            return back()->withErrors($validator)->withInput();  
        } 


        if($request->input('processing_charge')==0)
        {
             Flash::error('Processing charge percentage not be 0'); 
             return redirect()->back();
        }
        else if($request->input('processing_charge')>100)
        {
             Flash::error('Processing charge percentage not be greater than 100'); 
             return redirect()->back();
        }

        $arr_data['site_name']           = $request->input('site_name');
        $arr_data['site_address']        = $request->input('site_address');
        $arr_data['site_contact_number'] = $request->input('site_contact_number');
        $arr_data['meta_desc']           = $request->input('meta_desc');
        $arr_data['meta_keyword']        = $request->input('meta_keyword');
        $arr_data['site_email_address']  = $request->input('site_email_address');
        $arr_data['fb_url']              = $request->input('fb_url');
        $arr_data['twitter_url']         = $request->input('twitter_url');
        //$arr_data['linked_in_url']       = $request->input('linked_in_url');
        $arr_data['instagram_url']       = $request->input('instagram_url');
        $arr_data['site_status']         = $request->input('site_status');
        $arr_data['processing_charge']   = $request->input('processing_charge');
        $arr_data['latitude']            = $request->input('lat');
        $arr_data['longitude']           = $request->input('lng');
        $arr_data['transcation_email_address']= $request->input('transcation_email_address');
        $arr_data['support_email_address']= $request->input('support_email_address');

        $entity = $this->BaseModel->where('site_setting_id',$id)->update($arr_data);

        if($entity)
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
            Flash::error('Problem Occured, While Updating '.str_singular($this->module_title));  
        } 
      
        return redirect()->back()->withInput();
    }
}

