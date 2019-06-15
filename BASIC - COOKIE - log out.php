	<!--USE with _BASIC - COOKIE_log in.php & _BASIC - COOKIE_navigation menu.php, SESSION_log out.php-->
	<!--USE - generaly combine cookie and session for long term and short term user data storage-->

<?php
/*

!!COOKIE - LOG OUT!!

*isset - determine if a variable is set and is not NULL
*setcookie - send a cookie
*time - return current Unix timestamp
*dirname - returns a parent directory's path
*header - send a raw HTTP header

*/


/*If the user has clicked a button log out*/
... 

/*If the user is logged in, delete the cookie to log them out*/
/*User_id is INT AI*/
if (isset($_COOKIE['user_id']) {
	/*Delete the user ID and username cookies by setting their expirations to an hour ago (3600)*/
	setcookie('user_id', '', time() - 3600);
	setcookie('username', '', time() - 3600);
}
/*Redirect to the home page*/
/*Or try just to use header*/
$home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';
header('Location: ' . $home_url);
?>