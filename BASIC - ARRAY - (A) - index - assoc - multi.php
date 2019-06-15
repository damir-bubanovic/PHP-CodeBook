<?php 
/*

!!BASIC ARRAY - INDEXED & ASSOCIATIVE & MULTIDIMENSIONAL!!

ARRAY - array is a special variable, which can hold more than one value at a time
	> 3 types of arrays:
		> Indexed arrays - Arrays with a numeric index
			> index key always starts at 0
		> Associative arrays - Arrays with named keys
		> Multidimensional arrays - Arrays containing one or more arrays
*list - assign variables as if they were an array
	> array list ( mixed $var1 [, mixed $... ] )
	> returns the assigned array
	> ALERT <
		list() only works on numerical arrays and assumes the numerical indices start at 0

*/

/*indexed*/
$cats = array('Tabitha', 'Blackie', 'Grumpy', 'Hissy', 'Timmy');

$array_length = count($cats);
for($x = 0; $x < $array_length; $x++) {
    print $cats[$x] . '<br />';
}


/*associative*/
$dogs = array(
	'house' => 'Fido',
	'shelter' => 'Scrappy',
	'village' => 'Marky',
	'comfort' => 'Yellow'
);

foreach($dogs as $dog) {
    print 'Key=' . $x . ', Value=' . $dog . '<br />';
}

$arr = array('foo', 'bar');
foreach ($arr as $value) {
    print "The value is $value.";
}

$arr = array('key' => 'value', 'foo' => 'bar');
foreach ($arr as $key => $value) {
    print "Key: $key, value: $value";
}


/*multidimensional*/
$cars = array(
  array("Volvo",22,18),
  array("BMW",15,13),
  array("Saab",5,2),
  array("Land Rover",17,15)
);

for ($row = 0; $row < 4; $row++) {
  print "<p><b>Row number $row</b></p>";
  print "<ul>";
  for ($col = 0; $col < 3; $col++) {
    print "<li>".$cars[$row][$col]."</li>";
  }
  print "</ul>";
}

/*Break arrays apart into individual variables*/
$fruits = array('Apples', 'Bananas', 'Cantaloupes', 'Dates');
list($red, $yellow, $beige, $brown) = $fruits;
?>