<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\PaperModel;  
use App\Models\ColorModel; 
use App\Common\Traits\MultiActionTrait;
use App\Models\NewsModel;  
use App\Models\MasterModel;  
use Validator;
use Session;
use Flash;
use DB;


class PaperController extends Controller
{
    use MultiActionTrait;

    public function __construct(
                                    PaperModel $paper,
                                    ColorModel $color,
                                    MasterModel $MasterModel
                               )
    {
        /*MASTER-MODEL : QUERY BUILDER*/
        $this->MasterModel          = $MasterModel;

        /* PAPER : SIZE */
        $this->module_title_size         = "Paper Size";
        $this->module_url_slug_size      = "Paper Size";               
        $this->module_url_path_size      = url(config('app.project.admin_panel_slug')."/papers/size/");
        $this->module_view_folder_size   = 'admin.paper_size';
        $this->module_icon_size          = "fa-file-text-o "; 
        /* PAPER : TYPE */
        $this->module_title_type         = "Paper Type";
        $this->module_url_slug_type      = "Paper Type";               
        $this->module_url_path_type      = url(config('app.project.admin_panel_slug')."/papers/type/");
        $this->module_view_folder_type   = 'admin.paper_type';
        $this->module_icon_type          = "fa-file-text-o ";  
        /* PAPER : WEIGHT(GSM) */
        $this->module_title_weight_gsm         = "Paper Weight[GSM]";
        $this->module_url_slug_weight_gsm      = "Paper Weight[GSM]";               
        $this->module_url_path_weight_gsm      = url(config('app.project.admin_panel_slug')."/papers/weight_gsm/");
        $this->module_view_folder_weight_gsm   = 'admin.paper_weight_gsm';
        $this->module_icon_weight_gsm          = "fa-file-text-o ";

        /* PAPER : WEIGHT(GSM) */
        $this->module_title_weight_gram         = "Paper Weight[Gram]";
        $this->module_url_slug_weight_gram      = "Paper Weight[Gram]";               
        $this->module_url_path_weight_gram      = url(config('app.project.admin_panel_slug')."/papers/weight_gram/");
        $this->module_view_folder_weight_gram   = 'admin.paper_weight_gram';
        $this->module_icon_weight_gram          = "fa-file-text-o ";
    }

/******************************************** START : PAPER - SIZE ********************************************/
    public function size_manage()
    {
        $size_arr = DB::table('paper_size as PS')
                    ->join('paper_size_translation as PST','PS.id','=','PST.size_id')
                    ->select(
                        'PS.id as primaryKey',
                        'PS.size_name',
                        'PS.list_status',
                        'PST.id',
                        'PST.size_id as foreignKey',
                        'PST.description'
                        )
                    ->groupBy('PST.size_id')
                    //->orderBy('PS.id', 'DESC')
                    ->get();
        $this->arr_view_data['page_title']        = "Manage ".str_plural($this->module_title_size);
        $this->arr_view_data['module_title']      = $this->module_title_size;
        $this->arr_view_data['module_url_path']   = $this->module_url_path_size;
        $this->arr_view_data['size_arr']          = $size_arr;
        $this->arr_view_data['module_icon']     = $this->module_icon_size;
        return view($this->module_view_folder_size.'.index',$this->arr_view_data);
    }

    public function size_create(Request $request)
    {
        $arr_lang = config('constants.LANG_ARR'); 
        
        if(isset($_POST['btn_add_paper_size']))
        {
            $arr_rules['size_name_common']       = "required";
            if(count($arr_lang) > 0)
            {
                foreach ($arr_lang as $arr_lang_key => $arr_lang_value)
                {
                    $arr_rules['size_description_'.$arr_lang_key]  = "required";
                }
            }
            $validator = Validator::make($request->all(),$arr_rules);
            if($validator->fails())
            {
                 return redirect()->back()->withErrors($validator)->withInput($request->all());
            }

            $is_present = DB::table('paper_size as PS')
                            ->select('PS.id')
                            ->where('PS.size_name', '=', $request->input('size_name_common'))
                            ->get();
            if(count($is_present) == 0)
            {
                $paper_size_insertArr = array(
                                            'size_name'         => $request->input('size_name_common'),
                                            'list_status'       => 'yes',
                                            'created_date'      => date('Y-m-d h:i:s')
                                          );
                $result = $this->MasterModel->insertRecord('paper_size',$paper_size_insertArr);
                if($result != '')
                {
                    if(count($arr_lang) > 0)
                    {
                        foreach ($arr_lang as $arr_lang_key => $arr_lang_value)
                        {
                            $paper_size_translation_insertArr = array(
                                                                        'size_id'           => $result,
                                                                        'locale'            => $arr_lang_key,
                                                                        'description'       => $request->input('size_description_'.$arr_lang_key)
                                                                      );
                            $this->MasterModel->insertRecord('paper_size_translation',$paper_size_translation_insertArr);
                        }
                    }
                   Flash::success($this->module_title_size.' created successfully'); 
                }
                else
                {
                    Flash::error('Problem Occured, While Updating '.str_singular($this->module_title_size));
                }
            }
            else
            {
                Flash::error('Size already exist.Please try with other size.'.str_singular($this->module_title_size));
            }
            return redirect()->back();
        }

        $this->arr_view_data['page_title']      = "Create ".$this->module_title_size;
        $this->arr_view_data['module_title']    = $this->module_title_size;
        $this->arr_view_data['module_url_path'] = $this->module_url_path_size;
        $this->arr_view_data['module_icon']     = $this->module_icon_size;
        $this->arr_view_data['arr_lang']        = $arr_lang;
        return view($this->module_view_folder_size.'.create',$this->arr_view_data);
    }

