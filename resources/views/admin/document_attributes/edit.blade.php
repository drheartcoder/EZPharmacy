@extends('admin.layout.master')
@section('main_content')
<link rel="stylesheet" type="text/css" href="{{ url('/css/admin/') }}/select-multiple.css">
<div id="breadcrumbs">
<?php
	$outerRow   =  $resCreatedDocuments[0];
	$arrSize 	= !empty($outerRow->paper_size) ? explode(',',$outerRow->paper_size):[];
	$arrGSM 	= !empty($outerRow->weight_gsm_options) ? explode(',',$outerRow->weight_gsm_options):[];
	$arrColor 	= !empty($outerRow->colour_options) ? explode(',',$outerRow->colour_options):[];
	$arrType 	= !empty($outerRow->paper_type) ? explode(',',$outerRow->paper_type):[];
	$arrFoldings = !empty($outerRow->brochure_options) ? explode(',',$outerRow->brochure_options):[];
	$arrBindings = !empty($outerRow->binding_options) ? explode(',',$outerRow->binding_options):[];
	$arrSides 	 = !empty($outerRow->side_options) ? explode(',',$outerRow->side_options):[];
?>
    <ul class="breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="{{ url($admin_panel_slug.'/dashboard') }}">Dashboard</a>
            <span class="divider"><i class="fa fa-angle-right"></i></span>
        </li>
        <li class="active">Edit Document <span class="divider"><i class="fa fa-angle-right"></i></span> {{$outerRow->documentName}}</li>
    </ul>
</div>
<!-- END Breadcrumb -->

<!-- BEGIN Main Content -->
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-title">
                <h3><i class="fa fa-table"></i> Document Type - {{$outerRow->documentName}}</h3>
            </div>
            <div class="box-content">
                @include('admin.layout._operation_status')
                <form id="frmDocumentAttributes" name="frmDocumentAttributes" method="post" action="" class="form-horizontal">
                	{{csrf_field()}}
				    <div class="row">
				    <!--******************************1******************************-->
				    	<div class="col-md-12" style="display: none;">
					        <div class="col-md-5 ">
					            <div class="form-group">
					                <label for="documentType" class="col-xs-3 col-lg-4 control-label">Document Type</label>
					                <div class="col-sm-9 col-lg-6 controls">
					                    <select class="form-control" id="documentType" name="documentType" disabled="disabled">
							                <option value="">Document Type</option>
							                @if(count($resDocumentType))
							                	@foreach($resDocumentType as $row)
							                		<option value="{{$row->primaryKey}}" {{$outerRow->document_id == $row->primaryKey?'selected':''}}>{{$row->documentType}}</option>
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
				                <label for="paperSize" class="col-xs-3 col-lg-4 control-label">Paper Size</label>
				                <div class="col-sm-9 col-lg-6 controls">
				                    <select id="paperSize" name="paperSize[]" class="form-control removeErrorSize clsMultiple" multiple="multiple">
						                @if(count($resPaperSize))
						                	@foreach($resPaperSize as $row)
						                		<option value="{{$row->primaryKey}}" {{in_array($row->primaryKey, $arrSize)?'selected':''}}>{{$row->paperSize}}</option>
						                	@endforeach
						                @endif
						            </select>
				                </div>
				            </div>
				        </div>
				        <div class="col-md-5 ">
				            <div class="form-group">
				                <label for="paperGsm" class="col-xs-3 col-lg-4 control-label">Paper Weight <small>(GSM)</small></label>
				                <div class="col-sm-9 col-lg-6 controls">
				                    <select class="form-control removeErrorWeight clsMultiple" id="paperGsm" name="paperGsm[]" multiple="multiple">
						                @if(count($resPaperGsm))
						                	@foreach($resPaperGsm as $row)
						                		<option value="{{$row->primaryKey}}" {{in_array($row->primaryKey, $arrGSM)?'selected':''}}>{{$row->paperGsm}} GSM</option>
						                	@endforeach
						                @endif
						            </select>
				                </div>
				            </div>
				        </div>
				    </div>
				    <!--*****************************2*******************************-->

				    <!--****************************3********************************-->
				    	<div class="col-md-12 ">
				    		<div class="col-md-5 ">
					            <div class="form-group">
					                <label for="paperColor" class="col-xs-3 col-lg-4 control-label">Paper Color</label>
					                <div class="col-sm-9 col-lg-6 controls">
					                    <select class="form-control clsMultiple" id="paperColor" name="paperColor[]" multiple="multiple">
							                @if(count($resPaperColor))
							                	@foreach($resPaperColor as $row)
							                		<option value="{{$row->primaryKey}}" {{in_array($row->primaryKey, $arrColor)?'selected':''}}>{{$row->paperColor}}</option>
							                	@endforeach
							                @endif
						            	</select>
					                </div>
					            </div>
					        </div>

					        <div class="col-md-5 ">
					            <div class="form-group">
					                <label for="paperType" class="col-xs-3 col-lg-4 control-label">Paper Type</label>
					                <div class="col-sm-9 col-lg-6 controls">
					                    <select class="form-control clsMultiple" id="paperType" name="paperType[]" multiple="multiple">
							                @if(count($resPaperType))
							                	@foreach($resPaperType as $row)
							                		<option value="{{$row->primaryKey}}" {{in_array($row->primaryKey, $arrType)?'selected':''}}>{{$row->paperType}}</option>
							                	@endforeach
							                @endif
						            	</select>
					                </div>
					            </div>
					        </div>
				        </div>
				        <div style="clear: both;"></div>
				    <!--****************************3********************************-->

				    <!--****************************4********************************-->
				    	<div class="col-md-12 ">
					        <div class="col-md-5 ">
					            <div class="form-group">
					                <label for="paperFolding" class="col-xs-3 col-lg-4 control-label">Paper Folding</label>
					                <div class="col-sm-9 col-lg-6 controls">
					                    <select class="form-control clsMultiple" id="paperFolding" name="paperFolding[]" multiple="multiple">
							                @if(count($resPaperFoldings))
							                	@foreach($resPaperFoldings as $row)
							                		<option value="{{$row->primaryKey}}" {{in_array($row->primaryKey, $arrFoldings)?'selected':''}}>{{$row->paperFolding}}</option>
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
					                    <select class="form-control clsMultiple" id="paperBinding" name="paperBinding[]" multiple="multiple">
							                @if(count($resPaperBindings))
							                	@foreach($resPaperBindings as $row)
							                		<option value="{{$row->primaryKey}}" {{in_array($row->primaryKey, $arrBindings)?'selected':''}}>{{$row->paperBinding}}</option>
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
					        <div class="col-md-5 ">
					            <div class="form-group">
					                <label for="paperSides" class="col-xs-3 col-lg-4 control-label">Paper Sides</label>
					                <div class="col-sm-9 col-lg-6 controls">
					                    <select class="form-control clsMultiple" id="paperSides" name="paperSides[]" multiple="multiple">
							                @if(count($resPaperSides))
							                	@foreach($resPaperSides as $row)
							                		<option value="{{$row->primaryKey}}" {{in_array($row->primaryKey, $arrSides)?'selected':''}}>{{$row->paperSides}}</option>
							                	@endforeach
							                @endif
						            	</select>
					                </div>
					            </div>
					        </div>
				        </div>
				        <div style="clear: both;"></div>
				    <!--****************************5********************************-->
				    <!--****************************6********************************-->
				    	<div class="col-md-12 ">
				    		<div class="col-md-5 ">
				    		&nbsp;
				    		</div>
					        <div class="col-md-5 ">
					            <div class="form-group">
					                <div class="col-sm-9 col-lg-6 controls col-lg-offset-4">
					                    <a class="btn btn-primary" href="{{$module_url_path.'/document/attributes/manage/'}}"><i class="fa fa-arrow-left"></i> Back</a>
					                    <input type="hidden" id="document_Type" name="document_Type" value="1">
					                    <button class="btn btn-primary" type="button" id="btnSubmit" name="btnSubmit"><i class="fa fa-edit"></i> Edit</button>
					                </div>
					            </div>
					        </div>
				        </div>
				        <div style="clear: both;"></div>
				    <!--****************************6********************************-->
				    </div>
				</form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{ url('/js/admin/') }}/jquery.select-multiple.js"></script>
