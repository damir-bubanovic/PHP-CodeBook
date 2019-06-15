<?php 
/*

!!COPY AN OBJECT!!

> VISIBILITY
	- public		can be accessed everywhere
	- private		can only be accessed by the class that defines it
	- protected		can be accessed only within the class itself and by inherited classes (children)

*__clone - creating a copy of an object with fully replicated properties

*/


/*Copy objects by reference using =:*/
$rasmus = $zeev;
/*Copy objects by value using clone:*/
$rasmus = clone $zeev;


/*SHALLOW CLONE 
- specific objects are cloned*/
$damir = new Person();
$damir->setName('Damir Volkic');
$damir->setCity('Zagreb');

$nikola = clone $damir;
$nikola->setName('Nikola Timovic');
$nikola->setCity('Osijek');

print $damir->getName() . ' lives in ' . $damir->getCity() . '.';
print $nikola->getName() . ' lives in ' . $nikola->getCity() . '.';


/*DEEP CLONE 
- all objects involved are cloned*/
class Person {
	// ... everything from before
	public function __clone() {
		$this->adress = clone $this->adress;
	}
}

/*Više imaš na 200 stranici POGLEDAJ*/
?>