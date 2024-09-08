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
                <i class="fa fa-home"></i>
                <a href="{{ url($admin_panel_slug.'/dashboard') }}">Dashboard</a>
            </li>
            <span class="divider">
                <i class="fa fa-angle-right"></i>
                <i class="fa {{$module_icon or ''}}"></i>
                <a href="{{ $module_url_path }}">{{ $module_title or ''}}</a>
            </span> 
            <span class="divider">
                <i class="fa fa-angle-right"></i>
                  <i class="fa fa-plus-square-o"></i>
            </span>
            <li class="active">{{ $page_title or ''}}</li>
        </ul>
      </div>
    <!-- END Breadcrumb -->

    <!-- BEGIN Main Content -->
    <div class="row">
      <div class="col-md-12">

          <div class="box {{ $theme_color }}">
            <div class="box-title">
              <h3>
                <i class="fa fa-plus-square-o"></i>
                {{ isset($page_title)?$page_title:"" }}
            </h3>
            <div class="box-tool">
                <a data-action="collapse" href="#"></a>
                <a data-action="close" href="#"></a>
            </div>
        </div>
        <div class="box-content">
          @include('admin.layout._operation_status')

           <form class="form-horizontal" id="validation-form" method="POST" enctype="multipart/form-data">

            {{ csrf_field() }}
           <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label">Location Name<i class="red">*</i></label>
                  <div class="col-sm-9 col-lg-7 controls" >
                      <input type="text" class="form-control" name="locations_name" value="{{ $arr_data->location or '' }}" data-rule-required="true" data-rule-maxlength="255" placeholder="Location Name" />
                      <span class="help-block">{{ $errors->first('locations_name') }}</span>
                  </div>
            </div> 

               <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label">Location Address Description<i class="red">*</i></label>
                  <div class="col-sm-9 col-lg-7 controls" >
                      <textarea type="text" class="form-control" name="location_description"  data-rule-required="true" data-rule-maxlength="288" placeholder="Location Address Description" >{{ $arr_data->location_description or '' }}</textarea> 
                      <span class="help-block">{{ $errors->first('location_description') }}</span>
                  </div>
            </div>

            <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label">Google Address<i class="red">*</i></label>
                  <div class="col-sm-9 col-lg-7 controls" >
                      <input type="text" class="form-control" id="google_address" name="google_address" value="{{ $arr_data->google_address or '' }}" data-rule-required="true" data-rule-maxlength="255" placeholder="Google Address" />
                      <span class="help-block">{{ $errors->first('google_address') }}</span>
                  </div>
            </div>
          

            <div class="form-group">
                <label class="col-sm-3 col-lg-2 control-label" for="country">Country <i class="red">*</i></label>
                <div class="col-sm-6 col-lg-7 controls">
                    <select class="form-control" name="country" data-rule-required="true" onchange="loadCities(this);" >
                      <option value="">Select Country</option>
                        @if(isset($arr_countries) && sizeof($arr_countries)>0)
                          @foreach($arr_countries as $country)
                            @if($country->id!='' && $country->country_name!='')
                                <option value="{{ $country->id }}"  
                                    @if(isset($arr_data->country) && $arr_data->country == $country->id)
                                    selected="selected"
                                    @endif
                                 >{{ $country->country_name }}</option>
                            @endif
                          @endforeach
                        @endif
                    </select>
                    <span class='help-block'>{{ $errors->first('country') }}</span>
                </div>
            </div>

            <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label">City<i class="red">*</i></label>
                  <div class="col-sm-9 col-lg-7 controls" >
                    <select class="form-control" name="city" data-rule-required="true">
                      <option value="">Select City</option>
                    </select>
                      <span class="help-block">{{ $errors->first('city') }}</span>
                  </div>
            </div>

             <div class="form-group">
              <div class="row">
                  <label class="col-sm-3 col-lg-2 control-label">Latitude<i class="red">*</i></label>
                  <div class="col-sm-9 col-lg-3 controls" >
                      <input type="text" class="form-control" name="lat" id="lat" data-rule-required="true" data-rule-maxlength="255" placeholder="Latitude" value="{{ $arr_data->latitude or '' }}"/>
                      <span class="help-block">{{ $errors->first('lat') }}</span>
                  </div>
                  <label class="col-sm-3 col-lg-1 control-label">Longitude<i class="red">*</i></label>
                  <div class="col-sm-9 col-lg-3 controls" >
                      <input type="text" class="form-control" name="lng" data-rule-required="true" data-rule-maxlength="255" placeholder="Longitude" value="{{ $arr_data->longitude or '' }}"/>
                      <span class="help-block">{{ $errors->first('lng') }}</span>
                  </div>
              </div>
            </div> 

             <br>
                   <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label"> Image  <i class="red"></i> </label>
                      <div class="col-sm-9 col-lg-10 controls">
                          <div class="fileupload fileupload-new" data-provides="fileupload">
                              <div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">
                              @if(isset($arr_data->image) && !empty($arr_data->image))

                              <img src="{{url('').'/uploads/pickup_location/thumb_200X150_'.$arr_data->image }}">
                              @else
                                <img src="{{url('').'/uploads/img_upload.png' }}">
                             @endif
                              </div>
                              <div class="fileupload-preview fileupload-exists img-thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                              <div>
                                  <span class="btn btn-default btn-file" style="height:32px;">
                                      <span class="fileupload-new">Select Image</span>
                                      <span class="fileupload-exists">Change</span>

                                      <input type="file" class="file-input news-image" name="image" id="image"  /><br>
                                      <input type="hidden" class="file-input " name="oldimage" id="oldimage" 
                                      value="{{ $arr_data->image }}"/><br>
                                      
                                  </span>
                                  <a href="#" id="remove" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                              </div>
                              <i class="red">
                              Allowed only jpg | jpeg | png | gif | GIF | JPG | JPEG | PNG image</i>
                            
                             <span for="image" id="err-image" class="help-block">{{ $errors->first(' image') }}</span>
                            
                          </div>
                      </div>
                      <div class="clearfix"></div>
                      <div class="col-sm-6 col-lg-5 control-label help-block-red" style="color:#b94a48;" id="err_logo"></div><br/>
                      <div class="col-sm-6 col-lg-5 control-label help-block-green" style="color:#468847;" id="success_logo"></div>

                </div>




            <div class="form-group">
              <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                <input type="submit" name="btn_update_location" class="btn btn-primary" value="Update">
                <a  href="{{$module_url_path or ''}}"  class="btn btn-primary" > Back</a>
            </div>
        </div>
    </form>
