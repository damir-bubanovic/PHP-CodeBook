<?php 
/*

!!REVERSE KEYS IN ARRAY!!

*array_reverse - return an array with elements in reverse order

*/


function array_reverse_keys($array) {
	return array_reverse(array_reverse($array, true), false);
}

?>