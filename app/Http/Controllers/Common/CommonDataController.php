<?php

namespace App\Http\Controllers\Common;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Validator;
use App\Models\MasterModel;
use DB;
use Session;

class CommonDataController extends Controller
{
    public function __construct()
    {
        
    }
    
    public function get_countries(Request $request)
    {
        $arr_countries = [];
        $current_locale = 'en';
        if(Session::has('locale'))
        {
            $current_locale = Session::get('locale');
        }
        $obj_countries = DB::table('countries as C')
                    ->select('C.id','CT.country_name')
                    ->leftJoin('countries_translation as CT','CT.country_id','=','C.id')
                    ->where('CT.locale', '=', $current_locale)
                    ->where('C.is_active',1)
                    ->orderBy('CT.country_name','ASC')
                    ->get();
        if(count($obj_countries) > 0)
        {
            $arr_countries = $obj_countries;
        }
        return response()->json(['arr_countries'=>$arr_countries]);
    }

    public function orderCheckoutGetCountries(Request $request)
    {
        $resp['aramax_location_countries'] = $resp['pickup_location_countries'] = $resp['delivery_location_countries'] = [];
        // $resp['aramax_location_countries'] = DB::table('countries as C')
        //                                 ->select(
        //                                             'C.id',
        //                                             'C.country_name'
        //                                         )
        //                                 ->where('C.is_active',1)
        //                                 ->orderBy('C.country_name','ASC')
        //                                 ->get();
        if(Session::has('locale'))
                            {
                                $current_locale = Session::get('locale');
                            }
        $resp['aramax_location_countries'] = DB::table('countries as C')
                                        ->select('C.id','CT.country_name')
                                        ->leftJoin('countries_translation as CT','CT.country_id','=','C.id')
                                        ->where('CT.locale', '=', $current_locale)
                                        ->where('C.is_active',1)
                                         ->orderBy('CT.country_name','ASC')
                                        ->get();      

       /* $resp['pickup_location_countries'] = DB::table('countries as C')
                                        ->select(
                                                    'C.id',
                                                    'C.country_name'
                                                )
                                        ->join('pickup_location as PL','PL.country','=','C.id')
                                        ->where('C.is_active',1)
                                        ->where('PL.is_active','=',1)
                                        ->orderBy('C.country_name','ASC')
                                        ->groupBy('PL.country')
                                        ->get();*/


                            if(Session::has('locale'))
                            {
                                $current_locale = Session::get('locale');
                            }
                            $resp['pickup_location_countries'] = DB::table('countries as C')
                                        ->select('C.id','CT.country_name')
                                        ->join('pickup_location as PL','PL.country','=','C.id')
                                        ->leftJoin('countries_translation as CT','CT.country_id','=','C.id')
                                        ->where('CT.locale', '=', $current_locale)
                                        ->where('C.is_active',1)
                                        ->where('PL.is_active','=',1)
                                        ->orderBy('CT.country_name','ASC')
                                        ->groupBy('PL.country')
                                        ->get();                                        
     
        // $resp['delivery_location_countries'] = DB::table('countries as C')
        //                                 ->select(
        //                                             'C.id',
        //                                             'C.country_name'
        //                                         )
        //                                 ->join('delivery_location as DL','DL.country','=','C.id')
        //                                 ->where('C.is_active',1)
        //                                 ->where('DL.is_active','=',1)
        //                                 ->orderBy('C.country_name','ASC')
        //                                 ->groupBy('DL.country')
        //                                 ->get();
        $resp['delivery_location_countries'] = DB::table('countries as C')
                                        ->select('C.id','CT.country_name')
                                         ->join('delivery_location as DL','DL.country','=','C.id')
                                        ->leftJoin('countries_translation as CT','CT.country_id','=','C.id')
                                        ->where('CT.locale', '=', $current_locale)
                                        ->where('C.is_active',1)
                                        ->where('DL.is_active','=',1)
                                        ->orderBy('CT.country_name','ASC')
                                        ->groupBy('DL.country')
                                        ->get();   

        return response()->json(['resp'=>$resp]);
    }

    public function orderCheckoutGetOptCity(Request $request)
    {
        $country_id = $request->input('country_id');

        $arr_cities = [];
        $obj_cities = DB::table('city as CT')
                        ->select('CT.id as city_id','CT.country_id','CT.city_title')
                        ->join('pickup_location as PL' , 'PL.city' ,'=' , 'CT.id')
                        ->where('CT.is_active',1)
                        ->orderBy('CT.city_title','ASC')
                        ->groupBy('city_id')
                        ->get();
        if(count($obj_cities) > 0)
        {
            $arr_cities = $obj_cities;
        }

        return response()->json(['arr_cities'=>$arr_cities]);
    }

