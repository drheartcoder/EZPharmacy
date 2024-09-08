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
        <li class="active">Add Document Attributes</li>
    </ul>
</div>
<!-- END Breadcrumb -->

<!-- BEGIN Main Content -->
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-title">
                <h3><i class="fa fa-table"></i> Add Document Attributes</h3>
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
				                <label for="paperSize" class="col-xs-3 col-lg-4 control-label">Paper Size</label>
				                <div class="col-sm-9 col-lg-6 controls">
				                    <select id="paperSize" name="paperSize[]" class="form-control removeErrorSize clsMultiple" multiple="multiple">
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
				                <label for="paperGsm" class="col-xs-3 col-lg-4 control-label">Paper Weight <small>(GSM)</small></label>
				                <div class="col-sm-9 col-lg-6 controls">
				                    <select class="form-control removeErrorWeight clsMultiple" id="paperGsm" name="paperGsm[]" multiple="multiple">
						                @if(count($resPaperGsm))
						                	@foreach($resPaperGsm as $row)
						                		<option value="{{$row->primaryKey}}">{{$row->paperGsm}} GSM</option>
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
							                		<option value="{{$row->primaryKey}}">{{$row->paperColor}}</option>
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
							                		<option value="{{$row->primaryKey}}">{{$row->paperType}}</option>
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
					                    <select class="form-control clsMultiple" id="paperBinding" name="paperBinding[]" multiple="multiple">
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
							                		<option value="{{$row->primaryKey}}">{{$row->paperSides}}</option>
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
					                    <button class="btn btn-primary" type="button" id="btnSubmit" name="btnSubmit"><i class="fa fa-check"></i> Save</button>
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

	$('body').on('change','#documentType',function(){
		$('#documentType').next("span").remove();
		var _count = $("#documentType :selected").val();
		if(_count == ''){
			$('<span class="help-inline has-error">Please select document type.</span>').insertAfter('#documentType');
		}
	});
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
		$('#documentType,#ms-paperSize,#ms-paperGsm,#ms-paperColor').next("span").remove();
		var _docType    = $("#documentType :selected").val();
		var _paperSize  = $("#paperSize :selected").length;
		var _paperGsm   = $("#paperGsm :selected").length;
		var _paperColor = $("#paperColor :selected").length;

		if(_docType == '')
		{
			$('<span class="help-inline has-error">Please select document type.</span>').insertAfter('#documentType');
			return false;
		}
		/*else if(_paperSize == 0)
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
		}*/
		else
		{
			runSwitch = null;
			runDuplicate = $.ajax(
			{
			  headers:{'X-CSRF-Token': $('input[name="_token"]').val()},
			  type:'post',
			  dataType: 'JSON',
			  url:'{{$module_url_path}}/document/attributes/check-duplicate/',
			  data:{_id:_docType,action:'add'},
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
