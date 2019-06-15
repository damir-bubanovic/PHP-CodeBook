<?php 
/*

!!PREVENTING CHANGES TO CLASSES & METHODS!!

> VISIBILITY
	- public		can be accessed everywhere
	- private		can only be accessed by the class that defines it
	- protected		can be accessed only within the class itself and by inherited classes (children)
	- static		properties or methods as static makes them accessible without needing an instantiation of the class
						> pseudo-variable $this is not available inside the method

> prevent another developer from redefining specific methods within a child class, or even from subclassing the entire class itself

*/


/*Label the particular methods or class as final*/
final public function connect($server, $username, $password) {
	// Method definition here
}

/*and*/
final class MySQL {
	// Class definition here
}
?>