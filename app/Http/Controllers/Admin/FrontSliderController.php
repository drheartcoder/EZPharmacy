<?php 
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\FrontSliderModel;  
use App\Events\ActivityLogEvent;
 
use App\Common\Services\LanguageService;  
use Validator;
use Session;
use Flash;
use Sentinel;
 
class FrontSliderController extends Controller
{

    public function __construct(
                                FrontSliderModel $front_slider,
                                LanguageService $langauge
                                )
    {
        $this->FrontSliderModel             = $front_slider;
        $this->LanguageService              = $langauge;
        $this->BaseModel                    = $this->FrontSliderModel;
        $this->arr_view_data                = [];
        $this->module_title                 = "Front Slider";
        $this->module_view_folder           = "admin.front_slider";
        $this->module_url_path              = url(config('app.project.admin_panel_slug')."/front_slider");
        $this->front_slider_base_img_path   = base_path().config('app.project.img_path.front_slider');
        $this->front_slider_public_img_path = url('/').config('app.project.img_path.front_slider');

        $this->theme_color                  = theme_color();
        $this->module_icon                  = "fa-youtube-play";
        $this->create_icon                  = "fa-plus-square-o";
        $this->edit_icon                    = "fa-edit";
        $this->view_icon                    = "fa-eye";
    }   
 
    public function index()
    {
        $arr_lang = array();
        $arr_data = array();
        $obj_data =  $this->BaseModel->get();

        if($obj_data != FALSE)
        {
            $arr_data = $obj_data->toArray();
        }


        $this->arr_view_data['arr_data']                     = $arr_data;
        $this->arr_view_data['module_title']                 = str_plural($this->module_title);
        $this->arr_view_data['module_url_path']              = $this->module_url_path;
        $this->arr_view_data['front_slider_public_img_path'] = $this->front_slider_public_img_path;
        $this->arr_view_data['page_title']                   = "Manage ".str_singular($this->module_title);
        $this->arr_view_data['module_icon']                  = $this->module_icon;

        return view($this->module_view_folder.'.index',$this->arr_view_data);
    }

    public function create()
    {
        $this->arr_view_data['arr_lang']        = $this->LanguageService->get_all_language();  

        $this->arr_view_data['page_title']      = "Create ".str_singular($this->module_title);;
        $this->arr_view_data['module_title']    = str_plural($this->module_title);
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['module_icon']     = $this->module_icon;
        $this->arr_view_data['create_icon']     = $this->create_icon;

        return view($this->module_view_folder.'.create',$this->arr_view_data);
    }

