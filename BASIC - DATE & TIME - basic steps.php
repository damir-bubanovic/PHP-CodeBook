<?php 
/*
1. Treat time internally as Coordinated Universal Time (abbreviated UTC and also known as GMT,Greenwich Mean Time)

2. Treat time not as an array of different values for month, day, year, minute, second, etc., 
but as seconds elapsed since the Unix epoch: midnight on January 1, 1970 (UTC, of course)

mktime() produces epoch timestamps from a given set of time parts, while
date(), given an epoch timestamp, returns a formatted time string
*/
	/*In exaple below we are finding on what day of the week New Year’s Day 1986 was*/
	$stamp = mktime(0,0,0,1,1,1986);
	print date('l',$stamp);	// prints Wednesday


/*
3. To ensure smooth date and time processing in your code, set the date.timezone configuration variable to an appropriate time zone, or call 
date_default_time zone_set() before you do any date or time operations
*/
?>