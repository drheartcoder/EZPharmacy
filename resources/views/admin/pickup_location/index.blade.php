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
                <a href="{{ url($admin_panel_slug.'/dashboard') }}">Dashboard</a>
            </li>
            <span class="divider">
                <i class="fa fa-angle-right"></i>
                <i class="fa {{$module_icon or ''}}"></i>
                <a href="{{ $module_url_path }}">{{ $module_title or ''}}</a>
            </span> 
            <span class="divider">
                <i class="fa fa-angle-right"></i>
                  <i class="fa {{$module_icon or ''}}"></i>
            </span>
            <li class="active">{{ $page_title or ''}}</li>
        </ul>
      </div>
    <!-- END Breadcrumb -->

    <!-- BEGIN Main Content -->
    <div class="row">
      <div class="col-md-12">

          <div class="box {{ $theme_color }}">
            <div class="box-title">
              <h3>
                <i class="fa {{$module_icon or ''}}"></i>
                {{ isset($page_title)?$page_title:"" }}
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
            

            <div id="ajax_op_status">
                
            </div>
            <div class="alert alert-danger" id="no_select" style="display:none;"></div>
            <div class="alert alert-warning" id="warning_msg" style="display:none;"></div>
          </div>
          <div class="btn-toolbar pull-right clearfix">

          
          <div class="btn-group">
          <a href="{{ $module_url_path.'/create' }}" class="btn btn-primary btn-add-new-records" title="Add {{ str_singular($module_title) }}">Add {{ str_singular($module_title) }}</a> 
          </div>

              <div class="btn-group">
                 <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" 
                    title="Multiple Active/Unblock" 
                    href="javascript:void(0);" 
                    onclick="javascript : return check_multi_action('frm_manage','activate');" 
                    style="text-decoration:none;">
                 <i class="fa fa-unlock"></i>
                 </a> 
              </div>
              <div class="btn-group">
                 <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" 
                    title="Multiple Deactive/Block" 
                    href="javascript:void(0);" 
                    onclick="javascript : return check_multi_action('frm_manage','deactivate');"  
                    style="text-decoration:none;">
                 <i class="fa fa-lock"></i>
                 </a> 
              </div>
          
            <div class="btn-group"> 
                <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" 
                   title="Refresh" 
                   href="javascript:void(0)"
                   onclick="javascript:location.reload();" 
                   style="text-decoration:none;">
                   <i class="fa fa-repeat"></i>
                </a> 
            </div>
          </div>
          <br/>
          <div class="clearfix"></div>
          <div class="table-responsive" style="border:0">

            <input type="hidden" name="multi_action" value="" />

            <table class="table table-advance"  id="table1" >
              <thead>
                <tr>
                  <th style="width:18px"> <input type="checkbox" name="mult_change" id="mult_change" /></th>
                  <th>Location Name</th> 
                  <th>City</th>
                  <th>Country</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
          
                @if(sizeof($arr_data)>0)
                  @foreach($arr_data as $data)
                      <?php
                        $is_used = array();
                        $is_used = \DB::table('transaction_master')->select('city')->where('city', '=', $data->pickupLocationId)->get();
                      ?>
                    
                      <tr>
                        <td><input type="checkbox" name="checked_record[]" value="{{ base64_encode($data->pickupLocationId) }}" /></td>
                        <td>{{ $data->location}}</td> 
                        <td>{{ $data->cityTitle}}</td> 
                        <td>{{ $data->countryName}}</td> 

                        <td>
                          @if(isset($data->is_active) && $data->is_active==1)
                          <a href="{{ $module_url_path.'/deactivate/'.base64_encode($data->pickupLocationId) }}" class="btn btn-sm btn-success show-tooltip" onclick="return confirm_action(this,event,'Do you really want to Deactivate this record ?')" title="Deactivate" ><i class="fa fa-unlock"></i></a>
                          @else
                          <a href="{{ $module_url_path.'/activate/'.base64_encode($data->pickupLocationId) }}" class="btn btn-sm btn-danger show-tooltip" onclick="return confirm_action(this,event,'Do you really want to Activate this record ?')" title="Activate" ><i class="fa fa-lock"></i></a>
                          @endif
                        </td>
                        <td> 
                            <a class="btn btn-sm btn-primary show-tooltip" href="{{ url($module_url_path.'/edit').'/'.base64_encode($data->pickupLocationId) }}"  title="Edit">
                            <i class="fa fa-edit" ></i>
                            </a>  
                            &nbsp; 
                            <a class="btn btn-sm btn-danger show-tooltip" href="{{ $module_url_path.'/delete/'.base64_encode($data->pickupLocationId)}}" onclick="return confirm_action(this,event,'Do you really want to delete this record ?')"
                            title="Delete"><i class="fa fa-trash" ></i></a>
                        </td> 

                      </tr>
                    
                  @endforeach
                @endif
                 
              </tbody>
            </table>
          </div>
        <div> </div>
         
          </form>
      </div>
  </div>
</div>

<!-- END Main Content -->

 
@stop                    


