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
            <div class="col-xs-12 col-sm-8 col-md-9 col-lg-9">
                <div class="row form-group">
                    <div class="col-xs-12">
                        <ul class="nav nav-pills nav-justified thumbnail setup-panel">
                            <li class="_success"><a href="javascript:void(0);">
                                <h4 class="list-group-item-heading"><?php echo translation('step_1');?></h4>
                                <p class="list-group-item-text"><?php echo translation('upload_file');?></p>
                            </a></li>
                            <li class="active"><a href="javascript:void(0);">
                                <h4 class="list-group-item-heading"><?php echo translation('step_2');?></h4>
                                <p class="list-group-item-text"><?php echo translation('document');?> &amp; <?php echo translation('its_attributes');?></p>
                            </a></li>
                            <li class="disabled"><a href="javascript:void(0);">
                                <h4 class="list-group-item-heading"><?php echo translation('step_3');?></h4>
                                <p class="list-group-item-text"><?php echo translation('cart');?></p>
                            </a></li>
                            
                            <li class="disabled"><a href="javascript:void(0);">
                                <h4 class="list-group-item-heading"><?php echo translation('step_4');?></h4>
                                <p class="list-group-item-text"><?php echo translation('checkout');?></p>
                            </a></li>
                        </ul>
                    </div>
                </div>
                <div class="full-white-box">
                    <div id="divPrice"><?php echo translation('total_price');?> <small>(SAR)</small> 0.00</div>
                    <div class="row">

                        <div class="col-sm-12 col-md-12 col-lg-12">
                           <div class="email-title clsTotalPages" data-num-page="{{$_numOfPages}}" data-file-id="{{$_fileId}}"><?php echo translation('document_type');?></div>
                            <div class="payment-method-redio doc-img">
                                <a href="#documentPaperOptions" style="display: none;"><span style="display: none;">please do not remove</span></a>
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
                                                                    <?php echo $row->documentDesc; ?>
                                                                </span>
                                                            </span>
                                                        </label>
                                                        <div class="check"></div>
                                                    </div>
                                                </div>
                                            </div>

                                        @endforeach
                                    @else
                                      <label><?php echo translation('sorry_no_document_type_available');?></label>
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

<script type="text/javascript" src="https://tympanus.net/Tutorials/WebsiteScrolling/jquery.easing.1.3.js"></script>
<script type="text/javascript">
$(function(){
  $(document).on({
    ajaxStart: function() { $(".ajaxLoader").show();},
    ajaxStop: function() { $(".ajaxLoader").hide(); }    
  });
});
var please_select_document_type = "<?php echo translation('please_select_document_type');?>";
var please_wait_server_is_busy = "<?php echo translation('please_wait_server_is_busy');?>";
var redirecting_to_cart = "<?php echo translation('redirecting_to_cart');?>";
var adding_to_cart = "<?php echo translation('adding_to_cart');?>";
var you_can_not_proceed_this_document = "<?php echo translation('you_can_not_proceed_this_document');?>";
var warning = "<?php echo translation('warning');?>";
var paper_type = "<?php echo translation('paper_type');?>";
var paper_options = "<?php echo translation('paper_options');?>";
var paper_size = "<?php echo translation('paper_size');?>";
var paper_weight = "<?php echo translation('paper_weight');?>";
var paper_price = "<?php echo translation('paper_price');?>";
var select_size = "<?php echo translation('select_size');?>";
var select_type = "<?php echo translation('select_type');?>";
var select_weight = "<?php echo translation('select_weight');?>";
var binding_options = "<?php echo translation('binding_options');?>";
var add_to_cart = "<?php echo translation('add_to_cart');?>";
var color = "<?php echo translation('color');?>";
var side = "<?php echo translation('side');?>";
var total_price = "<?php echo translation('total_price');?>";
var folding_options = "<?php echo translation('folding_options');?>";
var total_price = "<?php echo translation('total_price');?>";
var save = "<?php echo translation('save');?>";
var edit = "<?php echo translation('edit');?>";

$('body').on('click','.clsDocumentType',function(){
    $('.clsDocumentType').css({'opacity':'.3'});
    $(this).css('opacity',5);
});

