<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Common\Traits\MultiActionTrait;
use App\Models\LoginModel; 
use App\Models\LoginUserDetailModel; 
 
use App\Models\MasterModel;

use Validator;
use Session;
use Flash;
use Image;
use DB;
use Datatables;
use Sentinel;

class UserController extends Controller
{
    use MultiActionTrait;

    public function __construct(LoginModel $consumers,LoginUserDetailModel $consumersDetails,MasterModel $MasterModel)
    {
       $this->module_title         = "Users";
       $this->module_url_slug      = "Users";
       $this->module_url_path      = url(config('app.project.admin_panel_slug')."/users/");
       $this->module_view_folder   = 'admin.users';

       $this->LoginModel                    = $consumers;
       $this->BaseModel                     = $this->LoginModel;
       $this->LoginUserDetailModel          = $consumersDetails;
       $this->MasterModel                   = $MasterModel;
       $this->user_profile_public_img_path  = url('/').'/uploads/all_users/profile';
       $this->module_icon                   = "fa-users";

       $this->tbl_user_categories = 'user_categories';
    }

    public function index()
    {
        return redirect($this->module_url_path.'/manage/consumer/');
    }

    public function manage(Request $request ,$usertype)
    {
        $usertype = empty($usertype)?'patient':$usertype;

        $pharmacy_name = $request->get("pharmacy-name");

        $fullName     = $request->get('name');
        $mobileNumber = $request->get('number');

        $query = DB::table('user_master AS tbl_USER');
        $query->select(
                DB::raw('SHA2(tbl_tbl_USER.id,256) AS priKey'),
                DB::raw('LCASE(tbl_tbl_USER.full_name) AS fullName'),
                DB::raw('YEAR(CURDATE()) - YEAR(dob) AS userAge'),
                DB::raw('DATE_FORMAT(tbl_tbl_USER.dob,"%d-%m-%Y") AS dateOfbirth'),
                DB::raw('DATE_FORMAT(tbl_tbl_USER.reg_on,"%d-%m-%Y") AS regSince'),
                'tbl_USER.id',
                'tbl_USER.user_type AS userType',
                'tbl_USER.pharmacy_name',
                'tbl_USER.registration_no',
                'tbl_USER.speciality',
                'tbl_USER.profile_image',
                'tbl_USER.mobile_number',
                'tbl_USER.address',
                'tbl_USER.zipcode',
                'tbl_USER.status',
                'tbl_COUNTRY.country_name',
                'tbl_STATE.state_title',
                'tbl_CITY.city_title',
                'tbl_AREA.area_title'
            );
        
        $query->leftJoin('area AS tbl_AREA','tbl_AREA.id','=','tbl_USER.area');
        $query->leftJoin('city AS tbl_CITY','tbl_CITY.id','=','tbl_USER.city');
        $query->leftJoin('state AS tbl_STATE','tbl_STATE.id','=','tbl_USER.state');
        $query->leftJoin('countries AS tbl_COUNTRY','tbl_COUNTRY.id','=','tbl_USER.country');
        /*if($usertype == "patient"){
            $query->join('order_prescriptions AS ORDERS','ORDERS.sender_id','=','tbl_USER.id','left outer');
        }*/
        if(isset($fullName) && !empty($fullName)){
            $query->where('tbl_USER.full_name', 'LIKE' ,"".$fullName."%");
        }

        if(isset($mobileNumber) && !empty($mobileNumber)){
            $query->where('tbl_USER.mobile_number', '=' ,$mobileNumber);
        }

        if(isset($pharmacy_name) && !empty($pharmacy_name))
        {
            $query->where('tbl_USER.pharmacy_name', 'LIKE' ,"".$pharmacy_name."%");
        }

        $query->where('tbl_USER.user_type', '=' ,$usertype);
        /*if($usertype == "patient"){
            $query->where('ORDERS.status', '=' ,'completed');
            $query->groupBy('ORDERS.sender_id');
        }*/
        $query->orderBy('tbl_USER.id', 'DESC');

        $arr_data = $query->paginate(20);
        
        $query = DB::table('state AS STATE');
        $query->where('STATE.is_active', '=' , 1);
        $query->orderBy('STATE.state_title', 'ASC');
        $dataState = $query->get();

        $speciality_query = DB::table('speciality');
        $speciality_query->where('speciality.is_active', '=' , 1);
        $speciality_query->orderBy('speciality.name', 'ASC');
        $dataSpeciality = $speciality_query->get();

        if(count($arr_data))
        {
            foreach ($arr_data as $key => $value) {
                $query = DB::table('order_prescriptions AS ORDERS');
                $query->select(DB::raw('SUM(tbl_ORDERS.total_price) AS earnedPoints'));
                $query->where('ORDERS.status', '=' ,'completed');
                $query->where('ORDERS.sender_id', '=' , $value->id);
                $query->groupBy('ORDERS.sender_id');
                $dataPoint = $query->get();
                /*dump($dataPoint);*/
                $arr_data[$key]->userPoints = $dataPoint;
            }
        }

        /*echo '<pre>';
        print_r($arr_data);
        die;*/
        $this->arr_view_data['page_title']        = "Manage ".str_plural($this->module_title);
        $this->arr_view_data['module_title']      = $this->module_title;
        $this->arr_view_data['module_url_path']   = $this->module_url_path;
        $this->arr_view_data['module_icon']       = $this->module_icon;
        $this->arr_view_data['dataState']         = $dataState;
        $this->arr_view_data['dataSpeciality']    = $dataSpeciality;
        $this->arr_view_data['arr_data']          = $arr_data;
        $this->arr_view_data['usertype']          = $usertype;
        $this->arr_view_data['fullName']          = $fullName;
        $this->arr_view_data['mobileNumber']      = $mobileNumber;
        $this->arr_view_data['pharmacy_name']     = $pharmacy_name;
        if($request->ajax()) {
            return view($this->module_view_folder.'.ajax.load-index',$this->arr_view_data)->render();
        }

        return view($this->module_view_folder.'.index',$this->arr_view_data);
    }

