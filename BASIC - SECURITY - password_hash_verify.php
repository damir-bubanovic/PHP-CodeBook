	<!--Use password HASH to crypt passwords, _SECURITY - password verify input login & password hash input signin-->
	<!--USE with HTTP authentification - if you dont want a form-->

<?php 
/*

!!PASSWORD - HASH - VERIFY!!

*mysqli_real_escape_string - escapes special characters in a string for use in an SQL statement
	> string mysqli_real_escape_string ( mysqli $link , string $escapestr )
	> ALERT < 
		Security: the default character set
		The character set must be set either at the server level, or with the API 
		function mysqli_set_charset() for it to affect mysqli_real_escape_string()
*trim - strip whitespace (or other characters) from the beginning and end of a string
	> string trim ( string $str [, string $character_mask = " \t\n\r\0\x0B" ] )
	> All user input should get rid of leading and trailing spaces with trim()
*password_hash - creates a password hash
	> string password_hash ( string $password , integer $algo [, array $options ] )
	> safest option is to use PASSWORD_DEFAULT
*password_verify - verifies that a password matches a hash
	> boolean password_verify ( string $password , string $hash )

*empty - determine whether a variable is empty
	> bool empty ( mixed $var )

*mysqli_fetch_array - fetch a result row as an associative array, a numeric array, or both
	
*/

/*Database connection has to go before these variables - reading lines*/

$username = mysqli_real_escape_string($dbc, trim($_POST['username']));
$email = mysqli_real_escape_string($dbc, trim($_POST['email']));
$password = mysqli_real_escape_string($dbc, trim(password_hash($_POST['password'], PASSWORD_DEFAULT)));

....
?>

	<!--Check user mail and password with stored mysqli data - password VERIFY-->

<?php
/*User input*/
$password = mysqli_real_escape_string($dbc, trim($_POST['password']));

/*If variables are not empty*/
if(!empty($email) && !empty($password)) {
	/*database connection*/
	...
	
	/*Select all data from table*/
	$query = "SELECT * FROM damir_info";
	$data = mysqli_query($dbc, $query)
	or die('Can not query database!');
	
	/*Cycle through every data and row by row*/
	while($row = mysqli_fetch_array($data)) {
		/*If email and password are the same*/
		if($email == $row['email'] && password_verify($password, $row['password'])) {
			header('Location: http://localhost/dwwithphp/d_sucess.php');
		} 
	}
	/*Close connection*/		
	...
} else {
	print 'Please enter email & password!';
}
?>