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
                       @include('front._operation_status')
                        <div class="table-block-dash my-order-block-table">
                            <div class="left-bar-head get-uploading">
                                <?php echo (preg_replace('#<[^>]+>#',' ',translation('my_wallet')));?>
                            </div>                            
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th><?php echo (preg_replace('#<[^>]+>#',' ',translation('transaction_id')));?></th>
                                            <th><?php echo (preg_replace('#<[^>]+>#',' ',translation('amount')));?>({{currency_code()}})</th>
                                            <th><?php echo (preg_replace('#<[^>]+>#',' ',translation('processing_fee')));?>({{currency_code()}})</th>
                                            <th><?php echo (preg_replace('#<[^>]+>#',' ',translation('total_paid')));?>({{currency_code()}})</th>
                                            <th><?php echo (preg_replace('#<[^>]+>#',' ',translation('date')));?></th>
                                            <th><?php echo (preg_replace('#<[^>]+>#',' ',translation('ptimep')));?></th>
                                            <th><?php echo (preg_replace('#<[^>]+>#',' ',translation('status')));?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($walletData))
                                        @foreach($walletData as $row)
                                            <tr>
                                                <td style="font-family: 'arial';">{{$row->txn_id}}</td>
                                                <td style="font-family: 'arial';">{{number_format($row->amount,2,'.','')}}</td>
                                                <td style="font-family: 'arial';">{{number_format($row->processing_charge,2,'.','')}}</td>
                                                <td style="font-family: 'arial';">{{number_format($row->txn_amount,2,'.','')}}</td>
                                                <td style="font-family: 'arial';">{{date('d-m-Y',strtotime($row->txn_date))}}</td>
                                                <td style="font-family: 'arial';">{{date('H:i:s',strtotime($row->txn_date))}}</td>
                                                <td style="font-family: 'arial';">{{$row->txn_status}}</td>
                                            </tr>
                                        @endforeach
                                            <tr><td colspan="4"></td><td colspan="2" style="text-align: right;font-weight: bold;"><?php echo (preg_replace('#<[^>]+>#',' ',translation('amount_in_wallet')));?><small style="font-weight: 100">({{currency_code()}})</small></td><td style="text-align: right;font-weight: bold;">{{number_format($walletAmount,2,'.','')}}</td></tr>
                                            <tr><td colspan="4"></td><td colspan="2" style="text-align: right;font-weight: bold;"><?php echo (preg_replace('#<[^>]+>#',' ',translation('amount_remain_in_wallet')));?><small style="font-weight: 100">({{currency_code()}})</small></td><td style="text-align: right;font-weight: bold;">{{number_format($remainWallet,2,'.','')}}</td></tr>
                                    @else

                                        <tr><td colspan="6" style="color: #F00;font-style: italic;font-weight: lighter;font-size: 20px;text-align: center;"><?php echo (preg_replace('#<[^>]+>#',' ',translation('transactions_not_found')));?></td></tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                            @if(count($walletData))
                             <?php echo $pageLinks; ?>
                            @endif 
                        </div>

                        <div class="table-block-dash my-order-block-table">
                            <div class="left-bar-head get-uploading">
                                <?php echo (preg_replace('#<[^>]+>#',' ',translation('recharge_wallet')));?>
                            </div>  
                            <div class="table-responsive">                          
                                <form class="login-form-block" id="recharge-wallet" name="recharge-wallet">
                                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                        <div class="email-box-2">
                                            <div class="email-title"><?php echo (preg_replace('#<[^>]+>#',' ',translation('amount')));?><small>({{currency_code()}})</small></div>
                                            <div class="select-bock-container">
                                                <select id="walletAmount" name="walletAmount">
                                                    <option value=""><?php echo (preg_replace('#<[^>]+>#',' ',translation('select')));?></option>
                                                    <?php
                                                        for($i = 10; $i <= 100; $i+=10)
                                                        {
                                                            echo '<option value="'.$i.'">'.$i.'</option>';
                                                        }
                                                    ?>
                                                    <option value="other"><?php echo (preg_replace('#<[^>]+>#',' ',translation('other')));?></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="clear: both;"></div>
                                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 clsOtherPrice" style="display: none;">
                                        <div class="email-box-2">
                                            <div class="email-title"><?php echo (preg_replace('#<[^>]+>#',' ',translation('other')));?></div>
                                            <div class="input-block">
                                                <input type="text" name="txtAmount" id="txtAmount" placeholder="<?php echo (preg_replace('#<[^>]+>#',' ',translation('enter_your_amount')));?>" />
                                            </div>
                                        </div>
                                    </div>
                                    <div style="clear: both;"></div>
                                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                        <div class="btn-block-print account margin">
                                            <button type="button" class="print-deliver-btn" id="btnRecharge" name="btnRecharge"><?php echo (preg_replace('#<[^>]+>#',' ',translation('recharge')));?></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>