    public function getCities(Request $request)
    {
        $citiesList = [];
        $status = 'fail';
        $stateId = $request->input('state_id');
        $query = DB::table('city AS CITY');
        $query->where('CITY.state_id', '=' , $stateId);
        $query->where('CITY.is_active', '=' , 1);
        $query->orderBy('CITY.city_title', 'ASC');
        $dataCities = $query->get();
        if(count($dataCities))
        {
            $status = 'success';
            foreach($dataCities as $key => $value)
            {
                $citiesList[$key]['id'] = $value->id;
                $citiesList[$key]['name'] = $value->city_title;
            }
        }
        $resp = array('status' => $status,'citiesList'=>$citiesList);
        return response()->json($resp);
    }
    public function getUserData(Request $request)
    {
        $specialityList = '';

        $_id = $request->get('id');
        $status = 'fail';
        $userDetails = $citiesList = [];
        if(!empty($_id))
        {
            $query = DB::table('user_master AS tbl_USER');
            $query->select(
                DB::raw('SHA2(tbl_tbl_USER.id,256) AS priKey'),
                DB::raw('DATE_FORMAT(tbl_tbl_USER.dob,"%d-%m-%Y") AS dateOfbirth'),
                'tbl_USER.id',
                'tbl_USER.first_name',
                'tbl_USER.last_name',
                'tbl_USER.user_type AS userType',
                'tbl_USER.profile_image',
                'tbl_USER.mobile_number',
                'tbl_USER.registration_no',
                'tbl_USER.speciality',
                'tbl_USER.address',
                'tbl_USER.city',
                'tbl_USER.state',
                'tbl_USER.zipcode',
                'tbl_USER.dob',
                'tbl_USER.status',
                'tbl_COUNTRY.country_name',
                'tbl_STATE.state_title',
                'tbl_CITY.city_title'
            );
            $query->leftJoin('city AS tbl_CITY','tbl_CITY.id','=','tbl_USER.city');
            $query->leftJoin('state AS tbl_STATE','tbl_STATE.id','=','tbl_USER.state');
            $query->leftJoin('countries AS tbl_COUNTRY','tbl_COUNTRY.id','=','tbl_USER.country');
            $query->whereRaw('SHA2(tbl_tbl_USER.id,256) =  "'.$_id.'" ');
            $arr_data = $query->first();
            if(count($arr_data))
            {
                $status = 'success';
                $userMsg = 'please wait retrieving data.';
                $userDetails[0]['id'] = $arr_data->priKey;
                $userDetails[0]['userType'] = $arr_data->userType;
                $userDetails[0]['firstName'] = $arr_data->first_name;
                $userDetails[0]['lastName'] = $arr_data->last_name;
                $userDetails[0]['mobileNumber'] = $arr_data->mobile_number;
                $userDetails[0]['registrationNo'] = $arr_data->registration_no;
                $userDetails[0]['speciality'] = $arr_data->speciality;
                $userDetails[0]['dateOfBirth'] = $arr_data->dateOfbirth;
                $userDetails[0]['address'] = $arr_data->address;
                $userDetails[0]['city'] = $arr_data->city;
                $userDetails[0]['state'] = $arr_data->state;
                $userDetails[0]['zipcode'] = $arr_data->zipcode;
                if($arr_data->userType == "doctor" || $arr_data->userType == "unverified-doctor")
                {
                    if(!empty($arr_data->speciality))
                    {
                        $specialityId = $arr_data->speciality;
                        $query = DB::table('speciality AS speciality');
                        $query->where('speciality.id', '=' , $specialityId);
                        $query->where('speciality.is_active', '=' , 1);
                        $query->orderBy('speciality.name', 'ASC');
                        $dataSpeciality = $query->get();
                        if(count($dataSpeciality))
                        {
                            $status = 'success';
                            foreach($dataSpeciality as $key => $value)
                            {
                                $specialityList[$key]['id'] = $value->id;
                                $specialityList[$key]['name'] = $value->name;
                            }
                        }
                    }
                }
                if($arr_data->userType == "pharmacy")
                {
                    if(!empty($arr_data->state))
                    {
                        $stateId = $arr_data->state;
                        $query = DB::table('city AS CITY');
                        $query->where('CITY.state_id', '=' , $stateId);
                        $query->where('CITY.is_active', '=' , 1);
                        $query->orderBy('CITY.city_title', 'ASC');
                        $dataCities = $query->get();
                        if(count($dataCities))
                        {
                            $status = 'success';
                            foreach($dataCities as $key => $value)
                            {
                                $citiesList[$key]['id'] = $value->id;
                                $citiesList[$key]['name'] = $value->city_title;
                            }
                        }
                    }
                }
            }
        }
        else{
            $status = 'fail';
            $userMsg = 'Record not found.';
        }
        $response = array('userDetails' => $userDetails,'citiesList' => $citiesList, 'specialityList' => $specialityList, 'userMsg' => $userMsg, 'status' => $status);
        return response()->json($response);
    }

