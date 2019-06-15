<?php 
/*

!!FIND NUMERICAL VALUE OF A STRING!!

*is_numeric - finds whether a variable is a number or a numeric string

*/

function get_numeric($val) { 
	if (is_numeric($val)) { 
		return $val + 0; 
	} 
	return 0; 
} 

/*
OUTPUT:
get_numeric('3'); // int(3) 
get_numeric('1.2'); // float(1.2) 
get_numeric('3.0'); // float(3) 
*/

?>