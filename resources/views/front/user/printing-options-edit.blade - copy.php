<style type="text/css">
    .error-box-shadow{box-shadow: 0px 0px 6px 0px #F00 !important;}
    .error-text-color{color: #F00 !important;}
    #divPrice {position: fixed;bottom: 90px;right: 20px; height: 40px; background-color: #302563; padding: 9px 10px; font-size: 15px; border-radius: 5px; color: #ffffff; z-index: 99;}
    .nav-pills>li._success>a, .nav-pills>li._success>a:focus, .nav-pills>li._success>a:hover {
    color: #fff;
    background-color: #7eb858;
    }
    .ajaxLoader{
        display:    none;
        position:   fixed;
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
            <div>
                @include('front.user.left-navigation')
            </div>
            <div class="col-sm-8 col-md-9 col-lg-9">
                <div class="row form-group">
                    <div class="col-xs-12">
                        <ul class="nav nav-pills nav-justified thumbnail setup-panel">
                            <li class="_success"><a href="javascript:void(0);">
                                <h4 class="list-group-item-heading"><?php echo (preg_replace('#<[^>]+>#',' ',translation('step_1')));?></h4>
                                <p class="list-group-item-text"><?php echo (preg_replace('#<[^>]+>#',' ',translation('upload_file')));?></p>
                            </a></li>
                            <li class="active"><a href="javascript:void(0);">
                                <h4 class="list-group-item-heading"><?php echo (preg_replace('#<[^>]+>#',' ',translation('step_2')));?></h4>
                                <p class="list-group-item-text"><?php echo (preg_replace('#<[^>]+>#',' ',translation('document')));?> &amp; <?php echo (preg_replace('#<[^>]+>#',' ',translation('its_attributes')));?></p>
                            </a></li>
                            <li class="disabled"><a href="javascript:void(0);">
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
                <div class="full-white-box">
                    <div id="divPrice"><?php echo (preg_replace('#<[^>]+>#',' ',translation('total_price')));?><small>(SAR)</small>0.00 </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                           <div class="email-title clsTotalPages" data-num-page="{{$_numOfPages}}" data-file-id="{{$_fileId}}"><?php echo (preg_replace('#<[^>]+>#',' ',translation('document_type')));?></div>
                            <div class="payment-method-redio">
                                <div class="row">
                                    @if(count($resDocumentType))
                                        @foreach($resDocumentType as $row)

                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="radio-btn mr-tp clsDocumentType">
                                                <div class="paymt-radio" <?php echo $orderDetails->document_type == $row->primaryKey?'style="opacity:5"':'style="opacity:.5"';?>>
                                                    <!-- <input type="radio" id="option-one" name="selector"> -->
                                                    <input type="radio" <?php echo $orderDetails->document_type == $row->primaryKey?'checked="checked"':'';?> data-document_id="{{$row->primaryKey}}" id="option-one-{{$row->primaryKey}}" name="rdbDocumentType" value="{{$row->primaryKey}}">
                                                    <?php 
                                                                 

                                                        $filePath = url('').'/front-assets/images/net-banking.png';
                                                        if(!empty($row->documentImg))
                                                        {
                                                            if(file_exists('uploads/document_type/'.$row->documentImg))
                                                            {
                                                                $filePath = url('').'/uploads/document_type/thumb_150X145_'.$row->documentImg;
                                                            }
                                                        }
                                                    ?>
                                                    <label for="option-one-{{$row->primaryKey}}">

                                                        <span class="img-label-block"><img src="{{$filePath}}" alt="{{$row->documentImg}}"> </span>
                                                        <span class="label-conent-block">
                                                            <span class="radio-head-block">
                                                            
                                                                {{$row->documentType}}
                                                            </span>
                                                            <span class="radio-content-block">
                                                                <?php if(strlen($row->documentDesc) <= 200) { echo $row->documentDesc; } else { echo substr($row->documentDesc, 0, 100).'.....'; } ?>
                                                            </span>
                                                        </span>
                                                    </label>
                                                    <div class="check"></div>
                                                </div>
                                            </div>
                                        </div>

                                        @endforeach
                                    @endif
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-12" id="loadingAttributes" style="display: none;">
                            <div class="mrg-tpspay" style="text-align: center;">
                                <img src="{{url('').'/front-assets/images/loading.gif'}}">
                            </div>
                            <div class="clearfix"></div>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div id="documentPaperOptions"></div>
                            <div id="documentColorOptions"></div>
                            <div id="documentSideOptions"></div>
                            <div id="documentBindingOptions"></div>
                            <div id="documentFoldingOptions"></div>

                            <div class="col-sm-12 col-md-12 col-lg-12" id="showPrice"></div>
                            <div class="col-sm-12 col-md-12 col-lg-12" id="nextButton"></div>
                        </div>
                        <p><input type="hidden" name="txtPaperCost" value="{{$orderDetails->paper_price}}"></p>
                        <p><input type="hidden" name="txtPrintingCost" value="{{$orderDetails->printing_price}}"></p>
                        <p><input type="hidden" name="txtBindingCost" value="{{$orderDetails->binding_price}}"></p>
                        <p><input type="hidden" name="txtFoldingCost" value="{{$orderDetails->folding_price}}"></p>
                        <p><input type="hidden" name="txtFinalPrice" value="{{$orderDetails->total_amount}}"></p>
                        
                        <p><input type="hidden" name="_doc_type" value="{{$orderDetails->document_type}}"></p>
                        <p><input type="hidden" name="_paper_size" value="{{$orderDetails->paper_size}}"></p>
                        <p><input type="hidden" name="_paper_type" value="{{$orderDetails->paper_type}}"></p>
                        <p><input type="hidden" name="_paper_weight" value="{{$orderDetails->paper_weight}}"></p>
                        <p><input type="hidden" name="_color_opted" value="{{$orderDetails->color_opted}}"></p>
                        <p><input type="hidden" name="_side_opted" value="{{$orderDetails->side_opted}}"></p>
                        <p><input type="hidden" name="_binding_opted" value="{{$orderDetails->binding_opted}}"></p>
                        <p><input type="hidden" name="_folding_opted" value="{{$orderDetails->folding_opted}}"></p>
                        <p><input type="hidden" name="_cart_id" value="{{$orderDetails->id}}"></p>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="ajaxLoader"></div>