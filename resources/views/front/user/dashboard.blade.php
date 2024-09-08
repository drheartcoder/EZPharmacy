@include('front.user._inner-breadcrumbs')
<div class="dash-main-block">
    <div class="container">
        <div class="row">
            <div>
                @include('front.user.left-navigation')
            </div>
            <div class="col-xs-12 col-sm-8 col-md-9 col-lg-9">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                        <div class="wallet-box-main-block">
                            <a href="{{url('')}}/user/my-wallet/">
                                <div class="wallet-box">
                                    <div class="wallet-image"> <img src="{{url('').'/front-assets/'}}images/wallet-img.png" alt="wallet" /> </div>
                                    <div class="text-price">
                                        <div class="wallet-title"><?php echo (preg_replace('#<[^>]+>#',' ',translation('wallet')));?></div>
                                        <div class="wallet-amount">{{currency_code().' '.$remainWallet}}</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                        <div class="wallet-box-main-block">
                            <a href="{{url('')}}/user/my-orders/">
                                <div class="wallet-box">
                                    <div class="wallet-image"> <img src="{{url('').'/front-assets/'}}images/order.png" alt="order" /> </div>
                                    <div class="text-price">
                                        <div class="wallet-title"><?php echo (preg_replace('#<[^>]+>#',' ',translation('my_orders')));?></div>
                                        <div class="wallet-amount">{{count($orderDetails)}}</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                        <div class="wallet-box-main-block">
                            <a href="{{url('')}}/user/create-document/">
                                <div class="wallet-box">
                                    <div class="wallet-image"> <img src="{{url('').'/front-assets/'}}images/creat-doc.png" alt="crete" /> </div>
                                    <div class="text-price-doc">
                                        <div class="wallet-title">
                                            <?php echo (preg_replace('#<[^>]+>#',' ',translation('upload')));?>
                                            <br/>
                                            <?php echo (preg_replace('#<[^>]+>#',' ',translation('document')));?>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>


                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                        <div class="dash-profile-block">
                            <div class="my-pro-text"><?php echo (preg_replace('#<[^>]+>#',' ',translation('my_profile')));?></div>
                            <a href="{{url('')}}/user/account/"> <i class="fa fa-pencil-square-o"></i> </a>
                            <div class="border-line">
                                <hr/>
                            </div>
                            <?php 
                                $profile_image='';
                                 if(isset($arr_logged_user))
                                 {
                                    $profile_image=$arr_logged_user['profile_image'];
                                    $user_type=$arr_logged_user['user_type'];
                                 }
                            ?>
                            <div class="main-round-image">
                                <div class="pro-image-edit">
                                    @if($profile_image!='')
                                    <img src="{{ url('/').'/uploads/all_users/'.$arr_logged_user['loginId'].'/profile/thumb_107X107_'.$profile_image}}" alt="edit-pro" />
                                    @else
                                     <img src="{{ url('/front-assets').'/images/user.png'}}" alt="edit-pro" />
                                    @endif
                                    </div>
                            </div>
                            <div class="text-all-pro">
                                <div class="profile-name">{{$arr_logged_user['full_name'] or ''}}</div>
                                <div class="profile-company">{{$arr_logged_user['email_address'] or ''}}</div>
                                <div class="profile-company">{{$arr_logged_user['mobile_number'] or ''}}</div>
                                @if($user_type =='corporate')
                                  <div class="profile-company">{{$arr_logged_user['country_name'] or ''}}</div>
                                @endif

                                <div class="profile-address">
                                {{ $arr_logged_user['address']?ucfirst( $arr_logged_user['address']).' ,':''}}
                                {{ $arr_logged_user['city_title']?ucfirst( $arr_logged_user['city_title']).' ,':''}}
                                {{ $arr_logged_user['country_name']?ucfirst( $arr_logged_user['country_name']).' ,':''}}
                                {{ $arr_logged_user['zipcode']?$arr_logged_user['zipcode'].' .':''}}

                               
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                        <div class="table-block-dash my-order-block-table">
                            <div class="left-bar-head get-uploading">
                                <?php echo (preg_replace('#<[^>]+>#',' ',translation('my_orders')));?>[ <?php echo (preg_replace('#<[^>]+>#',' ',translation('latest_5_orders')));?>]
                            </div>
                            <div class="table-responsive">
                                <?php
                                    /*echo '<pre>';
                                        print_r($orderDetails);
                                    echo '</pre>';*/
                                ?>
                                <table class="table table-striped dashboard" style="width: 100%;max-width: 100%;">
                                    <thead>
                                        <tr>
                                            <th><a class="icon" href="javascript:void(0);"><?php echo (preg_replace('#<[^>]+>#',' ',translation('order_id')));?></a></th>
                                            <!-- <th><a class="icon" href="javascript:void(0);"><?php echo (preg_replace('#<[^>]+>#',' ',translation('status')));?></a></th> -->
                                            <th><a class="icon" href="javascript:void(0);"><?php echo (preg_replace('#<[^>]+>#',' ',translation('print_status')));?></a></th>
                                           <!--  <th><a class="icon" href="javascript:void(0);"><?php echo (preg_replace('#<[^>]+>#',' ',translation('sub_total')));?></a></th>
                                            <th><a class="icon" href="javascript:void(0);"><?php echo (preg_replace('#<[^>]+>#',' ',translation('processing_fee')));?></a></th> -->
                                            <th><a class="icon" href="javascript:void(0);"><?php echo (preg_replace('#<[^>]+>#',' ',translation('ptracking_idp')));?></a></th>
                                            <th><a class="icon" href="javascript:void(0);"><?php echo (preg_replace('#<[^>]+>#',' ',translation('order_type')));?></a></th>
                                            <?php /*<th><a class="icon" href="javascript:void(0);"><?php echo (preg_replace('#<[^>]+>#',' ',translation('delivery_price')));?></a></th>*/ ?>
                                            <th><a class="icon" href="javascript:void(0);"><?php echo (preg_replace('#<[^>]+>#',' ',translation('total')));?></a></th>
                                            <th><a class="icon" href="javascript:void(0);"><?php echo (preg_replace('#<[^>]+>#',' ',translation('date_added')));?></a></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php
                                            if(count($orderDetails))
                                            {
                                                foreach($orderDetails as $row)
                                                { ?>
                                                    <tr>
                                                        <td style="font-family:'Open Sans';"><a style="font-size: 12px;color: #2890eb;" href="{{ url('/') }}/user/transaction/details/{{ base64_encode($row->txn_id) }}/">{{$row->txn_id}}</a></td>
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
                                                        <!-- <td style="font-family: 'arial';">
                                                            <?php
                                                                $_actualPrice = ($row->txn_amount - $row->delivery_charges);
                                                                if(!empty($row->processing_fee) && $row->processing_fee > 0)
                                                                {
                                                                    $_actualPrice = $row->txn_amount/(1+($row->processing_fee/100));
                                                                }
                                                                $_actualPrice = $_actualPrice - $row->delivery_charges;
                                                                echo round($_actualPrice,2);
                                                            ?>
                                                        </td>
                                                        <td style="font-family: 'arial';">
                                                            <?php
                                                                $_processinCharge = 0;
                                                                if(!empty($row->processing_fee) && $row->processing_fee > 0)
                                                                {
                                                                    $_processinCharge = ($row->txn_amount-$row->delivery_charges) - $_actualPrice;
                                                                }
                                                                echo number_format($_processinCharge,2,'.','');
                                                            ?>
                                                        </td> -->
                                                        <td style="font-family: 'arial';">{{ucfirst($row->tracking_id)}}</td>
                                                        <td style="font-family: 'arial';"> <?php
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
                                                                @endif</td>
                                                        <?php /*<td style="font-family: 'arial';">{{$row->delivery_charges}}</td> */?>
                                                        <td style="font-family: 'arial';">{{$row->txn_amount}}</td>
                                                        <td style="font-family: 'arial';">{{date('d-m-Y',strtotime($row->txn_date))}}</td>
                                                    </tr>
                                                <?php }
                                            }
                                            else{
                                                echo '<td colspan="6" style="text-align: center;"><span style="font-size: 20px;font-weight: lighter;color: #F00;font-style: italic;">'.strip_tags(translation('no_orders_have_been_placed_yet')).'!</span></td>';
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="table-block-dash my-order-status">
                            <div class="status-main-block">
                                <div class="status-color-block">
                                    <span class="pending-status"><i class="fa fa-circle"></i></span>
                                    <span class="starus-text"><?php echo (preg_replace('#<[^>]+>#',' ',translation('pending')));?>:</span>
                                </div>
                                <div class="status-content-block"><?php echo (preg_replace('#<[^>]+>#',' ',translation('order_still_on_queue_for_ordering')));?>
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