<?php 
/*

!!FIND CURRENT DATE & TIME!!

*getdate - get date/time information
*localtime - get the local time

*/


print date('r');	// Fri, 01 Feb 2013 14:23:33 -0500
/*OR*/
$when = new DateTime();
print $when->format('r');	// Fri, 01 Feb 2013 14:23:33 -0500

/*Finding time parts*/
$now_1 = getdate();
$now_2 = localtime();
print "{$now_1['hours']}:{$now_1['minutes']}:{$now_1['seconds']}\n";	// 18:23:45
print "$now_2[2]:$now_2[1]:$now_2[0]";	// 18:23:45

/*Associative array getdate() returns the key/value pairs*/
Key 		Value
seconds 	Seconds
minutes 	Minutes
hours 		Hours
mday 		Day of the month
wday 		Day of the week, numeric (Sunday is 0, Saturday is 6)
mon 		Month, numeric
year 		Year, numeric (4 digits)
yday 		Day of the year, numeric (e.g., 299)
weekday 	Day of the week, textual, full (e.g., “Friday”)
month 		Month, textual, full (e.g., “January”)
0 			Seconds since epoch (what time() returns)

/*Finding the month, day, and year*/
$a = getdate();
printf('%s %d, %d',$a['month'],$a['mday'],$a['year']);	// February 4, 2013

/*getdate() with a specific timestamp*/
$a = getdate(163727100);
printf('%s %d, %d',$a['month'],$a['mday'],$a['year']);	// March 10, 1975

/*Return array from localtime()*/
Numeric position 	Key 		Value
0 					tm_sec 		Second
1 					tm_min 		Minutes
2 					tm_hour 	Hour
3 					tm_mday 	Day of the month
4 					tm_mon 		Month of the year (January is 0)
5 					tm_year 	Years since 1900
6 					tm_wday 	Day of the week (Sunday is 0)
7 					tm_yday 	Day of the year
8 					tm_isdst 	Is daylight saving time in effect?

/*Using localtime()*/
$a = localtime();
$a[4] += 1;
$a[5] += 1900;
print "$a[4]/$a[3]/$a[5]";	// 2/4/2013
?>