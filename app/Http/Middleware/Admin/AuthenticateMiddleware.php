<?php

namespace App\Http\Middleware\Admin;

use Closure;
use Sentinel;
use Flash;
use Session;

class AuthenticateMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, Accept, Authorization, X-Requested-With, Application');
        
        $arr_except = array();

        $admin_path = config('app.project.admin_panel_slug');

        $arr_except[] =  $admin_path;
        $arr_except[] =  $admin_path.'/login';
        $arr_except[] =  $admin_path.'/process_login';
        $arr_except[] =  $admin_path.'/forgot_password';
        $arr_except[] =  $admin_path.'/process_forgot_password';
        $arr_except[] =  $admin_path.'/validate_admin_reset_password_link';
        $arr_except[] =  $admin_path.'/reset_password';
        
        /*-----------------------------------------------------------------
            Code for {enc_id} or {extra_code} in url
        ------------------------------------------------------------------*/
        $request_path = $request->route()->getCompiled()->getStaticPrefix();
        $request_path = substr($request_path,1,strlen($request_path));
        
        /*-----------------------------------------------------------------
                End
        -----------------------------------------------------------------*/        

        if(!in_array($request_path, $arr_except))
        {
            $user = Sentinel::check();

            if($user)
            {
                if($user->inRole(config('app.project.role_slug.admin_role_slug')))
                {
                    if($user->is_active == '1')
                    {
                        return $next($request);    
                    }
                    else
                    {
                        Sentinel::logout();
                        Session::flush();
                        Flash::error('Your Account is not activated by Admin.');
                        return redirect(url(config('app.project.admin_panel_slug')));
                    }
                }
                
                if($user->inRole(config('app.project.role_slug.operator_role_slug')))
                {   
                    if($user->is_active == '1')
                    {
                        return $next($request);    
                    }
                    else
                    {
                        Sentinel::logout();
                        Session::flush();
                        Flash::error('Your Account is not activated by Admin.');
                        return redirect(url(config('app.project.admin_panel_slug')));
                    }
                }
                else
                {   
                    Sentinel::logout();
                    Session::flush();   
                    Flash::error('Not Sufficient Privileges');
                    return redirect(url(config('app.project.admin_panel_slug')));
                }    
            }
            else
            {
                return redirect(config('app.project.admin_panel_slug'));
            }
            
        }
        else
        {
            return $next($request); 
        }
    }
}