    public function size_edit($enc_id)
    {
        $arr_lang = $size_arr = $size_desc_arr = array();
        $id = base64_decode($enc_id);
        $arr_lang = config('constants.LANG_ARR'); 
        
        $size_arr = DB::table('paper_size as PS')
                    ->where('PS.id','=',$id)
                    ->select(
                        'PS.id as primaryKey',
                        'PS.size_name',
                        'PS.list_status'
                        )
                    ->get();
        if(count($size_arr) > 0)
        {
            $size_desc_arr = DB::table('paper_size_translation as PST')
                            ->select(
                                'PST.id',
                                'PST.size_id as foreignKey',
                                'PST.locale',
                                'PST.description'
                                )
                            ->where('PST.size_id','=',$size_arr[0]->primaryKey)
                            ->get();
        }
        
        $this->arr_view_data['edit_mode']       = true;
        $this->arr_view_data['enc_id']          = $enc_id;
        $this->arr_view_data['page_title']      = "Edit ".$this->module_title_size;
        $this->arr_view_data['module_title']    = $this->module_title_size;
        $this->arr_view_data['module_url_path'] = $this->module_url_path_size;
        $this->arr_view_data['module_icon']     = $this->module_icon_size;
        $this->arr_view_data['arr_lang']        = $arr_lang;
        $this->arr_view_data['size_arr']        = $size_arr;
        $this->arr_view_data['size_desc_arr']   = $size_desc_arr;
        return view($this->module_view_folder_size.'.edit',$this->arr_view_data);
    }

    public function size_update(Request $request)
    {
        $id = base64_decode($request->input('enc_id'));
        $arr_lang = config('constants.LANG_ARR');
        $arr_rules['size_name_common']       = "required";
        if(count($arr_lang) > 0)
        {
            foreach ($arr_lang as $arr_lang_key => $arr_lang_value)
            {
                $arr_rules['size_description_'.$arr_lang_key]  = "required";
            }
        }
        $validator = Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
             return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $is_present = DB::table('paper_size as PS')
                            ->select('PS.id')
                            ->where('PS.id','!=', $id)
                            ->where('PS.size_name', '=', $request->input('size_name_common'))
                            ->get();
        if(count($is_present) == 0)
        {
            $paper_size_updateArr = array(
                                            'size_name'         => $request->input('size_name_common')
                                          );
            $this->MasterModel->updateRecord('paper_size',array('id'=>$id),$paper_size_updateArr);

                $size_desc_arr = DB::table('paper_size_translation as PST')
                                    ->select(
                                        'PST.id',
                                        'PST.locale'
                                        )
                                    ->where('PST.size_id','=',$id)
                                    ->get();
                if(count($size_desc_arr) > 0)
                {
                    if(count($arr_lang) > 0)
                    {
                        $i = 0;
                        foreach ($arr_lang as $arr_lang_key => $arr_lang_value)
                        {
                            if($size_desc_arr[$i]->locale == $arr_lang_key)
                            {
                                $paper_size_translation_updateArr = array(
                                                                        'description'       => $request->input('size_description_'.$arr_lang_key)
                                                                      );
                                //$this->MasterModel->updateRecord('paper_size_translation',array('id'=>$size_desc_arr[$i]->id),$paper_size_translation_updateArr);
                                $this->MasterModel->updateRecord('paper_size_translation',array('size_id'=>$id,'locale' => $arr_lang_key),$paper_size_translation_updateArr);
                            }
                        $i++;
                        }
                    }
                }
            Flash::success(str_singular($this->module_title_size).' Updated Successfully');
        }
        else
        {
            Flash::error('Size already exist.Please try with other size.'.str_singular($this->module_title_size));
        }
        return redirect()->back();
    }

    public function size_actions($action_type,$enc_id)
    {
        $id = base64_decode($enc_id);
        switch($action_type){
            case 'delete':
                    $is_present = $this->MasterModel->getRecords('paper_size',array('id'),'',array('id'=>$id),'','','','');
                    if(count($is_present) > 0)
                    {
                        $table = 'paper_size';
                        $column_name = 'id';
                        $sub_table = 'paper_size_translation';
                        $sub_column_name = 'size_id';
                        $status = perform_delete($id,$table,$column_name,$sub_table,$sub_column_name);
                        if($status == 'true')
                        {
                            Flash::success(str_singular($this->module_title_size).' deleted successfully');
                            return redirect()->back();
                        }
                        else
                        {
                            Flash::error("Problem occured when deleting ".$this->module_title_size);
                            return redirect()->back();
                        }    
                    }
                    else
                    {
                        Flash::error("Problem occured when deleting ".$this->module_title_size);
                        return redirect()->back();
                    }
            break;
            case 'activate':
                    $whrCondition   =   array('id' => $id);
                    $dataVals       = array('list_status' => 'yes');
                    $table = 'paper_size';
                    $column_name = 'list_status';
                    $status = perform_active($id,$table,$column_name);
                    if($status == 'true')
                    {
                        Flash::success(str_singular($this->module_title_size).' activated successfully');
                        return redirect()->back();
                    }
                    else
                    {
                        Flash::error("Problem occured when updating ".$this->module_title_size);
                        return redirect()->back();
                    }
            break;
            case 'deactivate':
                    $whrCondition   =   array('id' => $id);
                    $dataVals       = array('list_status' => 'no');
                    $table = 'paper_size';
                    $column_name = 'list_status';
                    $status = perform_block($id,$table,$column_name);
                    if($status == 'true')
                    {
                        Flash::success(str_singular($this->module_title_size).' deactivated successfully');
                        return redirect()->back();
                    }
                    else
                    {
                        Flash::error("Problem occured when updating ".$this->module_title_size);
                        return redirect()->back();
                    }
            break;
            default:
                Flash::error('Something went wrong, please check your code.');
                return redirect()->back();
            break;
        }
    }

