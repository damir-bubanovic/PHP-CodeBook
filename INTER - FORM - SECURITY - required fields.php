<?php 
/*

!!VALIDATING FORM INPUT: REQUIRED FILEDS!!

> want to make sure a value has been supplied for a form element. npr. you want to make sure a text box hasn’t been left blank

*filter_has_var - checks if variable of specified type exists ($type at php.net)
*strlen - get string length
*filter_input - gets a specific external variable by name and optionally filters it

> ALERT <
	To make your code as robust as possible, always check that a particular element exists in the 
	appropriate set of input data before applying other validation strategies to the element
	
	In a moment of weakness, you may be tempted to use empty() instead of strlen() to test if a value has been entered in a text box. 
	Succumbing to such weakness leads to problems since the one character string 0 is false

*/


/*filter_has_var() to see if the element exists in the appropriate input array*/
/*Testing a required field*/
if(!filter_has_var(INPUT_POST, 'flavor')) {
	print 'You must enter your favourite ice cream';
}


/*uses filter_has_var(), filter_input(), and strlen() for maximally strict form validation*/
/*Strict form validation*/
// Making sure $_POST['flavor'] exists before checking its length
if(!(filter_has_var(INPUT_POST, 'flavor') && strlen(filter_input(INPUT_POST, 'flavor')) > 0)) {
	print 'You must enter your favourite ice cream flavor.';
}
// $_POST['color'] is optional, but if it's supplied, it must be
// more than 5 characters after being sanitized
if(filter_has_var(INPUT_POST, 'color') && (strlen(filter_input(INPUT_POST, 'color', FILTER_SANITIZE_STRING)) <= 5)) {
	print 'Color must be more than 5 characters.';
}
// Making sure $_POST['choices'] exists and is an array
if(!(filter_has_var(INPUT_POST, 'choices') && filter_input(INPUT_POST, 'choices', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY))) {
	print 'You must select some choices.';
}
?>