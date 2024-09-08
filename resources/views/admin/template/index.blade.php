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
      <i class="fa fa-home"></i>
      <a href="{{ url($admin_panel_slug.'/dashboard') }}"> Dashboard </a>
    </li>
    <span class="divider">
      <i class="fa fa-angle-right"></i>
      <i class="fa fa-envelope"></i>
      <a href="{{ $module_url_path }}"> {{ $module_title or ''}} </a>
    </span> 
    <span class="divider">
      <i class="fa fa-angle-right"></i>
      <i class="fa fa-list"></i>
    </span>
    <li class="active"> {{ $page_title or ''}} </li>
  </ul>
</div>
<!-- END Breadcrumb -->
<!-- BEGIN Main Content -->
<div class="row">
  <div class="col-md-12">
    <div class="box {{ $theme_color }}">
      <div class="box-title">
        <h3>
          <i class="fa fa-list"></i>
          {{ $page_title or ''}}
        </h3>
        <div class="box-tool">
          <a data-action="collapse" href="#"></a>
          <a data-action="close" href="#"></a>
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
        <div class="btn-toolbar pull-right clearfix">
          <div class="btn-group"> 
            <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" 
               title="Refresh" 
               href="{{ $module_url_path }}"
               style="text-decoration:none;">
              <i class="fa fa-repeat"></i>
            </a> 
          </div>
        </div>
        <br/>
        <br/>
        <div class="clearfix">
        </div>
        <div class="table-responsive" style="border:0">
          <table class="table table-advance"  id="table_module" >
            <thead>
              <tr>
                <th>   ID       </th>
                <th>   Template Name</th> 
                <th>   Edit Email Template     </th> 
                {{-- <th>   Edit SMS Template     </th>  --}}
                <th>   Action     </th> 
                
              </tr>
            </thead>
            <tbody>
              @if( isset($arr_data) && sizeof($arr_data)>0)
              @foreach($arr_data as $key => $template)  {{-- {{dd($module_url_path)}} --}}
              <tr>
                <td>{{$template['id']}} </td>
                <td>{{ $template['template_name'] }}</td>

                <td>  
                        @if(isset($template['email_template_details']) && sizeof($template['email_template_details'])>0)
                          <a class="btn btn-primary" href="{{ $module_url_path.'/email_template/edit/'.base64_encode($template['email_template_details']['id']) }}"  title="Edit Email Template">{{-- <i class="fa fa-edit" > --}}Edit Email Template</i></a>
                        @else
                          <a class="btn btn-primary" href="{{ $module_url_path.'/email_template/create/'.base64_encode($template['id']) }}"  title="Add Email Template">{{-- <i class="fa fa-edit" > --}}Add Email Template</i></a>
                        @endif
                </td> 

               {{--  
               <td>    
                        @if(isset($template['sms_template_details']) && sizeof($template['sms_template_details'])>0)
                          <a class="btn btn-primary" href="{{ $module_url_path.'/sms_template/edit/'.base64_encode($template['sms_template_details']['id']) }}"  title="Edit SMS Template">Edit SMS Template</i></a>
                        @else
                          <a class="btn btn-primary" href="{{ $module_url_path.'/sms_template/create/'.base64_encode($template['id']) }}"  title="Add SMS Template">Add SMS Template</i></a>
                        @endif
                </td>  
                --}}
                
                <td>
                  <a href="{{ $module_url_path.'/edit/'.base64_encode($template['id']) }}" class="btn btn-sm btn-primary show-tooltip"  title="Edit"><i class="fa fa-edit" ></i></a>
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
  
  /*$(document).ready(function() {
        $('#table_module').DataTable( {
            "aoColumns": [
            { "bSortable": true },
            { "bSortable": true },
            { "bSortable": true },
            { "bSortable": true },
            { "bSortable": true },
            { "bSortable": false }
            ]

        });
    });
*/
</script>

@stop