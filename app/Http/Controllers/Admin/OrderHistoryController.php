<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\MasterModel;
use Validator;
use Flash;
use DB;
use Datatables;
use Sentinel;

class OrderHistoryController extends Controller
{
    protected $module_icon, $module_url_path, $module_view_folder, $module_title;

    public function __construct(MasterModel $MasterModel)
    {
        $this->MasterModel                   = $MasterModel;
    	$this->module_title         = "Prescription Order History";
        $this->module_url_path      = url(config('app.project.admin_panel_slug')."/order_history/");
        $this->module_view_folder   = 'admin.order_history';

        $this->uploads_public_path          = url('/').'/uploads/all_users/';
        $this->user_profile_public_img_path = url('/').'/uploads/all_users/profile';
        $this->module_icon                  = "fa-cart-plus";
    }

    public function index(Request $request)
    {
        $query = DB::table('order_prescriptions AS ORDERS');
        $query->select(
            DB::raw('SHA2(tbl_ORDERS.id,256) AS orderKey'),
            DB::raw('SHA2(tbl_SENDER.id,256) AS senderKey'),
            DB::raw('LCASE(tbl_SENDER.full_name) AS senderFullName'),

            DB::raw('SHA2(tbl_SENTFOR.id,256) AS sentForKey'),
            DB::raw('LCASE(tbl_SENTFOR.full_name) AS sentForFullName'),

            DB::raw('SHA2(tbl_UNVDOC.id,256) as docsentForKey'),
            DB::raw('LCASE(tbl_UNVDOC.full_name) AS docsentForFullName'),

            DB::raw('SHA2(tbl_RECEIVER.id,256) AS receiverKey'),
            DB::raw('LCASE(tbl_RECEIVER.full_name) AS receiverFullName'),

            DB::raw('DATE_FORMAT(tbl_ORDERS.sent_on,"%d-%m-%Y %T") AS orderedSentOn'),
            'SENDER.id AS senderId',
            'SENDER.user_type AS senderUT',
            'SENDER.mobile_number AS senderMobile',

            'SENTFOR.id AS sentForId',
            'SENTFOR.user_type AS sentForUT',
            'SENTFOR.mobile_number AS sentForMobile',

            'RECEIVER.id AS receiverId',
            'RECEIVER.user_type AS receiverUT',
            'RECEIVER.mobile_number AS receiverMobile',
            'RECEIVER.address AS receiverAddress',
            'RECEIVER.zipcode AS receiverZipcode',

            'COUNTRY.country_name AS receiverCountry',
            'STATE.state_title',
            'CITY.city_title',

            'ORDERS.order_id',
            'ORDERS.order_type',
            'ORDERS.prescription_image',
            'ORDERS.is_doctor_unverified',
            'ORDERS.total_price AS totalPrice',

            'UNVDOC.id AS docsentForId',
            'UNVDOC.user_type AS docsentForUT',

            DB::raw('CONCAT("uploads/all_users/",tbl_ORDERS.sender_id,"/",tbl_ORDERS.prescription_image) AS prescriptionImage'),
            'ORDERS.status AS orderStatus'
            /*DB::raw('LOAD_FILE("uploads/all_users/1019/1515151371_prescription_1019.png") AS isFound'),
            DB::raw('LOAD_FILE(CONCAT("uploads/all_users/",tbl_ORDERS.sender_id,"/",tbl_ORDERS.prescription_image)) IS NOT NULL AS isFound')*/
        );
        $query->leftJoin('user_master AS SENDER','SENDER.id','=','ORDERS.sender_id');
        $query->leftJoin('unverified_doctor AS UNVDOC','UNVDOC.id','=','ORDERS.sent_for');
        $query->leftJoin('user_master AS SENTFOR','SENTFOR.id','=','ORDERS.sent_for');
        $query->leftJoin('user_master AS RECEIVER','RECEIVER.id','=','ORDERS.receiver_id');
        $query->leftJoin('city AS CITY','CITY.id','=','RECEIVER.city');
        $query->leftJoin('state AS STATE','STATE.id','=','RECEIVER.state');
        $query->leftJoin('countries AS COUNTRY','COUNTRY.id','=','RECEIVER.country');
        /*$query->whereRaw('LOAD_FILE(CONCAT("uploads/all_users/",tbl_ORDERS.sender_id,"/",tbl_ORDERS.prescription_image)) IS NOT NULL');*/
        /*$query->whereRaw('ISNULL(LOAD_FILE(prescriptionImage))');*/
        $query->orderBy('ORDERS.sent_on', 'DESC');
        $dataOrders = $query->paginate(20);
        /*echo '<pre>';
        print_r($dataOrders);
        die;*/

        $this->arr_view_data['dataOrders'] = $dataOrders;
        $this->arr_view_data['page_title']      = "Manage ".str_singular($this->module_title);
    	$this->arr_view_data['module_title']    = $this->module_title;
    	$this->arr_view_data['module_url_path'] = $this->module_url_path;
    	$this->arr_view_data['module_icon']     = $this->module_icon;
        if($request->ajax()) {
            return view($this->module_view_folder.'.ajax.index',$this->arr_view_data)->render();
        }
    	return view($this->module_view_folder.'.index', $this->arr_view_data);
    }

