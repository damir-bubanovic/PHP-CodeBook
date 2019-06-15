<?php
/*

!!SESSION - SESSION START!!

*/
function secure_session_start() {
	/*Set a custom session name*/
	$session_name = 'sec_session_id';
	/*Session cookies should only be sent over secure connections.*/
	$secure = false; // (Set to true if using https - look up your web page (is it HTTP or HTTPS))
	/*This stops javascript being able to access the session id*/
	$httponly = true;
	
	/*Forces sessions to only use cookies.*/
	if (ini_set('session.use_only_cookies', 1) === FALSE) {
        header("Location: ../../z_session_fail.php");
        exit();
    }

	/*Gets current cookies params.*/
	$cookieParams = session_get_cookie_params();
	/*Sets cookie params*/
	session_set_cookie_params(
		$cookieParams["lifetime"], 
		$cookieParams["path"], 
		$cookieParams["domain"], 
		$secure, 
		$httponly
	); 
	/*Sets the session name to the one set above*/
	session_name($session_name);
	/*Start the php session*/
	session_start();
	/*Regenerated the session, delete the old one.*/
	session_regenerate_id(); 
}
?>