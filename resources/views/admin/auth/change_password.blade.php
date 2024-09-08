    @extends('admin.layout.master')                
    @section('main_content')
    <!-- BEGIN Page Title -->
    
    <!-- END Page Title -->

    <!-- BEGIN Breadcrumb -->
    <div id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="{{ url('/'.$admin_panel_slug.'/dashboard') }}">Dashboard</a>
            </li>
            <span class="divider">
                <i class="fa fa-angle-right"></i>
            </span>
            
            <li class="active">  {{ $module_title or ''}}</li>
        </ul>
    </div>
    <!-- END Breadcrumb -->

    <!-- BEGIN Main Content -->
    
    <div class="row">
        <div class="col-md-12">
            <div class="box {{ $theme_color }}">
                <div class=" box-title">
                    <h3><i class="fa fa-file"></i> Change Password</h3>
                </div>
                <div class="box-content">

                    @include('admin.layout._operation_status')  

                    
                        {!! Form::open([ 'url' => $admin_panel_slug.'/update_password',
                                 'method'=>'POST',
                                 'id'=>'validation-form',
                                 'class'=>'form-horizontal' 
                                ]) !!} 
                                    
                            {{ csrf_field() }}
                        <div class="form-group">
                            <label class="col-sm-3 col-lg-2 control-label">Current Password</label>
                            <div class="col-sm-9 col-lg-4 controls">

                                {!! Form::password('current_password',['class'=>'form-control',
                                        'data-rule-required'=>'true',
                                        'id'=>'current_password',
                                        'placeholder'=>'Current Password']) !!}
                                
                                <span class='help-block'>{{ $errors->first('current_password') }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 col-lg-2 control-label">New Password</label>
                            <div class="col-sm-9 col-lg-4 controls">
                                
                                {!! Form::password('new_password',['class'=>'form-control',
                                        'data-rule-required'=>'true',
                                        'data-rule-minlength'=>'6',
                                        'data-rule-maxlength'=>'40',
                                        'id'=>'new_password',
                                        'placeholder'=>'New Password',
                                        'data-rule-pattern'=>'^(?=.*[a-zA-Z])(?=.*\d)(?=.*[!@#$%^&*()_+])[A-Za-z\d][A-Za-z\d!@#$%^&*()_+]{6,40}$'
                                        ]) !!}

                                <span class='help-block'>{{ $errors->first('new_password') }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 col-lg-2 control-label">Re-Type New Password</label>
                            <div class="col-sm-9 col-lg-4 controls">

                                {!! Form::password('new_password_confirmation',['class'=>'form-control',
                                        'data-rule-required'=>'true',
                                        'data-rule-equalto'=>'#new_password',
                                        'id'=>'new_password_confirmation',
                                        'placeholder'=>'Re-type New password']) !!}

                                <span class='help-block'>{{ $errors->first('new_password_confirmation') }}</span>
                            </div>
                        </div>
                            
                        <div class="form-group">
                            <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                                <h6 style="color: red;font-style:italic;"> Note: Password should contain alphabets, at least one special character and at least one number. </h6>
                            </div>
                        </div>    

                        <div class="form-group">
                            <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                                {!! Form::Submit('Save',['class'=>'btn btn-primary']) !!}
                            </div>
                        </div>
                        
                        {!! Form::close() !!}
                </div>
            </div>
        </div>
    
<!-- END Main Content -->
@stop