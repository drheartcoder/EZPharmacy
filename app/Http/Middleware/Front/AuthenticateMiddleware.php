<?php

namespace App\Http\Middleware\Front;
use App\Models\MasterModel;

use Closure;
use Session;
use DB;


class AuthenticateMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    protected $except = [
        'user/document-attributes',
    ];
    public function handle($request, Closure $next)
    {     
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, Accept, Authorization, X-Requested-With, Application');
        $arr_except = array();
        //$admin_path = config('app.project.admin_panel_slug');
        
        $arr_except[] =  '/';
        $arr_except[] =  'user/document-attributes';
        $arr_except[] =  'user/get-paper-price';
        $arr_except[] =  'user/get-printing-price';
        $arr_except[] =  'user/get-binding-price';
        $arr_except[] =  'user/get-folding-price';

        $current_url_route = app()->router->getCurrentRoute()->uri();
        //dd($current_url_route);
        if(!in_array($current_url_route, $arr_except))
        {
            if(!Session::has('userLogged')){
               return redirect('/');
            }
            $is_blocked = array();
            $is_blocked = DB::table('login_master as LM')
                            ->select('LM.is_active')
                            ->where('LM.id', '=', Session('userLogged.loginId'))
                            ->first();
            //dd($is_blocked);
            if(count($is_blocked) > 0)
            {
                if($is_blocked->is_active == 0)
                {
                    session()->flush();
                    return redirect('/blocked');
                }
                else
                {
                    $cartCount = 0;        
                    $arr_session = Session::get('userLogged');
                    $loginId = isset($arr_session['loginId']) && $arr_session['loginId'] != "" ? $arr_session['loginId'] : ''; 
                    $whrArr = array('login_id'=>$loginId,'txn_id' => null,'txn_status' => 'Pending');
                    $cartCount = MasterModel::getRecords('order_master',array('id'),'',$whrArr);
                           view()->share('cartCount',count($cartCount));        
                }
                return $next($request);
            }                           
            
            return $next($request);
        }
        else
        {
            return $next($request);    
        }
    }
}