$('body').on('click','.clsFoldingOpts',function(){
    $('.cls-foldings').removeClass('error-box-shadow');
    $('.clsFoldingOpts').css({'opacity':'.3','box-shadow':'0px 0px 6px 0px #ccc'});
    $(this).css({'opacity':5,'box-shadow':'0px 0px 6px 0px #58BA47'});
});

$('body').on('click','.clsBindingOpts',function(){
    $('.cls-bindings').removeClass('error-box-shadow');
    $('.clsBindingOpts').css({'opacity':'.3','box-shadow':'0px 0px 6px 0px #ccc'});
    $(this).css({'opacity':5,'box-shadow':'0px 0px 6px 0px #58BA47'});
});

$('body').on('click','input[name="rdbDocumentType"]',function(){
    var docId = $('input[name="rdbDocumentType"]:checked').val();
    setAttributes(docId);
});
var isRunning = null;

function setAttributes(id)
{
    /*$('#documentBindingOptions').ScrollTo({
        duration: 2000,
        durationMode: 'all'
    });*/
    isRunning = $.ajax({
        headers:{'X-CSRF-Token': $('input[name="_token"]').val()},
        url : SITE_URL+'/user/document-attributes/',
        type : "POST",
        dataType: 'JSON',
        data : {id: id},
        beforeSend:function(data, statusText, xhr, wrapper){
            if(isRunning != null){
                return false;
            }
            $('#loadingAttributes').show();
            $("#documentPaperOptions,#documentColorOptions,#documentSideOptions,#documentBindingOptions,#documentFoldingOptions,#nextButton,#showPrice").html('');
        },
        success:function(data, statusText, xhr, wrapper){
            isRunning = null;
            $('#loadingAttributes').hide();
            var paperOptions = [''];
            var colorOptions = [''];
            var sideOptions = [''];
            var bindingOptions = [''];
            var foldingOptions = [''];
            if(data.status == "done")
            {   
                var divPosition = $('#documentPaperOptions').offset();
                $('html, body').animate({
                        scrollTop: divPosition.top
                },1500, "easeInOutExpo");
                if(data.htmlSize.length > 0 || data.htmlType.length > 0 || data.htmlGsm.length > 0){
                    paperOptions.push('<div class="col-sm-12 col-md-12 col-lg-12"><div class="email-title">'+paper_options+'</div><div class="payment-method-redio">');
                }
                if(data.htmlSize.length > 0)
                {
                    var _output = data.htmlSize;
                    var _optionsList = '';
                    $.each(_output, function(i, val)
                    {
                        var obj = _output[i];
                        _optionsList += '<option value="'+obj.id+'">'+obj.name+' ('+obj.description+')</option>';
                    });
                    paperOptions.push('<div class="col-sm-6 col-md-6 col-lg-6"><div class="email-box-2"><div class="email-title cls-paper-size">'+paper_size+'</div><div class="select-bock-container"><select id="paperSize" name="paperSize" data-select-opt="size" class="clsPaperOptions"><option value="" disabled="disabled" selected="selected">'+select_size+'</option>'+_optionsList+'</select></div></div></div>');
                }

                if(data.htmlType.length > 0)
                {
                    var _output = data.htmlType;
                    var _optionsList = '';
                    $.each(_output, function(i, val)
                    {
                        var obj = _output[i];
                        _optionsList += '<option value="'+obj.id+'">'+obj.name+' ('+obj.description+')</option>';
                    });
                    paperOptions.push('<div class="col-sm-6 col-md-6 col-lg-6"><div class="email-box-2"><div class="email-title cls-paper-type">'+paper_type+'</div><div class="select-bock-container"><select id="paperType" name="paperType" data-select-opt="type" class="clsPaperOptions"><option value="" disabled="disabled" selected="selected">'+select_type+'</option>'+_optionsList+'</select></div></div></div>');
                }

                if(data.htmlGsm.length > 0)
                {
                    var _output = data.htmlGsm;
                    var _optionsList = '';
                    $.each(_output, function(i, val)
                    {
                        var obj = _output[i];
                        _optionsList += '<option value="'+obj.id+'">'+obj.name+' GSM ('+obj.description+')</option>';
                    });
                    paperOptions.push('<div class="col-sm-6 col-md-6 col-lg-6"><div class="email-box-2"><div class="email-title cls-paper-weight">'+paper_weight+'</div><div class="select-bock-container"><select id="paperWeight" name="paperWeight" data-select-opt="weight" class="clsPaperOptions"><option value="" disabled="disabled" selected="selected">'+select_weight+'</option>'+_optionsList+'</select></div></div></div>');
                }
                if(data.htmlSize.length > 0 || data.htmlType.length > 0 || data.htmlGsm.length > 0){
                    paperOptions.push('<div class="clearfix"></div></div></div>');
                }

                if(data.htmlColor.length > 0)
                {
                    colorOptions.push('<div class="col-sm-12 col-md-12 col-lg-12"><div class="email-title">'+color+'</div><div class="payment-method-redio color-radio-btns"><div class="mrg-tpspay">');
                    var _output = data.htmlColor;
                    var _radioList = '';
                    $.each(_output, function(i, val)
                    {
                        var obj = _output[i];
                        _radioList += '<div class="radio-btn"><div class="paymt-radio box-color-radio"><input type="radio" id="option-color-'+obj.id+'" value="'+obj.id+'" name="rdbColors"><label for="option-color-'+obj.id+'" class="cls-color"> '+obj.name+'</label><div class="check"></div></div></div>';
                    });
                    colorOptions.push(_radioList+'</div><div class="clearfix"></div></div></div>');
                }

                if(data.htmlSides.length > 0)
                {
                    sideOptions.push('<div class="col-sm-12 col-md-12 col-lg-12"><div class="email-title">'+side+'</div><div class="payment-method-redio color-radio-btns"><div class="mrg-tpspay">');
                    var _output = data.htmlSides;
                    var _radioList = '';
                    $.each(_output, function(i, val)
                    {
                        var obj = _output[i];
                        _radioList += '<div class="radio-btn"><div class="paymt-radio box-color-radio"><input type="radio" id="option-side-'+obj.id+'" value="'+obj.id+'" data-text="'+obj.name+'" name="rdbSides"><label for="option-side-'+obj.id+'" class="cls-sides"> '+obj.name+'</label><div class="check"></div></div></div>';
                    });
                    sideOptions.push(_radioList+'</div><div class="clearfix"></div></div></div>');
                }

                if(data.htmlBindings.length > 0)
                {
                    bindingOptions.push('<div class="col-sm-12 col-md-12 col-lg-12"><div class="email-title">'+binding_options+'</div><div class="payment-method-redio"><div class="row">');
                    var _output = data.htmlBindings;
                    var _optionsList = '';
                    $.each(_output, function(i, val)
                    {
                        var obj = _output[i];
                        _optionsList += '<div class="col-sm-12 col-md-6 col-lg-6"><div class="radio-btn mr-tp"><div class="paymt-radio clsBindingOpts cls-bindings"><input type="radio"type="radio" data-binding_id="'+obj.id+'" id="option-binding-'+obj.id+'" name="rdbBindingOptions" value="'+obj.id+'"><label for="option-binding-'+obj.id+'"><span class="img-label-block"><img src="'+obj.image+'" alt=""> </span><span class="label-conent-block"><span class="radio-head-block">'+obj.name+'</span><span class="radio-content-block">'+obj.description+'</span></span></label><div class="check"></div></div></div></div>';
                    });
                    bindingOptions.push(_optionsList+'</div><div class="clearfix"></div></div></div>');
                }

                if(data.htmlFoldings.length > 0)
                {
                    foldingOptions.push('<div class="col-sm-12 col-md-12 col-lg-12"><div class="email-title">'+folding_options+'</div><div class="payment-method-redio"><div class="row">');
                    var _output = data.htmlFoldings;
                    var _optionsList = '';
                    $.each(_output, function(i, val)
                    {
                        var obj = _output[i];

                        _optionsList += '<div class="col-sm-12 col-md-6 col-lg-6"><div class="radio-btn mr-tp"><div class="paymt-radio clsFoldingOpts cls-foldings"><input type="radio" data-folding_id="'+obj.id+'" id="option-folding-'+obj.id+'" name="rdbFoldingOptions" value="'+obj.id+'"><label for="option-folding-'+obj.id+'"><span class="img-label-block"><img src="'+obj.image+'" alt=""> </span><span class="label-conent-block"><span class="radio-head-block">'+obj.name+'</span><span class="radio-content-block">'+obj.description+'</span></span></label><div class="check"></div></div></div></div>';
                    });
                    foldingOptions.push(_optionsList+'</div><div class="clearfix"></div></div></div>');
                }
                $('#showPrice').html('<div class="btn-block-print account margin" style="margin: 6px 0 0px;"><a style="background: #d94890;background: none;width: auto;color: #000;border:0px solid #FFF;float:right;font-size: 17px;" class="userAmount" href="javascript:void(0);">'+total_price+'<small>(SAR)</small> 0.00</a></div>');

                $('#nextButton').html('<div class="btn-block-print account margin"><a class="print-deliver-btn account btnPrintNext" href="javascript:void(0);">'+add_to_cart+'</a></div>');
            }
            else{
                $('#nextButton,#showPrice').html('');
                $('#loadingAttributes').hide();
            }
            $("#documentPaperOptions").html(paperOptions.join(''));
            $("#documentColorOptions").html(colorOptions.join(''));
            $("#documentSideOptions").html(sideOptions.join(''));
            $("#documentBindingOptions").html(bindingOptions.join(''));
            $("#documentFoldingOptions").html(foldingOptions.join(''));
        },
        error:function(data, statusText, xhr, wrapper){
          isRunning = null;  
        }
    });
}

