<?php 
/*

!!SQL - ACCESSING DATABASE CONNECTION ANYWHERE IN MY PROGRAM!!

> VISIBILITY
	- public		can be accessed everywhere
	- private		can only be accessed by the class that defines it
	- protected		can be accessed only within the class itself and by inherited classes (children)
	- static		properties or methods as static makes them accessible without needing an instantiation of the class
						> pseudo-variable $this is not available inside the method
	- final			prevents child classes from overriding a method by prefixing the definition with final
						> if the class itself is being defined final then it cannot be extended

*__construct - this function creates an object (function to do something)
*__clone - creating a copy of an object with fully replicated properties
*is_null - finds whether a variable is NULL
*isset - determine if a variable is set and is not NULL
*is_array - finds whether the given variable is an array
*throw - an exception can be thrown - when an exception is thrown, code following the statement will not be executed

> want to maintain a single database connection that’s easily accessible from anywhere in the program
> Use a static class method that creates the connection if it doesn’t exist and returns the connection

> If you need to manage multiple different database connections during the same script execution, change 
$dsn and $db to an array and have get() accept an argument identifying which connection to use

*/


/*Creating a database connection in a static class method*/
class dabaBaseConnection {
	// What DSN to connect to?
	public static $dsn = 'sqlite:c:/data/zodiac.db';
	public static $user = null;
	public static $pass = null;
	public static $driverOpts = null;
	
	// Internal variable to hold the connection
	private static $db;
	
	// No cloning or instantiating allowed
	final private function __construct() {
	}
	final private function __clone() {
	}
	
	final static function get() { /*Mozda ovdje treba __get()*/
		// Connect if not already connected
		if(is_null(self::$db)) {
			self::$db = new PDO(self::$dsn, self::$user, self::$pass, self::$driverOpts);
		}
		// Return the connection
		return self::$db;
	}
}


/*Handling connections to multiple databases*/
class dataBaseConnection {
	// What DSNs to connect to
	public static $dsn = array(
		'sqlite:c:/data/zodiac.db',
		'users'	=>	array('mysql:host=db.example.com','monty','7f2iuh'),
		'stats'	=>	array('oci:statistics', 'statsuser','statspass')
	);
	
	// Internal variable to hold the connection
	private static $db = array();
	
	// No cloning or instantiating allowed
	final private function __construct() {
	}
	final private function __clone() {
	}
	
	public static function get($key) { /*Mozda ovdje treba __get()*/
		if(!isset(self::$dsn[$key])) {
			throw new Exception("Unknown DSN: $key");
		}
		
		// Connect if not already connected
		if(!isset(self::$db[$key])) {
			if(is_array(self::$dsn[$key])) {
				$c = new ReflectionClass('PDO');
				self::$db[$key] = $c->newInstanceArgs(self::$dsn[$key]);
			} else {
				self::$db[$key] = new PDO(self::$dsn[$key]);
			}
		}
		// Return the connection
		return self::$db[$key];
	}
}

?>