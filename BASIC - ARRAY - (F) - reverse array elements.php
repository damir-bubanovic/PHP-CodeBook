<?php 
/*

!!REVERSE ARRAY ELEMENTS!!

*array_reverse - return an array with elements in reverse order
	> array array_reverse ( array $array [, bool $preserve_keys = false ] )
*count - count all elements in an array, or something in an object
	> int count ( mixed $array_or_countable [, int $mode = COUNT_NORMAL ] )
	> ALERT <
		count() may return 0 for a variable that isn't set, but it may also return 0 for a variable 
		that has been initialized with an empty array. Use isset() to test if a variable is set

*/

/*reverse the order of the elements in an array*/
$array = array('Zero', 'One', 'Two');
$reversed = array_reverse($array);

/*reverse a list you’re about to loop through and process*/
for ($i = count($array) - 1; $i >=0 ; $i--) {
	// ...
}


/*Reverse only array keys*/
function array_reverse_keys($array){ 
    return array_reverse(array_reverse($array, true), false); 
} 
?>