<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

/*use App\Models\CountryModel;
use App\Models\CountryTranslationModel;
use App\Models\StateModel; 
use App\Models\StateTranslationModel;*/

use Validator;
use Session;

/*use App\Common\Services\LanguageService;*/
use App\Common\Traits\MultiActionTrait;

use Flash;
use DB;
use Datatables;

class StateController extends Controller
{   
    use MultiActionTrait;

    public function __construct()
    {
        /*$this->CountryModel            = $countries;
        $this->StateModel              = $state;
        $this->LanguageService         = $langauge;
        $this->CountryTranslationModel = $country_translation;
        $this->StateTranslationModel   = $state_translation;
        $this->BaseModel               = $this->StateModel;*/

        $this->arr_view_data      = [];
        $this->module_url_path    = url(config('app.project.admin_panel_slug')."/states");
        $this->module_title       = "State";
        $this->module_view_folder = "admin.states";
        $this->module_icon        = "fa-globe";
        $this->theme_color        = theme_color();
    } 
    
    public function index()
    {
        $query = DB::table('state AS tbl_STATE');
        $query->select('tbl_STATE.*','tbl_COUNTRY.country_name');
        $query->leftJoin('countries AS tbl_COUNTRY','tbl_COUNTRY.id','=','tbl_STATE.country_id');
        $query->orderBy('tbl_STATE.state_title', 'ASC');
        $arr_data = $query->paginate(50);

        $this->arr_view_data['page_title']      = "Manage ".str_plural($this->module_title);
        $this->arr_view_data['module_title']    = str_plural($this->module_title);
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['arr_data']        = $arr_data;
        $this->arr_view_data['theme_color']     = $this->theme_color;
        $this->arr_view_data['module_icon']     = $this->module_icon;
        return view($this->module_view_folder.'.index', $this->arr_view_data);
    }

    public function show($enc_id)
    {
        $id = base64_decode($enc_id);

        $arr_data = array();
        $obj_data = $this->BaseModel->where('id',$id)->with(['country_details'])->first();
       
        if($obj_data)
        {
            $arr_data = $obj_data->toArray();
        }

        $this->arr_view_data['arr_data']        = $arr_data;
        $this->arr_view_data['page_title']      = "Show ".str_singular($this->module_title);
        $this->arr_view_data['module_title']    = str_plural($this->module_title);
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['module_icon']     = $this->module_icon;
        $this->arr_view_data['theme_color']     = $this->theme_color;

        return view($this->module_view_folder.'.show', $this->arr_view_data);
    }   

