<?php
/*

!!DISPLAY DATA FROM MySQL TO HTML TABLE!!

USAGE:
	1) define database constants & store them in connections.php file -> define()
		> on local server -> DB_HOST, 'localhost'
	2) in process.php page require (not include) connections.php
		> require is stricter & upon failure it will also produce a fatal error
	3) open connection to mysql database -> $databaseConnect
	4) query database -> $query & $data (retrieve all the data from the table)
	5) show data in table... ->while (loop through the array of score data, formatting it as HTML )
	6) close database connection

TIPS & EXPLANATIONS:
> in development stage use or die() to see errors, but in active stage disable errors & remove die() alerts
> store database results in array -> $row = mysqli_fetch_array($data)
	*mysqli_fetch_array() -> fetch a result row as an associative array, a numeric array, or both
> show results through database table column names -> $row['date'] & $row['score'] ...

*/


$query = "SELECT * FROM database_name_table";
$data = mysqli_query($dataBase, $query);

/*Look out for "primary table" outside displayed rows*/
print '<table>';
while ($row = mysqli_fetch_array($data)) { 
	/*Displaying with "secondary table"*/
	print '<tr><td class="scoreinfo">';
    print '<span class="city">' 	. $row['city'] 		. '</span><br />';
    print 'State: ' 				. $row['state'] 	. '<br />';
    print 'Country: ' 			  . $row['country'] 	. '</td></tr>';
}
print '</table>';
>