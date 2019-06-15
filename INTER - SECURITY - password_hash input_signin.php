	<!--Check BASIC - security - password_hash_verify, _SECURITY - password verify input login-->
	<!--USE with HTTP authentification - if you dont want a form-->
	<!--USE with _BASIC - sign up - unique username-->

<?php 
/*Open database*/
$dbc = mysqli_connect('localhost', 'root', '', 'damir_db')
or die('Can not connect to the database!');

/*User input variables - anti-SQL injection*/
$username = mysqli_real_escape_string($dbc, trim($_POST['username']));
$email = mysqli_real_escape_string($dbc, trim($_POST['email']));
$password1 = mysqli_real_escape_string($dbc, trim(password_hash($_POST['password'], PASSWORD_DEFAULT)));
$password2 = mysqli_real_escape_string($dbc, trim(password_hash($_POST['password'], PASSWORD_DEFAULT)));

/*If user variables are not empty*/
if(!empty($username) && !empty($email) && !empty($password) && ($password1 == $password2)) {
	
	/*Query insert data in database*/
	$query = "INSERT INTO damir_info(username, email, password1) VALUES('$username', '$email', '$password')";
	$result = mysqli_query($dbc, $query) 
	or die('Can not query database');
	
	/*If sucessfull print message*/
	print 'All information is recorded';
	
} else {
	/*If not sucessfull print message*/
	print 'Please enter all information!';
}
/*Clear variable values or not for unsucesfull login*/
$username = '';
$email = '';
$password = '';

/*Close connection*/
mysqli_close($dbc); 
?>

	<!--Alternative (mayby better) looping-->

<?php
	...
	// Look up the username and password in the database
	$query = "SELECT * FROM damir_info WHERE username = '$username'";
	$data = mysqli_query($dbc, $query);
	
	/*IF username is unique, 0 - does not exist / no rows*/
	if (mysqli_num_rows($data) == 1) {
		/*Insert data in database*/
		$query = "INSERT INTO damir_info(username, password1) VALUES('$username', '$password')";
		...
		print 'Username is OK';
	}
	...
?>
