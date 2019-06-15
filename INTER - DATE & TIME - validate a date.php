<?php 
/*

!!VALIDATE A DATE!!

> check if a date is valid npr. make sure a user hasn’t provided a birthdate

*checkdate - validate a Gregorian date

*/


/*check if a date is valid npr. make sure a user hasn’t provided a birthdate*/
$ok = checkdate(3, 10, 1993);		// $ok is true - March 10, 1993 is a valid date
$not_ok = checkdate(2, 30, 1962);	// $not_ok is false - February 30, 1962 is not a valid date


/*checkbirthdate()*/
function checkbirthdate($month,$day,$year) {
	$min_age = 18;
	$max_age = 122;
	
	if(!checkdate($month,$day,$year)) {
		return false;
	}
	
	$now = new DateTime();
	$then_formatted = sprintf("%d-%d-%d", $year, $month, $day);
	$then = DateTime::createFromFormat("Y-n-j|",$then_formatted);
	$age = $now->diff($then);
	
	if(($age->y < $min_age)|| ($age->y > $max_age)) {
		return FALSE;
	} else {
		return TRUE;
	}
}

// check December 3, 1974
if (checkbirthdate(12,3,1974)) {
	print "You may use this web site.";
} else {
	print "You are too young (or too old!!) to proceed.";
}
?>