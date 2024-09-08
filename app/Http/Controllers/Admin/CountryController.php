<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Common\Traits\MultiActionTrait;
use App\Models\MasterModel;
use Validator;
use Session;
use Flash;
use DB;
 
class CountryController extends Controller
{
    use MultiActionTrait;
    
    public function __construct(MasterModel $MasterModel)
    {
        $this->arr_view_data = [];
        $this->module_url_path    = url(config('app.project.admin_panel_slug')."/countries");
        $this->module_title       = "Countries";
        $this->module_url_slug    = "countries";
        $this->module_view_folder = "admin.countries";
        $this->theme_color        = theme_color();
    }   
 
    public function index()
    {
        $arr_lang = array();
        $arr_data = array();

        
        $arr_data = DB::table('countries')->where('is_active', '=', '1')->orderBy('country_name', 'ASC')->paginate(50);
        
        $this->arr_view_data['arr_data'] = $arr_data;
        $this->arr_view_data['page_title']      = "Manage ".str_singular($this->module_title);
        $this->arr_view_data['module_title']    = str_plural($this->module_title);
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['theme_color']     = $this->theme_color;
        //dd($this->arr_view_data);
        return view($this->module_view_folder.'.index',$this->arr_view_data);
    }

    public function show($enc_id)
    {
        $id = base64_decode($enc_id);
        $arr_data = array();
        $obj_data = $this->BaseModel->where('id',$id)->first();
        if($obj_data != FALSE)
        {
            $arr_data = $obj_data->toArray();
        }

        $this->arr_view_data['arr_data'] = $arr_data;

        $this->arr_view_data['page_title']      = "Show ".str_singular($this->module_title);
        $this->arr_view_data['module_title']    = str_plural($this->module_title);
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['theme_color']     = $this->theme_color;

        return view($this->module_view_folder.'.show',$this->arr_view_data);

    }

    
    
    public function create()
    {
        $this->arr_view_data['arr_lang'] = $this->LanguageService->get_all_language();  

        $this->arr_view_data['page_title']      = "Create ".str_singular($this->module_title);
        $this->arr_view_data['module_title']    = str_plural($this->module_title);
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['theme_color']     = $this->theme_color;

        return view($this->module_view_folder.'.create',$this->arr_view_data);
    }


    public function store(Request $request)
    {
        $form_data = array();

        /* English Required */
        $arr_rules['country_code']      = "required|max:3";
        $arr_rules['phone_code']        = "required|max:8";
        $arr_rules['country_name_en']   = "required";
        
        $form_data = $request->all();

        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        /* Check if country already exists with given translation */
        $does_exists = $this->BaseModel
                            ->where('country_name',$request->input('country_name_en'))      
                            ->whereHas('translations',function($query) use($request)

                                        {
                                            $query->where('locale','en')
                                                  ->where('country_name',$request->input('country_name_en'));      
                                        })
                            ->count();   

        if($does_exists)
        {
            Flash::error(str_singular($this->module_title).' Name Already Exists.');
            return redirect()->back()->withInput($request->all());
        }

        $code_exists = $this->country_code_duplication($request->input('country_code'));

        if($code_exists == true)
        {
            Flash::error(str_singular($this->module_title).' Code Already Exists.');
            return redirect()->back()->withInput($request->all());
        }

        $phone_code_exists = $this->phone_code_duplication($request->input('phone_code'));

        if($phone_code_exists == true)
        {
            Flash::error(str_singular($this->module_title).' Phone Code Already Exists.');
            return redirect()->back();
        }

        /* Insert into Country Table */

        $arr_data = array();
        $arr_data['country_code'] =  $form_data['country_code'];
        $arr_data['phone_code']   =  $form_data['phone_code'];
        $arr_data['country_name'] =  $request->input('country_name_en');

        $entity = $this->BaseModel->create($arr_data);

        if($entity)      
        {
            Flash::success(str_singular($this->module_title).' Created Successfully');

            $arr_lang =  $this->LanguageService->get_all_language();      
            
            //insert record into translation table 
            if(sizeof($arr_lang) > 0 )
            {
                foreach ($arr_lang as $lang) 

                {        
                    $arr_data = array();
                    $country_name = 'country_name_'.$lang['locale'];

                    if( isset($form_data[$country_name]) && $form_data[$country_name] != '')
                    { 
                        $translation = $entity->translateOrNew($lang['locale']);

                        $translation->country_id    = $entity->id;
                        $translation->country_name  = $form_data[$country_name];

                        $translation->save();

                    }

                }//foreach 

                Flash::success(str_singular($this->module_title).' Created Successfully');
                
            } //if
            else
            {
                Flash::error('Problem Occurred, While Creating '.str_singular($this->module_title));
            }
        }
        else
        {
            Flash::error('Problem Occurred, While Creating '.str_singular($this->module_title));
        }

        return redirect()->back();
    }


    public function edit($enc_id)
    {

        $id = base64_decode($enc_id); 
        // 
        /*$obj_data = $this->CountryModel->where('id', $id)->with(['translations'])->first();*/
        $obj_data = [];

        $arr_data = [];
        if($obj_data)
        {
           $arr_data = $obj_data->toArray(); 
           /*Arrange Locale Wise*/
           $arr_data['translations'] = $this->arrange_locale_wise($arr_data['translations']);
        }
        //dd($arr_data);
        $this->arr_view_data['edit_mode'] = TRUE;
        $this->arr_view_data['enc_id']    = $enc_id;
        $this->arr_view_data['arr_lang']  = $this->LanguageService->get_all_language();
        
        $this->arr_view_data['arr_data']        = $arr_data;
        $this->arr_view_data['page_title']      = "Edit ".str_singular($this->module_title);
        $this->arr_view_data['module_title']    = str_plural($this->module_title);
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['theme_color']     = $this->theme_color;

        return view($this->module_view_folder.'.edit',$this->arr_view_data);    
    }

