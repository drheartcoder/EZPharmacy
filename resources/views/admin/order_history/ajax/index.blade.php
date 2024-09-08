<input type="hidden" name="multi_action" value="" />
                    <table class="table table-advance table-condensed ">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Sent By</th>
                                <th>Sent To</th>
                                <th>Pharmacy</th>
                                <th>Order Type</th>
                                <th>Order Value (<i class="fa fa-inr"></i>)</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                          @if(count($dataOrders))
                            @foreach($dataOrders as $key => $value)
                              <?php
                                $acceptUrl = url('').'/superadmin/order_history/order/accept?id='.$value->orderKey;
                                $rejectUrl   = url('').'/superadmin/order_history/order/reject?id='.$value->orderKey;
                                $viewUrl   = url('').'/superadmin/order_history/order/view?id='.$value->orderKey;
                                $completeUrl = url('').'/superadmin/order_history/order/complete?id='.$value->orderKey;
                              ?>
                              <tr>
                                <td>{{$value->order_id}}</td>
                                <td>{{ucwords($value->senderFullName)}}</td>
                                @if($value->is_doctor_unverified == '1')
                                <td>{{ucwords($value->docsentForFullName)}}</td>
                                @else
                                <td>{{ucwords($value->sentForFullName)}}</td>
                                @endif
                                <td>{{ucwords($value->receiverFullName)}}</td>
                                <td>{{ucwords($value->order_type)}}</td>
                                <td>{{number_format($value->totalPrice,'2','.','')}}</td>
                                <td>{{ucwords($value->orderStatus)}}</td>
                                <td>{{$value->orderedSentOn}}</td>
                                <td>
                                  @if($value->orderStatus == "pending" OR $value->orderStatus == "accepted")
                                    <div class="dropdown">
                                      <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Action<span class="caret"></span></button>
                                      <ul class="dropdown-menu">
                                          @if($value->orderStatus == "pending")
                                            <li><a class="clsAcceptOrder" data-origin="no" href="{{$acceptUrl}}">Accept</a></li>
                                            <li><a class="clsViewOrder" href="{{$viewUrl}}">View</a></li>
                                            <li><a class="clsRejectOrder" data-origin="no" href="{{$rejectUrl}}">Reject</a></li>
                                          @endif
                                          @if($value->orderStatus == "accepted")
                                            <li><a class="clsCompleteOrder" href="{{$completeUrl}}">Complete</a></li>
                                            <li><a class="clsRejectOrder" data-origin="no" href="{{$rejectUrl}}">Reject</a></li>
                                          @endif
                                      </ul>
                                    </div>
                                  @endif
                                </td>
                              </tr>
                            @endforeach
                                @if(!empty($dataOrders->links()))
                                  <tr><td colspan="9">&nbsp;</td></tr>
                                  <tr>
                                      <td colspan="9" style="text-align: right;">
                                          {{$dataOrders->links()}}
                                      </td>
                                  </tr>
                                @endif
                          @endif
                        </tbody>
                    </table>