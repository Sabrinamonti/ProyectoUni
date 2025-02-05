<?php 
	include("conectar.php");
 
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Travel Modes in Directions</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBAbPcvthtv1DfSKI0cmwf_P1SHgzPfPQ4&callback=initMap&libraries=&v=weekly"
      defer
    ></script>
    <style type="text/css">
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 60%;
        width: 60%;
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
        text-align: left;
        font-family: "Roboto", "sans-serif";
        line-height: 30px;
        padding-left: 10px;
      }
    </style>
    <script>
      function initMap() {
      	
        const directionsRenderer = new google.maps.DirectionsRenderer();
        const directionsService = new google.maps.DirectionsService();
        const map = new google.maps.Map(document.getElementById("map"), {
          zoom: 5,
          center: { lat: 37.77, lng: -122.447 },
        });
        directionsRenderer.setMap(map);
        calculateAndDisplayRoute(directionsService, directionsRenderer);
        document.getElementById("mode").addEventListener("change", () => {
          calculateAndDisplayRoute(directionsService, directionsRenderer);
        });
      }

      function calculateAndDisplayRoute(directionsService, directionsRenderer) {
        const selectedMode = document.getElementById("mode").value;
        if(!! navigator.geolocation)
        {
        	navigator.geolocation.getCurrentPosition(function(position) 
        	{
        		var geolocate= new google.maps.LatLng(position.coords.latitude, position.coords.longitude);

        		const origin1 = { lat: -17.385517, lng:  -66.148681};
        		const bounds = new google.maps.LatLngBounds();
        		const markersArray = [];
        		const geocoder = new google.maps.Geocoder();
        		const service = new google.maps.DistanceMatrixService();
        		directionsService.route(
          		{

            		origin: origin1,
            		destination: geolocate,
            		travelMode: google.maps.TravelMode[selectedMode],
          		},
          		(response, status) => {
            		if (status == "OK") {
              		directionsRenderer.setDirections(response);
            		} else {
              		window.alert("Directions request failed due to " + status);
            		}
          		}
        		);
        		service.getDistanceMatrix(
          {
            origins: [origin1],
            destinations: [geolocate],
            travelMode: google.maps.TravelMode.DRIVING,
            unitSystem: google.maps.UnitSystem.METRIC,
            avoidHighways: false,
            avoidTolls: false,
          },
          (response, status) => {
            if (status !== "OK") {
              alert("Error was: " + status);
            } else {
              const originList = response.originAddresses;
              const destinationList = response.destinationAddresses;
              const outputDiv = document.getElementById("output");
              outputDiv.innerHTML = "";
              deleteMarkers(markersArray);

              const showGeocodedAddressOnMap = function (asDestination) {
                const icon = asDestination ? destinationIcon : originIcon;

                return function (results, status) {
                  if (status === "OK") {
                    map.fitBounds(bounds.extend(results[0].geometry.location));
                    markersArray.push(
                      new google.maps.Marker({
                        map,
                        position: results[0].geometry.location,
                        icon: icon,
                      })
                    );
                  } else {
                    alert("Geocode was not successful due to: " + status);
                  }
                };
              };

              for (let i = 0; i < originList.length; i++) {
                const results = response.rows[i].elements;
                geocoder.geocode(
                  { address: originList[i] },
                  showGeocodedAddressOnMap(false)
                );

                for (let j = 0; j < results.length; j++) {
                  geocoder.geocode(
                    { address: destinationList[j] },
                    showGeocodedAddressOnMap(true)
                  );
                  outputDiv.innerHTML +=
                    originList[i] +
                    " to " +
                    destinationList[j] +
                    ": " + "<br> La Distancia es: " +
                    results[j].distance.text +
                    " <br> El tiempo que tarda es: " +
                    results[j].duration.text +
                    "<br>";
                }
              }
            }
          }
        ); 

        		
    		});
    	}
      }
    </script>
  </head>
  <body>
    <div id="floating-panel">
      <b>Mode of Travel: </b>
      <select id="mode">
        <option value="DRIVING">Driving</option>
        <option value="WALKING">Walking</option>
        <option value="BICYCLING">Bicycling</option>
        <option value="TRANSIT">Transit</option>
      </select>
    </div>
    <div id="map"></div>
    <div id="output"></div>
  </body>
</html>