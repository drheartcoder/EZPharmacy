<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\UserModel;
use App\Events\ActivityLogEvent;
use App\Models\ActivityLogsModel;

use Validator;
use Flash;
use Sentinel;
use Hash;
use Image;
use DB;

class AccountSettingsController extends Controller
{

    public function __construct(
                                UserModel $user,
                                ActivityLogsModel $activity_logs
                               )
    {
        $this->UserModel          = $user;
        $this->BaseModel          = $this->UserModel;
        $this->ActivityLogsModel  = $activity_logs;
        
        $this->arr_view_data      = [];
        $this->admin_url_path     = url(config('app.project.admin_panel_slug'));
        $this->module_url_path    = $this->admin_url_path."/account_settings";

        $this->module_title       = "Account Settings";
        $this->module_view_folder = "admin.account_settings";
        
        $this->theme_color        = theme_color();

        $this->module_icon        = "fa-cogs";
    }



    public function index()
    {
        $arr_account_settings = $country_rec = $city_rec = array();

        $arr_data  = [];
        
        $obj_data  = Sentinel::getUser();
        
        if($obj_data)
        {
           $arr_data = $obj_data->toArray();    
        }

        if(isset($arr_data) && sizeof($arr_data)<=0)
        {
            return redirect($this->admin_url_path.'/login');
        }
        /*dd($arr_data);*/
        $country_rec = DB::table('countries')->select('id','country_name')->where('is_active', '=', 1)->get();
        $state_rec = DB::table('state')->select('id','state_title')->where('is_active', '=', 1)->get();
        $city_rec  = DB::table('city')->select('id','city_title')->where('state_id', '=', $arr_data['state'])->where('is_active', '=', 1)->get();

        /*dd($city_rec);*/
        $this->arr_view_data['arr_data']        = $arr_data;
        $this->arr_view_data['country_rec']     = $country_rec;
        $this->arr_view_data['state_rec']       = $state_rec;
        $this->arr_view_data['city_rec']        = $city_rec;
        $this->arr_view_data['page_title']      = str_plural($this->module_title);
        $this->arr_view_data['module_title']    = str_plural($this->module_title);
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['theme_color']     = $this->theme_color;
        $this->arr_view_data['module_icon']     = $this->module_icon;

        return view($this->module_view_folder.'.index',$this->arr_view_data);
    }
 

    public function update(Request $request)
    {
        $arr_rules = array();
        
        $obj_data  = Sentinel::getUser();    

        $arr_rules['first_name']            = "required";
        $arr_rules['last_name']             = "required"; 
        $arr_rules['email']                 = "email|required";
        $arr_rules['old_password']          = "sometimes";
        $arr_rules['new_password']          = "sometimes";
       /* $arr_rules['fax']                   = "required";*/
        $arr_rules['address']               = "required";
        $arr_rules['country']               = "required";
        $arr_rules['state']                  = "required";
        $arr_rules['city']                  = "required";
        /*$arr_rules['zip_code']              = "required";*/
        $arr_rules['mobile_no']             = "required";
       
        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {       
            return redirect()->back()->withErrors($validator)->withInput();  
        }
        

        if($this->UserModel->where('email',$request->input('email'))->where('id','!=',$obj_data->id)->count()==1)
        {
            Flash::error('This Email id already present in our system, please try another one');
            return redirect()->back();
        }
        
        if($request->has('old_password'))
        {
            $old_password= $request->input('old_password');

            if(Hash::check($old_password,$obj_data->password))
            {
                $new_password = $request->input('new_password');

                $update_password = Sentinel::update($obj_data,['password'=>$new_password]);
            }
            else
            {
                Flash::error('Incorrect Old Password');
                return redirect()->back();
            }
        }
        $oldImage=$request->input('oldimage');
        if($request->hasFile('image'))
        {
            $file_name = $request->input('image');
            $file_extension = strtolower($request->file('image')->getClientOriginalExtension());
            if(in_array($file_extension,['png','jpg','jpeg']))
            {
                $file_name = time().uniqid().'.'.$file_extension;
                $isUpload = $request->file('image')->move('uploads/all_users/admin/', $file_name);
                if($isUpload)
                {
                    @unlink('uploads/all_users/admin/'.$oldImage);
                    @unlink('uploads/all_users/admin/thumb_50X50_'.$oldImage);
                    $res= $this->attachmentThumb(file_get_contents('uploads/all_users/admin/'.$file_name), $file_name, 50, 50);
                }
            }
            else
            {
                Flash::error('Invalid File type, While creating '.str_singular($this->module_title));
                return redirect()->back();
            }
        }
        else
        {
             $file_name=$oldImage;
        }

        $arr_data['profile_image'] = $file_name;
        $arr_data['first_name']    = trim($request->input('first_name'));
        $arr_data['last_name']     = trim($request->input('last_name'));
        $arr_data['email']         = $request->input('email');
        $arr_data['mobile_no']     = $request->input('mobile_no');
        $arr_data['fax']           = $request->input('fax');
        $arr_data['address']       = $request->input('address');
        $arr_data['country']       = $request->input('country');
        $arr_data['city']          = $request->input('city');
        $arr_data['state']          = $request->input('state');
        $arr_data['zip_code']      = $request->input('zip_code');

        $obj_data = Sentinel::update($obj_data, $arr_data);

        if($obj_data)
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
     public function attachmentThumb($input, $name, $width, $height)
    {
        $thumb_img = Image::make($input)->resize($width,$height);
        $thumb_img->fit($width,$height, function ($constraint) {
            $constraint->upsize();
        });
        $thumb_img->save('uploads/all_users/admin/thumb_'.$width.'X'.$height.'_'.$name);

         
    }
    public function get_city(Request $request)
    {
        $responce['status'] = '';
        $responce['city_rec'] = $city_rec = array();

        if($request['state'] != '')
        {
            $city_rec = DB::table('city as TC')->select('TC.id','TC.city_title')
                        ->where('TC.state_id', '=', $request['state'])
                        ->where('TC.is_active', '=', 1)
                        ->get();
            if(count($city_rec) > 0)
            {
                $responce['status'] = 'success';
                $responce['city_rec'] = $city_rec;
            }
            else
            {
                $responce['status'] = 'error';
            }
        }
        else
        {
            $responce['status'] = 'error';
        }
		return response()->json($responce);
    }

}
