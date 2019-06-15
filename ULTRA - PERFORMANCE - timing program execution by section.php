<?php 
/*

!!PERFORMANCE - TIMING PROGRAM EXECUTION BY SECTION!!

> You have a block of code and you want to profile it to 
see how long each statement takes to execute

*/


/*Use the PEAR Benchmark module*/
require_once 'Benchmark/Timer.php';

$timer = new Benchmark_timer(true);
$timer->start();

// some setup code here
$timer->setMarker('setup');

// some more code executed here
$timer->setMarker('middle');

// even yet still more code here
$timer->setmarker('done');	// brijem da treba setMarker

// and a last bit of code here
$timer->stop();
$timer->display();



/*The Benchmark module also includes the Benchmark_Iterate class, which 
can be used to time many executions of a single function*/
require 'Benchmark/Iterate.php';

$timer = new Benchmark_Iterate;

// a sample function to time
function use_preg($ar) {
	for($i = 0, $j = count($ar); $i < $j; $i++) {
		if(preg_match('/gouda/', $ar[$i])) {
			// it's gouda
		}
	}
}

// another sample function to time
function use_equals($ar) {
	for($i = 0, $j = count($ar); $i < $j; $i++) {
		if('gouda' == $ar[$i]) {
			// it's gouda
		}
	}
}


// run use_preg() 1000 times
$timer->run(1000, 'use_preg', array('gouda','swiss','gruyere','muenster','whiz'));
$results = $timer->get();
print "Mean execution time for use_preg(): $results[mean]\n";

// run use_equals() 1000 times
$timer->run(1000,'use_equals', array('gouda','swiss','gruyere','muenster','whiz'));
$results = $timer->get();
print "Mean execution time for use_equals(): $results[mean]\n";

?>