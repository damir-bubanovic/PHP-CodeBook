<?php 
/*

!!SESSION - PREVENTING SESSION HIJACKING!!

> want make sure an attacker can’t access another user’s session

> Allow passing of session IDs via cookies only, and generate an additional session token that is passed via URLs
	>> Only requests that contain a valid session ID and a valid session token may access the session
	
*ini_set - sets the value of the given configuration option
*session_start - start new or resume existing session
*strval - get string value of a variable
*date - format a local time/date
*md5 - calculate the md5 hash of a string
*output_add_rewrite_var - this function adds another name/value pair to the URL rewrite mechanism

*/


ini_set('session.use_only_cookies', true);

session_start();

$salt = 'YourSpecialValueHere';
$token_str = strval(date('W')) . $salt;
$token = md5($token_str);

if(!isset($_REQUEST['token']) || $_REQUEST['token'] != $token) {
	// prompt for login
	exit();
}
$_SESSION['token'] = $token;
output_add_rewrite_var('token', $token);

?>