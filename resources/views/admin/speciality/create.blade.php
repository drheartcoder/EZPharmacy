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
      <a href="{{ $module_url_path }}">{{'Manage ' }}{{ $module_title or ''}}</a>
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
          <div class="box {{ $theme_color }}">
            <div class="box-title">
              <h3>
                <i class="fa {{ $module_icon or '' }}"></i>
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
              {!! Form::open([ 'url' => $module_url_path.'/store',
                  'method'=>'POST',
                  'enctype' =>'multipart/form-data',   
                  'class'=>'form-horizontal', 
                  'id'=>'validation-form' 
              ]) !!}

              {{ csrf_field() }}  

              <div id="myTabContent1" class="tab-content">

                  <div class="form-group">
                    <label class="col-sm-3 col-lg-2 control-label" for="txt_area">Speciality <i class="red">*</i></label>
                    <div class="col-sm-6 col-lg-4 controls">
                        <input type="text" class="form-control" id="txt_speciality" name="txt_speciality" placeholder="Enter Speciality" >
                    </div>
                  </div>
              </div>
              <br/>
          
          <div class="form-group">
            <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
              <input type="submit"  class="btn btn-primary" value="Save" >
            </div>
          </div>
        {!! Form::close() !!}
      </div>
      
      
    </div>
  </div>
  </div>


<!-- END Main Content -->

<script type="text/javascript">
    var admin_panel_slug = "{{$admin_panel_slug}}";
    var url = "{{ url('/') }}";
    function loadStates(ref)
     {
        var selected_country = jQuery(ref).val();

        jQuery.ajax({
                        url:url+'/'+admin_panel_slug+'/common/get_states/'+selected_country,
                        type:'GET',
                        data:'flag=true',
                        dataType:'json',
                        beforeSend:function()
                        {
                            jQuery('select[name="state"]').attr('disabled','disabled');
                        },
                        success:function(response)
                        {
                            if(response.status=="SUCCESS")
                            {
                              
                                jQuery('select[name="state_id"]').removeAttr('disabled');
                                if(typeof(response.arr_state) == "object")
                                {
                                   var option = '<option value="">Please Select</option>'; 
                                   jQuery(response.arr_state).each(function(index,states)
                                   {   
                                    
                                        option+='<option value="'+states.id+'">'+states.state_title+'</option>';
                                   });

                                   jQuery('select[name="state_id"]').html(option);
                                }
                            }
                            else
                            {
                              var option = '<option value="">Please Select</option>'; 
                              jQuery('select[name="state_id"]').html(option);
                            }
                            return false;
                        },
                        error:function(response)
                        {
                         
                        }
        });
     }    
</script>

     


@stop                    