    public function store(Request $request)
    {  
        
        //$form_data             = array();
        $sort_order            = $this->get_max_order();
        $arr_rules['text1_en'] = "required";
        $arr_rules['text2_en'] = "required";
        $arr_rules['text3_en'] = "required";
        $arr_rules['image']    = "required|image";
        //$form_data             = $request->all();

        $validator                   = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {
            
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
    

        /* File uploading code starts here */

        if($request->hasFile('image'))///check image loaded/Not
        {
            $image_validation = Validator::make(array('file'=>$request->file('image')),
                                                array('file'=>'mimes:jpg,jpeg,png'));
            
            
            if($request->file('image')->isValid() && $image_validation->passes())
            {

                $maxHeight      = 640;//740
                $maxWidth       = 1920;//1600
                $arr_image_size = [];
                $arr_image_size = getimagesize($request->file('image'));

                if(isset($arr_image_size) && $arr_image_size==false)
                {
                    Flash::error('Please use valid image');
                    return redirect()->back(); 
                }

                /*-----------------------------------------------------------------
                    $arr_image_size[0] = width of image
                    $arr_image_size[1] = height of image
                -------------------------------------------------------------------*/

               if(($arr_image_size[0] != $maxWidth) && ($arr_image_size[1] != $maxHeight))
                {
                    Flash::error("Please upload Image having  demension is equal to 1920 x 640");
                    return redirect()->back();
                }   


                $image_path              = $request->file('image')->getClientOriginalName();
                $image_extention         = $request->file('image')->getClientOriginalExtension();
                $image_name              = sha1(uniqid().$image_path.uniqid()).'.'.$image_extention;
                $arr_data                = array();
                
                $arr_data['image']       = $image_name;
                $arr_data['public_key']  = str_random(7);
                $arr_data['order_index'] = intval($sort_order)+1;

                $duplication = $this->BaseModel->where('image','=',$arr_data['image'])->count();

                if($duplication>0)
                {
                    Flash::error("Image is already in use..!!");
                    return redirect()->back();
                }

                $slider_image            = $this->BaseModel->create($arr_data);
                $final_image             = $request->file('image')->move($this->front_slider_base_img_path, $image_name);

                if($slider_image)
                {

                           /*--------------------------------------
                                Below section is temporary hide
                            ---------------------------------------*/

                            $arr_lang =  $this->LanguageService->get_all_language();      
                 
                            /* insert record into translation table */
                            if(sizeof($arr_lang) > 0 )
                            {
                                foreach ($arr_lang as $lang) 
                                {            
                                    $arr_data   = array();
                                    $text1      = 'text1_'.$lang['locale'];
                                    $text2      = 'text2_'.$lang['locale'];
                                    $text3      = 'text3_'.$lang['locale'];
                                  
                                    if( $request->input($text1) !='' && $request->input($text2) != '' && $request->input($text3)!='')
                                    { 
                                        $translation = $slider_image->translateOrNew($lang['locale']);

                                        $translation->slider_id = $slider_image->id;
                                        $translation->text1     = $request->input($text1);
                                        $translation->text2     = $request->input($text2);
                                        $translation->text3     = $request->input($text3);
                                        $translation->save();

                                        Flash::success('Front Slider Created Successfully');
                                        return redirect()->back();
                                    }

                                }//foreach 

                            } //if
                            else
                            {
                                Flash::error('Problem Occurred, While Creating Front Slider');
                                return redirect()->back();
                            }  
                }
                else
                {
                    Flash::error("Error While Adding Slider Image");
                    return redirect()->back();
                }
                
            }
            else
            {
                Flash::error('File is not an Image File');
                return redirect()->back();
            }
        }    
        else
        {
            Flash::error('Slider Image Not Available');
            return redirect()->back();
        }
    }

   
    public function edit($enc_id)
    {
        $id         = base64_decode($enc_id);
        $arr_lang   = $this->LanguageService->get_all_language();
        $obj_slider = $this->BaseModel->where('id', $id)->with(['translations'])->first();
        $arr_slider = [];

        if($obj_slider)
        {
           $arr_slider = $obj_slider->toArray(); 
           /* Arrange Locale Wise */
           $arr_slider['translations']    = $this->arrange_locale_wise($arr_slider['translations']);
        }

        $this->arr_view_data['edit_mode']                    = TRUE;
        $this->arr_view_data['enc_id']                       = $enc_id;
        $this->arr_view_data['arr_lang']                     = $arr_lang;
        $this->arr_view_data['arr_slider']                   = $arr_slider;
        $this->arr_view_data['module_title']                 = str_plural($this->module_title);
        $this->arr_view_data['module_url_path']              = $this->module_url_path;
        $this->arr_view_data['front_slider_public_img_path'] = $this->front_slider_public_img_path;
        $this->arr_view_data['page_title']                   = "Edit ".str_singular($this->module_title);
        $this->arr_view_data['module_icon']                  = $this->module_icon;
        $this->arr_view_data['edit_icon']                    = $this->edit_icon;

        return view($this->module_view_folder.'.edit',$this->arr_view_data);   
    }


    public function update(Request $request, $enc_id)
    {

        $obj_data   = Sentinel::getUser();
        $first_name = $obj_data->first_name;
        $last_name  = $obj_data->last_name;

        $id                      = base64_decode($enc_id);
        $arr_rules               = array();
        
        $arr_rules['text1_en'] = "required";
        $arr_rules['text2_en'] = "required";
        $arr_rules['text3_en'] = "required";
        // $arr_rules['start_date'] = "required";
        // $arr_rules['end_date']   = "required";         
        $validator               = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {   
            return redirect()->back()->withErrors($validator)->withInput();
        }

         $arr_lang   = $this->LanguageService->get_all_language();  
        


        $arr_data               = array();
        // $arr_data['image']      = $final_image_upload;
        $slider_update          = $this->BaseModel->where('id',$id)->update($arr_data);

        
        $obj_skill = $this->BaseModel->where('id',$id)->first();
        
        /* Insert Multi Lang Fields */

        if(sizeof($arr_lang) > 0)
        { 
            foreach($arr_lang as $i => $lang)
            {
                $translate_data_ary = array();
                $text1  = 'text1_'.$lang['locale'];
                $text2  = 'text2_'.$lang['locale'];
                $text3  = 'text3_'.$lang['locale'];

                if( $request->input($text1)!=''  &&  $request->input($text2)!=""  &&  $request->input($text3)!="" )
                {
                    /* Get Existing Language Entry */
                    $translation = $obj_skill->getTranslation($lang['locale']);    

                    if($translation)
                    {
                        $translation->text1 = $request->input($text1);
                        $translation->text2 = $request->input($text2);
                        $translation->text3 = $request->input($text3);
                        //$translation->save();    
                    }  
                    else
                    {
                        /* Create New Language Entry  */
                        $translation            = $obj_skill->getNewTranslation($lang['locale']);
                        $translation->slider_id = $id;
                        $translation->text1     = $request->input($text1);
                        $translation->text2     = $request->input($text2);
                        $translation->text3     = $request->input($text3);
                        //$translation->save();
                    } 


                     if($request->hasFile('image_'.$lang['locale']))///check image loaded/Not
                            {
                                $image_validation = Validator::make(array('file'=>$request->file('image_'.$lang['locale'])),
                                                                    array('file'=>'mimes:jpg,jpeg,png'));
                                
                                if($request->file('image_'.$lang['locale'])->isValid() && $image_validation->passes())
                                {

                                    $maxHeight = 640;//740
                                    $maxWidth  = 1920;//1600

                                    $arr_image_size = [];
                                    $arr_image_size = getimagesize($request->file('image_'.$lang['locale']));

                                    if(isset($arr_image_size) && $arr_image_size==false)
                                    {
                                        Flash::error('Please use valid image');
                                        return redirect()->back(); 
                                    }

                                    /*-----------------------------------------------------------------
                                        $arr_image_size[0] = width of image
                                        $arr_image_size[1] = height of image
                                    -------------------------------------------------------------------*/

                                    if(($arr_image_size[0] != $maxWidth) && ($arr_image_size[1] != $maxHeight))
                                    {
                                        Flash::error("Please upload Image having  demension is equal to 1920 x 640");
                                        return redirect()->back();
                                    }   

                                    $image_path      = $request->file('image_'.$lang['locale'])->getClientOriginalName();
                                    $image_extention = $request->file('image_'.$lang['locale'])->getClientOriginalExtension();
                                    $image_name      = sha1(uniqid().$image_path.uniqid()).'.'.$image_extention;
                                    $previous_data   = $this->BaseModel->where('id',$id)->first()->toArray();

                                    if(isset($previous_data['image']) && sizeof($previous_data['image']))
                                    {
                                        if(file_exists($this->front_slider_base_img_path.$previous_data['image']))//CHECK FILE EXISTS IN FOLDER
                                        {
                                            /*$unlink_path  = $this->front_slider_base_img_path.$previous_data['image'];
                                            $unlink_image = unlink($unlink_path);

                                            if($unlink_image)
                                            {*/
                                                $final_image = $request->file('image_'.$lang['locale'])->move($this->front_slider_base_img_path, $image_name);
                                                if($final_image)
                                                {
                                                    $final_image_upload = $image_name;
                                                }
                                            /*}*/
                                        }
                                        else
                                        {
                                            $final_image = $request->file('image_'.$lang['locale'])->move($this->front_slider_base_img_path, $image_name);
                                            if($final_image)
                                            {
                                                $final_image_upload = $image_name;
                                            }
                                        }                    
                                    }
                                    else
                                    {
                                        $final_image = $request->file('image_'.$lang['locale'])->move($this->front_slider_base_img_path, $image_name);
                                        if($final_image)
                                        {
                                            $final_image_upload = $image_name;
                                        }
                                    }
                                }
                                else
                                {
                                    Flash::error('File is not an Image File');
                                    return redirect()->back();
                                }
                            }    
                            else
                            {
                                $old_image = $this->BaseModel->where('id',$id)->first()->toArray();
                                if(isset($old_image) && sizeof($old_image)>0)
                                {
                                    $final_image_upload = $old_image['image'];
                                }
                                else
                                {
                                    $final_image_upload = '';
                                }
                            }
                            $translation->image     = $final_image_upload;

                            $translation->save();

                } 

            }
            
        }


        if($slider_update)
        {
            Flash::success('Front Slider Image Updated Successfully');     
            return redirect()->back();
        }
        else
        {
            Flash::error("Error While Updating Slider Image");
            return redirect()->back();
        }  
    }

    public function save_order(Request $request)
    {
        $slider_id          = $request->input('slider_id');
        $order_index        = $request->input('order_id');
        $get_existing_order = $this->BaseModel->where('id','<>',$slider_id)->select('order_index')->get()->toArray();
        // dd($get_existing_order);
        /*Check if order index in a number */

        $check_number = is_numeric($order_index);
        if(!$check_number)
        {
            $data['status'] = "NUMERIC";
            $data['msg']    = "Please Do Not Enter Characters";
            return response()->json($data);
            exit;
        }

        /* Check if orderindex is not duplicate */
        $flag = 0;
        foreach ($get_existing_order as $order) 
        {
            if($order['order_index'] == $order_index )
            {
                $flag++; 
            }
        }

        if($flag > 0)
        {
            $data['status'] = "DUPLICATE";
            $data['msg']    = "Please Do Not Enter Duplicate Order";
            return response()->json($data);
            exit;
        }

        $slider     = $this->BaseModel->where('id',$slider_id);
        $arr_update = array('order_index'=> $order_index);
        $status     = $slider->update($arr_update);

        if($status)
        {
            $data['status'] = "SUCCESS";
            $data['msg']    = "Order Stored Successfully";
            return response()->json($data);
            exit;
        }
        else
        {
            $data['status'] = "ERROR";
            $data['msg']    = "Error While Changing The Order";
            return response()->json($data);
            exit;
        }
    }

    public function get_max_order()
    {
          $array_order        = array();
          $max_order          = 0;
          $get_existing_order = $this->BaseModel
                                      ->select('order_index')
                                      ->get()
                                      ->toArray();

          if(isset($get_existing_order) && count($get_existing_order) >0)
          {
                foreach ($get_existing_order as $order) 
                {
                    if(intval($order['order_index']) > $max_order)  
                    {
                        $max_order  = intval($order['order_index']);

                    }
                    
                }
          }
          return $max_order;
    }

    public function delete($enc_id = FALSE)
    {
        $obj_data   = Sentinel::getUser();
        $first_name = $obj_data->first_name;
        $last_name  = $obj_data->last_name;

        if(!$enc_id)
        {
            return redirect()->back();
        }

        if($this->perform_delete(base64_decode($enc_id)))
        {
           
            Flash::success(' Front Slider Deleted Successfully');
        }
        else
        {
            Flash::error('Problem Occured While Front Slider Deletion ');
        }

        return redirect()->back();
    }

    public function perform_delete($id)
    {
        $front_slider= $this->BaseModel->where('id',$id)->first();

        if($front_slider)
        {   
            return $front_slider->delete();
        }

        return FALSE;
    }   

    public function multi_action(Request $request)
    {
        $obj_data   = Sentinel::getUser();
        $first_name = $obj_data->first_name;
        $last_name  = $obj_data->last_name;

        $arr_rules                   = array();
        $arr_rules['multi_action']   = "required";
        $arr_rules['checked_record'] = "required";
        $validator                   = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {
            Flash::error('Please Select '.str_plural($this->module_title) .' To Perform Multi Actions');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $multi_action   = $request->input('multi_action');
        $checked_record = $request->input('checked_record');

        /* Check if array is supplied*/
        if(is_array($checked_record) && sizeof($checked_record)<=0)
        {
            Flash::error('Problem Occured, While Doing Multi Action');
            return redirect()->back();
        }

        foreach ($checked_record as $key => $record_id) 
        {  
            if($multi_action=="delete")
            {
               $this->perform_delete(base64_decode($record_id));    
               Flash::success('Front Slider(s) Deleted Successfully'); 
            } 
            elseif($multi_action=="activate")
            {
               $this->perform_activate(base64_decode($record_id)); 
               Flash::success('Front Slider(s) Activated Successfully'); 
            }
            elseif($multi_action=="deactivate")
            {
               $this->perform_deactivate(base64_decode($record_id));    
               Flash::success('Front Slider(s) Blocked Successfully');  
            }
        }
           return redirect()->back();
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
