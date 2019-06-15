<?php 
/*

!!REMOVE DUPLICATE VALUES!!

*array_unique - removes duplicate values from an array
	> array array_unique ( array $array [, int $sort_flags = SORT_STRING ] )
	> takes an input array and returns a new array without duplicate values
	> look up $sort_flags on PHP
*$_GET - associative array of variables passed to the current script via the URL parameters
*in_array - checks if a value exists in an array
	> bool in_array ( mixed $needle , array $haystack [, bool $strict = FALSE ] )
	> searches haystack for needle using loose comparison unless strict is set
	> ALERT < 
		Always use strict checking option
*array_keys - return all the keys or a subset of the keys of an array
	> array array_keys ( array $array [, mixed $search_value = null [, bool $strict = false ]] )
		> $search_value -> If specified, then only keys containing these values are returned
		> $strict -> Determines if strict comparison (===) should be used during the search
*count - count all elements in an array, or something in an object
	> int count ( mixed $array_or_countable [, int $mode = COUNT_NORMAL ] )

> ALERT < 
	Faster to use a foreache and array_keys than array_unique
	
*/

/*Eliminate duplicates from an array*/
$unique = array_unique($array); //returns a new array that contains no duplicate values

/*create the array while processing results - technique for numerical arrays*/
foreach ($_GET['fruits'] as $fruit) {
	if(!in_array($fruit, $array, true)) { 
		$array[] = $fruit; 
	}
}

/*create the array while processing results - technique for associative arrays*/
foreach ($_GET['fruits'] as $fruit) {
	$array[$fruit] = $fruit;
}


/*remove duplicate values*/
$max = 1000000; 
$arr = range(1,$max,3); 
$arr2 = range(1,$max,2); 
$arr = array_merge($arr,$arr2); 


$time = -microtime(true); 
$res2 = array(); 
foreach($arr as $key=>$val) {    
    $res2[$val] = true; 
} 
$res2 = array_keys($res2); 
$time += microtime(true); 
print "<br />deduped to ".count($res2)." in ".$time; 
// deduped to 666667 in 0.84372591972351 
?>