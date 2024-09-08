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
use Datatables;

class PriceController extends Controller
{
    public function __construct(MasterModel $MasterModel)
    {
        /*MASTER-MODEL : QUERY BUILDER*/
        $this->MasterModel          = $MasterModel;

        /* PAPER : SIZE */
        $this->module_title_size         = "Prices Paper Size";
        $this->module_sub_title_size     = "Paper size price";
        $this->module_url_slug_size      = "Prices Paper Size";               
        $this->module_url_path_size      = url(config('app.project.admin_panel_slug')."/prices/size/");
        $this->module_view_folder_size   = 'admin.price_paper_size';
        $this->module_icon_size          = "fa-money "; 
        /* PAPER : COLOR */
        $this->module_title_color         = "Prices Paper Color";
        $this->module_sub_title_color     = "Paper color price";
        $this->module_url_slug_color      = "Prices Paper Color";               
        $this->module_url_path_color      = url(config('app.project.admin_panel_slug')."/prices/color/");
        $this->module_view_folder_color   = 'admin.price_paper_color';
        $this->module_icon_color          = "fa-money "; 

        /* PAPER : Brouchure */
        $this->module_title_brochure         = "Prices Paper Brochure";
        $this->module_sub_title_brochure     = "Paper brochure price";
        $this->module_url_slug_brochure      = "Prices Paper brochure";               
        $this->module_url_path_brochure      = url(config('app.project.admin_panel_slug')."/prices/brochure/");
        $this->module_view_folder_brochure   = 'admin.price_paper_brochure';
        $this->module_icon_brochure          = "fa-money "; 

        /* PAPER : Binding */
        $this->module_title_binding         = "Prices Paper Binding";
        $this->module_sub_title_binding     = "Paper binding price";
        $this->module_url_slug_binding      = "Prices Paper binding";               
        $this->module_url_path_binding      = url(config('app.project.admin_panel_slug')."/prices/binding/");
        $this->module_view_folder_binding   = 'admin.price_paper_binding';
        $this->module_icon_binding          = "fa-money ";

          /* PAPER : Printing */
        $this->module_title_printing         = "Prices Paper Printing";
        $this->module_sub_title_printing     = "Paper printing price";
        $this->module_url_slug_printing      = "Prices Paper Printing";               
        $this->module_url_path_printing      = url(config('app.project.admin_panel_slug')."/prices/printing/");
        $this->module_view_folder_printing   = 'admin.price_paper_printing';
        $this->module_icon_printing          = "fa-money ";
    }

/******************************************** START : PRICE [PAPER - SIZE] ********************************************/
    public function price_size_manage($catId = null)
    {   
        /*echo $catId*/
        /*$query = DB::table('price_paper_size as PPS');
        $query->select(
            'PPS.id as primaryKey',
            'PPS.category_id',
            'UC.name as category_name',
            'PPS.size_id',
            'PS.size_name',
            'PPS.price',
            'PPS.type_id',
            'PPS.gsm_id',
            'PG.weight_in_gsm as weightGSM',
            'PTT.name as typeName'
            );
        $query->join('paper_size as PS','PPS.size_id','=','PS.id')
        ->join('user_categories as UC','PPS.category_id','=','UC.id')
        ->join('paper_weight_gsm as PG','PPS.gsm_id','=','PG.id')
        ->join('paper_type as PT','PPS.type_id','=','PT.id')
        ->join('paper_type_translation as PTT','PT.id','=','PTT.type_id');
        $query->where('PTT.locale','=','en');
        if(!empty($catId)){
            $query->where('PPS.category_id','=',$catId);
        }
        
        $query->orderBy('category_name', 'ASC')->orderBy('size_name', 'ASC')->orderBy('typeName', 'ASC');
        $query->groupBy('PPS.id');
	    $price_size_arr = $query->get();*/
        /*dd($query);*/
        $price_size_arr = [];
        $this->arr_view_data['page_title']        = "Manage ".str_plural($this->module_title_size);
        $this->arr_view_data['module_title']      = $this->module_title_size;
        $this->arr_view_data['module_url_path']   = $this->module_url_path_size;
        $this->arr_view_data['price_size_arr']    = $price_size_arr;
        $this->arr_view_data['module_icon']     = $this->module_icon_size;
        $this->arr_view_data['catId']           = $catId;
        return view($this->module_view_folder_size.'.index',$this->arr_view_data);
    }


    public function loadAllPriceSize(Request $request )
    {
        $build_result ='';
        
            $obj_user        = $this->get_price_size_details($request);
            $current_context = $this;
            $json_result     = Datatables::of($obj_user);
            $json_result     = $json_result->blacklist(['id']);
            $json_result     = $json_result->editColumn('enc_id',function($data) use ($current_context)
                                {
                                    return base64_encode($data->primaryKey);
                                })
                                /*->editColumn('category_name',function($data) use ($current_context)
                                {
                                    return isset($data->category_name) && $data->category_name != "" ? $data->category_name : "Default";
                                })*/
                                ->editColumn('build_action',function($data) use ($current_context)
                                {
                                     
                                        $build_edit_action_btn = '<a class="btn btn-primary btn-sm show-tooltip call_loader" title="Edit"  href="'.$this->module_url_path_size.'/edit/'.base64_encode($data->primaryKey).'"
                                             ><i class="fa fa-edit"></i></a>';
                                   
                                        $build_delete_action_btn = '<a class="btn btn-danger btn-sm show-tooltip call_loader" title="Delete"  href="'.$this->module_url_path_size.'/action/delete/'.base64_encode($data->primaryKey).'" 
                                            onclick="return confirm_action(this,event,\'Do you really want to Delete this record ?\')" ><i class="fa fa-trash"></i></a>';
                                  
                                    return $build_action=$build_edit_action_btn.' '.$build_delete_action_btn;
                                }) 
                            
                                ->make(true);

            $build_result = $json_result->getData();

             

        return response()->json($build_result);
    }

    public function get_price_size_details(Request $request)
    {
        $obj_price_size_arr  = DB::table('price_paper_size as PPS')
                        ->join('paper_size as PS','PPS.size_id','=','PS.id')
                        ->join('user_categories as UC','PPS.category_id','=','UC.id')
                        ->join('paper_weight_gsm as PG','PPS.gsm_id','=','PG.id')
                        ->join('paper_type as PT','PPS.type_id','=','PT.id')
                        ->join('paper_type_translation as PTT','PT.id','=','PTT.type_id')
                        ->where('PTT.locale','=','en')
                        ->select(
                            'PPS.id as primaryKey',
                            'PPS.category_id',
                            'UC.name as category_name',
                            'PPS.size_id',
                            'PS.size_name',
                            'PPS.price',
                            'PPS.type_id',
                            'PPS.gsm_id',
                            'PG.weight_in_gsm as weightGSM',
                            'PTT.name as typeName'
                            )
                        ->orderBy('category_name', 'ASC')
                        ->orderBy('size_name', 'ASC')
                        ->orderBy('typeName', 'ASC')
                        ->groupBy('PPS.id');                     

        /* ---------------- Filtering Logic ----------------------------------*/                    

        $arr_search_column = $request->input('column_filter');

        if(isset($arr_search_column['cat_id']) && $arr_search_column['cat_id'] != '' )
        {
            $cat_id = $arr_search_column['cat_id'];
            $obj_price_size_arr->where('PPS.category_id','=',$cat_id);
        }

        if(isset($arr_search_column['q_category']) && $arr_search_column['q_category']!="")
        {
            $search_term      = $arr_search_column['q_category'];
            $obj_price_size_arr = $obj_price_size_arr->where('UC.name','LIKE', '%'.$search_term.'%');
        }

        if(isset($arr_search_column['q_size']) && $arr_search_column['q_size']!="")
        {
            $search_term      = $arr_search_column['q_size'];
            $obj_price_size_arr = $obj_price_size_arr->where('PS.size_name','LIKE', '%'.$search_term.'%');
        }

        if(isset($arr_search_column['q_type']) && $arr_search_column['q_type']!="")
        {
            $search_term      = $arr_search_column['q_type'];
            $obj_price_size_arr = $obj_price_size_arr->where('PTT.name','LIKE', '%'.$search_term.'%');
        }

        if(isset($arr_search_column['q_gsm']) && $arr_search_column['q_gsm']!="")
        {
            $search_term      = $arr_search_column['q_gsm'];
            $obj_price_size_arr = $obj_price_size_arr->where('PG.weight_in_gsm','LIKE', '%'.$search_term.'%');
        }

        if(isset($arr_search_column['q_price']) && $arr_search_column['q_price']!="")
        {
            $search_term      = $arr_search_column['q_price'];
            $obj_price_size_arr = $obj_price_size_arr->where('PPS.price','LIKE', '%'.$search_term.'%');
        }

        return $obj_price_size_arr;
    }

