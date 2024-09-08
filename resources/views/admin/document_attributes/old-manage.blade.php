@extends('admin.layout.master')
@section('main_content')
<div id="breadcrumbs">
    <ul class="breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="{{ url($admin_panel_slug.'/dashboard') }}">Dashboard</a>
            <span class="divider"><i class="fa fa-angle-right"></i></span>
        </li>
        <li class="active">Document Attributes</li>
    </ul>
</div>
<!-- END Breadcrumb -->

<!-- BEGIN Main Content -->
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-title">
                <h3><i class="fa fa-table"></i> Document Attributes</h3>
            </div>
            <div class="box-content">
                <div class="btn-toolbar pull-right">
                    <div class="btn-group">
                        <a class="btn btn-circle show-tooltip" title="Add new record" href="{{$module_url_path.'/document/attributes/add/'}}"><i class="fa fa-plus"></i></a>
                        <a class="btn btn-circle show-tooltip" title="Delete selected" href="#"><i class="fa fa-trash-o"></i></a>
                        <a class="btn btn-circle show-tooltip" title="Refresh" href="{{$module_url_path.'/document/attributes/manage/'}}"><i class="fa fa-repeat"></i></a>
                    </div>
                </div>
                <br/>
                <br/>
                @include('admin.layout._operation_status') 
                <!-- <pre>
                    {{--print_r($resCreatedDocuments)--}}
                </pre> -->
                <div class="table-big">
                    <table class="table table-bordered fill-head">
                        <thead>
                            <tr>
                                <!-- <th style="width:18px"><input type="checkbox" /></th> -->
                                <?php
                                    $totalColspan = count($resPaperColor) + count($resPaperSize) + count($resPaperType) + count($resPaperGsm) + count($resPaperFoldings) + count($resPaperBindings) + count($resPaperSides);
                                ?>
                                <th style="width:18px">Document Name</th>
                                <th style="text-align: center;" colspan="{{count($resPaperColor)}}">Paper Colour</th>
                                <th style="text-align: center;" colspan="{{count($resPaperSize)}}">Paper Size</th>
                                <th style="text-align: center;" colspan="{{count($resPaperType)}}">Paper Type</th>
                                <th style="text-align: center;" colspan="{{count($resPaperGsm)}}">Paper Weight GSM</th>
                                <th style="text-align: center;" colspan="{{count($resPaperFoldings)}}">Paper Foldings</th>
                                <th style="text-align: center;" colspan="{{count($resPaperBindings)}}">Paper Bindings</th>
                                <th style="text-align: center;" colspan="{{count($resPaperSides)}}">Paper Sides</th>
                            </tr>
                        </thead>
                        <tbody>
                        	<tr>
                                <!-- <th>&nbsp;</th> -->
                            	<th>Document Name</th>
                            	@if(count($resPaperColor))
                            		@foreach($resPaperColor as $row)
                            			<th>{{$row->paperColor}}</th>
                            		@endforeach
                            	@endif

                            	@if(count($resPaperSize))
                            		@foreach($resPaperSize as $row)
                            			<th>{{$row->paperSize}}</th>
                            		@endforeach
                            	@endif

                            	@if(count($resPaperType))
                            		@foreach($resPaperType as $row)
                            			<th>{{$row->paperType}}</th>
                            		@endforeach
                            	@endif

                            	@if(count($resPaperGsm))
                            		@foreach($resPaperGsm as $row)
                            			<th>{{$row->paperGsm}}</th>
                            		@endforeach
                            	@endif

                            	@if(count($resPaperFoldings))
                            		@foreach($resPaperFoldings as $row)
                            			<th>{{$row->paperFolding}}</th>
                            		@endforeach
                            	@endif

                            	@if(count($resPaperBindings))
                                    @foreach($resPaperBindings as $row)
                                        <th>{{$row->paperBinding}}</th>
                                    @endforeach
                                @endif

                                @if(count($resPaperSides))
                                    @foreach($resPaperSides as $row)
                                        <th>{{$row->paperSides}}</th>
                                    @endforeach
                                @endif
                            </tr>
                                <?php
                                    $arrColor = [];
                                    $arrSize  = [];
                                    $arrGSM   = [];
                                    $arrSides = [];
                                    $arrType  = [];
                                    $arrFoldings  = [];
                                    $arrBindings  = [];
                                ?>
                                @if(count($resCreatedDocuments))
                            		@foreach($resCreatedDocuments as $outerRow)
                                        <tr class="table-flag-blue">
                                            <!-- <td><input type="checkbox" /></td> -->
                                            <td>{{$outerRow->documentName}}</td>
                                            <?php
                                                
                                                $arrColor = !empty($outerRow->colour_options) ? explode(',',$outerRow->colour_options):[];
                                                $arrType = !empty($outerRow->paper_type) ? explode(',',$outerRow->paper_type):[];
                                                $arrFoldings = !empty($outerRow->brochure_options) ? explode(',',$outerRow->brochure_options):[];
                                                $arrBindings = !empty($outerRow->binding_options) ? explode(',',$outerRow->binding_options):[];
                                                $arrSides = !empty($outerRow->side_options) ? explode(',',$outerRow->side_options):[];
                                            ?>

                                                @if(count($resPaperColor))
                                                    @foreach($resPaperColor as $row)
                                                        <td style="text-align: center;">
                                                            <?php
                                                                echo in_array($row->primaryKey, $arrColor)?'<i class="fa fa-check" style="color:green;"></i>':'&nbsp;'
                                                            ?>
                                                        </td>
                                                    @endforeach
                                                @endif
                                               
                                                @if(count($resPaperSize))
                                                    @foreach($resPaperSize as $row)
                                                        <td style="text-align: center;">
                                                            <?php
                                                                $arrSize = [];
                                                                if(!empty($outerRow->paper_size))
                                                                {
                                                                    $sizeData = json_decode($outerRow->paper_size,TRUE);
                                                                    for($i = 0; $i < count($sizeData); $i++)
                                                                    {
                                                                        $arrSize[] = $sizeData['paperSize_'.$i]['id'];
                                                                    }
                                                                }
                                                                echo in_array($row->primaryKey, $arrSize)?'<i class="fa fa-check" style="color:green;"></i>':'&nbsp;'
                                                            ?>
                                                        </td>
                                                    @endforeach
                                                @endif

                                                @if(count($resPaperType))
                                                    @foreach($resPaperType as $row)
                                                        <td style="text-align: center;">
                                                            <?php
                                                                echo in_array($row->primaryKey, $arrType)?'<i class="fa fa-check" style="color:green;"></i>':'&nbsp;'
                                                            ?>
                                                        </td>
                                                    @endforeach
                                                @endif

                                                @if(count($resPaperGsm))
                                                    @foreach($resPaperGsm as $row)
                                                        <td style="text-align: center;">
                                                            <?php
                                                                $arrGSM = [];
                                                                if(!empty($outerRow->weight_gsm_options))
                                                                {
                                                                    $gsmData = json_decode($outerRow->weight_gsm_options,TRUE);
                                                                    for($i = 0; $i < count($gsmData); $i++)
                                                                    {
                                                                        $arrGSM[] = $gsmData['paperGsm_'.$i]['id'];
                                                                    }
                                                                }
                                                                echo '<pre>';
                                                                   print_r($arrGSM);
                                                                    echo $row->primaryKey;
                                                                echo '</pre>';
                                                                echo in_array($row->primaryKey, $arrGSM)?'<i class="fa fa-check" style="color:green;"></i>':'&nbsp;'
                                                            ?>
                                                        </td>
                                                    @endforeach
                                                @endif

                                                @if(count($resPaperFoldings))
                                                    @foreach($resPaperFoldings as $row)
                                                        <td style="text-align: center;">
                                                            <?php
                                                            echo in_array($row->primaryKey, $arrFoldings)?'<i class="fa fa-check" style="color:green;"></i>':'&nbsp;'
                                                            ?>
                                                        </td>
                                                    @endforeach
                                                @endif

                                                @if(count($resPaperBindings))
                                                    @foreach($resPaperBindings as $row)
                                                        <td style="text-align: center;">
                                                            <?php
                                                            echo in_array($row->primaryKey, $arrBindings)?'<i class="fa fa-check" style="color:green;"></i>':'&nbsp;' 
                                                            ?>
                                                        </td>
                                                    @endforeach
                                                @endif

                                                @if(count($resPaperSides))
                                                    @foreach($resPaperSides as $row)
                                                        <td style="text-align: center;">
                                                            <?php 
                                                            echo in_array($row->primaryKey, $arrSides)?'<i class="fa fa-check" style="color:green;"></i>':'&nbsp;' 
                                                            ?>
                                                        </td>
                                                    @endforeach
                                                @endif
                                        </tr>
                            		@endforeach
                                @else
                                    <tr>
                                        <td colspan="{{$totalColspan}}" style="text-align: center;color: #F00;font-weight: lighter;font-size: 24px;">Record(s) Not Found</td>
                                    </tr>
                            	@endif
                            
                        </tbody>
                    </table>
                </div>

                <!-- <p class="text-right">
                    1-12 of 46
                    <a class="btn btn-circle disabled" href="#"><i class="fa fa-angle-left"></i></a>
                    <a class="btn btn-circle" href="#"><i class="fa fa-angle-right"></i></a>
                </p> -->
            </div>
        </div>
    </div>
</div>
@stop