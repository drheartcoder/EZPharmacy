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
      <i class="fa fa-globe">
      </i>
      <a href="{{ $module_url_path }}">{{ $module_title or ''}}
      </a>
    </span> 
    <span class="divider">
      <i class="fa fa-angle-right">
      </i>
      <i class="fa fa-edit">
      </i>
    </span>
    <li class="active">{{ $page_title or ''}}
    </li>
  </ul>
</div>
<!-- END Breadcrumb -->
<!-- BEGIN Main Content -->
<div class="row">
  <div class="col-md-12">
    <div class="box">
      <div class="box-title">
        <h3>
          <i class="fa fa-edit">
          </i>
          {{ isset($page_title)?$page_title:"" }}
        </h3>
        <div class="box-tool">
          <a data-action="collapse" href="#">
          </a>
          <a data-action="close" href="#">
          </a>
        </div>
      </div>
      <div class="box-content">
        @include('admin.layout._operation_status')  
        <div class="tabbable">
          <ul  class="nav nav-tabs">
            @include('admin.layout._multi_lang_tab')
          </ul>
          {!! Form::open([ 'url' => $module_url_path.'/update/'.$enc_id,
          'method'=>'POST',
          'enctype' =>'multipart/form-data',   
          'class'=>'form-horizontal',
          'id'=>'validation-form' 
          ]) !!} 
          {{ csrf_field() }}
          <div  class="tab-content">
            @if(isset($arr_lang) && sizeof($arr_lang)>0)
            @foreach($arr_lang as $lang)
          
         <?php                          
                    /* Locale Variable */

                    $locale_title = "";                          
                    $locale_title = isset($arr_data['city_title']) ? $arr_data['city_title'] : "";
                   
                    if(isset($arr_data['translations'][$lang['locale']]))
                    {
                        $locale_title = $arr_data['translations'][$lang['locale']]['city_title'];
                    }
                ?>
            <div class="tab-pane fade {{ $lang['locale']=='en'?'in active':'' }}" 
                 id="{{ $lang['locale'] }}">

              @if($lang['locale']=="en")    

                        <div class="form-group">
                      <label class="col-sm-3 col-lg-2 control-label" for="country_id">Country <i class="red">*</i></label>
                      <div class="col-sm-6 col-lg-4 controls">

                        @if($lang['locale'] == 'en')        
                          {!! Form::text('country_id',$arr_data['country_details']['country_name'],['class'=>'form-control','data-rule-required'=>'true','readonly'=>'readonly']) !!}
                        @endif
                          
                          <span class='help-block'>{{ $errors->first('country_id') }}</span>
                      </div>
                  </div>
              @endif
              <div class="form-group">
                <label class="col-sm-3 col-lg-2 control-label" for="state"> City 
                  <i class="red">*
                  </i>
                </label>
                <div class="col-sm-6 col-lg-4 controls">
                  @if($lang['locale'] == 'en')        
                    {!! Form::text('city_title_'.$lang['locale'],$locale_title,['class'=>'form-control','data-rule-required'=>'true','placeholder'=>'City Title']) !!}
                    @else
                    {!! Form::text('city_title_'.$lang['locale'],$locale_title,['class'=>'form-control','placeholder'=>'City Title']) !!}
                  @endif                  
                </div>
                <span class='help-block'>{{ $errors->first('city_title_'.$lang['locale']) }}
                </span>  
              </div>
            </div>
            @endforeach
            @endif
          </div>
          <br>
          <div class="form-group">
            <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
              {!! Form::submit('Save',['class'=>'btn btn btn-primary','value'=>'true'])!!}
              <a class="btn btn-primary" href="{{ $module_url_path }}"> Back 
              </a>
            </div>
          </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
<!-- END Main Content -->
@stop                    
