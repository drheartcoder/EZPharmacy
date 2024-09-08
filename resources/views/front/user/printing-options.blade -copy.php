<style type="text/css">
    .error-box-shadow{box-shadow: 0px 0px 6px 0px #F00 !important;}
    .error-text-color{color: #F00 !important;}
    #divPrice {position: fixed;bottom: 90px;right: 20px; height: 40px; background-color: #302563; padding: 9px 10px; font-size: 15px; border-radius: 5px; color: #ffffff; z-index: 99;}
    .nav-pills>li._success>a, .nav-pills>li._success>a:focus, .nav-pills>li._success>a:hover {color: #fff; background-color: #7eb858;}
    .close-btn{position: absolute; right: 10px; top: 10px; opacity: 0.5;}
    .close-btn img{width: 10px;}
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
                    <div id="divPrice"><?php echo (preg_replace('#<[^>]+>#',' ',translation('total_price')));?><small>(SAR)</small> 0.00</div>
                    <div class="row">

                        <div class="col-sm-12 col-md-12 col-lg-12">
                           <div class="email-title clsTotalPages" data-num-page="{{$_numOfPages}}" data-file-id="{{$_fileId}}"><?php echo (preg_replace('#<[^>]+>#',' ',translation('document_type')));?></div>
                            <div class="payment-method-redio doc-img">
                                <div class="row">
                                    @if(count($resDocumentType))
                                        @foreach($resDocumentType as $row)
                                            <div class="col-sm-12 col-md-6 col-lg-6">
                                                <div class="radio-btn mr-tp">
                                                    <div class="paymt-radio clsDocumentType">
                                                        <!-- <input type="radio" id="option-one" name="selector"> -->
                                                        <input style="display: none;" type="radio" data-document_id="{{$row->primaryKey}}" id="option-one-{{$row->primaryKey}}" name="rdbDocumentType" value="{{$row->primaryKey}}">
                                                        <?php
                                                            $filePath = url('').'/front-assets/images/net-banking.png';
                                                            if(!empty($row->documentImg))
                                                            {
                                                                if(file_exists('uploads/document_type/'.$row->documentImg)){
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
                                    @else
                                      <label><?php echo (preg_replace('#<[^>]+>#',' ',translation('sorry_no_document_type_available')));?></label>
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

                        <p><input type="hidden" name="txtPaperCost" value="0"></p>
                        <p><input type="hidden" name="txtPrintingCost" value="0"></p>
                        <p><input type="hidden" name="txtBindingCost" value="0"></p>
                        <p><input type="hidden" name="txtFoldingCost" value="0"></p>
                        <p><input type="hidden" name="txtFinalPrice" value="0"></p>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="ajaxLoader"></div>