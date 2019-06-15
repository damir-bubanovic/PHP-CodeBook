<?php 
/*

!!DOES KEY EXIST IN ARRAY!!

TIPS & EXPLANATIONS:
*isset - variable set & not NULL
	> bool isset ( mixed $var [, mixed $... ] )
	> can use var_dump() for more information about a variable 
	> return true
	> isset() only works with variables as passing anything else will result in a error
	> for checking if constants are set use the defined() function
*array_key_exists - checks if the given key or index exists in the array
	> bool array_key_exists ( mixed $key , array $array )
		> $key -> key or index
		> $array -> array
	> return true if exists
> Take the performance advantage of isset() while keeping the NULL element correctly detected
> ALERT <
	The code for this check is very fast, so you shouldn't warp the code into a function

*/


if(isset() || array_key_exists()) {
	print 'code here';
}
?>