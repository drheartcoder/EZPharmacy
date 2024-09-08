@include('front.user._inner-breadcrumbs')
<div class="dash-main-block">
    <div class="container">
        <div class="row">
            <div>
                @include('front.user.left-navigation')
            </div>
            <div class="col-xs-12 col-sm-8 col-md-9 col-lg-9">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                       <!-- <div class="search-block-my-order">
                           <div class="search-field-block">
                               <input type="text" name="enter order" placeholder="Enter Order ID or Document Name " />
                           </div>
                           <div class="btn-search-block">
                               <button class="my-order-search-btn" type="submit"><?php echo  (preg_replace('#<[^>]+>#',' ',translation('search')));?></button>
                           </div>
                       </div> -->
                       @include('front._operation_status')
                        <div class="table-block-dash my-order-block-table">
                            <div class="left-bar-head get-uploading"><?php echo  (preg_replace('#<[^>]+>#',' ',translation('my_orders')));?></div>                            
                            <div class="table-responsive">
                                <table class="table table-striped dashboard" style="width: 100%;max-width: 100%;">
                                    <thead>
                                        <tr>
                                            <th><a class="icon" href="javascript:void(0);"><?php echo (preg_replace('#<[^>]+>#',' ',translation('order_id')));?></a></th>
                                            
                                            <th style="text-align: center;"><a class="icon" href="javascript:void(0);"><?php echo (preg_replace('#<[^>]+>#',' ',translation('print_status')));?></a></th>
                                            <th><a class="icon" href="javascript:void(0);"><?php echo (preg_replace('#<[^>]+>#',' ',translation('ptracking_idp')));?></a></th>
                                            <th><a class="icon" href="javascript:void(0);"><?php echo (preg_replace('#<[^>]+>#',' ',translation('order_type')));?></a></th>
                                            <th><a class="icon" href="javascript:void(0);"><?php echo (preg_replace('#<[^>]+>#',' ',translation('total')));?></a></th>
                                            <th><a class="icon" href="javascript:void(0);"><?php echo (preg_replace('#<[^>]+>#',' ',translation('date_added')));?></a></th>
                                            <th style="text-align: center;"><?php echo (preg_replace('#<[^>]+>#',' ',translation('action')));?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php
                                            if(count($orderDetails))
                                            {
                                                foreach($orderDetails as $row)
                                                { ?>
                                                    <tr>
                                                        <td style="font-family:'Open Sans';">
                                                            <a title="View Details" style="color: #2890eb;" href="{{ url('/') }}/user/transaction/details/{{ base64_encode($row->txn_id) }}/">{{$row->txn_id}}</a>
                                                        </td>
                                                        <!-- <td><span class="pending-status">{{$row->txn_status}}</span></td> -->
                                                        <td style="text-align: center;">
                                                            @if($row->order_status == 'pending')
                                                                <!-- <span class="pending-status"><i class="fa fa-circle"></i></span> -->
                                                                <span class="pending-status"><?php echo (preg_replace('#<[^>]+>#',' ',translation('pending')));?></span>
                                                            
                                                            @elseif($row->order_status == 'in_process')
                                                                <!-- <span class="in-progress"><i class="fa fa-circle"></i></span> -->
                                                                <span class="in-progress"><?php echo (preg_replace('#<[^>]+>#',' ',translation('in_process')));?></span>
                                                            
                                                            @elseif($row->order_status == 'ready_for_pickup')
                                                                <!-- <span class="at-pickup-point"><i class="fa fa-circle"></i></span> -->
                                                                <span class="at-pickup-point"><?php echo (preg_replace('#<[^>]+>#',' ',translation('at_pickup_point')));?></span>
                                                            
                                                            @elseif($row->order_status == 'dispatch_to_user')
                                                                <!-- <span class="on-delivery"><i class="fa fa-circle"></i></span> -->
                                                                <span class="on-delivery"><?php echo (preg_replace('#<[^>]+>#',' ',translation('on_delivery')));?></span>
                                                            
                                                            @elseif($row->order_status == 'pickup_by_user')
                                                                <!-- <span class="delivered"><i class="fa fa-circle"></i></span> -->
                                                                <span class="delivered"><?php echo (preg_replace('#<[^>]+>#',' ',translation('pickup_by_user')));?></span>

                                                            @elseif($row->order_status == 'delivered')
                                                                <!-- <span class="delivered"><i class="fa fa-circle"></i></span> -->
                                                                <span class="greened"><?php echo (preg_replace('#<[^>]+>#',' ',translation('delivered')));?></span>

                                                            @else
                                                                <?php echo (preg_replace('#<[^>]+>#',' ',translation('n/a')));?>
                                                            @endif
                                                        </td>
                                                        
                                                        <td style="font-family: 'arial';">{{ucfirst($row->tracking_id)}}</td>
                                                        <td style="font-family: 'arial';">
                                                                <?php
                                                                        $order_type = isset($row->order_type)?$row->order_type:'';
                                                                ?>
                                                                @if($order_type == 'delivery')
                                                                    @if(\App::getLocale() == 'en')
                                                                        Delivery
                                                                    @else
                                                                        توصيل
                                                                    @endif
                                                                @elseif($order_type == 'pickup')
                                                                    @if(\App::getLocale() == 'en')
                                                                        Pickup
                                                                    @else
                                                                        امسك
                                                                    @endif
                                                                @elseif($order_type == 'aramex')
                                                                    @if(\App::getLocale() == 'en')
                                                                        Aramex
                                                                    @else
                                                                        أرامكس
                                                                    @endif
                                                                @endif
                                                        </td>
                                                        <td style="font-family: 'arial';">{{$row->txn_amount}}</td>
                                                        <td style="font-family: 'arial';">{{date('d-m-Y',strtotime($row->txn_date))}}</td>
                                                        <td style="text-align: center">
                                                            <a title="View Details" href="{{ url('/') }}/user/transaction/details/{{ base64_encode($row->txn_id) }}/"><i class="fa fa-eye"></i></a>
                                                        </td>
                                                    </tr>
                                                <?php }
                                            }
                                            else{
                                                echo '<td colspan="7" style="text-align: center;"><span style="font-size: 20px;font-weight: lighter;color: #F00;font-style: italic;">'.strip_tags( translation('no_orders_have_been_placed_yet')).'!</span></td>';
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            @if(count($orderDetails))
                             <?php echo $pageLinks; ?>
                            @endif 
                        </div>
                        <div class="table-block-dash my-order-status">
                            <div class="status-main-block">
                                <div class="status-color-block">
                                    <span class="pending-status"><i class="fa fa-circle"></i></span>
                                    <span class="starus-text"> <?php echo (preg_replace('#<[^>]+>#',' ',translation('pending')));?>:</span>
                                </div>
                                <div class="status-content-block">
                                    <?php echo (preg_replace('#<[^>]+>#',' ',translation('order_still_on_queue_for_ordering')));?>
                                </div>
                            </div>
                            <div class="status-main-block">
                                <div class="status-color-block">
                                    <span class="in-progress"><i class="fa fa-circle"></i></span>
                                    <span class="starus-text"><?php echo (preg_replace('#<[^>]+>#',' ',translation('in_process')));?>:</span>
                                </div>
                                <div class="status-content-block">
                                    <?php echo (preg_replace('#<[^>]+>#',' ',translation('order_is_on_printing_hall')));?>
                                </div>
                            </div>
                            <div class="status-main-block">
                                <div class="status-color-block">
                                    <span class="on-delivery"><i class="fa fa-circle"></i></span>
                                    <span class="starus-text"><?php echo (preg_replace('#<[^>]+>#',' ',translation('on_delivery')));?>:</span>
                                </div>
                                <div class="status-content-block">
                                    <?php echo (preg_replace('#<[^>]+>#',' ',translation('order_is_on_delivery_to_your_door')));?>
                                </div>
                            </div>
                            <div class="status-main-block">
                                <div class="status-color-block">
                                    <span class="at-pickup-point"><i class="fa fa-circle"></i></span>
                                    <span class="starus-text"><?php echo (preg_replace('#<[^>]+>#',' ',translation('at_pickup_point')));?>:</span>
                                </div>
                                <div class="status-content-block">
                                   <?php echo (preg_replace('#<[^>]+>#',' ',translation('order_is_ready_at_the_selected_pickup_point')));?>
                                </div>
                            </div>
                            <div class="status-main-block">
                                <div class="status-color-block">
                                    <span class="delivered"><i class="fa fa-circle"></i></span>
                                    <span class="starus-text"><?php echo (preg_replace('#<[^>]+>#',' ',translation('pickup_by_user')));?>:</span>
                                </div>
                                <div class="status-content-block">
                                    <?php echo (preg_replace('#<[^>]+>#',' ',translation('order_is_picked_by_end_user')));?>
                                </div>
                            </div>
                            <div class="status-main-block">
                                <div class="status-color-block">
                                    <span class="greened"><i class="fa fa-circle"></i></span>
                                    <span class="starus-text"><?php echo (preg_replace('#<[^>]+>#',' ',translation('delivered')));?>:</span>
                                </div>
                                <div class="status-content-block">
                                <?php echo (preg_replace('#<[^>]+>#',' ',translation('order_is_delivered_to_the_end_user')));?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>