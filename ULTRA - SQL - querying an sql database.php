<?php 
/*

!!SQL - QUERYING AN SQL DATABASE!!

> want to retrieve some data from your database
> Use PDO::query() to send the SQL query to the database, and then a foreach loop to retrieve each row of the result
	>> The query() method returns a PDOStatement object. Its fetchAll() method provides a concise way to operate on each row returned from a query


PDO::FETCH_* constants
CONSTANT			ROW FORMAT
PDO::FETCH_BOTH 	Array with both numeric and string (column names) keys. The default format.
PDO::FETCH_NUM 		Array with numeric keys.
PDO::FETCH_ASSOC 	Array with string (column names) keys.
PDO::FETCH_OBJ 		Object of class stdClass with column names as property names.
PDO::FETCH_LAZY 	Object of class PDORow with column names as property names. The properties aren’t populated until
					accessed, so this is a good choice if your result row has a lot of columns. Note that if you store the
					returned object and fetch another row, the stored object is updated with values from the new row.

*get_object_vars - gets the properties of the given object
*strlen - returns the length of the given string
*count - count all elements in an array, or something in an object

*/


/*Sending a query to the database*/
$st = $db->query('SELECT symbol, planet FROM zodiac');

foreach($st->fetchAll() as $row) {
	print "{$row['symbol']} goes with {$row['planet']} <br />\n";
}



/*Fetching individual rows*/
$row = $db->query('SELECT symbol, planet FROM zodiac ORDER BY planet');

$firstRow = $row->fetch();
print "The first results are that {$firstRow['symbol']} goes with {$firstRow['planet']}";



/*In combination with bindColumn(), the PDO::FETCH_BOUND fetch mode lets you set up
variables whose values get refreshed each time fetch() is called*/
/*Binding result columns*/
$row = $db->query('SELECT symbol, planet FROM zodiac', PDO::FETCH_BOUND);

// Put the value of the 'symbol' column in $symbol
$row->bindColumn('symbol', $symbol);

// Put the value of the second column ('planet') in $planet
$row->bindColumn(2, $planet);

while($row->fetch()) {
	print "$symbol goes with $planet. <br />\n";
}



/*When used with query(), the PDO::FETCH_INTO and PDO::FETCH_CLASS constants put
result rows into specialized objects of particular classes. To use these modes, first create
a class that extends the built-in PDOStatement class*/
/*Extending PDOStatement*/
class AvgStatement extends PDOStatement {
	
	public  function avg() {
		$sum = 0;
		$vars = get_object_vars($this);
		
		// Remove PDOStatement's built-in 'queryString' variable
		unset($vars['gueryString']);
		foreach($vars as $var => $value) {
			$sum += strlen($value);
		}
		return $sum / count($vars);
	}
}

$row = new AvgStatement;
$results = $db->query('SELECT symbol, planet FROM zodiac', PDO::FETCH_INTO, $row);

// Each time fetch() is called, $row is repopulated
while($results->fetch()) {
	print "$row->symbol to $row->planet (Average: {$row->avg()} <br />\n)";
}

?>