<?php 
/*

!!VALIDATING FORM INPUT: RADIO BUTTONS!!

> want to make sure a valid radio button is selected from a group of radio buttons
> use an array of values to generate the menu. Then validate the input by checking that the submitted value is in the array

*array_key_exists - checks if the given key or index exists in the array

*/


/*Validating a radio button*/
// Generating the radio buttons
$choices = array(
	'egss'	=>	'Eggs Benedict',
	'toast'   =>	'Buttered Toast with Jam',
	'coffe'   =>	'Piping Hot Coffe'
);

foreach($choices as $key => $choice) {
	print "<input type='radio' name='food' value='$key'/> $choice \n";
}

// Then, later, validating the radio button submission
if(!array_key_exists($_POST['food'], $choices)) {
	print 'You must select a valid choice.';
}



/*To ensure that one of a set of radio buttons is chosen in a well-behaved web browser, give the default choice a checked="checked" attribute*/
// Defaults
$defaults['food'] = 'toast';

// Generating the radio buttons
$choices = array(
	'egss'	=>	'Eggs Benedict',
	'toast'   =>	'Buttered Toast with Jam',
	'coffe'   =>	'Piping Hot Coffe'
);

foreach($choices as $key => $choice) {
	print "<input type='radio' name='food' value='$key'";
	
	if($key == $defaults['food']) {
		print ' checked="checked"';
	}
	print "/> $choice \n";
}

// Then, later, validating the radio button submission
if(!array_key_exists($_POST['food'], $choices)) {
	print 'You must select a valid choice';
}
?>