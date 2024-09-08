<style type="text/css">
.dropzone {
    /*border: 2px dashed #EB7260;*/
    box-shadow: 0 0 0 2px #373b44;
    padding: 20px;
    /*background: #373b44;*/
    color: #000;
    text-align: center;
}

.dropzone h3 {
    color: white;
    text-align: center;
    line-height: 3em;
    margin-top: 20px;
}

.dz-clickable {
    cursor: pointer;
}

.dz-drag-hover {
    border: 2px solid #EB7260;
}

.dz-preview, .dz-processing, .dz-image-preview, .dz-success, .dz-complete {
    background-color: rgba(0, 0, 0, .5);
    padding: 5px;
}

.dz-preview {
    width: auto !important;
}

.dz-image {
    text-align: center;
    /*border: 1px solid #EB7260;*/
}

.dz-details {
    padding: 10px;
}

.dz-success-mark, .dz-error-mark,  {
    display: none;
}
#total-progress{
    opacity: 0;
    transition: opacity 0.3s linear;
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
                            <li class="active"><a href="javascript:void(0);">
                                <h4 class="list-group-item-heading"><?php echo (preg_replace('#<[^>]+>#',' ',translation('step_1')));?></h4>
                                <p class="list-group-item-text"><?php echo (preg_replace('#<[^>]+>#',' ',translation('upload_file')));?></p>
                            </a></li>
                            <li class="disabled"><a href="javascript:void(0);">
                                <h4 class="list-group-item-heading"><?php echo (preg_replace('#<[^>]+>#',' ',translation('step_2')));?></h4>
                                <p class="list-group-item-text"><?php echo  (preg_replace('#<[^>]+>#',' ',translation('document')));?> &amp; <?php echo (preg_replace('#<[^>]+>#',' ',translation('its_attributes')));?></p>
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

                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div  class="click-drop-block" >                            
                            <form name="" id="upload-pdf" class="dropzone" action="{{url('').'/user/store/'}}" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            </form>
                        </div>
                    </div>
                </div>
                <br/>
                <span class="label label-important" style="background: red;"><?php echo  (preg_replace('#<[^>]+>#',' ',translation('pnotep')));?></span>
                <span style="color: red"><?php echo  (preg_replace('#<[^>]+>#',' ',translation('pallowed_file_types_ppt_pptx_doc_docx_amp_pdfp')));?></span>
                <!--*****************-->
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                            <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                        </div>
                    </div>
                </div>

   <div style="display: block; color: #a08d4b;font-weight: bold;padding: 4px 10px;font-size: 15px;background-color: #F4EEDA;margin-bottom: 5px;letter-spacing: 0.5px; display: none;" id="file_converted_msg"> <span><i class="fa fa-check" aria-hidden="true"></i> </span></div>

                <!--*****************-->
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="table-block-dash" id="documentResult">
                            <div class="left-bar-head get-uploading">
                                <?php echo (preg_replace('#<[^>]+>#',' ',translation('recently_uploaded_files')));?>
                            </div>
                            <hr/>
                            <div class="table-responsive" >
                                <table class="table table-striped dashboard">
                                    <thead>
                                        <tr>
                                            <th><?php echo (preg_replace('#<[^>]+>#',' ',translation('document_name')));?></th>
                                            <th><?php echo (preg_replace('#<[^>]+>#',' ',translation('number_of_pages')));?></th>
                                            <th><?php echo (preg_replace('#<[^>]+>#',' ',translation('upload_date')));?></th>                                            
                                            <th style="text-align: center"><?php echo (preg_replace('#<[^>]+>#',' ',translation('action')));?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($documentsList))
                                            @foreach($documentsList as $row)
                                                <tr>
                                                    <td>{{$row->filename}}</td>
                                                    <td style="font-family:'Open Sans';">{{$row->num_pages}}</td>
                                                    <td style="font-family:'Open Sans';">{{date('d-m-Y',strtotime($row->created_date))}}</td>
                                                    <td style="text-align: center">
                                                        {{-- <a href="{{ url('').'/'.$row->filepath }}" title="Preview" target="_new"> <i class="fa fa-eye"></i></a> --}}
                                                        <a href="{{ url('').'/user/file/preview/'.base64_encode($row->filepath) }}" title="Preview" target="_new"> <i class="fa fa-eye"></i></a>

                                                        {{-- <iframe id="frame-" src="{{url('/')}}/MainViewerJS/#../{{$row->filepath}}" allowfullscreen width="100%" height="500"></iframe> --}}

                                                        <a href="{{url('').'/user/printing-options/'.$row->enc_pdf_id}}/"> <i class="fa fa-print"></i></a>
                                                        
                                                        <a href="{{url('').'/user/remove-file?id='.$row->id}}" class="removeFile" id="loader_{{$row->id}}"><i class="fa fa-trash-o"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr><td colspan="4" style="text-align: center;color: #F00;font-weight: lighter;font-size: 22px;font-style: italic;"><?php echo (preg_replace('#<[^>]+>#',' ',translation('files_not_found')));?></td></tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="pagin-drop-block">
                                <div class="row">
                                    <div class="col-sm-6 col-md-12 col-lg-12">
                                        <div class="pagination-block-container">
                                            <?php echo $documentsList->links();?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>