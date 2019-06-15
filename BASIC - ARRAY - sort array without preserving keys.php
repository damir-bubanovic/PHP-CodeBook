<?php 
/*

!!SORTED ARRAY WITHOUT PRESERVING THE KEYS!!

*array_values - Return all the values of an array
	> array array_values ( array $array )
	> returns all the values from the array and indexes the array numerically
*array_unique - Removes duplicate values from an array
	> array array_unique ( array $array [, int $sort_flags = SORT_STRING ] )
	> $sort_flags
		SORT_REGULAR - compare items normally (don't change types)
		SORT_NUMERIC - compare items numerically
		SORT_STRING - compare items as strings
		SORT_LOCALE_STRING - compare items as strings, based on the current locale
> returns an array which is both unique and sorted from zero

*/


$array = array("hello", "fine", "good", "fine", "hello", "bye"); 

$get_sorted_unique_array = array_values(array_unique($array)); 
?>