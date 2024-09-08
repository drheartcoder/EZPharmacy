<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\MasterModel;  
use App\Common\Traits\MultiActionTrait;
use App\Models\DeliveryLocationModel;  

use Validator;
use Session;
use Flash;
use DB;

class DeliveryLocationController extends Controller
{
    use MultiActionTrait;

    public function __construct(
                                    MasterModel $MasterModel,
                                    DeliveryLocationModel $DeliveryLocationModel
                               )
    {
       $this->MasterModel          = $MasterModel;
       $this->DeliveryLocationModel= $DeliveryLocationModel;
       $this->BaseModel            = $this->DeliveryLocationModel;

       $this->module_title         = "Delivery Location";
       $this->module_url_path      = url(config('app.project.admin_panel_slug')."/delivery_locations/");
       $this->module_view_folder   = 'admin.delivery_location';
       $this->module_icon          = 'fa-truck';
       $this->theme_color          = theme_color();
    }

    public function index()
    {   
        $arr_location = [];
        $obj_location = DB::table('delivery_location as DL')
                                ->select( 
                                            'CNTRY.country_name as countryName',
                                            'CNTRY.id as countryId', 
                                            'DL.same_day_delivery as sameDayDelivery',
                                            'DL.is_active',
                                            'DL.id as pickupLocationId',
                                            'CT.city_title as cityTitle',
                                            'DL.delivery_price'
                                        )
                                ->join('countries as CNTRY' ,'DL.country' ,'=', 'CNTRY.id')
                                ->join('city as CT' ,'DL.city' ,'=', 'CT.id')
                                ->orderBy('DL.id' ,'DESC')
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
        $arr_countries = $this->get_countries();

        if(isset($_POST['btn_add_location']))
        {
            $arr_rules['same_day_delivery'] = "required";
            $arr_rules['country']           = "required";
            $arr_rules['city']              = "required";
            $arr_rules['delivery_price']    = "required";

            
            $validator = Validator::make($request->all(),$arr_rules);
            if($validator->fails())
            {
                 return redirect()->back()->withErrors($validator)->withInput($request->all());
            }

            if($request->input('delivery_price')==0)
            {
                 Flash::error('Price not equeal to 0');
                return redirect()->back();
            }

           
            $arr_location = DB::table('delivery_location as DL')
                                        ->where(array(
                                            'country'=>$request->input('country'),
                                            'city'=>$request->input('city')
                                            ))
                                        ->first();

            if(count($arr_location)>0)
            {
                Flash::error(str_singular($this->module_title) .' already exists.');        
                return redirect()->back()->withInput($request->all());
            }

            $insertArr = array(
                                'same_day_delivery' => $request->input('same_day_delivery'),
                                'country'           => $request->input('country'),
                                'city'              => $request->input('city'),
                                'delivery_price'    => $request->input('delivery_price'),
                                'is_active'         => 1
                            );

            $result = $this->MasterModel->insertRecord('delivery_location',$insertArr);
            
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
            $arr_rules['same_day_delivery'] = "required";
            $arr_rules['country']           = "required";
            $arr_rules['city']              = "required";
            $arr_rules['delivery_price']    = "required";

            
            $validator = Validator::make($request->all(),$arr_rules);
            if($validator->fails())
            {
                 return redirect()->back()->withErrors($validator)->withInput($request->all());
            }

            if($request->input('delivery_price')==0)
            {
                 Flash::error('Price not equeal to 0');
                return redirect()->back();
            }
            
             $arr_location = DB::table('delivery_location as DL')
                                        ->where(array(
                                            'country'=>$request->input('country'),
                                            'city'=>$request->input('city')
                                            ))
                                        ->where('id','!=',$id)
                                        ->first();

            if(count($arr_location)>0)
            {
                Flash::error(str_singular($this->module_title) .' already exists.');        
                return redirect()->back()->withInput($request->all());
            }

            $arr_update = [
                                'same_day_delivery' => $request->input('same_day_delivery'),
                                'country'           => $request->input('country'),
                                'delivery_price'    => $request->input('delivery_price'),
                                'city'              => $request->input('city')
                            ];

            $this->MasterModel->updateRecord('delivery_location', array('id'=>$id), $arr_update);
            Flash::success(str_singular($this->module_title).' Updated Successfully');
        }

        $arr_location = DB::table('delivery_location as DL')
                                        ->where('DL.id', $id)
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

    
    /*
    public function check_exists($value = false , $id =  false)
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
    }
    */
}