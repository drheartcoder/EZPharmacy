<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\MasterModel;  
use App\Common\Traits\MultiActionTrait;
use App\Models\PickupLocationModel;  

use Validator;
use Session;
use Flash;
use DB;
use Image;


class PickupLocationController extends Controller
{
    use MultiActionTrait;

    public function __construct(
                                    MasterModel $MasterModel,
                                    PickupLocationModel $PickupLocationModel
                               )
    {
       $this->MasterModel          = $MasterModel;
       $this->PickupLocationModel  = $PickupLocationModel;
       $this->BaseModel            = $this->PickupLocationModel;

       $this->module_title         = "Pickup Location";
       $this->module_url_path      = url(config('app.project.admin_panel_slug')."/pickup_locations/");
       $this->module_view_folder   = 'admin.pickup_location';
       $this->module_icon          = 'fa-truck';
       $this->theme_color          = theme_color();
    }

    public function index()
    {   
        $arr_location = [];
        $obj_location = DB::table('pickup_location as PL')
                                ->select( 
                                            'CNTRY.country_name as countryName',
                                            'CNTRY.id as countryId', 
                                            'PL.location',
                                            'PL.is_active',
                                            'PL.id as pickupLocationId',
                                            'CT.city_title as cityTitle'
                                        )
                                ->join('countries as CNTRY' ,'PL.country' ,'=', 'CNTRY.id')
                                ->join('city as CT' ,'PL.city' ,'=', 'CT.id')
                                ->orderBy('PL.id','DESC')
                                ->get();

        if(count($obj_location) > 0)
        {
            $arr_location = $obj_location;
        }   

        $this->arr_view_data['page_title']        = "Manage ".str_plural($this->module_title);
        $this->arr_view_data['module_title']      = $this->module_title;
        $this->arr_view_data['module_url_path']   = $this->module_url_path;
        $this->arr_view_data['arr_data']          = $arr_location;
        $this->arr_view_data['module_icon']       = $this->module_icon;
        $this->arr_view_data['theme_color']       = $this->theme_color;

        return view($this->module_view_folder.'.index',$this->arr_view_data);
    }

    public function create(Request $request)
    {   
        //dd($request->all());
        $arr_countries = $this->get_countries();

        if(isset($_POST['btn_add_country']))
        {
            $arr_rules['locations_name']             = "required";
            $arr_rules['country']              = "required";
            $arr_rules['city']                 = "required";
            $arr_rules['location_description'] = "required";
            $arr_rules['google_address']       = "required";
            $arr_rules['lat']             = "required";
            $arr_rules['lng']            = "required";
            // $arr_rules['image']                = "required";
            
            $validator = Validator::make($request->all(),$arr_rules);
            if($validator->fails())
            {
                 return redirect()->back()->withErrors($validator)->withInput($request->all());
            }
                $file_name = "";
            if($request->hasFile('image'))
            {
                $file_name = $request->input('image');
                $file_extension = strtolower($request->file('image')->getClientOriginalExtension());
                if(in_array($file_extension,['png','jpg','jpeg','gif']))
                {
                        $file_name = time().uniqid().'.'.$file_extension;
                        $isUpload = $request->file('image')->move('uploads/pickup_location/', $file_name);
                        if($isUpload)
                        {
                            $res= $this->attachmentThumb(file_get_contents('uploads/pickup_location/'.$file_name), $file_name, 270, 190);
                            $res1= $this->attachmentThumb(file_get_contents('uploads/pickup_location/'.$file_name), $file_name, 200, 150);
                        }
                        

                       
                }
                else
                {
                    Flash::error('Invalid File type, While creating '.str_singular($this->module_title));
                    return redirect()->back();
                }
            }

       
            $insertArr = array(
                                'location'             => $request->input('locations_name'),
                                'country'              => $request->input('country'),
                                'city'                 => $request->input('city'),
                                'location_description' => $request->input('location_description'),
                                'google_address'       => $request->input('google_address'),
                                'latitude'             => $request->input('lat'),
                                'longitude'            => $request->input('lng'),
                                'image'                => $file_name,
                                'is_active'            => 1
                            );

            $result = $this->MasterModel->insertRecord('pickup_location',$insertArr);
            
            if($result != '')
            {
               Flash::success(str_singular($this->module_title).' created successfully'); 
            }
            else
            {
                Flash::error('Problem Occured, While creating '.str_singular($this->module_title));
            }
            return redirect()->back();
        }

        $this->arr_view_data['page_title']      = "Create ".str_singular($this->module_title);
        $this->arr_view_data['module_title']    = $this->module_title;
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['module_icon']     = $this->module_icon;
        $this->arr_view_data['theme_color']     = $this->theme_color;
        $this->arr_view_data['arr_countries']   = $arr_countries;
        return view($this->module_view_folder.'.create',$this->arr_view_data);
    }

