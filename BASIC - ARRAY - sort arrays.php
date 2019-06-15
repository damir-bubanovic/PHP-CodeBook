<?php 
/*

!!SORT ARRAY!!

*sort - sort an array
	> bool sort ( array &$array [, int $sort_flags = SORT_REGULAR ] )
	> $sort_flags
		SORT_REGULAR - compare items normally (don't change types) -> DEFAULT
		SORT_NUMERIC - compare items numerically
		SORT_STRING - compare items as strings
		SORT_LOCALE_STRING - compare items as strings, based on the current locale. It uses the locale, which can be changed using setlocale()
		SORT_NATURAL - compare items as strings using "natural ordering" like natsort()
		SORT_FLAG_CASE - can be combined (bitwise OR) with SORT_STRING or SORT_NATURAL to sort strings case-insensitively
	> ALERT <
		This function assigns new keys to the elements in array. It will remove any existing 
		keys that may have been assigned, rather than just reordering the keys
		Be careful when sorting arrays with mixed types values because sort() can produce unpredictable results
	> ALERT <
		Use KSORT() to preserve associative keys 
		
	> if you're using this function on a multidimensional array, php will sort the first key, then the second and so on
	
*rsort - sort an array in reverse order
	> bool rsort ( array &$array [, int $sort_flags = SORT_REGULAR ] )
	> $sort_flags -> same as sort
	> same ALERT <
	> ALERT <
		Use KRSORT() to preserve associative keys 
*asort - sort an array and maintain index association
	> bool asort ( array &$array [, int $sort_flags = SORT_REGULAR ] )
*natsort - sort an array using a "natural order" algorithm
	> bool natsort ( array &$array )
		
*/


/*Sort*/
$cats = array('Tabitha', 'Mikica', 'Blackie', 'Marina');
sort($cats);
foreach($cats as $key => $value) {
	print 'fruits[' . $key . '] = ' . $value . '<br />';
}
/*
fruits[0] = Blackie
fruits[1] = Marina
fruits[2] = Mikica
fruits[3] = Tabitha
*/

/*MULTIDIMENSIONAL ARRAY*/
/*Before*/
$myArray = array( 
	[0] => array( [category] => work [name] => Smith ), 
	[1] => array( [category] => play [name] => Johnson ),
	[2] => array( [category] => work [name] => Berger )
)

/*After*/
$myArray = array( 
	[0] => array( [category] => play [name] => Johnson ),
	[1] => array( [category] => work [name] => Berger ), 
	[2] => array( [category] => work [name] => Smith ) 
)


/*Ksort*/
$fruits = array("lemon", "orange", "banana", "apple");
rsort($fruits);
foreach ($fruits as $key => $val) {
    echo "$key = $val\n";
}

$dogs = array('Fido', 'Blackie', 'Timmy', 'Spot', 'Ultra');
rsort($dogs);
foreach($dogs as $key => $value) {
	print 'dogs[' . $key . '] = ' . $value . '<br />';
}
/*
dogs[0] = Ultra
dogs[1] = Timmy
dogs[2] = Spot
dogs[3] = Fido
dogs[4] = Blackie
*/


/*sort an array using the traditional definition of sort*/
$states = array('Delaware', 'Pennsylvania', 'New Jersey');
sort($states);

/*sort numerically, pass SORT_NUMERIC as the second argument to sort()*/
$scores = array(1, 10, 2, 20);
sort($scores, SORT_NUMERIC);

/*preserve the key/value links - indexes of the entries are meaningful*/
$states = array(
	1 => 'Delaware', 
	'Pennsylvania', 
	'New Jersey'
);
asort($states);
while (list($rank, $state) = each($states)) {
	print "$state was the #$rank state to join the United States\n";
}

/*sort the array using a natural sorting algorithm*/
$tests = array(
	'test1.php', 
	'test10.php', 
	'test11.php', 
	'test2.php'
);
natsort($tests);

?>