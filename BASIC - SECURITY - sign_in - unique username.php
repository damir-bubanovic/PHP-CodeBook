	<!--USE SECURTIY - password (signup)-->

<?php
/*

!!SIGN IN - UNIQUE USERNAME!!

*mysqli_real_escape_string - escapes special characters in a string for use in an SQL statement
	> string mysqli_real_escape_string ( mysqli $link , string $escapestr )
	> ALERT < 
		Security: the default character set
		The character set must be set either at the server level, or with the API 
		function mysqli_set_charset() for it to affect mysqli_real_escape_string()
*trim - strip whitespace (or other characters) from the beginning and end of a string
	> string trim ( string $str [, string $character_mask = " \t\n\r\0\x0B" ] )
	> All user input should get rid of leading and trailing spaces with trim()
	
*empty - determine whether a variable is empty
	> bool empty ( mixed $var )
	
> query SQL
	> Uvijek ubacuj podatke u columns na ovaj način jer time si točan i sigurniji
	> INSERT query očekuje listu kolumni prije list of data
	> Ništa se ne može ubaciti u approved column jer ona nije dio liste - approved je samo za admina
	> Onda moraš izmjeniti MySQL tablicu da approved column ima 0 kao default vrijednosti (As defined: 0)

*/


$username = mysqli_real_escape_string($dbc, trim($_POST['username']));

if(!empty($username)) {
	/*database connection*/
	...
	
	/*Select all data from table*/
	$query = "SELECT * FROM damir_info";
	$data = mysqli_query($dbc, $query)
	or die('Can not query database!');
	
	/*Cycle through every data and row by row*/
	while($row = mysqli_fetch_array($data)) {
		/*If username is already present*/
		if($username == $row['username']) {
			print 'This username is already taken';
		} 
	}
	/*Close connection*/		
	...
} else {
	/*Or put in self processing form line after username*/
	print 'Username is OK';
}
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
		$query = "INSERT INTO damir_info(username, password) VALUES('$username', '$password')";
		...
		print 'Username is OK';
	}
	...
?>