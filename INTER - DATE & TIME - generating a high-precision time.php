<?php 
/*

!!GENERATE A HIGH PRECISION TIME!!

> Measure time with finer than one-second resolution—for example, 
npr. generate a unique ID or benchmark a function call

*microtime - return current Unix timestamp with microseconds
*preg_match - perform a regular expression match
*explode - split a string by string
*getmypid - Gets PHP's process ID
	> ALERT <
		Process IDs are not unique, thus they are a weak entropy source. 
		We recommend against relying on pids in security-dependent contexts

*/


/*Timing with microtime()*/
$start = microtime(true);
for ($i = 0; $i < 1000; $i++) {
	preg_match('/age=\d{1,5}/',$_SERVER['QUERY_STRING']);
}
$end = microtime(true);
$elapsed = $end - $start;

/*Generating an ID with microtime()*/
list($microseconds,$seconds) = explode(' ',microtime());
$id = $seconds.$microseconds.getmypid();
?>