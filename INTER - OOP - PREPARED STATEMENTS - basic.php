<?php
/* 
!!INTER - OOP - PREPARED STATEMENTS - basic!!

> You want to prevent SQL injections

TIPS
> look up for database -> MySQL Database chapter (http://www.w3schools.com/)

STEPS:
1) Sanitize & validate user input
2) Use prepared statements to CRUD database queries

*prepare() - prepare an SQL statement for execution (mysqli::prepare)
*bind_param() 	- binds variables to a prepared statement as parameters (mysqli_stmt::bind_param)
				- characters which specify the types for the corresponding bind variables
				(only 1 s because we bind only email, if user_id & email = is)
*execute() - executes a prepared Query (mysqli_stmt::execute)
*store_result() - transfers a result set from the last query (mysqli::store_result)
*bind_result() - binds variables to a prepared statement for result storage (mysqli_stmt::bind_result)
*fetch() - fetch results from a prepared statement into the bound variables (mysqli_stmt::fetch)
*num_rows() - gets the number of rows in a result (mysqli_result::$num_rows)
*query() - performs a query on the database (mysqli::query)
*/

/*Standard database connection*/
$dbc = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
/*If unable to connect output an error (better to redirect to page)*/
if($dbc->connect_error) {
	print "Connection failed: " . $dbc->connect_error;
	exit();
}

/*User input*/
$user_number = 8;

/*
> if this statement is true and we are able to select all records from
database table_numbers that have an id of ? (some number)
	>> prepare -> this is the prepared statement
> ? is a placeholder that holds the values of our user input (ie. 8)
> with bind_param we are saying that ? = $user_number (inserting $user_number to ?), 
and also expecting the value of $user_number to be a type of integer (ie type checking)
	>> (i = integer, d = double, s = string, b = blob)
> with execute query -> do something into database
> header - redirect page on completion to some page
*/
if($statement = $dbc->prepare("SELECT * FROM table_numbers WHERE id = ?")) {
	$statement->bind_param('i', $user_number);
	if($statement->execute()) {
		header('Location: ./sucess.php');
	}
}
/*
After running the script remember to always close the connection at the end!!
*/
$statement->close();
$dbc->close();


/*
> we are storing all the results in variable $result
> ger_result (better than fetch_result)
	>> we get array returned
> while loop (while the condition is true) get all the objects & do something
	>> setting the value of row to the fetch_object
*/
if($statement = $dbc->prepare("SELECT * FROM table_numbers WHERE id = ?")) {
	$statement->bind_param('i', $user_number);
	$statement->execute();
	$result = $statement->get_result();
	while($row = $result->fetch_object()) {
		$results[] = $row;
	}
}
print_r($results); // return an array of objects


/*
CRUD
*/
$statement = $dbc->prepare("INSERT INTO objects VALUES (?, ?, ?, ?)");
$statement->bind_param('sssd', $code, $language, $official, $percenth);

$statement = $dbc->prepare("UPDATE objects SET some = ?, some2 = ?, some3 = ?, some4 = ? WHERE id = ?");
$statement->bind_param('sssdd', $something, $something2, $something3, $something4, $number);

$statement = $dbc->prepare("DELETE FROM objects WHERE id = ?");
$statement->bind_param('i', $id);


/*
EXAMPLE 1.
Login page
*/
if($statement = $dbc->prepare("SELECT user_id, password FROM table_users WHERE email = ? LIMIT 1")) {
	$statement->bind_param('s', $login_email);
	$statement->execute();
	$statement->store_result();
			
	if($statement->num_rows == 1) {
		$statement->bind_result($db_user_id, $db_password);
		$statement->fetch();
				
		if(check_brute($db_user_id, $dbc)) {
			header('Location: ./locked.php');
		} else {				
			if(password_verify($login_password, $db_password)) {
				header('Location: ./sucess.php');
			} else { 
				insert_brute($db_user_id, $dbc);
				$output_form = true;
			}
		} 
				
	} else {
		$output_form = true;
	}
}
		
$statement->close();	
$dbc->close();

/*
EXAMPLE 2.
Signup page
*/
if($statement = $dbc->prepare("SELECT email FROM table_users WHERE email = ? LIMIT 1")) {
	$statement->bind_param('s', $signup_email);
	$statement->execute();
	$statement->bind_result($signup_email);
	$statement->store_result();
	if($statement->num_rows == 0) {
				
		if($statement = $dbc->prepare("INSERT INTO table_users (email, password) VALUES (?, ?)")) {
			$statement->bind_param('ss', $signup_email, $password);
			if($statement->execute()) {
				header('Location: ./sucess.php');
			}
		}			
	} else {
		/*User exists*/
		print "User already exists!";
		$output_form = true;
	}		
}
		
$statement->close();
$dbc->close();
?>