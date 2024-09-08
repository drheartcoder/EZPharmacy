<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Common\Traits\MultiActionTrait;


use App\Models\LoginModel; 
use App\Models\LoginUserDetailModel; 
use App\Models\ColorModel;  
use Validator;
use Session;
use Flash;
use DB;
use Datatables;

class ConsumerController extends Controller
{
    use MultiActionTrait;

    public function __construct(
    								LoginModel $consumers,
    								LoginUserDetailModel $consumersDetails,
                                    ColorModel $color
                                 )
    {

       $this->module_title         = "Consumers";
       $this->module_url_slug      = "Consumers";
       $this->module_url_path      = url(config('app.project.admin_panel_slug')."/consumers/");
       $this->module_view_folder   = 'admin.consumers';

       $this->LoginModel                    = $consumers;
       $this->BaseModel                     = $this->LoginModel;
       $this->LoginUserDetailModel          = $consumersDetails;
       $this->user_profile_public_img_path  = url('/').'/uploads/all_users/profile';
       $this->module_icon                   = "fa-users";

       $this->tbl_user_categories = 'user_categories';
    }

    public function index()
    {
        $arr_categories = DB::table($this->tbl_user_categories.' as UC')
                                        //->orderBy('UC.id', 'DESC')
                                        ->get();

        $this->arr_view_data['page_title']        = "Manage ".str_plural($this->module_title);
        $this->arr_view_data['module_title']      = $this->module_title;
        $this->arr_view_data['module_url_path']   = $this->module_url_path;
        $this->arr_view_data['module_icon']       = $this->module_icon;
        $this->arr_view_data['arr_categories']    = $arr_categories;
        return view($this->module_view_folder.'.index',$this->arr_view_data);
    }
    
    public function loadAll(Request $request)
    {
    	$obj_user        = $this->get_users_details($request);

        $current_context = $this;
      
        $json_result     = Datatables::of($obj_user);
        
        $json_result     = $json_result->blacklist(['id']);
        
        $json_result     = $json_result->editColumn('enc_id',function($data) use ($current_context)
                            {
                                return base64_encode($data->id);
                            })
                            ->editColumn('category_name',function($data) use ($current_context)
                            {
                                return isset($data->category_name) && $data->category_name != "" ? $data->category_name : "Default";
                            })
                            ->editColumn('build_status_btn',function($data) use ($current_context)
                            {
                                if($data->is_active != null && $data->is_active == '0')
                                {   
                                    $build_status_btn = '<a class="btn btn-danger btn-sm show-tooltip call_loader" title="Lock"  href="'.$this->module_url_path.'/activate/'.base64_encode($data->id).'"
                                        onclick="return confirm_action(this,event,\'Do you really want to Activate this record ?\')" ><i class="fa fa-lock"></i></a>';
                                }
                                elseif($data->is_active != null && $data->is_active == '1')
                                {
                                    $build_status_btn = '<a class="btn btn-success btn-sm show-tooltip call_loader" title="Unlock"  href="'.$this->module_url_path.'/deactivate/'.base64_encode($data->id).'" 
                                        onclick="return confirm_action(this,event,\'Do you really want to Deactivate this record ?\')" ><i class="fa fa-unlock"></i></a>';
                                }
                                return $build_status_btn;
                            }) 
                            ->editColumn('build_action_btn',function($data) use ($current_context)
                            {       
                                $build_edit_action = "";
                                /*$edit_href =  $this->module_url_path.'/edit/'.base64_encode($data->id);
                                $build_edit_action = '<a class="btn btn-primary btn-sm show-tooltip call_loader" href="'.$edit_href.'" title="Edit"><i class="fa fa-edit" ></i></a>';*/

                                $view_href =  $this->module_url_path.'/view/'.base64_encode($data->id);
                                $build_view_action = '<a class="btn btn-warning btn-sm show-tooltip call_loader" href="'.$view_href.'" title="View"><i class="fa fa-eye" ></i></a>';
                                
                                $build_wallet_action='';

                                /*$wallet_href         = $this->module_url_path.'/wallet/'.base64_encode($data->id);
                                $build_wallet_action = '<a class="btn btn-info btn-sm show-tooltip call_loader" href="'.$wallet_href.'" title="Wallet"><i class="fa fa-google-wallet" ></i></a>';*/

                                $delete_href =  $this->module_url_path.'/delete/'.base64_encode($data->id);
                                $confirm_delete =  'onclick="return confirm_action(this,event,\'Do you really want to delete this record ?\')"';

                                $build_delete_action = '<a class="btn btn-danger btn-sm show-tooltip call_loader" '.$confirm_delete.' href="'.$delete_href.'" title="Delete"><i class="fa fa-trash" ></i></a>';

                                return $build_action = $build_wallet_action.' '.$build_edit_action.' '.$build_view_action.' '.$build_delete_action;
                            })
                            ->make(true);

        $build_result = $json_result->getData();

        return response()->json($build_result);
    }


