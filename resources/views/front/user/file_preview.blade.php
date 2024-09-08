
@include('front.user._inner-breadcrumbs')
<div class="dash-main-block">
    <div class="container">
        <div class="row">
            <div>
                @include('front.user.left-navigation')
            </div>
            <div class="col-xs-12 col-sm-8 col-md-9 col-lg-9">
                <br/>
          		<iframe id="frame-" src="{{url('/')}}/MainViewerJS/#../{{$url}}" allowfullscreen width="100%" height="500"></iframe>   
               <div class="col-xs-12">
                @if(count($documentsList))
                <div class="row">
                  <div class="back-forward">
                    <a href="{{url('/').'/user/create-document'}}"><i class="icon-back"></i><?php echo (preg_replace('#<[^>]+>#',' ',translation('back')));?></a>
                    <a href="{{url('').'/user/printing-options/'.$documentsList[0]->enc_pdf_id}}/"><i class="icon-next"></i><?php echo (preg_replace('#<[^>]+>#',' ',translation('continue')));?></a>
                  </div>
                </div>
                @endif
              </div>   


            </div>

        </div>
    </div>
</div>