<?php 
/*

!!FIND VALUE AND ITS KEY IN ARRAY!!

*array_search - searches the array for a given value and returns the corresponding key if successful
	> mixed array_search ( mixed $needle , array $haystack [, bool $strict = false ] )

*/


/*Know if a value is in an array. If the value is in the array, you want to know its key*/
$position = array_search($value, $array);
if ($position !== false) {
	// the element in position $position has $value as its value in array $array
}
?>