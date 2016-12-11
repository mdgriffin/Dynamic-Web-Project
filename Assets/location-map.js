var initMap = (function () {

	var map;
	var locationListEl = document.getElementById("locations-list");
	var venueCardEl = document.getElementById("locations-map-venue");

	locationListEl.addEventListener("click", function (e) {
		var venueID;
		var locationIndex;
		var foundIndex = false;

		for (var  i = 0; i < e.path.length; i++) {
			if (e.path[i].dataset && e.path[i].dataset.venueId) {
				venueID = e.path[i].dataset.venueId;
				break;
			}
		}

		if (venueID) {
			for (var j = 0; j < globs.locations.length; j++) {
				if (globs.locations[j].id == venueID) {
					locationIndex = j;
					foundIndex = true;
				}
			}

			if (foundIndex) {
				map.setZoom(12);
				map.setCenter(globs.locations[locationIndex].latlng);
			}

			loadVenueCard(locationIndex);
		}

	});

	var loadVenueCard = function (locationIndex) {
		httpRequest = new XMLHttpRequest();

		httpRequest.onreadystatechange = function(){
			if (httpRequest.readyState === XMLHttpRequest.DONE && httpRequest.status === 200) {
				addClass(venueCardEl, "locations-map-venue-visible");
				venueCardEl.innerHTML = httpRequest.responseText;
			}
		};

		httpRequest.open('GET', "venues/card/" + globs.locations[locationIndex].id, true);
		httpRequest.send(null);
	};

	var initMap = function () {

		map = new google.maps.Map(document.getElementById('map'), {
			zoom: 8,
			center: {lat: 53.3, lng: -8}
		});

		map.addListener("dragend", function (e) {
			removeClass(venueCardEl, "locations-map-venue-visible");
		});

		for (var i = 0; i < globs.locations.length; i++) {
			globs.locations[i].marker = new google.maps.Marker({
				position: globs.locations[i].latlng,
				map: map
			});

			(function () {
				var j = i;

				globs.locations[i].marker.addListener('click', function(e) {
					map.setZoom(12);
					map.setCenter(e.latLng);

					loadVenueCard(j);
				});
			})();
		}

	};

	return initMap;

})();
