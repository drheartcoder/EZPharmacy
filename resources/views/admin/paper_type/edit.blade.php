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
      <a href="{{ $module_url_path }}/manage">{{ 'Manage '}}{{ $module_title or ''}}</a>
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
               <form name="validation-form" id="validation-form" method="POST" class="form-horizontal"  enctype="multipart/form-data">
                  {{ csrf_field() }}

                  <input  type="hidden" readonly="" name="enc_id" value="{{$enc_id or ''}}" ></input>
                  @if(count($type_arr)>0)
                  
                           @if(count($arr_lang) > 0)
                           <?php $i=0;?>
                            @foreach($arr_lang as $arr_lang_key => $arr_lang_value)
                               @if($arr_lang_key == 'en')

                                <div class="form-group">
                                    <label class="col-sm-3 col-lg-2 control-label" for="type_name_{{ $arr_lang_key }}">  Name {{ ucfirst($arr_lang_value) }}
                                      <i class="red">*</i>
                                    </label>
                                    <div class="col-sm-6 col-lg-4 controls">   
                                    
                                      <input type="text" name="type_name_{{ $arr_lang_key }}" required="" placeholder="Paper Type Name {{ ucfirst($arr_lang_value) }}" value="{{ $type_arr[$i]->name}}"  class="form-control add-stundt"/>
                                    
                                    </div>
                                    <span class='help-block'> {{ $errors->first('type_name_'.$arr_lang_key) }} </span>  
                                </div>
                                 <div class="form-group">
                                     <label class="col-sm-3 col-lg-2 control-label" for="type_description_{{ $arr_lang_key }}">  Description {{ ucfirst($arr_lang_value) }}
                                       <i class="red">*</i>
                                     </label>
                                     <div class="col-sm-6 col-lg-4 controls">   
                                     
                                       <textarea name="type_description_{{ $arr_lang_key }}" required="" placeholder="Paper Type Description {{ ucfirst($arr_lang_value) }}"  class="form-control add-stundt" >{{ $type_arr[$i]->description}}</textarea>  
                                     
                                     </div>
                                     <span class='help-block'> {{ $errors->first('type_description_'.$arr_lang_key) }} </span>  
                                 </div>
                              @elseif($arr_lang_key == 'ar')
                                <div class="form-group">
                                    <label class="col-sm-3 col-lg-2 control-label" for="type_name_{{ $arr_lang_key }}">  Name {{ ucfirst($arr_lang_value) }}
                                      <i class="red">*</i>
                                    </label>
                                    <div class="col-sm-6 col-lg-4 controls">   
                                    
                                      <input type="text" name="type_name_{{ $arr_lang_key }}" required="" placeholder="Paper Type Name {{ ucfirst($arr_lang_value) }}" value="{{ $type_arr[$i]->name}}"  class="form-control add-stundt"/>
                                    
                                    </div>
                                    <span class='help-block'> {{ $errors->first('type_name_'.$arr_lang_key) }} </span>  
                                </div>
                                 <div class="form-group">
                                     <label class="col-sm-3 col-lg-2 control-label" for="type_description_{{ $arr_lang_key }}">  Description  {{ ucfirst($arr_lang_value) }}
                                       <i class="red">*</i>
                                     </label>
                                     <div class="col-sm-6 col-lg-4 controls">   
                                     
                                       <textarea name="type_description_{{ $arr_lang_key }}" required=""  placeholder="Paper Type Description {{ ucfirst($arr_lang_value) }}"  class="form-control add-stundt" >{{ $type_arr[$i]->description}}</textarea>  
                                     
                                     </div>
                                     <span class='help-block'> {{ $errors->first('type_description_'.$arr_lang_key) }} </span>  
                                 </div>
                              @endif
                               <?php $i++;?>
                           @endforeach
                          
                        @endif 


                    
                  @endif

                 
                  <br>
                  <div class="form-group">
                     <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                         <input type="submit" value="Update" class="btn btn btn-primary" name="btn_update_paper_type" id="btn_update_paper_type">
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
