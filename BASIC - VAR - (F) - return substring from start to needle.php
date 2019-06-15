	<!--LOOK UP _BASIC - find the first occurrance of a string.pgp-->

<?php
/*

!!RETURN SUBSTRING FROM START TO NEEDLE!!

*strstr - find the first occurrence of a string
	> string strstr ( string $haystack , mixed $needle [, bool $before_needle = false ] )
	> returns part of haystack string starting from and including the first occurrence of needle to the end of haystack
	> ALERT <
		strstr() is not a way to avoid type-checking with strpos(),
		strstr() is far more memory-intensive than strpos(), especially with longer strings as your $haystack
*strpos - find the position of the first occurrence of a substring in a string
	> mixed strpos ( string $haystack , mixed $needle [, int $offset = 0 ] )
	> ALERT <
		This function may return Boolean FALSE, but may also return a non-Boolean value which evaluates to FALSE
		To know that a substring is absent, you must use: === FALSE
		To know that a substring is present, you must use: !== FALSE
		To know that a substring is at the start of the string: === 0

*/


function reverse_strstr($haystack, $needle, $start = 0) {
	return substr($haystack, $start, strpos($haystack, $needle));
}

print reverse_strstr('Nedjeljko really sucks', 'ko');	// Nedjelj
?>