    public function size_multi_action(Request $request)
    {
        $arr_rules                   = array();
        $arr_rules['multi_action']   = "required";
        $arr_rules['checked_record'] = "required";

        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {
            Flash::error('Please Select '.$this->module_title_size.' To Perform Multi Actions');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $multi_action   = $request->input('multi_action');
        $checked_record = $request->input('checked_record');

        /* Check if array is supplied*/
        if(is_array($checked_record) && sizeof($checked_record)<=0)
        {
            Flash::error('error','whoops record not found. please try again');
            return redirect()->back();
        }

        foreach ($checked_record as $key => $record_id) 
        {  
            if($multi_action=="delete")
            {
                $table = 'paper_size';
                $column_name = 'id';
                $sub_table = 'paper_size_translation';
                $sub_column_name = 'size_id';
                perform_delete(base64_decode($record_id),$table,$column_name,$sub_table,$sub_column_name);
                Flash::success('Records deleted successfully');
            } 
            elseif($multi_action=="activate")
            {
                $table = 'paper_size';
                $column_name = 'list_status';
                perform_active(base64_decode($record_id),$table,$column_name); 
                Flash::success('Records activated successfully');
            }
            elseif($multi_action=="deactivate")
            {
                $table = 'paper_size';
                $column_name = 'list_status';
                perform_block(base64_decode($record_id),$table,$column_name);    
                Flash::success('Records blocked successfully');
            }
        }
        return redirect()->back();
    }

/******************************************** END : PAPER - SIZE ********************************************/

/******************************************** START : PAPER - TYPE ********************************************/
    public function type_manage()
    {
        $type_arr=[];
        $type_arr = DB::table('paper_type as PT')
                    ->join('paper_type_translation as PTT','PT.id','=','PTT.type_id')
                    ->select(
                        'PT.id as primaryKey',
                        'PT.list_status',
                        'PTT.id',
                        'PTT.name as foreignKey',
                        'PTT.name',
                        'PTT.description'
                        )
                    ->groupBy('PTT.type_id')
                    //->orderBy('PT.id', 'DESC')
                    ->get();

        $this->arr_view_data['page_title']        = "Manage ".str_plural($this->module_title_type);
        $this->arr_view_data['module_title']      = $this->module_title_type;
        $this->arr_view_data['module_url_path']   = $this->module_url_path_type;
        $this->arr_view_data['type_arr']          = $type_arr;
        $this->arr_view_data['module_icon']       = $this->module_icon_type;
        return view($this->module_view_folder_type.'.index',$this->arr_view_data);
    }
    
    public function type_create(Request $request)
    {
        $arr_lang = config('constants.LANG_ARR');
        
        if(isset($_POST['btn_add_paper_type']))
        {
            if(count($arr_lang) > 0)
            {
                foreach ($arr_lang as $arr_lang_key => $arr_lang_value)
                {
                    $arr_rules['type_name_'.$arr_lang_key]  = "required";
                    $arr_rules['type_description_'.$arr_lang_key]  = "required";
                }
            }
            $validator = Validator::make($request->all(),$arr_rules);
            if($validator->fails())
            {
                 return redirect()->back()->withErrors($validator)->withInput($request->all());
            }

            $is_present='';
            if(count($arr_lang) > 0)
            {
                foreach ($arr_lang as $arr_lang_key => $arr_lang_value)
                {
                    $is_present = DB::table('paper_type_translation')
                                ->where('paper_type_translation.name','=',$request->input('type_name_'.$arr_lang_key))
                                ->count();
                }
            }

            if($is_present == 0)
            {

                $paper_type_insertArr = array(
                                                'list_status'       => 'yes',
                                                'created_date'      => date('Y-m-d h:i:s')
                                              );
                $result = $this->MasterModel->insertRecord('paper_type',$paper_type_insertArr);
                if($result != '')
                {
                    if(count($arr_lang) > 0)
                    {
                        foreach ($arr_lang as $arr_lang_key => $arr_lang_value)
                        {
                            $paper_type_translation_insertArr = array(
                                                                        'type_id'           => $result,
                                                                        'locale'            => $arr_lang_key,
                                                                        'name'       => $request->input('type_name_'.$arr_lang_key),
                                                                        'description'       => $request->input('type_description_'.$arr_lang_key)
                                                                      );
                            $this->MasterModel->insertRecord('paper_type_translation',$paper_type_translation_insertArr);
                        }
                    }
                   Flash::success($this->module_title_type.' created successfully'); 
                }
                else
                {
                    Flash::error('Problem Occured, While Creating '.str_singular($this->module_title_type));
                }
                return redirect()->back();
            }
            else
            {
                 Flash::error($this->module_title_type." Name Allready Exists");
                 return redirect()->back();
            }
        }

        $this->arr_view_data['page_title']      = "Create ".$this->module_title_type;
        $this->arr_view_data['module_title']    = $this->module_title_type;
        $this->arr_view_data['module_url_path'] = $this->module_url_path_type;
        $this->arr_view_data['module_icon']     = $this->module_icon_type;
        $this->arr_view_data['arr_lang']        = $arr_lang;
        return view($this->module_view_folder_type.'.create',$this->arr_view_data);
    }

    public function type_edit(Request $request,$enc_id)
    {
        $id =base64_decode($enc_id);
        if($id =='')
        {
            Flash::error('Problem Occured, While Updating '.str_singular($this->module_title_type));
            return redirect()->back();            
        }

        $arr_lang = config('constants.LANG_ARR');
        
        if(isset($_POST['btn_update_paper_type']))
        {
            if(count($arr_lang) > 0)
            {
                foreach ($arr_lang as $arr_lang_key => $arr_lang_value)
                {
                    $arr_rules['type_name_'.$arr_lang_key]  = "required";
                    $arr_rules['type_description_'.$arr_lang_key]  = "required";
                }
            }
            $validator = Validator::make($request->all(),$arr_rules);
            if($validator->fails())
            {
                 return redirect()->back()->withErrors($validator)->withInput($request->all());
            }

            $is_present='';
            if(count($arr_lang) > 0)
            {
                foreach ($arr_lang as $arr_lang_key => $arr_lang_value)
                {
                    $is_present = DB::table('paper_type_translation')
                                ->where('paper_type_translation.name','=',$request->input('type_name_'.$arr_lang_key))
                                ->where('paper_type_translation.type_id','!=',$id)
                                ->where('paper_type_translation.locale','=', $arr_lang_key)
                                ->count();
                }
            }
           // dd($is_present,$id);
            if($is_present == 0)
            {
                if($id != '' )
                {
                    if(count($arr_lang) > 0)
                    {
                        foreach ($arr_lang as $arr_lang_key => $arr_lang_value)
                        {
                            $paper_type_translation_updateArr = array(
                                                                        'name'              => $request->input('type_name_'.$arr_lang_key),
                                                                        'description'       => $request->input('type_description_'.$arr_lang_key)
                                                                          );
                            //dd($paper_type_translation_updateArr);
                            $this->MasterModel->updateRecord('paper_type_translation',array('type_id'=>$id,'locale' => $arr_lang_key),$paper_type_translation_updateArr);
                        }
                    }
                   Flash::success($this->module_title_type.' Update successfully'); 
                }
                else
                {
                    Flash::error('Problem Occured, While Updating '.str_singular($this->module_title_type));
                }
                return redirect()->back();
            }
            else
            {
                 Flash::error($this->module_title_type." Name Allready Exists");
                 return redirect()->back();
            }
            
        }

        $type_arr=[];
        $type_arr = DB::table('paper_type as PT')
                    ->join('paper_type_translation as PTT','PT.id','=','PTT.type_id')
                    ->select(
                        'PT.id as primaryKey',
                        'PT.list_status',
                        'PTT.id',
                        'PTT.name as foreignKey',
                        'PTT.name',
                        'PTT.description'
                        )
                    ->where('PT.id', $id)
                    ->get();
        $this->arr_view_data['page_title']      = "Edit ".$this->module_title_type;
        $this->arr_view_data['module_title']    = $this->module_title_type;
        $this->arr_view_data['module_url_path'] = $this->module_url_path_type;
        $this->arr_view_data['module_icon']     = $this->module_icon_type;
        $this->arr_view_data['arr_lang']        = $arr_lang;
        $this->arr_view_data['type_arr']        = $type_arr;
        return view($this->module_view_folder_type.'.edit',$this->arr_view_data);
    }

    public function type_actions($action_type,$enc_id)
    {
        $id = base64_decode($enc_id);
        switch($action_type){
            case 'delete':
                    $is_present = $this->MasterModel->getRecords('paper_type',array('id'),'',array('id'=>$id),'','','','');
                    if(count($is_present) > 0)
                    {
                        $table = 'paper_type';
                        $column_name = 'id';
                        $sub_table = 'paper_type_translation';
                        $sub_column_name = 'type_id';
                        $status = perform_delete($id,$table,$column_name,$sub_table,$sub_column_name);
                        if($status == 'true')
                        {
                            Flash::success(str_singular($this->module_title_type).' deleted successfully');
                            return redirect()->back();
                        }
                        else
                        {
                            Flash::error("Problem occured when deleting ".$this->module_title_type);
                            return redirect()->back();
                        }    
                    }
                    else
                    {
                        Flash::error("Problem occured when deleting ".$this->module_title_type);
                        return redirect()->back();
                    }
            break;
            case 'activate':
                    $whrCondition   =   array('id' => $id);
                    $dataVals       = array('list_status' => 'yes');
                    $table = 'paper_type';
                    $column_name = 'list_status';
                    $status = perform_active($id,$table,$column_name);
                    if($status == 'true')
                    {
                        Flash::success(str_singular($this->module_title_type).' activated successfully');
                        return redirect()->back();
                    }
                    else
                    {
                        Flash::error("Problem occured when updating ".$this->module_title_type);
                        return redirect()->back();
                    }
            break;
            case 'deactivate':
                    $whrCondition   =   array('id' => $id);
                    $dataVals       = array('list_status' => 'no');
                    $table = 'paper_type';
                    $column_name = 'list_status';
                    $status = perform_block($id,$table,$column_name);
                    if($status == 'true')
                    {
                        Flash::success(str_singular($this->module_title_type).' deactivated successfully');
                        return redirect()->back();
                    }
                    else
                    {
                        Flash::error("Problem occured when updating ".$this->module_title_type);
                        return redirect()->back();
                    }
            break;
            default:
                Flash::error('Something went wrong, please check your code.');
                return redirect()->back();
            break;
        }
    }

    public function type_multi_action(Request $request)
    {
        $arr_rules                   = array();
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
            Flash::error('error','whoops record not found. please try again');
            return redirect()->back();
        }

        foreach ($checked_record as $key => $record_id) 
        {  
            if($multi_action=="delete")
            {
                $table = 'paper_type';
                $column_name = 'id';
                $sub_table = 'paper_type_translation';
                $sub_column_name = 'type_id';
                perform_delete(base64_decode($record_id),$table,$column_name,$sub_table,$sub_column_name);
                Flash::success('Records deleted successfully');
            } 
            elseif($multi_action=="activate")
            {
                $table = 'paper_type';
                $column_name = 'list_status';
                perform_active(base64_decode($record_id),$table,$column_name); 
                Flash::success('Records activated successfully');
            }
            elseif($multi_action=="deactivate")
            {
                $table = 'paper_type';
                $column_name = 'list_status';
                perform_block(base64_decode($record_id),$table,$column_name);    
                Flash::success('Records blocked successfully');
            }
        }
        return redirect()->back();
    }

/******************************************** END : PAPER - TYPE ********************************************/

/******************************************** START : PAPER - WEIGHT [GSM] ********************************************/
    public function weight_gsm_manage()
    {
        $weight_gsm_arr = DB::table('paper_weight_gsm as PWG')
                        ->join('paper_weight_gsm_translation as PWGT','PWG.id','=','PWGT.gsm_id')
                        ->select(
                            'PWG.id as primaryKey',
                            'PWG.weight_in_gsm',
                            'PWG.list_status',
                            'PWGT.id',
                            'PWGT.gsm_id as foreignKey',
                            'PWGT.description'
                            )
                        ->groupBy('PWGT.gsm_id')
                        //->orderBy('PWG.id', 'DESC')
                        ->get();
        $this->arr_view_data['page_title']          = "Manage ".$this->module_title_weight_gsm;
        $this->arr_view_data['module_title']        = $this->module_title_weight_gsm;
        $this->arr_view_data['module_url_path']     = $this->module_url_path_weight_gsm;
        $this->arr_view_data['weight_gsm_arr']      = $weight_gsm_arr;
        $this->arr_view_data['module_icon']         = $this->module_icon_weight_gsm;
        return view($this->module_view_folder_weight_gsm.'.index',$this->arr_view_data);
    }

