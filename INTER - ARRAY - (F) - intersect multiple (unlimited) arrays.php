<?php 
/*

!!INTERSECT MULTIPLE ARRAYS!!

*array_pop - pop the element off the end of array
*in_array - checks if a value exists in an array
*unset - destroys the specified variables

*/


/*Pass an array containing all the arrays you want to compare, along with what key to match by*/
function multipleArrayIntersect($arrayOfArrays, $matchKey) {
	$compareArray = array_pop($arrayOfArrays);
	
	foreach($compareArray as $key => $valueArray) {
		foreach($arrayOfArrays as $subArray => $contents) {
			if(!in_array($compareArray[$key][$matchKey], $contents)) {
				unset($compareArray[$key]);
			}
		}
	}
	
	return $compareArray;
}
?>