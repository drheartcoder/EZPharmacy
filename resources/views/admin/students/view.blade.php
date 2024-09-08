@extends('admin.layout.master')                
@section('main_content')

<style type="text/css">
  .ui-autocomplete
  {
    max-width: 26% !important;
  }
  .mass_min {
    background: #fcfcfc none repeat scroll 0 0;
    border: 1px dashed #d0d0d0;
    float: left;
    margin-bottom: 20px;
    margin-right: 21px;
    margin-top: 10px;
    padding: 5px;
  }
  .mass_addphoto {
    display: inline-block;
    margin: 0 10px;
    padding-top: 27px;
    text-align: center;
    vertical-align: top;
  }
  .mass_addphoto {
    text-align: center;
  }
  .upload_pic_btn {
    cursor: pointer;
    font-size: 14px;
    height: 100% !important;
    left: 0;
    margin: 0;
    opacity: 0;
    padding: 0;
    position: absolute;
    right: 0;
    top: 0;
  }
</style>

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
          <i class="fa fa-eye">
          </i>{{ isset($page_title)?$page_title:"" }} 
        </h3>
        <div class="box-tool">
        </div>
      </div>
      <div class="box-content">
        <?php 
          $first_name    = isset($arr_consumer['user_details']['first_name']) ?$arr_consumer['user_details']['first_name']:"NA";
          $last_name     = isset($arr_consumer['user_details']['last_name']) ?$arr_consumer['user_details']['last_name']:"NA ";
          $name     = isset($arr_consumer['user_details']['full_name']) ?$arr_consumer['user_details']['full_name']:"NA ";
          $mobile_no     = isset($arr_consumer['user_details']['mobile_number']) ?$arr_consumer['user_details']['mobile_number']:"NA ";
          $email         = isset($arr_consumer['email_address']) ?$arr_consumer['email_address']:"NA ";
          $profile_image = isset($arr_consumer['user_details']['profile_image']) ?$arr_consumer['user_details']['profile_image']:"NA ";
         
          $address       = isset($arr_consumer['user_details']['address']) ?$arr_consumer['user_details']['address']:"NA ";
          $state         = isset($arr_consumer['user_details']['state']) ?$arr_consumer['user_details']['state']:"NA ";
          $city          = isset($arr_consumer['user_details']['city']) ?$arr_consumer['user_details']['city']:"NA ";              
          $zipcode       = isset($arr_consumer['user_details']['zipcode']) ?$arr_consumer['user_details']['zipcode']:"NA ";
          $country       = isset($arr_consumer['user_details']['country_details']['country_name']) ?$arr_consumer['user_details']['country_details']['country_name']:"NA ";
         
        ?>
        <div class="box">
          <div class="box-content studt-padding">
            <div class="row">
              <div class="form-group" style="margin-top: 15px;">
                <label class="col-sm-8 col-lg-8 control-label" style="text-align:left">
                  <h3>Basic Details 
                  </h3>
                  
                </label>
              </div>
            <div class="col-md-8">
                <table class="table table-bordered">
                <tbody>
                  <tr>
                    <th style="width: 30%">Profile Image
                    </th>
                    <td>
                      @if(isset($arr_consumer['profile_image']) && $arr_consumer['profile_image']!= "")  
                      <img alt="pic" src="{{$user_profile_public_img_path.'/'.$arr_consumer['id'].'/'.$arr_consumer['profile_image']}}" style="max-width: 200px; max-height: 150px; line-height: 20px;"/>
                      @else
                      <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" style="max-width: 200px; max-height: 150px; line-height: 20px;" />  
                      @endif
                    </td>
                  </tr>
                  <tr>
                    <th style="width: 30%">User Name
                    </th>
                    <td>
                      {{$name or ''}}
                    </td>
                  </tr>
                  <tr>
                    <th style="width: 30%">Mobile Number
                    </th>
                    <td>
                      {{$mobile_no or ''}}
                    </td>
                  </tr>
                  <tr>
                    <th style="width: 30%">Email
                    </th>
                    <td>
                     {{$email or ''}}
                    </td>
                  </tr>
                  <tr>
                    <th style="width: 30%">Country
                    </th>
                    <td>
                      {{$country or ''}}
                    </td>
                  </tr>
                  <tr>
                    <th style="width: 30%">Address
                    </th>
                    <td>
                      {{ $address or '' }}
                    </td>
                  </tr>
                  <tr>
                    <th style="width: 30%">State
                    </th>
                    <td>
                      {{$state or '-'}}
                    </td>
                   </tr>
                   <tr>
                    <th style="width: 30%">City
                    </th>
                    <td>
                      {{$city or '-'}}
                    </td>
                  </tr>
                  <tr>
                    <th style="width: 30%">Zipcode
                    </th>
                    <td>
                      {{$zipcode or '-'}}
                    </td>
                  </tr>
          </tbody>
        </table>  
            </div>            
           {{--  <div class="form-group" style="margin-top: 15px;">
                <label class="col-sm-8 col-lg-8 control-label" style="text-align:left">
                  <h3>Portfolio 
                  </h3>
                </label>
              </div>
              <div class="col-md-8">
                <table class="table table-bordered">
                <tbody>
                  <tr>
                    <th style="width: 30%">Company Name
                    </th>
                    <td>
                      {{$company_name or ''}}
                    </td>
                  </tr>
                  <tr>
                    <th style="width: 30%">Owner Name
                    </th>
                    <td>
                      {{$owner_name or ''}}
                    </td>
                  </tr>
                  <tr>
                    <th style="width: 30%">Company Size
                    </th>
                    <td>
                     {{$company_size or ''}}
                    </td>
                  </tr>
                  <tr>
                    <th style="width: 30%">Company Type
                    </th>
                    <td>
                      {{$company_type or ''}}
                    </td>
                  </tr>
                  <tr>
                    <th style="width: 30%">Company Website
                    </th>
                    <td>
                      {{ $company_website or '' }}
                    </td>
                  </tr> --}}
          </tbody>
        </table>  
            </div>            

            </div>
          </div>
        </div>
        
      </div>
    </div>
  </div>
  <!-- END Main Content --> 
  @endsection
