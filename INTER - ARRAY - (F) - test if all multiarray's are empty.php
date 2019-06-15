<?php 
/*

!!TEST IF ALL MULTIARRAYS ARE EMPTY!!

*is_array - finds whether a variable is an array
*array_shift - shift an element off the beginning of array
*empty - determine whether a variable is empty

*/

function is_multiArrayEmpty($array) {
	if(is_array($array) && !empty($array)) {
		$tmp = array_shift($array);
		
		if(!is_multiArrayEmpty($array) || !is_multiArrayEmpty($tmp)) {
			return false;
		}
		return true;
	}
	if(empty($array)) {
		return true;
	}
	return false;
}
 

$testCase = array (     
	0 => '', 
	1 => "", 
	2 => null, 
	3 => array(), 
	4 => array(array()), 
	5 => array(array(array(array(array())))), 
	6 => array(array(), array(), array(), array(), array()), 
	7 => array(array(array(), array()), array(array(array(array(array(array(), array())))))), 
	8 => array(null), 
	9 => 'not empty', 
	10 => "not empty", 
	11 => array(array("not empty")), 
	12 => array(array(),array("not empty"),array(array())) 
); 

foreach ($testCase as $key => $case ) { 
    print "$key is_multiArrayEmpty= ".is_multiArrayEmpty($case)."<br>"; 
}

/*
0 is_multiArrayEmpty= 1 
1 is_multiArrayEmpty= 1 
2 is_multiArrayEmpty= 1 
3 is_multiArrayEmpty= 1 
4 is_multiArrayEmpty= 1 
5 is_multiArrayEmpty= 1 
6 is_multiArrayEmpty= 1 
7 is_multiArrayEmpty= 1 
8 is_multiArrayEmpty= 1 
9 is_multiArrayEmpty= 
10 is_multiArrayEmpty= 
11 is_multiArrayEmpty= 
12 is_multiArrayEmpty=
*/

?>