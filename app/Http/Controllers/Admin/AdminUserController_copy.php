<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\UserModel;
use App\Events\ActivityLogEvent;
use App\Models\ActivityLogsModel;
use Validator;
use Session;
use Sentinel;
use Flash;
use App\Models\MasterModel;

use App\Common\Traits\MultiActionTrait;

use DB;

class AdminUserController extends Controller
{
    use MultiActionTrait;

    public function __construct(
                                UserModel $user,
                                ActivityLogsModel $activity_logs
                                ) 
    {
        $this->UserModel          = $user;
        $this->BaseModel          = $this->UserModel;
        $this->ActivityLogsModel  = $activity_logs;

        $this->arr_view_data      = [];
        $this->admin_url_path     = url(config('app.project.admin_panel_slug'));

        $this->module_title       = "Admin Users";
        $this->module_view_folder = "admin.admin_users";
        $this->module_url_path    = $this->admin_url_path."/admin_users";
        
        $this->theme_color        = theme_color();
    }

    public function index()
    {
        $arr_users = array();
        /*$obj_users = Sentinel::createModel()->whereHas('roles',function($query)
                                                {
                                                   return $query->whereIn('slug',['admin']);
                                                })
                                            ->orWhereHas('roles',function($query)
                                                {
                                                   return $query->whereIn('slug',['operator']);
                                                })
                                            ->get();*/

        $obj_users = Sentinel::createModel()->whereHas('roles',function($query)
                                                {
                                                   return $query->whereIn('slug',['operator']);
                                                })
                                            ->orderBy('id','DESC')
                                            ->get();
        

        $is_last_user = count($obj_users)==1?true:false;

        $this->arr_view_data['is_last_user']    = $is_last_user;
        $this->arr_view_data['obj_users']       = $obj_users;
        $this->arr_view_data['page_title']      = "Manage ".str_singular( $this->module_title);
        $this->arr_view_data['module_title']    = str_plural($this->module_title);
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['theme_color']     = $this->theme_color;

        return view($this->module_view_folder.'.index',$this->arr_view_data);
    }

    public function create()
    {
        /*$obj_role = Sentinel::getRoleRepository()->createModel()->whereIn('slug',['admin'])
                                                                ->orWhereIn('slug',['operator']);*/
        
        $obj_role = Sentinel::getRoleRepository()->createModel()->whereIn('slug',['operator']);
        
        $obj_role = $obj_role->get(); 
        
        if( $obj_role != false)
        {
            $arr_roles = $obj_role->toArray();
        }

        $this->arr_view_data['arr_roles']       = $arr_roles;
        $this->arr_view_data['page_title']      = "Create ".str_singular( $this->module_title);
        $this->arr_view_data['module_title']    = str_plural($this->module_title);
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['theme_color']     = $this->theme_color;

        return view($this->module_view_folder.'.create',$this->arr_view_data);
    }

    public function store(Request $request)
    {
    	$arr_rules = [];

        $arr_rules['first_name'] = "required";
        $arr_rules['last_name']  = "required";
        $arr_rules['email']      = "required";
        $arr_rules['password']   = "required|confirmed";

    	$validator = Validator::make($request->all(),$arr_rules);
    	
    	if($validator->fails())
    	{
    		return redirect()->back()->withErrors($validator)->withInput($request->all());
    	}

    	/* Duplication Check */
    	$is_duplicate = Sentinel::createModel()->where('email',$request->input('email'))
                                               ->count();

    	if($is_duplicate>0)
    	{
    		Flash::error(str_singular($this->module_title).' Already Exists.');
    		return redirect()->back()->withInput($request->all());
    	}

        $arr_data               = [];
        $arr_data['first_name'] = trim($request->input('first_name'));
        $arr_data['last_name']  = trim($request->input('last_name'));
        $arr_data['email']      = $request->input('email');
        $arr_data['password']   = $request->input('password');
    	
        DB::beginTransaction();

    	$user = Sentinel::registerAndActivate($arr_data);
    	
    	$arr_roles = $request->input('roles');
    	
        if($user)
        {
            $is_role_attached = false;

        	if(sizeof($arr_roles)>0)
        	{
        		foreach ($arr_roles as $key => $id) 
        		{
        			$role = Sentinel::findRoleById($id);
                    if($role)
                    {
                        $is_role_attached = true;
        			    $role->users()->attach($user);
                    }
        		}
        	}

            if($is_role_attached == false)
            {       
                DB::rollback();
                Flash::error('Problem Occurred, While Creating '.str_singular($this->module_title));
                return redirect()->back();
            }

            $user_mail = $this->operator_added_mail($arr_data);
             //DB::rollback();
            DB::commit();
            Flash::success(str_singular($this->module_title).' Created Successfully');
    	}
    	else
    	{  
            DB::rollback();
    		Flash::error('Problem Occurred, While Creating '.str_singular($this->module_title));
    	}

    	return redirect($this->module_url_path);
    }

