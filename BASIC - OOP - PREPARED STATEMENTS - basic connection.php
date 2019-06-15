<?php 
/*
!!BASIC - OOP - PREPARED STATEMENTS - BASIC CONNECTION!!
*/

/*
STEPS
1) inlcude basic connection constants & database connection
	> ...
	> $dbc = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
2) test if we can connect to database
3) sec charset (as another layer of protection)
4) test if server is online
	> enable when in real enviroment
*/
include_once("_include/connect_database.php");
if($dbc->connect_error) {
	print "Connection failed: " . $dbc->connect_error;
	exit();
}
$dbc->set_charset("utf8");

/*
if($dbc->ping() == false) {
	print "Error: " . $dbc->error;
}
*/
?>