    public function setUserData(Request $request)
    {
        $status = 'fail';
        $recStatus = 'existed';
        $errors = $userMsg = $userType = '';
        $rules = array(
            'firstName'    => 'required',
            'lastName'     => 'required',
            'txtDOB'       => 'required',
            'mobileNumber' => 'required|numeric'
            );
        $messages = array(
            'firstName.required'    => 'Please enter first name.',
            'lastName.required'     => 'Please enter last name.',
            'txtDOB.required'       => 'Please select date of birth.',
            'mobileNumber.required' => 'Please enter mobile number.',
            'mobileNumber.numeric'  => 'Mobile number must be numeric.'
            );
        $validator = Validator::make($request->all(), $rules, $messages);
        
        if($validator->fails())
        {
           return json_encode(['errors' => $validator->errors()->getMessages(),'code' => 422,'userMsg' => $userMsg,'status' => 'fail']);
        }
        else
        {
            $txtId          = $request->input('txtId');
            $userType       = $request->input('userType');
            $firstName      = $request->input('firstName');
            $lastName       = $request->input('lastName');
            $txtDOB         = $request->input('txtDOB');
            $mobileNumber   = $request->input('mobileNumber');
            $fullName = ucwords(strtolower($firstName)).' '.ucwords(strtolower($lastName));
            $dataValues = array(
                'first_name'    => ucwords(strtolower($firstName)),
                'last_name'     => ucwords(strtolower($lastName)),
                'full_name'     => $fullName,
                'dob'           => date('Y-m-d',strtotime($txtDOB)),
                'mobile_number' => $mobileNumber
            );
            if($userType == "doctor" || $usertype == "unverified-doctor")
            {
                $rules = array(
                        'txtRegistrationNo'  => 'required',
                        'selSpeciality'    => 'required'
                    );
                $messages = array(
                        'txtRegistrationNo.required'  => 'Please enter registration no.',
                        'selSpeciality.required'    => 'Please select speciality.'
                    );
                $validator = Validator::make($request->all(), $rules, $messages);
                
                if($validator->fails())
                {
                   return json_encode(['errors' => $validator->errors()->getMessages(),'code' => 422,'userMsg' => $userMsg,'status' => 'fail']);
                }

                $txtRegistrationNo   = $request->input('txtRegistrationNo');
                $selSpeciality     = $request->input('selSpeciality');

                $selSpec = '';
                if(!empty($selSpeciality))
                {
                	$selSpeciality = implode(',', $selSpeciality);
                }

                $dataDoctor = array(
                        'registration_no' => $txtRegistrationNo,
                        'speciality'      => $selSpeciality
                    );
                $dataValues = array_merge($dataValues, $dataDoctor);
            }
            if($userType == "pharmacy")
            {
                $rules = array(
                        'txtAddress'  => 'required',
                        'selState'    => 'required',
                        'selCity'     => 'required',
                        'txtPostcode' => 'required|numeric'
                    );
                $messages = array(
                        'txtAddress.required'  => 'Please enter address.',
                        'selState.required'    => 'Please select state.',
                        'selCity.required'     => 'Please select city.',
                        'txtPostcode.required' => 'Please enter postcode.',
                    );
                $validator = Validator::make($request->all(), $rules, $messages);
                
                if($validator->fails())
                {
                   return json_encode(['errors' => $validator->errors()->getMessages(),'code' => 422,'userMsg' => $userMsg,'status' => 'fail']);
                }

                $txtAddress   = $request->input('txtAddress');
                $selState     = $request->input('selState');
                $selCity      = $request->input('selCity');
                $txtPostcode  = $request->input('txtPostcode');
                $dataPharmacy = array(
                        'address'   => $txtAddress,
                        'city'      => $selCity,
                        'state'     => $selState,
                        'zipcode'   => $txtPostcode,
                        'country'   => 1
                    );
                $dataValues = array_merge($dataValues, $dataPharmacy);
            }
            if(!empty($txtId))
            {
                $isExists = DB::table('user_master AS USER')->where('mobile_number','=',$mobileNumber)->whereRaw('SHA2(tbl_USER.id, 256) <> "'.$txtId.'" ')->count();
                if($isExists)
                {
                    $resp = array('status' => 'fail','errors'=>$errors,'userMsg'=>'Mobile number already exists.');
                    return response()->json($resp);
                }
                else
                {
                    $isEdit = DB::table('user_master')->whereRaw('SHA2(id, 256) = "'.$txtId.'"')->update($dataValues);
                    if($isEdit)
                    {
                        $status  = 'success';
                        $recStatus = 'existed';
                        $userMsg = 'User details modified successfully.';
                    }
                    else
                    {
                        $status  = 'fail';
                        $userMsg = 'Error in modifying user details.';
                    }
                }
            }
            else
            {
                $isExists = DB::table('user_master AS USER')->where('mobile_number','=',$mobileNumber)->count();
                if($isExists)
                {
                    $resp = array('status' => 'fail','errors'=>$errors,'userMsg'=>'Mobile number already exists.');
                    return response()->json($resp);
                }
                else
                {
                    $isInsert = DB::table('user_master')->insertGetId($dataValues);
                    if($isInsert)
                    {
                        @chmod('uploads', 0777);
                        @chmod('uploads/all_users', 0777);
                        $targetDir = 'uploads/all_users/'.$isInsert;
                        if(!is_dir($targetDir))
                        {
                            mkdir($targetDir);
                            @chmod($targetDir, 0777);
                        }
                        $fopen = @fopen($targetDir.'/index.html', 'w');

                        if($fopen)
                        {
                            if(file_exists($targetDir.'/index.html')){
                                fwrite($fopen, '<!DOCTYPE html><html><head><title>403 Forbidden</title></head><body><p>Directory access is forbidden.</p></body></html>');
                                
                                $setFile = $targetDir.'/index.html';
                                @chmod($setFile, 0644);
                            }
                            fclose($fopen);
                        }
                        $status  = 'success';
                        $recStatus = 'new';
                        $userMsg = 'User details added successfully.';
                    }
                    else
                    {
                        $status  = 'fail';
                        $userMsg = 'Error in adding user details.';
                    }
                }
            }
        }

        $resp = array('status' => $status,'errors'=>$errors,'userMsg'=>$userMsg,'recStatus'=>$recStatus,'userType'=>$userType);
        return response()->json($resp);
    }

