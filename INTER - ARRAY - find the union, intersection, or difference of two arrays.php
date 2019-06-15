<?php 
/*

!!FIND THE UNION - INTESECTION - DIFFERENCE IN ARRAY!!

*array_unique - removes duplicate values from an array
*array_merge - merge one or more arrays
*array_intersect - computes the intersection of arrays 
*array_diff - computes the difference of arrays
*strtolower - make a string lowercase
*array_map - applies the callback FUNCTION to the elements of the given arrays

*/


/*You have a pair of arrays, and you want to find their union (all the elements), 
intersection (elements in both, not just one), or difference (in one but not both)*/
$union = array_unique(array_merge($a, $b));

$intersection = array_intersect($a, $b);

/*simple difference*/
$difference = array_diff($a, $b);
/*OR*/
$old = array('To', 'be', 'or', 'not', 'to', 'be');
$new = array('To', 'be', 'or', 'whatever');
$difference = array_diff($old, $new);
print_r($difference);

/*reverse difference - o find the unique elements in $new that are lacking in $old*/
$old = array('To', 'be', 'or', 'not', 'to', 'be');
$new = array('To', 'be', 'or', 'whatever');
$reverse_diff = array_diff($new, $old);
print_r($reverse_diff);

/*symmetric difference*/
$difference = array_merge(array_diff($a, $b), array_diff($b, $a));

/*apply a function or other filter to array_diff()*/
// implement case-insensitive diffing; diff -i
$seen = array();
foreach ($new as $n) {
	$seen[strtolower($n)]++;
}

foreach ($old as $o) {
	$o = strtolower($o);
	if (!$seen[$o]) { 
		$diff[$o] = $o; 
	}
}

/*Little faster to combine array_diff() with array_map()*/
$diff = array_diff(array_map('strtolower', $old), array_map('strtolower', $new));
?>