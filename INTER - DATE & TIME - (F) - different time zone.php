<?php 
/*

!!DATE - DIFFERENT TIME ZONE!!

> If you have a problem with the different time zone, this is the solution for that

*date_default_timezone_get - gets the default timezone used by all date/time functions in a script
*date_default_timezone_set - sets the default timezone used by all date/time functions in a script
*date - format a local time/date

*/


// first line of PHP
$defaultTimeZone='UTC';
if(date_default_timezone_get() != $defaultTimeZone) {
	date_default_timezone_set($defaultTimeZone);
}

// somewhere in the code
function _date($format="r", $timestamp=false, $timezone=false) {
    $userTimezone = new DateTimeZone(!empty($timezone) ? $timezone : 'GMT');
    $gmtTimezone = new DateTimeZone('GMT');
    $myDateTime = new DateTime(($timestamp != false ? date("r",(int)$timestamp) : date("r")), $gmtTimezone);
    $offset = $userTimezone->getOffset($myDateTime);
    return date($format, ($timestamp!=false?(int)$timestamp : $myDateTime->format('U')) + $offset);
}

/* Example */
print 'System Date/Time: '.date("Y-m-d | h:i:sa").'<br>';
print 'New York Date/Time: ' . _date("Y-m-d | h:i:sa", false, 'America/New_York').'<br>';
print 'Belgrade Date/Time: ' . _date("Y-m-d | h:i:sa", false, 'Europe/Belgrade').'<br>';
print 'Belgrade Date/Time: ' . _date("Y-m-d | h:i:sa", 514640700, 'Europe/Belgrade').'<br>';

?>