    public function weight_gsm_create(Request $request)
    {
        $arr_lang = config('constants.LANG_ARR'); 
        
        if(isset($_POST['btn_add_paper_weight_gsm']))
        {
            $arr_rules['weight_gsm_common']       = "required|numeric";
            if(count($arr_lang) > 0)
            {
                foreach ($arr_lang as $arr_lang_key => $arr_lang_value)
                {
                    $arr_rules['weight_gsm_description_'.$arr_lang_key]  = "required";
                }
            }
            $validator = Validator::make($request->all(),$arr_rules);
            if($validator->fails())
            {
                 return redirect()->back()->withErrors($validator)->withInput($request->all());
            }

            if($request->input('weight_gsm_common')==0)
            {
                 Flash::error('Weight not equal to 0 .Please try with other .'.$this->module_title_weight_gsm);
                return redirect()->back();
            }

            $is_present = DB::table('paper_weight_gsm as PWG')
                            ->select('PWG.id')
                            ->where('PWG.weight_in_gsm', '=', $request->input('weight_gsm_common'))
                            ->get();
            if(count($is_present) == 0)
            {
                $paper_weight_gsm_insertArr = array(
                                            'weight_in_gsm'     => $request->input('weight_gsm_common'),
                                            'list_status'       => 'yes',
                                            'created_at'      => date('Y-m-d h:i:s')
                                          );
                $result = $this->MasterModel->insertRecord('paper_weight_gsm',$paper_weight_gsm_insertArr);
                if($result != '')
                {
                    if(count($arr_lang) > 0)
                    {
                        foreach ($arr_lang as $arr_lang_key => $arr_lang_value)
                        {
                            $paper_weight_gsm_translation_insertArr = array(
                                                                        'gsm_id'            => $result,
                                                                        'locale'            => $arr_lang_key,
                                                                        'description'       => $request->input('weight_gsm_description_'.$arr_lang_key)
                                                                      );
                            $this->MasterModel->insertRecord('paper_weight_gsm_translation',$paper_weight_gsm_translation_insertArr);
                        }
                    }
                   Flash::success($this->module_title_weight_gsm.' created successfully'); 
                }
                else
                {
                    Flash::error('Problem Occured, While Updating '.$this->module_title_weight_gsm);
                }
            }
            else
            {
                Flash::error('Weight already exist.Please try with other weight.'.$this->module_title_weight_gsm);
            }
            return redirect()->back();
        }

        $this->arr_view_data['page_title']      = "Create ".$this->module_title_weight_gsm;
        $this->arr_view_data['module_title']    = $this->module_title_weight_gsm;
        $this->arr_view_data['module_url_path'] = $this->module_url_path_weight_gsm;
        $this->arr_view_data['module_icon']     = $this->module_icon_weight_gsm;
        $this->arr_view_data['arr_lang']        = $arr_lang;
        return view($this->module_view_folder_weight_gsm.'.create',$this->arr_view_data);
    }

