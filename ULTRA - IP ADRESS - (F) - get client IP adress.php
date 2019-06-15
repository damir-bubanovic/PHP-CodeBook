<?php 
/*

!!GET CLIENT IP ADRESS!!

*$_SERVER - array containing information such as headers, paths, and script locations
*HTTP_CLIENT_IP - The IP address from which the user is viewing the current page
*HTTP_X_FORWARDED_FOR - The IP address from which the user is viewing the current page
*HTTP_FORWARDED - The IP address from which the user is viewing the current page
*REMOTE_ADDR - The IP address from which the user is viewing the current page

> ALERT <
	HTTP_X_FORWARDED_FOR can be anything a client chooses to set, whereas REMOTE_ADDR is considerably harder to fake
	This code is vulnerable to spoofing - see anti spoofing methods
	REMOTE_ADDR might not contain the real IP of the TCP connection. This entirely depends on your SAPI. 
	Ensure that your SAPI is properly configured such that $_SERVER['REMOTE_ADDR'] actually returns the IP of the TCP connection.

*/


/*Function to get the client IP address*/
function get_client_ip() {
    $ipaddress = '';
	/*$_SERVER is an array that contains server variables created by the web server*/
    if ($_SERVER['HTTP_CLIENT_IP'])
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if($_SERVER['HTTP_X_FORWARDED_FOR'])
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if($_SERVER['HTTP_X_FORWARDED'])
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if($_SERVER['HTTP_FORWARDED_FOR'])
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if($_SERVER['HTTP_FORWARDED'])
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if($_SERVER['REMOTE_ADDR'])
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

?>