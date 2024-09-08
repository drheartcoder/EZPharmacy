<?php  $pageTitle ="Site Offline";?>
@include('front.includes.header',['title'=>$pageTitle])
   
<style>.header, .newsletter-main, .footer-main-block{display: none} </style>
<div class="banner-404">
    <div class="container">
        <div class="man-404"><img src="{{ url('front-assets')}}/images/man-404.png" class="img-responsive" alt="404-page" /></div>
        <div class="wrapper">
            <div class="img2-404page"><img src="{{ url('front-assets')}}/images/404-small-img.png" class="img-responsive" alt="404-page" /></div>
            {{-- <h1>404</h1> --}}
            <h4>Work In Progess...</h4>
            <h5>Sorry for the inconvenience our website is currently offline.</h5>
            {{-- <a href="{{ url('/')}}" class="back-btn"><span><i class="fa fa-long-arrow-left" aria-hidden="true"></i>
               --}}
        </div>
    </div>
</div>
@include('front.includes.footer')