    public function weight_gsm_edit($enc_id)
    {
        $arr_lang = $size_arr = $size_desc_arr = array();
        $id = base64_decode($enc_id);
        $arr_lang = config('constants.LANG_ARR'); 
        
        $weight_gsm_arr = DB::table('paper_weight_gsm as PWG')
                        ->where('PWG.id','=',$id)
                        ->select(
                            'PWG.id as primaryKey',
                            'PWG.weight_in_gsm',
                            'PWG.list_status'
                            )
                        ->get();
        if(count($weight_gsm_arr) > 0)
        {
            $weight_gsm_desc_arr = DB::table('paper_weight_gsm_translation as PWGT')
                                ->select(
                                    'PWGT.id',
                                    'PWGT.gsm_id as foreignKey',
                                    'PWGT.locale',
                                    'PWGT.description'
                                    )
                                ->where('PWGT.gsm_id','=',$weight_gsm_arr[0]->primaryKey)
                                ->get();
        }
        
        $this->arr_view_data['edit_mode']               = true;
        $this->arr_view_data['enc_id']                  = $enc_id;
        $this->arr_view_data['page_title']              = "Edit ".$this->module_title_weight_gsm;
        $this->arr_view_data['module_title']            = $this->module_title_weight_gsm;
        $this->arr_view_data['module_url_path']         = $this->module_url_path_weight_gsm;
        $this->arr_view_data['module_icon']             = $this->module_icon_weight_gsm;
        $this->arr_view_data['arr_lang']                = $arr_lang;
        $this->arr_view_data['weight_gsm_arr']          = $weight_gsm_arr;
        $this->arr_view_data['weight_gsm_desc_arr']     = $weight_gsm_desc_arr;
        return view($this->module_view_folder_weight_gsm.'.edit',$this->arr_view_data);
    }

    public function weight_gsm_update(Request $request)
    {
        $id = base64_decode($request->input('enc_id'));
        $arr_lang = config('constants.LANG_ARR');
        $arr_rules['weight_gsm_common']       = "required";
        if(count($arr_lang) > 0)
        {
            foreach ($arr_lang as $arr_lang_key => $arr_lang_value)
            {
                $arr_rules['weight_gsm_description_'.$arr_lang_key]  = "required";
            }
        }
        $validator = Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
             return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $is_present = DB::table('paper_weight_gsm as PWG')
                            ->select('PWG.id')
                            ->where('PWG.id','!=', $id)
                            ->where('PWG.weight_in_gsm', '=', $request->input('weight_gsm_common'))
                            ->get();
        if(count($is_present) == 0)
        {
            $paper_weight_gsm_updateArr = array(
                                            'weight_in_gsm'         => $request->input('weight_gsm_common')
                                          );
            $this->MasterModel->updateRecord('paper_weight_gsm',array('id'=>$id),$paper_weight_gsm_updateArr);

                $weight_gsm_desc_arr = DB::table('paper_weight_gsm_translation as PWGT')
                                    ->select(
                                        'PWGT.id',
                                        'PWGT.locale'
                                        )
                                    ->where('PWGT.gsm_id','=',$id)
                                    ->get();
                if(count($weight_gsm_desc_arr) > 0)
                {
                    if(count($arr_lang) > 0)
                    {
                        $i = 0;
                        foreach ($arr_lang as $arr_lang_key => $arr_lang_value)
                        {
                            if($weight_gsm_desc_arr[$i]->locale == $arr_lang_key)
                            {
                                $paper_weight_gsm_translation_updateArr = array(
                                                                        'description'       => $request->input('weight_gsm_description_'.$arr_lang_key)
                                                                      );
                                //$this->MasterModel->updateRecord('paper_size_translation',array('id'=>$size_desc_arr[$i]->id),$paper_size_translation_updateArr);
                                $this->MasterModel->updateRecord('paper_weight_gsm_translation',array('gsm_id'=>$id,'locale' => $arr_lang_key),$paper_weight_gsm_translation_updateArr);
                            }
                        $i++;
                        }
                    }
                }
            Flash::success(str_singular($this->module_title_weight_gsm).' Updated Successfully');
        }
        else
        {
            Flash::error('Weight already exist.Please try with other weight.'.str_singular($this->module_title_weight_gsm));
        }
        return redirect()->back();
    }

