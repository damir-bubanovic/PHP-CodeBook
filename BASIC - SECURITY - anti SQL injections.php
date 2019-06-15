	<!--LOOK / USE WITH SCOREBOARD - user insert score.php, _BASIC securtiy SQL section-->

<?php 
/*

!!ANTI-SQL INJECTION!!

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

/*User insert data*/
$name = mysqli_real_escape_string($dbc, trim($_POST['name']));
$score = mysqli_real_escape_string($dbc, trim($_POST['score']));
$screenshot = mysqli_real_escape_string($dbc, trim($_FILES['screenshot']['name']));


/*Check empty data*/
/*Ako name nije prazan, score je broj, a screenshot nije prazan*/
if (!empty($name) && is_numeric($score) && !empty($screenshot)) {
	/*Some code goes here*/
}


/*Query SQL*/
/*GOOD*/
$query = "INSERT INTO guitarwars (date, name, score, screenshot) " . 
"VALUES (NOW(), '$name', '$score', '$screenshot')";
mysqli_query($dbc, $query);

/*BAD*/
$query = "INSERT INTO guitarwars VALUES (0, NOW(), '$name', '$score', '$screenshot', 0)";
mysqli_query($dbc, $query);
?>