    public function price_size_create(Request $request)
    {   

        $category_arr = $size_arr = array();
        $category_arr   = DB::table('user_categories')
                            ->get();
        $size_arr       = DB::table('paper_size as PS')
                            ->select('PS.id','PS.size_name')
                            ->where('list_status', '=', 'yes')
                            ->get();
        if(isset($_POST['btn_add_price_size']))
        {
            $arr_rules['category']   = "required";
            $arr_rules['size']       = "required";
            $arr_rules['price']      = "required|numeric";
            $arr_rules['paperType']      = "required";
            $arr_rules['paperGsm']       = "required";

            $validator = Validator::make($request->all(),$arr_rules);
            if($validator->fails())
            {
                 return redirect()->back()->withErrors($validator)->withInput($request->all());
            }

            $is_present = DB::table('price_paper_size as PPS')
                            ->select('PPS.id')
                            ->where('PPS.category_id','=',$request->input('category'))
                            ->where('PPS.size_id','=', $request->input('size'))
                            ->where('PPS.type_id','=', $request->input('paperType'))
                            ->where('PPS.gsm_id','=', $request->input('paperGsm'))
                            ->get();

            if(count($is_present) == 0)
            {
                $price_paper_size_insertArr = array(
                                            'category_id'   => $request->input('category'),
                                            'size_id'       => $request->input('size'),
                                            'price'         => $request->input('price'),
                                            'type_id'       => $request->input('paperType'),
                                            'gsm_id'        => $request->input('paperGsm')
                                          );
                $result = $this->MasterModel->insertRecord('price_paper_size',$price_paper_size_insertArr);
                if($result)
                {
                   Flash::success($this->module_sub_title_size.' created successfully'); 
                }
                else
                {
                    Flash::error('Problem Occured, While Updating '.str_singular($this->module_sub_title_size));
                }
            }
            else
            {
                Flash::error('Price already exist for your selected Category, Size, Type & GSM .Please try with other price.');
            }
            return redirect()->back();
        }

        $selectCols = array('TPT.id AS primaryKey','TPTT.name AS paperType');
        $joinArray  = array('join'=>array('paper_type_translation AS TPTT','TPTT.type_id','=','TPT.id','left'));
        $whrCondition = array('TPTT.locale' => 'en');
        $resPaperType = $this->MasterModel->getRecords('paper_type AS TPT',$selectCols,$joinArray,$whrCondition,'TPTT.name','asc');
        
        $selectCols = array('TPWG.id AS primaryKey','TPWG.weight_in_gsm AS paperGsm');
        $resPaperGsm = $this->MasterModel->getRecords('paper_weight_gsm AS TPWG',$selectCols,'','','TPWG.weight_in_gsm','asc');

        $this->arr_view_data['page_title']      = "Create ".$this->module_title_size;
        $this->arr_view_data['module_title']    = $this->module_title_size;
        $this->arr_view_data['module_url_path'] = $this->module_url_path_size;
        $this->arr_view_data['module_icon']     = $this->module_icon_size;
        $this->arr_view_data['category_arr']    = $category_arr;
        $this->arr_view_data['size_arr']        = $size_arr;
        $this->arr_view_data['resPaperType']    = $resPaperType;
        $this->arr_view_data['resPaperGsm']     = $resPaperGsm;
        return view($this->module_view_folder_size.'.create',$this->arr_view_data);
    }

    public function price_size_edit($enc_id)
    {
        $id = base64_decode($enc_id);
        $category_arr = $size_arr = array();
        $category_arr   = DB::table('user_categories')
                            ->get();
        $size_arr       = DB::table('paper_size as PS')
                            ->select('PS.id','PS.size_name')
                            ->where('list_status', '=', 'yes')
                            ->get();
        
        $price_paper_size = DB::table('price_paper_size as PPS')
                    ->where('PPS.id','=',$id)
                    ->select(
                        'PPS.id as primaryKey',
                        'PPS.category_id',
                        'PPS.size_id',
                        'PPS.type_id',
                        'PPS.gsm_id',
                        'PPS.price'
                        )
                    ->first();

        $selectCols = array('TPT.id AS primaryKey','TPTT.name AS paperType');
        $joinArray  = array('join'=>array('paper_type_translation AS TPTT','TPTT.type_id','=','TPT.id','left'));
        $whrCondition = array('TPTT.locale' => 'en');
        $resPaperType = $this->MasterModel->getRecords('paper_type AS TPT',$selectCols,$joinArray,$whrCondition,'TPTT.name','asc');
        
        $selectCols = array('TPWG.id AS primaryKey','TPWG.weight_in_gsm AS paperGsm');
        $resPaperGsm = $this->MasterModel->getRecords('paper_weight_gsm AS TPWG',$selectCols,'','','TPWG.weight_in_gsm','asc');
        
        $this->arr_view_data['edit_mode']       = true;
        $this->arr_view_data['enc_id']          = $enc_id;
        $this->arr_view_data['page_title']      = "Edit ".$this->module_title_size;
        $this->arr_view_data['module_title']    = $this->module_title_size;
        $this->arr_view_data['module_url_path'] = $this->module_url_path_size;
        $this->arr_view_data['module_icon']     = $this->module_icon_size;
        $this->arr_view_data['category_arr']    = $category_arr;
        $this->arr_view_data['size_arr']        = $size_arr;
        $this->arr_view_data['price_paper_size'] = $price_paper_size;
        $this->arr_view_data['resPaperType']     = $resPaperType;
        $this->arr_view_data['resPaperGsm']      = $resPaperGsm;
        return view($this->module_view_folder_size.'.edit',$this->arr_view_data);
    }

