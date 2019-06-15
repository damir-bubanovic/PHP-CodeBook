<?php 
/*

!!DOES OBJECT FIELD MATCH NEEDLE!!

*isset - determine if a variable is set and is not NULL

*/

function in_array_field($needle, $needle_field, $haystack, $strict = false) {
	if($strict) {
		foreach($haystack as $hstack) {
			if(isset($hstack->$needle_field) && $hstack->$needle_field === $needle) {
				return true;
			}
		}
	} else {
		foreach($haystack as $hstack) {
			if(isset($hstack->$needle_field) && $hstack->$needle_field == $needle) {
				return true;
			}
		}
	}
	return false;
}


$arr = array( new stdClass(), new stdClass() ); 
$arr[0]->colour = 'red'; 
$arr[1]->colour = 'green'; 
$arr[1]->state  = 'enabled'; 

if (in_array_field('red', 'colour', $arr)) {
   print 'Item exists with colour red.';	// Item exists with colour red. 
}
if (in_array_field('magenta', 'colour', $arr)) {
   print 'Item exists with colour magenta.'; 
}
if (in_array_field('enabled', 'state', $arr)) {
   print 'Item exists with enabled state.'; 	// Item exists with enabled state. 
}
?>