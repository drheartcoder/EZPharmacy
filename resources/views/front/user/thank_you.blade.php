@include('front.user._inner-breadcrumbs')
<!-- CONTENT BEGIN -->
<section class="container simple-page">
  <div class="row">
    <!-- MENU BEGIN -->
    <div>
        @include('front.user.left-navigation')
    </div>
    <!-- MENU BEGIN -->
    <!-- THANK YOU BEGIN -->
    <div class="col-md-8 col-md-8 col-sm-8 col-xs-12 col-lg-offset-1 thank-you">
      <div class="thank-you-flex">
        <h2><?php echo  (preg_replace('#<[^>]+>#',' ',translation('pthank_youp')));?></h2>
        <p><?php echo  (preg_replace('#<[^>]+>#',' ',translation('pyour_order_is_acceptedp')));?><p><?php echo  (preg_replace('#<[^>]+>#',' ',translation('pour_specialist_will_contact_you_as_soon_as_possiblep')));?>
        </p>
        <a href="{{url('/')}}/user/my-orders/" class="thank-you-flex-button"><?php echo  (preg_replace('#<[^>]+>#',' ',translation('pokp')));?></a>
      </div>
    </div>
    <!-- THANK YOU EOF -->
  </div>
</section>
<!-- CONTENT EOF -->