    public function get_users_details(Request $request)
    {   
        $consumer_table             = $this->BaseModel->getTable();
        $prefixed_consumer_table    = DB::getTablePrefix().$this->BaseModel->getTable();

        $user_details_table          = $this->LoginUserDetailModel->getTable();
        $prefixed_user_details_table   = DB::getTablePrefix().$this->LoginUserDetailModel->getTable();

        $obj_user = DB::table($consumer_table)
                                ->select(DB::raw($prefixed_consumer_table.".id as id,".
                                                 $prefixed_consumer_table.".user_type as user_type, ".
                                                 $prefixed_consumer_table.".email_address as email_address ,".
                                                 $prefixed_consumer_table.".is_active as is_active ,".
                                                 $prefixed_user_details_table.".full_name as full_name, ".
                                                 $prefixed_consumer_table.".mobile_number as mobile_number, ".
                                                 "tbl_user_categories.name as category_name "
                                                ))
                                ->whereNull($consumer_table.'.deleted_at')
                                ->where($consumer_table.'.user_type','consumer')  
                                ->Join($user_details_table,$user_details_table.'.login_id','=',$consumer_table.'.id')
                                ->leftJoin('user_categories','user_categories.id','=',$consumer_table.'.category_id')
                                ->orderBy($consumer_table.'.created_at','DESC');                      

        /* ---------------- Filtering Logic ----------------------------------*/                    

        $arr_search_column = $request->input('column_filter');
        
        if(isset($arr_search_column['q_name']) && $arr_search_column['q_name']!="")
        {
            $search_term      = $arr_search_column['q_name'];

            $obj_user = $obj_user->where($user_details_table.'.full_name','LIKE', '%'.$search_term.'%');
        }

        if(isset($arr_search_column['q_mobile_no']) && $arr_search_column['q_mobile_no']!="")
        {
            $search_term      = $arr_search_column['q_mobile_no'];
            $obj_user = $obj_user->where($consumer_table.'.mobile_number','LIKE', '%'.$search_term.'%');
        }

        if(isset($arr_search_column['q_email']) && $arr_search_column['q_email']!="")
        {
            $search_term      = $arr_search_column['q_email'];
            $obj_user = $obj_user->where($consumer_table.'.email_address','LIKE', '%'.$search_term.'%');
        }

        if(isset($arr_search_column['q_category_name']) && $arr_search_column['q_category_name']!="")
        {
            $search_term      = $arr_search_column['q_category_name'];
            $obj_user = $obj_user->where('user_categories.name','LIKE', '%'.$search_term.'%');
        }

        return $obj_user;
    }

    public function view($enc_id)
    {
        $id = base64_decode($enc_id);

        $obj_consumer = $this->BaseModel->where('id',$id)
                                      ->with('user_details.country_details')  
                                      ->first();
        if($obj_consumer)
        {
            $arr_consumer = $obj_consumer->toArray();
        }

        $this->arr_view_data['page_title']                   = "View ".str_singular($this->module_title);
        $this->arr_view_data['module_title']                 = str_plural($this->module_title);
        $this->arr_view_data['module_url_path']              = $this->module_url_path;
        $this->arr_view_data['arr_consumer']                 = $arr_consumer;
        $this->arr_view_data['module_icon']                  = $this->module_icon;
       	$this->arr_view_data['user_profile_public_img_path'] = $this->user_profile_public_img_path;

        return view($this->module_view_folder.'.view', $this->arr_view_data);
    }

