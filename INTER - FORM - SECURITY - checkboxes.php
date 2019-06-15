<?php 
/*

!!VALIDATING FORM INPUT: CHECKBOXES!!

> want to make sure only valid checkboxes are checked
> example below figures out whether a checkbox was checked, unchecked, or had an invalid value submitted

*filter_has_var - checks if variable of specified type exists
*array_intersect - returns an array containing all the values of array1 that are present in all the arguments
*array_keys - return all the keys or a subset of the keys of an array

*/


/*Validating a single checkbox*/
// Generating the checkbox
$value = 'yes';
print "<input type='checkbox' name='subscribe' value='yes'/> Subscribe";

// Then, later, validating the checkbox
if(filter_has_var(INPUT_POST, 'subscribe')) {
		// A value was submitted and it's the right one
	if($_POST['subscribe'] == $value) {
		$subscribed = true;
	} else {
		// A value was submitted and it's the wrong one
		$subscribed = false;
		print 'Invalid checkbox value submitted.';
	}
} else {
	// No value was submitted
	$subscribed = false;
}

if($subscribed) {
	print 'You are subscribed';
} else {
	print 'You are not subscribed';
}



/*For a group of checkboxes, use an array of values to generate the checkboxes. Then, use array_intersect() 
to ensure that the set of submitted values is contained within the set of acceptable values*/
/*Validating a group of checkboxes*/
// Generating the checkboxes
$choices = array(
	'egss'	=>	'Eggs Benedict',
	'toast'   =>	'Buttered Toast with Jam',
	'coffe'   =>	'Piping Hot Coffe'
);

foreach($choices as $key => $choice) {
	print "<input type='checkbox' name='food[]' value='$key'/> $choice \n";
}

// Then, later, validating the radio button submission
if(array_intersect($_POST['food'], array_keys($choices)) != $_POST['food']) {
	print 'You must select only valid choices.';
}

?>