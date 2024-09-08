<style>
    .header {
        background: #fff;
        background: rgba(255, 255, 255, 1);
        box-shadow: 0 0 2px rgba(0, 0, 0, 0.24);
        position: relative;
    }
    
    /*.min-menu li {
        display: none;
    }
    
    .min-menu li.lang,    
    .min-menu li.dash-show {
        display: inline-block;
    }
    
    #dd .dropdown li {
        display: block;
    }*/
</style>
<!-- <div class="banner-block-inner help-banner-block">
    <div class="about-overlay"></div>
    <div class="container main-content-head">
        <div class="row">
            <div class="col-sm-6 col-md-6 col-lg-6">
                <div class="page-head-block">
                    <?php if($breadcrumbTitle != ''){ echo $breadcrumbTitle; } else { echo ''; } ?>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-6">
                <div class="bread-cum-block">
                    <ul>

                        @if(\Request::segment(2) != 'dashboard')
                        <li><a href="{{url('').'/user/dashboard/'}}"><?php echo (preg_replace('#<[^>]+>#',' ',translation('dashboard')));?></a></li>
                        @endif

                        <li><?php if($breadcrumbTitle != ''){ echo $breadcrumbTitle; } else { echo ''; } ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div> -->
