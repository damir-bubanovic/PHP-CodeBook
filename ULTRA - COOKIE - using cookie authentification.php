<?php 
/*

!!USING COOKIE AUTHENTIFICATION!!

> You want more control over the user login procedure, such as presenting your own login form

> Using cookie or session authentication instead of HTTP Basic authentication makes it much easier for users to log out: 
you just delete their login cookie or remove the login variable from their session

*setcookie - defines a cookie to be sent along with the rest of the HTTP headers
*md5 - calculate the md5 hash of a string (but use password hash & verify)
*unset - destroys the specified variables
*list - assign variables as if they were an array
*explode - returns an array of strings, each of which is a substring of string formed by splitting it on boundaries formed by the string delimiter.
*error_log - sends an error message to the web server's error log or to a file
	> writes a message to the error log, but it could just as easily record the information in a database that you could use in your analysis of site usage and traffic
*session_id - used to get or set the session id for the current session

> ALERT < 
	One danger of using session IDs is that sessions are hijackable, if you guess session ID you can masquerade as specific user to the server.
	See anti-hacking directives for Session ID - session.entropy_file & session.entropy_length

*/



/*
Store authentication status in a cookie or as part of a session. When a user logs in successfully, put her username (or another unique value) in a cookie. 
Also include hash of the username and a secret word so a user can’t just make up an authentication cookie with a username in it.
*/
$secret_word = 'if I ate spinach';

if(validate($_POST[username], $_POST['password'])) {
	setcookie('login', $_POST['username'] . ',' . md5($_POST['username'] . $secret_word));
}
?>

<!--Sample cookie authentication login form-->
<form method="POST" action="login.php">
Username: <input type="text" name="username"> <br>
Password: <input type="password" name="password"> <br>
<input type="submit" value="Log In">
</form>

<?php
/*Use this function to validate*/
function validate($user, $pass) {
	/* replace with appropriate username and password checking, such as checking a database */
	$users = array(
			'david' => 'fadj&32',
			'adam'  => '8HEj838'
		);
	
	if(isset($users[$user]) && ($users[$user] === $pass)) {
		return true;
	} else {
		return false;
	}
}


/*Once the user has logged in, a page just needs to verify that a valid login cookie was sent in order to do special things for that logged-in user*/
unset($username);

if(isset($_COOKIE['login'])) {
	list($c_username, $cookie_hash) = explode(',', $_COOKIE['login']);
	
	if(md5($c_username . $secret_word) == $cookie_hash) {
		$username = $c_username;
	} else {
		print 'You have sent a bad cookie.';
	}
	
	if(isset($username)) {
		print "Welcome, $username.";
	} else {
		print "Welcome, anonymous user.";
	}
}


/*If you use the built-in session support, you can add the username and hash to the session and avoid sending a separate cookie*/
if(validate($_POST['username'], $_POST['password'])) {
	$_SESSION['login'] = $_POST['username'] . ',' . md5($_POST['username'] . $secret_word);
}


/*Verifying session info - almoast the same as cookie*/
unset($username);

if(isset($_SESSION['login'])) {
	list($c_username,$cookie_hash) = explode(',', $_SESSION['login']);
	
	if(md5($c_username . $secret_word) == $cookie_hash) {
		$username = $c_username;
	} else{
		print 'You have tempered with your session.';
	}
}


/*Connecting logged-out and logged-in usage*/
if(validate($_POST['username'], $_POST['password'])) {
	$_SESSION['login'] = $_POST['username'] . ',' . md5($_POT['username'] . $secret_word);
	error_log('Session id ' . session_id() . ' log in as ' . $_POST['username']);
}

?>