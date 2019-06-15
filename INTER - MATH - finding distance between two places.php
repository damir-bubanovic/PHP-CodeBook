<?php 
/*

!!FIND DISTANCES BETWEEN TWO PLACES!!

> find the distance between two coordinates on planet Earth

*doubleval - get float value of a variable (*floatval)
*acos - returns the arc cosine of arg in radians
*sin - returns the sine of the arg parameter
*cos - returns the cosine of the arg parameter

*/


/*find the distance between two coordinates on planet Earth*/
function sphere_distance($lat1, $lon1, $lat2, $lon2, $radius = 6378.135) {
	$rad = doubleval(M_PI/180.0);
	
	$lat1 = doubleval($lat1) * $rad;
	$lon1 = doubleval($lon1) * $rad;
	$lat2 = doubleval($lat2) * $rad;
	$lon2 = doubleval($lon2) * $rad;
	
	$theta = $lon2 - $lon1;
	$dist = acos(sin($lat1) * sin($lat2) +
		cos($lat1) * cos($lat2) *
		cos($theta));
	if($dist < 0) { 
		$dist += M_PI; 
	}
	// Default is Earth equatorial radius in kilometers
	return $dist = $dist * $radius;
}

// NY, NY (10040)
$lat1 = 40.858704;
$lon1 = -73.928532;

// SF, CA (94144)
$lat2 = 37.758434;
$lon2 = -122.435126;
$dist = sphere_distance($lat1, $lon1, $lat2, $lon2);

// It's about 2570 miles from NYC to SF
// $formatted is 2570.18
$formatted = sprintf("%.2f", $dist * 0.621); // Format and convert to miles
?>