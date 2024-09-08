@extends('admin.layout.master')
@section('main_content')
<link rel="stylesheet" type="text/css" href="{{ url('/css/admin/') }}/select-multiple.css">
<div id="breadcrumbs">
    <ul class="breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="{{ url($admin_panel_slug.'/dashboard') }}">Dashboard</a>
            <span class="divider"><i class="fa fa-angle-right"></i></span>
        </li>
        <li class="active">Advance Table</li>
    </ul>
</div>
<!-- END Breadcrumb -->

<!-- BEGIN Main Content -->
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-title">
                <h3><i class="fa fa-table"></i> Advance Table</h3>
            </div>
            <div class="box-content">
                @include('admin.layout._operation_status')
                <form id="frmDocumentAttributes" name="frmDocumentAttributes" method="post" action="" class="form-horizontal">
                	{{csrf_field()}}
				    <div class="row">
				    <!--******************************1******************************-->
				    	<div class="col-md-12 ">
					        <div class="col-md-5 ">
					            <div class="form-group">
					                <label for="documentType" class="col-xs-3 col-lg-4 control-label">Document Type</label>
					                <div class="col-sm-9 col-lg-6 controls">
					                    <select class="form-control" id="documentType" name="documentType" >
							                <option value="">Document Type</option>
							                @if(count($resDocumentType))
							                	@foreach($resDocumentType as $row)
							                		<option value="{{$row->primaryKey}}">{{$row->documentType}}</option>
							                	@endforeach
							                @endif
						            	</select>
					                </div>
					            </div>
					        </div>
				        </div>
				        <div style="clear: both;"></div>
				    <!--****************************1********************************-->

				    <!--*****************************2*******************************-->
				    <div class="col-md-12">
				        <div class="col-md-5 ">
				            <div class="form-group">
				                <label for="paperSize_1" class="col-xs-3 col-lg-4 control-label">Paper Size</label>
				                <div class="col-sm-9 col-lg-6 controls">
				                    <select id="paperSize_1" name="paperSize[]" class="form-control removeErrorSize">
					                	<option value="">Paper Size</option>
						                @if(count($resPaperSize))
						                	@foreach($resPaperSize as $row)
						                		<option value="{{$row->primaryKey}}">{{$row->paperSize}}</option>
						                	@endforeach
						                @endif
						            </select>
				                </div>
				            </div>
				        </div>
				        <div class="col-md-5 ">
				            <div class="form-group">
				                <label for="paperGsm_1" class="col-xs-3 col-lg-4 control-label">Paper Weight <small>(GSM)</small></label>
				                <div class="col-sm-9 col-lg-6 controls">
				                    <select class="form-control removeErrorWeight clsMultiple" id="paperGsm_1" name="paperGsm[]" multiple="multiple">
						                @if(count($resPaperGsm))
						                	@foreach($resPaperGsm as $row)
						                		<option value="{{$row->primaryKey}}">{{$row->paperGsm}} GSM</option>
						                	@endforeach
						                @endif
						            </select>
				                </div>
				            </div>
				        </div>
				        <div class="col-md-2 ">
				        	<div class="form-group">
				        		<a href="javascript:void(0);" id="addMore"><i class="fa fa-plus"></i> Add More</a>
				        	</div>
				        </div>
				    </div>
				    <!--*****************************2*******************************-->
				    <!--*****************************3*******************************-->
				    <div id="paperSizeWeight"></div>
				    <!--*****************************3*******************************-->


				    <!--****************************4********************************-->
				    	<div class="col-md-12 ">
					        <div class="col-md-5 ">
					            <div class="form-group">
					                <label for="paperType" class="col-xs-3 col-lg-4 control-label">Paper Type</label>
					                <div class="col-sm-9 col-lg-6 controls">
					                    <select class="form-control" id="paperType" name="paperType[]" multiple="multiple">
							                @if(count($resPaperType))
							                	@foreach($resPaperType as $row)
							                		<option value="{{$row->primaryKey}}">{{$row->paperType}}</option>
							                	@endforeach
							                @endif
						            	</select>
					                </div>
					            </div>
					        </div>

					        <div class="col-md-5 ">
					            <div class="form-group">
					                <label for="paperColor" class="col-xs-3 col-lg-4 control-label">Paper Color</label>
					                <div class="col-sm-9 col-lg-6 controls">
					                    <select class="form-control" id="paperColor" name="paperColor[]" multiple="multiple">
							                @if(count($resPaperColor))
							                	@foreach($resPaperColor as $row)
							                		<option value="{{$row->primaryKey}}">{{$row->paperColor}}</option>
							                	@endforeach
							                @endif
						            	</select>
					                </div>
					            </div>
					        </div>
				        </div>
				        <div style="clear: both;"></div>
				    <!--****************************4********************************-->
				    <!--****************************5********************************-->
				    	<div class="col-md-12 ">
					        
				        </div>
				        <div style="clear: both;"></div>
				    <!--****************************5********************************-->
				    <!--****************************6********************************-->
				    	<div class="col-md-12 ">
					        <div class="col-md-5 ">
					            <div class="form-group">
					                <label for="paperFolding" class="col-xs-3 col-lg-4 control-label">Paper Folding</label>
					                <div class="col-sm-9 col-lg-6 controls">
					                    <select class="form-control" id="paperFolding" name="paperFolding[]" multiple="multiple">
							                @if(count($resPaperFoldings))
							                	@foreach($resPaperFoldings as $row)
							                		<option value="{{$row->primaryKey}}">{{$row->paperFolding}}</option>
							                	@endforeach
							                @endif
						            	</select>
					                </div>
					            </div>
					        </div>
					        <div class="col-md-5 ">
					            <div class="form-group">
					                <label for="paperBinding" class="col-xs-3 col-lg-4 control-label">Paper Binding</label>
					                <div class="col-sm-9 col-lg-6 controls">
					                    <select class="form-control" id="paperBinding" name="paperBinding[]" multiple="multiple">
							                @if(count($resPaperBindings))
							                	@foreach($resPaperBindings as $row)
							                		<option value="{{$row->primaryKey}}">{{$row->paperBinding}}</option>
							                	@endforeach
							                @endif
						            	</select>
					                </div>
					            </div>
					        </div>
				        </div>
				        <div style="clear: both;"></div>
				    <!--****************************6********************************-->

				    <!--****************************7********************************-->
				    	<div class="col-md-12 ">
					        <div class="col-md-5 ">
					            <div class="form-group">
					                <label for="paperSides" class="col-xs-3 col-lg-4 control-label">Paper Sides</label>
					                <div class="col-sm-9 col-lg-6 controls">
					                    <select class="form-control" id="paperSides" name="paperSides[]" multiple="multiple">
							                @if(count($resPaperSides))
							                	@foreach($resPaperSides as $row)
							                		<option value="{{$row->primaryKey}}">{{$row->paperSides}}</option>
							                	@endforeach
							                @endif
						            	</select>
					                </div>
					            </div>
					        </div>
				        </div>
				        <div style="clear: both;"></div>
				    <!--****************************7********************************-->
				    <!--****************************8********************************-->
				    	<div class="col-md-12 ">
				    		<div class="col-md-5 ">
				    		&nbsp;
				    		</div>
					        <div class="col-md-5 ">
					            <div class="form-group">
					                <div class="col-sm-9 col-lg-6 controls col-lg-offset-4">
					                    <a class="btn btn-primary" href="{{$module_url_path.'/document/attributes/manage/'}}"><i class="fa fa-arrow-left"></i> Back</a>
					                    <button class="btn btn-primary" type="button" id="btnSubmit" name="btnSubmit"><i class="fa fa-check"></i> Save</button>
					                </div>
					            </div>
					        </div>
				        </div>
				        <div style="clear: both;"></div>
				    <!--****************************8********************************-->
				    </div>
				</form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{ url('/js/admin/') }}/jquery.select-multiple.js"></script>
