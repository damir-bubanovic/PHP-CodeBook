<?php 
/*

!!CHECK VALUE IN ARRAY!!

*in_array = checks if a value exists in an array
	> bool in_array ( mixed $needle , array $haystack [, bool $strict = FALSE ] )
		> $neddle -> searched value
		> $haystack -> the array
	> returns TRUE if needle is found in the array
	> ALERT <
		Use strict checking option
*/


$objects = array(NULL, 0, 'Nikica', 456, true);

var_dump(in_array(NULL, $objects, true)) . '<br />';	// boolean true
var_dump(in_array(23, $objects, true)) . '<br />';	// boolean false
var_dump(in_array('Vlatka', $objects, true)) . '<br />'; // boolean false
var_dump(in_array('false', $objects, true)) . '<br />';	// boolean false
?>