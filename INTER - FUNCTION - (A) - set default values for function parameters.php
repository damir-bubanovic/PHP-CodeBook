<?php 
/*

!!SET DEFAULT VALUES FOR FUNCTION PARAMETERS!!

*/


/*You want a parameter to have a default value if the function’s caller doesn’t pass it*/
function wrap_in_html_tag($text, $tag = 'strong') {
	return "<$tag>$text</$tag>";
}

/*example in the Solution sets the default tag value to strong*/
print wrap_in_html_tag("Hey, a mountain lion!");	// <strong>Hey, a mountain lion!</strong>

/*example in the Solution sets the em value*/
print wrap_in_html_tag("Look over there!", "em");	// <em>Look over there!</em>


/*Assign a default of nothing*/
function wrap_in_html_tag($text, $tag = '') {
	if (empty($tag)) { 
		return $text; 
	}
	return "<$tag>$text</$tag>";
}
?>