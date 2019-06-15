<?php 
/*

!!CONVERT DATE & TIME STAMPS TO AN EPOHE TIMESTAMP!!

> want to know what epoch timestamp corresponds to a set of time and date parts

*mktime - get Unix timestamp for a date
*gmmktime - get Unix timestamp for a GMT date
*date_default_timezone_set - sets the default timezone used by all date/time functions in a script
*date - format a local time/date

*/


/*Getting a specific epoch timestamp*/
// 7:45:03 PM on March 10, 1975, local time
// Assuming your "local time" is US Eastern time
$then = mktime(19,45,3,3,10,1975);

/*Getting a specific GMT-based epoch timestamp*/
// 7:45:03 PM on March 10, 1975, in GMT
$then = gmmktime(19,45,3,3,10,1975);

/*Getting a specific epoch timestamp from a formatted time string*/
// 7:45:03 PM on March 10, 1975, in a particular timezone
$then = DateTime::createFromFormat(DateTime::ATOM, "1975-03-10T19:45:03-04:00");

/*Working with epoch timestamps*/
date_default_timezone_set('America/New_York');
// $stamp_future is 1733257500
$stamp_future = mktime(15,25,0,12,3,2024);
// $formatted is '2024-12-03T15:25:00-05:00'
$formatted = date('c', $stamp_future);

/*Epoch timestamps and gmmktime()*/
date_default_timezone_set('America/New_York');
// $stamp_future is 1733239500, whch is 18000
// smaller than 1733257500
$stamp_future = gmmktime(15,25,0,12,3,2024);

/*Format characters for DateTime::createFromFormat( )*/
Character 				Meaning
space or tab
# 						Any one of the separation bytes ;, :, /, ., ,, -, (, )
;, :, /, ., ,, -, (, ) 	Literal character
? 						Any byte (not a character, just one byte)
* 						Any number of bytes until the next digit or separation character
! 						Reset all fields to “start of Unix epoch” values (without this, any unspecified fields will be set to the current date/time)
| 						Reset any unparsed fields to “start of Unix epoch” values
+ 						Treat unparsed trailing data as a warning rather than an error

/*Using DateTime::createFromFormat()*/
$text = "Birthday: May 11, 1918.";
$when = DateTime::createFromFormat("*: F j, Y.|", $text);
// $formatted is "Saturday, 11-May-18 00:00:00 UTC"
$formatted = $when->format(DateTime::RFC850);
?>