@include('front.includes.header',['title'=>$pageTitle])
   
	   @include($middleContent,['myData' => $multipleArray])
   
@include('front.includes.footer')