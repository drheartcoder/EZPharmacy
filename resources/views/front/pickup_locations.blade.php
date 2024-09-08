<style>.header{background: #fff;background:rgba(255,255,255,1); box-shadow: 0 0 2px rgba(0, 0, 0, 0.24); position: relative;}
    .min-menu li.dash-show{display: block;float: right;}
/*    .min-menu li{display: none;}.min-menu li.lang, .min-menu li.call-no-block, .min-menu li.dash-show{display: inline-block;}#dd .dropdown li{display: block;}*/
</style>
<!-- CONTENT BEGIN -->
<section class="container simple-page pickup-loc">
  <div class="row">
    <div class="col-xs-12 text-center">
      <h2><?php echo (preg_replace('#<[^>]+>#',' ',translation('ppickup_locationsp')));?></h2>
   
      <div id="map" style="width: 100%; height: 700px;"></div>

    </div>
  </div>
</section>
<!-- CONTENT EOF -->
<script src="//maps.google.com/maps/api/js?key=AIzaSyCccvQtzVx4aAt05YnfzJDSWEzPiVnNVsY&libraries=places" type="text/javascript"></script>
    <script type="text/javascript" src="https://cdn.rawgit.com/googlemaps/v3-utility-library/master/markerclustererplus/src/markerclusterer.js"></script>
    <script>
    var locations = [];
    locations = [
    <?php
            if(count($arr_locations))
            {
                foreach($arr_locations as $row)
                {
                	$lat = $row->latitude;
                	$long = $row->longitude;
            ?>
                ['<div class="col-sm-12 col-sm-12 col-lg-12"><?php echo $row->google_address; ?></div>',<?php echo $row->latitude; ?>,<?php echo $row->longitude; ?>],
            <?php
            }
        }
    ?>
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
              maxZoom: 25,
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
            icon: "../front-assets/images/map-marker.png"
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
              map.setOptions({ maxZoom: 50 });
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
