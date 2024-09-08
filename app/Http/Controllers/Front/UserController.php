<?php

namespace App\Http\Controllers\Front;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\MasterModel;
use App\Models\UserMasterModel;
use Validator;
use Session;
use Flash;
use DB;
use Response;

class UserController extends Controller
{
    public function __construct(MasterModel $MasterModel, UserMasterModel $UserMasterModel)
    {
        $this->MasterModel      = $MasterModel;
        $this->UserMasterModel  = $UserMasterModel;

        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, Accept, Authorization, X-Requested-With, Application');
        /*header('Access-Control-Allow-Origin: http://localhost:8080');
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 604800');
        header("Content-type: application/json");*/
    }

    public function index()
    {
        /*echo php_uname();
        echo '<br>'.PHP_OS;*/
        /*echo $this->validateInput('Imran Ahmed Khan');*/
        /*$_otp = $this->generateOTP();
        $response = $this->sendOTP(8485002440, $_otp);*/
        /*$response = $this->getTinyUrl('http://192.168.1.75/ez_pharmacy/superadmin/users/manage/patient/');*/
        /*$response = $this->generateOTP();*/
        /*DB::enableQueryLog();
        $today = strtotime(date('Y-m-d H:i:s').'+15 min');
        DB::table('user_master')->where('id','=',1001)->update(array('otp' => 132456,'otp_expiration' => date('Y-m-d H:i:s',$today) ));
        $queries = DB::getQueryLog();
        dd($queries);*/
        /*echo $response;*/

        /*$os = $this->getOS($_SERVER['HTTP_USER_AGENT']);
        echo $os;*/
        echo $_SERVER['HTTP_USER_AGENT'] . "\n\n";
        /*$browser = get_browser(null, true);
        echo '<br><pre>';
        print_r($browser);*/
    }
    public function getOS($userAgent) {
        // Create list of operating systems with operating system name as array key 
        $oses = array (
            'iPhone'            => '(iPhone)',
            'Windows 3.11'      => 'Win16',
            'Windows 95'        => '(Windows 95)|(Win95)|(Windows_95)',
            'Windows 98'        => '(Windows 98)|(Win98)',
            'Windows 2000'      => '(Windows NT 5.0)|(Windows 2000)',
            'Windows XP'        => '(Windows NT 5.1)|(Windows XP)',
            'Windows 2003'      => '(Windows NT 5.2)',
            'Windows Vista'     => '(Windows NT 6.0)|(Windows Vista)',
            'Windows 7'         => '(Windows NT 6.1)|(Windows 7)',
            'Windows NT 4.0'    => '(Windows NT 4.0)|(WinNT4.0)|(WinNT)|(Windows NT)',
            'Windows ME'        => 'Windows ME',
            'Open BSD'          => 'OpenBSD',
            'Sun OS'            => 'SunOS',
            'Linux'             => '(Linux)|(X11)',
            'Safari'            => '(Safari)',
            'Mac OS'            => '(Mac_PowerPC)|(Macintosh)',
            'QNX'               => 'QNX',
            'BeOS'              => 'BeOS',
            'OS/2'              => 'OS/2',
            'Search Bot'        => '(nuhk)|(Googlebot)|(Yammybot)|(Openbot)|(Slurp/cat)|(msnbot)|(ia_archiver)'
        );
        
        // Loop through $oses array
        foreach($oses as $os => $preg_pattern) {
            // Use regular expressions to check operating system type
            if ( preg_match('@' . $preg_pattern . '@', $userAgent) ) {
                // Operating system was matched so return $oses key
                return $os;
            }
        }
        
        // Cannot find operating system so return Unknown
        
        return 'n/a';
    }

