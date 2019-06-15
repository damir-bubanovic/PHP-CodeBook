<?php 
/*

!!APPLY FUNCTION TO EACH ELEMENT OF THE ARRAY!!

*array_walk - apply a user supplied function to every member of an array
*htmlentities - convert all applicable characters to HTML entities
*array_map - applies the callback (function) to the elements of the given arrays

*/



/*This allows you to transform the input data for the entire set all at once*/
$names = array(
	'firstname' => "Baba",
	'lastname' => "O'Riley"
);

array_walk($names, function(&$value, $key) {
	$value = htmlentities($value, ENT_QUOTES);
});

foreach ($names as $name) {
	print "$name\n";
}


/*For nested data*/
$names = array(
	'firstnames' => array(
			"Baba", 
			"Bill"
			),
	'lastnames' => array(
			"O'Riley", 
			"O'Reilly"
			)
);
array_walk_recursive($names, function (&$value, $key) {
	$value = htmlentities($value, ENT_QUOTES);
});

foreach ($names as $nametypes) {
	foreach ($nametypes as $name) {
		print "$name\n";
	}
}

/*Example that ensures all the data in the $names array is properly HTML encoded*/
$names = array(
	'firstname' => "Baba",
	'lastname' => "O'Riley"
);

array_walk($names, function (&$value, $key) {
	$value = htmlentities($value, ENT_QUOTES);
});

foreach ($names as $name) {
	print "$name\n";
}

/*When you have a series of nested arrays*/
$names = array(
	'firstnames' => array(
				"Baba", 
				"Bill"
				),
	'lastnames' => array(
				"O'Riley", 
				"O'Reilly"
				)
);

array_walk_recursive($names, function (&$value, $key) {
	$value = htmlentities($value, ENT_QUOTES);
});
foreach ($names as $nametypes) {
	foreach ($nametypes as $name) {
		print "$name\n";
	}
}
?>