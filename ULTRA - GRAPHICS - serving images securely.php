<?php 
/*

!!GRAPHICS - SERVING IMAGES SECURELY!!

> want to control who can view a set of images

> use also HTTP Basic and Digest Authentication

*header - send a raw HTTP header
*readfile - outputs a file
*explode - split a string by string
*date - format a local time/date
*mktime - get Unix timestamp for a date
*$_GET - associative array of variables passed to the current script via the URL parameters

*/


/*Don’t keep the images in your document root, but store them elsewhere. 
To deliver a file, manually open it and send it to the browser*/
header('Content-Type: image/png');
readfile('/path/to/graphic.png');



/*Here’s the solution. Files arrive named by date, so it’s easy to identify which files belong
to which day. Now, to lock out strips outside the rolling 14-day window, use code like
this*/

// display a comic if it's less than 14 days old and not in the future
// calculate the current date
list($now_m, $now_d,$now_y) = explode(',', date('m,d,Y'));
$now = mktime(0, 0, 0, $now_m, $now_d, $now_y);

// two-hour boundary on either side to account for dst
$min_ok = $now - 14*86400 - 7200; // 14 days ago
$max_ok = $now + 7200; // today
$mo = (int) $_GET['mo'];
$dy = (int) $_GET['dy'];
$yr = (int) $_GET['yr'];

// find the time stamp of the requested comic
$asked_for = mktime(0, 0, 0, $mo, $dy, $yr);

// compare the dates
if(($min_ok > $asked_for) || ($max_ok < $asked_for)) {
	print 'You are not allowed to view the comic for that day.';
} else {
	header('Content-type: image/png');
	readfile("/www/comics/{$mo}{$dy}{$yr}.png");
}

?>