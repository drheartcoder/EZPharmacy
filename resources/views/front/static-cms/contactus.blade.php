<style>.header{background: #fff;background:rgba(255,255,255,1); box-shadow: 0 0 2px rgba(0, 0, 0, 0.24); position: relative;}
    .min-menu li.dash-show{display: block;float: right;}
/* .min-menu li{display: none;}.min-menu li.lang, .min-menu li.call-no-block, .min-menu li.dash-show{display: inline-block;}#dd .dropdown li{display: block;} */
</style>
<div class="container" ng-controller="CMSCtrl" ng-init="module_url = '{{url('/')}}/store_contact_enquiry'">
 <section class="container-fluid simple-page contact-us">
  <div class="row">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <h2 class="text-center"><?php echo (preg_replace('#<[^>]+>#',' ',translation('contact_us')));?></h2>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
          <h3><?php echo (preg_replace('#<[^>]+>#',' ',translation('contact_info')));?></h3>
          <ul>
            <li class="contact-icon contact-phone"><b>+{{$arr_site_settings['site_contact_number'] or '-'}}</b></li>
            <li class="contact-icon contact-email"><b>{{$arr_site_settings['site_email_address'] or '-'}}</b></li>
            <li class="contact-icon contact-location"><b>{{$arr_site_settings['site_address'] or '-'}}</b></li>
          </ul>
          <div class="contact-social">
            <a target="blank" href="{{$arr_site_settings['fb_url'] or 'https://www.facebook.com'}}" class="contact-social-facebook icon-facebook"></a>
            <a target="blank" href="{{$arr_site_settings['twitter_url'] or 'https://twitter.com'}}" class="contact-social-twitter icon-twitter"></a>
           <!--  <a target="blank" href="{{$arr_site_settings['linked_in_url'] or 'https://www.linkedin.com'}}" class="contact-social-linkedin icon-linkedin"></a> -->
            <a target="blank" href="{{$arr_site_settings['instagram_url'] or 'https://www.instagram.com'}}" class="contact-social-instagram icon-instagram"></a>
          </div>

          <div class="contact-us-map">
            <!-- <iframe src="https://maps.google.it/maps?q=<?php echo $arr_site_settings['site_address']; ?>&output=embed"
                    width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe> -->
            <div id="map" style="width: 100%; height: 500px;"></div>

          </div>
          
        </div>
        <div class="col-lg-5 col-md-5 col-sm-6 col-lg-offset-1 col-md-offset-1">
          <h3><?php echo (preg_replace('#<[^>]+>#',' ',translation('send_us_a_message')));?></h3>
          <form name="contactUsForm" name="contactUsForm" ng-submit="contactUsForm.$valid && storeContactEnquiry()" novalidate class="contact-us-form">
            <label for="first-name">
              <div  ng-class="{ 'has-error': contactUsForm.first_name.$touched && contactUsForm.first_name.$invalid }">
                     <input type="text" name="first_name" placeholder="<?php echo (preg_replace('#<[^>]+>#',' ',translation('enter_your_first_name')));?>"
                            ng-model="enquiry.first_name" 
                            ng-maxlength="100"
                            ng-required="true"/>
                     <div class="ng-cloak" ng-messages="contactUsForm.first_name.$error" ng-if="contactUsForm.$submitted || contactUsForm.first_name.$touched">
                        @include('front.includes.message',['maxlength' => 100])
                     </div>
                </div>
            </label>
            {{-- <input type="hidden" name="csrf" value="{{csrf_filed}}"> --}}
            <label for="last-name">
               <div  ng-class="{ 'has-error': contactUsForm.last_name.$touched && contactUsForm.last_name.$invalid }">
                     <input type="text" name="last_name" placeholder="<?php echo (preg_replace('#<[^>]+>#',' ',translation('enter_your_last_name')));?>" 
                            ng-model="enquiry.last_name" 
                            ng-maxlength="100" 
                            ng-required="true" />
                     <div class="ng-cloak" ng-messages="contactUsForm.last_name.$error" ng-if="contactUsForm.$submitted || contactUsForm.last_name.$touched">
                        @include('front.includes.message',['maxlength' => 100]) 
                     </div>
                  </div>
            </label>
            <label for="email">
              <div  ng-class="{ 'has-error': contactUsForm.email.$touched && contactUsForm.email.$invalid }">
                     <input type="email" name="email" placeholder="<?php echo (preg_replace('#<[^>]+>#',' ',translation('enter_your_email_address')));?>" 
                            ng-model="enquiry.email"
                            ng-required="true" />
                     <div class="ng-cloak" ng-messages="contactUsForm.email.$error" ng-if="contactUsForm.$submitted || contactUsForm.email.$touched">
                        @include('front.includes.message') 
                     </div>
                  </div>
            </label>
            <label for="number">
              <div  ng-class="{ 'has-error': contactUsForm.phone.$touched && contactUsForm.phone.$invalid }">
                     <input type="text" name="phone" placeholder="<?php echo (preg_replace('#<[^>]+>#',' ',translation('enter_your_phone_number')));?>"
                            ng-model="enquiry.phone"
                            numbers-only
                            ng-pattern="/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/" 
                            ng-minlength="6"
                            ng-maxlength="16"
                            ng-required="true" />
                            <?php 
                            $invalid_number= translation("must_be_a_valid_phone_number");
                            ?>
                     <div class="ng-cloak" ng-messages="contactUsForm.phone.$error" ng-if="contactUsForm.$submitted || contactUsForm.phone.$touched">
                        @include('front.includes.message',['maxlength' => 6 , 'minlength' => 10 ,'pattern' => "$invalid_number"])
                     </div>
                  </div>
            </label>
            <label for="message">
              <div  ng-class="{ 'has-error': contactUsForm.message.$touched && contactUsForm.message.$invalid }">
                     <textarea rows="" cols="" name="message" placeholder="<?php echo (preg_replace('#<[^>]+>#',' ',translation('enter_your_message')));?>" 
                                 ng-model="enquiry.message" 
                                 ng-maxlength="1000"
                                 ng-required="true"
                                 ></textarea>
                     <div class="ng-cloak"  ng-messages="contactUsForm.message.$error" ng-if="contactUsForm.$submitted || contactUsForm.message.$touched">
                        @include('front.includes.message',['maxlength' => 1000 ]) 
                     </div>
                  </div>
            </label>
            <input type="submit" value="<?php echo (preg_replace('#<[^>]+>#',' ',translation('send_message')));?>">
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
</div>
<script src="//maps.google.com/maps/api/js?key=AIzaSyCccvQtzVx4aAt05YnfzJDSWEzPiVnNVsY&libraries=places" type="text/javascript"></script>
    <script type="text/javascript" src="https://cdn.rawgit.com/googlemaps/v3-utility-library/master/markerclustererplus/src/markerclusterer.js"></script>
    <script>
    var locations = [];
    locations = [
    <?php  
          $lat = isset($arr_site_settings['latitude'])?$arr_site_settings['latitude']:'' ;
          $long = isset($arr_site_settings['longitude'])?$arr_site_settings['longitude']:'' ;
    ?>
                ['<div class="col-sm-12 col-sm-12 col-lg-12"><?php echo $arr_site_settings['site_address']; ?></div>',<?php echo $arr_site_settings['latitude'];?>,<?php echo $arr_site_settings['longitude']; ?>],

    ];
      var defaultLat ='<?php echo $lat; ?>';
      var defaultLng ='<?php echo $long; ?>';
      // var defaultLat = -31.563910;
      // var defaultLng = 147.154312;
      var _address   = '';
      var map;       
      var mc;/*marker clusterer*/
      var mcOptions = {
              gridSize: 20,
              maxZoom: 7,
              zoom:12,
              imagePath: "https://cdn.rawgit.com/googlemaps/v3-utility-library/master/markerclustererplus/images/m",
          };
      /*global infowindow*/
      var infowindow = new google.maps.InfoWindow();
      /*geocoder*/

      var _address = _address;
      mapInitialize(defaultLat, defaultLng,_address);
      function createMarker(latlng,text)
      {
        var marker = new google.maps.Marker({
            position: latlng,
            map: map,
            icon: "{{url('')}}/front-assets/images/map-marker.png"
        });
        /*get array of markers currently in cluster*/
        var allMarkers = mc.getMarkers();
         
        /*check to see if any of the existing markers match the latlng of the new marker*/
        if (allMarkers.length != 0) {
          for (i=0; i < allMarkers.length; i++) {
            var existingMarker = allMarkers[i];
            var pos = existingMarker.getPosition();
            if (latlng.equals(pos)) {
              text = text + " " + locations[i][0];
            }
          }
        }

         google.maps.event.addListener(marker, 'click', function(){
            infowindow.close();
            infowindow.setContent(text);
            infowindow.open(map,marker);
        });
        mc.addMarker(marker);
        return marker;
      }

      function mapInitialize(lat,lng,_address)
      {
        var geocoder = new google.maps.Geocoder(); 
         geocoder.geocode( { 'address': _address}, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
              /*map.setCenter(results[0].geometry.location);*/
              map.setOptions({ maxZoom: 15 });
              map.fitBounds(results[0].geometry.viewport);
            }
          });

          var options = {
              zoom      : 12,
              center    : new google.maps.LatLng(lat,lng), 
              mapTypeId : google.maps.MapTypeId.ROADMAP,
              zoomControlOptions: {
                         position: google.maps.ControlPosition.LEFT_TOP
                         //position: google.maps.ControlPosition.LEFT_CENTER
                         //position: google.maps.ControlPosition.RIGHT_CENTER
                         
              },
              streetViewControlOptions: {
                         position: google.maps.ControlPosition.LEFT_TOP
              },
              fullscreenControl: true,
              //scrollwheel: false,
          };
          map = new google.maps.Map(document.getElementById('map'), options); 

          /*marker cluster*/
          var gmarkers = [];
          mc = new MarkerClusterer(map, [], mcOptions);
          for (i=0; i<locations.length; i++)
          {
              var latlng = new google.maps.LatLng(parseFloat(locations[i][1]),parseFloat(locations[i][2]));                
              gmarkers.push(createMarker(latlng,locations[i][0]));
          }
          
          console.log(gmarkers);
      }
    </script>



