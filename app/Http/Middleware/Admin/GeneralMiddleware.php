<?php

namespace App\Http\Middleware\Admin;

use Closure;
use Session;
use App\Models\ContactEnquiryModel;

use Sentinel;

class GeneralMiddleware
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
        
        Session::put('locale','en');
        view()->share('admin_panel_slug',config('app.project.admin_panel_slug'));

        view()->share('admin_contact_unread',$this->admin_contact_unread());
        view()->share('admin_hepl_unread',$this->admin_help_unread());
        view()->share('check_admin_role',$this->check_admin_role());
        return $next($request);
    }

    public function admin_contact_unread()
    {
        $count_unread=0;
        $count_unread = ContactEnquiryModel::where('is_view','0')->count();
        return $count_unread;       
    }
    
    public function admin_help_unread()
    {
        $count_unread=0;
        /*$count_unread = HelpModel::where('is_read','0')->count();*/
        return $count_unread;       
    }

    public function check_admin_role()
    {
        $user = Sentinel::check();

        if(isset($user) && ($user != false) && $user->inRole(config('app.project.role_slug.admin_role_slug')))
        {
            return 'admin';
        }
        else
        {
            return 'operator';
        }
    }
}
