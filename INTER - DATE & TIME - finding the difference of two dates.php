<?php 
/*

!!FIND THE DIFFERENCE OF TWO DATES!!

> find the elapsed time between two dates, npr. you want to tell a 
user how long it’s been since she last logged on to your site

*floor - round fractions down

*/


/*Calculating the difference between two dates*/
// 7:32:56 pm on May 10, 1965
$first = 	new DateTime("1965-05-10 7:32:56pm",
			new DateTimeZone('America/New_York'));
// 4:29:11 am on November 20, 1962
$second = 	new DateTime("1962-11-20 4:29:11am",
			new DateTimeZone('America/New_York'));
$diff = $second->diff($first);

printf("The two dates have %d weeks, %s days, " .
	"%d hours, %d minutes, and %d seconds " .
	"elapsed between them.",
	floor($diff->format('%a') / 7),
	$diff->format('%a') % 7,
	$diff->format('%h'),
	$diff->format('%i'),
	$diff->format('%s'));	
/*prints - The two dates have 128 weeks, 6 days, 15 hours, 
3 minutes, and 45 seconds elapsed between them.*/


/*Calculating the elapsed-time difference between two dates*/
// 7:32:56 pm on May 10, 1965
$first_local = 	new DateTime("1965-05-10 7:32:56pm",
				new DateTimeZone('America/New_York'));
// 4:29:11 am on November 20, 1962
$second_local = new DateTime("1962-11-20 4:29:11am",
				new DateTimeZone('America/New_York'));
				
$first = new DateTime('@' . $first_local->getTimestamp());
$second = new DateTime('@' . $second_local->getTimestamp());
$diff = $second->diff($first);
printf("The two dates have %d weeks, %s days, " .
	"%d hours, %d minutes, and %d seconds " .
	"elapsed between them.",
	floor($diff->format('%a') / 7),
	$diff->format('%a') % 7,
	$diff->format('%h'),
	$diff->format('%i'),
	$diff->format('%s'));
/*prints - The two dates have 128 weeks, 6 days, 14 hours, 
3 minutes, and 45 seconds elapsed between them.*/

?>