    /*public function fillCountryFromCountryAramex(Request $request)
    {
        $resp['aramax_location_countries'] = $resp['user_country'] = $user_country = [];
        
        $user_country = DB::table('user_details as UD')
                        ->select(
                            'country'
                            )
                        ->where('login_id', '=', Session('userLogged.loginId'))
                        ->first();
        //dd($resp['user_country']);
        //$resp['user_country']
        if(count($user_country) > 0)
        {
            $resp['user_country'] = $user_country->country;
        }
        dd($resp['user_country']);
        $resp['aramax_location_countries'] = DB::table('countries as C')
                                        ->select(
                                                    'C.id',
                                                    'C.country_name'
                                                )
                                        ->where('C.is_active',1)
                                        ->orderBy('C.country_name','ASC')
                                        ->get();

        return response()->json(['resp'=>$resp]);
    }*/


    public function get_pickup_cities(Request $request)
    {
        $country_id = $request->input('country_id');

        $arr_cities = [];
       /* $obj_cities = DB::table('city as CT')
                                ->select('CT.id as city_id','CT.country_id','CT.city_title')
                                ->join('countries as CNTRY' , 'CT.country_id' ,'=' , 'CNTRY.id')
                                ->join('pickup_location as PL' , 'PL.city' ,'=' , 'CT.id')
                                ->where('CT.country_id',$country_id)
                                ->where('CT.is_active',1)
                                ->where('CNTRY.is_active',1)
                                ->orderBy('CT.city_title','ASC')
                                ->groupBy('city_id')
                                ->get();*/

           $current_locale = 'en';
        if(Session::has('locale'))
        {
            $current_locale = Session::get('locale');
        }
        $obj_cities = DB::table('city as CT')
                                ->select('CT.id as city_id','CT.country_id','cityTrans.city_title') //'CT.city_title'
                                ->join('countries as CNTRY' , 'CT.country_id' ,'=' , 'CNTRY.id')
                                 ->join('pickup_location as PL' , 'PL.city' ,'=' , 'CT.id')
                                ->leftjoin('city_translation as cityTrans' , 'CT.id' ,'=' , 'cityTrans.city_id')
                                ->where('cityTrans.locale', '=', $current_locale)
                                ->where('CT.country_id',$country_id)
                                ->where('CT.is_active',1)
                                ->where('CNTRY.is_active',1)
                                ->orderBy('cityTrans.city_title','ASC')
                                ->groupBy('city_id')
                                ->get();

        if(count($obj_cities) > 0)
        {
            $arr_cities = $obj_cities;
        }

        return response()->json(['arr_cities'=>$arr_cities]);
    }


    public function get_cities(Request $request)
    {
        $country_id = $request->input('country_id');
        $current_locale = 'en';
        if(Session::has('locale'))
        {
            $current_locale = Session::get('locale');
        }
        $arr_cities = [];
        $obj_cities = DB::table('city as CT')
                                ->select('CT.id as city_id','CT.country_id','cityTrans.city_title') //'CT.city_title'
                                ->join('countries as CNTRY' , 'CT.country_id' ,'=' , 'CNTRY.id')
                                ->leftjoin('city_translation as cityTrans' , 'CT.id' ,'=' , 'cityTrans.city_id')
                                ->where('cityTrans.locale', '=', $current_locale)
                                ->where('CT.country_id',$country_id)
                                ->where('CT.is_active',1)
                                ->where('CNTRY.is_active',1)
                                ->orderBy('cityTrans.city_title','ASC')
                                ->groupBy('city_id')
                                ->get();
        if(count($obj_cities) > 0)
        {
            $arr_cities = $obj_cities;
        }

        return response()->json(['arr_cities'=>$arr_cities]);
    }

    public function get_delivery_cities(Request $request)
    {
        $country_id = $request->input('country_id');

        $arr_cities = [];
        /*$obj_cities = DB::table('city as CT')
                                ->select('CT.id as city_id','CT.country_id','CT.city_title')
                                ->join('countries as CNTRY' , 'CT.country_id' ,'=' , 'CNTRY.id')
                                ->join('delivery_location as DL' , 'DL.city' ,'=' , 'CT.id')
                                ->where('CT.country_id',$country_id)
                                ->where('CT.is_active',1)
                                ->where('CNTRY.is_active',1)
                                ->orderBy('CT.city_title','ASC')
                                ->groupBy('city_id')
                                ->get();*/

        $current_locale = 'en';
        if(Session::has('locale'))
        {
            $current_locale = Session::get('locale');
        }
        $obj_cities = DB::table('city as CT')
                                ->select('CT.id as city_id','CT.country_id','cityTrans.city_title') //'CT.city_title'
                                ->join('countries as CNTRY' , 'CT.country_id' ,'=' , 'CNTRY.id')
                                ->join('delivery_location as DL' , 'DL.city' ,'=' , 'CT.id')
                                ->leftjoin('city_translation as cityTrans' , 'CT.id' ,'=' , 'cityTrans.city_id')
                                ->where('cityTrans.locale', '=', $current_locale)
                                ->where('CT.country_id',$country_id)
                                ->where('CT.is_active',1)
                                ->where('CNTRY.is_active',1)
                                ->orderBy('cityTrans.city_title','ASC')
                                ->groupBy('city_id')
                                ->get();
        if(count($obj_cities) > 0)
        {
            $arr_cities = $obj_cities;
        }

        return response()->json(['arr_cities'=>$arr_cities]);
    }

