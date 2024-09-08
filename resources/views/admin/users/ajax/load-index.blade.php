<input type="hidden" name="multi_action" value="" />
<table class="table table-advance table-condensed">
<thead>
    <tr>
        <th style="width: 5%; vertical-align: initial;"><input type="checkbox" /></th>
        @if($usertype == "pharmacy")
            <th>Pharmacy Name</th>
        @endif
        <th>Name</th>
        <th>Mobile Number</th>
        @if($usertype == "patient")
            <th>Earned Points</th>
        @endif
        @if($usertype == "doctor" || $usertype == "unverified-doctor")
            <th>Registration No.</th>
            <th>Speciality</th>
        @endif
        <th>Date Of Birth</th>
        @if($usertype == "pharmacy")
            <th>Address</th>
        @endif
        <th>Status</th>
        <th>Reg<sup>n</sup> Date</th>
        <th>&nbsp;</th>
    </tr>
</thead>
<tbody>
    @if(count($arr_data)) @foreach($arr_data as $key => $value)
    <?php
          $modalUrl = url('').'/superadmin/users/retrieve?id='.$value->priKey;
          $deleteUrl = url('').'/superadmin/users/delete?id='.$value->priKey;
          if($value->status == "active")
          {
            $statusUrl = url('').'/superadmin/users/status/blocked?id='.$value->priKey;
          }
          else
          {
            $statusUrl = url('').'/superadmin/users/status/active?id='.$value->priKey;
          }
          $orderUrl = url('').'/superadmin/users/create-order?id='.$value->priKey;
      ?>
        <tr>
            <td><input type="checkbox" /></td>
            @if($usertype == "pharmacy")
                <td>
                    <?php
                        echo $value->pharmacy_name;
                    ?>
                </td>
            @endif
            <td>{{ucwords($value->fullName)}}</td>
            <td>{{$value->mobile_number}}</td>
            @if($usertype == "patient")
                <td>
                    <?php
                        if(count($value->userPoints))
                        {
                           echo $value->userPoints[0]->earnedPoints;
                        }
                    ?>
                </td>
            @endif
            @if($usertype == "doctor")
                <th>{{ $value->registration_no }}</th>
                <th>
                    <?php
                    $temp_arr = explode(',', $value->speciality);
                    if(count($temp_arr)>0)
                    {
                        $spe_arr = [];
                        foreach ($temp_arr as $temp_key) 
                        {
                           $data = DB::table('speciality')->select('name')->where('id',$temp_key)->first();
                           array_push($spe_arr, $data);
                        }
                    }
                    $array = array_map(function ($spe_arr) { return (array) $spe_arr; }, $spe_arr);
                    
                    foreach ($array as $key_val) {
                        foreach ($key_val as $new_val) {
                            echo $new_val.'<br/>';
                        }
                    }
                    ?>
                </th>
            @endif
            <td>{{$value->dateOfbirth}}</td>
            @if($usertype == "pharmacy")
                <td>
                    <?php
                        echo $value->address.'<br>'.$value->area_title.'<br>'.$value->city_title.', '.$value->state_title.'<br>'.$value->country_name.' - '.$value->zipcode;
                    ?>
                </td>
            @endif
            <td>{{ucwords($value->status)}}</td>
            <td>{{$value->regSince}}</td>
            <td style="text-align: center;">
                <div class="dropdown">
                    <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Action<span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        @if($value->status == "active")
                        <li><a class="changeStatus" href="{{$statusUrl}}">Deactivate</a></li>
                        @else
                        <li><a class="changeStatus" href="{{ $statusUrl }}">Activate</a></li>
                        @endif
                        <!-- data-toggle="modal" data-target="#userModal" -->
                        <li><a class="open-user-modal" data-url="{{$modalUrl}}">Edit</a></li>
                        @if($usertype != "pharmacy")
                            <li><a class="open-order-modal" data-sender-id="{{$value->priKey}}" >Create Order</a></li>
                        @endif
                        <li><a class="deleteUser" href="{{$deleteUrl}}">Delete</a></li>
                    </ul>
                </div>
            </td>
        </tr>
        @endforeach @if(!empty($arr_data->links()))
        <?php
            $colspan = 9;
            if($usertype == "pharmacy" || $usertype == "patient")
            {
                $colspan = 8;
            }
        ?>
        <tr><td colspan="{{$colspan}}">&nbsp;</td></tr>
        <tr>
            <td colspan="{{$colspan}}" style="text-align: right;">
                {{$arr_data->links()}}
            </td>
        </tr>
        @endif @endif
</tbody>
</table>