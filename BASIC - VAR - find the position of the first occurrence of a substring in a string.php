<?php 
/*

!!FIND THE POSITION OF THE FIRST OCCURANCE OF A SUBSTRING IN A STRING!!

*strpos - find the position of the first occurrence of a substring in a string
	> mixed strpos ( string $haystack , mixed $needle [, int $offset = 0 ] )
	> ALERT <
		This function may return Boolean FALSE, but may also return a non-Boolean value which evaluates to FALSE
		To know that a substring is absent, you must use: === FALSE
		To know that a substring is present, you must use: !== FALSE
		To know that a substring is at the start of the string: === 0

*/


$string = 'This timmy is the end!';
$needle = 't';
print strpos($string, $needle) . '<br />';	// 5
print strpos($string, $needle, 8);			// 14

?>