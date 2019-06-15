<?php 
/*

!!RANDOMIZE ARRAY ELEMENTS!!

> mayby better to use mt_rand
*shuffle - randomize an array elements
	> bool shuffle ( array &$array )
	> ALERT <
		function assigns new keys to the elements in array. It will remove any existing 
		keys that may have been assigned, rather than just reordering the keys
> preserve key => value of associative arrays in function below

*/


/*scramble the elements of an array in a random order*/
$cats = array(
	'house' => 'Tabitha',
	'work' => 'Micika',
	'friend' => 'Snuggle Puss',
	'lover' => 'Whitey',
	'shelter' => 'Old Faithfull'
);

shuffle($cats);
foreach($cats as $cat) {
	print $cat . ', ';
}


/*shuffle for associative arrays, preserves key=>value pairs*/
function shuffle_assoc(&$array) {
	$keys = array_keys($array);

	shuffle($keys);

	foreach($keys as $key) {
		$new[$key] = $array[$key];
	}

	$array = $new;

	return true;
}
?>