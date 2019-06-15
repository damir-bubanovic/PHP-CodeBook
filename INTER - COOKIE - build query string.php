<?php 
/*

!!BUILD QUERY STRING!!

> construct a link that includes name/value pairs in a query string

*http_build_query - generates a URL-encoded query string from the associative (or indexed) array provided

To prevent embedded entities from corrupting your URLs, you have three choices:
1) choose variable names that can’t be confused with entities, such as _amp instead of amp
2) convert characters with HTML entity equivalents to those entities before printing out the URL => htmlentities($query_string):
3) change the argument separator from & to &amp	=> ini_set('arg_separator.input', '&amp;');

*/

$vars = array(
	'name'					 =>	'Oscar the Grouch',
	'color'					=>	'green',
	'favourite_punctuation'	=>	'#'
);

$query_string = http_build_query($vars);

$url = '/muppet/select.php?' . $query_string;
// /muppet/select.php?name=Oscar+the+Grouch&color=green&favorite_punctuation=%23
?>