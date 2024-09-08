<table class="table table-advance table-condensed"  id="table" >
  <thead>
    <tr>
      <th style="width:18px"> <input type="checkbox" name="mult_change" id="mult_change" /></th>
      <th>Name</th>
      <th>Status</th>
    </tr>
  </thead>
  <tbody>
    <?php /*$isState = [];*/ ?>
    @if(count($arr_speciality))
      @foreach($arr_speciality as $data)
      <tr>
        <td> 
          <input type="checkbox" name="checked_record[]" value="{{ base64_encode($data->id) }}" />
        </td>
        <td> {{ $data->name }} </td> 

          <td>
            @if($data->is_active==1)
            <a href="{{ $module_url_path.'/deactivate/'.base64_encode($data->id) }}" class="btn btn-sm btn-success show-tooltip" onclick="return confirm_action(this,event,'Do you really want to Deactivate this record ?')" title="Deactivate" ><i class="fa fa-unlock"></i></a>
            @else
            <a href="{{ $module_url_path.'/activate/'.base64_encode($data->id) }}" class="btn btn-sm btn-danger show-tooltip" onclick="return confirm_action(this,event,'Do you really want to Activate this record ?')" title="Activate" ><i class="fa fa-lock"></i></a>
            @endif
         </td>
      </tr>
      @endforeach
        @if(!empty($arr_speciality->links()))
          <tr><td colspan="4" style="text-align: right;">
          {{$arr_speciality->links()}}
          </td></tr>
        @endif
    @endif
     
  </tbody>
</table>