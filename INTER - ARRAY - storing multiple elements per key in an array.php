<?php 
/*

!!ASSOCIATE MILTIPLE ELEMENTS WITH A SINGLE KEY!!

*list - assign variables as if they were an array

*/


/*Store the multiple elements in an array*/
$fruits = array(
	'red' => array(
		'strawberry',
		'apple'
	),
	'yellow' => array(
		'banana'
	)
);
/*OR - use object*/
while ($obj = mysqli_fetch_assoc($r)) {
	$fruits[] = $obj;
}

/*Processing items in a loop*/
while (list($color,$fruit) = mysqli_fetch_assoc($r)) {
	$fruits[$color][] = $fruit;
}
/*Print the entries, loop through the array*/
foreach ($fruits as $color => $color_fruit) {
	// $color_fruit is an array
	foreach ($color_fruit as $fruit) {
		print "$fruit is colored $color.<br>";
	}
}

?>