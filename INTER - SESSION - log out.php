	<!--USE with _BASIC - COOKIE_log out-->
	<!--USE - generaly combine cookie and session for long term and short term user data storage-->

<?php
/*

!!SESSION - LOG OUT!!

*session_start - start new or resume existing session
*isset - determine if a variable is set and is not NULL
*$_SESSION - associative array containing session variables available to the current script
*session_destroy - destroys all data registered to a session
*setcookie - send a cookie
*time - return current Unix timestamp
*dirname - returns a parent directory's path
*header - send a raw HTTP header

*/


/*If the user is logged in, delete the session vars to log them out*/
session_start();
/*now a session variable is used to check the log-in status instead of a cookie*/
/*user id is INT AI*/
if(isset($_SESSION['user_id']) {
	/*Delete the session vars by assigning the $_SESSION superglobal as empty array*/
	$_SESSION = array();
	/*If session cookie exists delete the session cookie by setting its expiration to an hour ago (3600)*/
	if (isset($_COOKIE[session_name()])) {
		setcookie(session_name(), '', time() - 3600);
	}
	/*Destroy the session*/
	session_destroy();
	
	/*Delete he user ID and username cookies by setting their expiration to an hour ago*/
	/*We are logging out by destroying both sessions and cookies*/
	setcookie('user_id', '', time() - 3600);
	setcookie('username', '', time() - 3600);
}
/*Redirect to the home page*/
$home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';
header('Location: ' . $home_url);
?>