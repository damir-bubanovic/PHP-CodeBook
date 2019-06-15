<?php 
/*

!!SECURITY - ELIMINATING SQL INJECTION!!

> You need to eliminate SQL injection vulnerabilities in your PHP applications

> Using bound parameters ensures your data never enters a context where it is considered
to be anything except raw data, so no value can possibly modify the format of the SQL query

*/


/*Use a database library such as PDO that performs the proper escaping for your database*/
$statement = $db->prepare(
	"INSERT INTO users (username, password) VALUES (:username, :password)"
);

$statement->bindParam(':username', $clean['username']);
$statement->bindParam(':password', $clean['password']);

$statement->execute();

?>