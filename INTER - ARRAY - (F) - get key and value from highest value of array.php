<?php 
/*

!!GET KEY AND VALUE OF HIGHEST VALUE OF ARRAY!!

*max - find highest value
*list - assign variables as if they were an array
*each - return the current key and value pair from an array and advance the array cursor

*/


function highest_score($array) {
	$max_value = max($array);
	
	while(list($key, $value) = each($array)) {
		if($value == $max_value) {
			$max_index = $key;
		}
	}
	
	return array(
		'm' => $max_value,
		'i' => $max_index
	);
}



$list = array(
	1 => 43,
	2 => 22,
	3 => 107,
	4 => 5
);

print_r(highest_score($list));
/*Array ( [m] => 107 [i] => 3 )*/

?>