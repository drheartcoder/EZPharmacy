<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\SubscribersModel;
use App\Models\UserModel;

use App\Common\Traits\MultiActionTrait;

use Session;
use Validator;
use Flash;
use DB;
use Mail;


class SubscribersController extends Controller
{
	use MultiActionTrait;
    public function __construct( SubscribersModel $subscribers)
    {

        $this->arr_view_data 		= [];
		$this->SubscribersModel 	= $subscribers;

        $this->BaseModel            = $this->SubscribersModel;

		$this->module_url_path 		= url(config('app.project.admin_panel_slug')."/subscribers");
        $this->module_view_folder   = "admin.subscribers";
        $this->module_title         = "Subscribers ";
    }

    public function index()
    {
    	$arr_subscribers = array();
		$obj_subscribers = $this->BaseModel->orderBy('id','DESC')->get();
		
		if($obj_subscribers != FALSE)
		{
			$arr_subscribers = $obj_subscribers->toArray();
		}

		$this->arr_view_data['arr_subscribers'] = $arr_subscribers;
        $this->arr_view_data['page_title'] 			= "Manage ".str_singular($this->module_title);
        $this->arr_view_data['module_title'] 		= str_plural($this->module_title);
        $this->arr_view_data['module_url_path'] 	= $this->module_url_path;

        return view($this->module_view_folder.'.index',$this->arr_view_data);
    }
    public function send_mail()
    {
    	$arr_user_rec = $arr_subscribers = array();
                        $obj_subscribers = $this->BaseModel->orderBy('id','DESC')->where('is_active','1')->get();
                        
                        if($obj_subscribers != FALSE)
                        {
                            $arr_subscribers = $obj_subscribers->toArray();
                        }

       // dd();                

        $this->arr_data['arr_user_rec'] = $arr_subscribers;
        $this->arr_data['page_title']           = "Send Email ".$this->module_title;
        $this->arr_data['base_title']           = $this->module_title;
        $this->arr_data['module_title']         = $this->module_title;
        $this->arr_data['module_url_path']      = $this->module_url_path;
        return view($this->module_view_folder.'.send',$this->arr_data); 
    }

    public function store(Request $request)
    {
        $arr_rules['users']         = "required";        
        $arr_rules['description']   = "required";  
        $validator = Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
             return redirect()->back()->withErrors($validator)->withInput($request->all());
        }              
    
       // dd($request['users']);


        if(isset($request['users']) && count($request['users'])>0 || isset($request['email']) && count($request['email'])>0)           
        {
            for($i=0;$i<count($request['users']);$i++)
            {

                $useremail = $request['users'][$i];                
               
                $mail_data['email']              = $useremail;
                $mail_data['content']            = $request['description'];
                
                $send_mail = $this->user_mail($mail_data);  

                    
               
            }

            Flash::success('Email Successfully Sent To User');
        }     
        return redirect()->back();
    }
   
    public function user_mail($arr_data)
    {   
        $obj_data=UserModel::where('id','1')->first();
        if($obj_data)
        {
 			$data=$obj_data->toArray();
        }
        
        $site_mail = "printing@gmail.com";
        $content ='';
        $email="support@goovifo.com";


        if(isset($data) && sizeof($data)>0)
        {
          $site_mail = $data['email'];
        }
        
        if(isset($arr_data) && sizeof($arr_data)>0)
        {
            $email = $arr_data['email'];
            $content .= $arr_data['content'];

            $content .='<tr><td height="20"></td></tr><tr><td style="color: #545454;font-size: 15px;padding: 12px 30px;">To unsubscribe the newsletters click below button</td></tr><tr><td>
            <p class="listed-btn "><a target="_blank" href=" '.url('').'/unsubscribe/'.$arr_data['email'].'">Unsubscribe</a></p></td></tr> ';
           
       }
        
       

        $content            = html_entity_decode($content);

        $to_email_id  = isset($arr_data['email'])?$arr_data['email']:'';
        $project_name = config('app.project.name');
        $mail_form  = $site_mail;
        $mail_subject ='Newsletters'.' : '.config('app.project.name');
        $data = array('content' => $content,'subject'=>$mail_subject);
	    $send_mail = Mail::send('email.front_general',$data	, function($message) use ($email,$mail_form,$project_name,$mail_subject)
    	{   
           $message->from($mail_form,$project_name);
           $message->to($email);          
           $message->subject($mail_subject);
           //$message->setBody($content,'text/html');
        });  
      return $send_mail;
       
    }
}
