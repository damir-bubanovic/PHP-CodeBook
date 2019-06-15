	<!--Check BASIC - security - password_hash_verify, _SECURITY - password hash input signin-->
	<!--USE with - _COOKIE - log in.php-->
	<!--USE with HTTP authentification - if you dont want a form-->
	
<?php 
/*Open database*/
$dbc = mysqli_connect('localhost', 'root', '', 'damir_db')
or die('Can not connect to the database!');

/*User input variables + pogledaj na php.net kako zakomplicirat password*/
$email = mysqli_real_escape_string($dbc, trim($_POST['email']));
$password = mysqli_real_escape_string($dbc, trim($_POST['password']));

/*If user input variables are not empty*/
if(!empty($email) && !empty($password)) {	
	
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
} else {
	print 'You are not sucessfull!';
}
/*Clear values*/
$password = "";
/*Close Connection*/
mysqli_close($dbc);
?>

	<!--Alternative (mayby better) looping-->
	
<?php
	/*Select data from table - and a correct code for query*/
	$query = "SELECT password FROM damir_info WHERE password = '$password'";
	...
	
	/*Cycle through data, if password exists, 1 - exists / 1 row*/
	if(mysqli_num_rows($data) = 1) {
		/*Sent user to page or print message*/
		header('Location: http://localhost/dwwithphp/d_sucess.php');
		print 'You are sucessfull';
	}

?>