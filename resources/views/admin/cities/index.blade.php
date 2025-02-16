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
                <i class="fa {{$module_icon or ''}}"></i>
                <a href="{{ $module_url_path }}">{{ $module_title or ''}}</a>
            </span> 
            <span class="divider">
                <i class="fa fa-angle-right"></i>
                  <i class="fa fa-edit"></i>
            </span>
            <li class="active">{{ isset($page_title)?$page_title:"" }}</li>
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

          <!-- <div class="btn-group">
          <a href="{{ $module_url_path.'/create'}}" class="btn btn-primary btn-add-new-records">Add New City</a> 
          </div> -->
          
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
             {{--  <div class="btn-group">
                
                <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" 
                   title="Multiple Delete" 
                   href="javascript:void(0);" 
                   onclick="javascript : return check_multi_action('frm_manage','delete');"  
                   style="text-decoration:none;">
                   <i class="fa fa-trash-o"></i>
                </a>
              </div>   --}}
              <div class="btn-group"> 
                <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" 
                   title="Refresh" 
                   href="{{ $module_url_path }}"
                   style="text-decoration:none;">
                   <i class="fa fa-repeat"></i>
                </a> 
              </div>
              <br>
          

          </div>
          <br/>
          <div class="clearfix"></div>

         <form name="frmSearchCity" id="frmSearchCity" class="form-horizontal" method="get">
            <div class="form-group">
              <label class="control-label col-lg-2">Name</label>
              <div class="col-lg-6">
                <input type="text" name="txtcity" id="txtcity" class="form-control" value="{{$city}}">
                <label id="error-txtcity"  for="txtcity"></label>
              </div>
              <div class="col-lg-4">
                <button type="button" class="btn btn-sm btn-primary btn-labeled" data-rule-required ="true" name="btnSearchCity" id="btnSearchCity"><b><i class="icon-search4"></i></b> Search</button>
                 <div class="btn-group">
                    <a href="{{ $module_url_path}}" class="btn btn-sm btn-primary btn-labeled">Cancel</a> 
                </div>
              </div>
            </div>
          </form>


          <div class="table-responsive replaceableContent" style="border:0">

            <input type="hidden" name="multi_action" value="" />

            <table class="table table-advance table-condensed"  id="table" >
              <thead>
                <tr>
                  <th style="width:18px"> <input type="checkbox" name="mult_change" id="mult_change" /></th>
                  <th>City</th> 
                  <th>State</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <?php /*$isState = [];*/ ?>
                @if(count($arr_data))
                  @foreach($arr_data as $data)
                  <tr>
                    <td> 
                      <input type="checkbox" name="checked_record[]" value="{{ base64_encode($data->id) }}" />
                    </td>
                    <td> {{ $data->city_title }} </td> 
                    <td> 
                      <?php
                        /*if(!in_array($data->state_title, $isState))
                        {
                          array_push($isState, $data->state_title);
                        }*/
                        echo $data->state_title;
                      ?>
                    </td> 
                    


                      <td>
                        @if($data->is_active==1)
                        <a href="{{ $module_url_path.'/deactivate/'.base64_encode($data->id) }}" class="btn btn-sm btn-success show-tooltip" onclick="return confirm_action(this,event,'Do you really want to Deactivate this record ?')" title="Deactivate" ><i class="fa fa-unlock"></i></a>
                        @else
                        <a href="{{ $module_url_path.'/activate/'.base64_encode($data->id) }}" class="btn btn-sm btn-danger show-tooltip" onclick="return confirm_action(this,event,'Do you really want to Activate this record ?')" title="Activate" ><i class="fa fa-lock"></i></a>
                        @endif
                     </td>
                  </tr>
                  @endforeach
                    @if(!empty($arr_data->links()))
                      <tr><td colspan="4" style="text-align: right;">
                      {{$arr_data->links()}}
                      </td></tr>
                    @endif
                @endif
                 
              </tbody>
            </table>
          </div>
        <div> </div>
         
          {!! Form::close() !!}
      </div>
      <div class="text-right" style="padding-bottom: 10px;padding-top: 10px;">

          
     </div>
  </div>
</div>

<!-- END Main Content -->
<script type="text/javascript">
    function show_details(url)
    { 
       
        window.location.href = url;
    } 

    
    function confirm_delete()
    {
       if(confirm('Are you sure ?'))
       {
        return true;
       }
       return false;
    }

    function check_multi_action(frm_id,action)
    {
      
      if(action == 'delete')
      {
        if(confirm_delete() == false)
            return false;
      }

      var frm_ref = jQuery("#"+frm_id);
      if(jQuery(frm_ref).length && action!=undefined && action!="")
      {
        /* Get hidden input reference */
        var input_multi_action = jQuery('input[name="multi_action"]');
        
        if(jQuery(input_multi_action).length)
        {
          /* Set Action in hidden input*/
          jQuery('input[name="multi_action"]').val(action);

          /*Submit the referenced form */
          jQuery(frm_ref)[0].submit();

        }
        else
        {
          console.warn("Required Hidden Input[name]: multi_action Missing in Form ")
        }
      }
      else
      {
          console.warn("Required Form[id]: "+frm_id+" Missing in Current Page ")
      }
    }


 $(document).on('click', '#btnSearchCity', function(){
    var txtcity = $("#txtcity").val();
   
    if(txtcity != '')
    {
      window.location.href=SITE_URL+'/cities?city='+txtcity;
    }
    else
    {
       $('#error-search').show();
       $('#error-search').html('<div class="alert alert-danger no-border"><button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button><span class="text-semibold">Fail!</span> Please enter brand for search</div>');
       setTimeout(function() {
            $('#error-search').html('');
            $('#error-search').hide('');
            }, 5000);
    }
  });

</script>

@stop                    


