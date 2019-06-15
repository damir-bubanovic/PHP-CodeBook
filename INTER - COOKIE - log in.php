	<!--USE with - _COOKIE - log in.php BASIC - SESSION_log in / out-->
	<!--LOOK UP _SECURITY - password hash input signin-->
	<!--LOOK UP _BASIC - COOKIE_log out.php-->
	<!--LOOK UP _BASIC - COOKIE_navigation menu.php-->
	<!--USE - generaly combine cookie and session for long term and short term user data storage-->

<?php
/*

!!COOKIE - LOG IN!!

*session_start - start new or resume existing session
*isset - determine if a variable is set and is not NULL
*mysqli_num_rows - get number of rows in result
*mysqli_fetch_array - fetch a result row as an associative array, a numeric array, or both
*setcookie - send a cookie
*time - return current Unix timestamp
*dirname - returns a parent directory's path
*header - send a raw HTTP header

*/


/*mysqli connection constants*/
... 

/*session start*/
session_start();

/*If user is not logged in, try to log them in, check the user_id cookie / session*/
/*user id is MySQL(INT AI)*/
if(!isset($_SESSION['user_id'])) {
	/*If submit button is pressed*/
	if(isset($_POST['submit'])) {
		
		... /*Connect to database*/
		... /*User input variables (username & password)*/
			/*Don't forget pasword hash here for later comparison in password encrypted numbers*/
	
		/*if user input variables are not empty*/
		if(!empty($user_username) && !empty($user_password)) {
			... /*Look up username and password in database - query = "" & store in $data = mysqli_query, if they are = */
			
			/*If we have a hit, data exists*/
			if(mysqli_num_rows($data) == 1) {
				// The log-in is OK so set the user ID and username cookies, and redirect to the home page
				$row = mysqli_fetch_array($data);
				/*Log in the user by setting user_id and username sessions & cookies*/
				/*Setting sessions and cookies for long term and short term user data storage*/
				$_SESSION['user_id'] = $row['user_id'];
				$_SESSION['username'] = $row['username'];
				/*cookies expire in 30 days*/
				setcookie('user_id', $row['user_id'], time() + (60 * 60 * 24 * 30)); /*Pisalo je 25 umjesto 24 čudno!*/
				setcookie('username', $row['username'], time() + (60 * 60 * 24 * 30));
				/*Redirect the user to homepage upon sucessfull log-in*/
				$home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';
				header('Location: ' . $home_url);
			} else {
				/*Error message if username & password are incorect*/
				$error_msg = 'Sorry, you must enter a valid username and password to log in.';
			}
		} else {
			/*Error message if username & password are incorect*/
			$error_msg = 'Sorry, you must enter your username and password to log in.';
		}
	}
}
?>