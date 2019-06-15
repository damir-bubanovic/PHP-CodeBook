<?php 
/*

!!CREATE AND DEFINE A FUNCTION AS THE PROGRAM IS RUNNING!!

*/


/*create and define a function as your program is running*/
$increment = 7;
$add = function($i, $j) use ($increment) { return $i + $j + $increment; };
$sum = $add(1, 2);


/*frequent use for anonymous functions is to create custom 
sorting functions for usort() or array_walk()*/
$files = array('ziggy.txt', '10steps.doc', '11pants.org', "frank.mov");
// sort files in reverse natural order
usort($files, function($a, $b) { return strnatcmp($b, $a); });
// Now $files is
// array('ziggy.txt', 'frank.mov','11pants.org','10steps.doc')
?>