    public function weight_gsm_actions($action_type,$enc_id)
    {
        $id = base64_decode($enc_id);
        switch($action_type){
            case 'delete':
                    $is_present = $this->MasterModel->getRecords('paper_weight_gsm',array('id'),'',array('id'=>$id),'','','','');
                    if(count($is_present) > 0)
                    {
                        $table = 'paper_weight_gsm';
                        $column_name = 'id';
                        $sub_table = 'paper_weight_gsm_translation';
                        $sub_column_name = 'gsm_id';
                        $status = perform_delete($id,$table,$column_name,$sub_table,$sub_column_name);
                        if($status == 'true')
                        {
                            Flash::success(str_singular($this->module_title_weight_gsm).' deleted successfully');
                            return redirect()->back();
                        }
                        else
                        {
                            Flash::error("Problem occured when deleting ".$this->module_title_weight_gsm);
                            return redirect()->back();
                        }    
                    }
                    else
                    {
                        Flash::error("Problem occured when deleting ".$this->module_title_weight_gsm);
                        return redirect()->back();
                    }
            break;
            case 'activate':
                    $whrCondition   =   array('id' => $id);
                    $dataVals       = array('list_status' => 'yes');
                    $table = 'paper_weight_gsm';
                    $column_name = 'list_status';
                    $status = perform_active($id,$table,$column_name);
                    if($status == 'true')
                    {
                        Flash::success(str_singular($this->module_title_weight_gsm).' activated successfully');
                        return redirect()->back();
                    }
                    else
                    {
                        Flash::error("Problem occured when updating ".$this->module_title_weight_gsm);
                        return redirect()->back();
                    }
            break;
            case 'deactivate':
                    $whrCondition   =   array('id' => $id);
                    $dataVals       = array('list_status' => 'no');
                    $table = 'paper_weight_gsm';
                    $column_name = 'list_status';
                    $status = perform_block($id,$table,$column_name);
                    if($status == 'true')
                    {
                        Flash::success(str_singular($this->module_title_weight_gsm).' deactivated successfully');
                        return redirect()->back();
                    }
                    else
                    {
                        Flash::error("Problem occured when updating ".$this->module_title_weight_gsm);
                        return redirect()->back();
                    }
            break;
            default:
                Flash::error('Something went wrong, please check your code.');
                return redirect()->back();
            break;
        }
    }