    public function price_size_update(Request $request)
    {
        $id = base64_decode($request->input('enc_id'));
        
        $arr_rules['category_id']    = "required";
        $arr_rules['size_id']        = "required";
        $arr_rules['price']          = "required|numeric";
        $arr_rules['paperType']      = "required";
        $arr_rules['paperGsm']       = "required";

        $validator = Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
             return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $is_present = DB::table('price_paper_size as PPS')
                            ->select('PPS.id')
                            ->where('PPS.id','!=', $id)
                            ->where('PPS.category_id','=',$request->input('category_id'))
                            ->where('PPS.size_id','=', $request->input('size_id'))
                            ->where('PPS.type_id','=', $request->input('paperType'))
                            ->where('PPS.gsm_id','=', $request->input('paperGsm'))
                            ->get();

        if(count($is_present) == 0)
        {
            $price_paper_size_updateArr = array(
                                                   'price'         => $request->input('price')
                                                );
            $this->MasterModel->updateRecord('price_paper_size',array('id'=>$id),$price_paper_size_updateArr);
            Flash::success(str_singular($this->module_sub_title_size).' updated successfully');
        }
        else
        {
            Flash::error('Price already exist for your selected Category, Size, Type & GSM .Please try with other price.');
        }
        return redirect()->back();
    }

