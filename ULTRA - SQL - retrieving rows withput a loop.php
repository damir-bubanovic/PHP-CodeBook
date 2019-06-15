<?php 
/*

!!SQL - RETRIEVING ROWS WITHOUT A LOOP!!

> want a concise way to execute a query and retrieve the data it returns
> Use fetchAll() to get all the results from a query at once

> fetchAll() method is useful when you need to do something that depends on all the rows a query returns, 
such as counting how many rows there are or handling rows out of order

> Like fetch(), fetchAll() defaults to representing each row as an array with both numeric and string 
keys and accepts the various PDO::FETCH_* constants to change that behavior

*/


/*Getting all results at once*/
$st = $db->query("SELECT planet, element FROM zodiac");
$results = $st->fetchAll();

foreach($results as $i => $result) {
	print "Planet $i is {$result['planet']} <br />\n";
}

?>