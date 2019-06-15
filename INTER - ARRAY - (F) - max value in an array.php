<?php 
/*

!!MAX VALUE IN ARRAY!!

*max — find highest value (simple)

*/


$arrTest = array(
    array( "day" => 1, "b" => 10 ),
    array( "day" => 2, "b" => 43 ),
    array( "day" => 3, "b" => 2 ),
    array( "day" => 4, "b" => -3 ),
    array( "day" => 5, "b" => 4 ),
    array( "day" => 6, "b" => -5 )
);




function maxValueInArray($array, $keyToSearch) {
	$currentMax = NULL;
	
	foreach($array as $arr) {
		foreach($arr as $key => $value) {
			if($key == $keyToSearch && ($value >= $currentMax)) {
				$currentMax = $value;
			}
		}
	}
	
	return $currentMax;
}


$value = maxValueInArray($arrTest, "b");
// 43
?>