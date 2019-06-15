<?php 
/*

!!PERFORMANCE - TIMING PROGRAM EXECUTION BY STATEMENT!!

> You have a block of code and you want to profile it to see how long 
each statement takes to execute

> VISIBILITY
	- public		can be accessed everywhere
	- private		can only be accessed by the class that defines it
	- protected		can be accessed only within the class itself and by inherited classes (children)
	- static		properties or methods as static makes them accessible without needing an instantiation of the class
						> pseudo-variable $this is not available inside the method
						
> The ticks directive allows you to execute a function on a repeatable basis for a block of code. 
> The number assigned to ticks is how many statements go by before the functions that are registered 
using register_tick_function() are executed


*microtime - return current Unix timestamp with microseconds
*array_shift - shift an element off the beginning of array
*explode - split a string by string
*doubleval - get float value of a variable - use floatval  instead
*unset - unset a given variable
*register_tick_function - register a function for execution on each tick
*declare - used to set execution directives for a block of code
*$_SERVER - array containing information such as headers, paths, and script locations
*strlen - returns the length of the given string
*unregister_tick_function - de-register a function for execution on each tick

*/


/*Use the declare construct and the ticks directive*/
function profile($display = false) {
	
	static $times;
	
	
	switch($display) {
		case false:
			// add the current time to the list of recorded times
			$times[] = microtime();
			break;
		case true:
			// return elapsed times in microseconds
			$start = array_shift($times);
			$start_mt = explode(' ', $start);
			$start_total = doubleval($start_mt[0]) + $start_mt[1];
			
			foreach($times as $stop) {
				$stop_mt = explode(' ', $stop);
				$stop_total = doubleval($stop_mt[0]) + $stop_mt[1];
				$elapsed[] = $stop_total - $start_total;
			}
			
			unset($times);
			return $elapsed;
			break;
	}
}


// register tick handler
register_tick_function('profile');

// clock the start time
profile();

// execute code, recording time for every statement execution
declare(ticks = 1) {
	foreach($_SERVER['argv'] as $arg) {
		print "$arg: " . strlen($arg) . "\n";
	}
}

// print out elapsed times
print "---\n";

$i = 0;
foreach(profile(true) as $time) {
	$i++;
	print "Line $i: $time\n";
}



/*You can also set things up to call two functions every three statements*/
register_tick_function('profile');
register_tick_function('backup');
declare (ticks = 3) {
	// code...
}


/*You can also pass additional parameters into the registered functions,
which can be object methods instead of regular functions*/
// pass "parameter" into profile()
register_tick_function('profile', 'parameter');

// call $car->drive();
$car = new Vehicle;
register_tick_function(array($car, 'drive'));



/*Call unregister_tick_function() to remove a function from the list of tick functions*/
unregister_tick_function('profile');

?>