
      <div class="col-xs-12 list-of-files" id="documentResult">
        <div class="row">
          <table class="create-table">
            <thead>
            <tr class="text-center">
              <td colspan="4"><h3>List of files</h3></td>
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
                      <td>
                        <div class="format-type"><img src="{{url('front-assets')}}/images/pdf.jpg" alt="PDF"></div>
                        {{$row->filename}}
                      </td>
                      <td class="text-center">{{$row->num_pages}}</td>
                      <td class="text-center">{{date('d-m-Y',strtotime($row->created_date))}}</td>
                      <td>
                        {{-- <button class="create-bnt create-bnt-yellow">Preview</button> --}}

                         <a class="create-bnt create-bnt-yellow" href="{{ url('').'/user/file/preview/'.base64_encode($row->filepath) }}" title="Preview" target="_new">Preview</a>

                        
                         <a class="create-bnt create-bnt-yellow" href="{{url('').'/user/printing-options/'.$row->enc_pdf_id}}/"> <i class="fa fa-print"></i></a>
                        
                        <a class="create-bnt create-bnt-yellow create-bnt removeFile" href="{{url('').'/user/remove-file?id='.$row->id}}"  id="loader_{{$row->id}}"><i class="icon-rubbish-bin"></i></a>
                              
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