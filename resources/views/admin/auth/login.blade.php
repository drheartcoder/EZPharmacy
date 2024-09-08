<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>{{ $site_settings['site_name'] or '' }} Admin Login</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
        <!--base css styles-->
        <link rel="stylesheet" type="text/css" href="{{ url('/') }}/assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="{{ url('/') }}/assets/font-awesome/css/font-awesome.min.css">
        <!--flaty css styles-->
        <link rel="stylesheet" type="text/css" href="{{ url('/') }}/css/admin/flaty.css">
        <link rel="stylesheet" type="text/css" href="{{ url('/') }}/css/admin/flaty-responsive.css">
        <link rel="shortcut icon" href="{{ url('/') }}/favicon.png">
        <style type="text/css">
        .error
        {
            color: red;
        }

        .login-page:before{background: none!important}

        #form-login , #form-forgot
        {
            /*box-shadow    : 13px 21px 70px #000;*/
            border:  1px solid #e5e5e5;
            border-radius : 15px;
        }

        </style>

    </head>

        
     <body class="login-page" >
        

        <!-- BEGIN Main Content -->
        <div class="login-wrapper">
            <!-- BEGIN Login Form -->
            
            {!! Form::open([ 'url' => $admin_panel_slug.'/process_login',
                                 'method'=>'POST',
                                 'id'=>'form-login' 
                                ]) !!} 
                                    
                    @include('admin.layout._operation_status')  
                 
                 {{ csrf_field() }}

                <h3 style="text-align: center;">Login to your account</h3>
                <hr/>
                <div class="form-group ">
                    <div class="controls">
                        {!! Form::text('email',null,['class'=>'form-control',
                                        'data-rule-required'=>'true',
                                        'data-rule-email'=>'true',
                                        'placeholder'=>'Email']) !!}

                        <span class="error">{{ $errors->first('email') }} </span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="controls">
                        

                        {!! Form::password('password',['class'=>'form-control',
                                        'data-rule-required'=>'true',
                                        'placeholder'=>'Password']) !!}

                        <span class="error">{{ $errors->first('password') }} </span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="controls">
                    {{-- {!! Form::Submit('Sign In',['class'=>'btn btn-primary form-control']) !!} --}}
                    <button  class="btn btn-danger form-control" >Sign In</button>        
                    </div>
                </div>
                <hr/>
                <p class="clearfix" style="text-align: center;">
                    <a href="javascript:void(0);" class="goto-forgot pull-left" >Forgot Password?</a>
                </p>
            </form>
            <!-- END Login Form -->

            <!-- BEGIN Forgot Password Form -->
            <form id="form-forgot" action="{{ url($admin_panel_slug.'/process_forgot_password') }}" method="post" style="display:none">
                 {{ csrf_field() }}

                @include('admin.layout._operation_status')  

                <h3 style="text-align: center;">Get back your password</h3>
                <hr/>
                <div class="form-group">
                    <div class="controls">
                        <input type="text" placeholder="Email" class="form-control" data-rule-required="true" data-rule-email="true" name="email"/>
                        <span class="error">{{ $errors->first('email') }} </span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="controls">
                        <button type="submit" class="btn btn-danger form-control">Recover</button>
                    </div>
                </div>
                <hr/>
                <p class="clearfix">
                    <a href="#" class="goto-login pull-left">← Back To Login</a>
                </p>
            </form>
            <!-- END Forgot Password Form -->
        </div>
        <!-- END Main Content -->



        <!--basic scripts-->
       
        <script>window.jQuery || document.write('<script type="text/javascript" src="{{ url('/') }}/assets/jquery/2.1.4/jquery.min.js"><\/script>')</script>
        <script>window.jQuery || document.write('<script type="text/javascript" src="{{ url('/') }}/assets/jquery/jquery-2.1.4.min.js"><\/script>')</script>
        <script type="text/javascript" src="{{ url('/') }}/assets/bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="{{ url('/') }}/assets/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <script type="text/javascript" src="{{ url('/') }}/assets/jquery-cookie/jquery.cookie.js"></script>
        <script type="text/javascript" src="{{ url('/') }}/assets/jquery-validation/dist/jquery.validate.min.js"></script>
        <script type="text/javascript" src="{{ url('/') }}/assets/jquery-validation/dist/additional-methods.min.js"></script>
        <script type="text/javascript" src="{{ url('/') }}/assets/chosen-bootstrap/chosen.jquery.min.js"></script>
        <!--flaty scripts-->
        <script type="text/javascript" src="{{ url('/') }}/js/admin/flaty.js"></script>
        <script type="text/javascript" src="{{ url('/') }}/js/admin/flaty-demo-codes.js"></script>
        <script type="text/javascript" src="{{ url('/') }}/js/admin/validation.js"></script>

        <script type="text/javascript">
            function goToForm(form)
            {
                $('.login-wrapper > form:visible').fadeOut(500, function(){
                    $('#form-' + form).fadeIn(500);
                });
            }
            $(function() 
            {
                $('.goto-login').click(function(){
                    goToForm('login');
                });
                $('.goto-forgot').click(function(){
                    goToForm('forgot');
                });
                $('.goto-register').click(function(){
                    goToForm('register');
                });

                applyValidationToFrom($("#form-login"))
                applyValidationToFrom($("#form-forgot"))
            });
		
        </script>
    </body>
</html>

