<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\MasterModel;  

use Validator;
use Session;
use Flash;
use DB;

class UserCategoryController extends Controller
{
    public function __construct(
                                    MasterModel $MasterModel
                               )
    {
       $this->MasterModel          = $MasterModel;

       $this->module_title         = "User Categories";
       $this->module_url_path      = url(config('app.project.admin_panel_slug')."/user_categories/");
       $this->module_view_folder   = 'admin.user_categories';
       $this->module_icon          = 'fa-bars';
       $this->theme_color          = theme_color();
       $this->tbl_user_categories  = 'user_categories';
    }

    public function index()
    {
        $arr_categories = DB::table($this->tbl_user_categories.' as UC')
                                    /*->where('UC.id','<>','0') */// default category is not shown
                                    ->orderBy('name', 'asc')
                                    ->get();

        $this->arr_view_data['page_title']        = "Manage ".str_plural($this->module_title);
        $this->arr_view_data['module_title']      = $this->module_title;
        $this->arr_view_data['module_url_path']   = $this->module_url_path;
        $this->arr_view_data['arr_data']          = $arr_categories;
        $this->arr_view_data['module_icon']       = $this->module_icon;
        $this->arr_view_data['theme_color']       = $this->theme_color;

        return view($this->module_view_folder.'.index',$this->arr_view_data);
    }

    public function create(Request $request)
    {   
        if(isset($_POST['btn_add_user_category']))
        {
            $arr_rules['name']       = "required";
            
            $validator = Validator::make($request->all(),$arr_rules);
            if($validator->fails())
            {
                 return redirect()->back()->withErrors($validator)->withInput($request->all());
            }

            $does_exists = $this->check_exists($request->input('name'));

            if($does_exists == false )
            {
                Flash::error(str_singular($this->module_title) .' already exists.');        
                return redirect()->back()->withInput($request->all());
            }

            $insertArr = array(
                                'name' => ucfirst($request->input('name'))
                                );

            $result = $this->MasterModel->insertRecord($this->tbl_user_categories,$insertArr);
            
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
        return view($this->module_view_folder.'.create',$this->arr_view_data);
    }

    public function edit(Request $request, $enc_id)
    {
        $id = base64_decode($enc_id);

        if(isset($_POST['btn_edit_user_category']))
        {
            $arr_rules['name']       = "required";
            
            $validator = Validator::make($request->all(),$arr_rules);
            if($validator->fails())
            {
                 return redirect()->back()->withErrors($validator)->withInput($request->all());
            }

            $does_exists = $this->check_exists($request->input('name'), $id);

            if($does_exists == false )
            {
                Flash::error(str_singular($this->module_title) .' already exists.', $id);        
                return redirect()->back()->withInput($request->all());
            }

            $arr_user_category_update = array(
                                                'name' => ucfirst($request->input('name'))
                                            );

            $this->MasterModel->updateRecord($this->tbl_user_categories, array('id'=>$id), $arr_user_category_update);
            Flash::success(str_singular($this->module_title).' Updated Successfully');
        }

        $arr_category = DB::table($this->tbl_user_categories.' as UC')
                                        ->where('UC.id', $id)
                                        ->where('UC.id','<>','0') // check if default category does not occure in result set
                                        ->first();
        
        $this->arr_view_data['edit_mode']       = true;
        $this->arr_view_data['enc_id']          = $enc_id;
        $this->arr_view_data['page_title']      = "Edit ".$this->module_title;
        $this->arr_view_data['module_title']    = $this->module_title;
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['module_icon']     = $this->module_icon;
        $this->arr_view_data['arr_data']        = $arr_category;
        
        return view($this->module_view_folder.'.edit',$this->arr_view_data);
    }

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

    public function multi_action(Request $request)
    {
        $arr_rules = array();
        $arr_rules['multi_action']   = "required";
        $arr_rules['checked_record'] = "required";

        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {
            Flash::error('Please Select '.$this->module_title.' To Perform Multi Actions');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $multi_action   = $request->input('multi_action');
        $checked_record = $request->input('checked_record');

        /* Check if array is supplied*/
        if(is_array($checked_record) && sizeof($checked_record)<=0)
        {
            Flash::error('Problem Occurred, While Doing Multi Action');
            return redirect()->back();
        }

        foreach ($checked_record as $key => $record_id) 
        {  
            if($multi_action=="delete")
            {
               $this->perform_delete(base64_decode($record_id));    
               Flash::success($this->module_title.' Deleted Successfully'); 
            }    
        }

        return redirect()->back();
    }

    public function perform_delete($id)
    {
        $delete = DB::table('user_categories')->where('id',$id)->delete();
        
        if($delete)
        {
            return true;
        }
        return false;
    }
        
    public function delete($enc_id = false)
    {
        if(!$enc_id)
        {
            return redirect()->back();
        }

        if($this->perform_delete(base64_decode($enc_id)))
        {   
            $this->remove_category_from_user(base64_decode($enc_id));
            Flash::success($this->module_title.' Deleted Successfully');
        }
        else
        {
            Flash::error('Problem Occured While '.$this->module_title.' Deletion ');
        }
        return redirect()->back();
    }

    public function remove_category_from_user($id)
    {
        $delete = DB::table('login_master')->where('category_id',$id)->update(['category_id' => '0']);

        if($delete)
        {
            return true;
        }
        return false;
    }
}
