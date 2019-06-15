<?php 
/*

!!RETURN VALUES BY REFERENCE!!

*/


/*return a value by reference, not by value. Avoids making a duplicate copy of a variable*/
function &array_find_value($needle, &$haystack) {
	foreach ($haystack as $key => $value) {
		if ($needle == $value) {
			return $haystack[$key];
		}
	}
}
/*use the =& assignment operator instead of plain = when invoking the function*/
$band =& array_find_value('The Doors', $artists);


/*code searches through an array looking for the first element that matches a value*/
function &array_find_value($needle, &$haystack) {
	foreach ($haystack as $key => $value) {
		if ($needle == $value) {
			return $haystack[$key];
		}
	}
}
$minnesota = array(
	'Bob Dylan', 
	'F. Scott Fitzgerald',
	'Prince', 
	'Charles Schultz'
);

$prince =& array_find_value('Prince', $minnesota);

$prince = 'O(+>'; // The ASCII version of Prince's unpronounceable symbol

print_r($minnesota);

?>