</div>
</div>
</div>

<!-- END Main Content -->
<script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places&key=AIzaSyCccvQtzVx4aAt05YnfzJDSWEzPiVnNVsY"></script>
<script src="{{url('assets')}}/jquery.geocomplete.js"></script>
<script>
    $(function(){      
      $("#google_address").geocomplete({ details: "form" });
    });
  </script>
<script type="text/javascript">

    $(document).ready(function () {
        loadCities(false,'{{ $arr_data->country or ''}}', '{{ $arr_data->city or ''}}');
    });

    var admin_panel_slug = "{{$admin_panel_slug}}";
    var url = "{{ url('/') }}";
    function loadCities(ref , country_id , city_id)
    { 
        var city_id = city_id || false;
        var country_id = country_id || false;

        if(country_id != false || country_id != "") {
          var selected_country = country_id;
        } else {
          var selected_country = $(ref).val();
        }

        var processing = $.ajax({ 
                            url:url+'/'+admin_panel_slug+'/common/get_cities',
                            type:'GET',
                            data: {country_id:selected_country},
                            dataType:'json',
                            beforeSend : function () {
                                if(processing != null) {
                                  return false;
                                }
                            },
                            success: function (response) {
                              if(response.arr_cities.length > 0) {
                                var option = '<option value="">Select City</option>'; 
                                $(response.arr_cities).each(function (index, cities) {
                                  var show_selected = "";
                                  if(city_id != false || city_id != "") {
                                    if(cities.city_id == city_id) {
                                      show_selected = 'selected="selected"';
                                    }
                                  }
                                  option+='<option value="'+cities.city_id+'" '+show_selected+' >'+cities.city_title+'</option>';
                                });
                                $('select[name="city"]').html(option);
                              }
                            }
                        });
    }

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
                               
                            image.onload = function () 
                            {
                                var height = this.height;
                                var width = this.width;
                                /*if (height !=400 || width !=770) 
                                {
                                    swal("Height and Width must be equal to  770 X 400 .");
                                    $(".fileupload-preview").html("");
                                    $(".fileupload").attr('class',"fileupload fileupload-new");
                                    $("#image").val();
                                    return false;


                               
                                }
                                else
                                {
                                   swal("Uploaded image has valid Height and Width.");
                                   return true;
                                }*/

                               
                            };
         
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
 
@stop                    
