<?php 
/*

!!FIND THE FIRST OCCURANCE OF A STRING!!

*strstr - find the first occurrence of a string
	> string strstr ( string $haystack , mixed $needle [, bool $before_needle = false ] )
	> returns part of haystack string starting from and including the first occurrence of needle to the end of haystack
	> ALERT <
		strstr() is not a way to avoid type-checking with strpos(),
		strstr() is far more memory-intensive than strpos(), especially with longer strings as your $haystack

*/


$email = 'damir.bubanovic@yahoo.com';
print strstr($email, '@') . '<br />';	// @yahoo.com
print strstr($email, '@', true);		// damir.bubanovic

?>