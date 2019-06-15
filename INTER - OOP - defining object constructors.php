<?php 
/*

!!DEFINE OBJECT CONSTRUCTORS!!

> Define a method that is called when an object is instantiated npr. 
automatically load information from a database into an object upon creation

*__construct - this function creates an object (function to do something)

*/

/*BASIc*/
class User {
	function __construct($username, $password) {
		// ... code
	}
}

/*EXAMPLE*/
class User {
	public $username;
	
	function __construct($username, $password) {
		if($this->validate_user($username, $password)) {
			$this->username = $username;
		}
	}
}

$user = new User('Marko', 'You killed Kenny');	// using built-in constructor
?>