<?php 
/*

!!PASS VALUES & KEYS TO THE CALLBACK FUNCTION!!

*array_map - Applies the callback to the elements of the given arrays
	> array array_map ( callable $callback , array $array1 [, array $... ] )
	> array_map() returns an array containing all the elements of array1 after applying the callback FUNCTION to each one
*array_keys - Return all the keys or a subset of the keys of an array
	> array array_keys ( array $array [, mixed $search_value = null [, bool $strict = false ]] )
	> returns the keys, numeric and string, from the array

*/


function callback($k, $v) { 
	... 
}

array_map( "callback", array_keys($array), $array);

?>