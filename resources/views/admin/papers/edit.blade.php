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
      <a href="{{ $module_url_path }}">{{ 'Manage '}}{{ $module_title or ''}}</a>
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
         <form name="validation-form" id="validation-form" action="{{ $module_url_path }}/update" method="POST" class="form-horizontal" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="tab-content">
             <input  type="hidden" readonly="" name="enc_id" value="{{$enc_id or ''}}" ></input>
             <?php 
                        
                        $title = "";
                        $description = "";

                        if(isset($arr_data))
                        {
                            $type = isset($arr_data['paper_type'])?$arr_data['paper_type']:'' ;
                            $size = isset($arr_data['paper_size'])?$arr_data['paper_size']:'' ;
                            $weight = isset($arr_data['paper_weight'])?$arr_data['paper_weight']:'' ;
                           
                        }
                     ?>
               <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label" for="type"> Paper Type
                  <i class="red">*</i> 
                  </label>
                  <div class="col-sm-6 col-lg-4 controls">       
                     <input type="text"
                      class="form-control" 
                      ddata-rule-alphanumeric="true" 
                      name="type" id="type" 
                      data-rule-required="true" 
                      data-rule-maxlength="128"
                      placeholder="Paper Type" 
                      value="{{isset($type)?$type:''}}">
                  </div>
                  <span class='help-block'> {{ $errors->first('type') }} </span>  
                </div>  
                <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label" for="size"> Paper Size
                  <i class="red">*</i> 
                  </label>
                  <div class="col-sm-6 col-lg-4 controls">       
                     <input type="text" class="form-control"
                            data-rule-pattern="[0-9]{2,4}[X,x]{1}[0-9]{2,4}"
                            name="size" id="size" 
                            data-rule-required="true" 
                            data-rule-maxlength="128"
                            placeholder="Paper Size" 
                            value="{{isset($size)?$size:''}}">
                      <i class="red"> Size format length from 2 to 4 : Ex. 12X14 | 12x14  |  1223X1423 | 1223x1423 </i>
                  </div>

                  <span class='help-block'> {{ $errors->first('size') }} </span>  
                </div>  
                <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label" for="email"> Paper Weight
                  <i class="red">*</i> 
                  </label>
                  <div class="col-sm-6 col-lg-4 controls">       
                     <input type="text" 
                     class="form-control" 
                     name="weight" 
                     id="weight" 
                     data-rule-number="true" 
                     data-rule-required="true" 
                     data-rule-maxlength="128" 
                     placeholder="Paper Weight" 
                      value="{{isset($weight)?$weight:''}}">
                     <i class="red"> Consider Weight in grams (gm)</i>
                  </div>
                  <span class='help-block'> {{ $errors->first('weight') }} </span>  
                </div>  
               
               <br>
               <div class="form-group">
                  <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                     <input type="submit" name="btn_add" value="Update" class="btn btn btn-primary">
                  </div>
               </div>
         </form>
         </div>
      </div>
   </div>
</div>
<!-- END Main Content -->

@stop
