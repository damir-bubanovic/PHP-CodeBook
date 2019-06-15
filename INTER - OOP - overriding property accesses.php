<?php 
/*

!!OVERIDING PROPERTY ACCESSES!!

> VISIBILITY
	- public		can be accessed everywhere
	- private		can only be accessed by the class that defines it
	- protected		can be accessed only within the class itself and by inherited classes (children)
	- static		properties or methods as static makes them accessible without needing an instantiation of the class
						> pseudo-variable $this is not available inside the method

> You want handler functions to execute whenever you read and write object properties.
This lets you write generalized code to handle property access in your class

*__data - nemam blage
*__get - utilized for reading data from inaccessible properties
*__set - run when writing data to inaccessible properties
*isset - determine if a variable is set and is not NULL

*/


/*Use the magic methods __get() and __set() to intercept property requests*/
class Person {
	private $__data = array();
	
	public function __get($property) {
		if(isset($this->__data[$property])) {
			return $this->__data[$property];
		} else {
			return false;
		}
	}
}

/*Use it like this*/
$johnwood = new Person;
$johnwood->email = 'jonathan@wopr.mil'; // sets $user->__data['email']
print $johnwood->email; 				// reads $user->__data['email']



/*Enforce exactly what properties are legal and illegal for a given class*/
class Person {
	// list person and email as valid properties
	protected function __get($property) {
		if(isset($this->__data[$property])) {
			return $this->__data[$property];
		} else {
			return false;
		}
	}
	
	// enforce the restriction of only setting
	// predefined properties
	public function __set($property, $value) {
		if(isset($this->__data[$property])) {
			return $this->__data[$property] = $value;
		} else {
			return false;
		}
	}
}

?>