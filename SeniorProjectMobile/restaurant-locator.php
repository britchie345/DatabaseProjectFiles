<?php	
	session_start();
	include "connection.php";
	include "resources/php/print-functions.php";
	include "resources/php/header.php";
?>

<!DOCTYPE html>

<html lang="en">

	<head>
		
		<meta charset="utf-8" />
		<title>RestaurantApp</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

		<link rel="stylesheet" type="text/css" href="resources/css/restaurantapp.css" />
		<link rel="stylesheet" href="resources/themes/test-theme-1.css" />
		<link rel="stylesheet" href="resources/themes/jquery.mobile.icons.min.css" />
		<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.3/jquery.mobile.structure-1.4.3.min.css" /> 
		<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script> 
		<script src="http://code.jquery.com/mobile/1.4.3/jquery.mobile-1.4.3.min.js"></script>	
		<!-- custom js function file -->
		<script src="resources/js/functions.js"></script>

		<style>
	    	<link rel="stylesheet" type="text/css" href="resources/css/restaurantapp.css"/>
	    </style>
	    <style type="text/css">
#map{
  display: block;
  width: 95%;
  height: 300px;
  margin: 0 auto;
  -moz-box-shadow: 0px 5px 20px #ccc;
  -webkit-box-shadow: 0px 5px 20px #ccc;
  box-shadow: 0px 5px 20px #ccc;
}
</style>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
		<script type="text/javascript" src="resources/js/gmaps.js"></script>
		<script type="text/javascript">
    var map;
    $(document).ready(function()
    {
		map = new GMaps(
		{
			el: '#map',
			lat: 38.327393,
			lng: -75.614104,
			zoomControl : true,
			zoomControlOpt: 
			{
				style : 'SMALL',
				position: 'TOP_LEFT'
			},
			panControl : false,
			streetViewControl : false,
			mapTypeControl: false,
			overviewMapControl: false
		});
      GMaps.geolocate(
      {
        success: function(position)
        {
        	map.drawRoute(
        	{
		        origin: [position.coords.latitude, position.coords.longitude],
		        destination: [38.327393, -75.614104],
		        travelMode: 'driving',
		        strokeColor: '#1AAC9F',
		        strokeOpacity: 0.6,
		        strokeWeight: 8
	      	});
          	map.setCenter(position.coords.latitude, position.coords.longitude);
          	map.addMarker(
          	{
		        lat: position.coords.latitude,
		        lng: position.coords.longitude,
		        icon: 'http://gmapsmarkergenerator.eu01.aws.af.cm/getmarker?scale=1&color=00ffff',
		        title: 'You Are Here',
		        infoWindow: {
		          content: '<p>You Are Here</p>'
		        }
		      });
          	map.fitZoom();
        },
        error: function(error)
        {
        	alert('Geolocation failed: '+error.message);
        },
        not_supported: function()
        {
        	alert("Your browser does not support geolocation");
        },
        always: function()
        {
    		//alert("Done!");
        }
      });
	  map.addMarker(
      {
		lat: 38.327393,
        lng: -75.614104,
        icon: 'http://gmapsmarkergenerator.eu01.aws.af.cm/getmarker?scale=1&color=00ffff',
        title: 'RestaurantApp',
        details: 
        {
          database_id: 42,
          author: 'HPNeo'
        },
        infoWindow: 
        {
          content: '<h1>Restaurant</h1><p>Super Sexy Food Place<ul><li>burgers</li><li>buns</li><li>meat</li></ul><a href="index.php">sexy.com</a></p>'
        },
        click: function(e){
          if(console.log)
            console.log(e);
          //alert('You clicked in this marker');
        },
        mouseover: function(e){
          if(console.log)
            console.log(e);
        }
      });
    });
  </script>
		
	</head>

	<body>
<!-- RESTAURANT LOCATOR PAGE begin... -->
		<div data-role="page" id="restaurant-locator-page" data-url="restaurant-locator-page" class="restaurant-locator-page">
			<div class='page-width'>

				<!-- panel -->
					<?php printPanel("restaurant-locator-panel"); ?>
				<!-- /panel -->

				<?php
					printHeader(3,"restaurant-locator");
				?>
				
			    <h1>Maps</h1>
			    <div id="map"></div>
			        <!-- map loads here... -->
			    </div>

				<!-- Load map assets at bottom for performance -->

				<?php
					include "resources/php/footer.php";
					printFooter(2);
				?>
			</div>
		</div>
<!-- RESTAURANT LOCATOR PAGE end -->
	</body>
</html>