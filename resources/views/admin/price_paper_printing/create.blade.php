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
                      <label class="col-sm-3 col-lg-2 control-label" for="category"> Category
                        <i class="red">*</i>
                      </label>
                      <div class="col-sm-6 col-lg-4 controls">   
                      
                        <select class="form-control" name="category" id="category" >
                          <option value="">Select Category</option>
                          @if(count($category_arr) > 0)
                            @foreach($category_arr as $category_arr_value)
                              <option value="{{ $category_arr_value->id or '' }}">{{ $category_arr_value->name or 'N/A' }}</option>
                            @endforeach
                          @endif
                        </select>

                      </div>
                      <span class='help-block' id="err_category"> {{ $errors->first('size_name_common') }} </span>  
                  </div>

                  <div class="form-group">
                      <label class="col-sm-3 col-lg-2 control-label" for="paperSize"> Size
                        <i class="red">*</i>
                      </label>
                      <div class="col-sm-6 col-lg-4 controls">
                        <select id="paperSize" name="paperSize" class="form-control">
                            @if(count($resPaperSize))
                              <option value="">Select Size</option>
                              @foreach($resPaperSize as $row)
                                <option value="{{$row->primaryKey}}">{{$row->paperSize}}</option>
                              @endforeach
                            @endif
                        </select>
                      </div>
                      <span class='help-block' id="err_paperSize"> {{ $errors->first('paperSize') }} </span>  
                  </div>

                  <div class="form-group">
                      <label class="col-sm-3 col-lg-2 control-label" for="paperColor"> Colour
                        <i class="red">*</i>
                      </label>
                      <div class="col-sm-6 col-lg-4 controls">
                        <select class="form-control" id="paperColor" name="paperColor">
                              @if(count($resPaperColor))
                                <option value="">Select Colour</option>
                                @foreach($resPaperColor as $row)
                                  <option value="{{$row->primaryKey}}">{{$row->paperColor}}</option>
                                @endforeach
                              @endif
                          </select>
                      </div>
                      <span class='help-block' id="err_paperColor"> {{ $errors->first('paperColor') }} </span>  
                  </div>


               
                  <div class="form-group">
                      <label class="col-sm-3 col-lg-2 control-label" for="size_name_common"> Price
                        <i class="red">*</i>
                      </label>
                      <div class="col-sm-6 col-lg-4 controls">   
                        <input type="text" name="price" id="price" placeholder="Enter Price" value="{{old('price') or ''}}"  class="form-control add-stundt"/>
                      </div>
                      <span class='help-block' id="err_price"> {{ $errors->first('price') }} </span>  
                  </div>

                  <div class="form-group">
                     <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                        <input type="submit" id="btn_submit" value="Save" class="btn btn btn-primary" name="btn_add_price_printing" >
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
            var category        = $("#category").val();
            var paperSize       = $("#paperSize").val();
            var paperColor      = $("#paperColor").val();
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

            if(paperSize=='')
            {
               $("#err_paperSize").html("Please select the size");
               $("#paperSize").focus();
               $("#paperSize").change(function(){
                 $("#err_paperSize").html("");
               });

               var flag=0;

            }

            if(paperColor=='')
            {
               $("#err_paperColor").html("Please select the Colour");
               $("#paperColor").focus();
               $("#paperColor").change(function(){
                 $("#err_paperColor").html("");
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
@stop