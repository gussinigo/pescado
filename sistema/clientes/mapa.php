<?php 
	$id= $_REQUEST['id'];
	//$url='http://guss.me/elbuenpescado/mapa/php.php?id='.$id;
	
	/*if($id == '0'){
		$cliente = '0';
		$dir = 'Cancun - Quintana Roo';
		$lat = '21.145893';
		$lng = '-86.849564';
		$type = 'restaurant';
		
	} else {*/
		/*$cliente = $_REQUEST['clie'];
		$dir = $_REQUEST['dir'];
		$lat = $_REQUEST['lat'];
		$lng = $_REQUEST['lng'];
		$type = $_REQUEST['type'];*/
	//}
	
	
		/*$sql = "select * from clientes where idcliente = ".$id;
		$res = mysqli_query($link, $sql);
		$row = mysqli_fetch_array($res);*/

	$url = 'marker.php?id='.$id; //'&clie='.$cliente.'&dir='.$dir.'&lat='.$lat.'&lng='.$lng.'&type='.$type;
	
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Removing Markers</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>

    <style type="text/css">
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }

      /* Optional: Makes the sample page fill the window. */
      html,
      body {
        height: 100%;
        margin: 0;
        padding: 0;
      }

      #floating-panel {
        position: absolute;
        top: 10px;
        left: 25%;
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
        text-align: center;
        font-family: "Roboto", "sans-serif";
        line-height: 30px;
        padding-left: 10px;
      }
    </style>
    <script>
      "use strict";

      // In the following example, markers appear when the user clicks on the map.
      // The markers are stored in an array.
      // The user can then click an option to hide, show or delete the markers.
      let map;
      let markers = [];
      let contador = 0;
      
      var customLabel = {
        restaurant: {
          label: 'R'
        },
        bar: {
          label: 'B'
        }
      };

     function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: new google.maps.LatLng(21.145893, -86.849564),
          zoom: 15
        }); // This event listener will call addMarker() when the map is clicked.

        map.addListener('click', function(e) {
		    //console.log(e);
		    
		   // if(contador > 0){
			 //   alert('Favor de eliminar el marcador anterior...');
		    //} else {
			    deleteMarkers();
		    
				addMarker(e.latLng);
		    //}
		    
		    
		   var coord = e.latLng;
		   //var lat = coord.spli
		   
		   /*alert(coord.lat());
		   alert(coord.lng());*/
		   
		   $('#txtlat').val(coord.lat());
		   $('#txtlong').val(coord.lng());
		   
		   
		   
		 
		    
		});
		
		
		var infoWindow = new google.maps.InfoWindow;
		//var contador = 0;
		downloadUrl("<?php echo $url;?>", function(data) {
	        var xml = data.responseXML;
	        //console.log(xml);
	        var markers = xml.documentElement.getElementsByTagName('marker');
	        Array.prototype.forEach.call(markers, function(markerElem) {
	          var id = markerElem.getAttribute('id');
	          var name = markerElem.getAttribute('name');
	          var address = markerElem.getAttribute('address');
	          var type = markerElem.getAttribute('type');
	         // alert(markerElem.getAttribute('lat'));
	          //alert(markerElem.getAttribute('lng'));
	          var point = new google.maps.LatLng(
	              parseFloat(markerElem.getAttribute('lat')),
	              parseFloat(markerElem.getAttribute('lng')));
	              
	         // alert(point);
	
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
	            label: icon.label,
	            draggable: false
	          });
	          marker.addListener('click', function() {
	            infoWindow.setContent(infowincontent);
	            infoWindow.open(map, marker);
	            	    
	            if(confirm("Desea eliminar el marcador?")){
		           marker.setMap(null);
		           //console.log(marker.position);
		           //contador = 0;
	            }
	            
	          });
	          
	          contador++;
	          
	        });
	        
	        
	        
	      });
		  
		  
		
		  
      } // Adds a marker to the map and push to the array.

      function addMarker(location) {
	    var infoWindow = new google.maps.InfoWindow;
		var id = $("#hdnid").val();
	    var name = $("#txtcliente").val();
	    var address = 'SM ' + $("#txtsmz").val();
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
	        position: location,
	        label: icon.label,
	        icon: 'http://maps.google.com/mapfiles/ms/icons/green-dot.png',
	        draggable: false
	    });
        
        
        marker.addListener('click', function() {
            infoWindow.setContent(infowincontent);
            infoWindow.open(map, marker);
            if(confirm("Desea eliminar el marcador?")){
	           marker.setMap(null);
	           contador = 0;
            }
            
          });
          
          markers.push(marker);
        
      } // Sets the map on all markers in the array.

      function setMapOnAll(map) {
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
	      //alert("lo hace")
        clearMarkers();
        markers = [];
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
  </head>
  <body>
    
    <div id="map"></div>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgfqMkcAEfDkk98au3YGdchBNkBYyrHUw&callback=initMap">
  </script>
  </body>
</html>