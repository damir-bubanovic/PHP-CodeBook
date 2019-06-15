<?php 
/*

!!ENSURE ARGUMENT VALUES HAVE CERTAIN TYPES!!

*is_array - finds whether a variable is an array

*/

/*Ensure argument values have certain types*/
/*Use type hints on the arguments when you define your function*/
function drink_juice(Liquid $drink) {
	/* ... */
}
function enumerate_some_stuff(array $values) {
	/* ... */
}


/*EXAMPLE*/
function must_be_an_array(array $fruits) {
	foreach ($fruits as $fruit) {
		print "$fruit\n";
	}
}
function array_or_null_is_ok(array $fruits = null) {
	if (is_array($fruits)) {
		foreach ($fruits as $fruit) {
			print "$fruit\n";
		}
	}
}
?>