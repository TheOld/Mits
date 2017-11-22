/**
 * find n number of closest marker
 * based on passed markers list
 *
 */
exports.findLimitedClosest = function(point, markers, numberOfResults) {
	const closest = [];
	for (var i = 0; i < markers.length; i++) {
		// create new google point using dealer position
		const dealer = new google.maps.LatLng(markers[i].position.lat, markers[i].position.lng);
		// add a distance object in the dealer object
		markers[i].distance = google.maps.geometry.spherical.computeDistanceBetween(point, dealer);
		// store updated marker
		closest.push(markers[i]);
	}
	// sort the array by distance (ASC)
	closest.sort(sortByDist);

	// return only the top n elements
	return closest.splice(0, numberOfResults);
};

/**
 * utils to sort by distance
 *
 */
function sortByDist(a, b) {
	return (a.distance - b.distance);
}
