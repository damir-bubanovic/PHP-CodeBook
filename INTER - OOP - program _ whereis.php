<?php 
/*

!!PROGRAM __WHEREIS!!

> VISIBILITY
	- public		can be accessed everywhere
	- private		can only be accessed by the class that defines it
	- protected		can be accessed only within the class itself and by inherited classes (children)
	- static		properties or methods as static makes them accessible without needing an instantiation of the class
						> pseudo-variable $this is not available inside the method

*array_slice - returns the sequence of elements from the array array as specified by the offset and length parameters
*get_declared_classes - returns an array of the names of the declared classes in the current script
*get_defined_functions - returns an array of all defined functions
*list - assign variables as if they were an array
*explode - returns an array of strings, each of which is a substring of string formed by splitting it on boundaries formed by the string delimiter
*strcasecmp - binary safe case-insensitive string comparison
*uksort - sort an array by keys using a user-defined comparison function
*array_merge - merges the elements of one or more arrays together so that the values of one are appended to the end of the previous one. It returns the resulting array

*/



if($argc < 2) {
	print "$argv[0]: classes.php [, ...]\n";
	exit;
}

// Include the files
foreach(array_slice($argv, 1) as $filename) {
	include_once $filename;
}



// Get all the method and function information
// Start with the classes
$methods = array();
foreach(get_declared_classes() as $class) {
	$r = new ReflectionClass($class);
	
	// Eliminate built-in classes
	if($r->isUserDefined()) {
		foreach($r->getMethods() as $method) {
			// Eliminate inherited methods
			if($method->getDeclaringClass()->getName() == $class) {
				$signature = "$class::" . $method->getName();
				$methods[$signature] = $method;
			}
		}
	}
}


// Then add the functions
$function = array();
$defined_functions = get_defined_functions();

foreach($defined_functions['user'] as $function) {
	$functions[$function] = new ReflectionFunction($function);
}




// Sort methods alphabetically by class
function sort_methods($a, $b) {
	list($a_class, $_method) = explode('::', $a);
	list($b_class, $b_method) = explode('::', $b);
	
	if($cmp = strcasecmp($a_class, $b_class)) {
		return $cmp;
	}
	
	return strcasecmp($a_method, $b_method);
}
uksort($methods, 'sort_methods');


// Sort functions alphabetically
// This is less complicated, but don't forget to
// remove the method sorting function from the list
unset($functions['sort_methods']);
// Sort 'em
ksort($functions);

// Print out information
foreach(array_merge($functions, $methods) as $name => $reflect) {
	$file = $reflect->getFileName();
	$line = $reflect->getStartLine();
	
	printf ("%-25s | %-40s | %6d\n", "$name()", $file, $line);
}
?>