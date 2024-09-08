<?php

namespace App\Http\Controllers\Front;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\MasterModel;
use Validator;
use Session;
use Flash;
use DB;

class OrderHistoryController extends Controller
{
    public function __construct(MasterModel $MasterModel)
    {
       $this->MasterModel                   = $MasterModel;
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, Accept, Authorization, X-Requested-With, Application');       
    }

    public function index(Request $request)
    {  
        $status           = 'fail';
        $userMsg          = $errors = $recStatus = '';
        $postdata         = file_get_contents("php://input");
        $orderHistoryData = [];

        if(isset($postdata) && !empty($postdata))
        {
            $request = json_decode($postdata);
        
            $pharmacist_id     = $request->pharmacist_id;
            $order_id          = $request->order_id;

            if(!empty($pharmacist_id))
            {
                $query = DB::table('order_prescriptions AS ORDERS');
                $query->select(
                    DB::raw('SHA2(tbl_ORDERS.id,256) AS orderKey'),
                    'ORDERS.order_id',
                    'ORDERS.status AS orderStatus',
                    'ORDERS.total_price AS orderPrice'
                );
                $query->leftJoin('user_master AS SENDER','SENDER.id','=','ORDERS.sender_id');
                $query->leftJoin('user_master AS SENTFOR','SENTFOR.id','=','ORDERS.sent_for');
                $query->leftJoin('user_master AS RECEIVER','RECEIVER.id','=','ORDERS.receiver_id');
                $query->leftJoin('city AS CITY','CITY.id','=','RECEIVER.city');
                $query->leftJoin('state AS STATE','STATE.id','=','RECEIVER.state');
                $query->leftJoin('countries AS COUNTRY','COUNTRY.id','=','RECEIVER.country');       
                $query->whereRaw('SHA2(tbl_ORDERS.receiver_id,256) =  "'.$pharmacist_id.'" ');
                //$query->whereIn('ORDERS.status',array('accepted','pending','completed'));

                if(isset($order_id) && !empty($order_id))
                {
                    $query->where('ORDERS.order_id', "like" ,'%'.$order_id);
                    $query->orWhere('SENDER.mobile_number', "like" ,$order_id.'%');
                    $query->orWhere('SENTFOR.mobile_number', "like" ,$order_id.'%');
                }

                $query->orderBy('ORDERS.sent_on', 'DESC');
                $dataOrders = $query->paginate(20);

                if(!empty($dataOrders))
                {
                    $orderHistoryData = $dataOrders->toArray();
                }
               
                if(!empty($orderHistoryData['data']))
                {
                    $status = "success";
                }
                else
                {
                    $status  = "fail";
                    $userMsg = 'No data available';
                }
            }
            else
            {
                $errors = "Pharmacist id shuold not be empty";
            }
        }
        else
        {
            $errors = "'Something went wrong, please try again.'";
        } 

        $resp = array('status' => $status, 'errors' => $errors, 'orderHistoryData' => $orderHistoryData, 'userMsg' => $userMsg);
        return response()->json($resp);
    } 