    public function edit($enc_id)
    {
        $id       = base64_decode($enc_id);

        $obj_user = Sentinel::findById($id);

        $obj_role = Sentinel::getRoleRepository()->createModel()->whereIn('slug',['operator']);
                                                                //->orWhereIn('slug',['operator']);
        
        $obj_role = $obj_role->orderBy('id','desc')->get();

        if( $obj_role != false)
        {
            $arr_roles = $obj_role->toArray();
        }

    	$arr_user = [];
    	if($obj_user)
    	{
    		$arr_tmp = $obj_user->roles->toArray();
    		$arr_assigned_roles = array_column($arr_tmp,'id');
    	}

        $this->arr_view_data['edit_mode']          = TRUE;
        $this->arr_view_data['enc_id']             = $enc_id;
        $this->arr_view_data['arr_assigned_roles'] = $arr_assigned_roles;
        $this->arr_view_data['arr_roles']          = $arr_roles;
        $this->arr_view_data['obj_user']           = $obj_user;
        $this->arr_view_data['page_title']         = "Edit ".str_singular($this->module_title);
        $this->arr_view_data['module_title']       = str_plural($this->module_title);
        $this->arr_view_data['module_url_path']    = $this->module_url_path;
        $this->arr_view_data['theme_color']        = $this->theme_color;

        return view($this->module_view_folder.'.edit', $this->arr_view_data);    

    }

    public function update(Request $request,$enc_id)
    {	
    	$id = base64_decode($enc_id);
    	
    	$arr_rules = [];
    	$arr_rules['first_name'] = "required";
    	$arr_rules['last_name']  = "required";
    	$arr_rules['email']      = "required";
    	

    	$validator = Validator::make($request->all(),$arr_rules);
    	if($validator->fails())
    	{
    		return redirect()->back()->withErrors($validator)->withInput($request->all());
    	}

    	/* Duplication Check */
    	$is_duplicate = Sentinel::createModel()
    						    ->where('email',$request->input('email'))
    						    ->where('id',"<>",$id)
    						    ->count();

    	if($is_duplicate>0)
    	{
    		Flash::error(str_singular($this->module_title).' Already Exists.');
    		return redirect()->back()->withInput($request->all());
    	}
    	
    	$obj_user = Sentinel::findById($id);

    	$arr_data['first_name'] = trim($request->input('first_name'));
    	$arr_data['last_name']  = trim($request->input('last_name'));
    	$arr_data['email']      = $request->input('email');
    	

    	if($request->has('password'))
    	{
    		$arr_data['password']      = $request->input('password');	
    	}

    	$obj_user = Sentinel::update($obj_user, $arr_data);


    	$arr_roles = $request->input('roles');
    	
    	if(sizeof($arr_roles)>0)
    	{
    		foreach ($arr_roles as $key => $id) 
    		{
    			$role = Sentinel::findRoleById($id);

                if(!$obj_user->inRole($role))
                {
    				$role->users()->attach($obj_user);	
    			}
    		}
    	}

    	if($obj_user)
    	{
            Flash::success(str_singular($this->module_title).' Updated Successfully');
    	}
    	else
    	{
            Flash::error('Problem Occured While Updating '.str_singular($this->module_title));
    	}

    	return redirect()->back();
    }

