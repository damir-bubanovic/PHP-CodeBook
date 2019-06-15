<?php 
/*

!!CREATE METHODS DYNAMICALLY!!

> VISIBILITY
	- public		can be accessed everywhere
	- private		can only be accessed by the class that defines it
	- protected		can be accessed only within the class itself and by inherited classes (children)
	- static		properties or methods as static makes them accessible without needing an instantiation of the class
						> pseudo-variable $this is not available inside the method

*__callStatic - triggered when invoking inaccessible methods in a static context

*/

class Users {
	static function find($argument) {
		// here's where the real logic lives
		// for example a database query:
		// SELECT user FROM users WHERE $args['field'] = $args['value']
	}
	
	static function __callStatic($method, $argument) {
		if(preg_match('/^findBy(.+)$/', $method, $matches)) {
			return static::find(array(
									'field' => $matches[1],
									'value' => $args[0]
									)
								);
		}
	}
}

$user = User::findById(123);
$user = User::findByEmail('damir.bubanovic@yahoo.com');
?>