<?php 
/*

!!IS NUMBER ODD OR EVEN!!

*is_numeric - finds whether a variable is a number or a numeric string

*/


function is_odd($num){
	return (is_numeric($num)&($num&1));
}

function is_even($num){
	return (is_numeric($num)&(!($num&1)));
}

//examples
print "1: odd? ".(is_odd(1)? "TRUE": "FALSE")."<br />"; 
//is_numeric(0) returns true 
print "0: odd? ".(is_odd(0)? "TRUE": "FALSE")."<br />"; 
print "6: odd? ".(is_odd(6)? "TRUE": "FALSE")."<br />"; 
print "\"italy\": odd? ".(is_odd("italy")? "TRUE": "FALSE")."<br />";
print "null: odd? ".(is_odd(null)? "TRUE": "FALSE")."<br /><br />"; 
print "1: even? ".(is_even(1)? "TRUE": "FALSE")."<br />";  
print "0: even? ".(is_even(0)? "TRUE": "FALSE")."<br />"; 
print "6: even? ".(is_even(6)? "TRUE": "FALSE")."<br />"; 
print "\"italy\": even? ".(is_even("italy")? "TRUE": "FALSE")."<br />";  
print "null: even? ".(is_even(null)? "TRUE": "FALSE")."<br />"; 


/*
OUTPUT:
1: odd? TRUE
0: odd? FALSE
6: odd? FALSE
"italy": odd? FALSE
null: odd? FALSE

1: even? FALSE
0: even? TRUE
6: even? TRUE
"italy": even? FALSE
null: even? FALSE
*/

?>