<?php 
/*

!!CONVERTING PLAIN TEXT TO HTML!!

> want to turn plain text into reasonably formatted HTML
1) First, encode entities with htmlentities(). 
2) Then, transform the text into various HTML structures. 

> The pc_text2html() function has basic transformations for links and paragraph breaks

*htmlentities - convert all applicable characters to HTML entities
*split - split string into array by regular expression (! but use explode instead !)
*count - count all elements in an array, or something in an object
*implode - join array elements with a string

*/


/*pc_text2html()*/
function pc_text2html($s) {
	$s = htmlentities($s);
	$grafs = split("\n\n", $s);
	
	for($i = 0, $j = count($grafs); $i < $j; $i++) {
		// Link to what seem to be http or ftp URLs
		$grafs[$i] = preg_replace('/((ht|f)tp:\/\/[^\s&]+)/', '<a href="$1">$1</a>', $grafs[$i]);
		
		// Link to email addresses
		$grafs[$i] = preg_replace('/[^@\s]+@([-a-z0-9]+\.)+[a-z]{2,}/i', '<a href="mailto:$1">$1</a>', $grafs[$i]);
		
		// Begin with a new paragraph
		$grafs[$i] = '<p>' . $grafs[$i] . '</p>';
	}
	return implode("\n\n", $grafs);
}



/*More text-to-HTML rules*/
$grafs[$i] = preg_replace('/(\A|\s)\*([^*]+)\*(\s|\z)/', '$1<b>$2</b>$3', $grafs[$i]);
$grafs[$i] = preg_replace('{(\A|\s)/([^/]+)/(\s|\z)}', '$1<i>$2</i>$3', $grafs[$i]);

?>