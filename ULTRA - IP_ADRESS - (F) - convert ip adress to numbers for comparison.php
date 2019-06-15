<?php
/*

!!CONFIRM IP ADRESS TO NUMBERS FOR COMPARISON!!

> Function which convert ip address to a number using substr with negative offset

USAGE:
> compare some IP addresses converted to a numbers
> eliminating same range of ip addresses from your website

*list - assign variables as if they were an array
*explode - split a string by string


*/


function ip_to_numbers($val) {
	list($A, $B, $C, $D) = explode('.', $val);
	
	return
        substr("000".$A,-3). 
        substr("000".$B,-3). 
        substr("000".$C,-3). 
        substr("000".$D,-3);
}


$min = ip_to_numbers("10.11.1.0"); 
$max = ip_to_numbers("111.11.1.0"); 
$visitor = ip_to_numbers("105.1.20.200"); 

if($min < $visitor && $visitor < $max) {    
	print 'Welcome !';    
} else {
	print 'Get out of here !';    
}
?>