<?php 
/*

!!FIND FILE EXTENSION!!

*strrchr - find the last occurrence of a character in a string
	> string strrchr ( string $haystack , mixed $needle )
	> returns the portion of haystack which starts at the last 
	  occurrence of needle and goes until the end of haystack

*/

$filename = 'marko.pdf';

/*Find file extension*/
$ext = strrchr($filename, '.');
print $ext;	// .pdf

?>