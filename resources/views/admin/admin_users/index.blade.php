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
            {{-- <span class="divider">
                <i class="fa fa-angle-right"></i>
                <i class="fa fa-user-secret"></i>
                <a href="{{ $module_url_path }}">{{ $module_title or ''}}</a>
            </span>  --}}
            <span class="divider">
                <i class="fa fa-angle-right"></i>
                  <i class="fa fa-user-secret"></i>
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
                <i class="fa fa-list"></i>
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
          <a href="{{ $module_url_path.'/create' }}" class="btn btn-primary btn-add-new-records" title="Add Admin Roles">Add {{ str_singular($module_title) }}</a> 
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
                   title="Multiple Delete" 
                   href="javascript:void(0);" 
                   onclick="javascript : return check_multi_action('frm_manage','delete');"  
                   style="text-decoration:none;">
                   <i class="fa fa-trash-o"></i>
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
                  <th style="width:18px"> <input type="checkbox" name="mult_change" id="mult_change" value="delete" /></th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Email</th>
                  <th>Roles</th>
                  <th>Set Default</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
          
                @if(sizeof($obj_users)>0)
                  @foreach($obj_users as $user)
                    
                    
                      <tr>
                       
                        <td> 
                          <input type="checkbox" 
                             name="checked_record[]" 
                             value="{{ base64_encode($user['id']) }}" /> 
                        </td>
                        <td>
                            {{ $user->first_name}}
                        </td> 

                        <td >
                            {{ $user->last_name}}
                        </td> 

                        <td >
                            {{ $user->email}}
                        </td> 

                        <td>
                            <?php 
                                $arr_roles = $user->roles->toArray();
                                $arr_roles = array_column($arr_roles,'name');

                                echo implode(", ",$arr_roles);

                            ?>
                        </td> 
                        <td>
                            @if(isset($user->is_default) && $user->is_default==1)
                            <a href="{{ $module_url_path.'/unset_default/'.base64_encode($user->id) }}" class="btn btn-sm btn-success show-tooltip" onclick="return confirm_action(this,event,'Do you really want to unset default this record ?')" title="Unset Default" ><i class="fa fa-user"></i></a>
                            @else
                            <a href="{{ $module_url_path.'/set_default/'.base64_encode($user->id) }}" class="btn btn-sm btn-danger show-tooltip" onclick="return confirm_action(this,event,'Do you really want to set Default this record ?')" title="Set Default" ><i class="fa fa-user"></i></a>
                            @endif
                        </td>

                          <td>
                            @if(isset($user->is_active) && $user->is_active==1)
                            <a href="{{ $module_url_path.'/deactivate/'.base64_encode($user->id) }}" class="btn btn-sm btn-success show-tooltip" onclick="return confirm_action(this,event,'Do you really want to Deactivate this record ?')" title="Deactivate" ><i class="fa fa-unlock"></i></a>
                            @else
                            <a href="{{ $module_url_path.'/activate/'.base64_encode($user->id) }}" class="btn btn-sm btn-danger show-tooltip" onclick="return confirm_action(this,event,'Do you really want to Activate this record ?')" title="Activate" ><i class="fa fa-lock"></i></a>
                            @endif
                          </td>

                         <td> 
                            <a class="btn btn-sm btn-primary show-tooltip" href="{{ url($module_url_path.'/edit')."/".base64_encode($user->id) }}"  title="Edit">
                            <i class="fa fa-edit" ></i>
                            </a>  
                            &nbsp;  
                            <a class="btn btn-sm btn-danger show-tooltip" href="{{ $module_url_path.'/delete/'.base64_encode($user->id)}}"
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
        <div> </div>
         
          </form>
      </div>
  </div>
</div>

<!-- END Main Content -->

 
@stop                    


