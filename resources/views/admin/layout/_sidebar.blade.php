<?php 

    $user = Sentinel::check();
    
    $admin_type = "";
    
    if($user)
    {
        $user = Sentinel::check();
        if($user)
        {
            if($user->inRole(config('app.project.role_slug.admin_role_slug')))
            {
                $admin_type = "ADMIN";
            }
            else if($user->inRole(config('app.project.role_slug.operator_role_slug')))
            {
                $admin_type = "OPERATOR";
            }
        }
    }
?>

<div id="sidebar" class="navbar-collapse collapse">
        <!-- BEGIN Navlist -->
       
        <ul class="nav nav-list">
                
            <li class="<?php echo Request::segment(2) == 'dashboard'?'active':'';?>">
                <a href="{{ url('/').'/'.$admin_panel_slug.'/dashboard'}}">
                    <i class="fa fa-dashboard faa-vertical animated-hover"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            
            <li class="<?php  echo Request::segment(2) == 'account_settings'?'active':'';  ?>">
                <a href="{{ url('/').'/'.$admin_panel_slug.'/account_settings' }}" >
                    <i class="fa fa-cogs faa-vertical animated-hover"></i>
                    <span>Account Settings</span>
                    <b class="arrow fa fa-angle-right"></b>
                </a>
            </li> 
            
            <li class="<?php  echo Request::segment(2) == 'users'?'active':''; ?>">
                <a href="javascript:void(0)" class="dropdown-toggle" >
                <i class="fa fa-users faa-vertical animated-hover"></i>
                    <span>Users</span>
                    <b class="arrow fa fa-angle-right"></b>
                </a>
                <ul class="submenu">
                    <li style="display: block;" {{ Request::segment(2) == 'users' && Request::segment(4) == 'patient'?'class=active':''}}><a href="{{ url($admin_panel_slug)}}/users/manage/patient">Patient</a></li>
                    <li style="display: block;" {{ Request::segment(2) == 'users' && Request::segment(4) == 'doctor'?'class=active':''}} ><a href="{{ url($admin_panel_slug)}}/users/manage/doctor">Doctor</a></li>
                    <li style="display: block;" {{ Request::segment(2) == 'users' && Request::segment(4) == 'unverified-doctor'?'class=active':''}} ><a href="{{ url($admin_panel_slug)}}/users/manage/unverified-doctor">Unverified Doctor</a></li>
                    <li style="display: block;" {{ Request::segment(2) == 'users' && Request::segment(4) == 'pharmacy'?'class=active':''}} ><a href="{{ url($admin_panel_slug)}}/users/manage/pharmacy">Pharmacy</a></li>    
                </ul>
            </li>

            <li class="<?php echo Request::segment(2) == 'order_history'?'active':'';  ?>">
                <a href="{{ url('/').'/'.$admin_panel_slug.'/order_history' }}">
                    <i class="fa fa-cart-plus faa-vertical animated-hover"></i>
                    <span>Prescription Orders</span>
                    <b class="arrow fa fa-angle-right"></b>
                </a>
            </li>

            
            <li class="<?php echo Request::segment(2) == 'countries' || Request::segment(2) == 'states' || Request::segment(2) == 'cities' || Request::segment(2) == 'area' || Request::segment(2) == 'pickup_locations' || Request::segment(2) == 'delivery_locations'  || Request::segment(2) == 'countries'?'active':''; ?>"> 
                <a href="javascript:void(0)" class="dropdown-toggle">
                    <i class="fa fa-globe faa-vertical animated-hover"></i>
                    <span>Locations</span>
                    <b class="arrow fa fa-angle-right"></b>
                </a>
                <ul class="submenu">
                    <li class="<?php  echo Request::segment(2) == 'countries'?'active':''; ?>"><a href="{{ url('/').'/'.$admin_panel_slug.'/countries'}}">Manage Country</a></li> 
                    <li class="<?php  echo Request::segment(2) == 'states'?'active':''; ?>"><a href="{{ url('/').'/'.$admin_panel_slug.'/states'}}">Manage States</a></li>
                    <li class="<?php  echo Request::segment(2) == 'cities'?'active':''; ?>"><a href="{{ url('/').'/'.$admin_panel_slug.'/cities'}}">Manage Cities</a></li> 
                    <li class="<?php  echo Request::segment(2) == 'area'?'active':''; ?>"><a href="{{ url('/').'/'.$admin_panel_slug.'/area'}}">Manage Area</a></li> 
                </ul>
            </li>

            <li class="<?php echo Request::segment(2) == 'speciality'?'active':'';  ?>">
                <a href="javascript:void(0)" class="dropdown-toggle" >
                    <i class="fa fa-stethoscope faa-vertical animated-hover"></i>
                        <span>Speciality</span>
                    <b class="arrow fa fa-angle-right"></b>
                </a>

                <ul class="submenu">
                    <li style="display: block;"><a href="{{ url($admin_panel_slug.'/speciality')}}">Manage </a></li>
                </ul>
            </li>


            <!-- <li class="<?php  //echo Request::segment(2) == 'static_pages'?'active':'';  ?>">
                <a href="javascript:void(0)" class="dropdown-toggle">
                    <i class="fa  fa-sitemap faa-vertical animated-hover"></i>
                    <span>CMS</span>
                    <b class="arrow fa fa-angle-right"></b>
                </a>
                 <ul class="submenu">
                    <li style="display: block;"><a href="{{ url($admin_panel_slug.'/static_pages')}}">Manage </a></li>
                </ul>
            </li> -->

            <!-- <li class="<?php //echo Request::segment(2) == 'site_settings'?'active':'';  ?>">
                <a href="{{ url($admin_panel_slug.'/site_settings') }}" >
                    <i class="fa  fa-wrench faa-vertical animated-hover"></i>
                    <span>Site Settings</span>
                    <b class="arrow fa fa-angle-right"></b>
                </a>
            </li> -->


            
            <!-- <li class="<?php  //echo Request::segment(2) == 'email_template'?'active':'';  ?>">
                <a href="{{ url($admin_panel_slug.'/email_template') }}" >
                    <i class="fa fa-comments-o faa-vertical animated-hover"></i>
                    <span>Email Template</span>
                    <b class="arrow fa fa-angle-right"></b>
                </a>
            </li> -->

        
            <!-- END Navlist -->
            
            <!-- BEGIN Sidebar Collapse Button -->
            <div id="sidebar-collapse" class="visible-lg">
                <i class="fa fa-angle-double-left"></i>
            </div>
            <!-- END Sidebar Collapse Button -->
            
            </ul>
</div>   