$('body').on('click','.btnPrintNext',function(){
    var lenPaperOptions = $('div#documentPaperOptions select').length;
    var lenColorOptions = $('div#documentColorOptions input[name="rdbColors"]').length;
    var lenSideOptions  = $('div#documentSideOptions input[name="rdbSides"]').length;
    var lenBindingOptions = $('div#documentBindingOptions .clsBindingOpts').length;
    var lenFoldingOptions = $('div#documentFoldingOptions .clsFoldingOpts').length;

    flag = 0;
    var paperSize,paperType,paperWeight = 0;
    var optedColor, optedSide, bindingVal, foldingVal = '';

    var docType   = $('input[name="rdbDocumentType"]:checked').val();
    if(docType == ""  || docType == undefined){
        $.alert.open('warning',warning,please_select_document_type);
        flag = 1;
    }
    
    if(lenPaperOptions > 0)
    {
        paperSize   = $('select[name="paperSize"] option:selected').val();
        paperType   = $('select[name="paperType"] option:selected').val();
        paperWeight = $('select[name="paperWeight"] option:selected').val();
        var paperCost   = $('select[name="txtPaperCost"]').val();
        var printCost   = $('input[name="txtPrintingCost"]').val();
        if(paperSize == ""){
            $('.cls-paper-size').addClass('error-text-color');
            $('select[name="paperSize"]').focus();
            flag = 1;
        }
        if(paperType == ""){
            $('.cls-paper-type').addClass('error-text-color');
            $('select[name="paperType"]').focus();
            flag = 1;
        }
        if(paperWeight == ""){
            $('.cls-paper-weight').addClass('error-text-color');
            $('select[name="paperWeight"]').focus();
            flag = 1;
        }
        if(paperCost == 0){
            flag = 1;
        }
        if(printCost == 0){
            flag = 1;
        }
    }

    if(lenColorOptions > 0)
    {
        optedColor  = $('input[name="rdbColors"]:checked').val();
        var printCost   = $('input[name="txtPrintingCost"]').val();
        if(optedColor == "" || optedColor == undefined){
            $('.cls-color').addClass('error-text-color');
            $('input[name="rdbColors"]').focus();
            flag = 1;
        }
        if(printCost == 0)
        {
            flag = 1;
        }
    }

    if(lenSideOptions > 0)
    {
        optedSide   = $('input[name="rdbSides"]:checked').val();
        if(optedSide == ""  || optedSide == undefined){
            $('.cls-sides').addClass('error-text-color');
            $('input[name="rdbSides"]').focus();
            flag = 1;
        }
    }
    
    if(lenBindingOptions > 0)
    {
        bindingVal   = $('input[name="rdbBindingOptions"]:checked').val();
        var bindingCost   = $('input[name="txtBindingCost"]').val();
        if(bindingVal == ""  || bindingVal == undefined){
            $('input[name="rdbBindingOptions"]').focus();
            $('.cls-bindings').addClass('error-box-shadow');
            flag = 1;
        }
        if(bindingCost == 0){
            flag = 1;
        }
    }
    
    if(lenFoldingOptions > 0)
    {
        foldingVal   = $('input[name="rdbFoldingOptions"]:checked').val();
        var foldingCost  = $('input[name="txtFoldingCost"]').val();
        if(foldingVal == ""  || foldingVal == undefined){
            $('.cls-foldings').addClass('error-box-shadow');
            $('input[name="rdbFoldingOptions"]').focus();
            flag = 1;
        }
        if(foldingCost == 0){
            flag = 1;
        }
        
    }
    var isNext = null;
    if(flag == 0)
    {
        calculatePrice();
        var fileId    = $('.clsTotalPages').data('file-id');
        var numPages    = $('.clsTotalPages').data('num-page');
        var paperCost   = $('input[name="txtPaperCost"]').val();
        var printCost   = $('input[name="txtPrintingCost"]').val();
        var bindingCost = $('input[name="txtBindingCost"]').val();
        var foldingCost = $('input[name="txtFoldingCost"]').val();
        var finalPrice  = $('input[name="txtFinalPrice"]').val();
        var paramName = [];
        var allData = {
                'pdf_id'     : fileId,
                'num_of_pages'   : numPages,
                'document_type'  : docType,
                'paper_size'  : paperSize,
                'paper_type'  : paperType,
                'paper_weight': paperWeight,
                'color_opted' : optedColor,
                'side_opted'  : optedSide,
                'binding_opted'   : bindingVal,
                'folding_opted'   : foldingVal,
                'paper_price'     : paperCost,
                'printing_price'  : printCost,
                'binding_price'   : bindingCost,
                'folding_price'   : foldingCost,
                'total_amount'    : finalPrice
            };

        if(finalPrice > 0){
            paramName.push(allData);
            isNext = $.ajax({
                headers:{'X-CSRF-Token': $('input[name="_token"]').val()},
                url : SITE_URL+'/user/add-to-cart/',
                type : "POST",
                dataType: 'JSON',
                data : {paramName},
                beforeSend:function(data, statusText, xhr, wrapper){
                    if(isNext != null){
                        $.alert.open('warning',warning,please_wait_server_is_busy);
                        return false;
                    }
                    $('.btnPrintNext').css('width','168px').html('<i class="fa fa-spinner fa-spin fa-fw"></i><span> '+adding_to_cart+'</span>');
                },
                success:function(data, statusText, xhr, wrapper){
                    isNext = null;
                    if(data.status == 'done'){
                        $('.btnPrintNext').css('width','200px').html('<i class="fa fa-spinner fa-spin fa-fw"></i><span> '+redirecting_to_cart+'</span>');
                        location.href = SITE_URL+'/user/my-cart/';
                    }
                    else{
                        $('.btnPrintNext').css('width','142px').html(add_to_cart);
                    }
                    $('#myCartCount').html(data.cart_Count);
                },
                error:function(data, statusText, xhr, wrapper){
                    $('.btnPrintNext').css('width','142px').html(add_to_cart);
                    isNext = null;  
                }
            });
        }
        else{
            $.alert.open('warning',warning,you_can_not_proceed_this_document);
            return false;
        }
    }
});

