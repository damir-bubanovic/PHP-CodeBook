<?php
/*

!!DOES VARIABLE CONTAIN NUMBERS!!

*is_numeric - finds whether a variable is a number or a numeric string
*gettype - get the type of a variable

*/


/*Check if variables (array) contains a valid number*/ 
$my_array = array(5, '5', '05', 12.3, '16.7', 'five', 0xDECAFBAD, '10e200');


/*Check each 'number'*/
foreach($my_array as $maybeNumber) {
	$is_it_numeric = is_numeric($isItNumeric);
	$actual_type = gettype($maybeNumber);
	print "Is the $actualType $maybeNumber numeric? ";
	
	if(is_numeric($maybeNumber)) {
		print 'yes';
	} else {
		print 'no';
	}
	print "\n";
}

?>