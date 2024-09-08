<style>.header{ box-shadow: 0 0 2px rgba(0, 0, 0, 0.24); position: relative;}
    .min-menu li.dash-show{display: none;}
/*    .min-menu li{display: none;}.min-menu li.lang, .min-menu li.call-no-block, .min-menu li.dash-show{display: inline-block;}#dd .dropdown li{display: block;}*/
</style>
<div class="banner-block-inner">
   <div class="about-overlay"></div>
   <div class="container main-content-head">
      <div class="row">
         <div class="col-sm-6 col-md-6 col-lg-6">
            <div class="page-head-block">
   
              <?php if($pageTitle != ''){ echo $pageTitle; } else { echo ''; } ?>
            </div>
         </div>
         <div class="col-sm-6 col-md-6 col-lg-6">
            <div class="bread-cum-block">
               <ul>
                  <li><a href="{{url('')}}"><?php echo (preg_replace('#<[^>]+>#',' ',translation('home')));?></a></li>
                  <li><?php if($pageTitle != ''){ echo $pageTitle; } else { echo ''; } ?></li>
               </ul>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="container">

   {{-- <div class="privacy-point-head">
      Commitment To Privacy
   </div>
   <div class="privacy-point-content">
      You acknowledge that all content included on this Site, including, without limitation, the information, data, software, photographs, graphs, typefaces, graphics, images, illustrations, maps, designs, icons, written and other material and compilations (collectively, "Content") are intellectual property and copyrighted works of Digital Room, Inc., its licensees, and/or various third-party providers ("Providers"). Reproductions or storage of Content retrieved from this Site, in all forms, media and technologies now existing or hereafter developed, is subject to the U.S. Copyright Act of 1976, Title 17 of the United States Code. Except where expressly provided otherwise by us, nothing made available to users via the Site may be construed to confer any license or ownership right in or materials published or otherwise made available through the Site or its services, whether by estoppel, implication, or otherwise. All rights not granted to you in the Terms &amp; Conditions are expressly reserved by us.
   </div> --}}
   
     {!! $description !!}
</div>