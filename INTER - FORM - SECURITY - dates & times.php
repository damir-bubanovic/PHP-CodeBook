<?php 
/*

!!VALIDATING FORM INPUT: DATES & TIMES!!

> want to make sure that a date or time a user entered is valid
	> npr. you want to ensure that a user hasn’t attempted to schedule an event for the 45th of August or provided a credit card that has already expired

> if your form provides month, day, and year as separate elements, plug those values into checkdate()

> checkdate() function is handy because it knows about leap year and how many days are in each month, saving you from tedious comparisons of each component of
the date. For range validations—making sure a date or time is before, after, or between other dates or times—it’s easiest to work with epoch timestamps

*checkdate - validate a Gregorian date
*mktime - get Unix timestamp for a date
*strtotime - parse about any English textual datetime description into a Unix timestamp
*time - return current Unix timestamp

*/


/*Checking a particular date*/
if(!checkdate($_POST['month'], $_POST['day'], $_POST['year'])) {
	print "The date you entered doesn't exist";
}


/*To check that a date is before or after a particular value, convert the user-supplied values
to a timestamp, compute the timestamp for the threshhold date, and compare the two*/
/*Checking credit card expiration*/
// The beginning of the month in which the credit card expires
$expires = mktime(0, 0, 0, $_POST['month'], 1, $_POST['year']);
// The beginning of the previous month
$lastMonth = strtotime('last month', $expires);
if(time() > $lastMonth) {
	print 'Sorry, that credit card expired too soon';
}

?>