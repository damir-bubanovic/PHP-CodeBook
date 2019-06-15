<?php 
/*

!! BASIC - PDO - Lynda.com !!

*/

/*
BASIC CONNECTIONS (mysql, sqlite & post options)
*/
$dsn = 'mysql:host=localhost;dbname=oophp';
$dsn = 'mysql:host=localhost;dbname=oophp;port=8889';
$dsn = 'sqlite:C:/xampp/htdocs/oophp/sqlite/oophp.db';
$dsn = 'sqlite:/Applications/MAMP/htdocs/oophp/sqlite/oophp.db';


/*
LOOP DIRECTLY OVER SELECT QUERY
*/
$sql = 'SELECT name, meaning, gender FROM names ORDER BY name';
foreach($dbc->query($sql) as $row) {
	print '<p>' . $row['name'] . ', ' . $row['meaning'] . ', ' . $row['gender']  . '</p><br/>' ;
}


?>