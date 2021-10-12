<!DOCTYPE html>
<html>
  <head>
    <title>Crm Agent Location</title>
    <style type="text/css">
/* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
#map {
  height: 70%;
   width: 70%;
}

/* Optional: Makes the sample page fill the window. */
html,
body {
  height: 100%;
  margin: 0;
  padding: 0;
}
    </style> 
  </head>
  <body>
      
     
                    
                       
                         
                       
           
   

    <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB6H8hQk3SFfZtO6PKJVwxosmUNnljmKws&callback=initMap&libraries=&v=weekly"
      async
    ></script>
    <div id="map"></div>
    @foreach($location as $location)
   
    @endforeach
  
    <?php 
$lati=$location->latitude;
$longi=$location->longitude;



?>
  </body>
  <script type="text/javascript">
function initMap() {
  const myLatlng = { lat:<?php echo $lati;?> ,lng: <?php echo $longi;?> };
  const map = new google.maps.Map(document.getElementById("map"), {
    zoom: 16,
    center: myLatlng,
    //center: e,
  });
  // Create the initial InfoWindow.
  let infoWindow = new google.maps.InfoWindow({
    content: "Click the map to get Lat/Lng!",
    position: myLatlng,
  });
  infoWindow.open(map);
  // Configure the click listener.
  map.addListener("click", (mapsMouseEvent) => {
    // Close the current InfoWindow.
    infoWindow.close();
    // Create a new InfoWindow.
    infoWindow = new google.maps.InfoWindow({
      position: mapsMouseEvent.latLng,
    });
    infoWindow.setContent(
      JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2)
    );
    infoWindow.open(map);
  });
}
  </script>
</html>