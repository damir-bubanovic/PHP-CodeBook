<?php
/*

!!IS DATE IN GREGHORIAN CALENDAR!!

*date - format a local time/date
	> string date ( string $format [, int $timestamp = time() ] )
	> više formata na php.net
*explode - split a string by string
	> array explode ( string $delimiter , string $string [, int $limit = PHP_INT_MAX ] )
*checkdate - validate a Gregorian date
	> bool checkdate ( int $month , int $day , int $year )
	> Checks the validity of the date formed by the arguments. A date is considered valid if each parameter is properly defined.

*/

$dateNow = date("d.m.Y");

$dateArray = explode(".", $dateNow);

if(checkdate($dateArray[1], $dateArray[0], $dateArray[2])) {
	print "Date accepted";
} else {
	print "Date invalid";
}
?>