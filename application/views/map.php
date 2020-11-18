<!DOCTYPE html>
<html>
  <head>
    <title>กรมสุขภาพจิต</title>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }

      #map {
        height: 100%;
        width: 100%;
      }
    </style>
  </head>
  <body>
    <div id="map"></div>
    <script>
      var map;
      function initMap() {
       /* map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 13.78489, lng: 100.531214},
          zoom: 16
        });*/

		  var mapOptions = {
			  center: {lat: 13.8483122, lng: 100.5282712},
			  zoom: 16,
			}
				
			var maps = new google.maps.Map(document.getElementById("map"),mapOptions);
			
			var marker = new google.maps.Marker({
			   position: new google.maps.LatLng(13.848793,100.528432),
			   map: maps,
			   title: 'ศูนย์รับเรื่องร้องเรียน กรมสุขภาพจิต'
			});


      }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCemziJZCsszrjlX9kklRcEj4fQ7CK1WbA&callback=initMap"
    async defer></script>
  </body>
</html>