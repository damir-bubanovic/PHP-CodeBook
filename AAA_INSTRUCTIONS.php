<?php 
/*

!!!DATABASE CONNECTION!!!

USAGE:
	1) define database constants & store them in connections.php file -> define()
		> on local server -> DB_HOST, 'localhost'
	2) in process.php page require (not include) connections.php
		> require is stricter & upon failure it will also produce a fatal error
	3) open connection to mysql database -> $databaseConnect
	4) query database -> $query & $data
	5) show data in table... ->while (most commmon through loops)
	6) close database connection
	
TIPS & EXPLANATIONS:
> in development stage use or die() to see errors, but in active stage disable errors & remove die() alerts
> store database results in array -> $row = mysqli_fetch_array($data)
	*mysqli_fetch_array() -> fetch a result row as an associative array, a numeric array, or both
> show results through database table column names -> $row['date'] & $row['score'] ...

> ALERT <
	Timmy
	
	
*/


/**
    * change the case of array-keys
    *
    * use: array_change_key_case_ext(array('foo' => 1, 'bar' => 2), ARRAY_KEY_UPPERCASE);
    * result: array('FOO' => 1, 'BAR' => 2)
    *
    * @param    array
    * @param    int
    * @return     array
    */
	

UČENJE	
variabla 
constants and function define()
loops
integer, float
|| !...

?>