    public function weight_gsm_multi_action(Request $request)
    {
        $arr_rules                   = array();
        $arr_rules['multi_action']   = "required";
        $arr_rules['checked_record'] = "required";

        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {
            Flash::error('Please Select '.$this->module_title_size.' To Perform Multi Actions');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $multi_action   = $request->input('multi_action');
        $checked_record = $request->input('checked_record');

        /* Check if array is supplied*/
        if(is_array($checked_record) && sizeof($checked_record)<=0)
        {
            Flash::error('error','whoops record not found. please try again');
            return redirect()->back();
        }

        foreach ($checked_record as $key => $record_id) 
        {  
            if($multi_action=="delete")
            {
                $table = 'paper_weight_gsm';
                $column_name = 'id';
                $sub_table = 'paper_weight_gsm_translation';
                $sub_column_name = 'gsm_id';
                perform_delete(base64_decode($record_id),$table,$column_name,$sub_table,$sub_column_name);
                Flash::success('Records deleted successfully');
            } 
            elseif($multi_action=="activate")
            {
                $table = 'paper_weight_gsm';
                $column_name = 'list_status';
                perform_active(base64_decode($record_id),$table,$column_name); 
                Flash::success('Records activated successfully');
            }
            elseif($multi_action=="deactivate")
            {
                $table = 'paper_weight_gsm';
                $column_name = 'list_status';
                perform_block(base64_decode($record_id),$table,$column_name);    
                Flash::success('Records blocked successfully');
            }
        }
        return redirect()->back();
    }

/******************************************** END : PAPER - WEIGHT [GSM] ********************************************/

/******************************************** START : PAPER - WEIGHT [Gram] ********************************************/
    public function weight_gram_manage()
    {
        $weight_gram_arr = DB::table('paper_weight_gram as PWG')
                        ->join('paper_weight_gram_translation as PWGT','PWG.id','=','PWGT.gram_id')
                        ->join('paper_size as PS','PWG.size_id','=','PS.id')
                        ->join('paper_weight_gsm as PWGSM','PWG.gsm_id','=','PWGSM.id')
                        ->select(
                            'PWG.id as primaryKey',
                            'PWG.size_id',
                            'PS.size_name',
                            'PWG.gsm_id',
                            'PWGSM.weight_in_gsm',
                            'PWG.weight_in_grams',
                            'PWG.list_status',
                            'PWGT.id',
                            'PWGT.gram_id as foreignKey',
                            'PWGT.description'
                            )
                        ->groupBy('PWGT.gram_id')
                        //->orderBy('PWG.id', 'DESC')
                        ->get();
        //dd($weight_gram_arr);                        
        $this->arr_view_data['page_title']          = "Manage ".$this->module_title_weight_gram;
        $this->arr_view_data['module_title']        = $this->module_title_weight_gram;
        $this->arr_view_data['module_url_path']     = $this->module_url_path_weight_gram;
        $this->arr_view_data['weight_gram_arr']      = $weight_gram_arr;
        $this->arr_view_data['module_icon']         = $this->module_icon_weight_gram;
        return view($this->module_view_folder_weight_gram.'.index',$this->arr_view_data);
    }

    public function weight_gram_create(Request $request)
    {
        $arr_lang = $size_arr = $weight_gsm_arr = array();
        $arr_lang = config('constants.LANG_ARR'); 
        
        if(isset($_POST['btn_add_paper_weight_gram']))
        {
            $arr_rules['weight_gram_common']        = "required|numeric";
            $arr_rules['size_id']                   = "required";
            $arr_rules['gsm_id']                    = "required";
            if(count($arr_lang) > 0)
            {
                foreach ($arr_lang as $arr_lang_key => $arr_lang_value)
                {
                    $arr_rules['weight_gram_description_'.$arr_lang_key]  = "required";
                }
            }
            $validator = Validator::make($request->all(),$arr_rules);
            if($validator->fails())
            {
                 return redirect()->back()->withErrors($validator)->withInput($request->all());
            }

            $is_present = DB::table('paper_weight_gram as PWG')
                            ->select('PWG.id')
                            ->where('PWG.size_id', '=', $request->input('size_id'))
                            ->where('PWG.gsm_id', '=', $request->input('gsm_id'))
                            ->get();
            if(count($is_present) == 0)
            {
                $paper_weight_gram_insertArr = array(
                                            'size_id'           => $request->input('size_id'),
                                            'gsm_id'            => $request->input('gsm_id'),
                                            'weight_in_grams'   => $request->input('weight_gram_common'),
                                            'list_status'       => 'yes',
                                            'created_at'        => date('Y-m-d h:i:s')
                                          );
                $result = $this->MasterModel->insertRecord('paper_weight_gram',$paper_weight_gram_insertArr);
                if($result != '')
                {
                    if(count($arr_lang) > 0)
                    {
                        foreach ($arr_lang as $arr_lang_key => $arr_lang_value)
                        {
                            $paper_weight_gram_translation_insertArr = array(
                                                                        'gram_id'           => $result,
                                                                        'locale'            => $arr_lang_key,
                                                                        'description'       => $request->input('weight_gram_description_'.$arr_lang_key)
                                                                      );
                            $this->MasterModel->insertRecord('paper_weight_gram_translation',$paper_weight_gram_translation_insertArr);
                        }
                    }
                   Flash::success($this->module_title_weight_gram.' created successfully'); 
                }
                else
                {
                    Flash::error('Problem Occured, While Updating '.$this->module_title_weight_gram);
                }
            }
            else
            {
                Flash::error($this->module_title_weight_gram.' already exist.Please try with other name.');
            }
            return redirect()->back();
        }

        $size_arr = DB::table('paper_size as PS')
                    ->select(
                        'PS.id',
                        'PS.size_name'
                        )
                    ->where('list_status','=','yes')
                    ->orderBy('PS.size_name', 'ASC')
                    ->get();
        //dd($size_arr)
        $weight_gsm_arr = DB::table('paper_weight_gsm as PWG')
                        ->select(
                            'PWG.id',
                            'PWG.weight_in_gsm'
                            )
                        ->where('list_status','=','yes')
                        ->orderBy('PWG.weight_in_gsm', 'ASC')
                        ->get();
        //dd($weight_gsm_arr);
        $this->arr_view_data['page_title']      = "Create ".$this->module_title_weight_gram;
        $this->arr_view_data['module_title']    = $this->module_title_weight_gram;
        $this->arr_view_data['module_url_path'] = $this->module_url_path_weight_gram;
        $this->arr_view_data['module_icon']     = $this->module_icon_weight_gram;
        $this->arr_view_data['arr_lang']        = $arr_lang;
        $this->arr_view_data['size_arr']        = $size_arr;
        $this->arr_view_data['weight_gsm_arr']  = $weight_gsm_arr;
        return view($this->module_view_folder_weight_gram.'.create',$this->arr_view_data);
    }

    public function weight_gram_edit($enc_id)
    {
        $arr_lang = $size_arr = $weight_gram_arr = $size_desc_arr = array();
        $id = base64_decode($enc_id);
        $arr_lang = config('constants.LANG_ARR'); 
        
        $weight_gram_arr = DB::table('paper_weight_gram as PWG')
                            ->where('PWG.id','=',$id)
                            ->select(
                                'PWG.id as primaryKey',
                                'PWG.size_id',
                                'PWG.gsm_id',
                                'PWG.weight_in_grams',
                                'PWG.list_status'
                                )
                            ->get();
        if(count($weight_gram_arr) > 0)
        {
            $weight_gram_desc_arr = DB::table('paper_weight_gram_translation as PWGT')
                                ->select(
                                    'PWGT.id',
                                    'PWGT.gram_id as foreignKey',
                                    'PWGT.locale',
                                    'PWGT.description'
                                    )
                                ->where('PWGT.gram_id','=',$weight_gram_arr[0]->primaryKey)
                                ->get();
        }
        $size_arr = DB::table('paper_size as PS')
                    ->select(
                        'PS.id',
                        'PS.size_name'
                        )
                    ->where('list_status','=','yes')
                    ->orderBy('PS.id', 'DESC')
                    ->get();
        //dd($size_arr)
        $weight_gsm_arr = DB::table('paper_weight_gsm as PWG')
                        ->select(
                            'PWG.id',
                            'PWG.weight_in_gsm'
                            )
                        ->where('list_status','=','yes')
                        ->orderBy('PWG.id', 'DESC')
                        ->get();
        //dd($weight_gsm_arr);
        $this->arr_view_data['edit_mode']               = true;
        $this->arr_view_data['enc_id']                  = $enc_id;
        $this->arr_view_data['page_title']              = "Edit ".$this->module_title_weight_gram;
        $this->arr_view_data['module_title']            = $this->module_title_weight_gram;
        $this->arr_view_data['module_url_path']         = $this->module_url_path_weight_gram;
        $this->arr_view_data['module_icon']             = $this->module_icon_weight_gram;
        $this->arr_view_data['arr_lang']                = $arr_lang;
        $this->arr_view_data['weight_gram_arr']         = $weight_gram_arr;
        $this->arr_view_data['weight_gram_desc_arr']    = $weight_gram_desc_arr;
        $this->arr_view_data['size_arr']                = $size_arr;
        $this->arr_view_data['weight_gsm_arr']          = $weight_gsm_arr;
        return view($this->module_view_folder_weight_gram.'.edit',$this->arr_view_data);
    }

    public function weight_gram_update(Request $request)
    {
        $id = base64_decode($request->input('enc_id'));
        $arr_lang = config('constants.LANG_ARR');
        $arr_rules['weight_gram_common']    = "required";
        $arr_rules['size_id']               = "required";
        $arr_rules['gsm_id']                = "required";
        if(count($arr_lang) > 0)
        {
            foreach ($arr_lang as $arr_lang_key => $arr_lang_value)
            {
                $arr_rules['weight_gram_description_'.$arr_lang_key]  = "required";
            }
        }
        $validator = Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
             return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $is_present = DB::table('paper_weight_gram as PWG')
                            ->select('PWG.id')
                            ->where('PWG.id','!=', $id)
                            ->where('PWG.size_id', '=', $request->input('size_id'))
                            ->where('PWG.gsm_id', '=', $request->input('gsm_id'))
                            ->get();
        if(count($is_present) == 0)
        {
            $paper_weight_gram_updateArr = array(
                                            'size_id'           => $request->input('size_id'),
                                            'gsm_id'            => $request->input('gsm_id'),
                                            'weight_in_grams'   => $request->input('weight_gram_common')
                                          );
            $this->MasterModel->updateRecord('paper_weight_gram',array('id'=>$id),$paper_weight_gram_updateArr);

                $weight_gram_desc_arr = DB::table('paper_weight_gram_translation as PWGT')
                                    ->select(
                                        'PWGT.id',
                                        'PWGT.locale'
                                        )
                                    ->where('PWGT.gram_id','=',$id)
                                    ->get();
                if(count($weight_gram_desc_arr) > 0)
                {
                    if(count($arr_lang) > 0)
                    {
                        $i = 0;
                        foreach ($arr_lang as $arr_lang_key => $arr_lang_value)
                        {
                            if($weight_gram_desc_arr[$i]->locale == $arr_lang_key)
                            {
                                $paper_weight_gram_translation_updateArr = array(
                                                                        'description'   => $request->input('weight_gram_description_'.$arr_lang_key)
                                                                      );
                                //$this->MasterModel->updateRecord('paper_size_translation',array('id'=>$size_desc_arr[$i]->id),$paper_size_translation_updateArr);
                                $this->MasterModel->updateRecord('paper_weight_gram_translation',array('gram_id'=>$id,'locale' => $arr_lang_key),$paper_weight_gram_translation_updateArr);
                            }
                        $i++;
                        }
                    }
                }
            Flash::success(str_singular($this->module_title_weight_gram).' Updated Successfully');
        }
        else
        {
            Flash::error($this->module_title_weight_gram.' already exist.Please try with other name.');
        }
        return redirect()->back();
    }

    public function weight_gram_actions($action_type,$enc_id)
    {
        $id = base64_decode($enc_id);
        switch($action_type){
            case 'delete':
                    $is_present = $this->MasterModel->getRecords('paper_weight_gram',array('id'),'',array('id'=>$id),'','','','');
                    if(count($is_present) > 0)
                    {
                        $table = 'paper_weight_gram';
                        $column_name = 'id';
                        $sub_table = 'paper_weight_gram_translation';
                        $sub_column_name = 'gram_id';
                        $status = perform_delete($id,$table,$column_name,$sub_table,$sub_column_name);
                        if($status == 'true')
                        {
                            Flash::success(str_singular($this->module_title_weight_gram).' deleted successfully');
                            return redirect()->back();
                        }
                        else
                        {
                            Flash::error("Problem occured when deleting ".$this->module_title_weight_gram);
                            return redirect()->back();
                        }    
                    }
                    else
                    {
                        Flash::error("Problem occured when deleting ".$this->module_title_weight_gram);
                        return redirect()->back();
                    }
            break;
            case 'activate':
                    $whrCondition   =   array('id' => $id);
                    $dataVals       = array('list_status' => 'yes');
                    $table = 'paper_weight_gram';
                    $column_name = 'list_status';
                    $status = perform_active($id,$table,$column_name);
                    if($status == 'true')
                    {
                        Flash::success(str_singular($this->module_title_weight_gram).' activated successfully');
                        return redirect()->back();
                    }
                    else
                    {
                        Flash::error("Problem occured when updating ".$this->module_title_weight_gram);
                        return redirect()->back();
                    }
            break;
            case 'deactivate':
                    $whrCondition   =   array('id' => $id);
                    $dataVals       = array('list_status' => 'no');
                    $table = 'paper_weight_gram';
                    $column_name = 'list_status';
                    $status = perform_block($id,$table,$column_name);
                    if($status == 'true')
                    {
                        Flash::success(str_singular($this->module_title_weight_gram).' deactivated successfully');
                        return redirect()->back();
                    }
                    else
                    {
                        Flash::error("Problem occured when updating ".$this->module_title_weight_gram);
                        return redirect()->back();
                    }
            break;
            default:
                Flash::error('Something went wrong, please check your code.');
                return redirect()->back();
            break;
        }
    }

    public function weight_gram_multi_action(Request $request)
    {
        $arr_rules                   = array();
        $arr_rules['multi_action']   = "required";
        $arr_rules['checked_record'] = "required";

        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {
            Flash::error('Please Select '.$this->module_title_size.' To Perform Multi Actions');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $multi_action   = $request->input('multi_action');
        $checked_record = $request->input('checked_record');

        /* Check if array is supplied*/
        if(is_array($checked_record) && sizeof($checked_record)<=0)
        {
            Flash::error('error','whoops record not found. please try again');
            return redirect()->back();
        }

        foreach ($checked_record as $key => $record_id) 
        {  
            if($multi_action=="delete")
            {
                $table = 'paper_weight_gram';
                $column_name = 'id';
                $sub_table = 'paper_weight_gram_translation';
                $sub_column_name = 'gram_id';
                perform_delete(base64_decode($record_id),$table,$column_name,$sub_table,$sub_column_name);
                Flash::success('Records deleted successfully');
            } 
            elseif($multi_action=="activate")
            {
                $table = 'paper_weight_gram';
                $column_name = 'list_status';
                perform_active(base64_decode($record_id),$table,$column_name); 
                Flash::success('Records activated successfully');
            }
            elseif($multi_action=="deactivate")
            {
                $table = 'paper_weight_gram';
                $column_name = 'list_status';
                perform_block(base64_decode($record_id),$table,$column_name);    
                Flash::success('Records blocked successfully');
            }
        }
        return redirect()->back();
    }

/******************************************** END : PAPER - WEIGHT [Gram] ********************************************/

/******************************************** START : COMMON - FUNCTION ********************************************/
   /* public function perform_active($id,$table,$column_name)
    {
        $whrCondition   =   array('id' => $id);
        $dataVals       = array($column_name => 'yes');
        if($this->MasterModel->updateRecord($table,$whrCondition,$dataVals))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    public function perform_block($id,$table,$column_name)
    {
        $whrCondition   =   array('id' => $id);
        $dataVals       = array($column_name => 'no');
        if($this->MasterModel->updateRecord($table,$whrCondition,$dataVals))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    
    public function perform_delete($id,$table,$column_name,$sub_table,$sub_column_name)
    {
        $whrCondition   =   array($column_name => $id);
        if($this->MasterModel->deleteRecord($table,$whrCondition))
        {
            $sub_whrCondition   =   array($sub_column_name => $id);
            $this->MasterModel->deleteRecord($sub_table,$sub_whrCondition);
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }*/

/******************************************** END : COMMON - FUNCTION ********************************************/    

/*++++++++++++++++++++++++++++++++++++++++++++Gayatri++++++++++++++++++++++++++++++++++++++++++++++++++++++*/


}
