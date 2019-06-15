<?php 
/*

!!PERFORMANCE - TIMING PROGRAM EXECUTION BY FUNCTION!!

> You have a block of code and you want to profile it to see how long each function 
takes to execute

> The Xdebug extension provides a wide range of helpful debugging and profiling features.
	>> It’s available via PECL or as a prebuilt Windows binary
	>> Its function-tracing feature provides insight into what functions are called from where,
	optionally including the arguments passed and returned. 
	>> It also records the time and memory taken for each call

> LOOK UP - Xdebug

*/


/*Use Xdebug function tracing*/
xdebug_start_trace('/tmp/factorial-trace');

function factorial($x) {
	return ($x == 1) ? 1 : $x * factorial($x - 1);
}

print factorial(10);
xdebug_stop_trace;



/*Xdebug allows you to format these results in a number of ways. This specific 
output format uses the following configuration parameters*/
xdebug.trace_format=0 ; human readable plain text
xdebug.collect_params=4 ; full variable contents and variable name.
xdebug.collect_return=1 ; show return values

?>