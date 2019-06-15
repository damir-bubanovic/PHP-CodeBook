<?php 
/*

!!SECURITY - AVOIDING CROSS-SITE SCRIPTING!!

> need to safely avoid cross-site scripting (XSS) attacks in your PHP applications

> XSS attacks try to take advantage of a situation where data provided by a third party 
is included in the HTML without being escaped properly

*header - send a raw HTTP header
*htmlentities - convert all applicable characters to HTML entities

*/


/*Escape all HTML output with htmlentities(), being sure to indicate the 
correct character encoding*/

/* Note the character encoding. */
header('Content-Type: text/html; charset=UTF-8');

/* Initialize an array for escaped data. */
$html = array();

/* Escape the filtered data. */
$html['username'] = htmlentities($clean['username'], ENT_QUOTES, 'UTF-8');
print "<p>Welcome back, {$html['username']}.</p>";

?>