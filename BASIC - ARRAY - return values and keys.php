<?php 
/*

!!ARRAY KEYS & VALUES!!

*array_shift - Shift an element off the beginning of array
	> mixed array_shift ( array &$array )
	> returns the shifted value, or NULL if array is empty or is not an array
*array_pop - Pop the element off the end of array
	> mixed array_pop ( array &$array )
	> returns the last value of the array, shortening the array by one element

*array_keys - Return all the keys or a subset of the keys of an array
	> array array_keys ( array $array [, mixed $search_value = null [, bool $strict = false ]] )
	> returns the keys, numeric and string, from the array
*array_values - Return all the values of an array
	> array array_values ( array $array )
	> returns all the values from the array and indexes the array numerically

*/

 
$array = array(
	'first' => '111', 
	'second' => '222', 
	'third' => '333'
);

print_r(array_shift($array)) . '<br />'; // 111
print_r(array_pop($array)) . '<br />'; // 333

print array_shift(array_keys($array));	// first
print array_pop(array_keys($array));	// third
print array_shift(array_values($array));	// 111
print array_pop(array_values($array));	// 333


$array = array("blue", "red", "green", "blue", "blue");
print_r(array_keys($array, "blue")); // Array ( [0] => 0 [1] => 3 [2] => 4 )

$array = array("size" => "XL", "color" => "gold");
print_r(array_values($array)); // Array ( [0] => XL [1] => gold )

?>