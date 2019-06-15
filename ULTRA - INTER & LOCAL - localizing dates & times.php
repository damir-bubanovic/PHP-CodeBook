<?php 
/*

!!INTER & LOCAL - LOCALIZING DATES & TIMES!!

> want to display dates and times in a locale-specific manner

> Look up - Date and time format pattern characters

*/


/*Use the date or time argument type, with an optional short, 
medium, long, or full style inside a MessageFormatter message*/
$when = 1376943432;	// Seconds since epoch
$message = "It is {0,time,short} on {0,date,medium}.";
$fmt = new MessageFormatter('en_US', $message);
print $fmt->format(array($when));
/*
OUTPUT:
It is 4:17 PM on Aug 19, 2013
*/



/*Use a formatting pattern with a date or time argument type inside a 
MessageFormatter message*/
$when = 1376943432; // Seconds since epoch
$message = "Maintenant: {0,date,eeee dd MMMM y}";
$fmt = new MessageFormatter('fr_FR', $message);
print $fmt->format(array($when));
/*
OUTPUT:
Maintenant: lundi 19 août 2013
*/



/*Use the format() method of an IntlDateFormatter*/
$when = 1376943432; // Seconds since epoch
$fmt = new IntlDateFormatter('en_US', IntlDateFormatter::FULL, IntlDateFormatter::FULL);
print $fmt->format($when);
/*
OUTPUT:
Monday, August 19, 2013 at 8:17:12 PM GMT
*/



/*Although a date or time argument type in a MessageFormatter message expects an
integer argument representing seconds since epoch, the IntlDateFormatter accomodates
more ways to specify the time or date you care about.*/
$fmt = new IntlDateFormatter(
	'en_US', IntlDateFormatter::FULL,
	IntlDateFormatter::FULL, 'America/Chicago'
);

// Z for time zone means UTC
$obj = new DateTime('2013-08-20T12:34:56Z');
$parts = array(
	'tm_sec' => 56,
	'tm_min' => 34,
	'tm_hour' => 12,
	'tm_mday' => 20,
	'tm_mon' => 7, /* 0 = January */
	'tm_year' => 113 /* 0 = 1900 */
);

print $fmt->format($obj) . "\n";
print $fmt->format($parts) . "\n";
/*
OUTPUT:
Tuesday, August 20, 2013 at 7:34:56 AM Central Daylight Time
Tuesday, August 20, 2013 at 12:34:56 PM Central Daylight Time
*/



/*DateTime object, format, and locale*/
$obj = new DateTime('2013-08-20T12:34:56');
print IntlDateFormatter::formatObject($obj, 'eeee dd MMMM y', 'es_ES') . "\n";
print IntlDateFormatter::formatObject($obj, IntlDateFormatter::FULL, 'fr_FR') . "\n";

// First element is date format, second is time format
$formats = array(IntlDateFormatter::FULL, IntlDateFormatter::SHORT);
print IntlDateFormatter::formatObject($obj, $formats, 'de_DE') . "\n";
/*
OUTPUT:
martes 20 agosto 2013
mardi 20 août 2013 12:34:56 UTC
Dienstag, 20. August 2013 12:34
*/

?>