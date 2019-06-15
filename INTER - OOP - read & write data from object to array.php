<?php 
/*

!!READ & WRITE DATA FROM OBJECT TO ARRAY!!

> VISIBILITY
	- public		can be accessed everywhere
	- private		can only be accessed by the class that defines it
	- protected		can be accessed only within the class itself and by inherited classes (children)
	- static		properties or methods as static makes them accessible without needing an instantiation of the class
						> pseudo-variable $this is not available inside the method

*implements - implement an interface
*__construct - this function creates an object (function to do something)
*isset - determine if a variable is set and is not NULL
*unset - destroys the specified variables

*/


/*You have an object, but you want to be able to read and write data to it as an array*/
class FakeArray implements ArrayAccess {
	private $elements;
	
	public function __construct() {
		$this->elements = array();
	}
	
	public function offsetExists($offset) {
		return isset($this->elements[$offset]);
	}
	
	public function offsetGet($offset) {
		return $this->elements[$offset];
	}
	
	public function offsetSet($offset, $value) {
		return $this->elements[$offset] = $value;
	}
	
	public function offsetUnset($offset) {
		unset($this->elements[$offset]);
	}
}


$array = new FakeArray;

$array['animal'] = 'wabbit';

if(isset($array['animal']) && $array['animal'] === 'wabbit') {
	unset($array['animal']);
}

if(!isset($array['animal'])) {
	print 'wabbit got lead';
}
?>