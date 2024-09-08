<style type="text/css">
    
</style>
<?php
$_action = app('request')->route()->getAction(); 
$isController = class_basename($_action['controller']);
$expl = explode('@',$isController);
$isActiveDashboard = $isActiveAccount = $isActiveAddressBook = $isActiveMyOrders = $isActiveOrderTracking = $isActiveCreateDocument = $isActiveWallet = '';
switch($isController)
{
    case 'UserController@dashboard':
        $isActiveDashboard = 'acti active-class _icon_home-active';
    break;
    case 'UserController@account':
        $isActiveAccount = 'acti _icon_settings-active';
    break;
    case 'UserController@my_wallet':case 'UserController@wallet_checkout':
        $isActiveWallet = 'acti _icon_wallet-active';
    break;
    case 'UserController@address_book':
        $isActiveAddressBook = 'acti _icon_address-book-active';
    break;
    case 'UserController@my_orders':
        $isActiveMyOrders = 'acti _icon_order-active';
    break;
    case 'UserController@order_tracking':
        $isActiveOrderTracking = 'acti traking-image-active';
    break;
    case 'UserController@create_document':case 'UserController@printing_options':case 'UserController@printing_options_edit':case 'UserController@my_cart':case 'UserController@order_checkout':case 'UserController@file_preview':
        $isActiveCreateDocument = 'acti create-image-active';
    break;
    
}

?>
<!-- <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <ul class="create-menu">
        <li><a href="{{url('').'/user/dashboard/'}}"><i class="icon-image icon-home {{$isActiveDashboard}}"></i><span><?php echo (preg_replace('#<[^>]+>#',' ',translation('dashboard')));?></span></a></li>
        <li><a href="{{url('').'/user/account/'}}"><i class="icon-settings {{$isActiveAccount}}"></i><span><?php echo (preg_replace('#<[^>]+>#',' ',translation('account_settings')));?></span></a></li>
        <li><a href="{{url('').'/user/my-wallet/'}}"><i class="icon-wallet {{$isActiveWallet}}"></i><span><?php echo (preg_replace('#<[^>]+>#',' ',translation('my_wallet')));?></span></a></li>
        <li><a href="{{url('').'/user/address-book/'}}"><i class="icon-address-book {{$isActiveAddressBook}}"></i><span><?php echo (preg_replace('#<[^>]+>#',' ',translation('my_address_book')));?></span></a></li>
        <li><a href="{{url('').'/user/my-orders/'}}"><i class="icon-order {{$isActiveMyOrders}}"></i><span><?php echo (preg_replace('#<[^>]+>#',' ',translation('my_orders')));?></span></a></li>
        <li class="create-menu-active {{$isActiveCreateDocument}}"><a href="{{url('').'/user/create-document/'}}"><i class="icon-create-document"></i><span><?php echo (preg_replace('#<[^>]+>#',' ',translation('create_document')));?></span></a>
        </li>
      </ul>
</div> -->

<div class="col-xs-12 col-sm-4 col-md-3">
    <div class="left-bar">
        <div class="menu-bx">
            <ul class="create-menu">
                <li> <a class="_icon_image dashboard-image {{$isActiveDashboard}}" href="{{url('').'/user/dashboard/'}}"><?php echo (preg_replace('#<[^>]+>#',' ',translation('dashboard')));?></a> </li>
                <li> <a class="_icon_image account-image {{$isActiveAccount}}" href="{{url('').'/user/account/'}}"><?php echo (preg_replace('#<[^>]+>#',' ',translation('account_settings')));?></a></li>
                <li> <a class="_icon_image wallet-image {{$isActiveWallet}}" href="{{url('').'/user/my-wallet/'}}"><?php echo (preg_replace('#<[^>]+>#',' ',translation('my_wallet')));?></a></li>
                <li> <a class="_icon_image address-image {{$isActiveAddressBook}}" href="{{url('').'/user/address-book/'}}"><?php echo (preg_replace('#<[^>]+>#',' ',translation('my_address_book')));?></a></li>
                <li> <a class="_icon_image order-image {{$isActiveMyOrders}}" href="{{url('').'/user/my-orders/'}}"><?php echo (preg_replace('#<[^>]+>#',' ',translation('my_orders')));?></a></li>
                <!-- <li> <a class="icon-image traking-image {{$isActiveOrderTracking}}" href="{{url('').'/user/order-tracking/'}}"><?php echo (preg_replace('#<[^>]+>#',' ',translation('order_traking')));?></a></li> -->
                <li> <a class="_icon_image create-image {{$isActiveCreateDocument}}" href="{{url('').'/user/create-document/'}}"><?php echo (preg_replace('#<[^>]+>#',' ',translation('create_document')));?></a></li>
            </ul>
        </div>
    </div>
</div>