<?php 
/*

!!SQL - REPEATING QUERIES EFFICIENTLY!!

> want to run the same query multiple times, substituting in different values each time
> Set up the query with PDO::prepare() and then run it by calling execute() on the prepared statement that prepare() returns. 
The placeholders in the query passed to prepare() are replaced with data by execute()

> The values passed to execute() are called bound parameters—each value is associated with (or “bound to”) a placeholder in the query. 
	>> Two great things about bound parameters are security and speed. 
	>> With bound parameters, you don’t have to worry about SQL injection attacks. 
		>>> PDO appropriately quotes and escapes each parameter so that special characters are neutralized

PDO::PARAM_* constants:
CONSTANT			TYPE
PDO::PARAM_NULL 	NULL
PDO::PARAM_BOOL 	boolean
PDO::PARAM_INT 		integer
PDO::PARAM_STR 		string
PDO::PARAM_LOB 		"large object"


*glob - find pathnames matching a pattern
*fopen - opens file or URL

*/


/*Running prepared statements*/
// Prepare
$st = $db->prepare("SELECT sign FROM zodiac WHERE element LIKE ?");

// Execute once
$st->execute(array('fire'));
while($row = $st->fetch()) {
	print $row[0] . "<br />\n";
}

// Execute again
$st->execute(array('water'));
while($row = $st->fetch()) {
	print $row[0] . "<br />\n";
}



/*prepare() and execute() with two placeholders*/
/*Multiple placeholders*/
$st = $db->prepare("SELECT sign FROM zodiac WHERE element LIKE ? OR planet LIKE ?");
// SELECT sign FROM zodiac WHERE element LIKE 'earth' OR planet LIKE 'Mars'
$st->execute(array('earth', 'Mars'));




/*If you’ve got a lot of placeholders in a query, this can make them easier to read - named placeholders*/
/*Using named placeholders*/
$st = $db->prepare("SELECT sign FROM zodiac WHERE LIKE :element OR planet LIKE :planet");
// SELECT sign FROM zodiac WHERE element LIKE 'earth' OR planet LIKE 'Mars'
$st->execute(array(
	'planet'	=>	'Mars',
	'element'   =>	'earth'
	)
);
$row = $st->fetch();



/*Aside from ? and named placeholders, prepare() offers a third way to stuff values into
queries: bindParam(). This method automatically associates what’s in a variable with a
particular placeholder.*/
/*Using bindParam()*/
$pairs = array(
	'Mars'	=>	'water',
	'Moon'    =>	'water',
	'Sun'	 =>	'fire'
);

$st = $db->prepare("SELECT sign FROM zodiac WHERE element LIKE :element AND planet LIKE :planet");
$st->bindParam(':element', $element);
$st->bindParam(':planet', $planet);

foreach($pairs as $planet => $element) {
	// No need to pass anything to execute() -- the values come from $element and $planet
	$st->execute();
	var_dump($st->fetch());
}



/*The PDO::PARAM_LOB type is particularly handy because it treats the parameter as a
stream. It makes for an efficient way to stuff the contents of files (or anything that can
be represented by a stream, such as a remote URL) into a database table*/
/*Putting file contents into a database with PDO::PARAM_LOB*/
$st = $db->prepare("INSERT INTO files (path, contents) VALUES (:path, :contents)");
$st->bindParam(':path', $path);
$st->bindParam(':contents', $fp, PDO::PARAM_LOB);

foreach(glob('/usr/local/*') as $path) {
	// Get a filehandle that PDO::PARAM_LOB can work with
	$fp = fopen($path, 'r');
	$st->execute();
}

?>