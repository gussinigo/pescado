<?php 
	$id=$_REQUEST['id'];
	//$url='http://guss.me/elbuenpescado/mapa/php.php?id='.$id;
	
	if($id == '0'){
		$cliente = '0';
		$dir = 'Cancun - Quintana Roo';
		$lat = '21.145893';
		$lng = '-86.849564';
		$type = 'restaurant';
		
	} else {
		$cliente = $_REQUEST['clie'];
		$dir = $_REQUEST['dir'];
		$lat = $_REQUEST['lat'];
		$lng = $_REQUEST['lng'];
		$type = $_REQUEST['type'];
	}

	$url = 'marker.php?id='.$id.'&clie='.$cliente.'&dir='.$dir.'&lat='.$lat.'&lng='.$lng.'&type='.$type;
	
?>
<!DOCTYPE html >
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>Using MySQL and PHP with Google Maps</title>
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
    </style>
  </head>

<html>
  <body>
    <div id="map"></div>

    <script>
	  
	  let map;
	  // define global array to store markers added
	  let markersArray = []; 
	  
      /*var customLabel = {
        restaurant: {
          label: 'R'
        },
        bar: {
          label: 'B'
        }
      };*/
      
      function addMarker(latLng) {
	    let marker = new google.maps.Marker({
	        map: map,
	        position: latLng,
	        draggable: false
	    });
	
	    //store the marker object drawn on map in global array
	    //markersArray.push(marker);
	    
	    marker.setMap(map);
	    
	  }

    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: new google.maps.LatLng(21.145893, -86.849564),
          zoom: 15
        });
        
         map.addListener('click', function(e) {
		    console.log(e);
		    addMarker(e.latLng);
		    
		   var coord = e.latLng;
		   //var lat = coord.spli
		   
		   alert(coord);
		    
		  });
	  
        
        /*var infoWindow = new google.maps.InfoWindow;

          // Change this depending on the name of your PHP or XML file
          downloadUrl("<?php echo $url;?>", function(data) {
            var xml = data.responseXML;
            var markers = xml.documentElement.getElementsByTagName('marker');
            Array.prototype.forEach.call(markers, function(markerElem) {
              var id = markerElem.getAttribute('id');
              var name = markerElem.getAttribute('name');
              var address = markerElem.getAttribute('address');
              var type = markerElem.getAttribute('type');
              var point = new google.maps.LatLng(
                  parseFloat(markerElem.getAttribute('lat')),
                  parseFloat(markerElem.getAttribute('lng')));

              var infowincontent = document.createElement('div');
              var strong = document.createElement('strong');
              strong.textContent = name
              infowincontent.appendChild(strong);
              infowincontent.appendChild(document.createElement('br'));

              var text = document.createElement('text');
              text.textContent = address
              infowincontent.appendChild(text);
              var icon = customLabel[type] || {};
              var marker = new google.maps.Marker({
                map: map,
                position: point,
                label: icon.label
              });
              marker.addListener('click', function() {
                infoWindow.setContent(infowincontent);
                infoWindow.open(map, marker);
              });
            });
          });*/
    }



      /*function downloadUrl(url, callback) {
        var request = window.ActiveXObject ?
            new ActiveXObject('Microsoft.XMLHTTP') :
            new XMLHttpRequest;

        request.onreadystatechange = function() {
          if (request.readyState == 4) {
            request.onreadystatechange = doNothing;
            callback(request, request.status);
          }
        };

        request.open('GET', url, true);
        request.send(null);
      }

      function doNothing() {
	      
      }*/
    </script>
    <script defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgfqMkcAEfDkk98au3YGdchBNkBYyrHUw&callback=initMap">
    </script>
  </body>
</html>