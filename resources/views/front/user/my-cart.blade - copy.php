<style type="text/css">
    .nav-pills>li._success>a, .nav-pills>li._success>a:focus, .nav-pills>li._success>a:hover {
    color: #fff;
    background-color: #7eb858;
    }
    .ajaxLoader {
        display:    none;
        position:   absolute;
        z-index:    1000;
        top:        0;
        left:       0;
        height:     100%;
        width:      100%;
        background: rgba( 255, 255, 255, .8 ) 
                    url('{{url('')}}/front-assets/images/trans-loader.gif') 
                    50% 50% 
                    no-repeat;
    }
</style>
@include('front.user._inner-breadcrumbs')
<div class="dash-main-block">
    <div class="container">
        <div class="row">
            <div>@include('front.user.left-navigation')</div>
            <div class="col-sm-8 col-md-9 col-lg-9">
                <div class="row form-group">
                    <div class="col-xs-12">
                        <ul class="nav nav-pills nav-justified thumbnail setup-panel">
                            <li class="_success"><a href="javascript:void(0);">
                                <h4 class="list-group-item-heading"><?php echo (preg_replace('#<[^>]+>#',' ',translation('step_1')));?></h4>
                                <p class="list-group-item-text"><?php echo (preg_replace('#<[^>]+>#',' ',translation('upload_file')));?></p>
                            </a></li>
                            <li class="_success"><a href="javascript:void(0);">
                                <h4 class="list-group-item-heading"><?php echo (preg_replace('#<[^>]+>#',' ',translation('step_2')));?></h4>
                                <p class="list-group-item-text"><?php echo  (preg_replace('#<[^>]+>#',' ',translation('document')));?> &amp; <?php echo (preg_replace('#<[^>]+>#',' ',translation('its_attributes')));?></p>
                            </a></li>
                            <li class="active"><a href="javascript:void(0);">
                                <h4 class="list-group-item-heading"><?php echo (preg_replace('#<[^>]+>#',' ',translation('step_3')));?></h4>
                                <p class="list-group-item-text"><?php echo (preg_replace('#<[^>]+>#',' ',translation('cart')));?></p>
                            </a></li>
                            
                            <li class="disabled"><a href="javascript:void(0);">
                                <h4 class="list-group-item-heading"><?php echo (preg_replace('#<[^>]+>#',' ',translation('step_4')));?></h4>
                                <p class="list-group-item-text"><?php echo (preg_replace('#<[^>]+>#',' ',translation('checkout')));?></p>
                            </a></li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="table-block-dash shopping-cart-block-main">
                            <div class="main-content-more-total">
                                <div class="ajaxLoader"></div>
                                <div class="table-responsive">
                                    <table class="table table-striped dashboard shoping-cart">
                                        <thead>
                                            <tr>
                                                <th><?php echo  (preg_replace('#<[^>]+>#',' ',translation('description')));?></th>
                                                <th style="text-align: center;"><?php echo (preg_replace('#<[^>]+>#',' ',translation('price')));?> (SAR)</th>
                                                <th style="text-align: center;"><?php echo (preg_replace('#<[^>]+>#',' ',translation('quantity')));?> </th>
                                                <th style="text-align: center;"><?php echo (preg_replace('#<[^>]+>#',' ',translation('total')));?>(SAR)</th>
                                                <th style="text-align: center"><?php echo (preg_replace('#<[^>]+>#',' ',translation('action')));?></th>
                                            </tr>
                                        </thead>
                                        <tbody id="cartItemsList">
                                            <tr>
                                                <td colspan="5" style="text-align: center;"><img src="{{url('').'/front-assets/images/cart-loader.gif'}}" style="width: 190px;"></td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                                <div class="add-more-btn-total-main" id="subtotal-block-txt"></div>
                            </div>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>