    public function getUserData(Request $request)
    {
        $_id = $request->get('id');
        $status = 'fail';
        $userDetails = [];
        if(!empty($_id))
        {
            $query = DB::table('user_master AS tbl_USER');
            $query->select(
                        DB::raw('SHA2(tbl_tbl_USER.id,256) AS priKey'),
                        DB::raw('DATE_FORMAT(tbl_tbl_USER.dob,"%d-%m-%Y") AS dateOfbirth'),
                        'tbl_USER.id',
                        'tbl_USER.user_type AS userType',
                        'tbl_USER.first_name',
                        'tbl_USER.last_name',
                        'tbl_USER.mobile_number',
                        'tbl_USER.dob',
                        'tbl_USER.status',
                        'tbl_USER.profile_image',
                        'tbl_COUNTRY.country_name',
                        'tbl_STATE.state_title',
                        'tbl_CITY.city_title',
                        'tbl_AREA.area_title'
                        );

            $query->leftJoin('area AS tbl_AREA','tbl_AREA.id','=','tbl_USER.area');
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
                $userDetails[0]['firstName'] = $arr_data->first_name;
                $userDetails[0]['lastName'] = $arr_data->last_name;
                $userDetails[0]['mobileNumber'] = $arr_data->mobile_number;
                $userDetails[0]['dateOfBirth'] = $arr_data->dateOfbirth;
            }
        }
        else{
            $status = 'fail';
            $userMsg = 'Record not found.';
        }
        $response = array('userDetails' => $userDetails, 'userMsg' => $userMsg, 'status' => $status);
        return response()->json($response);
    }

    public function register()
    {
        $status = 'fail';
        $errors = $userMsg = $userType = '';
        $postdata = file_get_contents("php://input");

        if(isset($postdata) && !empty($postdata))
        {
            $request = json_decode($postdata);
            if(count($request))
            {
                $userType       = $this->validateInput($request->userType);
                $firstName      = $this->validateInput($request->firstName);
                $lastName       = $this->validateInput($request->lastName);
                $mobileNumber   = $this->validateInput($request->mobileNumber);

                if($userType == 'doctor' || $userType == 'patient')
                {
                    $dateOfBirth = $this->validateInput($request->dateOfBirth);
                }

                if($userType == 'pharmacy')
                {
                    $pharmacyName = $this->validateInput($request->pharmacyName);
                    $city         = $this->validateInput($request->city);
                    $area         = $this->validateInput($request->area);
                }

                if($userType == 'doctor')
                {
                    $registrationNo = $this->validateInput($request->registrationNo);
                    $speciality     = $this->validateInput($request->speciality);
                }


                if(empty($userType))
                {
                    $resp = array('status' => 'fail','errors'=>$errors,'userMsg'=> 'Please slect user type.');
                    return response()->json($resp);
                }
                else if(empty($firstName))
                {
                    $resp = array('status' => 'fail','errors'=>$errors,'userMsg'=> 'First name is empty.');
                    return response()->json($resp);
                }
                else if(empty($lastName))
                {
                    $resp = array('status' => 'fail','errors'=>$errors,'userMsg'=> 'Last name is empty.');
                    return response()->json($resp);
                }
                else if(empty($mobileNumber))
                {
                    $resp = array('status' => 'fail','errors'=>$errors,'userMsg'=> 'Mobile number is empty.');
                    return response()->json($resp);
                }

                if($userType == 'doctor' || $userType == 'patient')
                {
                    if(empty($dateOfBirth))
                    {
                        $resp = array('status' => 'fail','errors'=>$errors,'userMsg'=> 'Date of birth is empty.');
                        return response()->json($resp);
                    }
                }

                if($userType == 'pharmacy')
                {
                    if(empty($pharmacyName))
                    {
                        $resp = array('status' => 'fail','errors'=>$errors,'userMsg'=> 'Pharmacy Name is empty.');
                        return response()->json($resp);
                    }
                    else if(empty($city))
                    {
                        $resp = array('status' => 'fail','errors'=>$errors,'userMsg'=> 'City is empty.');
                        return response()->json($resp);
                    }
                    else if(empty($area))
                    {
                        $resp = array('status' => 'fail','errors'=>$errors,'userMsg'=> 'Area is empty.');
                        return response()->json($resp);
                    }
                }

                if($userType == 'doctor')
                {
                    if(empty($registrationNo))
                    {
                        $resp = array('status' => 'fail','errors'=>$errors,'userMsg'=> 'Area is empty.');
                        return response()->json($resp);
                    }
                    else if(empty($speciality))
                    {
                        $resp = array('status' => 'fail','errors'=>$errors,'userMsg'=> 'Area is empty.');
                        return response()->json($resp);
                    }
                }

                $isExists = DB::table('user_master AS USER')->where('mobile_number','=',$mobileNumber)->count();
                if($isExists)
                {
                    $status = 'fail';
                    $userMsg = 'Mobile number is already exists.';
                }
                else
                {
                    $userStatus = $userType == "pharmacy"?'blocked':'active';
                    $fullName   = ucwords(strtolower($firstName)).' '.ucwords(strtolower($lastName));
                    
                    if($userType == 'patient')
                    {
                        $dataValues = array(
                            'user_type'     => $userType,
                            'first_name'    => ucwords(strtolower($firstName)),
                            'last_name'     => ucwords(strtolower($lastName)),
                            'full_name'     => $fullName,
                            'dob'           => $dateOfBirth,
                            'mobile_number' => $mobileNumber,
                            'status'        => $userStatus
                        );
                    }
                    else if($userType == 'doctor')
                    {
                        $dataValues = array(
                            'user_type'     => $userType,
                            'first_name'    => ucwords(strtolower($firstName)),
                            'last_name'     => ucwords(strtolower($lastName)),
                            'full_name'     => $fullName,
                            'dob'           => $dateOfBirth,
                            'mobile_number' => $mobileNumber,
                            'status'        => $userStatus,
                            'registration_no' => $registrationNo,
                            'speciality'    => $speciality
                        );
                    }
                    else if($userType == 'pharmacy')
                    {
                        $dataValues = array(
                            'user_type'     => $userType,
                            'pharmacy_name' => $pharmacyName,
                            'first_name'    => ucwords(strtolower($firstName)),
                            'last_name'     => ucwords(strtolower($lastName)),
                            'full_name'     => $fullName,
                            'mobile_number' => $mobileNumber,
                            'status'        => $userStatus,
                            'city'          => $city,
                            'area'          => $area
                        );
                    }

                    $isInsert = DB::table('user_master')->insertGetId($dataValues);
                    if($isInsert)
                    {
                        $_otp = 123456;
                        /*$_otp = $this->generateOTP();*/
                        $today = strtotime(date('Y-m-d H:i:s').'+15 min');
                        $otpExpiration = date('Y-m-d H:i:s',$today);
                        $isUpdate = DB::table('user_master')->where('id','=',$isInsert)->update(array('otp' => $_otp,'otp_expiration' => $otpExpiration));
                        if($userType != "pharmacy")
                        {
                            //$this->sendOTP($mobileNumber,$_otp);
                        }
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
                    }
                }
            }
        }
        else{
            $status = 'fail';
        }
        
        $resp = array('status' => $status,'errors'=>$errors,'userMsg'=>$userMsg,'userType'=>$userType);
        return response()->json($resp);
    }

    public function getAreaList(Request $request)
    {
        $areaList = [];
        $city = $request->get("cityId");
        $get_area_query = DB::table('area');
        $get_area_query->select('area.*','city.city_title');
        $get_area_query->leftJoin('city','city.id','=','area.city_id');
        if(isset($city) && !empty($city))
        {
            $get_area_query->where('city.id',$city);
        }
        $get_area_query->where('area.is_active', '1');
        $get_area_query->orderBy('area.area_title', 'ASC');
        $arr_area = $get_area_query->get();

        if(count($arr_area) > 0)
        {
            $status = 'success';
            foreach($arr_area as $key => $value)
            {
                $areaList[$key]['id']   = $value->id;
                $areaList[$key]['name'] = $value->area_title;
            }

            $resp = array('status' => $status,'areaList'=>$areaList);
            return response()->json($resp);    
        }
        else
        {
            $status = 'fail';
            $resp = array('status' => $status,'areaList'=>$areaList);
            return response()->json($resp);
        }
    }

    public function getCityList()
    {
        $cityList = [];
        $get_city_query = DB::table('city');
        $get_city_query->where('city.state_id', '22');
        $get_city_query->where('city.is_active', '1');
        $get_city_query->orderBy('city.city_title', 'ASC');
        $arr_city = $get_city_query->get();

        if(count($arr_city) > 0)
        {
            $status = 'success';
            foreach($arr_city as $key => $value)
            {
                $cityList[$key]['id']   = $value->id;
                $cityList[$key]['name'] = $value->city_title;
            }
            
            $resp = array('status' => $status,'cityList'=>$cityList);
            return response()->json($resp);    
        }
        else
        {
            $status = 'fail';
            $resp = array('status' => $status,'cityList'=>$cityList);
            return response()->json($resp);
        }
    }

    public function getSpecialityList()
    {
        $specialityList = [];
        $get_speciality_query = DB::table('speciality');
        $get_speciality_query->where('speciality.is_active', '1');
        $get_speciality_query->orderBy('speciality.name', 'ASC');
        $arr_speciality = $get_speciality_query->get();

        if(count($arr_speciality) > 0)
        {
            $status = 'success';
            foreach($arr_speciality as $key => $value)
            {
                $specialityList[$key]['id']   = $value->id;
                $specialityList[$key]['name'] = $value->name;
            }
            
            $resp = array('status' => $status,'specialityList'=>$specialityList);
            return response()->json($resp);    
        }
        else
        {
            $status = 'fail';
            $resp = array('status' => $status,'specialityList'=>$specialityList);
            return response()->json($resp);
        }
    }

    public function getDoctorList(Request $request)
    {
        $name = $request->get("name");
        $doctorList = [];

        $get_doctor = $this->UserMasterModel->where('user_type', 'doctor')
                                            ->where('status', 'active')
                                            ->with('speciality_data')
                                            ->where('first_name','LIKE',$name."%")
                                            ->orWhere('last_name','LIKE',$name."%")
                                            ->get();
        if($get_doctor)
        {
            $arr_doctor = $get_doctor->toArray();
        }        

        if(count($arr_doctor) > 0)
        {
            $status = 'success';
            $temp_arr=[]; $spe_arr=[];
            foreach($arr_doctor as $key => $value)
            {
                $temp_arr = explode(',', $value['speciality']);
                if(count($temp_arr)>0)
                {
                    $spe_arr = [];
                    foreach ($temp_arr as $temp_key) 
                    {
                       array_push($spe_arr, get_speciality_title($temp_key));
                    }
                } 
                $doctorList[$key]['speciality'] = $spe_arr;
                $doctorList[$key]['id']         = $value['id'];
                $doctorList[$key]['fullName']   = $value['first_name'].' '.$value['last_name'];
            }
            $resp = array('status' => $status,'doctorList'=>$doctorList);
            return response()->json($resp);    
        }
        else
        {
            $status = 'fail';
            $resp = array('status' => $status,'doctorList'=>$doctorList);
            return response()->json($resp);
        }
    }

    public function getDoctorList1(Request $request)
    {
        $doctorList = [];
        $name = $request->get("name");

        $query = DB::table('user_master AS tbl_USER');
        $query->select( 'tbl_USER.*', 'speciality.name AS doc_speciality');
        $query->where('tbl_USER.user_type', 'doctor');
        $query->leftJoin('speciality','speciality.id','=','tbl_USER.speciality');
        if(isset($name) && !empty($name))
        {
            $query->where('tbl_USER.first_name','LIKE',"%".$name."%");
        }
        $arr_doctor = $query->get();


        if(count($arr_doctor) > 0)
        {
            $status = 'success';
            foreach($arr_doctor as $key => $value)
            {
                $doctorList[$key]['id']   = $value->id;
                $doctorList[$key]['fullName'] = $value->first_name.' '.$value->last_name;
                $doctorList[$key]['doc_speciality'] = $value->doc_speciality;
            }

            $resp = array('status' => $status,'doctorList'=>$doctorList);
            return response()->json($resp);    
        }
        else
        {
            $status = 'fail';
            $resp = array('status' => $status,'doctorList'=>$doctorList);
            return response()->json($resp);
        }
    }

    public function getPharmacyList(Request $request)
    {
        $pharmacyList = [];
        $area = $request->get("areaId");
        $name = $request->get("name");

        $query = DB::table('user_master AS tbl_USER');
        $query->select( 'tbl_USER.*', 'area.area_title');
        $query->where('tbl_USER.user_type', 'pharmacy');
        $query->leftJoin('area','area.id','=','tbl_USER.area');
        if(isset($area) && !empty($area))
        {
            $query->where('area.id',$area);
        }
        if(isset($name) && !empty($name))
        {
            $query->where('tbl_USER.pharmacy_name','LIKE',$name.'%');
        }
        $arr_pharmacy = $query->get();

        if(count($arr_pharmacy) > 0)
        {
            $status = 'success';
            foreach($arr_pharmacy as $key => $value)
            {
                $pharmacyList[$key]['id']   = $value->id;
                $pharmacyList[$key]['pharmacy_name']   = $value->pharmacy_name;
                $pharmacyList[$key]['first_name']   = $value->first_name;
                $pharmacyList[$key]['last_name']   = $value->last_name;
                $pharmacyList[$key]['full_name']   = $value->full_name;
                $pharmacyList[$key]['name'] = $value->area_title;
            }

            $resp = array('status' => $status,'pharmacyList'=>$pharmacyList);
            return response()->json($resp);    
        }
        else
        {
            $status = 'fail';
            $resp = array('status' => $status,'pharmacyList'=>$pharmacyList);
            return response()->json($resp);
        }
    }

    public function register_Old()
    {
        $status = 'fail';
        $errors = $userMsg = $userType = '';
        $postdata = file_get_contents("php://input");

        if(isset($postdata) && !empty($postdata))
        {
            $request = json_decode($postdata);
            if(count($request))
            {
                $userType       = $this->validateInput($request->userType);
                $firstName      = $this->validateInput($request->firstName);
                $lastName       = $this->validateInput($request->lastName);
                $dateOfBirth    = $this->validateInput($request->dateOfBirth);
                $mobileNumber   = $this->validateInput($request->mobileNumber);

                if(empty($userType))
                {
                    $resp = array('status' => 'fail','errors'=>$errors,'userMsg'=> 'Please slect user type.');
                    return response()->json($resp);
                }
                else if(empty($firstName))
                {
                    $resp = array('status' => 'fail','errors'=>$errors,'userMsg'=> 'First name is empty.');
                    return response()->json($resp);
                }
                else if(empty($lastName))
                {
                    $resp = array('status' => 'fail','errors'=>$errors,'userMsg'=> 'Last name is empty.');
                    return response()->json($resp);
                }
                else if(empty($dateOfBirth))
                {
                    $resp = array('status' => 'fail','errors'=>$errors,'userMsg'=> 'Date of birth is empty.');
                    return response()->json($resp);
                }
                else if(empty($mobileNumber))
                {
                    $resp = array('status' => 'fail','errors'=>$errors,'userMsg'=> 'Mobile number is empty.');
                    return response()->json($resp);
                }

                $isExists = DB::table('user_master AS USER')->where('mobile_number','=',$mobileNumber)->count();
                if($isExists)
                {
                    $status = 'fail';
                    $userMsg = 'Mobile number is already exists.';
                }
                else
                {
                    $userStatus = $userType == "pharmacy"?'blocked':'active';
                    $fullName = ucwords(strtolower($firstName)).' '.ucwords(strtolower($lastName));
                    $dataValues = array(
                        'user_type'     => $userType,
                        'first_name'    => ucwords(strtolower($firstName)),
                        'last_name'     => ucwords(strtolower($lastName)),
                        'full_name'     => $fullName,
                        /*'dob'           => date('Y-m-d',strtotime($dateOfBirth)),*/
                        'dob'           => $dateOfBirth,
                        'mobile_number' => $mobileNumber,
                        'status'        => $userStatus
                    );
                    $isInsert = DB::table('user_master')->insertGetId($dataValues);
                    if($isInsert)
                    {
                        $_otp = 123456;
                        /*$_otp = $this->generateOTP();*/
                        $today = strtotime(date('Y-m-d H:i:s').'+15 min');
                        $otpExpiration = date('Y-m-d H:i:s',$today);
                        $isUpdate = DB::table('user_master')->where('id','=',$isInsert)->update(array('otp' => $_otp,'otp_expiration' => $otpExpiration));
                        if($userType != "pharmacy")
                        {
                            //$this->sendOTP($mobileNumber,$_otp);
                        }
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
                    }
                }
            }
        }
        else{
            $status = 'fail';
        }
        $resp = array('status' => $status,'errors'=>$errors,'userMsg'=>$userMsg,'userType'=>$userType);
        return response()->json($resp);
    }

    public function login()
    {
        $status = 'fail';
        $errors = $userMsg = '';
        $postdata = file_get_contents("php://input");
        /*echo $postdata;*/
        if(isset($postdata) && !empty($postdata))
        {
            $request = json_decode($postdata);
            if(count($request))
            {
                $mobileNumber   = $this->validateInput($request->mobileNumber);
                $isExists = DB::table('user_master AS USER')
                    ->select('id','status')->where('mobile_number','=',$mobileNumber)->first();
                if(count($isExists))
                {
                    if($isExists->status == "active")
                    {
                        $_otp = 123456;
                        /*$_otp = $this->generateOTP();*/
                        /*$this->sendOTP($mobileNumber,$_otp);*/
                        $today = strtotime(date('Y-m-d H:i:s').'+15 min');
                        $otpExpiration = date('Y-m-d H:i:s',$today);
                        DB::table('user_master')->where('id','=',$isExists->id)->update(array('otp' => $_otp,'otp_expiration' => $otpExpiration));
                        @chmod('uploads', 0777);
                        @chmod('uploads/all_users', 0777);
                        $targetDir = 'uploads/all_users/'.$isExists->id;
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
                    }
                    else
                    {
                        $userMsg = 'Your account is deactivated by admin.';
                    }
                }
                else
                {
                    $status = 'fail';
                    $userMsg = 'The mobile number you are trying to login is not exists.';
                }
            }
        }
        else{
            $status = 'fail';
        }
        $resp = array('status' => $status,'errors'=>$errors,'userMsg'=>$userMsg);
        return response()->json($resp);
    }

    public function verifyOTP(Request $request)
    {
        $status = 'fail';
        $errors = $userMsg = $userId = $encUserId = $userType = '';
        $postdata = file_get_contents("php://input");
        if(isset($postdata) && !empty($postdata))
        {
            $request = json_decode($postdata);
            if(count($request))
            {
                $userOTP        = $this->validateInput($request->userOTP);
                $mobileNumber   = $this->validateInput($request->mobileNumber);
                $isExists = DB::table('user_master AS USER')
                    ->select(
                        DB::raw('SHA2(tbl_USER.id,256) AS priKey'),
                        DB::raw('ROUND((UNIX_TIMESTAMP(tbl_USER.otp_expiration) - UNIX_TIMESTAMP(now()) ) / 60) AS diffMinutes'),
                        'USER.id',
                        'USER.user_type AS userType',
                        'USER.first_name',
                        'USER.last_name',
                        'USER.mobile_number',
                        'USER.status'
                    )
                    ->where('otp','=',$userOTP)->where('mobile_number','=',$mobileNumber)->first();
                if(count($isExists))
                {
                    if($isExists->status == 'blocked')
                    {
                        $userMsg = 'Your account is not yet activated.';    
                    }
                    else if($isExists->diffMinutes < 0)
                    {
                        $userMsg = 'Your OTP is expired.';    
                    }
                    else
                    {
                        $userId     = $isExists->id;
                        $encUserId  = $isExists->priKey;
                        $userType  = $isExists->userType;
                        $status  = 'success';
                        DB::table('user_master AS USER')->where('mobile_number','=',$mobileNumber)->update(array('otp'=>NULL,'otp_expiration'=>NULL));
                    }
                    
                }
                else
                {
                    $status = 'fail';
                    $userMsg = 'The OTP you entered is incorrect.';
                }
            }
        }
        else{
            $status = 'fail';
        }
        $resp = array('status' => $status,'errors'=>$errors,'userMsg'=>$userMsg,'userId'=>$userId,'encUserId'=>$encUserId,'userType'=>$userType);
        return response()->json($resp);
    }

    public function createOrder(Request $request)
    {
        $status     = 'fail';
        $userMsg    = $recStatus = $errors = $file_name = $selDoctor = '';
        /* if (isset($_SERVER['HTTP_ORIGIN'])) {
            header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
            header('Access-Control-Allow-Credentials: true');
            header('Access-Control-Max-Age: 86400');    // cache for 1 day
        }
     
        // Access-Control headers are received during OPTIONS requests
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
     
            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
                header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
     
            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
                header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
     
            exit(0);
        }*/
        /*header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, PUT, OPTIONS");
        header("content-type: application/json; charset=utf-8");
        $postdata = file_get_contents("php://input");
        echo $postdata;
        print_r($_REQUEST);
        print_r($_FILES);*/
        
        if(isset($_POST) && !empty($_POST))
        {
            $txtSenderId     = $this->validateInput($_POST['txtSenderId']);
            $txtName         = $this->validateInput($_POST['txtName']);
            $txtMobileNumber = $_POST['txtMobileNumber'];
            $selDoctor       = $_POST['selDoctor'];
            $selPharmacy     = $_POST['selPharmacy'];
            $txtUserType     = $_POST['txtUserType'];
            $orderType       = $_POST['orderType'];

            if(!empty($txtSenderId) && /*!empty($txtName) && !empty($txtMobileNumber) && !empty($selDoctor) &&*/ !empty($selPharmacy) && !empty($txtUserType))
            {
                $query = DB::table('user_master AS tbl_USER');
                $query->select('tbl_USER.id');
                $query->whereRaw('SHA2(tbl_tbl_USER.id,256) =  "'.$txtSenderId.'" ');
                $arrData = $query->first();

                if(count($arrData))
                {
                    if($_FILES['prescriptionPic']['name'])
                    {
                        if($_FILES["prescriptionPic"]["error"] == 0)
                        {
                            $fileSize = $_FILES["prescriptionPic"]["size"];
                            if($fileSize > 2097152)
                            {
                                $status  = 'fail';
                                $userMsg = 'File size must be exactly 2 MB';
                            }
                            else
                            {
                                if(is_dir('uploads/all_users/'.$arrData->id))
                                {
                                    $file_name = $_FILES['prescriptionPic']['name'];
                                    /*$file_extension = strtolower($request->file('fileName')->getClientOriginalExtension());*/
                                    $allowed =  array('gif','png' ,'jpg');
                                    $filename = $_FILES['prescriptionPic']['name'];
                                    $file_extension = pathinfo($filename, PATHINFO_EXTENSION);

                                    if(in_array($file_extension,['png','jpg','jpeg']))
                                    {
                                        $file_name = time().'_prescription_'.$arrData->id.'.'.$file_extension;
                                        /*$isUpload = $request->file('fileName')->move('uploads/all_users/'.$arrData->id.'/', $file_name);*/
                                        $isUpload = move_uploaded_file($_FILES['prescriptionPic']['tmp_name'], 'uploads/all_users/'.$arrData->id.'/'.$file_name);
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

                                                if($txtUserType == 'doctor')
                                                {
                                                    $query = DB::table('user_master AS tbl_USER');
                                                    $query->where('tbl_USER.id', $selDoctor);
                                                    $arr_data = $query->first();

                                                    if(!count($arr_data))
                                                    {
                                                        $dataValues = array(
                                                            'user_type'     => 'unverified-doctor',
                                                            'first_name'    => $firstName,
                                                            'last_name'     => $lastName,
                                                            'full_name'     => $fullName,
                                                            'status'        => 'blocked'
                                                        );
                                                        $isInsert = DB::table('unverified_doctor')->insertGetId($dataValues);

                                                        if($isInsert)
                                                        {

                                                            $orderId    = $this->createOrderId('order_prescriptions','order_id');
                                                            $dataOrders = array(
                                                                'sender_id'             =>  $arrData->id,
                                                                'sent_for'              =>  $isInsert,
                                                                'receiver_id'           =>  $selPharmacy,
                                                                'doctor_id'             =>  $selDoctor,
                                                                'order_id'              =>  $orderId,
                                                                'order_type'            =>  $orderType,
                                                                'prescription_image'    =>  $file_name,
                                                                'is_doctor_unverified'  =>  '1'
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

                                                        $orderId    = $this->createOrderId('order_prescriptions','order_id');
                                                        $dataOrders = array(
                                                            'sender_id'          =>  $arrData->id,
                                                            'sent_for'           =>  $selDoctor,
                                                            'receiver_id'        =>  $selPharmacy,
                                                            'doctor_id'          =>  $selDoctor,
                                                            'order_id'           =>  $orderId,
                                                            'order_type'         =>  $orderType,
                                                            'prescription_image' =>  $file_name
                                                        );
                                                        
                                                        $res       = DB::table('order_prescriptions')->insertGetId($dataOrders);

                                                        $status    = 'success';
                                                        $recStatus = 'new';
                                                        $userMsg   = 'Precription sent successfully.';
                                                    }
                                                    
                                                }
                                                else
                                                {

                                                    $query = DB::table('user_master AS tbl_USER');
                                                    $query->where('tbl_USER.id', $selDoctor);
                                                    $arr_data = $query->first();

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

                                                        $orderId    = $this->createOrderId('order_prescriptions','order_id');
                                                        $dataOrders = array(
                                                            'sender_id'          =>  $arrData->id,
                                                            'sent_for'           =>  $isInsert,
                                                            'receiver_id'        =>  $selPharmacy,
                                                            'doctor_id'          =>  $selDoctor,
                                                            'order_id'           =>  $orderId,
                                                            'order_type'         =>  $orderType,
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
                                                
                                            }
                                            else
                                            {
                                                $orderId    = $this->createOrderId('order_prescriptions','order_id');
                                                $dataOrders = array(
                                                    'sender_id'          =>  $arrData->id,
                                                    'sent_for'           =>  $isFound->id,
                                                    'receiver_id'        =>  $selPharmacy,
                                                    'doctor_id'          =>  $selDoctor,
                                                    'order_id'           =>  $orderId,
                                                    'order_type'         =>  $orderType,
                                                    'prescription_image' =>  $file_name
                                                );
                                                $res       = DB::table('order_prescriptions')->insertGetId($dataOrders);
                                                $status    = 'success';
                                                $recStatus = 'new';
                                                $userMsg   = 'Precription sent successfully.';
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
                        }
                        else{
                            $userMsg = 'Error in uploading image.';
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
            else
            {
                return json_encode(['errors' => 'Sender id, name, mobile number, selPharmacy and user type should not be empty ','code' => 422,'userMsg' => $userMsg,'status' => 'fail']); 
            }
        }
        else
        {
           $userMsg = 'Something went wrong, please try again.';
        }
        $resp = array('status' => $status,'errors'=>$errors,'userMsg'=>$userMsg,'recStatus'=>$recStatus,'file_name' => $file_name);
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
        $query->whereNotNull('tbl_CITY.city_title');
        $query->whereNotNull('tbl_USER.address');
        $query->orderBy('tbl_CITY.city_title', 'ASC');
        $arrData = $query->get();
        if(count($arrData))
        {
            $status = 'success';
            foreach($arrData as $key => $value)
            {
                $pharmaciesList[$key]['id'] = $value->id;
                /*$pharmaciesList[$key]['name'] = ucwords($value->fullName).' ('.$value->address.', '.$value->city_title.')';*/
                $pharmaciesList[$key]['name'] = $value->address.', '.$value->city_title;
            }
        }
        $resp = array('status' => $status,'pharmaciesList'=>$pharmaciesList);
        return response()->json($resp);
    }

    public function get_Pharmacies(Request $request)
    {
        /*header('Access-Control-Allow-Origin: *');*/
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: Cache-Control, Pragma, Origin, Authorization, Content-Type, X-Requested-With');
        header('Access-Control-Allow-Methods: GET, PUT, POST');
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
                /*$pharmaciesList[$key]['name'] = ucwords($value->fullName).' ('.$value->address.', '.$value->city_title.')';*/
                $pharmaciesList[$key]['name'] = $value->address.', '.$value->city_title;
            }
        }
        $resp = array('status' => $status,'pharmaciesList'=>$pharmaciesList);
        return response()->json($resp);
    }

    public function validateInput($data)
    {
        $data = trim($data);
        /*$data = preg_replace('/\s+/','',$data);*/
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        $data = filter_var(trim($data), FILTER_SANITIZE_STRING);
        return $data;
    }

    public function filterString($field)
    {
        // Sanitize string
        $field = filter_var(trim($field), FILTER_SANITIZE_STRING);
        if(!empty($field)){
            return $field;
        }else{
            return FALSE;
        }
    }

    public function sendOTP($mobileNumber, $userOTP)
    {
        $ch = curl_init();
        $response = curl_setopt($ch, CURLOPT_URL, "http://103.16.101.52:80/sendsms/bulksms?username=stec-webwing&password=webwing&type=0&dlr=1&destination=".$mobileNumber."&source=MARMOR&message=Hello%2C+".$userOTP."+is+your+OTP+code+for+account+verification.+do+not+share+with+anyone.");
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }

    public function getTinyUrl($url)
    {
        $ch = curl_init();  
        $timeout = 5;  
        curl_setopt($ch,CURLOPT_URL,'http://tinyurl.com/api-create.php?url='.$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }

    public function generateOTP()
    {
     $num_chars = 6;
     $i = 0;
     $my_keys = "0123456789";
     $keys_length = strlen($my_keys);
     $_otp  = '';
     while($i<$num_chars)
     {
        $rand_num = mt_rand(1, $keys_length-1);
        $_otp .= $my_keys[$rand_num];
        $i++;
     }
     return $_otp;
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

    public function previewPrescription($orderId)
    {   
        $query = DB::table('order_prescriptions AS ORDERS');
        $query->select('ORDERS.id','ORDERS.sender_id','ORDERS.prescription_image AS prescriptionImage');
        $query->whereRaw('SHA2(tbl_ORDERS.id, 256) = "'.$orderId.'"');
        $dataOrders = $query->first();

        $imagePath = url('').'/images/img-not-found.png';
        if(count($dataOrders))
        {
            if(file_exists('uploads/all_users/'.$dataOrders->sender_id.'/'.$dataOrders->prescriptionImage))
            {
                $imagePath = url('').'/uploads/all_users/'.$dataOrders->sender_id.'/'.$dataOrders->prescriptionImage;
            }
        }
        echo '<img src="'.$imagePath.'" height="500" width="500">';
        /*$fileName = base64_decode($enc_url);*/
        /*return response()->file($imagePath);*/
    }
}