$('body').on('click','input[name="rdbColors"]',function(){
    var _value = $('input[name="rdbColors"]:checked').val();
    if(_value != ''){
        var paperSize   = $('select[name="paperSize"] option:selected').val();
        $('.cls-color').removeClass('error-text-color');
        getPrintingPrice(paperSize,_value);
    }
});

$('body').on('click','input[name="rdbSides"]',function(){
    var _value = $('input[name="rdbSides"]:checked').val();
    if(_value != ''){
        $('.cls-sides').removeClass('error-text-color');
        calculatePrice();
    }
});

$('body').on('change','.clsPaperOptions',function(){
    var optType = $(this).data('select-opt');
    var _value = $(this).val();
    switch(optType){
        case 'size':
            if(_value == ''){
                $('.cls-paper-size').addClass('error-text-color');    
            }
            else{
                $('.cls-paper-size').removeClass('error-text-color');
                var paperType   = $('select[name="paperType"] option:selected').val();
                var paperWeight = $('select[name="paperWeight"] option:selected').val();
                getPaperPrice(_value,paperType,paperWeight);
                var _color = $('input[name="rdbColors"]:checked').val();
                getPrintingPrice(_value,_color);
            }
        break;
        case 'type':
            if(_value == ''){
                $('.cls-paper-type').addClass('error-text-color');
            }
            else{
                $('.cls-paper-type').removeClass('error-text-color');
                var paperSize   = $('select[name="paperSize"] option:selected').val();
                var paperWeight = $('select[name="paperWeight"] option:selected').val();
                getPaperPrice(paperSize,_value,paperWeight);
            }
        break;
        case 'weight':
            if(_value == ''){
                $('.cls-paper-weight').addClass('error-text-color');
            }
            else{
                $('.cls-paper-weight').removeClass('error-text-color');
                var paperSize   = $('select[name="paperSize"] option:selected').val();
                var paperType   = $('select[name="paperType"] option:selected').val();
                getPaperPrice(paperSize,paperType,_value);
            }
        break;
    }
});

