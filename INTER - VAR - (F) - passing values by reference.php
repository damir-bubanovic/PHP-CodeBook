<?php 
/*

!!PASS VALUES BY REFERENCE!!

> pass a variable to a function and have it retain any changes made to its value inside the function

*/


function wrap_in_html_tag($text, $tag = 'strong') {
	$text = "<$tag>$text</$tag>";
}
?>