<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Common\Services\LanguageService;  
use App\Models\DocumentTypeModel;  
use App\Models\ColorModel;  

use App\Common\Traits\MultiActionTrait;

use Validator;
use Session;
use Sentinel;
use Flash;
use Excel;
use DB;
use Image;

class DocumentTypeController extends Controller
{
    use MultiActionTrait;

    public function __construct(
                                    DocumentTypeModel $document_type,
                                    ColorModel $color,
                                    LanguageService $langauge
                                )
    {      
       $this->DocumentTypeModel  = $document_type;
       $this->BaseModel          = $this->DocumentTypeModel;
       $this->LanguageService    = $langauge;
       $this->module_title       = "Document Type";
       $this->module_icon        = "fa-tasks";
       $this->module_view_folder = "admin.document_type";
       $this->module_url_path    = url(config('app.project.admin_panel_slug')."/document_type");

    }

	public function index()
    {
        $arr_document_type = [];
    
        $obj_document_type = $this->BaseModel->orderBy('id','DESC')->get();


        if(count($obj_document_type) > 0)
        {
            $arr_document_type = $obj_document_type->toArray();       
        }
        

        $this->arr_view_data['page_title']        = "Manage ".str_plural($this->module_title);
        $this->arr_view_data['module_title']      = $this->module_title;
        $this->arr_view_data['module_icon']       = $this->module_icon;
        $this->arr_view_data['module_url_path']   = $this->module_url_path;
        $this->arr_view_data['arr_data']          = $arr_document_type;

        return view($this->module_view_folder.'.index',$this->arr_view_data);
    }

    public function create()
    {
        $arr_lang  = $this->LanguageService->get_all_language();

        $this->arr_view_data['page_title']      = "Create ".$this->module_title;
        $this->arr_view_data['arr_lang']        = $arr_lang;
        $this->arr_view_data['module_icon']      = $this->module_icon;
        $this->arr_view_data['module_title']    = $this->module_title;
        $this->arr_view_data['module_url_path'] = $this->module_url_path;

        return view($this->module_view_folder.'.create',$this->arr_view_data);
    }


