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
                      <label class="col-sm-3 col-lg-2 control-label" for="category"> Category
                        <i class="red">*</i>
                      </label>
                      <div class="col-sm-6 col-lg-4 controls">   
                        <input  type="hidden" readonly="" name="category_id" value="{{ $price_paper_size->category_id }}" ></input>
                        <select class="form-control" name="category" id="category" disabled="">
                          <option value="">Select Category</option>
                          @if(count($category_arr) > 0)
                            @foreach($category_arr as $category_arr_value)
                              <option value="{{ $category_arr_value->id or '' }}" <?php if(isset($price_paper_size->category_id)){ if($price_paper_size->category_id == $category_arr_value->id){ echo "selected=selected"; } else{ echo ""; } } else{ echo ""; } ?> >{{ $category_arr_value->name or 'N/A' }}</option>
                            @endforeach
                          @endif
                        </select>

                      </div>
                      <span class='help-block' id="err_category"> {{ $errors->first('size_name_common') }} </span>  
                  </div>
                  <div class="form-group">
                      <label class="col-sm-3 col-lg-2 control-label" for="size"> Size
                        <i class="red">*</i>
                      </label>
                      <div class="col-sm-6 col-lg-4 controls">   
                        <input  type="hidden" readonly="" name="size_id" value="{{ $price_paper_size->size_id }}" ></input>
                      
                        <select class="form-control" name="size" id="size" disabled=''>
                          <option value="">Select Size</option>
                          @if(count($size_arr) > 0)
                            @foreach($size_arr as $size_arr_value)
                              <option value="{{ $size_arr_value->id or '' }}" <?php if(isset($price_paper_size->size_id) && $price_paper_size->size_id != ''){ if($price_paper_size->size_id == $size_arr_value->id){ echo "Selected=selected"; } else{ echo ""; } } else{ echo ""; } ?> >{{ $size_arr_value->size_name or 'N/A' }}</option>
                            @endforeach
                          
                          @endif
                        </select>

                      </div>
                      <span class='help-block' id="err_size"> {{ $errors->first('size') }} </span>  
                  </div>

                  <input  type="hidden" readonly="" name="paperType" value="{{ $price_paper_size->type_id or ''}}" ></input>

                  <div class="form-group">
                      <label class="col-sm-3 col-lg-2 control-label" for="paper_type"> Type
                        <i class="red">*</i>
                      </label>
                      <div class="col-sm-6 col-lg-4 controls">
                        <select class="form-control" id="paper_type" name="paper_type" disabled="">
                            <option value="">Select Type</option>
                            @if(count($resPaperType))
                              @foreach($resPaperType as $row)
                                <option value="{{$row->primaryKey}}"
                                {{ isset($price_paper_size->type_id) && $price_paper_size->type_id == $row->primaryKey ? 'selected=selected' : '' }}
                                >{{$row->paperType}}</option>
                              @endforeach
                            @endif
                        </select>
                      </div>
                      <span class='help-block' id="err_size"> {{ $errors->first('paperType') }} </span>  
                  </div>


                  <input  type="hidden" readonly="" name="paperGsm" value="{{ $price_paper_size->gsm_id or '' }}" ></input>


                  <div class="form-group">
                      <label class="col-sm-3 col-lg-2 control-label" for="paperGsm"> GSM
                        <i class="red">*</i>
                      </label>
                      <div class="col-sm-6 col-lg-4 controls">
                        <select class="form-control" id="paperGsm" name="paperGsm" disabled="">
                            <option value="">Select GSM</option>
                            @if(count($resPaperGsm))
                              @foreach($resPaperGsm as $row)
                                <option value="{{$row->primaryKey}}"
                                {{ isset($price_paper_size->gsm_id) && $price_paper_size->gsm_id == $row->primaryKey ? 'selected=selected' : '' }}
                                >{{$row->paperGsm}} GSM</option>
                              @endforeach
                            @endif
                        </select>
                      </div>
                      <span class='help-block' id="err_size"> {{ $errors->first('paperGsm') }} </span>  
                  </div>

                  <div class="form-group">
                      <label class="col-sm-3 col-lg-2 control-label" for="size_name_common"> Price
                        <i class="red">*</i>
                      </label>
                      <div class="col-sm-6 col-lg-4 controls">   
                        <input type="text" name="price" id="price" placeholder="Enter Price" value="<?php if(isset($price_paper_size->price) && $price_paper_size->price != ''){ echo $price_paper_size->price; } else { echo ""; } ?>"  class="form-control add-stundt"/>
                      </div>
                      <span class='help-block' id="err_price"> {{ $errors->first('price') }} </span>  
                  </div>

                  <div class="form-group">
                     <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                        <input type="submit" id="btn_submit" value="Update" class="btn btn btn-primary" name="btn_update_price_size" id="btn_update_price_size">
                        <input type="button" value="Back" class="btn btn btn-primary" onclick='window.location.href="{{ $module_url_path }}/manage"'>
                     </div>
                  </div>

               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">
    $(document).ready(function()
    {
        $("#btn_submit").click(function()
        {

         // alert();return false;
            var category        = $("#category").val();
            var size            = $("#size").val();
            var price           = $("#price").val();
            
            var flag=1;
            if(category=='')
            {
               $("#err_category").html("Please select the category name");
               $("#category").focus();
               $("#category").change(function(){
                 $("#err_category").html("");
               });

               var flag=0;

            }
             if(size=='')
            {
               $("#err_size").html("Please select the size ");
               $("#size").focus();
               $("#size").change(function(){
                 $("#err_size").html("");
               });

               var flag=0;

            }
            if(price == '')
            {
               $("#err_price").html("Please enter the  price");
               $("#price").focus();
               $("#price").keyup(function(){
                 $("#err_price").html("");
               });
               var flag=0;
            }
            else if(isNaN(price))
            {
               $("#err_price").html("Please enter the valid price");
               $("#price").focus();
               $("#price").keyup(function(){
                 $("#err_price").html("");
               });
               var flag=0;
            }

             else if(price==0)
            {
               $("#err_price").html("Price not equal to zero");
               $("#price").focus();
               $("#price").keyup(function(){
                 $("#err_price").html("");
               });
               var flag=0;
            }

           
            

            if(flag==1)
            {
                return true ;
            }
            else
            {
                return false;
            }
        });
    });
</script>
<!-- END Main Content -->
@stop
