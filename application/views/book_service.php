<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Codeigniter 4 Show Multiple Markers on Google Map Example</title>
	<meta name="description" content="The tiny framework with powerful features">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
	<style>
	  .container {
		max-width: 1000px;
	  }
	  #gmapBlock {
		  width: 100%;
		  height: 450px;
	  }
	</style>
</head>
<body>
<div class="container mt-5">
<div id="gmapBlock"></div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
	$(function() {
			var script = document.createElement('script');
				script.src = "https://maps.googleapis.com/maps/api/js?sensor=false&callback=initialize";
				document.body.appendChild(script);
			});
			
			function initialize() {
			var map;
			var bounds = new google.maps.LatLngBounds();
			var mapOptions = {
				mapTypeId: 'roadmap'
			};
							
			map = new google.maps.Map(document.getElementById("gmapBlock"), mapOptions);
			map.setTilt(45);
			
			var locationMarkers = JSON.parse(`<?php echo ($locationMarkers); ?>`);
			
			var locInfo = JSON.parse(`<?php echo ($locInfo); ?>`);       
				
			var infoWindow = new google.maps.InfoWindow(), marker, i;
			
			for( i = 0; i < locationMarkers.length; i++ ) {
				var position = new google.maps.LatLng(locationMarkers[i][1], locationMarkers[i][2]);
				bounds.extend(position);
				marker = new google.maps.Marker({
					position: position,
					map: map,
					title: locationMarkers[i][0]
				});
				
				google.maps.event.addListener(marker, 'click', (function(marker, i) {
					return function() {
						infoWindow.setContent(locInfo[i][0]);
						infoWindow.open(map, marker);
					}
				})(marker, i));
			
				map.fitBounds(bounds);
			}
			
			var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
				this.setZoom(5);
				google.maps.event.removeListener(boundsListener);
			});
	
	}
</script>
</div>

</body>
</html>