isRunningPrice = null;
function getPaperPrice(_size,_type,_weight)
{
    $('input[name="txtPaperCost"]').val(0);
    if(_size != '' && _type != '' && _weight != '')
    {
        isRunningPrice = $.ajax({
            headers:{'X-CSRF-Token': $('input[name="_token"]').val()},
            url : SITE_URL+'/user/get-paper-price/',
            type : "POST",
            dataType: 'JSON',
            data : {_size:_size,_type:_type,_weight:_weight},
            beforeSend:function(data, statusText, xhr, wrapper){
                if(isRunningPrice != null){
                    isRunningPrice.abort();
                }
                $('input[name="txtPaperCost"]').val(0);

                
            },
            success:function(data, statusText, xhr, wrapper){
                isRunningPrice = null;
                if(data.status == 'done'){
                }
                $('input[name="txtPaperCost"]').val(data.paperPrice);
                if(data.paperPrice <= 0)
                {
                    $.alert.open('warning','Warning','Price not available for selected option.');
                    $('select[name="paperSize"]')[0].selectedIndex = 0;
                    $('select[name="paperType"]')[0].selectedIndex = 0;
                    $('select[name="paperWeight"]')[0].selectedIndex = 0;
                }
                calculatePrice();
            },
            error:function(data, statusText, xhr, wrapper){
              isRunningPrice = null;  
            }
        });
    }
}

