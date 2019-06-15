<?php 
/*

!!CALCULATE TIMES IN DIFFERENT TIME ZONES!!

> give users information adjusted to their local time, not the local time of your server

*date_default_timezone_set - sets the default timezone used by all date/time functions in a script

*/


/*Simple time zone usage*/
$nowInNewYork = new DateTime('now', new DateTimeZone('America/New_York'));
$nowInCalifornia = new DateTime('now', new DateTimeZone('America/Los_Angeles'));

printf("It's %s in New York but %s in California.",
	$nowInNewYork->format(DateTime::RFC850),
	$nowInCalifornia->format(DateTime::RFC850));
	/*It's Friday, 15-Feb-13 14:50:25 EST in New York but
	Friday, 15-Feb-13 11:50:25 PST in California.*/
	
/*Changing time zone with date_default_timezone_set()*/
$now = time();
date_default_timezone_set('America/New_York');
print date(DATE_RFC850, $now);
print "\n";

date_default_timezone_set('Europe/Paris');
print date(DATE_RFC850, $now);
?>