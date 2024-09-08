
<style type="text/css">
.dropzone {
    /*border: 2px dashed #EB7260;*/
/*    box-shadow: 0 0 0 2px #373b44;*/
       padding: 40px 20px 20px;
    /*background: #373b44;*/
    color: #7d7d7d;
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
    padding: 1px;
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
<section class="container simple-page">
  <div class="row">
    <div class="col-md-12 col-xs-12 text-center">
      <h2><?php echo (preg_replace('#<[^>]+>#',' ',translation('create_document')));?></h2>
    </div>
    <!-- MENU BEGIN -->
    <div>
        @include('front.user.left-navigation')
    </div>
    <!-- MENU BEGIN -->
    <!-- CREATE CONTENT BEGIN -->
    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12"><!-- col-lg-offset-1 col-md-offset-0 col-sm-offset-0 col-xs-offset-0 -->
      <!-- STEPS BEGIN -->
      <div class="col-lg-3 col-xs-3">
        <div class="row">
          <div class="chevron first-step chevron-active">
            <span><?php echo (preg_replace('#<[^>]+>#',' ',translation('step_1')));?></span>
            <div class="text-center">
              <i class="icon-upload-file"></i>
              <p><?php echo (preg_replace('#<[^>]+>#',' ',translation('upload_file')));?></p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-xs-3">
        <div class="row">
          <div class="chevron chevron-right">
            <span><?php echo (preg_replace('#<[^>]+>#',' ',translation('step_2')));?></span>
            <div class="text-center">
              <i class="icon-order"></i>
              <p><?php echo  (preg_replace('#<[^>]+>#',' ',translation('document')));?> &amp; <?php echo (preg_replace('#<[^>]+>#',' ',translation('its_attributes')));?></p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-xs-3">
        <div class="row">
          <div class="chevron chevron-right">
            <span><?php echo (preg_replace('#<[^>]+>#',' ',translation('step_3')));?></span>
            <div class="text-center">
              <i class="icon-shopping-cart">
                <span class="cart-count" id="myCartCount">{{$cartCount or '0'}}</span>
              </i>
              <p><?php echo (preg_replace('#<[^>]+>#',' ',translation('cart')));?></p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-xs-3">
        <div class="row">
          <div class="chevron last-step">
            <span><?php echo (preg_replace('#<[^>]+>#',' ',translation('step_4')));?></span>
            <div class="text-center">
              <i class="icon-card"></i>
              <p><?php echo (preg_replace('#<[^>]+>#',' ',translation('checkout')));?></p>
            </div>
          </div>
        </div>
      </div>
      <!-- STEPS EOF -->
      <!-- UPDATE FILE BEGIN -->
      <div class="row" ><br/></div>
      <div style="margin-top: 10px;">
             <div class="col-xs-12 upload-file">
                <div class="row">
                  <div class="col-lg-5 col-md-5 col-xs-12">
                    <div class="row">
                      <div class="drag-and-drop">
                        <div  class="click-drop-block" >                    
                            <form name="" id="upload-pdf" class="dropzone" action="{{url('').'/user/store/'}}" method="post" enctype="multipart/form-data">
                             <i class="icon-drag-and-drop"></i>
                            {{csrf_field()}}
                            </form>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-7 col-md-7 col-xs-12">
                    <div class="row last-uploaded-file">
                      <h3 class="text-center"><?php echo (preg_replace('#<[^>]+>#',' ',translation('plast_uploaded_filep')));?></h3>
                      <div class="last-uploaded-file-wrap">
                        <div class="last-uploaded-file-img">
                          <img src="{{url('front-assets')}}/images/pdf-img-adobe.png" alt="">
                        </div>
                        @if(count($documentsList))
                        <div class="last-uploaded-file-action">
                        <?php 
                              $file_name = '-';
                              $arr_file =  explode("---",$documentsList[0]->filename);
                              $file_name = isset($arr_file[1])?$arr_file[1]:'-';
                        ?>
                          <p>{{$file_name or '-'}}</p>
                          
                          <a class="create-bnt create-bnt-yellow-fill" href="{{ url('').'/user/file/preview/'.base64_encode($documentsList[0]->filepath) }}" title="<?php echo (preg_replace('#<[^>]+>#',' ',translation('ppreviewp')));?>" target="_new"><?php echo (preg_replace('#<[^>]+>#',' ',translation('ppreviewp')));?></a>


                          <a class="create-bnt create-bnt-disabled" data-placement="right" data-toggle="tooltip" title="<?php echo (preg_replace('#<[^>]+>#',' ',translation('ppleasepreview_your_file_firstp')));?>" data-toggle="modal"  href="{{url('').'/user/printing-options/'.$documentsList[0]->enc_pdf_id}}/"><?php echo (preg_replace('#<[^>]+>#',' ',translation('continue')));?></a>

                         <a class="create-bnt removeFile" href="{{url('').'/user/remove-file?id='.$documentsList[0]->id}}"  id="loader_{{$documentsList[0]->id}}"><i class="icon-rubbish-bin"></i></a>

                        </div>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            
            
        </div>

      <!-- NOTE BEGIN -->
      <div class="col-xs-12">
        <div class="row">
          <div class="note">
            <i class="icon-note"></i><span><?php echo (preg_replace('#<[^>]+>#',' ',translation('pnotep')));?></span> <p><?php echo (preg_replace('#<[^>]+>#',' ',translation('pallowed_file_types_ppt_pptx_doc_docx_amp_pdfp')));?></p>
          </div>
        </div>
      </div>

      <div class="col-xs-12 list-of-files" id="documentResult">
        <div class="row">
          <table class="table table-condensed table-striped">
            <thead>
            <tr class="text-center" style="background: #f9f9f9;">
              <td colspan="4"><h3><?php echo (preg_replace('#<[^>]+>#',' ',translation('plist_of_filesp')));?></h3></td>
            </tr>
            <tr>
              <td><?php echo (preg_replace('#<[^>]+>#',' ',translation('document_name')));?></td>
              <td class="text-center"><?php echo (preg_replace('#<[^>]+>#',' ',translation('number_of_pages')));?></td>
              <td class="text-center"><?php echo (preg_replace('#<[^>]+>#',' ',translation('upload_date')));?></td>
              <td class="text-center"><?php echo (preg_replace('#<[^>]+>#',' ',translation('action')));?></td>
            </tr>
            </thead>
            <tbody>
             @if(count($documentsList))
              @foreach($documentsList as $row)
                    <tr>
                      <td style="white-space: nowrap;width: 160px;overflow: hidden;text-overflow: ellipsis;display: inline-block;padding: 20px 10px;">
                        <div class="format-type"><img src="{{url('front-assets')}}/images/pdf.jpg" alt="PDF"></div>
                       <?php 
                              $file_name = '-';
                              $arr_file =  explode("---",$row->filename);
                              $file_name = isset($arr_file[1])?$arr_file[1]:'-';
                       ?>
                       {{$file_name}}
                      </td>
                      <td class="text-center">{{$row->num_pages}}</td>
                      <td class="text-center">{{date('d-m-Y',strtotime($row->created_date))}}</td>
                      <td>
                        {{-- <button class="create-bnt create-bnt-yellow">Preview</button> --}}

                         <a class="create-bnt create-bnt-yellow" href="{{ url('').'/user/file/preview/'.base64_encode($row->filepath) }}" title="<?php echo (preg_replace('#<[^>]+>#',' ',translation('ppreviewp')));?>" target="_new"><?php echo (preg_replace('#<[^>]+>#',' ',translation('ppreviewp')));?></a>

                         <a class="create-bnt create-bnt-disabled" data-placement="right" data-toggle="tooltip" title="<?php echo (preg_replace('#<[^>]+>#',' ',translation('ppleasepreview_your_file_firstp')));?>" data-toggle="modal" href="{{url('').'/user/printing-options/'.$row->enc_pdf_id}}/"><?php echo (preg_replace('#<[^>]+>#',' ',translation('continue')));?></a>

                         <a class="create-bnt removeFile" href="{{url('').'/user/remove-file?id='.$row->id}}"  id="loader_{{$row->id}}"><i class="icon-rubbish-bin"></i></a>
                              
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
      <!-- NOTE BEGIN -->
      <div class="col-xs-12">
        <div class="row">
          <div class="note">
          <i class="icon-note"></i><span><?php echo (preg_replace('#<[^>]+>#',' ',translation('pnotep')));?></span> <p><?php echo (preg_replace('#<[^>]+>#',' ',translation('puploaded_files_are_stored_up_to_48_hoursp')));?></p>
          </div>
        </div>
      </div>
      <!-- NOTE EOF -->
      <!-- LIST OF FILES EOF -->
    </div>
    <!-- CREATE CONTENT EOF -->
  </div>
</section>