var isPrintPrice = null;
function getPrintingPrice(_size,_color)
{
    $('input[name="txtPrintingCost"]').val(0);
    if(_size != '' && _color != '' && _color != undefined)
    {
        isPrintPrice = $.ajax({
            headers:{'X-CSRF-Token': $('input[name="_token"]').val()},
            url : SITE_URL+'/user/get-printing-price/',
            type : "POST",
            dataType: 'JSON',
            data : {_size:_size,_color:_color},
            beforeSend:function(data, statusText, xhr, wrapper){
                if(isPrintPrice != null){
                    isPrintPrice.abort();
                }
                $('input[name="txtPrintingCost"]').val(0);
            },
            success:function(data, statusText, xhr, wrapper){
                isPrintPrice = null;
                if(data.status == 'done'){
                }
                $('input[name="txtPrintingCost"]').val(data.printingPrice);
                calculatePrice();
            },
            error:function(data, statusText, xhr, wrapper){
              isPrintPrice = null;  
            }
        });
    }
}

$('body').on('click','input[name="rdbBindingOptions"]',function(){
    var _id = $('input[name="rdbBindingOptions"]:checked').val();
    getBindingPrice(_id);
});
var isBindingPrice = null;
function getBindingPrice(_id)
{
    $('input[name="txtBindingCost"]').val(0);
    if(_id != '' && _id != undefined)
    {
        isBindingPrice = $.ajax({
            headers:{'X-CSRF-Token': $('input[name="_token"]').val()},
            url : SITE_URL+'/user/get-binding-price/',
            type : "POST",
            dataType: 'JSON',
            data : {_id:_id},
            beforeSend:function(data, statusText, xhr, wrapper)
            {
                if(isBindingPrice != null){
                    isBindingPrice.abort();
                }
                $('input[name="txtBindingCost"]').val(0);
            },
            success:function(data, statusText, xhr, wrapper)
            {
                isBindingPrice = null;
                if(data.status == "done"){
                }
                $('input[name="txtBindingCost"]').val(data.bindingPrice);
                if(data.bindingPrice <= 0){
                  $.alert.open('warning','Warning','Price for selected binding option is not available.');
                }
                calculatePrice();
            },
            error:function(data, statusText, xhr, wrapper)
            {
              isBindingPrice = null;  
            }
        });
    }
}