<script type="text/javascript">
	$('.clsMultiple').selectMultiple();

	/*$('body').on('change','.removeErrorWeight',function(){
		var count = $("#paperGsm :selected").length;
		$('#ms-paperGsm').next("span").remove();
		if(count == 0){
			$('<span class="help-inline has-error">Please select paper weight.</span>').insertAfter('#ms-paperGsm');
		}
	});
	
	$('body').on('change','.removeErrorSize',function(){
		var count = $("#paperSize :selected").length;
		$('#ms-paperSize').next("span").remove();
		if(count == 0){
			$('<span class="help-inline has-error">Please select paper size.</span>').insertAfter("#ms-paperSize");
		}
	});

	$('body').on('change','#paperColor',function(){
		var count = $("#paperColor :selected").length;
		$('#ms-paperColor').next("span").remove();
		if(count == 0){
			$('<span class="help-inline has-error">Please select paper color.</span>').insertAfter("#ms-paperColor");
		}
	});*/

	$('body').on('click','#btnSubmit',function(){
		$('#ms-paperSize,#ms-paperGsm,#ms-paperColor').next("span").remove();
		var _paperSize  = $("#paperSize :selected").length;
		var _paperGsm   = $("#paperGsm :selected").length;
		var _paperColor = $("#paperColor :selected").length;
		$('#frmDocumentAttributes').submit();
		/*if(_paperSize == 0)
		{
			$('<span class="help-inline has-error">Please select paper size.</span>').insertAfter('#ms-paperSize');
			return false;
		}
		else if(_paperGsm == 0)
		{
			$('<span class="help-inline has-error">Please select paper weight.</span>').insertAfter('#ms-paperGsm');
			return false;
		}
		else if(_paperColor == 0)
		{
			$('<span class="help-inline has-error">Please select paper color.</span>').insertAfter('#ms-paperColor');
			return false;
		}
		else
		{
			$('#frmDocumentAttributes').submit();
		}*/
	});

</script>
@stop
