<?php 
/*

!!CHECK IF KEY IS IN ARRAY!!

*array_key_exists - checks if the given key or index exists in the array
	> bool array_key_exists ( mixed $key , array $array )
	> USE array_key_exists() to check for a key no matter what the associated value is
*isset - determine if a variable is set and is not NULL
	> bool isset ( mixed $var [, mixed $... ] )
	> isset() only works with variables as passing anything else will result in a parse error
	> USE isset() to find a key whose associated value is anything but null

*/


if (array_key_exists('key', $array)) {
	/* there is a value for $array['key'] */
}

if (isset($array['key'])) { 
	/* there is a non-null value for 'key' in $array */ 
}

?>