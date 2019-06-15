<?php 
/*

!!ESTABLISH DEFAULT VALUE!!

> assign a default value to a variable that doesn’t already have a value npr. 
you want a hardcoded default value for a variable that can be overridden
from form input or through an environment variable

*isset - determine if a variable is set and is not NULL
*$_GET - HTTP GET variables - associative array of variables passed to the current script via the URL parameters

*/


/*Use isset() to assign a default to a variable that may already have a value*/
if(!isset($cats)) {
	$cats = $default_cats;
}


/*Use the ternary (a ? b : c) operator to give a new variable a (possibly default) value*/
$cars = isset($_GET['cars']) ? $_GET['cars'] : $default_cars;


/*Use an array of defaults to set multiple default values*/
$defaults = array(
	'emperors' => array(
		'Rudolf II',
		'Caligula'
	),
	'vegetable' => 'celery',
	'acres' => 15
);


/*variables are set in the global namespace*/
foreach($defaults as $k => $v) {
	if(!isset($GLOBALS[$k])) { 
		$GLOBALS[$k] = $v; 
	}
}

/*OR*/

/*setting default variables private within a function*/
foreach($defaults as $k => $v) {
	if(!isset($$k)) { 
		$$k = $v; 
	}
}
?>