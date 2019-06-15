<?php 
/*

!!CONTROL HOW PHP DISPLAYS AN OBJECT WHEN YOU PRINT IT!!

> VISIBILITY
	- public		can be accessed everywhere
	- private		can only be accessed by the class that defines it
	- protected		can be accessed only within the class itself and by inherited classes (children)
	
*__toString - allows a class to decide how it will react when it is treated like a string (what will print)

*/

class Person {
	protected $name;
	protected $email;
	
	public function setName($name) {
		$this->name = $name;
	}
	
	public function setEmail($email) {
		$this->email = $email;
	}
	
	public function __toString() {
		/*make sure that return is string with (string)*/
		return /*(string)*/ "$this->name < $this->email >";
	}
}


/*Using Class*/
$user1 = new Person();
$user1->setName('Marko');
$user1->setEmail('marko@gmail.com');
print $user1;	// Marko < marko@gmail.com >
?>