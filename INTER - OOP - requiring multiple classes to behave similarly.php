<?php 
/*

!!REQUIRE MULTIPLE CLASSES TO BEHAVE SIMILARY!!

> VISIBILITY
	- public		can be accessed everywhere
	- private		can only be accessed by the class that defines it
	- protected		can be accessed only within the class itself and by inherited classes (children)
	- static		properties or methods as static makes them accessible without needing an instantiation of the class
						> pseudo-variable $this is not available inside the method

*class_implements - returns an array with the names of the interfaces that the given class and its parents implement

*/



/*You want multiple classes to use the same methods, but it doesn’t make sense for all the classes to inherit from a common parent class*/
interface NameInterface {
	public function getName();
	public function setName($name);
}

class Book implements NameInterface {
	private $name;
	
	public function getName() {
		return $this->name;
	}
	
	public function setName($name) {
	return $this->name = $name;
	}
}


/*When you want to include the code that implements the interface, define 
a trait and declare that your classes will use that trait*/
trait NameTrait {
	private $name;
	
	public function getName() {
		return $this->name;
	}
	
	public function setName($name) {
		return $this->name = $name;
	}
}
class Book {
	use NameTrait;
}
class Child {
	use NameTrait;
}


/*mechanism for forcing classes to support the same set of methods is called 
an interface. Defining an interface is similar to defining a class*/
interface NameInterface {
	public function getName();
	public function setName($name);
}
/*implement an interface in your class definition*/
class Book implements NameInterface {
	private $name;
	public function getName() {
		return $this->name;
	}
	public function setName($name) {
		return $this->name = $name;
	}
}


/*To check if a class implements a specific interface, use class_implements()*/
class Book implements NameInterface {
	// .. Code here
}

$interfaces = class_implements('Book');
if (isset($interfaces['NameInterface'])) {
	// Book implements NameInterface
}

/*Share code across two classes*/
trait NameTrait {
	private $name;
	public function getName() {
		return $this->name;
	}
	public function setName($name) {
		return $this->name = $name;
	}
}

class Book {
	use NameTrait;
}

$book = new Book;
$book->setName('PHP Cookbook');
print $book->getName();

/*Use interfaces and traits together*/
class Book implements NameInterface {
	use NameTrait;
}

/*have a class implement multiple interfaces or traits by separating them with a comma*/
class Book implements NameInterface, SizeInterface {
	use NameTrait, SizeTrait;
}
?>