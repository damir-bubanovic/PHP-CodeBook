<?php 
/*

!!AGGREGATING OBJECTS!!


> VISIBILITY
	- public		can be accessed everywhere
	- private		can only be accessed by the class that defines it
	- protected		can be accessed only within the class itself and by inherited classes (children)

*__construct - this function creates an object (function to do something)
*__call - invoking inaccessible methods in an object context

*method_exists - checks if the class method exists
*call_user_func_array - call a callback with an array of parameters

*/

/*Compose two or more objects together so that they appear to behave as a single object*/
/*OBJECT 1*/
class Adress {
	protected $city;
	
	/*Do not forget set parameter to variable*/
	public function setCity($city) {
		$this->city = $city;
	}
	
	public function getCity() {
		return $this->city;
	}
}

/*OBJECT 2*/
class Person {
	protected $name;
	protected $adress;
	
	/*new function that calls function from another object*/
	public function __construct() {
		$this->adress = new Adress;
	}
	
	/*Do not forget set parameter to variable*/
	public function setName($name) {
		$this->name = $name;
	}
	
	public function getName() {
		return $this->name;
	}
	
	public function __call($method, $arguments) {
		if(method_exists($this->adress, $method)) {
			return call_user_func_array(
				array($this->adress, $method), $arguments);
		}
	}
}


/*Using classes*/
$rasmus = new Person;
$rasmus->setName('Nikola');
$rasmus->setCity('Zagreb');

print $rasmus->getName() . ' lives in ' .$rasmus->getCity() . '.';
?>