    public function proceedOrder(Request $request, $_mode = false)
    {
        $status  = 'fail';
        $userMsg = '';
        $dataOrders = [];
        $_mode = !isset($_mode) && empty($_mode)?'view':$_mode;
        $id = $request->get('id');
        if(!empty($id))
        {
            switch ($_mode) {
                case 'accept':
                    $dataValues = array('status' => 'accepted');
                    $isEdit = DB::table('order_prescriptions')->whereRaw('SHA2(id, 256) = "'.$id.'"')->update($dataValues);
                    if($isEdit)
                    {
                        $status  = 'success';
                        $userMsg = 'Prescription order accepted successfully.';
                    }
                    else
                    {
                        $userMsg = 'Error in accepting prescription order.';
                    }
                break;
                case 'view':
                    $query = DB::table('order_prescriptions AS ORDERS');
                    $query->select(
                        DB::raw('SHA2(tbl_ORDERS.id,256) AS orderKey'),
                        DB::raw('SHA2(tbl_SENDER.id,256) AS senderKey'),
                        DB::raw('LCASE(tbl_SENDER.full_name) AS senderFullName'),

                        DB::raw('SHA2(tbl_SENTFOR.id,256) AS sentForKey'),
                        DB::raw('LCASE(tbl_SENTFOR.full_name) AS sentForFullName'),

                        DB::raw('SHA2(tbl_UNVDOC.id,256) as docsentForKey'),
                        DB::raw('LCASE(tbl_UNVDOC.full_name) AS docsentForFullName'),

                        DB::raw('SHA2(tbl_RECEIVER.id,256) AS receiverKey'),
                        DB::raw('LCASE(tbl_RECEIVER.full_name) AS receiverFullName'),

                        DB::raw('DATE_FORMAT(tbl_ORDERS.sent_on,"%d-%m-%Y") AS orderedSentOn'),
                        'SENDER.id AS senderId',
                        'SENDER.user_type AS senderUT',
                        'SENDER.mobile_number AS senderMobile',

                        'SENTFOR.id AS sentForId',
                        'SENTFOR.user_type AS sentForUT',
                        'SENTFOR.mobile_number AS sentForMobile',

                        'RECEIVER.id AS receiverId',
                        'RECEIVER.user_type AS receiverUT',
                        'RECEIVER.mobile_number AS receiverMobile',

                        'RECEIVER.address AS receiverAddress',
                        'RECEIVER.zipcode AS receiverZipcode',
                        
                        'ORDERS.order_id',
                        'ORDERS.is_doctor_unverified',

                        'UNVDOC.id AS docsentForId',
                        'UNVDOC.user_type AS docsentForUT',

                        DB::raw('CONCAT("uploads/all_users/",tbl_ORDERS.sender_id,"/",tbl_ORDERS.prescription_image) AS prescriptionImage'),
                        'ORDERS.status AS orderStatus'
                    );
                    $query->leftJoin('user_master AS SENDER','SENDER.id','=','ORDERS.sender_id');
                    $query->leftJoin('unverified_doctor AS UNVDOC','UNVDOC.id','=','ORDERS.sent_for');
                    $query->leftJoin('user_master AS SENTFOR','SENTFOR.id','=','ORDERS.sent_for');
                    $query->leftJoin('user_master AS RECEIVER','RECEIVER.id','=','ORDERS.receiver_id');
                    $query->whereRaw('SHA2(tbl_ORDERS.id, 256) = "'.$id.'"');
                    $dataOrders = $query->first();
                    $status  = 'success';
                break;
                case 'complete':
                    $query = DB::table('order_prescriptions AS ORDERS');
                    $query->select(DB::raw('SHA2(tbl_ORDERS.id,256) AS orderKey'));
                    $query->whereRaw('SHA2(tbl_ORDERS.id, 256) = "'.$id.'"');
                    $dataOrders = $query->first();
                    $status  = 'success';
                break;
                case 'reject':
                    $dataValues = array('status' => 'rejected');
                    $isEdit = DB::table('order_prescriptions')->whereRaw('SHA2(id, 256) = "'.$id.'"')->update($dataValues);
                    if($isEdit)
                    {
                        $status  = 'success';
                        $userMsg = 'Prescription order rejected.';
                    }
                    else
                    {
                        $userMsg = 'Error in rejecting prescription order.';
                    }
                break;
                default:
                break;
            }    
        }
        $resp = array('status' => $status, 'errors' => '', 'dataOrders' => $dataOrders, 'userMsg' => $userMsg);
        return response()->json($resp);
    }

    public function completeOrder(Request $request)
    {
        $status = 'fail';
        $userMsg = $recStatus = $errors = '';
        $rules = array(
            '_txtOrderId'   => 'required',
            'txtOrderValue' => 'required'
        );
        $messages = array(
            '_txtOrderId.required'      => 'Order id is missing.',
            'txtOrderValue.required' => 'Please enter order value.',
            'txtOrderValue.numeric'  => 'Order value must be digits only (0-9).'
        );
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails())
        {
           return json_encode(['errors' => $validator->errors()->getMessages(),'code' => 422,'userMsg' => $userMsg,'status' => 'fail']);
        }
        else
        {
            $_txtOrderId     = $request->input('_txtOrderId');
            $txtOrderValue   = $request->input('txtOrderValue');
            $dataValues = array('status' => 'completed', 'total_price' => $txtOrderValue);
            $isEdit = DB::table('order_prescriptions')->whereRaw('SHA2(id, 256) = "'.$_txtOrderId.'"')->update($dataValues);
            if($isEdit)
            {
                $status  = 'success';
                $userMsg = 'Prescription order completed successfully.';
            }
            else
            {
                $userMsg = 'Error in completing prescription order.';
            }
        }
        $resp = array('status' => $status,'errors'=>$errors,'userMsg'=>$userMsg,'recStatus'=>$recStatus);
        return response()->json($resp);
    }
}