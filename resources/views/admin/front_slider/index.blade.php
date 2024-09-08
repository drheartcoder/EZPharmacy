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
      <a class=" call_loader" href="{{ url($admin_panel_slug.'/dashboard') }}">Dashboard
      </a>
    </li>
    <span class="divider">
      <i class="fa fa-angle-right">
      </i>
      <i class="fa {{$module_icon}}" aria-hidden="true">
      </i>
      <a class=" call_loader" href="{{ $module_url_path }}">{{ $module_title or ''}}
      </a>
    </span> 
    <span class="divider">
      <i class="fa fa-angle-right">
      </i>
      <i class="fa fa-list">
      </i>
    </span>
    <li class="active">{{ isset($page_title)?$page_title:"" }}
    </li>
  </ul>
</div>
<!-- END Breadcrumb -->

<!-- BEGIN Main Content -->
<div class="row">
  <div class="col-md-12">
    <div class="box box-navi_blue">
      <div class="box-title">
        <h3>
          <i class="fa fa-list">
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
        {!! Form::open([ 'url' => $module_url_path.'/multi_action',
        'method'=>'POST',
        'enctype' =>'multipart/form-data',   
        'class'=>'form-horizontal', 
        'id'=>'frm_manage' 
        ]) !!} 
        {{ csrf_field() }}
        <div class="col-md-10">
          <div id="ajax_op_status">
          </div>
          <div class="alert alert-danger" id="no_select" style="display:none;">
          </div>
          <div class="alert alert-warning" id="warning_msg" style="display:none;">
          </div>
        </div>
        <div class="btn-toolbar pull-right clearfix">
          <div class="btn-group">
            <a href="{{ $module_url_path.'/create'}}" class="btn btn-primary btn-add-new-records">Add New
            </a> 
          </div>
          <div class="btn-group">                
            <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip call_loader" 
               title="Multiple Delete" 
               href="javascript:void(0);" 
               onclick="javascript : return check_multi_action('frm_manage','delete');"  
               style="text-decoration:none;">
              <i class="fa fa-trash-o">
              </i>
            </a>
          </div>  
          <div class="btn-group"> 
            <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip call_loader" 
               title="Refresh" 
               href="{{ $module_url_path }}"
               style="text-decoration:none;">
              <i class="fa fa-repeat">
              </i>
            </a> 
          </div>
        </div>
        <br/>
        <div class="clearfix">
        </div>
        <div class="table-responsive" style="border:0">
          <input type="hidden" name="multi_action" value="" />
          <table class="table table-advance" {{-- id="table1" --}} >
            <thead>
              <tr>
                <th style="width:18px"> 
                  <input type="checkbox" name="mult_change" id="mult_change" />
                </th>
                <th>Image
                </th> 
          {{-- <th>Title
                </th> --}}
                <th>Order
                </th>
          {{-- <th>Image Alt
                </th>
                <th>Start Date
                </th>
                <th>End Date
                </th>--}} 
                <th>Action
                </th>
              </tr>
            </thead>
            <tbody>
              @if(sizeof($arr_data)>0)
              @foreach($arr_data as $slider_data)
              <tr>
                <td> 
                  <input type="checkbox" 
                         name="checked_record[]"  
                         value="{{ base64_encode($slider_data['id']) }}" /> 
                </td>
                <td >
                          
                  <img src="{{ $front_slider_public_img_path.'/'.$slider_data['image']}}" alt="" style="width:95px; height:65px;" />   
                </td>  
                
                {{-- <td> {{ $slider_data['title'] }} 
                </td> --}} 
                <td > 
                  <input type="text" class="form-control" style="background-color: white;width:120px;" 
                         value="{{ $slider_data['order_index'] }}"
                         data-slider-id="{{ $slider_data['id'] }}" 
                         onblur="save_order(this)"
                         id="order_index" />
                </td>
{{--                 <td> 
                  {{ $slider_data['image_alt'] }}
                </td>
                <td> 
                  {{ date('d M Y',strtotime($slider_data['start_date'])) }}
                </td>
                <td> 
                  {{ date('d M Y',strtotime($slider_data['end_date'])) }}
                </td>
 --}}           <td> 
                  {{-- <a class=" call_loader" href="{{ $module_url_path.'/edit/'.base64_encode($slider_data['id']) }}" title="Edit">
                    <i class="fa fa-edit" >
                    </i>
                  </a>  
                  &nbsp;  
                  <a href="{{ $module_url_path.'/delete/'.base64_encode($slider_data['id']) }}"  
                     onclick="return confirm_action(this,event);"
                     title="Delete">
                    <i class="fa fa-trash" >
                    </i>  
                  </a>   --}}

                   <a class="btn btn-sm btn-primary show-tooltip" href="{{ $module_url_path.'/edit/'.base64_encode($slider_data['id']) }}"  title="Edit">
                    <i class="fa fa-edit" ></i>
                    </a>  
                    &nbsp;  
                    <a class="btn btn-sm btn-danger show-tooltip" href="{{ $module_url_path.'/delete/'.base64_encode($slider_data['id'])}}" 
                    onclick="return confirm_action(this,event,'Do you really want to delete this record ?')"
                    title="Delete">
                    <i class="fa fa-trash" ></i>
                    </a>
                </td>
              </tr>
              @endforeach
              @endif
            </tbody>
          </table>
        </div>
        <div>   
        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
  
<!-- END Main Content -->

<script type="text/javascript">
  function show_details(url)
  {
    window.location.href = url;
  }
  function save_order(elem)
  {
    var url       = "{{ $module_url_path }}";
    var order_id  = jQuery(elem).val();
    var slider_id = jQuery(elem).attr("data-slider-id");
    console.log("order_id:-  "+order_id);
    console.log("slider_id:-  "+slider_id);
    if(order_id == "")
    {
      alert("Please Enter Order");
      document.focus(elem);
      return false;
    }
    else
    {
      jQuery.ajax({
        url:url+'/save_order',
        type:'GET',
        dataType:'json',
        data :{
          'order_id' : order_id ,'slider_id':slider_id }
        ,
        success:function(response)
        {
          if(response.status=="SUCCESS")
          {
          }
          if(response.status=="DUPLICATE")
          {
            alert(response.msg);
          }
          if(response.status=="NUMERIC")
          {
            alert(response.msg);
          }
          return false;
        }
      }
                 );
    }
  }

  
</script>
<!--page specific plugin scripts-->

@stop                    
