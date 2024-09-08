@extends('admin.layout.master')                
@section('main_content')
<!-- BEGIN Page Title -->
<link rel="stylesheet" type="text/css" href="{{ url('/') }}/assets/data-tables/latest/dataTables.bootstrap.min.css">

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
    <div class="box {{ $theme_color }}">
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
          <div id="ajax_op_status"></div>
          <div class="alert alert-danger" id="no_select" style="display:none;"></div>
          <div class="alert alert-warning" id="warning_msg" style="display:none;"></div>
        </div>
        <div class="clearfix"></div>
        <div class="table-responsive" style="border:0">
          <input type="hidden" name="multi_action" value="" />
          <table class="table table-condensed table-advance">
            <thead>
              <tr>
                <!-- <th style="width:18px"> 
                  <input type="checkbox" name="mult_change" id="mult_change" />
                </th> -->
                <th>Country Name</th> 
                <th>Country Code</th> 
                <th>Phone Code</th> 
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              @if(isset($arr_data) && sizeof($arr_data)>0)
              @foreach($arr_data as $data)
              <?php $show_url = $module_url_path.'/edit/'.base64_encode($data->id); ?>
              <tr>
                <!-- <td><input type="checkbox" name="checked_record[]" value="{{ base64_encode($data->id) }}" /></td> -->
                <td onclick="show_details('{{ $show_url }}')"> {{ $data->country_name or '-'}}</td> 
                <td onclick="show_details('{{ $show_url }}')"> {{ $data->country_code  or '-'}} </td> 
                <td > {{ $data->phone_code or '-' }} </td> 
                <td>
                  @if($data->is_active==1)
                    <a href="{{ $module_url_path.'/deactivate/'.base64_encode($data->id) }}" class="btn btn-sm btn-success show-tooltip" onclick="return confirm_action(this,event,'Do you really want to Deactivate this record ?')" title="Deactivate" ><i class="fa fa-unlock"></i></a>
                    @else
                    <a href="{{ $module_url_path.'/activate/'.base64_encode($data->id) }}" class="btn btn-sm btn-danger show-tooltip" onclick="return confirm_action(this,event,'Do you really want to Activate this record ?')" title="Activate" ><i class="fa fa-lock"></i></a>
                  @endif 
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
  
@stop                    
