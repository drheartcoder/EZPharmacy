<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Common\Traits\MultiActionTrait;
use App\Models\ColorModel; 
use App\Common\Services\LanguageService; 

use App\Models\NewsModel;  
use Validator;
use Session;
use Flash;
use DB;
use Image;
class NewsController extends Controller
{
    
    use MultiActionTrait;

    public function __construct(
                                    NewsModel $news,
                                    ColorModel $color,
                                    LanguageService $langauge
                                )
    {

       $this->module_title         = "News";
       $this->module_url_slug      = "News";
       $this->module_url_path      = url(config('app.project.admin_panel_slug')."/news/");
       $this->module_view_folder   = 'admin.news';

       $this->NewsModel  = $news;
       $this->BaseModel          = $this->NewsModel;
       $this->LanguageService    = $langauge;     
       $this->module_icon        = "fa-sitemap";
     
    }
    public function index()
    {
       $arr_news = [];
    
        $obj_news = $this->BaseModel->get();

        if(count($obj_news) > 0)
        {
            $arr_news = $obj_news->toArray();       
        }

        $this->arr_view_data['page_title']        = "Manage ".str_plural($this->module_title);
        $this->arr_view_data['module_title']      = $this->module_title;
        $this->arr_view_data['module_url_path']   = $this->module_url_path;
        $this->arr_view_data['arr_data']          = $arr_news;
        $this->arr_view_data['module_icon']     = $this->module_icon;
        return view($this->module_view_folder.'.index',$this->arr_view_data);
    }
    public function create()
    {
        $arr_lang  = $this->LanguageService->get_all_language();

        $this->arr_view_data['page_title']      = "Create ".$this->module_title;
        $this->arr_view_data['arr_lang']        = $arr_lang;
        $this->arr_view_data['module_title']    = $this->module_title;
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['module_icon']     = $this->module_icon;
        return view($this->module_view_folder.'.create',$this->arr_view_data);
    }
    public function store(Request $request)
    {
    	$arr_rules['title_en']       = "required";
    	$arr_rules['description_en'] = "required";
    	$arr_rules['image']          = "required";
        
        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {
             return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $arr_data              = array();
        
       
        /* Fetch All Languages*/
        $arr_lang  = $this->LanguageService->get_all_language();

        DB::beginTransaction();

        if($request->hasFile('image'))
        {
        	$file_name = $request->input('image');
            $file_extension = strtolower($request->file('image')->getClientOriginalExtension());
            if(in_array($file_extension,['png','jpg','jpeg','gif']))
            {
                    $file_name = time().uniqid().'.'.$file_extension;
                    $isUpload = $request->file('image')->move('uploads/news/', $file_name);
                    if($isUpload)
                    {
                        $res= $this->attachmentThumb(file_get_contents('uploads/news/'.$file_name), $file_name, 370, 287);
                    }
                    

                   
            }
            else
            {
                Flash::error('Invalid File type, While creating '.str_singular($this->module_title));
                return redirect()->back();
            }
        }

        $arr_data['image']=$file_name;
        $arr_data['is_active'] = 1;

        $obj_data    = $this->BaseModel->create($arr_data);

        if($obj_data == true && count($arr_lang) > 0)
        {
            $trans_added =  true;

            $id = $obj_data->id;

            foreach ($arr_lang as $lang) 
            {      
                if($lang['locale']=='en')
                {
                	$arr_data     = array();
	                $title   = 'title_'.$lang['locale'];
	                $description   = 'description_'.$lang['locale'];

	                if( $request->input($title) != '' && $request->input($description) != '' )
	                { 
	                    $translation = $obj_data->translateOrNew($lang['locale']);

	                    $translation->title = $request->input($title);

	                    $translation->description = $request->input($description);
	                    $translation->news_id  = $id;

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

        $obj_news = $this->BaseModel->where('id', $id)->with(['translations'])->first();

        $arr_data = [];

        if($obj_news)
        {
           $arr_data = $obj_news->toArray(); 
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

        $arr_rules['title_en']       = "required";
        $arr_rules['description_en'] = "required";
       
        
        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $form_data = array();
        $form_data = $request->all(); 

         /* Get All Active Languages */ 
        $arr_lang  = $this->LanguageService->get_all_language();

        $oldImage=$request->input('oldimage');

        if($request->hasFile('image'))
        {
        	$file_name = $request->input('image');
            $file_extension = strtolower($request->file('image')->getClientOriginalExtension());
            if(in_array($file_extension,['png','jpg','jpeg','gif']))
            {
                    $file_name = time().uniqid().'.'.$file_extension;
                    $isUpload = $request->file('image')->move('uploads/news/', $file_name);
                    if($isUpload)
                    {
                        @unlink('uploads/news/'.$oldImage);
                        @unlink('uploads/news/thumb_370X287_'.$oldImage);

                        $res= $this->attachmentThumb(file_get_contents('uploads/news/'.$file_name), $file_name, 370, 287);
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

        $arr_data['image']=$file_name;

        $updateArr = array(
                            'image'       => $file_name,
                            );
        $this->BaseModel->where('id',$id)->update($updateArr);

        $obj_news = $this->BaseModel->where('id',$id)->first();

         /* Insert Multi Lang Fields */

        if(sizeof($arr_lang) > 0 && ($obj_news == true) )
        {
            foreach($arr_lang as $i => $lang)
            {
                $title   = 'title_'.$lang['locale'];
                $description   = 'description_'.$lang['locale'];

                if($request->input($title)!="" && $request->input($description))
                {
                    /* Get Existing Language Entry and update it */
                    $translation = $obj_news->getTranslation($lang['locale']);    
                    if($translation)
                    {
                       	$translation->title       =  ucfirst($request->input($title));
                       	$translation->description =  $request->input($description);
                        $status = $translation->save();
                    }  
                    else
                    {
                        /* Create New Language Entry  */
                        $translation     = $obj_news->getNewTranslation($lang['locale']);
                        $translation->news_id   =  $id;
                        $translation->title =   ucfirst($request->input($title));
                        $translation->description =  $request->input($description);
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

    public function attachmentThumb($input, $name, $width, $height)
    {
        $thumb_img = Image::make($input)->resize($width,$height);
        $thumb_img->fit($width,$height, function ($constraint) {
            $constraint->upsize();
        });
        $thumb_img->save('uploads/news/thumb_'.$width.'X'.$height.'_'.$name);

         
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
}
