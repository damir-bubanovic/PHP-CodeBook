<?php 
/*

!!PRINT ARRAY TO STRING with COMMAS!!

*count - count all elements in an array, or something in an object
*reset - set the internal pointer of an array to its first element
*implode - join array elements with a string
*array_pop - pop the element off the end of array

*/

$myArray = array(
	'Tabitha',
	'Micika',
	'Veljkica',
	'Judith'
);


function array_to_comma_string($array) {
	switch(count($array)) {
		case 0:
			return '';
			break;
		case 1:
			return reset($array);
			break;
		case 2:
			return implode(' and ', $array);
			break;
		default:
			$last = array_pop($array);
			return join(', ', $array) . ' and ' . $last;
	}
}

print array_to_comma_string($myArray);
// Tabitha, Micika, Veljkica and Judith

?>