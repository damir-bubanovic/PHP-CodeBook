<?php 
/*

!!CONVERTING AN EPOHE TIMESTAMP!!

*explode - plit a string by string

*/


/*Set of time and date parts that corresponds to a particular epoch timestamp*/
$when = new DateTime("@163727100");
$when->setTimezone(new DateTimeZone('America/Los_Angeles'));
$parts = explode('/', $when->format('Y/m/d/H/i/s'));
// Year, month, day, hour, minute, second
// $parts is array('1975', '03','10', '16','45', '00'))
?>