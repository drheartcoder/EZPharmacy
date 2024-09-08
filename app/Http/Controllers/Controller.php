<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Events\ActivityLogEvent;

use Session;
use App;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /*---------------------------------------------------------
    |Activity Log
    ---------------------------------------------------------*/
    public function save_activity($ARR_DATA = [])
    {  
        if(isset($ARR_DATA) && sizeof($ARR_DATA)>0)
        {
            if(\Request::segment(2)!='' && sizeof(\Request::segment(2))>0)
            {    
                $ARR_EVENT_DATA                 = [];
                $ARR_EVENT_DATA['module_title'] = $ARR_DATA['MODULE_TITLE'];
                $ARR_EVENT_DATA['module_action']= $ARR_DATA['ACTION'];
              	
                event(new ActivityLogEvent($ARR_EVENT_DATA));

                return true;
            }
            return false;    
        }
        return false;
    }
   

    public function get_locale()
    {
        $locale =  \App::getLocale();
        
        if($locale == "")
            $locale = 'en';

        return $locale;
    }

    public function build_response($status = 'success',
                                  $message = "",
                                 $arr_data = [],
                            $response_format = 'json',
                            $response_code = 200)
    {
        if($response_format == 'json')
        {
            $arr_response = [
                'status' => $status,
                'msg' => $message
            ];

            if(sizeof($arr_data)>0)
            {
                $arr_response['data'] = $arr_data;
            }   
            
            return response()->json($arr_response,$response_code,[],JSON_UNESCAPED_UNICODE);    
        }   
    }   
    
    
}