    public function update(Request $request, $enc_id)
    {
        $id = base64_decode($enc_id);

        $arr_rules = array();
        $arr_rules['country_name_en']   = "required";
        $arr_rules['country_code']      = "required";
        $arr_rules['phone_code']        = "required";
      
        $validator = Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $form_data = array();
        $form_data = $request->all();  

        /* Retrieve Existing Model*/
        $entity = $this->BaseModel->where('id',$id)->first();
        if(!$entity)
        {
            Flash::error('Problem Occured While Retriving '.str_singular($this->module_title));
            return redirect()->back();  
        }

        /* Check if category already exists with given translation */
        $does_exists = $this->BaseModel
                            ->where('id','<>',$id)
                            ->where('country_name',$request->input('country_name_en'))
                            ->whereHas('translations',function($query) use($request)
                                        {
                                            $query->where('locale','en')
                                                  ->where('country_name',$request->input('country_name_en'));      
                                        })
                            ->count()>0;   
        if($does_exists)
        {
            Flash::error(str_singular($this->module_title).' Name Already Exists');
            return redirect()->back();
        }
        
        $code_exists = $this->country_code_duplication($request->input('country_code'), $id);

        if($code_exists == true)
        {
            Flash::error(str_singular($this->module_title).' Code Already Exists.');
            return redirect()->back();
        }

        $phone_code_exists = $this->phone_code_duplication($request->input('phone_code'), $id);

        if($phone_code_exists == true)
        {
            Flash::error(str_singular($this->module_title).' Phone Code Already Exists.');
            return redirect()->back();
        }

        $cloned_entity = clone $entity ;
        
        /* Update Country */   
        $arr_data = [];     
        $arr_data['country_code']   = $request->input('country_code');
        $arr_data['phone_code']     = $request->input('phone_code');
        $arr_data['country_name']   = $request->input('country_name_en');

        $cloned_entity->update($arr_data);

        // Insert Multi Lang Fields 

        $arr_lang = $this->LanguageService->get_all_language();  

        if(sizeof($arr_lang) > 0)
        { 
            foreach($arr_lang as $i => $lang)
            {
                $country_name = $request->input('country_name_'.$lang['locale']);
                if(isset($country_name) && $country_name!="")
                {
                     // Get Existing Language Entry 
                    $translation = $entity->getTranslation($lang['locale']);    
                    if($translation)
                    {
                        $translation->country_name =  $country_name;
                        $translation->save();    
                    }  
                    else
                    {
                         //Create New Language Entry  
                        $translation = $entity->getNewTranslation($lang['locale']);
                        $translation->country_id =  $id;
                        $translation->country_name =  $request->input('country_name_'.$lang['locale']);
                        $translation->save();
                    } 
                }   
            } 


        }

        Flash::success(str_singular($this->module_title).' Updated Successfully');
        return redirect()->back(); 
    }

    public function multi_action(Request $request)
    {
        $arr_rules = array();
        $arr_rules['multi_action'] = "required";
        $arr_rules['checked_record'] = "required";


        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $multi_action = $request->input('multi_action');
        $checked_record = $request->input('checked_record');

        /* Check if array is supplied*/
        if(is_array($checked_record) && sizeof($checked_record)<=0)
        {
            Session::flash('error','Problem Occured, While Doing Multi Action');
            return redirect()->back();

        }

        
        foreach ($checked_record as $key => $record_id) 
        {  
            if($multi_action=="delete")
            {
               $this->perform_delete(base64_decode($record_id));    
               Flash::success(str_plural($this->module_title).' Deleted Successfully'); 
            } 
            elseif($multi_action=="activate")
            {
               $this->perform_activate(base64_decode($record_id)); 
               Flash::success(str_plural($this->module_title).' Activated Successfully'); 
            }
            elseif($multi_action=="deactivate")
            {
               $this->perform_deactivate(base64_decode($record_id));    
               Flash::success(str_plural($this->module_title).' Blocked Successfully');  
            }
        }

        return redirect()->back();
    }

   

    public function arrange_locale_wise(array $arr_data)
    {
        if(sizeof($arr_data)>0)
        {
            foreach ($arr_data as $key => $data) 
            {
                $arr_tmp = $data;
                unset($arr_data[$key]);

                $arr_data[$data['locale']] = $data;                    
            }

            return $arr_data;
        }
        else
        {
            return [];
        }
    }
    
    /*
    | Function checks country code duplication.
    | return boolean
    */
    public function country_code_duplication($country_code,$id=false)
    {
        $is_exists = $this->BaseModel->where('country_code','=',$country_code);

        if($id != false)
        {
            $is_exists = $is_exists->where('id','<>',$id);
        }

        $is_exists = $is_exists->count();

        if($is_exists > 0)
        {
            return true;
        }
        return false;
    }

    /*
    | Function checks country phone code duplication.
    | return boolean
    */
    public function phone_code_duplication($phone_code,$id=false)
    {
        $is_exists = $this->BaseModel->where('phone_code','=',$phone_code);

        if($id != false)
        {
            $is_exists = $is_exists->where('id','<>',$id);
        }

        $is_exists = $is_exists->count();

        if($is_exists > 0)
        {
            return true;
        }
        return false;
    }

}