    public function edit($enc_id)
    {
        $id = base64_decode($enc_id);

        $obj_consumer = $this->BaseModel->where('id',$id)
                                      ->with('user_details')  
                                      ->first();

        if($obj_consumer)
        {
            $arr_consumer = $obj_consumer->toArray();
        }

        $this->arr_view_data['page_title']                   = "Edit ".str_singular($this->module_title);
        $this->arr_view_data['module_title']                 = str_plural($this->module_title);
        $this->arr_view_data['module_url_path']              = $this->module_url_path;
        $this->arr_view_data['arr_data']                     = $arr_consumer;
        $this->arr_view_data['module_icon']                  = $this->module_icon;
        $this->arr_view_data['user_profile_public_img_path'] = $this->user_profile_public_img_path;

        return view($this->module_view_folder.'.edit', $this->arr_view_data);
    }    

    public function update(Request $request)
    {
    	$arr_rules['id']                = "required";
        $arr_rules['first_name']        = "required";
        $arr_rules['last_name']         = "required";
        $arr_rules['email_address']     = "required";
        $arr_rules['mobile_number']     = "required";

        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
           
        $arr_login_data['email_address'] = $request->input('email_address');
        $arr_login_data['mobile_number']  = $request->input('mobile_number');

        $arr_user_data['first_name']     = $request->input('first_name');
        $arr_user_data['last_name']      = $request->input('last_name');
        $arr_user_data['full_name']      = $request->input('first_name').' '.$request->input('last_name');
       
        $obj_user = $this->BaseModel->where('id','=', $request->input('id'))
                                    ->update($arr_login_data);


        if(isset($arr_user_data) && sizeof($arr_user_data)>0)
        {   
            $obj_client = $this->LoginUserDetailModel
            					->where('login_id',$request->input('id'))
                                ->update($arr_user_data);      
        }                              

        if($obj_client)
        {
            /*-------------------------------------------------------
            |   Activity log Event
            --------------------------------------------------------*/
                /*$arr_event                 = [];
                $arr_event['ACTION']       = 'Update';
                $arr_event['MODULE_TITLE'] = $this->module_title;

                $this->save_activity($arr_event);*/
            /*-------------------------------------------------------*/
            Flash::success(str_singular($this->module_title).' Updated Successfully');
        }
        else
        {
            Flash::error('Problem Occured While Updating '.str_singular($this->module_title));
        }   

        return redirect()->back();      
    }

    /*-----------------------------------------------------------
    |   Following function assign category to selected consumers
    ------------------------------------------------------------*/
    public function action_user_category(Request $request)
    {   
        $arr_insert = [];
        $error_while_assigning = true;

        $arr_user     = $request->input('arr_user');
        $category_id  = $request->input('category_id');

        DB::beginTransaction();
        if(is_array($arr_user) && count($arr_user) > 0)
        {       
            foreach ($arr_user as $key => $user) 
            {   
                if($user != "")
                {   
                    $id_assigned = false;

                    if($request->input('perform_action') == 'ASSIGN' && $category_id != "")
                    {
                        $id_assigned = $this->LoginModel->where('id',base64_decode($user))->update(['category_id' => $category_id]);
                    }

                    /*if($request->input('perform_action') == 'REMOVE')
                    {
                        $id_assigned = $this->LoginModel->where('id',base64_decode($user))->update(['category_id' => "0"]);
                    }*/
                    
                    if($id_assigned == false)
                    {
                        $error_while_assigning = false;
                    }
                }
            }
        }
        
        if($error_while_assigning == true)
        {
            DB::commit();
            if($request->input('perform_action') == 'ASSIGN')
            {
                Flash::success('Category assigned successfully.');
                $arr_response['msg']          = 'Category assigned successfully.';
            }

            /*if($request->input('perform_action') == 'REMOVE')
            {
                Flash::success('Category removed successfully.');
                $arr_response['msg']          = 'Category removed successfully.';
            }*/

            $arr_response['status']       = 'SUCCESS';
        }
        else
        {
            DB::rollback();
            
            $arr_response['status']       = 'ERROR';
            $arr_response['msg']          = 'Error occured while performing action.';
            
            if($request->input('perform_action') == 'ASSIGN')
            {
                Flash::error('Error occured while assigning category');
                $arr_response['msg']          = 'Error occured while assigning category';
            }

            /*if($request->input('perform_action') == 'REMOVE')
            {
                Flash::error('Error occured while removing category');
                $arr_response['msg']          = 'Error occured while removing category';
            }*/
        }
        return response()->json($arr_response);
    }

}
