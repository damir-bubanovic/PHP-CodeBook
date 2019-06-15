<?php 
/*

!!PARSING DATES AND TIMES FROM STRING!!

> Get a date or time in a string into a format you can use in calculations

*strtotime - parse about any English textual datetime description into a Unix timestamp
*date_default_timezone_set - sets the default timezone used by all date/time functions in a script

*/


/*Parsing strings with strtotime()*/
$a = strtotime('march 10'); // defaults to the current year
$b = strtotime('last thursday');
$c = strtotime('now + 3 months');

/*function strtotime() understands words about the current time*/
$a = strtotime('now');
print date(DATE_RFC850, $a);	// Tuesday, 12-Feb-13 19:12:14 UTC
print "\n";
$a = strtotime('today');
print date(DATE_RFC850, $a);	// Tuesday, 12-Feb-13 00:00:00 UTC

/*Different ways to identify a time and date*/
$a = strtotime('5/12/2014');
print date(DATE_RFC850, $a);	// Monday, 12-May-14 00:00:00 UTC
print "\n";
$a = strtotime('12 may 2014');
print date(DATE_RFC850, $a);	// Monday, 12-May-14 00:00:00 UTC

/*Relative times and dates*/
$a = strtotime('last thursday'); // On February 12, 2013
print date(DATE_RFC850, $a);	// Thursday, 07-Feb-13 00:00:00 UTC
print "\n";
$a = strtotime('2015-07-12 2pm + 1 month');
print date(DATE_RFC850, $a);	// Wednesday, 12-Aug-15 14:00:00 UTC

date_default_timezone_set('America/New_York');
$a = strtotime('2012-07-12 2pm America/New_York + 1 month');
print date(DATE_RFC850, $a);	// Sunday, 12-Aug-12 14:00:00 EDT

date_default_timezone_set('America/New_York');
$a = strtotime('2012-07-12 2pm America/Denver + 1 month');
print date(DATE_RFC850, $a);	// Sunday, 12-Aug-12 16:00:00 EDT

/*Parsing a date with a specific format*/
$dates = array('01/02/2015', '03/06/2015', '09/08/2015');
	foreach ($dates as $date) {
		$default = new DateTime($date);
		$day_first = DateTime::createFromFormat('d/m/Y|', $date);
		printf("The default interpretation is %s\n but day-first is %s.\n",
			$default->format(DateTime::RFC850),
			$day_first->format(DateTime::RFC850));
}
/*The default interpretation is Friday, 02-Jan-15 00:00:00 UTC
but day-first is Sunday, 01-Feb-15 00:00:00 UTC.
The default interpretation is Friday, 06-Mar-15 00:00:00 UTC
but day-first is Wednesday, 03-Jun-15 00:00:00 UTC.
The default interpretation is Tuesday, 08-Sep-15 00:00:00 UTC
but day-first is Sunday, 09-Aug-15 00:00:00 UTC.*/
?>