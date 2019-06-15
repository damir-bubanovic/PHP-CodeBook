<?php 
/*

!!DATE / TIME / TIMEZONE!!


*date - format a local time/date
	> string date ( string $format [, int $timestamp = time() ] )
	> sve pise na http://php.net/manual/en/function.date.php
	> sav code ti može biti napisan kao $time - pogeldaj

*/


$dayInWeek = date("l");
$dayInMonth = date("jS");
$month = date("F");
$year = date("Y");
$time = date("G:i:s a");


print $dayInWeek .  ", " . $month . " " . $dayInMonth . " " . $year . ", " . $time;
/*printa Saturday, September 26th 2015, 12:12:35 pm*/

?>