$('body').on('click','input[name="rdbFoldingOptions"]',function(){
    var _id = $('input[name="rdbFoldingOptions"]:checked').val();
    getFoldingPrice(_id);
});

var isFoldingPrice = null;
function getFoldingPrice(_id)
{
    $('input[name="txtFoldingCost"]').val(0);
    if(_id != '' && _id != undefined)
    {
        isFoldingPrice = $.ajax({
            headers:{'X-CSRF-Token': $('input[name="_token"]').val()},
            url : SITE_URL+'/user/get-folding-price/',
            type : "POST",
            dataType: 'JSON',
            data : {_id:_id},
            beforeSend:function(data, statusText, xhr, wrapper)
            {
                if(isFoldingPrice != null){
                    isFoldingPrice.abort();
                }
                $('input[name="txtFoldingCost"]').val(0);
            },
            success:function(data, statusText, xhr, wrapper)
            {
                isFoldingPrice = null;
                if(data.status == 'done'){
                }
                $('input[name="txtFoldingCost"]').val(data.foldingPrice);
                if(data.foldingPrice <= 0){
                    $.alert.open('warning','Warning','Price for selected folding option is not available.');
                }
                calculatePrice();
            },
            error:function(data, statusText, xhr, wrapper)
            {
              isFoldingPrice = null;  
            }
        });
    }
}

function calculatePrice()
{
    var numPages  = $('.clsTotalPages').data('num-page');
    var paperCost  = $('input[name="txtPaperCost"]').val();
    var printCost  = $('input[name="txtPrintingCost"]').val();
    var bindingCost  = $('input[name="txtBindingCost"]').val();
    var foldingCost  = $('input[name="txtFoldingCost"]').val();
    var paperSide    = $('input[name="rdbSides"]:checked').data('text');

    var _paperPrice = 0;
    var _printPrice = 0;
    var finalPrice = 0;

    if(numPages > 0 && paperCost > 0 && printCost > 0 && /*bindingCost > 0 && foldingCost > 0 &&*/ paperSide != '' && paperSide != undefined)

    {
        if(paperSide.trim() == "Double Sided or Two Sides")
        {
            /*_paperPrice = (parseFloat(numPages)/2) * parseFloat(paperCost);*/
            _paperPrice = parseFloat(numPages) * parseFloat(paperCost);
            _printPrice = parseFloat(numPages) * parseFloat(printCost);
            finalPrice  = parseFloat(_paperPrice) + (parseFloat(_printPrice)*2) + parseFloat(bindingCost) + parseFloat(foldingCost);
        }
        else{
            _paperPrice = parseFloat(numPages) * parseFloat(paperCost);
            _printPrice = parseFloat(numPages) * parseFloat(printCost);
            finalPrice = parseFloat(_paperPrice) + parseFloat(_printPrice) + parseFloat(bindingCost) + parseFloat(foldingCost);
        }
    }
    $('input[name="txtFinalPrice"]').val(parseFloat(finalPrice).toFixed(2));
    $('.userAmount,#divPrice').html('<?php echo translation('total_price');?><small>(SAR)</small> '+parseFloat(finalPrice).toFixed(2));
}
</script>