    public function price_size_actions($action_type,$enc_id)
    {
        $id = base64_decode($enc_id);
        switch($action_type){
            case 'delete':
                    $is_present = $this->MasterModel->getRecords('price_paper_size',array('id'),'',array('id'=>$id),'','','','');
                    if(count($is_present) > 0)
                    {
                        $table = 'price_paper_size';
                        $column_name = 'id';
                        $sub_table = '';
                        $sub_column_name = '';
                        $status = perform_delete($id,$table,$column_name,$sub_table,$sub_column_name);
                        if($status == 'true')
                        {
                            Flash::success(str_singular($this->module_sub_title_size).' deleted successfully');
                            return redirect()->back();
                        }
                        else
                        {
                            Flash::error("Problem occured when deleting ".$this->module_sub_title_size);
                            return redirect()->back();
                        }    
                    }
                    else
                    {
                        Flash::error("Problem occured when deleting ".$this->module_sub_title_size);
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

    public function price_size_multi_action(Request $request)
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
                $table = 'price_paper_size';
                $column_name = 'id';
                $sub_table = '';
                $sub_column_name = '';
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



/******************************************** START : PRICE [PAPER - COLOR] ********************************************/
    public function price_color_manage()
    {
        $price_color_arr = DB::table('price_color as PC')
            ->join('user_categories as UC','PC.category_id','=','UC.id')
            ->join('paper_color_translation as PCT','PC.color_id','=','PCT.color_id')
            ->select(
                'PC.id as primaryKey',
                'PC.category_id',
                'UC.name as category_name',
                'PC.color_id',
                'PC.color_id',
                'PCT.color_name',
                'PC.price'
                )
            ->where('locale','=','en')
            ->orderBy('PC.id', 'DESC')
            ->get();
        //dd($price_color_arr);                       
        $this->arr_view_data['page_title']          = "Manage ".str_plural($this->module_title_color);
        $this->arr_view_data['module_title']        = $this->module_title_color;
        $this->arr_view_data['module_url_path']     = $this->module_url_path_color;
        $this->arr_view_data['price_color_arr']     = $price_color_arr;
        $this->arr_view_data['module_icon']         = $this->module_icon_color;
        return view($this->module_view_folder_color.'.index',$this->arr_view_data);
    }

    public function price_color_create(Request $request)
    {
        $category_arr = $color_arr = array();
        $category_arr   = DB::table('user_categories')
                            ->get();
        $color_arr      = DB::table('paper_color as PC')
                            ->join('paper_color_translation as PCT','PC.id','=','PCT.color_id')
                            ->select(
                                'PC.id',
                                'PCT.color_name'
                                )
                            ->where('PCT.locale','=','en')
                            ->where('PC.deleted_at','=',NULL)
                            ->get();


        if(isset($_POST['btn_add_price_color']))
        {
            $arr_rules['category']   = "required";
            $arr_rules['color']      = "required";
            $arr_rules['price']      = "required|numeric";
            $validator = Validator::make($request->all(),$arr_rules);
            if($validator->fails())
            {
                 return redirect()->back()->withErrors($validator)->withInput($request->all());
            }

            $is_present = DB::table('price_color as PC')
                            ->select('PC.id')
                            ->where('PC.category_id', '=', $request->input('category'))
                            ->where('PC.color_id', '=', $request->input('color'))
                            ->get();
            if(count($is_present) == 0)
            {
                $price_paper_color_insertArr = array(
                                            'category_id'   => $request->input('category'),
                                            'color_id'      => $request->input('color'),
                                            'price'         => $request->input('price')
                                          );
                $result = $this->MasterModel->insertRecord('price_color',$price_paper_color_insertArr);
                if($result)
                {
                   Flash::success($this->module_sub_title_color.' created successfully'); 
                }
                else
                {
                    Flash::error('Problem Occured, While Updating '.str_singular($this->module_sub_title_color));
                }
            }
            else
            {
                Flash::error('Price already exist for your selected Category & '.$this->module_sub_title_color.'.Please try with other price.');
            }
            return redirect()->back();
        }

        $this->arr_view_data['page_title']      = "Create ".$this->module_title_color;
        $this->arr_view_data['module_title']    = $this->module_title_color;
        $this->arr_view_data['module_url_path'] = $this->module_url_path_color;
        $this->arr_view_data['module_icon']     = $this->module_icon_color;
        $this->arr_view_data['category_arr']    = $category_arr;
        $this->arr_view_data['color_arr']       = $color_arr;
        return view($this->module_view_folder_color.'.create',$this->arr_view_data);
    }

    public function price_color_edit($enc_id)
    {
        $id = base64_decode($enc_id);
        $category_arr = $color_arr = array();
        
        $category_arr   = DB::table('user_categories')
                            ->get();

        $color_arr      = DB::table('paper_color as PC')
                            ->join('paper_color_translation as PCT','PC.id','=','PCT.color_id')
                            ->select(
                                'PC.id',
                                'PCT.color_name'
                                )
                            ->where('PCT.locale','=','en')
                            ->where('PC.deleted_at','=',NULL)
                            ->get();
        
        $price_paper_color = DB::table('price_color as PC')
                            ->where('PC.id','=',$id)
                            ->select(
                                'PC.id as primaryKey',
                                'PC.category_id',
                                'PC.color_id',
                                'PC.price'
                                )
                            ->get();
        
        $this->arr_view_data['edit_mode']       = true;
        $this->arr_view_data['enc_id']          = $enc_id;
        $this->arr_view_data['page_title']      = "Edit ".$this->module_title_color;
        $this->arr_view_data['module_title']    = $this->module_title_color;
        $this->arr_view_data['module_url_path'] = $this->module_url_path_color;
        $this->arr_view_data['module_icon']     = $this->module_icon_color;
        $this->arr_view_data['category_arr']    = $category_arr;
        $this->arr_view_data['color_arr']       = $color_arr;
        $this->arr_view_data['price_paper_color'] = $price_paper_color;
        return view($this->module_view_folder_color.'.edit',$this->arr_view_data);
    }

    public function price_color_update(Request $request)
    {
        $id = base64_decode($request->input('enc_id'));
        
        $arr_rules['category']   = "required";
        $arr_rules['color']      = "required";

        $arr_rules['category_id']   = "required";
        $arr_rules['color_id']       = "required";

        $arr_rules['price']      = "required|numeric";
        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {
             return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $is_present = DB::table('price_color as PC')
                            ->select('PC.id')
                            ->where('PC.id','!=', $id)

                            ->where('PC.price', '=', $request->input('price'))

                            ->where('PC.category_id', '=', $request->input('category_id'))
                            ->where('PC.color_id', '=', $request->input('color_id'))

                            ->get();

        if(count($is_present) == 0)
        {

            /*$price_paper_color_updateArr = array(
                                            'category_id'   => $request->input('category'),
                                            'color_id'      => $request->input('color'),
                                            'price'         => $request->input('price')
                                          );
            $this->MasterModel->updateRecord('price_color',array('id'=>$id),$price_paper_color_updateArr);
            Flash::success(str_singular($this->module_sub_title_color).' updated successfully');*/

            $price_paper_size_updateArr = array(
                                            'price'         => $request->input('price')
                                          );
            $this->MasterModel->updateRecord('price_color',array('id'=>$id),$price_paper_size_updateArr);
            Flash::success(str_singular($this->module_sub_title_size).' updated successfully');

        }
        else
        {
            Flash::error('Price already exist for your selected Category & '.$this->module_sub_title_color.'.Please try with other price.');
        }
        return redirect()->back();
    }

    public function price_color_actions($action_type,$enc_id)
    {
        $id = base64_decode($enc_id);
        switch($action_type){
            case 'delete':
                    $is_present = $this->MasterModel->getRecords('price_color',array('id'),'',array('id'=>$id),'','','','');
                    if(count($is_present) > 0)
                    {
                        $table = 'price_color';
                        $column_name = 'id';
                        $sub_table = '';
                        $sub_column_name = '';
                        $status = perform_delete($id,$table,$column_name,$sub_table,$sub_column_name);
                        if($status == 'true')
                        {
                            Flash::success(str_singular($this->module_sub_title_color).' deleted successfully');
                            return redirect()->back();
                        }
                        else
                        {
                            Flash::error("Problem occured when deleting ".$this->module_sub_title_color);
                            return redirect()->back();
                        }    
                    }
                    else
                    {
                        Flash::error("Problem occured when deleting ".$this->module_sub_title_color);
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

    public function price_color_multi_action(Request $request)
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
                $table = 'price_color';
                $column_name = 'id';
                $sub_table = '';
                $sub_column_name = '';
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

/******************************************** END : PAPER - COLOR ********************************************/


/******************************************** START : PRICE [PAPER - Brouchure] ********************************************/
    public function price_brochure_manage($catId= null)
    {
        /*$price_brochure_arr = DB::table('price_brochure as PB')
                        ->join('brochure_options as BO','BO.id','=','PB.brochure_id')
                        ->join('brochure_options_translation as BOT','BO.id','=','BOT.option_id')
                        ->join('user_categories as UC','PB.category_id','=','UC.id')
                        ->select(
                            'PB.id as primaryKey',
                            'PB.category_id',
                            'UC.name as category_name',
                            'PB.brochure_id',
                            'PB.price',
                            'BOT.option_name'
                            )
                        ->orderBy('category_name', 'DESC')
                        ->orderBy('option_name', 'DESC')
                        ->get();*/
        $price_brochure_arr = [];    
        $this->arr_view_data['page_title']        = "Manage ".str_plural($this->module_title_brochure);
        $this->arr_view_data['module_title']      = $this->module_title_brochure;
        $this->arr_view_data['module_url_path']   = $this->module_url_path_brochure;
        $this->arr_view_data['price_brochure_arr']    = $price_brochure_arr;
        $this->arr_view_data['module_icon']     = $this->module_icon_brochure;
        $this->arr_view_data['catId']           = $catId;
        return view($this->module_view_folder_brochure.'.index',$this->arr_view_data);
    }

     public function loadAllPriceBrouchure(Request $request )
    {
            $build_result ='';
            $obj_user        = $this->get_price_brochure_details($request);
            $current_context = $this;
            $json_result     = Datatables::of($obj_user);
            $json_result     = $json_result->blacklist(['id']);
            $json_result     = $json_result->editColumn('enc_id',function($data) use ($current_context)
                                {
                                    return base64_encode($data->primaryKey);
                                })
                              ->editColumn('build_action',function($data) use ($current_context)
                                {
                                     
                                    $build_edit_action_btn = '<a class="btn btn-primary btn-sm show-tooltip call_loader" title="Edit"  href="'.$this->module_url_path_brochure.'/edit/'.base64_encode($data->primaryKey).'"
                                         ><i class="fa fa-edit"></i></a>';
                               
                                    $build_delete_action_btn = '<a class="btn btn-danger btn-sm show-tooltip call_loader" title="Delete"  href="'.$this->module_url_path_brochure.'/action/delete/'.base64_encode($data->primaryKey).'" 
                                        onclick="return confirm_action(this,event,\'Do you really want to Delete this record ?\')" ><i class="fa fa-trash"></i></a>';
                                  
                                    return $build_action=$build_edit_action_btn.' '.$build_delete_action_btn;
                                }) 
                                ->make(true);

            $build_result = $json_result->getData();             

        return response()->json($build_result);
    }

    public function get_price_brochure_details(Request $request)
    {   
        $obj_price_size_arr  = DB::table('price_brochure as PB')
                                ->join('brochure_options as BO','BO.id','=','PB.brochure_id')
                                ->join('brochure_options_translation as BOT','BO.id','=','BOT.option_id')
                                ->join('user_categories as UC','PB.category_id','=','UC.id')
                                ->select(
                                    'PB.id as primaryKey',
                                    'PB.category_id',
                                    'UC.name as category_name',
                                    'PB.brochure_id',
                                    'PB.price',
                                    'BOT.option_name'
                                    )
                                ->orderBy('category_name', 'DESC')
                                ->orderBy('option_name', 'DESC');                     

       
        $arr_search_column = $request->input('column_filter');

        if(isset($arr_search_column['cat_id']) && $arr_search_column['cat_id'] != '' )
        {
            $cat_id = $arr_search_column['cat_id'];
            $obj_price_size_arr->where('PB.category_id','=',$cat_id);
        }
        
        if(isset($arr_search_column['q_price']) && $arr_search_column['q_price']!="")
        {
            $search_term      = $arr_search_column['q_price'];

            $obj_price_size_arr = $obj_price_size_arr->where('PB.price','LIKE', '%'.$search_term.'%');
        }

        if(isset($arr_search_column['q_category']) && $arr_search_column['q_category']!="")
        {
            $search_term      = $arr_search_column['q_category'];
            $obj_price_size_arr = $obj_price_size_arr->where('UC.name','LIKE', '%'.$search_term.'%');
        }

        if(isset($arr_search_column['q_option_name']) && $arr_search_column['q_option_name']!="")
        {
            $search_term      = $arr_search_column['q_option_name'];
            $obj_price_size_arr = $obj_price_size_arr->where('BOT.option_name','LIKE', '%'.$search_term.'%');
        }
        return $obj_price_size_arr;
    }


    public function price_brochure_create(Request $request)
    {
        $category_arr = $size_arr = array();
        $category_arr   = DB::table('user_categories')
                            ->get();

        $brochure_arr       = DB::table('brochure_options as BO')
                            ->select(
                                'BO.id',
                                'BOT.option_name'
                                )
                            ->join('brochure_options_translation as BOT','BO.id','=','BOT.option_id')
                            ->where('BO.is_active', '=', '1')
                            ->where('BOT.locale','=','en')
                            ->where('BO.deleted_at','=',NULL)
                            ->get();

        if(isset($_POST['btn_add_price_brochure']))
        {
            $arr_rules['category']   = "required";
            $arr_rules['brochure']   = "required";
            $arr_rules['price']      = "required|numeric";
            $validator = Validator::make($request->all(),$arr_rules);
            if($validator->fails())
            {
                 return redirect()->back()->withErrors($validator)->withInput($request->all());
            }

            $is_present = DB::table('price_brochure as PB')
                            ->select('PB.id')
                            ->where('PB.category_id','=',$request->input('category'))
                            ->where('PB.brochure_id','=', $request->input('brochure'))
                            ->get();

            if(count($is_present) == 0)
            {
                $price_paper_brochure_insertArr = array(
                                            'category_id'   => $request->input('category'),
                                            'brochure_id'       => $request->input('brochure'),
                                            'price'         => $request->input('price')
                                          );
                $result = $this->MasterModel->insertRecord('price_brochure',$price_paper_brochure_insertArr);
                if($result)
                {
                   Flash::success($this->module_sub_title_brochure.' created successfully'); 
                }
                else
                {
                    Flash::error('Problem Occured, While Updating '.str_singular($this->module_sub_title_brochure));
                }
            }
            else
            {
                Flash::error('Price already exist for your selected Category & Brochure .Please try with other price.');
            }
            return redirect()->back();
        }

        //dd($brouchure_arr);
        $this->arr_view_data['page_title']      = "Create ".$this->module_title_brochure;
        $this->arr_view_data['module_title']    = $this->module_title_brochure;
        $this->arr_view_data['module_url_path'] = $this->module_url_path_brochure;
        $this->arr_view_data['module_icon']     = $this->module_icon_brochure;
        $this->arr_view_data['category_arr']    = $category_arr;
        $this->arr_view_data['brochure_arr']        = $brochure_arr;
        return view($this->module_view_folder_brochure.'.create',$this->arr_view_data);
    }

    public function price_brochure_edit($enc_id)
    {
        $id = base64_decode($enc_id);
        $category_arr = $size_arr = array();
        $category_arr   = DB::table('user_categories')
                            ->get();

        $brochure_arr       = DB::table('brochure_options as BO')
                             ->select(
                                'BO.id',
                                'BOT.option_name'
                                )
                            ->join('brochure_options_translation as BOT','BO.id','=','BOT.option_id')
                            ->where('BO.is_active', '=', '1')
                            ->where('BOT.locale','=','en')
                            ->where('BO.deleted_at','=',NULL)
                            ->get();
        
        $price_paper_brochure = DB::table('price_brochure as PB')
                    ->where('PB.id','=',$id)
                    ->select(
                        'PB.id as primaryKey',
                        'PB.category_id',
                        'PB.brochure_id',
                        'PB.price'
                        )
                    ->get();
        $this->arr_view_data['edit_mode']       = true;
        $this->arr_view_data['enc_id']          = $enc_id;
        $this->arr_view_data['page_title']      = "Edit ".$this->module_title_brochure;
        $this->arr_view_data['module_title']    = $this->module_title_brochure;
        $this->arr_view_data['module_url_path'] = $this->module_url_path_brochure;
        $this->arr_view_data['module_icon']     = $this->module_icon_brochure;
        $this->arr_view_data['category_arr']    = $category_arr;
        $this->arr_view_data['brochure_arr']        = $brochure_arr;
        $this->arr_view_data['price_paper_brochure'] = $price_paper_brochure;
        return view($this->module_view_folder_brochure.'.edit',$this->arr_view_data);
    }

    public function price_brochure_update(Request $request)
    {
       $id = base64_decode($request->input('enc_id'));
        
        $arr_rules['category_id']   = "required";
        $arr_rules['brochure_id']   = "required";
        $arr_rules['price']      = "required|numeric";
        $validator = Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
             return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $is_present = DB::table('price_brochure as PB')
                            ->select('PB.id')
                            ->where('PB.id','!=', $id)
                            ->where('PB.category_id','=',$request->input('category_id'))
                            ->where('PB.brochure_id','=', $request->input('brochure_id'))
                            ->get();
        if(count($is_present) == 0)
        {
            $price_paper_brochure_updateArr = array(
                                            'price'         => $request->input('price')
                                          );
            $this->MasterModel->updateRecord('price_brochure',array('id'=>$id),$price_paper_brochure_updateArr);
            Flash::success(str_singular($this->module_sub_title_brochure).' updated successfully');
        }
        else
        {
            Flash::error('Price already exist for your selected Category & Brochure .Please try with other price.');
        }
        return redirect()->back();
    }

    public function price_brochure_actions($action_type,$enc_id)
    {
        $id = base64_decode($enc_id);
        switch($action_type){
            case 'delete':
                    $is_present = $this->MasterModel->getRecords('price_brochure',array('id'),'',array('id'=>$id),'','','','');
                    if(count($is_present) > 0)
                    {
                        $table = 'price_brochure';
                        $column_name = 'id';
                        $sub_table = '';
                        $sub_column_name = '';
                        $status = perform_delete($id,$table,$column_name,$sub_table,$sub_column_name);
                        if($status == 'true')
                        {
                            Flash::success(str_singular($this->module_sub_title_brochure).' deleted successfully');
                            return redirect()->back();
                        }
                        else
                        {
                            Flash::error("Problem occured when deleting ".$this->module_sub_title_brochure);
                            return redirect()->back();
                        }    
                    }
                    else
                    {
                        Flash::error("Problem occured when deleting ".$this->module_sub_title_brochure);
                        return redirect()->back();
                    }
            break;          
            default:
                Flash::error('Something went wrong, please check your code.');
                return redirect()->back();
            break;
        }
    }

    public function price_brochure_multi_action(Request $request)
    {
        $arr_rules                   = array();
        $arr_rules['multi_action']   = "required";
        $arr_rules['checked_record'] = "required";

        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {
            Flash::error('Please Select '.$this->module_title_brochure.' To Perform Multi Actions');
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
                $table = 'price_brochure';
                $column_name = 'id';
                $sub_table = '';
                $sub_column_name = '';
                perform_delete(base64_decode($record_id),$table,$column_name,$sub_table,$sub_column_name);
                Flash::success('Records deleted successfully');
            } 
           
        }
        return redirect()->back();
    }

/******************************************** END : PAPER - SIZE ********************************************/



/******************************************** START : PRICE [PAPER - Binding] ********************************************/
    public function price_binding_manage($catId = null)
    {
        /*$price_binding_arr = DB::table('price_binding as PB')
                        ->join('binding_options as BO','BO.id','=','PB.binding_id')
                        ->join('binding_options_translation as BOT','BO.id','=','BOT.option_id')
                        ->join('user_categories as UC','PB.category_id','=','UC.id')
                        ->select(
                            'PB.id as primaryKey',
                            'PB.category_id',
                            'UC.name as category_name',
                            'PB.binding_id',
                            'PB.price',
                            'BOT.option_name'
                            )
                        ->orderBy('category_name', 'DESC')
                        ->orderBy('option_name', 'DESC')
                        ->get();*/
        $price_binding_arr = [];
        $this->arr_view_data['page_title']        = "Manage ".str_plural($this->module_title_binding);
        $this->arr_view_data['module_title']      = $this->module_title_binding;
        $this->arr_view_data['module_url_path']   = $this->module_url_path_binding;
        $this->arr_view_data['price_binding_arr'] = $price_binding_arr;
        $this->arr_view_data['module_icon']     = $this->module_icon_binding;
        $this->arr_view_data['catId']           = $catId;
        return view($this->module_view_folder_binding.'.index',$this->arr_view_data);
    }

    public function loadAllPriceBinding(Request $request )
    {
        $build_result ='';
        $obj_user        = $this->get_price_binding_details($request);
        $current_context = $this;
        $json_result     = Datatables::of($obj_user);
        $json_result     = $json_result->blacklist(['id']);
        $json_result     = $json_result->editColumn('enc_id',function($data) use ($current_context)
                            {
                                return base64_encode($data->primaryKey);
                            })
                          ->editColumn('build_action',function($data) use ($current_context)
                            {
                                 
                                $build_edit_action_btn = '<a class="btn btn-primary btn-sm show-tooltip call_loader" title="Edit"  href="'.$this->module_url_path_binding.'/edit/'.base64_encode($data->primaryKey).'"
                                     ><i class="fa fa-edit"></i></a>';
                           
                                $build_delete_action_btn = '<a class="btn btn-danger btn-sm show-tooltip call_loader" title="Delete"  href="'.$this->module_url_path_binding.'/action/delete/'.base64_encode($data->primaryKey).'" 
                                    onclick="return confirm_action(this,event,\'Do you really want to Delete this record ?\')" ><i class="fa fa-trash"></i></a>';
                                return $build_action=$build_edit_action_btn.' '.$build_delete_action_btn;
                            }) 
                            ->make(true);

            $build_result = $json_result->getData();             

        return response()->json($build_result);
    }

    public function get_price_binding_details(Request $request)
    {   
        $obj_price_size_arr  = DB::table('price_binding as PB')
                            ->join('binding_options as BO','BO.id','=','PB.binding_id')
                            ->join('binding_options_translation as BOT','BO.id','=','BOT.option_id')
                            ->join('user_categories as UC','PB.category_id','=','UC.id')
                            ->select(
                                'PB.id as primaryKey',
                                'PB.category_id',
                                'UC.name as category_name',
                                'PB.binding_id',
                                'PB.price',
                                'BOT.option_name'
                                )
                            ->orderBy('category_name', 'DESC')
                            ->orderBy('option_name', 'DESC');                     

       
        $arr_search_column = $request->input('column_filter');
        if(isset($arr_search_column['cat_id']) && $arr_search_column['cat_id'] != '' )
        {
            $cat_id = $arr_search_column['cat_id'];
            $obj_price_size_arr->where('PB.category_id','=',$cat_id);
        }
        if(isset($arr_search_column['q_price']) && $arr_search_column['q_price']!="")
        {
            $search_term      = $arr_search_column['q_price'];

            $obj_price_size_arr = $obj_price_size_arr->where('PB.price','LIKE', '%'.$search_term.'%');
        }

        if(isset($arr_search_column['q_category']) && $arr_search_column['q_category']!="")
        {
            $search_term      = $arr_search_column['q_category'];
            $obj_price_size_arr = $obj_price_size_arr->where('UC.name','LIKE', '%'.$search_term.'%');
        }

        if(isset($arr_search_column['q_option_name']) && $arr_search_column['q_option_name']!="")
        {
            $search_term      = $arr_search_column['q_option_name'];
            $obj_price_size_arr = $obj_price_size_arr->where('BOT.option_name','LIKE', '%'.$search_term.'%');
        }

        return $obj_price_size_arr;
    }

    public function price_binding_create(Request $request)
    {
        
        $category_arr = $size_arr = array();
        $category_arr   = DB::table('user_categories')
                            ->get();

        $binding_arr       = DB::table('binding_options as BO')
                            ->select(
                                'BO.id',
                                'BOT.option_name'
                                )
                            ->join('binding_options_translation as BOT','BO.id','=','BOT.option_id')
                            ->where('BO.is_active', '=', '1')
                            ->where('BOT.locale','=','en')
                            ->where('BO.deleted_at','=',NULL)
                            ->get();

        if(isset($_POST['btn_add_price_binding']))
        {
            $arr_rules['category']   = "required";
            $arr_rules['binding']    = "required";
            $arr_rules['price']      = "required"; 
            //$arr_rules['price']      = "required|numeric";
            $validator = Validator::make($request->all(),$arr_rules);
            if($validator->fails())
            {
                 return redirect()->back()->withErrors($validator)->withInput($request->all());
            }

            $is_present = DB::table('price_binding as PB')
                            ->select('PB.id')
                            ->where('PB.category_id','=',$request->input('category'))
                            ->where('PB.binding_id','=', $request->input('binding'))
                            ->get();

            if(count($is_present) == 0)
            {
                $price_paper_binding_insertArr = array(
                                            'category_id'   => $request->input('category'),
                                            'binding_id'       => $request->input('binding'),
                                            'price'         => $request->input('price')
                                          );
                $result = $this->MasterModel->insertRecord('price_binding',$price_paper_binding_insertArr);
                if($result)
                {
                   Flash::success($this->module_sub_title_binding.' created successfully'); 
                }
                else
                {
                    Flash::error('Problem Occured, While Updating '.str_singular($this->module_sub_title_binding));
                }
            }
            else
            {
                Flash::error('Price already exist for your selected Category & Binding .Please try with other price.');
            }
            return redirect()->back();
        }

        //dd($brouchure_arr);
        $this->arr_view_data['page_title']      = "Create ".$this->module_title_binding;
        $this->arr_view_data['module_title']    = $this->module_title_binding;
        $this->arr_view_data['module_url_path'] = $this->module_url_path_binding;
        $this->arr_view_data['module_icon']     = $this->module_icon_binding;
        $this->arr_view_data['category_arr']    = $category_arr;
        $this->arr_view_data['binding_arr']        = $binding_arr;
        return view($this->module_view_folder_binding.'.create',$this->arr_view_data);
    }

    public function price_binding_edit($enc_id)
    {
        $id = base64_decode($enc_id);
        $category_arr = $size_arr = array();
        $category_arr   = DB::table('user_categories')
                            ->get();

        $binding_arr       = DB::table('binding_options as BO')
                            ->select(
                                'BO.id',
                                'BOT.option_name'
                                )
                            ->join('binding_options_translation as BOT','BO.id','=','BOT.option_id')
                            ->where('BO.is_active', '=', '1')
                            ->where('BOT.locale','=','en')
                            ->where('BO.deleted_at','=',NULL)
                            ->get();
        
        $price_paper_binding = DB::table('price_binding as PB')
                    ->where('PB.id','=',$id)
                    ->select(
                        'PB.id as primaryKey',
                        'PB.category_id',
                        'PB.binding_id',
                        'PB.price'
                        )
                    ->get();
        $this->arr_view_data['edit_mode']       = true;
        $this->arr_view_data['enc_id']          = $enc_id;
        $this->arr_view_data['page_title']      = "Edit ".$this->module_title_binding;
        $this->arr_view_data['module_title']    = $this->module_title_binding;
        $this->arr_view_data['module_url_path'] = $this->module_url_path_binding;
        $this->arr_view_data['module_icon']     = $this->module_icon_binding;
        $this->arr_view_data['category_arr']    = $category_arr;
        $this->arr_view_data['binding_arr']     = $binding_arr;
        $this->arr_view_data['price_paper_binding'] = $price_paper_binding;
        return view($this->module_view_folder_binding.'.edit',$this->arr_view_data);
    }

    public function price_binding_update(Request $request)
    {
        $id = base64_decode($request->input('enc_id'));
        
        $arr_rules['category_id']   = "required";
        $arr_rules['binding_id']   = "required";
        /*$arr_rules['price']      = "required|numeric";*/
        $arr_rules['price']      = "required";
        $validator = Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
             return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $is_present = DB::table('price_binding as PB')
                            ->select('PB.id')
                            ->where('PB.id','!=', $id)
                            ->where('PB.category_id','=',$request->input('category_id'))
                            ->where('PB.binding_id','=', $request->input('binding_id'))
                            ->get();
        if(count($is_present) == 0)
        {
            $price_paper_binding_updateArr = array(
                                            'price'         => $request->input('price')
                                          );
            $this->MasterModel->updateRecord('price_binding',array('id'=>$id),$price_paper_binding_updateArr);
            Flash::success(str_singular($this->module_sub_title_binding).' updated successfully');
        }
        else
        {
            Flash::error('Price already exist for your selected Category & Binding .Please try with other price.');
        }
        return redirect()->back();
    }

    public function price_binding_actions($action_type,$enc_id)
    {
        $id = base64_decode($enc_id);
        switch($action_type){
            case 'delete':
                    $is_present = $this->MasterModel->getRecords('price_binding',array('id'),'',array('id'=>$id),'','','','');
                    if(count($is_present) > 0)
                    {
                        $table = 'price_binding';
                        $column_name = 'id';
                        $sub_table = '';
                        $sub_column_name = '';
                        $status = perform_delete($id,$table,$column_name,$sub_table,$sub_column_name);
                        if($status == 'true')
                        {
                            Flash::success(str_singular($this->module_sub_title_binding).' deleted successfully');
                            return redirect()->back();
                        }
                        else
                        {
                            Flash::error("Problem occured when deleting ".$this->module_sub_title_binding);
                            return redirect()->back();
                        }    
                    }
                    else
                    {
                        Flash::error("Problem occured when deleting ".$this->module_sub_title_binding);
                        return redirect()->back();
                    }
            break;          
            default:
                Flash::error('Something went wrong, please check your code.');
                return redirect()->back();
            break;
        }
    }

    public function price_binding_multi_action(Request $request)
    {
        $arr_rules                   = array();
        $arr_rules['multi_action']   = "required";
        $arr_rules['checked_record'] = "required";

        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {
            Flash::error('Please Select '.$this->module_title_binding.' To Perform Multi Actions');
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
                $table = 'price_binding';
                $column_name = 'id';
                $sub_table = '';
                $sub_column_name = '';
                perform_delete(base64_decode($record_id),$table,$column_name,$sub_table,$sub_column_name);
                Flash::success('Records deleted successfully');
            } 
           
        }
        return redirect()->back();
    }

/******************************************** END : PAPER - SIZE ********************************************/

/******************************************** START : PRICE [PAPER - Printing] ********************************************/
    public function price_printing_manage($catId = null)
    {
        /*$price_binding_arr = DB::table('price_printing as PP')
                                    ->select(
                                            'PP.id as primaryKey',
                                            'PP.category_id',
                                            'UC.name as category_name',
                                            'PP.price',
                                            'PCT.color_name',
                                            'PS.size_name' )
                                    ->join('user_categories as UC','PP.category_id','=','UC.id')
                                    ->join('paper_color as PC','PP.colour_id','=','PC.id')
                                    ->join('paper_color_translation as PCT','PC.id','=','PCT.color_id')
                                    ->join('paper_size as PS','PP.size_id','=','PS.id')
                                    ->where('PCT.locale' ,'=', 'en')
                                    ->orderBy('category_name', 'DESC')
                                    ->orderBy('size_name', 'DESC')
                                    ->get();*/
        $price_binding_arr = [];
        $this->arr_view_data['page_title']        = "Manage ".str_plural($this->module_title_printing);
        $this->arr_view_data['module_title']      = $this->module_title_printing;
        $this->arr_view_data['module_url_path']   = $this->module_url_path_printing;
        $this->arr_view_data['price_binding_arr'] = $price_binding_arr;
        $this->arr_view_data['module_icon']       = $this->module_icon_printing;
        $this->arr_view_data['catId']             = $catId;
        return view($this->module_view_folder_printing.'.index',$this->arr_view_data);
    }

     public function loadAllPricePrinting(Request $request )
    {
            $build_result ='';
            $obj_user        = $this->get_price_printing_details($request);
            $current_context = $this;
            $json_result     = Datatables::of($obj_user);
            $json_result     = $json_result->blacklist(['id']);
            $json_result     = $json_result->editColumn('enc_id',function($data) use ($current_context)
                                {
                                    return base64_encode($data->primaryKey);
                                })
                              ->editColumn('build_action',function($data) use ($current_context)
                                {
                                    $build_edit_action_btn = '<a class="btn btn-primary btn-sm show-tooltip call_loader" title="Edit"  href="'.$this->module_url_path_printing.'/edit/'.base64_encode($data->primaryKey).'"
                                         ><i class="fa fa-edit"></i></a>';
                               
                                    $build_delete_action_btn = '<a class="btn btn-danger btn-sm show-tooltip call_loader" title="Delete"  href="'.$this->module_url_path_printing.'/action/delete/'.base64_encode($data->primaryKey).'" 
                                        onclick="return confirm_action(this,event,\'Do you really want to Delete this record ?\')" ><i class="fa fa-trash"></i></a>';
                                  
                                    return $build_action=$build_edit_action_btn.' '.$build_delete_action_btn;
                                }) 
                                ->make(true);

            $build_result = $json_result->getData();             

        return response()->json($build_result);
    }

    public function get_price_printing_details(Request $request)
    {
        $obj_price_size_arr  = DB::table('price_printing as PP')
                            ->select(
                                    'PP.id as primaryKey',
                                    'PP.category_id',
                                    'UC.name as category_name',
                                    'PP.price',
                                    'PCT.color_name',
                                    'PS.size_name' )
                            ->join('user_categories as UC','PP.category_id','=','UC.id')
                            ->join('paper_color as PC','PP.colour_id','=','PC.id')
                            ->join('paper_color_translation as PCT','PC.id','=','PCT.color_id')
                            ->join('paper_size as PS','PP.size_id','=','PS.id')
                            ->where('PCT.locale' ,'=', 'en')
                            ->orderBy('category_name', 'DESC')
                            ->orderBy('size_name', 'DESC');                     

       
        $arr_search_column = $request->input('column_filter');

        if(isset($arr_search_column['cat_id']) && $arr_search_column['cat_id'] != '' )
        {
            $cat_id = $arr_search_column['cat_id'];
            $obj_price_size_arr->where('PP.category_id','=',$cat_id);
        }
        
        if(isset($arr_search_column['q_category']) && $arr_search_column['q_category']!="")
        {
            $search_term      = $arr_search_column['q_category'];

            $obj_price_size_arr = $obj_price_size_arr->where('UC.name','LIKE', '%'.$search_term.'%');
        }

        if(isset($arr_search_column['q_size']) && $arr_search_column['q_size']!="")
        {
            $search_term      = $arr_search_column['q_size'];
            $obj_price_size_arr = $obj_price_size_arr->where('PS.size_name','LIKE', '%'.$search_term.'%');
        }

        if(isset($arr_search_column['q_color']) && $arr_search_column['q_color']!="")
        {
            $search_term      = $arr_search_column['q_color'];
            $obj_price_size_arr = $obj_price_size_arr->where('PCT.color_name','LIKE', '%'.$search_term.'%');
        }

         if(isset($arr_search_column['q_price']) && $arr_search_column['q_price']!="")
        {
            $search_term      = $arr_search_column['q_price'];
            $obj_price_size_arr = $obj_price_size_arr->where('PP.price','LIKE', '%'.$search_term.'%');
        }
    

        return $obj_price_size_arr;
    }


    public function price_printing_create(Request $request)
    {
        $category_arr = $size_arr = array();
        $category_arr   = DB::table('user_categories')->get();

        if(isset($_POST['btn_add_price_printing']))
        {
            $arr_rules['category']   = "required";
            $arr_rules['price']      = "required|numeric";
            $arr_rules['paperSize']  = "required";
            $arr_rules['paperColor'] = "required";

            $validator = Validator::make($request->all(),$arr_rules);
            if($validator->fails())
            {
                 return redirect()->back()->withErrors($validator)->withInput($request->all());
            }

            $is_present = DB::table('price_printing as PP')
                                        ->select('PP.id')
                                        ->where('PP.category_id','=',$request->input('category'))
                                        ->where('PP.size_id','=',$request->input('paperSize'))
                                        ->where('PP.colour_id','=',$request->input('paperColor'))
                                        ->get();

            if(count($is_present) == 0)
            {
                $price_paper_printing_insertArr = array(
                                                'category_id' => $request->input('category'),
                                                'price'       => $request->input('price'),
                                                'size_id'     => $request->input('paperSize'),
                                                'colour_id'   => $request->input('paperColor')
                                            );
                $result = $this->MasterModel->insertRecord('price_printing',$price_paper_printing_insertArr);
                if($result)
                {
                   Flash::success($this->module_sub_title_printing.' created successfully'); 
                }
                else
                {
                    Flash::error('Problem Occured, While Updating '.str_singular($this->module_sub_title_printing));
                }
            }
            else
            {
                Flash::error('Price already exist for your selected Category, Printing, Size & Color .Please try with other price.');
            }
            return redirect()->back();
        }

        $selectCols   = array('TPC.id AS primaryKey','TPCT.color_name AS paperColor');
        $joinArray    = array('join'=>array('paper_color_translation AS TPCT','TPCT.color_id','=','TPC.id','left'));
        $whrCondition = array('TPCT.locale' => 'en');
        $resPaperColor = $this->MasterModel->getRecords('paper_color AS TPC',$selectCols,$joinArray,$whrCondition,'TPCT.color_name','asc');

        $selectCols = array('TPS.id AS primaryKey','TPS.size_name AS paperSize');
        $resPaperSize = $this->MasterModel->getRecords('paper_size AS TPS',$selectCols);

        $this->arr_view_data['page_title']      = "Create ".$this->module_title_printing;
        $this->arr_view_data['module_title']    = $this->module_title_printing;
        $this->arr_view_data['module_url_path'] = $this->module_url_path_printing;
        $this->arr_view_data['module_icon']     = $this->module_icon_printing;
        $this->arr_view_data['category_arr']    = $category_arr;
        $this->arr_view_data['resPaperSize']    = $resPaperSize;
        $this->arr_view_data['resPaperColor']   = $resPaperColor;
       return view($this->module_view_folder_printing.'.create',$this->arr_view_data);
    }

    public function price_printing_edit($enc_id)
    {
        $id = base64_decode($enc_id);
        $category_arr = $size_arr = array();
        $category_arr   = DB::table('user_categories')->get();
        
        $price_paper_printing = DB::table('price_printing as PP')
                                            ->select('PP.id as primaryKey','PP.category_id','PP.price', 'PP.colour_id', 'PP.size_id' )
                                            ->where('PP.id','=',$id)
                                            ->first();

        $selectCols   = array('TPC.id AS primaryKey','TPCT.color_name AS paperColor');
        $joinArray    = array('join'=>array('paper_color_translation AS TPCT','TPCT.color_id','=','TPC.id','left'));
        $whrCondition = array('TPCT.locale' => 'en');
        $resPaperColor = $this->MasterModel->getRecords('paper_color AS TPC',$selectCols,$joinArray,$whrCondition,'TPCT.color_name','asc');

        $selectCols = array('TPS.id AS primaryKey','TPS.size_name AS paperSize');
        $resPaperSize = $this->MasterModel->getRecords('paper_size AS TPS',$selectCols);
        
        $this->arr_view_data['edit_mode']       = true;
        $this->arr_view_data['enc_id']          = $enc_id;
        $this->arr_view_data['page_title']      = "Edit ".$this->module_title_printing;
        $this->arr_view_data['module_title']    = $this->module_title_printing;
        $this->arr_view_data['module_url_path'] = $this->module_url_path_printing;
        $this->arr_view_data['module_icon']     = $this->module_icon_printing;
        $this->arr_view_data['category_arr']    = $category_arr;
       $this->arr_view_data['price_paper_printing'] = $price_paper_printing;
       $this->arr_view_data['resPaperSize'] = $resPaperSize;
       $this->arr_view_data['resPaperColor'] = $resPaperColor;
        return view($this->module_view_folder_printing.'.edit',$this->arr_view_data);
    }

    public function price_printing_update(Request $request)
    {
        $id = base64_decode($request->input('enc_id'));
        
        // $arr_rules['category_id']   = "required";
        $arr_rules['price']         = "required|numeric";
        
        $validator = Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
             return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $is_present = DB::table('price_printing as PP')
                                ->select('PP.id')
                                ->where('PP.id','!=', $id)
                                ->where('PP.category_id','=',$request->input('category'))
                                ->where('PP.size_id','=',$request->input('paperSize'))
                                ->where('PP.colour_id','=',$request->input('paperColor'))
                                ->get();

        if(count($is_present) == 0)
        {
            $price_paper_printing_updateArr = array('price'       => $request->input('price'));
            $this->MasterModel->updateRecord('price_printing',array('id'=>$id),$price_paper_printing_updateArr);
            Flash::success(str_singular($this->module_sub_title_printing).' updated successfully');
        }
        else
        {
            Flash::error('Price already exist for your selected Category, Printing, Size & Colour .Please try with other price.');
        }
        return redirect()->back();
    }

    public function price_printing_actions($action_type,$enc_id)
    {
        $id = base64_decode($enc_id);
        switch($action_type){
            case 'delete':
                    $is_present = $this->MasterModel->getRecords('price_printing',array('id'),'',array('id'=>$id),'','','','');
                    if(count($is_present) > 0)
                    {
                        $table = 'price_printing';
                        $column_name = 'id';
                        $sub_table = '';
                        $sub_column_name = '';
                        $status = perform_delete($id,$table,$column_name,$sub_table,$sub_column_name);
                        if($status == 'true')
                        {
                            Flash::success(str_singular($this->module_sub_title_printing).' deleted successfully');
                            return redirect()->back();
                        }
                        else
                        {
                            Flash::error("Problem occured when deleting ".$this->module_sub_title_printing);
                            return redirect()->back();
                        }    
                    }
                    else
                    {
                        Flash::error("Problem occured when deleting ".$this->module_sub_title_printing);
                        return redirect()->back();
                    }
            break;          
            default:
                Flash::error('Something went wrong, please check your code.');
                return redirect()->back();
            break;
        }
    }

    public function price_printing_multi_action(Request $request)
    {
        $arr_rules                   = array();
        $arr_rules['multi_action']   = "required";
        $arr_rules['checked_record'] = "required";

        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {
            Flash::error('Please Select '.$this->module_title_binding.' To Perform Multi Actions');
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
                $table = 'price_printing';
                $column_name = 'id';
                $sub_table = '';
                $sub_column_name = '';
                perform_delete(base64_decode($record_id),$table,$column_name,$sub_table,$sub_column_name);
                Flash::success('Records deleted successfully');
            } 
           
        }
        return redirect()->back();
    }

/******************************************** END : PAPER - SIZE ********************************************/
}
