<?php 
/*

!!VALIDATING FORM INPUT: NUMBERS!!

> make sure a number is entered in a form input box

*filter_input - gets a specific external variable by name and optionally filters it ($type - pogledaj php.net)

> ALERT <
	Usually avoid regular expressions because they are slow, but - The regular expression allows
	you to consider valid numbers, such as 782364.238723123, that cannot be stored as a
	PHP float without losing precision. This can be useful with data such as a longitude or
	latitude that you plan to store as a string

*/

/*Validating a number with FILTER_VALIDATE_INT*/
$age = filter_input(INPUT_POST, 'age', FILTER_VALIDATE_INT);

if($age === false) {
	print 'Submitted age is invalid.';
}


/*Validating a number with FILTER_VALIDATE_FLOAT*/
$price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);

if($price === false) {
	print 'Submitted price is invalid';
}



/*OR*/



/*Validating numbers with regular expressions*/
// The pattern matches an optional—sign and then
// at least one digit
if(!preg_match('/^-?\d+$/', $_POST['rating'])) {
	print 'Your rating must be an integer.';
}

// The pattern matches an optional—sign and then
// optional digits to go before a decimal point
// an optional decimal point
// and then at least one digit
if(!preg_match('/^-?\d*\.?\d+$/', $_POST['temperature'])) {
	print 'Your temperature must be a number';
}

?>