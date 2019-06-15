<?php 
/*

!!FIND THE DAY OF THE WEEK, MONTH, YEAR!!

> You want to know the day or week of the year, the day of the week, or the day of the
month. For example, you want to print a special message every Monday, or on the first
of every month

*/


/*Finding days of the week, month, and year*/
print "Today is day " . date('d') . ' of the month and ' . date('z') .
	' of the year.';
print "\n";

$birthday = new DateTime('January 17, 1706', new DateTimeZone('America/New_York'));

print "Benjamin Franklin was born on a " . $birthday->format('l') . ", " .
"day " . $birthday->format('N') . " of the week.";

/*Day and week number format characters - pronađi na php.net*/

/*Print out something only on Mondays*/
if (1 == date('w')) {
	print "Welcome to the beginning of your work week.";
}
?>