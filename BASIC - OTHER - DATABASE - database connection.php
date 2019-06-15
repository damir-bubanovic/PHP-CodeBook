<?php
/*

!!!DATABASE CONNECTION!!!

USAGE:
	1) define database constants & store them in connections.php file -> define()
		> on local server -> DB_HOST, 'localhost'
	2) in process.php page require (not include) connections.php
		> require is stricter & upon failure it will also produce a fatal error
	3) open connection to mysql database -> $databaseConnect
	4) query database -> $query & $data/result  (retrieve all the data from the table)
		*mysqli_query -> connect database with query (what you want to do)
	5) show data/result in table... ->while (most commmon through loops)
	6) close database connection
	
TIPS & EXPLANATIONS:
> in development stage use or die() to see errors, but in active stage disable errors & remove die() alerts
> store database results in array -> $row = mysqli_fetch_array($data)
	*mysqli_fetch_array() -> fetch a result row as an associative array, a numeric array, or both
> show results through database table column names -> $row['date'] & $row['score'] ...

GIANT TIP (use PDO or Prepared Statements)
> look up for database -> MySQL Database chapter (http://www.w3schools.com/)

*/


/*connections.php file*/
define('DB_HOST', 'www.mypage.com');
define('DB_USER', 'damir');
define('DB_PASS', 'kalnK345SFGr');
define('DB_NAME', 'damir_db');


/*process.php page*/
require_once('connections.php');

$databaseConnect = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die('Error connecting to database!');

$query = "SELECT * FROM email_list";
$result = mysqli_query($databaseConnect, $query) or die('Error querying database!');

while ($row = mysqli_fetch_array($result)) {
	print 'table';
	print '<td>' . $row['first_name'] . '</td>';
	print '<td>' . $row['last_name'] . '</td>';
	print '...';
}

mysqli_close($databaseConnect);

?>