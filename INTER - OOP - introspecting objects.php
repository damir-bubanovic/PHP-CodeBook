<?php 
/*

!!INTROSPECTING OBJECTS!!

> VISIBILITY
	- public		can be accessed everywhere
	- private		can only be accessed by the class that defines it
	- protected		can be accessed only within the class itself and by inherited classes (children)
	- static		properties or methods as static makes them accessible without needing an instantiation of the class
						> pseudo-variable $this is not available inside the method

> inspect an object to see what methods and properties it has, which lets you write code that works on any generic object, regardless of type

> useful for projects you want to apply to a whole range of different classes, such as creating automated class documentation, 
generic object debuggers, and state savers, like serialize()

*__construct - this function creates an object (function to do something)

*array_slice - returns the sequence of elements from the array array as specified by the offset and length parameters
*strpos - find the numeric position of the first occurrence of needle in the haystack string
*explode - returns an array of strings, each of which is a substring of string formed by splitting it on boundaries formed by the string delimiter

*/



/*QUICK REVIEW OF CLASS, call Reflection::export()*/
Reflection::export(new ReflectionClass('car'));	// learn about cars

/*OR*/
/*probe for specific data*/
$car = new ReflectionClass('car');
if ($car->hasMethod('retractTop')) {
	// car is a convertible
}


/*Projects with whole range of different classes*/
class Person {
	public $name;
	protected $spouse;
	private $password;
	
	public function __construct($name) {
		$this->name = $name;
	}
	
	public function getName() {
		return $name;
	}
	
	protected function setSpouse(Person $spouse) {
		if(!isset($this->spouse)) {
			$this->spouse = $spouse;
		}
	}
	
	private function setPassword($password) {
		$this->password = $password;
	}
}

/*For a quick overview of the class, call Reflection::export()*/
Reflection::export(new ReflectionClass('Person'));


/*Using reflection to locate function and method definitions*/
if ($argc < 2) {
	print "$argv[0]: function/method, classes1.php [, ... classesN.php]\n";
	exit;
}

// Grab the function name
$function = $argv[1];

// Include the files
foreach (array_slice($argv, 2) as $filename) {
	include_once $filename;
}

try {
	if (strpos($function, '::')) {
		// It's a method
		list ($class, $method) = explode('::', $function);
		$reflect = new ReflectionMethod($class, $method);
	} else {
		// It's a function
		$reflect = new ReflectionFunction($function);
	}
	
	$file = $reflect->getFileName();
	$line = $reflect->getStartLine();
	
	printf ("%s | %s | %d\n", "$function()", $file, $line);
} catch (ReflectionException $e) {
	printf ("%s not found.\n", "$function()");
}
?>