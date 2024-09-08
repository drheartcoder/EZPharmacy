<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\MasterModel;
use Illuminate\Http\Request;

use Session;
use Validator;
use DB;
use Flash;

use App\Common\Traits\MultiActionTrait;
use App\Common\Services\LanguageService;

class SpecialityController extends Controller
{

    use MultiActionTrait;

    public function __construct(MasterModel $MasterModel, LanguageService $LanguageService)
    {
        DB::enableQueryLog();
        $this->arr_view_data      = [];
        $this->module_url_path    = url(config('app.project.admin_panel_slug')."/speciality");
        $this->module_title       = "Speciality";
        $this->module_url_slug    = "speciality";
        $this->module_icon        = "fa-stethoscope";
        $this->module_view_folder = "admin.speciality";
        $this->theme_color        = theme_color();
        $this->LanguageService    = $LanguageService;
    }
 
    public function index (Request $request)
    {
        $get_speciality_query = DB::table('speciality');
        $get_speciality_query->orderBy('speciality.name', 'ASC');
        $arr_speciality = $get_speciality_query->paginate(20);

        $this->arr_view_data['page_title']      = "Manage ".str_singular($this->module_title);
        $this->arr_view_data['module_title']    = str_plural($this->module_title);
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['arr_speciality']  = $arr_speciality;
        $this->arr_view_data['theme_color']     = $this->theme_color;
        $this->arr_view_data['module_icon']     = $this->module_icon;

        if($request->ajax()) {
            return view($this->module_view_folder.'.ajax.load-index',$this->arr_view_data)->render();
        }
        return view($this->module_view_folder.'.index', $this->arr_view_data);
    }

    public function show($enc_id)
    {
        $id = base64_decode($enc_id);
        $arr_data = array();

        $obj_data = $this->BaseModel->where('id',$id)->with(['country_details','state_details'])->first();
        if( $obj_data != FALSE)
        {
            $arr_data = $obj_data->toArray();
        }

        $this->arr_view_data['arr_data']        = $arr_data;
        $this->arr_view_data['page_title']      = "Show ".str_singular($this->module_title);
        $this->arr_view_data['module_title']    = str_plural($this->module_title);
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['theme_color']     = $this->theme_color;

        return view($this->module_view_folder.'.show', $this->arr_view_data);
    }

    public function create()
    {

        $this->arr_view_data['page_title']      = "Create ".str_singular($this->module_title);
        $this->arr_view_data['module_title']    = str_plural($this->module_title);
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['theme_color']     = $this->theme_color;

        return view($this->module_view_folder.'.create', $this->arr_view_data);
    }
  
    public function store(Request $request)
    {
        $form_data                   = array();
        $arr_rules['txt_speciality'] = "required";
         
        $validator = Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
 
        $form_data = $request->all();

        $arr_data['txt_speciality']   = $request->input('txt_speciality');

        $does_exists = DB::table('speciality')->where('name', $arr_data['txt_speciality'])->count();
        if($does_exists)
        {
            Flash::error(str_singular($this->module_title).' Already Exists.');
        }
        else
        {
            $dataValues = array(
                'name'  => $request->input('txt_speciality')
            );
            $create = DB::table('speciality')->insertGetId($dataValues);
            if($create)
            {
                Flash::success(str_singular($this->module_title).' Created Successfully');
            }
            else
            {
                Flash::error('Problem Occurred, While Creating '.str_singular($this->module_title));
            }
        }
        return redirect()->back();
    }

    public function edit($enc_id)
    {
        $id = base64_decode($enc_id);
        $arr_data = array();

        $obj_data = $this->BaseModel
                           ->where('id',$id)
                           ->with(['country_details','state_details','translations'])
                           ->first();

                            //$obj_data = $this->CountryModel->where('id', $id)->with(['translations'])->first();

        if($obj_data)
        {
           $arr_data = $obj_data->toArray();
           /* Arrange Locale Wise */
        $arr_data['translations'] = $this->arrange_locale_wise($arr_data['translations']);
        }
       
        $arr_lang =  $this->LanguageService->get_all_language();


        $this->arr_view_data['edit_mode']       = TRUE;
        $this->arr_view_data['enc_id']          = $enc_id;
        $this->arr_view_data['arr_lang']        = $this->LanguageService->get_all_language();
        $this->arr_view_data['arr_data']        = $arr_data;
        $this->arr_view_data['page_title']      = "Edit ".str_singular($this->module_title);
        $this->arr_view_data['module_title']    = str_plural($this->module_title);
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['module_icon'] = $this->module_icon;
        $this->arr_view_data['theme_color']     = $this->theme_color;
       // dd($arr_data);
        return view($this->module_view_folder.'.edit', $this->arr_view_data);    
    }

    public function update(Request $request, $enc_id)
    {
        $id = base64_decode($enc_id);
        $arr_rules = array();
        $arr_rules['city_title_en'] = "required";
        
         
        $validator = Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $form_data = array();
        $form_data = $request->all();    
        
        $arr_data = array();
  
        $entity = $this->BaseModel->where('id',$id)->first();

        if(!$entity)
        {
            Flash::error('Problem Occured While Retriving '.str_singular($this->module_title));
            return redirect()->back();   
        }

        /* Check if category already exists with given translation */
        $does_exists = $this->BaseModel
                            ->where('id','<>',$id)
                            ->where('city_title',$request->input('city_title_en'))
                            ->whereHas('translations',function($query) use($request)
                                        {
                                            $query->where('locale','en')
                                                  ->where('city_title',$request->input('city_title_en'));      
                                        })
                            ->count();   
        if($does_exists)
        {
            Flash::error(str_singular($this->module_title).' Already Exists');
            return redirect()->back();
        }

        /* Update Country */   
        
        $arr_data['city_title']   = $request->input('city_title_en');

        $obj_city = $this->BaseModel->where('id','=',$id)->update($arr_data);

        $arr_lang = $this->LanguageService->get_all_language();  
        if(sizeof($arr_lang) > 0)
        { 
            foreach($arr_lang as $i => $lang)
            {
                $city_title = $request->input('city_title_'.$lang['locale']);

                if( isset($city_title) && $city_title!="")
                {
                     //Get Existing Language Entry 
                    $translation = $entity->getTranslation($lang['locale']);    

                    if($translation)
                    {
                        $translation->city_title =  $city_title;
                        $translation->city_slug   = str_slug($city_title, "-");
                        $translation->save();    
                    }  
                    else
                    {
                       //  Create New Language Entry  
                        $translation = $entity->getNewTranslation($lang['locale']);
                        
                        $translation->city_id    =  $id;
                        $translation->city_title =  $city_title;
                        $translation->city_slug  =  str_slug($city_title, "-");
                        $translation->save();    
                    } 
                }   
            }
        }    

        Flash::success(str_singular($this->module_title).' Updated Successfully');
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


    public function build_select_options_array(array $arr_data,$option_key,$option_value,array $arr_default)
    {
        $arr_options = [];
        if(sizeof($arr_default)>0)
        {
            $arr_options =  $arr_default;   
        }

        if(sizeof($arr_data)>0)
        {
            foreach ($arr_data as $key => $data) 
            {
                if(isset($data[$option_key]) && isset($data[$option_value]))
                {
                    $arr_options[$data[$option_key]] = $data[$option_value];
                }
            }
        }
        return $arr_options;
    }
}
