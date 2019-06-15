<?php
/*

!!UPPER CASE NAME!!

*ucwords - uppercase the first character of each word in a string
*strtolower - make a string lowercase
*strpos - find the position of the first occurrence of a substring in a string
*implode - join array elements with a string
*array_map - applies the callback FUNCTION to the elements of the given arrays
*explode - split a string by string

*/


function ucname($string) {
	$string = ucwords(strtolower($string));
	
	foreach($array('-', '\'') as $delimeter) {
		if(strpos($string, $delimeter) !== false) {
			$string = implode($delimeter, array_map('ucfirst', explode($delimeter, $string)));
		}
	}
	return $string;
}



$names =array(
  'JEAN-LUC PICARD',
  'MILES O\'BRIEN',
  'WILLIAM RIKER',
  'geordi la forge',
  'bEvErly CRuSHeR'
);
foreach($names as $name) { 
	print ucname("{$name}\n") . '<br />'; 
}

/*
Jean-Luc Picard 
Miles O'Brien 
William Riker 
Geordi La Forge 
Beverly Crusher 
*/
?>