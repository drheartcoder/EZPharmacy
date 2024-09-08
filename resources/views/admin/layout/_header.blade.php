<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" >
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>{{ isset($page_title)?$page_title:"" }} - {{ config('app.project.name') }}</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--base css styles-->
        <!-- <link rel="stylesheet" type="text/css" href="{{ url('/') }}/assets/bootstrap/css/bootstrap.min.css"> -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <!-- <link rel="stylesheet" type="text/css" href="https://getbootstrap.com/dist/css/bootstrap.min.css"> -->
        <link rel="stylesheet" type="text/css" href="{{ url('/') }}/assets/font-awesome/css/font-awesome.min.css">
        <!--page specific css styles-->
        <link rel="stylesheet" type="text/css" href="{{ url('/') }}/assets/bootstrap-fileupload/bootstrap-fileupload.css" />
        <!--flaty css styles-->
        <link rel="stylesheet" type="text/css" href="{{ url('/') }}/css/admin/flaty.css">
        <link rel="stylesheet" type="text/css" href="{{ url('/') }}/css/admin/flaty-responsive.css">
        <link rel="stylesheet" type="text/css" href="{{ url('/') }}/assets/jquery-ui/jquery-ui.min.css">
        <link rel="stylesheet" type="text/css" href="{{ url('/') }}/assets/bootstrap-switch/static/stylesheets/bootstrap-switch.css" />
        <link rel="stylesheet" type="text/css" href="{{ url('/') }}/assets/bootstrap-wysihtml5/bootstrap-wysihtml5.css" />
        <link rel="stylesheet" type="text/css" href="{{ url('/') }}/assets/bootstrap-daterangepicker/daterangepicker.css" />
        <link rel="stylesheet" type="text/css" href="{{ url('/') }}/css/admin/select2.min.css" />
        <link rel="stylesheet" type="text/css" href="{{ url('/') }}/css/admin/sweetalert.css" />
        <!-- Auto load email address -->
        <link rel="stylesheet" type="text/css" href="{{ url('/') }}/assets/chosen-bootstrap/chosen.min.css" />
        <link rel="stylesheet" type="text/css" href="{{ url('/') }}/assets/alert/css/alert.css" />
        <link rel="stylesheet" type="text/css" href="{{ url('/') }}/assets/alert/themes/default/theme.css" />
        <link rel="stylesheet" type="text/css" href="{{ url('/') }}/assets/jquery-tags-input/jquery.tagsinput.css" />
        <link rel="stylesheet" type="text/css" href="{{ url('/') }}/assets/bootstrap-duallistbox/duallistbox/bootstrap-duallistbox.css" />
        <link rel="stylesheet" type="text/css" href="{{ url('/') }}/assets/bootstrap-colorpicker/css/colorpicker.css" />
        <link rel="stylesheet" type="text/css" href="{{ url('/') }}/assets/font-awesome/css/font-awesome-animation.min.css" />

        <!--basic scripts-->
        <script type="text/javascript" src="{{ url('') }}/assets/jquery/jquery-2.1.4.min.js"></script>
        <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="{{ url('/') }}/assets/jquery-ui/jquery-ui.min.js"></script>
        <script type="text/javascript" src="{{ url('/') }}/js/admin/select2.min.js"></script>
        <script type="text/javascript" src="{{ url('/') }}/js/admin/sweetalert.min.js"></script>  
        <!-- This is custom js for sweetalert messages -->
        <script type="text/javascript" src="{{ url('/js/admin') }}/sweetalert_msg.js"></script>
        <script type="text/javascript"> var SITE_URL = "{{ url('/') }}/superadmin"; </script>
        <!-- Ends -->
    </head>
    <style type="text/css">
    .flaty-nav .nav-user-photo {width: 100% !important;height: 100% !important;}
    </style>
    <body class="{{ theme_body_color() }}">
    <?php
            $admin_path = config('app.project.admin_panel_slug');
    ?>
        <!-- BEGIN Theme Setting -->
        <div id="theme-setting">
            <a href="#"><i class="fa fa-gears fa fa-2x"></i></a>
            <ul>
                <li>
                    <span>Skin</span>
                    <ul class="colors" data-target="body" data-prefix="skin-">
                        <li class="active"><a class="blue" href="#"></a></li>
                        <li><a class="red" href="#"></a></li>
                        <li><a class="green" href="#"></a></li>
                        <li><a class="orange" href="#"></a></li>
                        <li><a class="yellow" href="#"></a></li>
                        <li><a class="pink" href="#"></a></li>
                        <li><a class="navi_blue" href="#"></a></li>
                        {{-- <li><a class="magenta" href="#"></a></li> --}}
                        <li><a class="gray" href="#"></a></li>
                        <li><a class="black" href="#"></a></li>
                    </ul>
                </li>
                <li>
                    <span>Navbar</span>
                    <ul class="colors" data-target="#navbar" data-prefix="navbar-">
                        <li class="active"><a class="blue" href="#"></a></li>
                        <li><a class="red" href="#"></a></li>
                        <li><a class="green" href="#"></a></li>
                        <li><a class="orange" href="#"></a></li>
                        <li><a class="yellow" href="#"></a></li>
                        <li><a class="pink" href="#"></a></li>
                        <li><a class="navi_blue" href="#"></a></li>
                        {{-- <li><a class="magenta" href="#"></a></li> --}}
                        <li><a class="gray" href="#"></a></li>
                        <li><a class="black" href="#"></a></li>
                    </ul>
                </li>
                <li>
                    <span>Sidebar</span>
                    <ul class="colors" data-target="#main-container" data-prefix="sidebar-">
                        <li class="active"><a class="blue" href="#"></a></li>
                        <li><a class="red" href="#"></a></li>
                        <li><a class="green" href="#"></a></li>
                        <li><a class="orange" href="#"></a></li>
                        <li><a class="yellow" href="#"></a></li>
                        <li><a class="pink" href="#"></a></li>
                        <li><a class="navi_blue" href="#"></a></li>
                        {{-- <li><a class="magenta" href="#"></a></li> --}}
                        <li><a class="gray" href="#"></a></li>
                        <li><a class="black" href="#"></a></li>
                    </ul>
                </li>
                <li>
                    <span></span>
                    <a data-target="navbar" href="#"><i class="fa fa-square-o"></i> Fixed Navbar</a>
                    <a class="hidden-inline-xs" data-target="sidebar" href="#"><i class="fa fa-square-o"></i> Fixed Sidebar</a>
                </li>
            </ul>
        </div>
        <!-- END Theme Setting -->

        <!-- BEGIN Navbar -->
        <div id="navbar" class="navbar {{ theme_navbar_color() }}">
            <button type="button" class="navbar-toggle navbar-btn collapsed" data-toggle="collapse" data-target="#sidebar">
                <span class="fa fa-bars"></span>
            </button>
            <a class="navbar-brand" href="#">
                <small>
                    <i class="fa fa-desktop"></i>

                    <?php  
                        $admin_type = "- Admin";
                        $user = Sentinel::check();
                        if($user)
                        {
                            if($user->inRole(config('app.project.role_slug.admin_role_slug')))
                            {
                                $admin_type = "- Admin";
                            }
                            else if($user->inRole(config('app.project.role_slug.operator_role_slug')))
                            {
                                $admin_type = "- Printing Operator Admin";
                            }
                        }
                    ?>                    
                    {{ config('app.project.name') }}  {{$admin_type or ''}}
                </small>
            </a>
            

            <!-- BEGIN Navbar Buttons -->
            <ul class="nav flaty-nav pull-right">
                @if($check_admin_role=='admin')
                    <!-- BEGIN Button Tasks -->
                    <li class="new-li">
