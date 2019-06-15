	<!--USE with all the pages on web site-->
	<!--LOOK UP _BASIC - COOKIE - log in.php & _COOKIE - log in.php-->

<?php
/*

!!COOKIE - NAVIGATION MENU!!

> can be used to make other things viewable / not-viewable

*/


/*Username cookie determines witch menu is displayed*/
/*If the cookie is set (we are logged in), but you have to do this with session*/
if (isset($_SESSION['username'])) {
	print '&#10084; <a href="viewprofile.php">View Profile</a><br />';
	print '&#10084; <a href="editprofile.php">Edit Profile</a><br />';
	print '&#10084; <a href="logout.php">Log Out (' . $_SESSION['username'] . ')</a>';
} else {
	print '&#10084; <a href="login.php">Log In</a><br />';
	print '&#10084; <a href="signup.php">Sign Up</a>';
}
?>