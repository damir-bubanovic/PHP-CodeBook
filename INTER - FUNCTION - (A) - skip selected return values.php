<?php 
/*

!!SKIP SELECTED RETURN VALUES!!

> function returns multiple values, but you only care about some of them
*explode - split a string by string
*fgetcsv - gets line from file pointer and parse for CSV fields

*/


// Only care about minutes
function time_parts($time) {
	return explode(':', $time);
}
list(, $minute,) = time_parts('12:34:56');


/*most efficient method*/
while (list(,,$rank,,) = fgetcsv($fh, 4096)) {
	print "$rank\n"; // directly assign $rank
}
?>