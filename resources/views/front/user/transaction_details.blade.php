@include('front.user._inner-breadcrumbs')
<div class="dash-main-block">
    <div class="container">
        <div class="row">
            <div>
                @include('front.user.left-navigation')
            </div>
            <?php
            if($div == 'transaction_details')
            { 
                ?>
                <div class="col-xs-12 col-sm-8 col-md-9 col-lg-9">
                    <div class="full-white-box">
                        <div id="profile_status_msg"></div>
                        <div class="row">
                            <div class="left-bar-head get-uploading">
                                <?php echo (preg_replace('#<[^>]+>#',' ',translation('order_details')));?>
                                <a class="" style="float: right;" href="{{ $back_url }}"><?php echo (preg_replace('#<[^>]+>#',' ',translation('back')));?></a>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="pro-picture-title line"></div>
                            </div>
                            
                            <div class="col-sm-6 col-md-6 col-lg-6">
                                <div class="email-box-2">
                                    <div class="email-title">
                                       <label><?php echo (preg_replace('#<[^>]+>#',' ',translation('transaction_id')));?>:</label> <?php if(isset($orderDetails->txnId) && $orderDetails->txnId!= ''){ echo $orderDetails->txnId; } else { echo translation('na'); } ?>
                                    </div>
                                </div>
                                
                                
                                <div class="email-box-2">
                                    <div class="email-title">
                                        <label><?php echo (preg_replace('#<[^>]+>#',' ',translation('pdf')));?>:</label> <?php if(( (isset($orderDetails->loginId))&&($orderDetails->loginId!='') ) && ( (isset($orderDetails->fileName))&&($orderDetails->fileName!='') )){  ?> <a download href="{{ $uploads_public_path }}{{ $orderDetails->loginId }}/product/{{ $orderDetails->fileName }}">
                                        <?php if(isset($orderDetails->fileName) && $orderDetails->fileName!= ''){ $file_name = '-';
                                              $arr_file =  explode("---",$orderDetails->fileName);
                                              $file_name = isset($arr_file[1])?$arr_file[1]:'-';
                                                echo $file_name; 
                                                } else 
                                                { 
                                                    echo translation('na'); 
                                                } 
                                        ?></a> <?php } else { ?>
                                         <a href="javascript:void(0);">
                                         <?php if(isset($orderDetails->fileName) && $orderDetails->fileName!= '')
                                         { 
                                             $file_name = '-';
                                              $arr_file =  explode("---",$orderDetails->fileName);
                                              $file_name = isset($arr_file[1])?$arr_file[1]:'-';
                                            echo $file_name; 
                                        } 
                                        else 
                                        { 
                                            echo translation('na'); 
                                        } ?>     
                                        </a> 
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="email-box-2">
                                    <div class="email-title">
                                        <label><?php echo (preg_replace('#<[^>]+>#',' ',translation('number_of_pages')));?>:</label> <?php if(isset($orderDetails->numOfPages) && $orderDetails->numOfPages!= ''){ echo $orderDetails->numOfPages; } else { echo translation('na'); } ?>
                                    </div>
                                </div>
                                <div class="email-box-2">
                                    <div class="email-title">
                                        <label><?php echo (preg_replace('#<[^>]+>#',' ',translation('document_type')));?>:</label> <?php if(isset($orderDetails->documentTypeName) && $orderDetails->documentTypeName!= ''){ echo $orderDetails->documentTypeName; } else { echo translation('na'); } ?>
                                    </div>
                                </div>
                                <div class="email-box-2">
                                    <div class="email-title">
                                        <label>{{(preg_replace('#<[^>]+>#','',translation('paper_size')))}} :</label> <?php if(isset($orderDetails->sizeName) && $orderDetails->sizeName!= ''){ echo $orderDetails->sizeName; } else { echo translation('na'); } ?>
                                    </div>
                                </div>
                                <div class="email-box-2">
                                    <div class="email-title">

                                       <label><?php echo (preg_replace('#<[^>]+>#',' ',translation('paper_type')));?>:</label> <?php if(isset($orderDetails->paperTypeName) && $orderDetails->paperTypeName!= ''){ echo $orderDetails->paperTypeName; } else { echo translation('na'); } ?>

                                    </div>
                                </div>
                                <div class="email-box-2">
                                    <div class="email-title">
                                        <label><?php echo (preg_replace('#<[^>]+>#',' ',translation('paper_weight_gsmweightingsm')));?>:</label> <?php if(isset($orderDetails->weightInGsm) && $orderDetails->weightInGsm!= ''){ echo $orderDetails->weightInGsm; } else { echo translation('na'); } ?>
                                    </div>
                                </div>
                                <div class="email-box-2">
                                    <div class="email-title">
                                        <label><?php echo (preg_replace('#<[^>]+>#',' ',translation('color')));?>:</label> <?php if(isset($orderDetails->paperColorName) && $orderDetails->paperColorName!= ''){ echo $orderDetails->paperColorName; } else { echo translation('na'); } ?>
                                    </div>
                                </div>
                                <div class="email-box-2">
                                    <div class="email-title">
                                        <label><?php echo (preg_replace('#<[^>]+>#',' ',translation('printing_side')));?>:</label> <?php if(isset($orderDetails->sideName) && $orderDetails->sideName!= ''){ echo $orderDetails->sideName; } else { echo translation('na'); } ?>
                                    </div>
                                </div>
                                <div class="email-box-2">
                                    <div class="email-title">
                                        <label><?php echo (preg_replace('#<[^>]+>#',' ',translation('binding')));?>:</label> <?php if(isset($orderDetails->bindingOptionName) && $orderDetails->bindingOptionName!= ''){ echo $orderDetails->bindingOptionName; } else { echo translation('na'); } ?>
                                    </div>
                                </div>
                                <div class="email-box-2">
                                    <div class="email-title">
                                        <label><?php echo (preg_replace('#<[^>]+>#',' ',translation('folding')));?>:</label> <?php if(isset($orderDetails->foldingOptionName) && $orderDetails->foldingOptionName!= ''){ echo $orderDetails->foldingOptionName; } else { echo translation('na'); } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-6">
                                <div class="email-box-2">
                                    <div class="email-title">

                                        <label><?php echo (preg_replace('#<[^>]+>#',' ',translation('transaction_price')));?>({{currency_code()}}) :</label> <?php if(isset($orderDetails->txnPrice) && $orderDetails->txnPrice!= ''){ echo $orderDetails->txnPrice; } else { echo translation('na'); } ?>

                                    </div>
                                </div>
                                <div class="email-box-2">
                                    <div class="email-title">
                                        <label><?php echo (preg_replace('#<[^>]+>#',' ',translation('processing_fee')));?>(%) :</label> <?php if(isset($orderDetails->processingfee) && $orderDetails->processingfee!= ''){ echo $orderDetails->processingfee; } else { echo translation('na'); } ?>
                                    </div>
                                </div>
                                <div class="email-box-2">
                                    <div class="email-title">
                                        <label><?php echo (preg_replace('#<[^>]+>#',' ',translation('status')));?>:</label> <?php if(isset($orderDetails->txnStatus) && $orderDetails->txnStatus!= ''){ echo $orderDetails->txnStatus; } else { echo translation('na'); } ?>
                                    </div>
                                </div>
                                <div class="email-box-2">
                                    <div class="email-title">
                                        <label><?php echo (preg_replace('#<[^>]+>#',' ',translation('pay_via')));?>:</label> <?php if(isset($orderDetails->payVia) && $orderDetails->payVia!= ''){ echo ucfirst($orderDetails->payVia); } else { echo translation('na'); } ?>
                                    </div>
                                </div>
                                <div class="email-box-2">
                                    <div class="email-title">
                                    <?php
                                            /*echo $orderDetails->orerType;
                                            die;*/
                                            switch ($orderDetails->orerType)
                                            {
                                                case 'aramex':
                                                    $shippingTo   = json_decode($orderDetails->shipping_to,TRUE);
                                                    $receiverName    = $shippingTo['name'];
                                                    $receiverEmail   = $shippingTo['email'];
                                                    $receiverContact = $shippingTo['contact'];
                                                    $receiverCompany = $shippingTo['company'] == "not-required"?$shippingTo['name']:$shippingTo['company'];
                                                    $receiverAddress = $shippingTo['address'];
                                                    $receiverCity    = $shippingTo['city'];
                                                    $receiverCountry = $shippingTo['country'];
                                                    $receiverPostcode = $shippingTo['postcode'];
                                                    $strDisplay = $receiverName.'<br>'.$receiverEmail.'<br>'.$receiverContact.'<br>'.$receiverAddress.'<br>'.$receiverCity.'<br>'.$receiverCountry.' - '.$receiverPostcode;
                                                break;
                                                case 'pickup':
                                                    $strDisplay = $orderDetails->address;
                                                    $strDisplay .= '[ ';
                                                        if(isset($orderDetails->cityTitle) && $orderDetails->cityTitle != '' && $orderDetails->cityTitle != null)
                                                        { $strDisplay.= ucfirst($orderDetails->cityTitle).','; }
                                                        if(isset($orderDetails->countryName) && $orderDetails->countryName != '' && $orderDetails->countryName != null)
                                                        { $strDisplay.= ucfirst($orderDetails->countryName); }
                                                        $strDisplay.=' ]';
                                                break;
                                                case 'delivery':
                                                    $strDisplay = $orderDetails->address;
                                                    $strDisplay .= '[ ';
                                                    if(isset($orderDetails->cityTitle) && $orderDetails->cityTitle != '' && $orderDetails->cityTitle != null)
                                                    { $strDisplay.= ucfirst($orderDetails->cityTitle).','; }
                                                    if(isset($orderDetails->countryName) && $orderDetails->countryName != '' && $orderDetails->countryName != null)
                                                    { $strDisplay.= ucfirst($orderDetails->countryName); }
                                                    $strDisplay.=' ]';
                                                break;
                                                
                                                default:
                                                    $strDisplay = '';
                                                break;
                                            }
                                            /*$str = '[ ';
                                            if(isset($orderDetails->cityTitle) && $orderDetails->cityTitle != '' && $orderDetails->cityTitle != null)
                                            { $str.= ucfirst($orderDetails->cityTitle).','; }
                                            if(isset($orderDetails->countryName) && $orderDetails->countryName != '' && $orderDetails->countryName != null)
                                            { $str.= ucfirst($orderDetails->countryName); }
                                            $str.=' ]';*/
                                            /*echo $strDisplay;
                                            $str = '';*/
                                        ?>

                                        <label><?php echo (preg_replace('#<[^>]+>#',' ',translation('address')));?>:</label> <?php echo $strDisplay!= ''?$strDisplay:translation('na'); ?>

                                    </div>
                                </div>
                                <div class="email-box-2">
                                    <div class="email-title">
                                        <label><?php echo (preg_replace('#<[^>]+>#',' ',translation('transaction_date')));?>:</label> <?php if(isset($orderDetails->txnDate) && $orderDetails->txnDate!= ''){ echo date('d-m-Y H:i A',strtotime($orderDetails->txnDate)); } else { echo translation('na'); } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="btn-block-print account margin">
                            <button type="button" class="print-deliver-btn clsReOrder" data-id="{{isset($orderDetails->orderId)?$orderDetails->orderId:''}}" id="btnReOrder" name="btnReOrder"><i class="fa fa-mail-forward"></i><?php echo (preg_replace('#<[^>]+>#',' ',translation('preorderp')));?></button>
                        </div>
                    </div>
                </div>
                <?php
            }
            else
            {
                ?>
                <div class="col-sm-8 col-md-9 col-lg-9">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                           @include('front._operation_status')
                            <div class="table-block-dash my-order-block-table">
                                <div class="left-bar-head get-uploading"><?php echo (preg_replace('#<[^>]+>#',' ',translation('my_transactions')));?><a class="" style="float: right;" href="{{ $back_url }}"><?php echo (preg_replace('#<[^>]+>#',' ',translation('back')));?></a> </div>
                                <div class="table-responsive">
                                    <table class="table table-striped dashboard">
                                        <thead>
                                            <tr>
                                                <th><a class="icon" href="javascript:void(0);"><?php echo (preg_replace('#<[^>]+>#',' ',translation('order_id')));?></a></th>
                                                <th><a class="icon" href="javascript:void(0);"><?php echo (preg_replace('#<[^>]+>#',' ',translation('status')));?></a></th>
                                                <th><a class="icon" href="javascript:void(0);"><?php echo (preg_replace('#<[^>]+>#',' ',translation('total')));?></a></th>
                                                <th><a class="icon" href="javascript:void(0);"><?php echo (preg_replace('#<[^>]+>#',' ',translation('date_added')));?></a></th>
                                                <th style="text-align: center;"><?php echo (preg_replace('#<[^>]+>#',' ',translation('action')));?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php
                                                if(count($transactionDetails))
                                                {
                                                    foreach($transactionDetails as $row)
                                                    { ?>
                                                        <tr>
                                                            <td style="font-family:'Open Sans';">
                                                                <a title="View Details" style="color: #2890eb;" href="{{ url('/') }}/user/transaction/details/{{ base64_encode($row->txn_id) }}/{{ base64_encode($row->id) }}/">{{$row->txn_id}}-{{$row->id}}</a>
                                                            </td>
                                                            <td><span class="pending-status">{{$row->txn_status}}</span></td>
                                                            <td style="font-family: 'arial';">{{$row->total_amount}}</td>
                                                            <td style="font-family: 'arial';">{{date('d-m-Y',strtotime($row->txn_date))}}</td>
                                                            <td style="text-align: center">

                                                                <a title="View Details" href="{{ url('/') }}/user/transaction/details/{{ base64_encode($row->txn_id) }}/{{ base64_encode($row->id) }}/"> <i class="fa fa-eye"></i></a>

                                                                <a title="Re-order" id="loader_{{$row->id}}" class="clsReOrder" data-id="{{$row->id}}" href="javascript:void(0);"><i class="fa fa-mail-forward"></i></a>

                                                            </td>
                                                        </tr>

                                                    <?php }
                                                }
                                                else
                                                {
                                                    ?>
                                                    <tr><td colspan="5" style="color: #F00;font-style: italic;font-weight: lighter;font-size: 20px;text-align: center;"><?php echo (preg_replace('#<[^>]+>#',' ',translation('transactions_not_found')));?></td></tr>
                                                    <?php
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
                                    <div class="status-content-block">
                                        <?php echo (preg_replace('#<[^>]+>#',' ',translation('order_still_on_queue_for_ordering')));?>
                                    </div>
                                </div>
                                <div class="status-main-block">
                                    <div class="status-color-block">
                                        <span class="in-progress"><i class="fa fa-circle"></i></span>
                                        <span class="starus-text"><?php echo (preg_replace('#<[^>]+>#',' ',translation('in_progress')));?>:</span>
                                    </div>
                                    <div class="status-content-block"><?php echo (preg_replace('#<[^>]+>#',' ',translation('order_is_on_printing_hall')));?>
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
                <?php
            }
            ?>
        </div>
    </div>
</div>
<script type="text/javascript">
var are_you_sure_want_to_reorder_selected_item = "<?php echo (preg_replace('#<[^>]+>#',' ',translation('are_you_sure_want_to_reorder_selected_item')));?>";
var please_wait = "<?php echo (preg_replace('#<[^>]+>#',' ',translation('please_wait')));?>";
var confirm = "<?php echo (preg_replace('#<[^>]+>#',' ',translation('pconfirmp')));?>";
$('body').on('click','.clsReOrder',function(){
    var _id = $(this).data('id');

    var _current = $(this);
    
    $.alert.open('confirm',are_you_sure_want_to_reorder_selected_item, function(button) {
        if (button == 'yes')
            reorder(_id);
        else if (button == 'no')
          return false;
        else
          return false;
    });
});
var isOrder = null;
function reorder(_id)
{
    var dataStr = {_id:_id};
    isOrder = $.ajax({
        headers:{'X-CSRF-Token': $('input[name="_token"]').val()},
        url : SITE_URL+'/user/re-order/',
        type : "POST",
        dataType: 'JSON',
        data : dataStr,
        beforeSend:function(data, statusText, xhr, wrapper){
            if(isOrder != null)
            {
                return false
            }
            $('#loader_'+_id).html('<i class="fa fa-spinner fa-spin fa-fw"></i>');
            $('#btnReOrder').html('<i class="fa fa-spinner fa-spin fa-fw"></i><span> '+please_wait+'</span>');
        },
        success:function(data, statusText, xhr, wrapper)
        {
            isOrder = null;
            if(data.status == "done"){
                location.href = SITE_URL+'/user/my-cart/';
            }
            else
            {
                $('#loader_'+_id).html('<i class="fa fa-mail-forward"></i>');
                $('#btnReOrder').html('<i class="fa fa-mail-forward"></i> Reorder');
                $.alert.open('error','Error','Error in placing your order.');
            }
            
        },
        error:function(data, statusText, xhr, wrapper){
            $('#loader_'+_id).html('<i class="fa fa-mail-forward"></i>');
            $('#btnReOrder').html('<i class="fa fa-mail-forward"></i> Reorder');
            isOrder = null;
        }
    });
}
</script>