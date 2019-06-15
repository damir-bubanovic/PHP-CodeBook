<?php
/*

!!ARRAY UNPOP!!

*unset - destroys the specified variables
*array_merge - merge one or more arrays

*/


function array_unpop($array) {
	$args = func_get_args();
	unset($args[0]);
	
	$tarr = array();
	
	foreach($args as $arg) {
		$tarr[] = $arg;
	}
	$arg = array_merge($array, $tarr);
}


$queue = array("orange", "banana");
array_unpop($queue, "apple", "raspberry");
print_r($queue);

/*Array ( [0] => orange [1] => banana [2] => apple [3] => raspberry )*/
?>