<?php 
/*

!!ROUND UP OR ROUND DOWN NUMBERS!!

> round up - rounds up a float to a specified number of decimal places (basically acts like ceil() but allows for decimal places)
> round out - rounds a float away from zero to a specified number of decimal places
*pow - returns base raised to the power of exp
*ceil - round fractions up
*floor - round fractions down
*str_pad - pad a string to a certain length with another string

*/


/*ROUND UP*/
function round_up($value, $places = 0) {
	if($places < 0) {
		$places = 0;
	}
	
	$mult = pow(10, $places);
	
	return ceil($value * $mult) / $mult;
}

/*ROUND OUT*/
function round_out($value, $places = 0) {
	if($places < 0) {
		$places = 0;
	}
	
	$mult = pow(10, $places);
	
	return ($value >= 0 ? ceil($value * $mult) : floor($value * $mult)) / $mult;
}

print round_up (56.77001, 2); // displays 56.78
print round_up (-0.453001, 4); // displays -0.453
print round_out (56.77001, 2); // displays 56.78
print round_out (-0.453001, 4); // displays -0.4531



/*

- PHP_ROUND_UP - Always round up.
- PHP_ROUND_DOWN - Always round down.

*/

/*In accounting, it's often necessary to always round up, or down to a precision of thousandths*/
function round_up($number, $precision = 2) {
    $fig = (int) str_pad('1', $precision, '0');
    return (ceil($number * $fig) / $fig);
}


function round_down($number, $precision = 2) {
    $fig = (int) str_pad('1', $precision, '0');
    return (floor($number * $fig) / $fig);
}

?>