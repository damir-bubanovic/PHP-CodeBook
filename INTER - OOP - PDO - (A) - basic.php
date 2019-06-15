<?php 
/*
!!INTER - OOP - PDO - BASIC!!

TIPS:
> use isset (submit) & filter sanitize on user input data
> put connection variable into seperate file (mayby use constants) + new PDO & exception (setAttribute)
> look up for database -> MySQL Database chapter (http://www.w3schools.com/)


*prepare() - prepare an SQL statement for execution
*bind_param()   - binds user input variables to a PDO as parameters (for simplicity use array)
				- user input email => :email (sql) & $email (bindParam)
*execute() - executes a prepared Query

*/

try {
	$db_host = 'localhost';
	$db_user = 'root';
	$db_pass = '';
	$db_name = 'mount_geo_db';
	
	$dbc = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
	// set the PDO error mode to exception
	$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	/*
	SHOW ALL RESULTS
	$statement = $dbc->prepare("SELECT * FROM table_users");
	$statement->execute();
	while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
		print "Email is: " . $row['email'] . " and password is " . $row['password'] . "<br />";
	}
	*/
	
	/*
	SELECT RESULT - but do this with password verify
	$statement = $dbc->prepare("SELECT * FROM pms_users WHERE username=:username AND password=:password LIMIT 1");
	$statement->execute(array(':username'=>$username, ':password'=>$password));
	$user_row = $statement->fetch(PDO::FETCH_ASSOC);
	if($statement->rowCount() > 0) {
		print "You are Emperor of the world";
	} else {
		print "Get out Loser!";
	}
	*/
	
	/*
	INSERT USER INPUT
	$statement = $dbc->prepare("INSERT INTO table_users (email, password) VALUES (:email, :password)");
	$statement->bindParam(':email', $email);
	$statement->bindParam(':password', $password);
	// OR $statement->bindParam(array(':email' => $email, ':password' => $password));
	$statement->execute();
	*/
	
	/*
	UPDATE
	$statement = $dbc->prepare("UPDATE table_users SET(email = :email, password = :password) WHERE user_id = :number"); 
	$statement->bindParam(array(':email' => $email, ':password' => $password, ':number' => $number));
	$statement->execute();
	*/
	
	/*
	DELETE
	$statement = $dbc->prepare("DELETE FROM table_users WHERE email = :email");
	$statement->bindParam(':email', $email);
	$statement->execute();
	*/
	print $statement->rowCount() . " records CHANGED successfully";
	
} catch(PDOException $e) {
	print 'Error: ' . $e->getMessage();
}

?>