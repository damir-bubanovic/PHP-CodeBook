<?php 
/*

!!INSERT ELEMENT TO FRONT OF ARRAY WITHOUT REINDEXING KEYS!!

*array_unshift - prepend one or more elements to the beginning of an array
*array_reverse - return an array with elements in reverse order

*/

function array_unshift_assoc($array, $key, $val) {
	$array = array_reverse($array, true);
	
	$array[$key] = $val;
	
	return array_reverse($array, true);
} 
?>