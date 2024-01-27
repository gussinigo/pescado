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
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
  <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
  <title></title>
  <style>
    #map {
      height: 100%;
    }
    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
    }	
  </style>
  
  
  
</head>
<body>
  <div id="map"></div>
  <script>
  let map;
  let markers = [];
  
  // define global array to store markers added
  var markersArray = []; 
  
  var customLabel = {
        restaurant: {
          label: 'R'
        },
        bar: {
          label: 'B'
        }
      };

  
  // define function to add marker at given lat & lng
  function addMarker(latLng) {
	var infoWindow = new google.maps.InfoWindow;
	
	var id = '1';
    var name = 'cliente prueba';
    var address = 'Sm 25';
    var type = 'restaurant';
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
        position: latLng,
        label: icon.label,
        draggable: false
    });
    
    marker.addListener('click', function() {
            infoWindow.setContent(infowincontent);
            infoWindow.open(map, marker);
            if(confirm("Desea eliminar el marcador?")){
	           marker.setMap(null);
            }
            
          });

    //store the marker object drawn on map in global array
    //markersArray.push(marker);
    
    
              
    marker.setMap(map);
    
  }
  
  /*function clearMarkers() {
	  var mapa = document.getElementById('map');
	  var markers = mapa.getElementsByTagName('marker')
	  console.log(markers);
	  for (let i = 0; i < markers.length; i++) {
	    markers[i].setMap(null);
	  }
	  markers = [];
  }*/
  
    function setMapOnAll(map) {
     console.log(markers.length);
     console.log(markers);
	  for (let i = 0; i < markers.length; i++) {
	    markers[i].setMap(map);
	    
	  }
	  
	  
	  
	} // Removes the markers from the map, but keeps them in the array.
	
	function clearMarkers() {
	  setMapOnAll(null);
	} // Shows any markers currently in the array.
	
	function showMarkers() {
	  setMapOnAll(map);
	} // Deletes all markers in the array by removing references to them.
	
	function deleteMarkers() {
	//alert("entra");
	  clearMarkers();
	  markers = [];
	}
  
  function initMap() {
	  map = new google.maps.Map(document.getElementById('map'), {
          center: new google.maps.LatLng(21.145893, -86.849564),
          zoom: 15
        });
	
	  map.addListener('click', function(e) {
	    console.log(e);
	    //clearMarkers();
	    
	    //deleteMarkers();
	    
	    addMarker(e.latLng);
	    
	   var coord = e.latLng;
	   //var lat = coord.spli
	   
	   alert(coord);
	   
	 
	    
	  });
	  
	  var infoWindow = new google.maps.InfoWindow;

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
            if(confirm("Desea eliminar el marcador?")){
	           marker.setMap(null);
            }
            
          });
        });
        
        
        
      });
	  
	  //console.log(map);
	  
	  
	
   }
   
   function downloadUrl(url, callback) {
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
    
    function doNothing() {}
   
  
</script>
  <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgfqMkcAEfDkk98au3YGdchBNkBYyrHUw&callback=initMap">
  </script>
</body>
</html>