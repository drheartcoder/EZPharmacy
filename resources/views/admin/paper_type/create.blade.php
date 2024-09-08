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
      <a href="{{ $module_url_path }}/manage">Manage Papers Type</a>
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
      <div class="box">
         <div class="box-title">
            <h3>
               <i class="fa fa-plus"></i>
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

            <form name="validation-form" id="validation-form" method="POST" class="form-horizontal" enctype="multipart/form-data">
             {{ csrf_field() }}

                  {{-- <ul  class="nav nav-tabs">
                     @include('admin.layout._multi_lang_tab')
                  </ul> --}}

                  {{-- <div id="myTabContent1" class="tab-content">
                     @if(isset($arr_lang) && sizeof($arr_lang)>0)
                     @foreach($arr_lang as $lang)
                     
                     <div class="tab-pane fade {{ $lang['locale']=='en'?'in active':'' }}"
                        id="{{ $lang['locale'] }}">
                        <div class="form-group">
                           <label class="col-sm-3 col-lg-2 control-label" for="skill_name">{{ $module_title or ''}} Name<i class="red">*</i></label>
                           <div class="col-sm-6 col-lg-4 controls">
                              @if($lang['locale'] == 'en') 
                              <input type="text" name="name_{{$lang['locale']}}" class="form-control" value="{{old('name_'.$lang['locale'])}}" data-rule-required="true" data-rule-maxlength="255" placeholder="{{ $module_title or ''}} Name">
                              @else
                              <input type="text" name="name_{{$lang['locale']}}" class="form-control" value="{{old('name_'.$lang['locale'])}}" placeholder="{{ $module_title or ''}} Name" data-rule-required="" data-rule-maxlength="255">
                              @endif    
                              <span class='error'>{{ $errors->first('name_'.$lang['locale']) }}</span>
                           </div>
                        </div>
                     </div>

                     @endforeach
                     @endif
                  </div> --}}
                  {{-- <br> --}}
                 

                  @if(count($arr_lang) > 0)
                     @foreach($arr_lang as $arr_lang_key => $arr_lang_value)
                        
                        @if($arr_lang_key == 'en')
                          <div class="form-group">
                              <label class="col-sm-3 col-lg-2 control-label" for="type_name_{{ $arr_lang_key }}">  Name {{ ucfirst($arr_lang_value) }}
                                <i class="red">*</i>
                              </label>
                              <div class="col-sm-6 col-lg-4 controls">   
                              
                                <input type="text" name="type_name_{{ $arr_lang_key }}" required="" placeholder="Paper Type Name {{ ucfirst($arr_lang_value) }}" value="{{old('type_name_'.$arr_lang_key) or ''}}"  class="form-control add-stundt"/>
                              
                              </div>
                              <span class='help-block'> {{ $errors->first('type_name_'.$arr_lang_key) }} </span>  
                          </div>
                           <div class="form-group">
                               <label class="col-sm-3 col-lg-2 control-label" for="type_description_{{ $arr_lang_key }}">  Description {{ ucfirst($arr_lang_value) }}
                                 <i class="red">*</i>
                               </label>
                               <div class="col-sm-6 col-lg-4 controls">   
                               
                                 <textarea name="type_description_{{ $arr_lang_key }}" required="" placeholder="Paper Type Description {{ ucfirst($arr_lang_value) }}" value="{{old('type_description_'.$arr_lang_key) or ''}}"  class="form-control add-stundt" ></textarea>  
                               
                               </div>
                               <span class='help-block'> {{ $errors->first('type_description_'.$arr_lang_key) }} </span>  
                           </div>
                        @elseif($arr_lang_key == 'ar')
                          <div class="form-group">
                              <label class="col-sm-3 col-lg-2 control-label" for="type_name_{{ $arr_lang_key }}">  Name {{ ucfirst($arr_lang_value) }}
                                <i class="red">*</i>
                              </label>
                              <div class="col-sm-6 col-lg-4 controls">   
                              
                                <input type="text" name="type_name_{{ $arr_lang_key }}" required="" placeholder="Paper Type Name {{ ucfirst($arr_lang_value) }}" value="{{old('type_name_'.$arr_lang_key) or ''}}"  class="form-control add-stundt"/>
                              
                              </div>
                              <span class='help-block'> {{ $errors->first('type_name_'.$arr_lang_key) }} </span>  
                          </div>
                           <div class="form-group">
                               <label class="col-sm-3 col-lg-2 control-label" for="type_description_{{ $arr_lang_key }}">  Description  {{ ucfirst($arr_lang_value) }}
                                 <i class="red">*</i>
                               </label>
                               <div class="col-sm-6 col-lg-4 controls">   
                               
                                 <textarea name="type_description_{{ $arr_lang_key }}" required=""  placeholder="Paper Type Description {{ ucfirst($arr_lang_value) }}" value="{{old('type_description_'.$arr_lang_key) or ''}}"  class="form-control add-stundt" ></textarea>  
                               
                               </div>
                               <span class='help-block'> {{ $errors->first('type_description_'.$arr_lang_key) }} </span>  
                           </div>
                        @endif

                     @endforeach
                  @endif

                  <div class="form-group">
                     <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                        <input type="submit" value="Save" class="btn btn btn-primary" name="btn_add_paper_type" id="btn_add_paper_type">
                        <input type="button" value="Back" class="btn btn btn-primary" onclick='window.location.href="{{ $module_url_path }}/manage"'>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>

@stop