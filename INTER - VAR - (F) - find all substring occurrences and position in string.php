	<!--LOOK UP _BASIC find the position of the first occurrance of a substring in a string.php-->

<?php 
/*

!!FIND ALL SUBSTRING OCCURRENCES & POSITION IN STRING!!

*strlen - get string length
*trigger_error — generates a user-level error/warning/notice message
*strrpos - find the position of the last occurrence of a substring in a string
*array_push - push one or more elements onto the end of array
*substr - return part of a string

*/


function str_occ_pos($haystack, $needle) {
	
	if(strlen($neddle) > strlen($haystack)) {
		trigger_error(sprintf("%s: length of argument 2 must be <= argument 1", __FUNCTION__) , E_USER_WARNING);
	}
	
	$seek = array();
	
	while($seek = strrpos($haystack, $needle)) {
		array_push($seeks, $seek);
		$haystack = substr($haystack, 0, $seek);
	}
	
	return $seeks;
}


$test = "marina ima";
var_dump(strpos_r($test, "a"));

/* array (size=3)
   0 => int 9
   1 => int 5
   2 => int 1
*/
?>