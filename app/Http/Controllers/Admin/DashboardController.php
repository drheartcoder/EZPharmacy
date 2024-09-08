<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;


use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\UserModel;
use App\Models\CountryModel;
use App\Models\MasterModel;

use Session;
use Sentinel;
use DB;

class DashboardController extends Controller
{
	public function __construct(UserModel $user,CountryModel $country)
	{
		$this->arr_view_data      = [];
		$this->module_title       = "Dashboard";
		$this->UserModel          = $user;
		$this->CountryModel          = $country;

		$this->module_view_folder = "admin.dashboard";
		$this->admin_url_path     = url(config('app.project.admin_panel_slug'));

		$this->project_url_slug     = config('app.project.url_slug.project');
	}
   
    public function index()
    {
    	$arr_tile_color = array('tile-red','tile-green','tile-magenta','');
    	$this->arr_view_data['arr_final_tile'] = $this->built_dashboard_tiles();
    	$this->arr_view_data['arr_tile_color'] = $arr_tile_color;
      $this->arr_view_data['admin_url_path'] = $this->admin_url_path;
      $this->arr_view_data['page_title']     = $this->module_title;
      return view($this->module_view_folder.'.index',$this->arr_view_data);
    }

    public function built_dashboard_tiles()
    {
        /*------------------------------------------------------------------------------
        | Note: Directly Use icon name - like, fa fa-user and use directly - 'user'
        ------------------------------------------------------------------------------*/
        $arr_final_tile = [];
        $user = Sentinel::check();
        $admin_type = "";
        $arr_final_tile[] = ['module_slug' => 'order_history','css_class' => 'cart-plus','module_title' => 'Order History' ];
        $arr_final_tile[] = ['module_slug'  => 'users/manage/patient/','css_class'   => 'users','module_title'=> 'Users'];
        $arr_final_tile[] = ['module_slug'  => 'account_settings','css_class'   => 'gear','module_title'=> 'Account Settings'];
        $arr_final_tile[] = ['module_slug'  => 'countries','css_class' => 'globe','module_title'=> 'Countries'];
		    return 	$arr_final_tile;						  

    }

    public function generate_random_color($str) 
    { 
    	$str = sha1($str);
    	$str = substr($str,0,6);
	    return '#'.($str); 
	  }
}
