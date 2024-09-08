@extends('admin.layout.master') @section('main_content')
<!-- BEGIN Page Title -->
<!-- <div class="page-title">
    <div></div>
</div> -->
<!-- END Page Title -->
<!-- BEGIN Breadcrumb -->
<div id="breadcrumbs">
    <ul class="breadcrumb">
        <li><i class="fa fa-home"></i><a href="{{ url($admin_panel_slug.'/dashboard') }}">Dashboard</a></li>
        <span class="divider">
          <i class="fa fa-angle-right"></i>
          <i class="fa {{$module_icon}}"></i>
        </span>
        <li class="active"> {{ isset($page_title)?$page_title:"" }}</li>
    </ul>
</div>
<!-- END Breadcrumb -->
<!-- BEGIN Main Content -->
<div class="row">
    <div class="col-md-12">
        <div class="box {{ $theme_color }}">
            <div class="box-title">
                <h3><i class="fa {{$module_icon}}"></i>{{ isset($page_title)?$page_title:"" }}</h3>
                <div class="box-tool"></div>
            </div>
            <div class="box-content">
                @include('admin.layout._operation_status') {!! Form::open([ 'url' => $module_url_path.'/update/'.base64_encode($arr_data['id']), 'method'=>'POST', 'class'=>'form-horizontal', 'id'=>'validation-form' , 'enctype'=>'multipart/form-data' ]) !!}

                <div class="form-group">
                    <label class="col-sm-3 col-lg-2 control-label">Profile Image  <i class="red">*</i> </label>
                    <div class="col-sm-9 col-lg-10 controls">
                        <div class="fileupload fileupload-new" data-provides="fileupload">
                            <div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">

                                @if(isset($arr_data['profile_image']) && !empty($arr_data['profile_image']))
                                <img src="{{url('').'/uploads/all_users/admin/'.$arr_data['profile_image'] }}"> @else
                                <img src="{{url('').'/uploads/img_upload.png' }}"> @endif

                            </div>
                            <div class="fileupload-preview fileupload-exists img-thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                            <div>
                                <span class="btn btn-default btn-file" style="height:32px;">
                                <span class="fileupload-new">Select Image</span>
                                <span class="fileupload-exists">Change</span>

                                <input type="file" data-validation-allowing="jpg, png, gif" class="file-input news-image" name="image" id="image" /><br>
                                <input type="hidden" class="file-input " name="oldimage" id="oldimage" value="{{ $arr_data['profile_image'] }}" />

                                </span>
                                <a href="#" id="remove" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                            </div>
                            <i class="red"> 
                        allowed only jpg | jpeg | png </i>
                            <span for="image" id="err-image" class="help-block">{{ $errors->first(' image') }}</span>

                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-sm-6 col-lg-5 control-label help-block-red" style="color:#b94a48;" id="err_logo"></div><br/>
                    <div class="col-sm-6 col-lg-5 control-label help-block-green" style="color:#468847;" id="success_logo"></div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 col-lg-2 control-label">First Name <i class="red">*</i></label>
                    <div class="col-sm-9 col-lg-4 controls">
                        {!! Form::text('first_name',$arr_data['first_name'],['class'=>'form-control','data-rule-required'=>'true','data-rule-maxlength'=>'255','placeholder'=>'First Name']) !!}
                        <span class='help-block'>{{ $errors->first('first_name') }}
            </span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 col-lg-2 control-label">Last Name <i class="red">*</i></label>
                    <div class="col-sm-9 col-lg-4 controls">
                        {!! Form::text('last_name',$arr_data['last_name'],['class'=>'form-control','data-rule-required'=>'true','data-rule-maxlength'=>'255', 'placeholder'=>'Last Name']) !!}
                        <span class='help-block'>{{ $errors->first('last_name') }}
            </span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 col-lg-2 control-label">Email <i class="red">*</i></label>
                    <div class="col-sm-9 col-lg-4 controls">
                        {!! Form::text('email',$arr_data['email'],['class'=>'form-control', 'data-rule-required'=>'true','data-rule-email'=>'true','data-rule-maxlength'=>'255','placeholder'=>'Email']) !!}
                        <span class='help-block'>{{ $errors->first('email') }}
            </span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 col-lg-2 control-label">Phone Number <i class="red">*</i></label>
                    <div class="col-sm-9 col-lg-4 controls">
                        {!! Form::text('mobile_no',$arr_data['mobile_no'],['class'=>'form-control', 'data-rule-required'=>'true','data-rule-number'=>'true','data-rule-maxlength'=>'12','placeholder'=>'Phone Number']) !!}
                        <span class='help-block'>{{ $errors->first('mobile_no') }}
            </span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 col-lg-2 control-label">Fax</label>
                    <div class="col-sm-9 col-lg-4 controls">
                        {!! Form::text('fax',$arr_data['fax'],['class'=>'form-control','placeholder'=>'Fax']) !!}
                        <span class='help-block'>{{ $errors->first('fax') }}
            </span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 col-lg-2 control-label">Country <i class="red">*</i></label>
                    <div class="col-sm-9 col-lg-4 controls">
                        <select name="country" id="country" class="form-control" data-rule-required="true">
              <option value="">Select</option>
              @if(count($country_rec) > 0)
                @foreach($country_rec as $country_rec_value)
                  <option value="<?php if(isset($country_rec_value->id) && $country_rec_value->id != ''){ echo $country_rec_value->id; } else { echo ''; }  ?>" <?php if($arr_data['country'] == $country_rec_value->id){ echo "selected='selected'"; } ?> ><?php if(isset($country_rec_value->country_name) && $country_rec_value->country_name != ''){ echo $country_rec_value->country_name; } else { echo ''; }  ?></option>
                @endforeach
              @endif
            </select>
                        <span class='help-block'>{{ $errors->first('country') }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 col-lg-2 control-label">State <i class="red">*</i></label>
                    <div class="col-sm-9 col-lg-4 controls">
                        <select name="state" id="state" class="form-control" data-rule-required="true">
              <option value="">Select</option>
              @if(count($state_rec) > 0)
                @foreach($state_rec as $key => $value)
                  <option value="<?php if(isset($value->id) && $value->id != ''){ echo $value->id; } else { echo ''; }  ?>" <?php if($arr_data['state'] == $value->id){ echo "selected='selected'"; } ?> ><?php echo $value->state_title;  ?></option>
                @endforeach
              @endif
            </select>
                        <span class='help-block'>{{ $errors->first('state') }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 col-lg-2 control-label">City <i class="red">*</i></label>
                    <div class="col-sm-9 col-lg-4 controls">
                        <select name="city" id="city" class="form-control" data-rule-required="true">
              <option value="">Select</option>
              @if(count($city_rec) > 0)
                @foreach($city_rec as $city_rec_value)
                  <option value="<?php if(isset($city_rec_value->id) && $city_rec_value->id != ''){ echo $city_rec_value->id; } else { echo ''; }  ?>" <?php if($arr_data['city'] == $city_rec_value->id){ echo "selected='selected'"; } ?> ><?php if(isset($city_rec_value->city_title) && $city_rec_value->city_title != ''){ echo $city_rec_value->city_title; } else { echo ''; }  ?></option>
                @endforeach
              @endif
            </select>
                        <span class='help-block'>{{ $errors->first('city') }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 col-lg-2 control-label">Address
            <i class="red">*</i>
          </label>
                    <div class="col-sm-9 col-lg-4 controls">
                        {!! Form::textarea('address',$arr_data['address'],['class'=>'form-control', 'data-rule-required'=>'true','placeholder'=>'Address','rows'=>'4','cols'=>'50']) !!}
                        <span class='help-block'>{{ $errors->first('address') }}
            </span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 col-lg-2 control-label">Postal Code
            <i class="red">
            </i>
          </label>
                    <div class="col-sm-9 col-lg-4 controls">
                        {!! Form::text('zip_code',$arr_data['zip_code'],['class'=>'form-control','placeholder'=>'Postal Code']) !!}
                        <span class='help-block'>{{ $errors->first('zip_code') }}
            </span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                        {!! Form::submit('Update',['class'=>'btn btn btn-primary','value'=>'true'])!!}
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).on("change", ".news-image", function()
        {            
            var file=this.files;
            traverseLogo(this.files);
        });   
        
        function traverseLogo (files) 
        {
    
          if (typeof files !== "undefined") 
          {
            for (var i=0, l=files.length; i<l; i++) 
            {
                var blnValid = false;
                var ext = files[0]['name'].substring(files[0]['name'].lastIndexOf('.') + 1);
                if(ext == "gif" || ext == "GIF" || ext == "JPEG" || ext == "jpeg" || ext == "jpg" || ext == "JPG" || ext == "png" || ext == "PNG")
                {
                  blnValid = true;
                }
                if(blnValid ==false) 
                {
                  swal("Sorry, " + files[0]['name'] + " is invalid, allowed extensions are: gif , jpeg , jpg , png");
                  $(".fileupload-preview").html("");
                  $(".fileupload").attr('class',"fileupload fileupload-new");
                  $("#image").val();
                  return false;
                }
                else
                {
                  var reader = new FileReader();
                  reader.readAsDataURL(files[0]);
                  reader.onload = function (e) 
                  {
                      var image = new Image();
                      image.src = e.target.result;
                  }
                }
            }
          }
          else
          {
            swal("No support for the File API in this web browser");
          } 
        }
    </script>

    <!-- END Main Content -->
    @endsection