    public function check_exists($value = false , $id =  false)
    {
        if($value != false) {

            $does_exists = $this->BaseModel->whereHas('translations',function($query) use($value)
                                         {
                                              $query->where('locale', 'en')
                                                    ->where('type_name',trim($value));
                                         });

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


    public function store(Request $request)
    {   
        $arr_rules['name_en'] = "required";
        //$arr_rules['image']   = "required";
        $arr_rules['desc_en']= "required";
        $file_name = '';
        
        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {
             return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
    
        $does_exists = $this->check_exists($request->input('name_en'));
        
        if($does_exists == false )
        {
            Flash::error(str_singular($this->module_title) .' already exists.');        
            return redirect()->back();
        }


        if($request->hasFile('image'))
        {
            $file_name = $request->input('image');
           
            $file_extension = strtolower($request->file('image')->getClientOriginalExtension());
            if(in_array($file_extension,['png','jpg','jpeg','gif']))
            {
                    $file_name = time().uniqid().'.'.$file_extension;
                    $isUpload = $request->file('image')->move('uploads/document_type/', $file_name);
                    if($isUpload)
                    {
                        $res= $this->attachmentThumb(file_get_contents('uploads/document_type/'.$file_name), $file_name, 255, 179);

                        $res1= $this->attachmentThumb(file_get_contents('uploads/document_type/'.$file_name), $file_name, 150, 145);
                    }
            }
            else
            {
                Flash::error('Invalid File type, While creating '.str_singular($this->module_title));
                return redirect()->back();
            }
        }
        //dd($file_name);
        $arr_data               = array();
        $arr_data['image']      = $file_name;
        $arr_data['is_active']  = 1;

        /* Fetch All Languages*/
        $arr_lang  = $this->LanguageService->get_all_language();

        DB::beginTransaction();

        $obj_data    = $this->BaseModel->create($arr_data);

        if($obj_data == true && count($arr_lang) > 0)
        {
            $trans_added =  true;
            
            $id = $obj_data->id;

            foreach ($arr_lang as $lang) 
            {            
                $arr_data     = array();
                $name   = 'name_'.$lang['locale'];
                $desc   = 'desc_'.$lang['locale'];

                
                // only english keyword is save at the time of storing.
                if($lang['locale'] == 'en')
                {
                    if( $request->input($name) != "" )
                    { 
                        $translation = $obj_data->translateOrNew($lang['locale']);

                        $translation->type_name = ucfirst($request->input($name));
                        $translation->type_desc = $request->input($desc);
                        $translation->type_id  = $id;
                        $obj_trans = $translation->save();

                        if($obj_trans == false)
                        {
                            $trans_added = false; 
                        }

                        /*-------------------------------------------------------
                        |   Activity log Event
                        --------------------------------------------------------*/
                            /*$arr_event                 = [];
                            $arr_event['ACTION']       = 'ADD';
                            $arr_event['MODULE_TITLE'] = $this->module_title;

                            $this->save_activity($arr_event);*/
                        /*----------------------------------------------------------------------*/
                    }
                }
            }//foreach

            if($trans_added == true)
            {
                DB::commit();
                Flash::success(str_singular($this->module_title).' Created Successfully');
                return redirect()->back();
            }
        }

        DB::rollback();
        Flash::error('Problem Occured, While Creating '.str_singular($this->module_title));  
        return redirect()->back();
    }


    public function edit($enc_id)
    {
        $id = base64_decode($enc_id);

        $arr_lang = $this->LanguageService->get_all_language();      

        $obj_skill = $this->BaseModel->where('id', $id)->with(['translations'])->first();

        $arr_data = [];

        if($obj_skill)
        {
           $arr_data = $obj_skill->toArray(); 
           /* Arrange Locale Wise */
           $arr_data['translations'] = $this->arrange_locale_wise($arr_data['translations']);
        }


        //dd($arr_data);

        $this->arr_view_data['edit_mode']       = true;
        $this->arr_view_data['enc_id']          = $enc_id;
        $this->arr_view_data['arr_lang']        = $this->LanguageService->get_all_language();
        $this->arr_view_data['arr_data']        = $arr_data;
        $this->arr_view_data['page_title']      = "Edit ".$this->module_title;
        $this->arr_view_data['module_title']    = $this->module_title;
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['module_icon']     = $this->module_icon;

        return view($this->module_view_folder.'.edit',$this->arr_view_data);
    }

    public function update(Request $request)
    {
   
        $id                         = base64_decode($request->input('enc_id'));
        $arr_rules                  = array();
        $status                     = FALSE;
        $arr_rules['name_en'] = "required";
        $arr_rules['desc_en'] = "required";
        
        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        $does_exists = $this->check_exists($request->input('name_en') , $id);
        
        if($does_exists == false )
        {
            Flash::error(str_singular($this->module_title) .' already exists.');        
            return redirect()->back();
        }

        $form_data = array();
        $form_data = $request->all(); 

         /* Get All Active Languages */ 
        $arr_lang = $this->LanguageService->get_all_language();

        $oldImage=$request->input('oldimage');

        if($request->hasFile('image'))
        {
            $file_name = $request->input('image');
            $file_extension = strtolower($request->file('image')->getClientOriginalExtension());
            if(in_array($file_extension,['png','jpg','jpeg','gif']))
            {
                    $file_name = time().uniqid().'.'.$file_extension;
                    $isUpload = $request->file('image')->move('uploads/document_type/', $file_name);
                    if($isUpload)
                    {
                        @unlink('uploads/document_type/'.$oldImage);
                        @unlink('uploads/document_type/thumb_255X179_'.$oldImage);
                        @unlink('uploads/document_type/thumb_150X145_'.$oldImage);

                        $res= $this->attachmentThumb(file_get_contents('uploads/document_type/'.$file_name), $file_name, 255, 179);
                        
                        $res1= $this->attachmentThumb(file_get_contents('uploads/document_type/'.$file_name), $file_name, 150, 145);
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

        $updateArr = array(
                            'image'       => $file_name,
                            );
        $this->BaseModel->where('id',$id)->update($updateArr);

        $obj_skill = $this->BaseModel->where('id',$id)->first();

         /* Insert Multi Lang Fields */

        if(sizeof($arr_lang) > 0 && ($obj_skill == true) )
        {
            foreach($arr_lang as $i => $lang)
            {
                $name   = 'name_'.$lang['locale'];
                $desc   = 'desc_'.$lang['locale'];

                if(isset($form_data[$name]) || isset($form_data[$desc]) )
                {
                    /* Get Existing Language Entry and update it */
                    $translation = $obj_skill->getTranslation($lang['locale']);    
                    if($translation)
                    {
                        $translation->type_name       =  ucfirst( $request->input($name));
                       	$translation->type_desc       =   $request->input($desc);
                        $status = $translation->save();
                    }  
                    else
                    {
                        /* Create New Language Entry  */
                        $translation     = $obj_skill->getNewTranslation($lang['locale']);
                        $translation->type_id   =  $id;
                        $translation->type_name =  ucfirst($request->input($name));
                        $translation->type_desc       =   $request->input($desc);
                        $status = $translation->save();
                    } 
                }   
            }
        }

        if ($status) 
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
     public function attachmentThumb($input, $name, $width, $height)
    {
        $thumb_img = Image::make($input)->resize($width,$height);
        $thumb_img->fit($width,$height, function ($constraint) {
            $constraint->upsize();
        });
        $thumb_img->save('uploads/document_type/thumb_'.$width.'X'.$height.'_'.$name);
    }
    // public function delete($enc_id = FALSE)
    // {
    //     if(!$enc_id)
    //     {
    //         return redirect()->back();
    //     }

    //     if($this->perform_delete(base64_decode($enc_id)))
    //     {
    //         Flash::success(str_singular($this->module_title).' Deleted Successfully');
    //     }
    //     else
    //     {
    //         Flash::error('Problem Occurred While Deleting '.str_singular($this->module_title));
    //     }

    //     return redirect()->back();
    // }
    //  public function perform_delete($id)
    // {

    //     $document_type_delete = $this->BaseModel->where('id',$id)    
    //                                 ->first();
    //     if($document_type_delete)
    //     {
    //         return $document_type_delete->delete();
    //     }

    //     return false;
    // }


}