    public function get_aramexCities(Request $request)
    {
        $country_id = $request->input('country_id');

        $arr_cities = [];
       /* $obj_cities = DB::table('city as CT')
                                ->select('CT.id as city_id','CT.country_id','CT.city_title')
                                ->join('countries as CNTRY' , 'CT.country_id' ,'=' , 'CNTRY.id')
                                ->where('CT.country_id',$country_id)
                                ->where('CT.is_active',1)
                                ->where('CNTRY.is_active',1)
                                ->orderBy('CT.city_title','ASC')
                                ->groupBy('city_id')
                                ->get();*/

        $current_locale = 'en';
        if(Session::has('locale'))
        {
            $current_locale = Session::get('locale');
        }
        $obj_cities = DB::table('city as CT')
                                ->select('CT.id as city_id','CT.country_id','cityTrans.city_title') //'CT.city_title'
                                ->join('countries as CNTRY' , 'CT.country_id' ,'=' , 'CNTRY.id')
                                ->leftjoin('city_translation as cityTrans' , 'CT.id' ,'=' , 'cityTrans.city_id')
                                ->where('cityTrans.locale', '=', $current_locale)
                                ->where('CT.country_id',$country_id)
                                ->where('CT.is_active',1)
                                ->where('CNTRY.is_active',1)
                                ->orderBy('cityTrans.city_title','ASC')
                                ->groupBy('city_id')
                                ->get();
        if(count($obj_cities) > 0)
        {
            $arr_cities = $obj_cities;
        }

        return response()->json(['arr_cities'=>$arr_cities]);
    }

    public function get_locations(Request $request)
    {
        $city_id = $request->input('city_id');

        $arr_locations = [];
        $obj_locations = DB::table('pickup_location')->select('*')->where('city',$city_id)->where('is_active',1)->get();

        if(count($obj_locations))
        {
            $i = 0;
            foreach($obj_locations as $row)
            {
                $myLocation  = $locationMap = $locationImage = $myLatLong = '';/*url('').'/front-assets/images/net-banking.png';*/
                $myLocation  = urlencode($row->google_address);
                if(isset($row->latitude) && $row->latitude!=null && $row->latitude!='' && isset($row->longitude) && $row->longitude!=null && $row->longitude!='')
                {
                    $myLatLong   = $row->latitude.','.$row->longitude;
                    //$myLatLong = '52.51758801683297,13.397978515625027';
                }
                if(!empty($row->image) && file_exists('uploads/pickup_location/'.$row->image))
                {
                    $locationImage = url('').'/uploads/pickup_location/'.$row->image;
                }
                else
                {
                    if($myLatLong != '')
                    {
                        $locationImage = 'https://maps.googleapis.com/maps/api/staticmap?q='.$myLocation.'&center='.$myLatLong.'&zoom=18&scale=false&size=600x300&maptype=roadmap&format=png&visual_refresh=true&markers='.$myLatLong.'&key=AIzaSyCccvQtzVx4aAt05YnfzJDSWEzPiVnNVsY';
                    }
                    else
                    {
                        $locationImage = 'https://maps.googleapis.com/maps/api/staticmap?center='.$myLocation.'&zoom=18&scale=false&size=600x300&maptype=roadmap&format=png&visual_refresh=true&markers='.$myLocation.'&key=AIzaSyCccvQtzVx4aAt05YnfzJDSWEzPiVnNVsY';
                    }
                    /*$locationImage = 'https://maps.googleapis.com/maps/api/staticmap?center='.$myLocation.'&zoom=18&scale=false&size=600x300&maptype=roadmap&format=png&visual_refresh=true&markers='.$myLocation.'&key=AIzaSyCccvQtzVx4aAt05YnfzJDSWEzPiVnNVsY';*/
                }
                $arr_locations[$i]['locationID']     = $row->id;
                $arr_locations[$i]['locationName']   = $row->location;
                $arr_locations[$i]['locationDesc']   = $row->location_description;
                $arr_locations[$i]['myLocation']     = $myLocation;
                $arr_locations[$i]['myLatLong']      = $myLatLong;
                $arr_locations[$i]['locationImage']  = $locationImage;
                $arr_locations[$i]['locationGoogle'] = $row->google_address;
                $i++;
            }
        }

        return response()->json(['arr_locations'=>$arr_locations]);
    }

    public function get_locations_aramex(Request $request)
    {
        $city_id = $request->input('city_id');

        $arr_locations = [];
        $obj_locations = DB::table('pickup_location')->select('*')->where('city',$city_id)->where('is_active',1)->get();
        
        if(count($obj_locations) > 0)
        {
            $arr_locations = $obj_locations;
        }
        
        return response()->json(['arr_locations'=>$arr_locations]);
    }
}