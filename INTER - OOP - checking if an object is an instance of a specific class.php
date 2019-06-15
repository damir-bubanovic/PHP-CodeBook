<?php 
/*

!!CHECK IF AN OBJECT IS AN INSTANCE OF SPECIFIC CLASS!!

> VISIBILITY
	- public		can be accessed everywhere
	- private		can only be accessed by the class that defines it
	- protected		can be accessed only within the class itself and by inherited classes (children)
	
*instanceof - used to determine whether a PHP variable is an instantiated object of a certain class

*/

/*IF OPTION*/
class AdressBook {
	public function add($person) {
		if($person instanceof Person) {
			// add $person to adress book
		} else {
			die('Argument 1 must be instance of Person');
		}
	}
}

/*OR*/

/*SIMPLE OPTION*/
class AdressBook {
	/*specify the class name in your function prototype*/
	public function add(Person $person) {
		// add $person to adress book
	}
}




/*In other contexts, use the instanceof operator*/
$media = get_something_from_catalog();
if($media instanceof Book) {
	// do bookich things
} elseif($media instanceof DVD) {
	// watch the movie
} else {
	// go for a walk
}

/*Više na 227*/
?>