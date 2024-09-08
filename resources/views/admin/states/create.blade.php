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
      <i class="fa {{ $module_icon or '' }}"></i>
      <a href="{{ $module_url_path }}">{{'Manage ' }}{{ $module_title or ''}}</a>
      </span> 
      <span class="divider">
      <i class="fa fa-angle-right"></i>
      <i class="fa fa-plus"></i>
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
              <i class="fa {{ $module_icon or '' }}"></i>
              {{ isset($page_title)?$page_title:"" }}
            </h3>
            <div class="box-tool">
              <a data-action="collapse" href="#"></a>
              <a data-action="close" href="#"></a>
            </div>
          </div>
          <div class="box-content">

            @include('admin.layout._operation_status')  

            <div class="tabbable">

              

              <form method="POST" id="validation-form" class="form-horizontal" action="{{$module_url_path}}/store" enctype="multipart/form-data">

              {{ csrf_field() }}

              <ul  class="nav nav-tabs">
                @include('admin.layout._multi_lang_tab')
              </ul>

              <div  class="tab-content">

              @if(isset($arr_lang) && sizeof($arr_lang)>0)
                @foreach($arr_lang as $lang)

                <div class="tab-pane fade {{ $lang['locale']=='en'?'in active':'' }}" 
                id="{{ $lang['locale'] }}">

                @if($lang['locale']=="en")
                  <div class="form-group">
                    <label class="col-sm-3 col-lg-2 control-label" for="state"> Country Name<i class="red">*</i> </label>
                    <div class="col-sm-6 col-lg-4 controls">
                      <select name="country_id" class="form-control" data-rule-required="true" >
                          <option value="">Select Country</option>
                          @if(isset($arr_country) && count($arr_country) > 0)
                            @foreach($arr_country as $key => $country)
                              @if(isset($key) && $key != "" && isset($country) && $country != "")
                                <option value="{{$key or ''}}" 
                                  @if(old('country_id') == $key) 
                                    selected="selected"
                                  @endif 
                                  > {{$country or ''}} </option>
                              @endif
                            @endforeach
                          @endif
                      </select>
                    </div>
                    <span class='help-block'>{{ $errors->first('country_id_'.$lang['locale']) }}</span>  
                  </div>
                @endif

              <div class="form-group">
                <label class="col-sm-3 col-lg-2 control-label" for="state"> State Title <i class="red">*</i> </label>
                <div class="col-sm-6 col-lg-4 controls">

                  @if($lang['locale'] == 'en')     
                  {!! Form::text('state_title_en',old('state_title_en'),['class'=>'form-control','data-rule-required'=>'true','placeholder'=>'State Title']) !!}
                  @else
                  {!! Form::text('state_title_'.$lang['locale'],old('state_title_'.$lang['locale'])) !!}
                  @endif    
                </div>
                <span class='help-block'>{{ $errors->first('state_title_'.$lang['locale']) }}</span>  
              </div>
            </div>

            @endforeach
            @endif

          </div>
          
          <br>

          <div class="form-group">
            <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
              <input type="submit" class="btn btn btn-primary"  name="Save" /> 
            </div>
          </div>

          </form>

        </div>
      </div>
    </div>
  </div>
<!-- END Main Content -->
@stop                    
