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

           <form class="form-horizontal" id="validation-form" method="POST">

            {{ csrf_field() }}

            
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
                  <label class="col-sm-3 col-lg-2 control-label">Same Day Delivery<i class="red">*</i></label>
                  <div class="col-sm-9 col-lg-7 controls" >
                    <select class="form-control" name="same_day_delivery" data-rule-required="true">
                      <option value="">Select</option>
                      <option value="yes" @if(isset($arr_data->same_day_delivery) && $arr_data->same_day_delivery == 'yes') selected="selected" @endif>Yes</option>
                      <option value="no" @if(isset($arr_data->same_day_delivery) && $arr_data->same_day_delivery == 'no') selected="selected" @endif>No</option>
                    </select>
                      <span class="help-block">{{ $errors->first('same_day_delivery') }}</span>
                  </div>
            </div>
              <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label">Price<i class="red">*</i></label>
                  <div class="col-sm-9 col-lg-7 controls" >
                      <input type="text" class="form-control" name="delivery_price" value="{{ $arr_data->delivery_price  }}" data-rule-required="true" data-rule-number="true" placeholder="Price" />
                      <span class="help-block">{{ $errors->first('delivery_price') }}</span>
                  </div>
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
</script>
 
@stop                    