<script type="text/javascript">
	$('.clsMultiple,#paperType,#paperColor,#paperFolding,#paperBinding,#paperSides').selectMultiple();

	$('body').on('change','#documentType',function(){
		$('#documentType').next("span").remove();
		var _count = $("#documentType :selected").val();
		if(_count == ''){
			$('<span class="help-inline has-error">Please select document type.</span>').insertAfter('#documentType');
		}
	});
	$('body').on('change','.removeErrorWeight',function(){
		var ele_id = this.id;
		var count = $("#"+ele_id+" :selected").length;
		var num = ele_id.split('_');
		$('#ms-paperGsm_'+num[1]).next("span").remove();
		if(count == 0){
			$('<span class="help-inline has-error">Please select paper weight.</span>').insertAfter('#ms-paperGsm_'+num[1]);
		}
	});
	
$('body').on('change','.removeErrorSize',function(){

	var allValues = [];
	var selVal = $(this).val();
	var _id = this.id;
	$(this).next("span").remove();
	if(selVal == ''){
		$('<span class="help-inline has-error">Please select paper size.</span>').insertAfter(this);
	}
	else{
		$(this).next("span").remove();
	}
});

function checkEmptySize()
{
	var allValues = [];
	var allEle = $('select[name="paperSize[]"]');
	var counter = 0;
	for(var i = 0; i < allEle.length; i++)
	{
		if(allEle[i].value != ''){
			counter++;
		}

	}
	if(allEle.length != counter){
		return false;
	}
	else{
		return true;
	}
}