    public function edit(Request $request, $enc_id)
    {   
        $arr_countries = $this->get_countries();

        $id = base64_decode($enc_id);

        if(isset($_POST['btn_update_location']))
        {
            $arr_rules['locations_name']      = "required";
            $arr_rules['country']       = "required";
            $arr_rules['city']          = "required";
            $arr_rules['location_description'] = "required";
            $arr_rules['google_address']      = "required";
            $arr_rules['lat']             = "required";
            $arr_rules['lng']            = "required";
            
            $validator = Validator::make($request->all(),$arr_rules);
            if($validator->fails())
            {
                 return redirect()->back()->withErrors($validator)->withInput($request->all());
            }

            $oldImage=$request->input('oldimage');
            $file_name = "";
            if($request->hasFile('image'))
            {
                $file_name = $request->input('image');
                $file_extension = strtolower($request->file('image')->getClientOriginalExtension());
                if(in_array($file_extension,['png','jpg','jpeg','gif']))
                {
                        $file_name = time().uniqid().'.'.$file_extension;
                        $isUpload = $request->file('image')->move('uploads/pickup_location/', $file_name);
                        if($isUpload)
                        {
                            @unlink('uploads/pickup_location/'.$oldImage);
                            @unlink('uploads/pickup_location/thumb_270X190_'.$oldImage);

                            $res= $this->attachmentThumb(file_get_contents('uploads/pickup_location/'.$file_name), $file_name, 270, 190);
                             $res1= $this->attachmentThumb(file_get_contents('uploads/pickup_location/'.$file_name), $file_name, 200, 150);
                        }
                      
                       
                }
                else
                {
                   Flash::error('Invalid File type, While updating '.str_singular($this->module_title));
                    return redirect()->back();
                }
            }
            else
            {
                 $file_name=$oldImage;
            }



            $arr_update = [
                                'location'             => $request->input('locations_name'),
                                'country'              => $request->input('country'),
                                'city'                 => $request->input('city'),
                                'latitude'             => $request->input('lat'),
                                'longitude'            => $request->input('lng'),
                                'google_address'       => $request->input('google_address'),
                                'location_description' => $request->input('location_description'),
                                'image' => $file_name,
                            ];

            $this->MasterModel->updateRecord('pickup_location', array('id'=>$id), $arr_update);
            Flash::success(str_singular($this->module_title).' Updated Successfully');
        }

        $arr_location = DB::table('pickup_location as PL')
                                        ->where('PL.id', $id)
                                        ->first();
        
        $this->arr_view_data['edit_mode']       = true;
        $this->arr_view_data['enc_id']          = $enc_id;
        $this->arr_view_data['page_title']      = "Edit ".$this->module_title;
        $this->arr_view_data['module_title']    = $this->module_title;
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['module_icon']     = $this->module_icon;
        $this->arr_view_data['arr_data']        = $arr_location;
        $this->arr_view_data['theme_color']     = $this->theme_color;
        $this->arr_view_data['arr_countries']   = $arr_countries;

        return view($this->module_view_folder.'.edit',$this->arr_view_data);
    }

    public function get_countries()
    {
        $arr_countries = [];
        $obj_countries = DB::table('countries as C')->select('C.id','C.country_name')->where('C.is_active',1)->get();   
        
        if(count($obj_countries) > 0)
        {
            $arr_countries = $obj_countries;
        }

        return $arr_countries;
    }

    /*public function check_exists($value = false , $id =  false)
    {
        if($value != false) {

            $does_exists = DB::table($this->tbl_user_categories.' as UC')
                                    ->where('UC.name', $value);                                        

            if($id != false) {
                $does_exists = $does_exists->where('id','<>',$id);                   
            }

            $does_exists = $does_exists->count();   
            if($does_exists <= 0) {
                return true; // if count is zero then value can be added.
            }
        }
        return false;
    }*/

     public function attachmentThumb($input, $name, $width, $height)
    {
        $thumb_img = Image::make($input)->resize($width,$height);
        $thumb_img->fit($width,$height, function ($constraint) {
            $constraint->upsize();
        });
        $thumb_img->save('uploads/pickup_location/thumb_'.$width.'X'.$height.'_'.$name);

         
    }

}

