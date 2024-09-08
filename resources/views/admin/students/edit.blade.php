    @extends('admin.layout.master')                


    @section('main_content')

    
    <!-- BEGIN Page Title -->
    <div class="page-title">
        <div>

        </div>
    </div>
    <!-- END Page Title -->

    <!-- BEGIN Breadcrumb -->
   <div id="breadcrumbs">
  <ul class="breadcrumb">
    <li>
      <i class="fa fa-home">
      </i>
      <a href="{{ url($admin_panel_slug.'/dashboard') }}">Dashboard
      </a>
    </li>
    <span class="divider">
      <i class="fa fa-angle-right">
      </i>
      <i class="fa fa-users faa-vertical animated-hover">
      </i>
      <a href="{{ url($module_url_path) }}" class="call_loader">{{ $module_title or ''}}
      </a>
    </span> 
    <span class="divider">
      <i class="fa fa-angle-right">
      </i>
      <i class="fa fa-eye">
      </i>
    </span> 
    <li class="active">  {{ isset($page_title)?$page_title:"" }}
    </li>
  </ul>
</div>
    <!-- END Breadcrumb -->



    <!-- BEGIN Main Content -->
    <div class="row">
      <div class="col-md-12">
          <div class="box ">
            <div class="box-title">
              <h3>
                <i class="fa fa-edit"></i>
                {{ isset($page_title)?$page_title:"" }}
              </h3>
              <div class="box-tool">
                <a data-action="collapse" href="#"></a>
                <a data-action="close" href="#"></a>
              </div>
            </div>
            <div class="box-content">

          @include('admin.layout._operation_status')  
          <form action="{{$module_url_path.'/update'}}" method="POST" class="form-horizontal" id="validation-form" enctype="multipart/form-data">
         

           {{ csrf_field() }}

           @if(isset($arr_data) && count($arr_data) > 0)   

           <input type="hidden" name="id" id="id" value="{{$arr_data['id']}}">
           
            <div class="form-group" style="margin-top: 25px;">
                  <label class="col-sm-3 col-lg-2 control-label">Firstname<i style="color: red;">*</i></label>
                  <div class="col-sm-9 col-lg-4 controls" >
                      <input type="text" name="first_name" id="first_name" data-rule-pattern="[A-Za-z]{3,20}" data-rule-required="true" class="form-control" value="{{ $arr_data['user_details']['first_name']}}"> 
                      <span class="help-block">{{ $errors->first('first_name') }}</span>
                  </div>
            </div>

            <div class="form-group" style="">
                  <label class="col-sm-3 col-lg-2 control-label">Lastname<i style="color: red;">*</i></label>
                  <div class="col-sm-9 col-lg-4 controls" >
                       <input type="text" name="last_name" id="last_name" data-rule-pattern="[A-Za-z]{3,20}" data-rule-required="true" class="form-control" value="{{ $arr_data['user_details']['last_name']}}">     
                      <span class="help-block">{{ $errors->first('last_name') }}</span>
                  </div>
            </div>

            <div class="form-group" style="">
                  <label class="col-sm-3 col-lg-2 control-label">Email<i style="color: red;">*</i></label>
                  <div class="col-sm-9 col-lg-4 controls" >
                       <input type="text" name="email_address" id="email_address" data-rule-required="true" data-rule-email='true' class="form-control" value="{{ $arr_data['email_address'] or ''}}">     
                     

                      <span class="help-block">{{ $errors->first('email_address') }}</span>
                  </div>
            </div>  

           

             <div class="form-group" style="">
                  <label class="col-sm-3 col-lg-2 control-label">Phone<i style="color: red;">*</i></label>
                  <div class="col-sm-9 col-lg-4 controls" >
                      <input type="text" name="mobile_number" id="mobile_number" data-rule-required="true" data-rule-number='true' class="form-control" value="{{ $arr_data['mobile_number'] or ''}}">  
                     <span class="help-block">{{ $errors->first('phone') }}</span>
                  </div>
            </div>
            <div class="form-group">
              <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
               
                {!! Form::submit('Update',['class'=>'btn btn btn-primary','value'=>'true'])!!}
                &nbsp;
                <a class="btn btn-primary" href="{{ $module_url_path or '' }}">Back</a>
              </div>
            </div>

            @else 
              <div class="form-group">
                <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                  <h3><strong>No Record found..</strong></h3>     
                </div>
              </div>
            @endif
    
          </form>
      </div>
    </div>
  </div>
  
  <!-- END Main Content -->
@stop                    
