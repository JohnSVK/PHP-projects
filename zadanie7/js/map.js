var map;

var mapType;
var actMap;
var mesta = [];
var aktMesto;

// GeoJSON
var cities = {
  type: 'FeatureCollection',
  features: []
};


function initMap() {

	  var styles = [
	  {
		featureType: "all",
		elementType: "labels",
		stylers: [
		  { visibility: "off" }
		]
	  }
	];

	var styledMap = new google.maps.StyledMapType(styles,
    {name: "Styled Map"});

	var mapOptionsEU = {
			center: { lat: 48.705113, lng: 18.915932},
			zoom: 2,
			disableDefaultUI: true,
			panControl: false,
			zoomControl: false,
			scaleControl: false,
			overviewMapControl: false,
			draggable: true,
			keyboardShortcuts: false,
			maxZoom: 6,
			minZoom: 2,
			scrollwheel: true
        };
	
	actMap = new google.maps.Map(document.getElementById("map"), mapOptionsEU);

	actMap.mapTypes.set('map_style', styledMap);
	actMap.setMapTypeId('map_style');
	
}
/*
function initMap() {
  map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: -34.397, lng: 150.644},
    zoom: 8
  });
}*/

$(document).ready(function(){
	
	  $.ajax({
		 type: 'GET',
		 url: 'http://147.175.98.161/zadanie07/cities.php',
		 dataType: 'json',
		 success: function(msg){
			var json = msg;
			
			if(json.success) {
				
				json.result.cities.forEach(function(city) {
					
					var feature = {
						type: 'Feature',
						geometry: {type: 'Point', coordinates: [parseFloat(city.lng), parseFloat(city.lat)]},
						properties: {name: ''}
					  };
					//console.log(feature);
					
					cities.features.push(feature);
					
					//mesta.push(city);
				});
				
				actMap.data.addGeoJson(cities);
				
			} else {
				//$("#result").html("<br>Nenašiel sa žiadny záznam.");
			}
			
		}});
		
	console.log(cities);
});