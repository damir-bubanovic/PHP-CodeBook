<?php 
/*

!!SESSIONS!!

> keep track of things for their visitors
	>> shopping carts, online banking, personalized home page portals, and social networking community sites...
	
> session data is stored in flat files in the server’s /tmp directory by default
	>> To change the directory in which the files are saved, set the session.save_path configuration directive to the new directory in php.ini 
	or with ini_set(). 
	>> You can also call session_save_path() with the new directory to change directories, but you need to do this before starting the 
	session or accessing any session variables

*isset - determine if a variable is set and is not NULL


1) Using Session Tracking
> want to maintain information about a user as she moves through your site

*/


/*(1.) Session Tracking */
session_start();

if(!isset($_SESSION['visits'])) {
	$_SESSION['visits'] = 0;
}

$_SESSION['visits']++;
print 'You have visited here ' . $_SESSION['visits'] . ' times.';


/*Set session*/
session_start();
$_SESSION['username'] = $_POST['username'];
/*Use / Call session*/
print $_SESSION['username'];

?>