    public function operator_added_mail($data_array)
    {
        $selectCols = array('ETT.template_html','ETT.template_subject');

        $whrCondition   =   array('ET.id' => 10);
        $orderBy = $orderStyle = $groupBy = '';

        $joinsArray= array(
                            'join' => array('email_template_translation AS ETT','ETT.email_template_id','=','ET.id','inner')
                        );

        $emailTemplate = MasterModel::getRecords('email_template AS ET',$selectCols,$joinsArray,$whrCondition);
        
        $toEmail        = "info@ps.com";
        $toEmail = $data_array['email'];
        //$toEmail = 'gayatrid@webwingtechnologies.com';
        
        if(count($emailTemplate))
        {
            $content    =   $emailTemplate[0]->template_html;

            $names = $data_array['first_name'];
            
            $name      = ucwords(strtolower($names));
            $email     = $data_array['email'];
            $full_name = $data_array['first_name'].' '.$data_array['last_name'];
            $password  = $data_array['password'];
            $admin_url = '<p class="listed-btn"><a href="'.url('/').'/'.config('app.project.admin_panel_slug').'/login'.'">Click Here</a></p>';
            $content   =  str_replace(
                            array('##NAME##','##EMAIL_ID##','##PASSWORD##','##ADMIN_URL##'),
                            array($full_name,$email,$password,$admin_url),
                            $content
                        );

            $emailForm    = 'info@ps.com';
            $projectName  = config('app.project.name');
            $emailSubject = isset($emailTemplate[0]->template_subject)?$emailTemplate[0]->template_subject:'Admin : Printing Operator Registration.';

            $sendersDetail   = array('fromEmail' => $emailForm, 'fromName' => $projectName, 'subject' => $emailSubject);

            $receiversDetail = array('viewName'=> 'email.front_general', 'toEmail' => $toEmail, 'toName' => $projectName, 'messageBody' => $content);

            $isSent = MasterModel::sendHtmlEmail($sendersDetail,$receiversDetail);

            return $isSent;
        }       
    }

    public function set_default($enc_id = FALSE)
    {
        if(!$enc_id)
        {
            return redirect()->back();
        }

        if($this->perform_set_default(base64_decode($enc_id)))
        {
            Flash::success($this->module_title. 'Set as Default User Successfully');
        }
        else
        {
            Flash::error('Problem Occured While '.$this->module_title.' Set as Default User only one user set as default');
        }
        return redirect()->back();
    }

    public function unset_default($enc_id = FALSE)
    {
        if(!$enc_id)
        {
            return redirect()->back();
        }

        if($this->perform_unset_default(base64_decode($enc_id)))
        {
            Flash::success($this->module_title. 'Unset as Default User Successfully');
        }
        else
        {
            Flash::error('Problem Occured While '.$this->module_title.' unset a Default User');
        }

        return redirect()->back();
    }

    public function perform_set_default($id)
    {
        $is_exist_default = $this->BaseModel->where('is_default','=',1)->first();
        if(count($is_exist_default) <= 0)
        {       
                $static_page = $this->BaseModel->where('id',$id)->first();
                if($static_page)
                {
                    return $this->BaseModel->where('id',$id)->update(['is_default'=>1]);
                }
        return FALSE;
        }
        else
        {
            Flash::error("Already one user set as default");
        }
    }

    public function perform_unset_default($id)
    {

        $static_page = $this->BaseModel->where('id',$id)->first();
        
        if($static_page)
        {
             return $this->BaseModel->where('id',$id)->update(['is_default'=>0]);
        }

        return FALSE;
    }
}