    public function check_exists($value = false , $country_id =  false , $id = false)
    {
        if($value != false && $country_id != false && $country_id != "" ) {

            $does_exists = $this->BaseModel->whereHas('translations',function($query) use($value)
                                         {
                                              $query->where('locale', 'en')
                                                    ->where('state_title',trim($value));
                                         })
                                        ->where('country_id',$country_id);

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

    public function create()
    {
        $arr_default = [];
        $arr_country = $this->fetch_active_countries();

        $this->arr_view_data['arr_country']     = $this->build_select_options_array($arr_country,'id','country_name',$arr_default);
        $this->arr_view_data['arr_lang']        = $this->LanguageService->get_all_language();
        $this->arr_view_data['page_title']      = "Create ".str_singular($this->module_title);
        $this->arr_view_data['module_title']    = str_plural($this->module_title);
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['module_icon']     = $this->module_icon;
        $this->arr_view_data['theme_color']     = $this->theme_color;
        return view($this->module_view_folder.'.create', $this->arr_view_data);
    }

    public function store(Request $request)
    {  
        $arr_rules['state_title_en'] = "required";
        $arr_rules['country_id']     = "required";
        
        $validator = Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
    
        $does_exists = $this->check_exists($request->input('state_title_en') , $request->input('country_id'));
        
        if($does_exists == false)
        {
            Flash::error(str_singular($this->module_title).' Already Exists.');
            return redirect()->back()->withInput($request->all());
        }

        //$arr_data['public_key'] = str_random(7);

        $arr_data['country_id'] = $request->input('country_id');        
        // Insert Into State Table
        $entity = $this->BaseModel->create($arr_data);

        if($entity)
        {
            /*-------------------------------------------------------
            |   Activity log Event
            --------------------------------------------------------*/
                /*$arr_event                 = [];
                $arr_event['ACTION']       = 'ADD';
                $arr_event['MODULE_TITLE'] = $this->module_title;

                $this->save_activity($arr_event);*/

            /*----------------------------------------------------------------------*/
            $arr_lang =  $this->LanguageService->get_all_language();
            
            if(sizeof($arr_lang) > 0 )
            {
                foreach ($arr_lang as $lang) 
                {

                    $state_title = $request->input('state_title_'.$lang['locale']);

                    if( isset($state_title) && $state_title != "")
                    { 
                        $translation = $entity->translateOrNew($lang['locale']);
                        $translation->state_id     = $entity->id;
                        $translation->state_title  = ucfirst($state_title);
                        // $translation->state_slug   = str_slug($state_title, "-");
                        $translation->save();

                        Flash::success(str_singular($this->module_title).' Created Successfully');
                    }

                }//foreach

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

    public function fetch_active_countries()
    {
        $arr_country = [];
        $obj_country = $this->CountryModel->where('is_active',1)->get();
       
        if( $obj_country != false)
        {
            $arr_country = $obj_country->toArray();
        }
        return $arr_country;
    }

    public function edit($enc_id)
    {
        $id = base64_decode($enc_id);

        $arr_default = array();

        $obj_data = $this->BaseModel
                          ->where('id',$id)
                          ->with(['country_details','translations'])
                          ->first();

        $arr_data = [];
        
        if($obj_data)
        {
           $arr_data = $obj_data->toArray(); 
           /* Arrange Locale Wise */
           $arr_data['translations'] = $this->arrange_locale_wise($arr_data['translations']);
        }

        $arr_country = $this->fetch_active_countries();
        
        $arr_default = array();
        $this->arr_view_data['arr_country'] = $this->build_select_options_array($arr_country,'id','country_name',$arr_default);

        $this->arr_view_data['edit_mode'] = TRUE;
        $this->arr_view_data['enc_id']    = $enc_id;
        $this->arr_view_data['arr_lang']  = $this->LanguageService->get_all_language();   
        
        $this->arr_view_data['arr_data']        = $arr_data;
        $this->arr_view_data['page_title']      = "Edit ".str_singular($this->module_title);
        $this->arr_view_data['module_title']    = str_plural($this->module_title);
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['theme_color']     = $this->theme_color;
        $this->arr_view_data['module_icon']     = $this->module_icon;

        return view($this->module_view_folder.'.edit', $this->arr_view_data);    
    }

    public function update(Request $request, $enc_id)
    {
        $id = base64_decode($enc_id);
        $arr_rules = array();
        $arr_rules['state_title_en'] = "required";
        $arr_rules['country_id']     = "required";
        

        $validator = Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $form_data = array();
        $form_data = $request->all(); 

        $arr_data['country_id'] = $request->input('country_id');   
  
        $entity = $this->BaseModel->where('id',$id)->first();
        if(!$entity)
        {
            Flash::error('Problem Occured While Retriving '.str_singular($this->module_title));
            return redirect()->back();   
        }
        
        $does_exists = $this->check_exists($request->input('state_title_en') , $request->input('country_id') , $id);
        
        if($does_exists == false)
        {
            Flash::error(str_singular($this->module_title).' Already Exists.');
            return redirect()->back()->withInput($request->all());
        }

        $cloned_entity = clone $entity ;

        /* Update State */   
        $arr_data = [];     
        //$arr_data['state_title'] = ucfirst($request->input('state_title_en'));
        $arr_data['country_id']  = $request->input('country_id');

        $cloned_entity->update($arr_data);

        /*-------------------------------------------------------
        |   Activity log Event
        --------------------------------------------------------*/
            /*$arr_event                 = [];
            $arr_event['ACTION']       = 'EDIT';
            $arr_event['MODULE_TITLE'] = $this->module_title;

            $this->save_activity($arr_event);*/

        /*----------------------------------------------------------------------*/

        $arr_lang =  $this->LanguageService->get_all_language();

        if(sizeof($arr_lang) > 0)
        {
            foreach($arr_lang as $i => $lang)
            {
                $state_title = $request->input('state_title_'.$lang['locale']);

                if( isset($state_title) && $state_title!="")
                {
                    /* Get Existing Language Entry */
                    $translation = $entity->getTranslation($lang['locale']);    
                    if($translation)
                    {
                        $translation->state_title = ucfirst($state_title);
                        //$translation->state_slug  = str_slug($request->input('state_title_'.$lang['locale']), "-");
                        $translation->save();
                    }  
                    else
                    {
                        /* Create New Language Entry  */
                        $translation = $entity->getNewTranslation($lang['locale']);
                        
                        $translation->state_id =  $id;
                        $translation->state_title =  ucfirst($state_title);
                        // $translation->state_slug =  str_slug($request->input('state_title_'.$lang['locale']), "-");
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

    public function load_table_data(Request $request)
    {
        $obj_user        = $this->get_table_details($request);

        $current_context = $this;
      
        $json_result     = Datatables::of($obj_user);
        
        $json_result     = $json_result->blacklist(['id']);
        
        $json_result     = $json_result->editColumn('enc_id',function($data) use ($current_context)
                            {
                                return base64_encode($data->id);
                            })
                            ->editColumn('build_status_btn',function($data) use ($current_context)
                            {       
                                $build_status_btn = "";

                                if(isset($data->is_active) && $data->is_active == 0)
                                {      
                                    $build_status_btn = '<a class="btn btn-danger btn-sm show-tooltip" title="Lock" btn-sm show-tooltip call_loader" href="'.$this->module_url_path.'/activate/'.base64_encode($data->id).'"
                                        onclick="return confirm_action(this,event,\'Do you really want to Activate this record ?\')" ><i class="fa fa-lock"></i></a>';
                                }
                                elseif(isset($data->is_active) && $data->is_active == 1)
                                {
                                    $build_status_btn = '<a class="btn btn-success btn-sm show-tooltip" title="Unlock" btn-sm show-tooltip call_loader" href="'.$this->module_url_path.'/deactivate/'.base64_encode($data->id).'" 
                                        onclick="return confirm_action(this,event,\'Do you really want to Deactivate this record ?\')" ><i class="fa fa-unlock"></i></a>';
                                }
                                return $build_status_btn;
                            })    
                            ->editColumn('build_action_btn',function($data) use ($current_context)
                            {   
                                $edit_href =  $this->module_url_path.'/edit/'.base64_encode($data->id);
                                $build_edit_action = '<a class="btn btn-primary btn-sm show-tooltip call_loader" href="'.$edit_href.'" title="Edit"><i class="fa fa-edit" ></i></a>';
                                
                                $delete_href =  $this->module_url_path.'/delete/'.base64_encode($data->id);
                                $confirm_delete =  'onclick="return confirm_action(this,event,\'Do you really want to delete this record ?\')"';

                                $build_delete_action = '<a class="btn btn-danger btn-sm show-tooltip call_loader" '.$confirm_delete.' href="'.$delete_href.'" title="Delete"><i class="fa fa-trash" ></i></a>';

                                return $build_action = $build_edit_action.' '.$build_delete_action;
                            })
                            ->make(true);

        $build_result = $json_result->getData();

        return response()->json($build_result);
    }

    public function get_locale()
    {
        $locale = \App::getLocale();
        if($locale == "") {
            $locale = 'en';
        } 
        return $locale;
    }

    public function get_table_details(Request $request)
    {   
        $locale = $this->get_locale();

        $state_table              = $this->StateModel->getTable();
       
        $prefixed_state_table     = DB::getTablePrefix().$this->StateModel->getTable();

        $state_translation_table             = $this->StateTranslationModel->getTable();
        $prefixed_state_translation_table    = DB::getTablePrefix().$this->StateTranslationModel->getTable();

        $country_table            = $this->CountryModel->getTable();
        $prefixed_country_table   = DB::getTablePrefix().$this->CountryModel->getTable();

        $country_translation_table             = $this->CountryTranslationModel->getTable();
        $prefixed_country_translation_table    = DB::getTablePrefix().$this->CountryTranslationModel->getTable();

        $obj_entity = DB::table($state_table)
                                  ->select(DB::raw( 
                                                    $prefixed_state_table.".id as id,".
                                                    $prefixed_state_translation_table.".state_title, ".
                                                    $prefixed_country_table.".id as country_id ,".
                                                    $prefixed_state_table.".is_active as is_active, ".
                                                    $prefixed_country_translation_table.".country_name as country_name "
                                                ))
                                ->Join($state_translation_table, $state_translation_table.'.state_id', '=' ,$state_table.'.id')
                                ->Join($country_table, $country_table.'.id', '=' ,$state_table.'.country_id')
                                ->Join($country_translation_table, $country_translation_table.'.country_id', '=' ,$country_table.'.id')
                                ->where($state_translation_table.'.locale' ,$locale) 
                                ->orderBy($state_table.'.created_at','DESC');

        /* ---------------- Filtering Logic ----------------------------------*/                    

        $arr_search_column = $request->input('column_filter');
        
        if(isset($arr_search_column['q_state_name']) && $arr_search_column['q_state_name']!="")
        {
            $search_term      = $arr_search_column['q_state_name'];

            $obj_entity = $obj_entity->where($state_translation_table.'.state_title','LIKE', '%'.$search_term.'%');
        }

        if(isset($arr_search_column['q_country_name']) && $arr_search_column['q_country_name']!="")
        {
            $search_term      = $arr_search_column['q_country_name'];
            $obj_entity = $obj_entity->where($country_translation_table.'.country_name','LIKE', '%'.$search_term.'%');
        }

        return $obj_entity;
    }

}