<!--                       <li class="hidden-xs">-->
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="fa fa-bell"></i>
                            <span class="badge badge-warning">{{$admin_contact_unread+$admin_hepl_unread}}</span>
                        </a>
                        
                        <!-- BEGIN Tasks Dropdown -->
                        <ul class="dropdown-navbar dropdown-menu">
                            
                            <li class="nav-header">
                               {{--  <i class="fa fa-check"></i> --}}
                                New Notifications
                            </li>

                            <li>
                                <a href="#">
                                    <div class="clearfix">
                                        <span class="pull-left"><a href="{{ url('/').'/'.$admin_path }}/contact_enquiry">Contact Enquiery</a></span>
                                        <span class="pull-right">{{$admin_contact_unread}}</span>
                                    </div>

                                 {{--    <div class="progress progress-mini">
                                        <div style="width:75%" class="progress-bar progress-bar-warning"></div>
                                    </div> --}}
                                </a>
                            </li>

                           {{--  <li>
                                <a href="#">
                                    <div class="clearfix">
                                        <span class="pull-left"><a href="{{ url('/').'/'.$admin_path }}/help">Help </a></span>
                                        <span class="pull-right">{{$admin_hepl_unread}}</span>
                                    </div>
                                </a>
                            </li> --}}

                           
                        </ul>
                        <!-- END Tasks Dropdown -->
                    </li>
                    <!-- END Button Tasks -->
                @endif
            <!-- BEGIN Button Notifications -->
               <?php
                $obj_data  = Sentinel::check();
                if($obj_data)
                {
                   $arr_data = $obj_data->toArray();    
                }
               ?>
            <!-- END Button Messages -->

                <!-- BEGIN Button User -->
                <li class="user-profile">
                   <a data-toggle="dropdown" href="#" class="user-menu dropdown-toggle">
                        <img class="nav-user-photo" src="{{url('').'/uploads/all_users/admin/thumb_50X50_'}}{{$arr_data['profile_image'] or ''}}" alt="">
                           
                        <span class="hhh" id="user_info">
                          Welcome {{$arr_data['first_name'] or ''}}
                        </span>
                        <i class="fa fa-caret-down"></i>
                       
                        </a>

                    <!-- BEGIN User Dropdown -->
                    <ul class="dropdown-menu dropdown-navbar" id="user_menu">
                        <li>
                            <a href="{{ url('/').'/'.$admin_path }}/change_password" >
                                <i class="fa fa-key"></i>
                                Change Password
                            </a>    
                        </li>    
                        <li class="divider"></li>
                        <li>
                            <a href="{{ url('/').'/'.$admin_path }}/clear_cache" >
                                <i class="fa fa-trash"></i>
                                Clear Cache
                            </a>    
                        </li>    
                        <li class="divider"></li>
                        <li>
                             <a href="{{ url('/').'/'.$admin_path }}/logout "> 
                                <i class="fa fa-power-off"></i>
                                Logout
                            </a>
                        </li>
                        <li>
                            <?php
                                $_action = app('request')->route()->getAction(); 
                                $isController = class_basename($_action['controller']);
                                ?>
                        </li>
                    </ul>
                    
                    <!-- BEGIN User Dropdown -->
                </li>
                <!-- END Button User -->
            </ul>
            <!-- END Navbar Buttons -->
        </div>
        <!-- END Navbar -->
        
        <!-- BEGIN Container -->
        <div class="container {{ theme_sidebar_color() }}" id="main-container">