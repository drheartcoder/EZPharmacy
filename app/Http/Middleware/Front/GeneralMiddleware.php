<?php

namespace App\Http\Middleware\Front;
use App\Common\Services\WalletService;
use App\Models\MasterModel;
use Closure;
use Sentinel;
use Session;

use App\Models\SiteSettingModel;
use App\Models\StaticPageModel;

use App;
use DB;

class GeneralMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle($request, Closure $next )
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, Accept, Authorization, X-Requested-With, Application');
        
        $cache_time = 30; /* minutes */

        if(!Session::has('locale'))
        {   
           Session::put('locale', \Config::get('app.locale'));
        }

        App::setLocale(Session::get('locale'));

        view()->share('selected_lang',Session::get('locale'));
       
        $current_url_route = app()->router->getCurrentRoute()->uri();
        
        /* Site Setting*/    
        
        $arr_site_settings = [];
        $site_setting = SiteSettingModel::first();

        if($site_setting) 
        {
            $arr_site_settings = $site_setting->toArray();

            if($arr_site_settings['site_status']==0 && $request->path() != 'site_offline')
            {
                return abort('503');
            }
            elseif($arr_site_settings['site_status']==1 && $request->path() == 'site_offline')
            {
                return redirect('/');
            }
        }
        
        view()->share('arr_site_settings',$arr_site_settings); 

        /* Static Pages */ 
            
        $arr_static_pages = [];
        //static pages links share in footer
        $obj_static_pages = StaticPageModel::remember($cache_time)
                                            ->where('is_active',1)
                                            ->with(['translations'=>function($query) use ($cache_time)
                                            {
                                                return $query->remember($cache_time);
                                            }])
                                            ->get();
        
        if ($obj_static_pages)
        {
            $arr_tmp_static_pages = $obj_static_pages->toArray();
            
            if(isset($arr_tmp_static_pages) && sizeof($arr_tmp_static_pages))
            {
                $arr_static_pages = $arr_tmp_static_pages;
            }   
        }
        
        view()->share('arr_static_pages',$arr_static_pages); 

    
        view()->share('cartCount',0);

        /* general */
        if(Session::has('userLogged'))
        {
            $arr_session = Session::get('userLogged');

            $loginId = isset($arr_session['loginId']) && $arr_session['loginId'] != "" ? $arr_session['loginId'] : ''; 

            $profile_image_public_img_path = url('/').config('app.project.img_path.profile_image');
            $arr_logged_user = [];

            $obj_user = DB::table('login_master as LM')
                                    ->select('LM.id as loginId','LM.email_address','LM.mobile_number','LM.company_name','UD.first_name','UD.profile_image','UD.last_name','full_name','UD.address','CT.city_title','CC.country_name','UD.zipcode','LM.user_type')
                                    ->where('LM.id','=',$loginId)
                                    ->join('user_details as UD','LM.id', '=', 'UD.login_id')
                                    ->leftJoin('city as CT','CT.id', '=', 'UD.city')
                                    ->leftJoin('countries as CC','CC.id', '=', 'UD.country')
                                    ->first();


            if($obj_user)
            {
                $cartCount = 0;        
                $arr_session = Session::get('userLogged');
                $loginId = isset($arr_session['loginId']) && $arr_session['loginId'] != "" ? $arr_session['loginId'] : ''; 
                $whrArr = array('login_id'=>$loginId,'txn_id' => null,'txn_status' => 'Pending');
                $cartCount = MasterModel::getRecords('order_master',array('id'),'',$whrArr);
                view()->share('cartCount',count($cartCount));

                $arr_logged_user = (array) $obj_user;
                view()->share('arr_logged_user', $arr_logged_user);
            }

        }
        
        return $next($request);
    }
}
