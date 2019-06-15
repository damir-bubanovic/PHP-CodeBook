<?php 
/*

!!ACESS GLOBAL VARIABLE INSIDE A FUNCTIONS!!

> global variable is a variable outside function
		$kitty = 'tabitha' -> global variable
		function my_animal() {
			$dogs = 'Spot' -> local variable
			$cats = global $kitty -> access global variable
		}
*unset - destroys the specified variables

*/


/*Bring the global variable into local scope with the global keyword*/
function eat_fruit($fruit) {
	global $chew_count;
	
	for ($i = $chew_count; $i > 0; $i--) {
		/* ... */
	}
}

/*OR*/

/*Reference it directly in $GLOBALS*/
function eat_fruit($fruit) {
	for ($i = $GLOBALS['chew_count']; $i > 0; $i--) {
		/* ... */
	}
}


/*bring multiple global variables into local scope*/
global $age, $gender, $shoe_size;


/*specify the names of global variables using variable variables*/
$which_var = 'age';
global $which_var; // refers to the global variable $age


/*Unset the variable in the global scope*/
$food = 'pizza';
$drink = 'beer';

function party() {
	global $food, $drink;
	unset($food); // eat pizza
	unset($GLOBALS['drink']); // drink beer
}

print "$food: $drink\n";
party();
print "$food: $drink\n";
?>