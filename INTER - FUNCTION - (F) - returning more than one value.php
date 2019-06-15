<?php 
/*

!!RETURN MORE THAN ONE VALUE FROM A FUNCTION!!

*min - find lowest value
*max - find highest value
*array_sum - calculate the sum of values in an array
*count - count all elements in an array, or something in an object

*/


/*Return an array and use list() to separate elements*/
function array_stats($values) {
	$min = min($values);
	$max = max($values);
	$mean = array_sum($values) / count($values);

	return array($min, $max, $mean);
}

$values = array(1,3,5,9,13,1442);
list($min, $max, $mean) = array_stats($values);

?>