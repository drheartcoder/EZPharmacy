<style>.header{background: #fff;background:rgba(255,255,255,1); box-shadow: 0 0 2px rgba(0, 0, 0, 0.24); position: relative;}
    .min-menu li.dash-show{display: block;float: right;}
/*    .min-menu li{display: none;}.min-menu li.lang, .min-menu li.call-no-block, .min-menu li.dash-show{display: inline-block;}#dd .dropdown li{display: block;}*/
</style>

<div class="container">

   <div class="privacy-point-head">
      <h2 class="text-center"><?php echo $pageTitle;?></h2>
   </div>
   <div class="privacy-point-content">
      <?php echo $description;?>
   </div>
</div>


<script type="text/javascript">
	$("div.privacy-point-content *[style]").removeAttr("style");
</script>