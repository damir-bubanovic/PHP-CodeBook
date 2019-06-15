<?php 
/*

!!!DOES VARIABLE EXIST?, IS IT SET?, IS IT NOT NULL?!!!

TIPS & EXPLANATIONS:
*isset - variable set & not NULL
	> can use var_dump() for more information about a variable 
	> return true
	> isset() only works with variables as passing anything else will result in a error
	> for checking if constants are set use the defined() function
*unset - unset/remove/destroy variable
	> To unset() a global variable inside of a function, then use the $GLOBALS array to do so
	> If a variable that is PASSED BY REFERENCE is unset() inside of a function, only the local variable is destroyed
	> If a static variable is unset() inside of a function, unset() destroys the variable only in the context of the rest of a function
> test if variable actually exists including being set to null
	> This will prevent errors when passing to functions
	> ALERT
		- 	you can't turn this into a function (e.g. is_defined($myvar)) because get_defined_vars() 
			only gets the variables in the current scope and entering a function changes the scope
	*var_export - outputs or returns a parsable string representation of a variable (similar to var_dump)
	*array_key_exists() 
		- checks if the given key or index exists in the array
		- returns TRUE on success
		- can be used for single variable (paramether = $variable) -> LOOK IT UP!
	*get_defined_vars - returns an array of all defined variables
> best option -> use isset(..) || array_key_exists(...)
	> do not wrap in function because it slows it down
	
*/


/*isset*/
$string = 'nikola';

if(isset($string)) {
	print 'Variable is set!';
} else {
	print 'Variable is not set and/or NULL';
}
/*or*/
var_dump(isset($string));


/*unset*/
$string = 'nikola';

unset($string);
// destroy a single variable
unset($foo);
// destroy a single element of an array
unset($bar['quux']);
// destroy more than one variable
unset($foo1, $foo2, $foo3);



/*test if variable actually exists*/
var_export(
  array_key_exists('myvar', get_defined_vars())
); // false

$myvar;
var_export(
  array_key_exists('myvar', get_defined_vars())
); // false

$myvar = null;
var_export(
  array_key_exists('myvar', get_defined_vars())
); // true

unset($myvar);
var_export(
  array_key_exists('myvar', get_defined_vars())
); // false

if (array_key_exists('myvar', get_defined_vars())) {
  myfunction($myvar);
}


/*best option*/
if(isset(..) || array_key_exists(...)) {
	...
}

?>