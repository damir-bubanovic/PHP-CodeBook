<?php 
/*

!!SEARCH THROUGH A MULTIDIMENSIONAL ARRAY!!

*array_search - searches the array for a given value and returns the corresponding key if successful
	> mixed array_search ( mixed $needle , array $haystack [, bool $strict = false ] )
	> ALERT <
		This function may return Boolean FALSE, but may also return a non-Boolean value which evaluates to FALSE. 
		Please read the section on Booleans for more information. 
		Use the === operator for testing the return value of this function

*/


/*search through a multi dimensional array*/
$key = array_search(40489, array_column($userdb, 'uid'));
?>