    public function setUserStatus(Request $request, $userStatus = 'blocked')
    {
        $status = 'fail';
        $errors = $userMsg = '';
        $_id = $request->get('id');

        $rules = array('id'    => 'required');
        $messages = array('id.required' => 'Something went wrong, please try again.');
        $validator = Validator::make($request->all(), $rules, $messages);
        
        if($validator->fails())
        {
           return json_encode(['errors' => $validator->errors()->getMessages(),'code' => 422,'userMsg' => $userMsg,'status' => 'fail']);
        }
        else
        {
            $isEdit = DB::table('user_master')->whereRaw('SHA2(id, 256) = "'.$_id.'"')->update(array('status' => $userStatus));
            if($isEdit)
            {
                $status  = 'success';
                $userMsg = 'User status changed successfully.';
            }
            else
            {
                $status  = 'fail';
                $userMsg = 'Error in changing user status.';
            }
        }
        $response = array('status' => $status, 'userMsg' => $userMsg);
        return response()->json($response);
    }

    public function deleteUser(Request $request)
    {
        $status = 'fail';
        $errors = $userMsg = '';
        $_id = $request->get('id');

        $rules = array('id' => 'required');
        $messages = array('id.required' => 'Something went wrong, please try again.');
        $validator = Validator::make($request->all(), $rules, $messages);
        
        if($validator->fails())
        {
           return json_encode(['errors' => $validator->errors()->getMessages(),'code' => 422,'userMsg' => $userMsg,'status' => 'fail']);
        }
        else
        {
            $isExists = DB::table('user_master')->select('id')->whereRaw('SHA2(id, 256) = "'.$_id.'"')->first();
            if(count($isExists))
            {
                DB::beginTransaction();
                $isDelete = DB::table('user_master')->whereRaw('SHA2(id, 256) = "'.$_id.'"')->delete();

                if($isDelete)
                {
                    $isRemove = DB::table('order_prescriptions')->where('sender_id','=',$isExists->id)->delete();
                    if($isRemove)
                    {
                       $this->removeDir('uploads/all_users/'.$isExists->id);
                       DB::commit();
                       $status  = 'success';
                       $userMsg = 'User deleted successfully.';
                    }
                    else
                    {
                        $this->removeDir('uploads/all_users/'.$isExists->id);
                        DB::commit();
                        $status  = 'success';
                        $userMsg = 'User deleted successfully.';
                    }
                }
                else
                {
                    DB::rollBack();
                    $status  = 'fail';
                    $userMsg = 'Error in deleteing user.';
                }
            }
            else
            {
                $status  = 'fail';
                $userMsg = 'user not found.';
            }
        }
        $response = array('status' => $status, 'userMsg' => $userMsg);
        return response()->json($response);
    }

