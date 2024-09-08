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
      <a href="{{ $module_url_path }}/manage">Manage {{ $module_title }}</a>
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

                  <div class="form-group">
                      <label class="col-sm-3 col-lg-2 control-label" for="weight_gram_common"> Weight [Gram]
                        <i class="red">*</i>
                      </label>
                      <div class="col-sm-6 col-lg-4 controls">   
                      
                        <input type="text" name="weight_gram_common" data-rule-number='true' required="" placeholder="Enter Weight [Gram]" value="{{old('weight_gram_common') or ''}}"  class="form-control add-stundt"/>
                      
                      </div>
                      <span class='help-block'> {{ $errors->first('weight_gram_common') }} </span>  
                  </div>

                  <div class="form-group">
                      <label class="col-sm-3 col-lg-2 control-label" for="page_size"> Page Size
                        <i class="red">*</i>
                      </label>
                      <div class="col-sm-6 col-lg-4 controls">   
                        <select class="form-control" name="size_id" required="">
                          <option value="">Select Page Size</option>
                          @if(count($size_arr) > 0)
                            @foreach($size_arr as $size_arr_value)
                              <option value="<?php if(isset($size_arr_value->id) && $size_arr_value->id != ''){ echo $size_arr_value->id; } else { echo ""; } ?>"><?php if(isset($size_arr_value->size_name) && $size_arr_value->size_name != ''){ echo $size_arr_value->size_name; } else { echo ""; } ?></option>
                            @endforeach
                          @endif
                        </select>
                      
                      </div>
                      <span class='help-block'> {{ $errors->first('weight_gram_common') }} </span>  
                  </div>

                  <div class="form-group">
                      <label class="col-sm-3 col-lg-2 control-label" for="page_size"> Weight [GSM] 
                        <i class="red">*</i>
                      </label>
                      <div class="col-sm-6 col-lg-4 controls">   
                        <select class="form-control" name="gsm_id" required="">
                          <option value="">Select Weight [GSM]</option>
                          @if(count($weight_gsm_arr) > 0)
                            @foreach($weight_gsm_arr as $weight_gsm_arr_value)
                              <option value="<?php if(isset($weight_gsm_arr_value->id) && $weight_gsm_arr_value->id != ''){ echo $weight_gsm_arr_value->id; } else { echo ""; } ?>"><?php if(isset($weight_gsm_arr_value->weight_in_gsm) && $weight_gsm_arr_value->weight_in_gsm != ''){ echo $weight_gsm_arr_value->weight_in_gsm; } else { echo ""; } ?></option>
                            @endforeach
                          @endif
                        </select>
                      </div>
                      <span class='help-block'> {{ $errors->first('weight_gram_common') }} </span>  
                  </div>

                  @if(count($arr_lang) > 0)
                     @foreach($arr_lang as $arr_lang_key => $arr_lang_value)
                        @if($arr_lang_key == 'en')
                           <div class="form-group">
                               <label class="col-sm-3 col-lg-2 control-label" for="weight_gram_description_{{ $arr_lang_key }}"> Weight [Gram] Description {{ ucfirst($arr_lang_value) }}
                                 <i class="red">*</i>
                               </label>
                               <div class="col-sm-6 col-lg-4 controls">   
                                <textarea cols="5" rows="5" style="resize: none;" name="weight_gram_description_{{ $arr_lang_key }}" required="" placeholder="Paper Weight[Gram] Description {{ ucfirst($arr_lang_value) }}" value="{{old('weight_gram_description_'.$arr_lang_key) or ''}}"  class="form-control add-stundt" ></textarea>  
                               </div>
                               <span class='help-block'> {{ $errors->first('weight_gram_description_'.$arr_lang_key) }} </span>  
                           </div>
                        @elseif($arr_lang_key == 'ar')
                           <div class="form-group">
                               <label class="col-sm-3 col-lg-2 control-label" for="weight_gram_description_{{ $arr_lang_key }}"> Weight [Gram] Description {{ ucfirst($arr_lang_value) }}
                                 <i class="red">*</i>
                               </label>
                               <div class="col-sm-6 col-lg-4 controls">   
                                <textarea cols="5" rows="5" dir="rtl" style="resize: none;" name="weight_gram_description_{{ $arr_lang_key }}" required="" placeholder="Paper Weight[Gram] Description {{ ucfirst($arr_lang_value) }}" value="{{old('weight_gram_description_'.$arr_lang_key) or ''}}"  class="form-control add-stundt" ></textarea>  
                               </div>
                               <span class='help-block'> {{ $errors->first('weight_gram_description_'.$arr_lang_key) }} </span>  
                           </div>
                        @endif

                     @endforeach
                  @endif

                  <div class="form-group">
                     <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                        <input type="submit" value="Save" class="btn btn btn-primary" name="btn_add_paper_weight_gram" id="btn_add_paper_weight_gram">
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