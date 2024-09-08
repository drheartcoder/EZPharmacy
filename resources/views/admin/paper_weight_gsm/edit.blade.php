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
      <i class="fa {{ $module_icon or ''}}"></i>
      <a href="{{ $module_url_path }}/manage">Manage Papers Size</a>
      </span> 
      <span class="divider">
      <i class="fa fa-angle-right"></i>
      <i class="fa fa-edit"></i>
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
            <div class="tabbable">
               <form name="validation-form" id="validation-form" method="POST" action="{{$module_url_path}}/update" class="form-horizontal" enctype="multipart/form-data">
                  {{ csrf_field() }}

                  <input  type="hidden" readonly="" name="enc_id" value="{{$enc_id or ''}}" ></input>

                  <div class="form-group">
                      <label class="col-sm-3 col-lg-2 control-label" for="weight_gsm_common"> Weight [GSM]
                        <i class="red">*</i>
                      </label>
                      <div class="col-sm-6 col-lg-4 controls">   
                      
                        <input type="text" name="weight_gsm_common" data-rule-number='true' required="" placeholder="Enter Weight [GSM]" value="{{ $weight_gsm_arr[0]->weight_in_gsm }}"  class="form-control add-stundt"/>
                      
                      </div>
                      <span class='help-block'> {{ $errors->first('weight_gsm_common') }} </span>  
                  </div>

                  @if(count($arr_lang) > 0)
                    <?php 
                      $i = 0;
                    ?>
                     @foreach($arr_lang as $arr_lang_key => $arr_lang_value)
                        @if($arr_lang_key == 'en')
                           <div class="form-group">
                               <label class="col-sm-3 col-lg-2 control-label" for="weight_gsm_description_{{ $arr_lang_key }}"> Weight [GSM] Description {{ ucfirst($arr_lang_value) }}
                                 <i class="red">*</i>
                               </label>
                               <div class="col-sm-6 col-lg-4 controls">                                                                                              
                                 <textarea cols="5" rows="5" style="resize: none;" name="weight_gsm_description_{{ $arr_lang_key }}" required="" placeholder="Paper Size Description {{ ucfirst($arr_lang_value) }}" class="form-control add-stundt" ><?php if(isset($weight_gsm_desc_arr[$i]->description) && $weight_gsm_desc_arr[$i]->description!=''){ echo $weight_gsm_desc_arr[$i]->description; } else { echo ""; } ?></textarea>
                               </div>
                               <span class='help-block'> {{ $errors->first('weight_gsm_description_'.$arr_lang_key) }} </span>  
                           </div>
                        @elseif($arr_lang_key == 'ar')
                           <div class="form-group">
                               <label class="col-sm-3 col-lg-2 control-label" for="weight_gsm_description_{{ $arr_lang_key }}"> Weight [GSM] Description {{ ucfirst($arr_lang_value) }}
                                 <i class="red">*</i>
                               </label>
                               <div class="col-sm-6 col-lg-4 controls">   
                                 <textarea cols="5" rows="5" dir="rtl" style="resize: none;" name="weight_gsm_description_{{ $arr_lang_key }}" required=""  placeholder="Paper Size Description {{ ucfirst($arr_lang_value) }}"  class="form-control add-stundt" ><?php if(isset($weight_gsm_desc_arr[$i]->description) && $weight_gsm_desc_arr[$i]->description!=''){ echo $weight_gsm_desc_arr[$i]->description; } else { echo ""; } ?></textarea>  
                               </div>
                               <span class='help-block'> {{ $errors->first('weight_gsm_description_'.$arr_lang_key) }} </span>  
                           </div>
                        @endif
                        <?php $i++; ?>
                     @endforeach
                  @endif

                  <div class="form-group">
                     <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                        <input type="submit" value="Update" class="btn btn btn-primary" name="btn_update_paper_weight_gsm" id="btn_update_paper_weight_gsm">
                        <input type="button" value="Back" class="btn btn btn-primary" onclick='window.location.href="{{ $module_url_path }}/manage"'>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- END Main Content -->
@stop