    public function createOrder(Request $request)
    {

        /*$_id = $request->input('txtSenderId');*/
        $file_name = '';
        $status = 'fail';
        $userMsg = $recStatus = $errors = '';
        $rules = array(
            'txtSenderId'   => 'required',
            'txtName'       => 'required',
            'txtMobileNumber' => 'required',
            'selPharmacy'   => 'required'
        );
        $messages = array(
            'id.required'      => 'User id is missing.',
            'txtName.required' => 'Please enter name.',
            'txtMobileNumber.required' => 'Please enter mobile number.',
            'txtMobileNumber.numeric'  => 'Mobile number must be digits only (0-9).',
            'selPharmacy.required'     => 'Please select pharmacy.'
        );
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails())
        {
           return json_encode(['errors' => $validator->errors()->getMessages(),'code' => 422,'userMsg' => $userMsg,'status' => 'fail']);
        }
        else
        {
        /*if(!empty($_id))
        {*/

            $txtSenderId     = $request->input('txtSenderId');
            $txtName         = $request->input('txtName');
            $txtMobileNumber = trim($request->input('txtMobileNumber'));
            $selPharmacy     = $request->input('selPharmacy');
            $txtUserType     = $request->input('txtUserType');

            $query = DB::table('user_master AS tbl_USER');
            $query->select('tbl_USER.id');
            $query->whereRaw('SHA2(tbl_tbl_USER.id,256) =  "'.$txtSenderId.'" ');
            $arrData = $query->first();
            if(count($arrData))
            {
                if($request->hasFile('fileName'))
                {
                    if(is_dir('uploads/all_users/'.$arrData->id))
                    {
                        $file_name = $request->input('fileName');
                        $file_extension = strtolower($request->file('fileName')->getClientOriginalExtension());

                        if(in_array($file_extension,['png','jpg','jpeg']))
                        {
                            $file_name = time().'_prescription_'.$arrData->id.'.'.$file_extension;
                            $isUpload = $request->file('fileName')->move('uploads/all_users/'.$arrData->id.'/', $file_name);
                            if($isUpload)
                            {
                                @chmod('uploads/all_users/'.$arrData->id.'/'.$file_name, 0644);

                                $query = DB::table('user_master AS tbl_USER');
                                $query->select('tbl_USER.id');
                                $query->where('tbl_USER.mobile_number','=',$txtMobileNumber);
                                $isFound = $query->first();
                                if(!count($isFound))
                                {
                                    $firstName = $fullName = ucwords(strtolower($txtName));
                                    $explName = explode(' ', $fullName);
                                    $lastName = '';
                                    if(count($explName))
                                    {
                                        $firstName = isset($explName[0]) && !empty($explName[0])?$explName[0]:'';
                                        $lastName  = isset($explName[1]) && !empty($explName[1])?$explName[1]:'';
                                    }
                                    $dataValues = array(
                                        'user_type'     => $txtUserType,
                                        'first_name'    => $firstName,
                                        'last_name'     => $lastName,
                                        'full_name'     => $fullName,
                                        'mobile_number' => $txtMobileNumber
                                    );
                                    $isInsert = DB::table('user_master')->insertGetId($dataValues);
                                    if($isInsert)
                                    {
                                        $orderId = $this->createOrderId('order_prescriptions','order_id');
                                        $dataOrders = array(
                                            'sender_id'     =>  $arrData->id,
                                            'sent_for'      =>  $isInsert,
                                            'receiver_id'   =>  $selPharmacy,
                                            'order_id'      =>  $orderId,
                                            'prescription_image' =>  $file_name
                                        );
                                        DB::table('order_prescriptions')->insertGetId($dataOrders);
                                        @chmod('uploads', 0777);
                                        @chmod('uploads/all_users', 0777);
                                        $targetDir = 'uploads/all_users/'.$isInsert;
                                        if(!is_dir($targetDir))
                                        {
                                            mkdir($targetDir);
                                            @chmod($targetDir, 0777);
                                        }
                                        $fopen = @fopen($targetDir.'/index.html', 'w');

                                        if($fopen)
                                        {
                                            if(file_exists($targetDir.'/index.html')){
                                                fwrite($fopen, '<!DOCTYPE html><html><head><title>403 Forbidden</title></head><body><p>Directory access is forbidden.</p></body></html>');
                                                
                                                $setFile = $targetDir.'/index.html';
                                                @chmod($setFile, 0644);
                                            }
                                            fclose($fopen);
                                        }
                                        $status  = 'success';
                                        $recStatus = 'new';
                                        $userMsg = 'Precription sent successfully.';
                                    }
                                    else
                                    {
                                        @unlink('uploads/all_users/'.$arrData->id.'/', $file_name);
                                        $status  = 'fail';
                                        $userMsg = 'Error in sending prescription.';
                                    }
                                }
                                else
                                {
                                    $orderId = $this->createOrderId('order_prescriptions','order_id');
                                    $dataOrders = array(
                                        'sender_id'     =>  $arrData->id,
                                        'sent_for'      =>  $isFound->id,
                                        'receiver_id'   =>  $selPharmacy,
                                        'order_id'      =>  $orderId,
                                        'prescription_image' =>  $file_name
                                    );
                                    $res = DB::table('order_prescriptions')->insertGetId($dataOrders);
                                    $status  = 'success';
                                    $recStatus = 'new';
                                    $userMsg = 'Precription sent successfully.';
                                }
                            }
                        }
                        else
                        {
                            $userMsg = 'Please upload only \'PNG\',\'JPG\' and \'JPEG\' file formats.';
                        }
                    }
                    else
                    {
                        $userMsg = 'Directory Not Found.';
                    }
                }
                else
                {
                    $userMsg = 'Please attach prescription image.';
                }
            }
            else
            {
                $userMsg = 'User not found.';
            }
        }
        $resp = array('status' => $status,'errors'=>$errors,'userMsg'=>$userMsg,'recStatus'=>$recStatus,'fileName' => $file_name);
        return response()->json($resp);
    }

    public function getPharmacies(Request $request)
    {
        $pharmaciesList = [];
        $status = 'fail';
        $query = DB::table('user_master AS tbl_USER');
        $query->select(
            DB::raw('SHA2(tbl_tbl_USER.id,256) AS priKey'),
            DB::raw('LCASE(tbl_tbl_USER.full_name) AS fullName'),
            'tbl_USER.id',
            'tbl_USER.mobile_number',
            'tbl_USER.address',
            'tbl_USER.zipcode',
            'tbl_USER.status',
            'tbl_COUNTRY.country_name',
            'tbl_STATE.state_title',
            'tbl_CITY.city_title'
        );
        $query->leftJoin('city AS tbl_CITY','tbl_CITY.id','=','tbl_USER.city');
        $query->leftJoin('state AS tbl_STATE','tbl_STATE.id','=','tbl_USER.state');
        $query->leftJoin('countries AS tbl_COUNTRY','tbl_COUNTRY.id','=','tbl_USER.country');
        $query->where('tbl_USER.user_type', '=' ,'pharmacy');
        $query->where('tbl_USER.status', '=' ,'active');
        $query->orderBy('tbl_USER.full_name', 'ASC');
        $arrData = $query->get();
        if(count($arrData))
        {
            $status = 'success';
            foreach($arrData as $key => $value)
            {
                $pharmaciesList[$key]['id'] = $value->id;
                $pharmaciesList[$key]['name'] = ucwords($value->fullName).' ('.$value->address.', '.$value->city_title.')';
            }
        }
        $resp = array('status' => $status,'pharmaciesList'=>$pharmaciesList);
        return response()->json($resp);
    }
    public function createOrderId($tableName,$columnName)
    {
        $orderId = time().mt_rand(1000,99999);
        $isFound = MasterModel::getRecords($tableName,array('order_id'),'',array($columnName => $orderId));
        if(!count($isFound)){
            return $orderId;
        }
        else{
            $this->createOrderId($tableName,$columnName);
        }
    }

    public function ordersList()
    {
        $query = DB::table('order_prescriptions AS ORDERS');
        $query->select(
            DB::raw('SHA2(tbl_ORDERS.id,256) AS orderKey'),
            DB::raw('SHA2(tbl_SENDER.id,256) AS senderKey'),
            DB::raw('LCASE(tbl_SENDER.full_name) AS senderFullName'),

            DB::raw('SHA2(tbl_SENTFOR.id,256) AS sentForKey'),
            DB::raw('LCASE(tbl_SENTFOR.full_name) AS sentForFullName'),

            DB::raw('SHA2(tbl_RECEIVER.id,256) AS receiverKey'),
            DB::raw('LCASE(tbl_RECEIVER.full_name) AS receiverFullName'),

            DB::raw('DATE_FORMAT(tbl_ORDERS.sent_on,"%d-%m-%Y") AS orderedSentOn'),
            'SENDER.id AS senderId',
            'SENDER.mobile_number AS senderMobile',

            'SENTFOR.id AS sentForId',
            'SENTFOR.mobile_number AS sentForMobile',

            'RECEIVER.id AS receiverId',
            'RECEIVER.mobile_number AS receiverMobile',

            'RECEIVER.address AS receiverAddress',
            'RECEIVER.zipcode AS receiverZipcode',
            'COUNTRY.country_name AS receiverCountry',
            'STATE.state_title',
            'CITY.city_title',
            'ORDERS.order_id',
            DB::raw('CONCAT("uploads/all_users/",tbl_ORDERS.sender_id,"/",tbl_ORDERS.prescription_image) AS prescriptionImage'),
            'ORDERS.status AS orderStatus'
        );
        $query->leftJoin('user_master AS SENDER','SENDER.id','=','ORDERS.sender_id');
        $query->leftJoin('user_master AS SENTFOR','SENTFOR.id','=','ORDERS.sent_for');
        $query->leftJoin('user_master AS RECEIVER','RECEIVER.id','=','ORDERS.receiver_id');
        $query->leftJoin('city AS CITY','CITY.id','=','RECEIVER.city');
        $query->leftJoin('state AS STATE','STATE.id','=','RECEIVER.state');
        $query->leftJoin('countries AS COUNTRY','COUNTRY.id','=','RECEIVER.country');
        $query->orderBy('ORDERS.sent_on', 'DESC');
        $dataOrders = $query->paginate(20);

        echo '<pre>';
        print_r($dataOrders);
    }
    public function removeDir($userDir)
    {
       return exec('rm -rf '.$userDir);
    }

    public function unverifiedDoctor(Request $request)
    {
        $usertype = 'unverified-doctor';

        $fullName     = $request->get('name');
        $mobileNumber = $request->get('number');

        $query = DB::table('unverified_doctor');
        $query->select(
                DB::raw('SHA2(tbl_unverified_doctor.id,256) AS priKey'),
                DB::raw('LCASE(tbl_unverified_doctor.full_name) AS fullName'),
                DB::raw('YEAR(CURDATE()) - YEAR(dob) AS userAge'),
                DB::raw('DATE_FORMAT(tbl_unverified_doctor.dob,"%d-%m-%Y") AS dateOfbirth'),
                DB::raw('DATE_FORMAT(tbl_unverified_doctor.reg_on,"%d-%m-%Y") AS regSince'),
                'unverified_doctor.id',
                'unverified_doctor.user_type AS userType',
                'unverified_doctor.registration_no',
                'unverified_doctor.speciality',
                'unverified_doctor.profile_image',
                'unverified_doctor.mobile_number',
                'unverified_doctor.address',
                'unverified_doctor.zipcode',
                'unverified_doctor.status',
                'tbl_COUNTRY.country_name',
                'tbl_STATE.state_title',
                'tbl_CITY.city_title'
            );
        
        $query->leftJoin('city AS tbl_CITY','tbl_CITY.id','=','unverified_doctor.city');
        $query->leftJoin('state AS tbl_STATE','tbl_STATE.id','=','unverified_doctor.state');
        $query->leftJoin('countries AS tbl_COUNTRY','tbl_COUNTRY.id','=','unverified_doctor.country');
        
        if(isset($fullName) && !empty($fullName)){
            $query->where('unverified_doctor.full_name', 'LIKE' ,"".$fullName."%");
        }

        if(isset($mobileNumber) && !empty($mobileNumber)){
            $query->where('unverified_doctor.mobile_number', '=' ,$mobileNumber);
        }

        $query->where('unverified_doctor.user_type', '=' ,$usertype);
        
        $query->orderBy('unverified_doctor.id', 'DESC');

        $arr_data = $query->paginate(20);
        
        $query = DB::table('state AS STATE');
        $query->where('STATE.is_active', '=' , 1);
        $query->orderBy('STATE.state_title', 'ASC');
        $dataState = $query->get();

        if(count($arr_data))
        {
            foreach ($arr_data as $key => $value) {
                $query = DB::table('order_prescriptions AS ORDERS');
                $query->select(DB::raw('SUM(tbl_ORDERS.total_price) AS earnedPoints'));
                $query->where('ORDERS.status', '=' ,'completed');
                $query->where('ORDERS.sender_id', '=' , $value->id);
                $query->groupBy('ORDERS.sender_id');
                $dataPoint = $query->get();
                $arr_data[$key]->userPoints = $dataPoint;
            }
        }

        $this->arr_view_data['page_title']        = "Manage ".str_plural($this->module_title);
        $this->arr_view_data['module_title']      = $this->module_title;
        $this->arr_view_data['module_url_path']   = $this->module_url_path;
        $this->arr_view_data['module_icon']       = $this->module_icon;
        $this->arr_view_data['dataState']         = $dataState;
        $this->arr_view_data['arr_data']          = $arr_data;
        $this->arr_view_data['usertype']          = $usertype;
        $this->arr_view_data['fullName']          = $fullName;
        $this->arr_view_data['mobileNumber']      = $mobileNumber;
        if($request->ajax()) {
            return view($this->module_view_folder.'.ajax.load-index',$this->arr_view_data)->render();
        }
        return view($this->module_view_folder.'.unverified-doctor',$this->arr_view_data);
    }


    public function verifiedDoctor(Request $request)
    {
        $status = 'fail';
        $errors = $userMsg = '';
        $_id = $request->get('id');

        $rules = array('id' => 'required');
        $messages = array('id.required' => 'Something went wrong, please try again.');
        $validator = Validator::make($request->all(), $rules, $messages);
        
        if($validator->fails())
        {
           return json_encode(['errors' => $validator->errors()->getMessages(),'code' => 422,'userMsg' => $userMsg,'status' => 'fail']);
        }
        else
        {
            $isExists = DB::table('unverified_doctor')->select('id')->whereRaw('SHA2(id, 256) = "'.$_id.'"')->first();
            if(count($isExists))
            {
                $get_user = DB::table('unverified_doctor')->whereRaw('SHA2(id, 256) = "'.$_id.'"')->first();

                $dataValues = array(
                    'user_type'     => 'doctor',
                    'first_name'    => $get_user->first_name,
                    'last_name'     => $get_user->last_name,
                    'full_name'     => $get_user->full_name,
                    'status'        => 'active'
                );
                $isInsert = DB::table('user_master')->insert($dataValues);
                DB::beginTransaction();

                if($isInsert)
                {
                    $isDelete = DB::table('unverified_doctor')->whereRaw('SHA2(id, 256) = "'.$_id.'"')->delete();
                    if($isDelete)
                    {
                       DB::commit();
                       $status  = 'success';
                       $userMsg = 'User deleted successfully.';
                    }
                    else
                    {
                        DB::commit();
                        $status  = 'success';
                        $userMsg = 'User deleted successfully.';
                    }
                }
                else
                {
                    DB::rollBack();
                    $status  = 'fail';
                    $userMsg = 'Error in deleteing user.';
                }
            }
            else
            {
                $status  = 'fail';
                $userMsg = 'user not found.';
            }
        }
        $response = array('status' => $status, 'userMsg' => $userMsg);
        //return response()->json($response);
        return redirect()->back();
    }


}