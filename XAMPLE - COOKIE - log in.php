	<!--USE with _BASIC - COOKIE - log in.php SESSION_log in / out-->
	<!--LOOK UP _SECURITY - password hash input signin-->
	<!--LOOK UP _BASIC - COOKIE_log out.php-->
	<!--USE - generaly combine cookie and session for long term and short term user data storage-->

<?php
... /*mysqli connection constants*/

/*SESSION - start the session*/
session_start();

/*Error message in empty variable, displayed later if not loged in*/
$error_msg = "";

/*If user is not logged in, try to log them in, check the user_id cookie / session*/
/*user id is MySQL(INT AI)*/
if (!isset($_SESSION['user_id'])) {
	/*If submit button is pressed*/
	if (isset($_POST['submit'])) {
		
		... /*Connect to database*/
		.... /*User input variables (username & password)*/
		$user_username = mysqli_real_escape_string($dbc, trim($_POST['username']));
		$user_password = mysqli_real_escape_string($dbc, trim(password_hash($_POST['password'], PASSWORD_DEFAULT)));
	
		/*if user input variables are not empty*/
		if (!empty($user_username) && !empty($user_password)) {
			... /*Look up username and password in database - query = "" & store in $data = mysqli_query*/
			
			$query = "SELECT user_id, username FROM damir_info WHERE username = '$user_username' AND " .
			"password = '$user_password'";
			
			/*If we have a hit , data exists*/
			if (mysqli_num_rows($data) == 1) {
				// The log-in is OK so set the user ID and username cookies, and redirect to the home page
				$row = mysqli_fetch_array($data);
				/*Log in the user by setting user_id and username sessions & cookies*/
				$_SESSION['user_id'] = $row['user_id'];
				$_SESSION['username'] = $row['username'];
				/*cookies expire in 30 days*/
				setcookie('user_id', $row['user_id'], time() + (60 * 60 * 25 * 30));
				setcookie('username', $row['username'], time() + (60 * 60 * 25 * 30));
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
<html>
<head>
	<title>Mismatch - Log In</title>
	<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
	<h3>Mismatch - Log In</h3>
<?php
/*If the session is empty, show any error message and the log-in form; otherwise confirm the log-in*/
if (empty($_SESSION['user_id'])) {
echo '<p class="error">' . $error_msg . '</p>';
?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	<fieldset>
		<legend>Log In</legend>
		<!--Enter username and password to log in-->
		<label for="username">Username:</label>
		<input type="text" id="username" name="username"
		value="<?php if (!empty($user_username)) echo $user_username; ?>" /><br />
		<label for="password">Password:</label>
		<input type="password" id="password" name="password" />
	</fieldset>
	<input type="submit" value="Log In" name="submit" />
</form>
<?php
} else {
	/*Confirm the successful log in*/
	print('<p class="login">You are logged in as ' . $_SESSION['username'] . '.</p>');
}
?>
</body>
</html>