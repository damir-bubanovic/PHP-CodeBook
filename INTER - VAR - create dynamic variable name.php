<?php 
/*

!!CREATE DYNAMIC VARIABLE NAME!!

*/


/*construct a variable’s name dynamically npr. use variable 
names that match the field names from a database query*/
$animal = 'turtles';
$turtles = 103;
print $$animal;	// 103

/*COMPLEX EXAMPLE*/
$stooges = array('Moe','Larry','Curly');
$stooge_moe = 'Moses Horwitz';
$stooge_larry = 'Louis Feinberg';
$stooge_curly = 'Jerome Horwitz';

foreach ($stooges as $s) {
	print "$s's real name was ${'stooge_'.strtolower($s)}.\n";
}

/*check if a title matches any of those values*/
for ($i = 1; $i <= $n; $i++) {
	$t = "title_$i";
	if ($title == $$t) { 
		/* match */ 
	}
}
?>