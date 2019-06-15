<?php 
/*

!!SQL - LOGGING DEBUGGING INFORMATION & ERRORS!!

> want access to information to help you debug database problems. 
	>> npr. when a query fails, you want to see what error message the database returns

> The errorCode() method returns a five-character error code

> Handling PDO errors as exceptions is useful inside of transactions, too. 
	>> If there’s a problem with a query once the transaction’s started, just roll back the transaction when handling the exception

*/


/*Printing error information*/
$st = $db->prepare("SELECT * FROM imaginary_temple");

if(!$st) {
	$error = $db->errorInfo();
	print "Problem ({$error[2]})";
}


/*Catching database exceptions*/
try {
	$db = new PDO('sqlite:/tmp/zodiac.db');
	
	// Make all DB errors throw exceptions
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$st = $db->prepare("SELECT * FROM zodiac");
	$st->execute();
	
	while($row = $st->fetch(PDO::FETCH_NUM)) {
		print implode(',', $row) . "<br />\n";
	}
} catch(Exception $e) {
	print 'Database Problem: ' . $e->getMessage();
}

?>