    public function proceedOrder(Request $request)
    {
        DB::enableQueryLog();
        $dataOrders = [];
        $status     = 'fail';
        $userMsg    = $recStatus = '';

        $postdata         = file_get_contents("php://input");
        $orderHistoryData = [];


        if(isset($postdata) && !empty($postdata))
        {
            $request = json_decode($postdata);
        
            $_mode      = !isset($request->_mode) && empty($request->_mode)?'view':$request->_mode;
            $id         = $request->id;
            if(!empty($id) && !empty($_mode))
            {
                switch ($_mode) {
                case 'accept':
                    $dataValues = array('status' => 'accepted');
                    $isEdit = DB::table('order_prescriptions')->whereRaw('SHA2(id, 256) = "'.$id.'"')->update($dataValues);
                    $queries = DB::getQueryLog();
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
                        'ORDERS.order_type AS orderType',
                        DB::raw('CONCAT("uploads/all_users/",tbl_ORDERS.sender_id,"/",tbl_ORDERS.prescription_image) AS prescriptionImage'),
                        'ORDERS.status AS orderStatus'
                    );
                    $query->leftJoin('user_master AS SENDER','SENDER.id','=','ORDERS.sender_id');
                    $query->leftJoin('user_master AS SENTFOR','SENTFOR.id','=','ORDERS.sent_for');
                    $query->leftJoin('user_master AS RECEIVER','RECEIVER.id','=','ORDERS.receiver_id');
                    $query->whereRaw('SHA2(tbl_ORDERS.id, 256) = "'.$id.'"');
                    $dataOrders = $query->first();
                    $status     = 'success';
                break;
                case 'complete':
                    $query = DB::table('order_prescriptions AS ORDERS');
                    $query->select(DB::raw('SHA2(tbl_ORDERS.id,256) AS orderKey'));
                    $query->whereRaw('SHA2(tbl_ORDERS.id, 256) = "'.$id.'"');
                    $dataOrders = $query->first();
                    $status     = 'success';
                break;
                case 'reject':
                    $dataValues = array('status' => 'rejected');
                    $isEdit     = DB::table('order_prescriptions')->whereRaw('SHA2(id, 256) = "'.$id.'"')->update($dataValues);
                    if($isEdit)
                    {
                        $status  = 'success';
                        $userMsg = 'Prescription order rejected successfully.';
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
            else
            {
                 $userMsg = "Pharmacist id and mode shuold not be empty";
            }
        }
        else
        {
             $userMsg = "'Something went wrong, please try again.'";
        }

        $resp = array('status' => $status, 'dataOrders' => $dataOrders, 'userMsg' => $userMsg);
        return response()->json($resp);
    }

    public function completeOrder(Request $request)
    {
        $status     = 'fail';
        $userMsg    = $errors = $recStatus = $txtOrderValue = '';
        $postdata   = file_get_contents("php://input");

        if(isset($postdata) && !empty($postdata))
        {
            $request         = json_decode($postdata);
            $_txtOrderId     = $request->_txtOrderId;
            $txtOrderValue   = $request->txtOrderValue;

            if(!empty($txtOrderValue) && !empty($_txtOrderId))
            {
                $dataValues  = array('status' => 'completed', 'total_price' => $txtOrderValue);
                $isEdit      = DB::table('order_prescriptions')->whereRaw('SHA2(id, 256) = "'.$_txtOrderId.'"')->update($dataValues);
                if($isEdit)
                {
                    $status  = 'success';
                    $userMsg = 'Prescription order completed successfully.';
                }
                else
                {
                    $errors = 'Error in completing prescription order.';
                }
            }
            else
            {
                $errors = 'Order id and order value should not be empty ';
            }
        }
        else
        {
            $errors = 'Something went wrong, please try again.';
        }
       
        $resp = array('status' => $status,'errors'=>$errors,'userMsg'=>$userMsg,'recStatus'=>$recStatus, 'orderValue'=>$txtOrderValue);
        return response()->json($resp);
    }

    public function getOrder(Request $request)
    {
        $status = 'fail';
        $errors = $dataOrders = '';

        $orderKey = $request->id;

        if($orderKey != '')
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
                'ORDERS.order_type AS orderType',
                'ORDERS.total_price AS orderPrice',
                
                DB::raw('CONCAT("uploads/all_users/",tbl_ORDERS.sender_id,"/",tbl_ORDERS.prescription_image) AS prescriptionImage'),
                'ORDERS.status AS orderStatus'
            );
            $query->leftJoin('user_master AS SENDER','SENDER.id','=','ORDERS.sender_id');
            $query->leftJoin('user_master AS SENTFOR','SENTFOR.id','=','ORDERS.sent_for');
            $query->leftJoin('user_master AS RECEIVER','RECEIVER.id','=','ORDERS.receiver_id');
            $query->whereRaw('SHA2(tbl_ORDERS.id, 256) = "'.$orderKey.'"');
            $dataOrders = $query->first();
            $status     = 'success';

            $status  = 'success';
        }
        else
        {
            $errors = 'Please select any order';
        }

        $resp = array('status' => $status,'errors'=>$errors,'orderData'=>$dataOrders);
        return response()->json($resp);           
    }
}