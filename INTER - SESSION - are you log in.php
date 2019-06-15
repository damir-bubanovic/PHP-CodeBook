	<!--For every page exept index - makes sure the user is logged in to procede further-->
	<!--Look up every log in, sign in page and COOKIES & SESSIONS-->
	<!--USE - generaly combine cookie and session for long term and short term user data storage-->

<!--Above the header-->
<?php
/*

!!SESSION - check log in!!

*isset - determine if a variable is set and is not NULL
*exit - output a message and terminate the current script
*$_SESSION - associative array containing session variables available to the current script
*$_COOKIE - associative array of variables passed to the current script via HTTP Cookies

*/


session_start();

/*If the session vars aren't set, try to set them with a cookie*/
if(!isset($_SESSION['user_id'])) {
	if(isset($_COOKIE['user_id']) && isset($_COOKIE['username'])) {
		/*Setting the session variables using the cookies*/
		/*The same session / cookie code goes in edit_profile & view_profile page*/
		$_SESSION['user_id'] = $_COOKIE['user_id'];
		$_SESSION['username'] = $_COOKIE['username'];
	}
}
?>
	
<?php 
// Make sure the user is logged in before going any further.
if (!isset($_SESSION['user_id'])) {
    print '<p class="login">Please <a href="login.php">log in</a> to access this page.</p>';
    exit();
} else {
    print('<p class="login">You are logged in as ' . $_SESSION['username'] . '. <a href="logout.php">Log out</a>.</p>');
}
?>