function checkEmptyWeight()
{
	var allValues = [];
	var allEle = $('select[name="paperGsm[]"]');
	var counter = 0;
	for(var i = 0; i < allEle.length; i++)
	{
		if(allEle[i].value != ''){
			counter++;
		}
	}

	if(allEle.length != counter){
		return false;
	}
	else{
		return true;
	}
}
	var iCnt = 2;
	var eleCounter = 2;
	var _limit = <?php echo count($resPaperSize); ?>
	
	$('body').on('click','#addMore',function(){

		$('#documentType').next("span").remove();
		var _count = $("#documentType :selected").val();
		if(_count == '')
		{
			$('<span class="help-inline has-error">Please select document type.</span>').insertAfter('#documentType');
		}
		else if(!checkEmptySize())
		{
			var num = parseInt(eleCounter)-1;
			if(eleCounter > 2){
				$('#paperSize_'+num).next("span").remove();
				$('<span class="help-inline has-error">Please select paper size.</span>').insertAfter('#paperSize_'+num);
			}
			else{
				$('#paperSize_1').next("span").remove();
				$('<span class="help-inline has-error">Please select paper size.</span>').insertAfter('#paperSize_1');
			}
		}
		else if(!checkEmptyWeight())
		{
			var num = parseInt(eleCounter)-1;
			if(eleCounter > 2){
				$('#ms-paperGsm_'+num).next("span").remove();
				$('<span class="help-inline has-error">Please select paper weight.</span>').insertAfter('#ms-paperGsm_'+num);
			}
			else{
				$('#ms-paperGsm_1').next("span").remove();
				$('<span class="help-inline has-error">Please select paper weight.</span>').insertAfter('#ms-paperGsm_1');
			}
		}
		else
		{
			if(iCnt <= _limit)
			{
				$("#paperSizeWeight").append('<div class="col-md-12 getMyLength clsPaperSizeWeight_'+eleCounter+'"><div class="col-md-5"><div class="form-group"><label for="paperSize_'+eleCounter+'" class="col-xs-3 col-lg-4 control-label">Paper Size</label><div class="col-sm-9 col-lg-6 controls"><select id="paperSize_'+eleCounter+'" name="paperSize[]" class="form-control removeErrorSize"><option value="">Paper Size</option><?php if(count($resPaperSize)) foreach($resPaperSize as $row) echo '<option value="'.$row->primaryKey.'">'.$row->paperSize.'</option>';?></select></div></div></div><div class="col-md-5 "><div class="form-group"><label for="paperGsm_'+eleCounter+'" class="col-xs-3 col-lg-4 control-label">Paper Weight <small>(GSM)</small></label><div class="col-sm-9 col-lg-6 controls"><select class="form-control removeErrorWeight clsMultiple" id="paperGsm_'+eleCounter+'" name="paperGsm[]" multiple="multiple"><?php if(count($resPaperGsm))foreach($resPaperGsm as $row)echo '<option value="'.$row->primaryKey.'">'.$row->paperGsm.' GSM</option>'; ?></select></div></div></div><div class="col-md-2 "><div class="form-group"><a href="javascript:void(0);" style="color:#F00;" class="removeElement" data-id="'+eleCounter+'"><i class="fa fa-times"></i> Remove</a></div></div></div>');
				$('.clsMultiple').selectMultiple();
				iCnt = iCnt + 1;
				eleCounter = eleCounter + 1;
			}
			else{
				$.alert.open('warning','Message',"Maximum limit reached. "+iCnt);
				return false;
			}
		}
	});

	$('body').on('click','.removeElement',function(){
		var id = $(this).data('id');
		$('.clsPaperSizeWeight_'+id).remove();
		if($('.getMyLength').length > 1){
			iCnt--;
		}
		else{
			iCnt = 2;
		}
	});

	function chkDuplicate()
	{
		var allValues = [];
		var allEle = $('select[name="paperSize[]"]');
		for(var i = 0; i < allEle.length; i++){
			if(allEle[i].value != ''){
				allValues.push(allEle[i].value);
			}
		}
		var duplicates = allValues.reduce(function(acc, el, i, arr) {
		if (arr.indexOf(el) !== i && acc.indexOf(el) < 0) acc.push(el); 
		  return acc;
		}, []);
		return duplicates.length;
	}

	$('body').on('click','#btnSubmit',function(){
		$('#documentType').next("span").remove();
		var _docType = $("#documentType :selected").val();
		var _paperColor = $("#paperColor :selected").length;

		if(_docType == '')
		{
			$.alert.open('warning','Message','Please select document type.');
			return false;
		}
		else if(!checkEmptySize())
		{
			$.alert.open('warning','Message','Please select paper size.');
			return false;
		}
		else if(!checkEmptyWeight())
		{
			$.alert.open('warning','Message','Please select paper weight.');
			return false;
		}
		else if(chkDuplicate() > 0)
		{
			$.alert.open('warning','Message','We have found some duplicate values in paper size.');
			return false;
		}
		else if(_paperColor == 0)
		{
			$.alert.open('warning','Message','Please select paper color.');
			return false;
		}
		else
		{
			runSwitch = null;
			runDuplicate = $.ajax(
			{
			  headers:{'X-CSRF-Token': $('input[name="_token"]').val()},
			  type:'post',
			  dataType: 'JSON',
			  url:'{{$module_url_path}}/document/attributes/check-duplicate/',
			  data:{_id:_docType},
			  beforeSend:function(data, statusText, xhr, wrapper)
			  {
			    if(runSwitch != null){
			      return false;
			    }
			    $('#btnSubmit').html('<i style="color:#ffdc14;" class="fa fa-spinner fa-pulse"></i><span class="bigger-110"> saving...</span>');
			  },
			  success: function(data, statusText, xhr, wrapper)
			  {
			    runSwitch = null;
			    $('#btnSubmit').html('<i class="fa fa-check"></i> Save');
			    if(data.status == 'found'){
			     	$.alert.open('warning','Message',data.message);
			    }
			    else if(data.status == 'notfound')
			    {
			      	var allEle = $('select[name="paperGsm[]"]');
					var x= 1;
					for(var i = 0; i < allEle.length; i++)
					{
						x = x+i;
						$(allEle[i]).attr('name','paperGsm_'+i+'[]');
					}
					$('#frmDocumentAttributes').submit();
			    }
			    else if(data.status == 'fail')
			    {
					if(data.errors != '')
					{
						$('.marketplaceCheckout').html('Checkout');
						var errorsHtml = '';
						$.each(data.errors, function( key, value ) {
						  errorsHtml = value[0];
						});
						$.alert.open('error','Error',errorsHtml);
					}
			    }
			  },
			  error: function(data, statusText, xhr, wrapper){
			  	$('#btnSubmit').html('<i class="fa fa-check"></i> Save');
			    runSwitch = null;
			  }
			});
		}

	});

</script>
@stop
