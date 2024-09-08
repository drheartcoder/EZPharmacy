<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ContactEnquiryModel;

use App\Common\Traits\MultiActionTrait;
use App\Models\MasterModel;

use Session;
use Validator;
use Flash;

class ContactEnquiryController extends Controller
{
    use MultiActionTrait;

	public function __construct(ContactEnquiryModel $contact_enquiry,MasterModel $MasterModel) 
	{
        $this->arr_view_data 		= [];
		$this->ContactEnquiryModel 	= $contact_enquiry;
        $this->BaseModel            = $this->ContactEnquiryModel;
        $this->MasterModel          = $MasterModel;
		$this->module_url_path 		= url(config('app.project.admin_panel_slug')."/contact_enquiry");
        $this->module_view_folder   = "admin.contact_enquiry";
        $this->module_title         = "Contact Enquiry";
	}

	public function index() 
	{	
		return redirect(url(config('app.project.admin_panel_slug')."/dashboard/"));
		
		/*$arr_contact_enquiry = array();
		$obj_contact_enquiry = $this->BaseModel->orderBy('id','DESC')->get();
		
		if($obj_contact_enquiry != FALSE)
		{
			$arr_contact_enquiry = $obj_contact_enquiry->toArray();
		}

		$this->arr_view_data['arr_contact_enquiry'] = $arr_contact_enquiry;
        $this->arr_view_data['page_title'] 			= "Manage ".str_singular($this->module_title);
        $this->arr_view_data['module_title'] 		= str_plural($this->module_title);
        $this->arr_view_data['module_url_path'] 	= $this->module_url_path;

        return view($this->module_view_folder.'.index',$this->arr_view_data);*/
	}

	public function view($enc_id)
	{
		$id = base64_decode($enc_id);

        $view_enquiry = $this->BaseModel->where('id',$id)->update(['is_view'=>'1']);  

		$arr_contact_enquiry_details = array();
		$obj_contact_enquiry 		 = $this->BaseModel->where('id','=',$id)->first();
		if($obj_contact_enquiry != FALSE)
		{
			$arr_contact_enquiry_details = $obj_contact_enquiry->toArray();
		}

		$this->arr_view_data['arr_contact_enquiry'] = $arr_contact_enquiry_details;
        $this->arr_view_data['page_title'] 			= "View ".str_singular($this->module_title);
        $this->arr_view_data['module_title'] 		= str_plural($this->module_title);
        $this->arr_view_data['module_url_path'] 	= $this->module_url_path;

        return view($this->module_view_folder.'.view',$this->arr_view_data);
	}

	public function reply($enc_id,Request $request)
	{
		$id = base64_decode($enc_id);


		 $selectCols     = array('site_email_address');
         $whrCondition   =   array('site_setting_id' => 1);
         $siteAssets     = MasterModel::getRecords('site_settings',$selectCols,'',$whrCondition, '','','');
            
        if(count($siteAssets))
        {
           $emailForm                = isset($siteAssets[0]->support_email_address)?$siteAssets[0]->support_email_address:'support@print.sa';
        }

		if(isset($_POST['btn_reply']))
		{
			$emailForm      = $toEmail = $content = $projectName = '';
			$emailForm 		= $request->input('txtFromEmail');
		 	$toEmail 		= $request->input('txtToEmail');
            $content 		= $request->input('subject');
            $projectName 	= config('app.project.name');
            $emailSubject 	= 'Contact Enquiry Reply';

			$sendersDetail  = array('fromEmail' => $emailForm, 'fromName' => $projectName, 'subject' => $emailSubject);
            $receiversDetail = array('viewName'=> 'email.front_general', 'toEmail' => $toEmail, 'toName' => $projectName, 'messageBody' => $content);
			if(MasterModel::sendHtmlEmail($sendersDetail,$receiversDetail))
			{
				Flash::success('Reply send successfully..');	
			}
			else
			{
				Flash::error('Problem while sending reply..');
			}
			return redirect($this->module_url_path);
		}
		$view_enquiry = $this->BaseModel->where('id',$id);  
		$arr_contact_enquiry_details = array();
		$obj_contact_enquiry 		 = $this->BaseModel->where('id','=',$id)->first();
		if($obj_contact_enquiry != FALSE)
		{
			$arr_contact_enquiry_details = $obj_contact_enquiry->toArray();
		}

		$this->arr_view_data['arr_contact_enquiry'] = $arr_contact_enquiry_details;
		$this->arr_view_data['email_from'] = $emailForm;
		
        $this->arr_view_data['page_title'] 			= "Reply ".str_singular($this->module_title);
        $this->arr_view_data['module_title'] 		= str_plural($this->module_title);
        $this->arr_view_data['module_url_path'] 	= $this->module_url_path;
        return view($this->module_view_folder.'.reply',$this->arr_view_data);
	}

	

}
