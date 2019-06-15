<?php 
/*

!!DEFINE OBJECT DESTRUCTORS!!

> Define a method that is called when an object is destroyed npr. want to 
automatically save information from a database into an object when it’s deleted

> It’s not normally necessary to manually clean up objects, but if you have 
a large loop, unset() can help keep memory usage from spiraling out of control

*/

$car = new car;	// buy new car
// ... other code
unset($car);	// car wreck


/*make PHP call a method when an object is eliminated*/
class car {
	function __destruct() {
	// head to car dealer
	}
}

/*If your destructor needs any instance-specific information, store it as a property*/
/*Database destructor would disconnect from the database and free up the connection*/
// Destructor
class Database {
	function __destruct() {
		db_close($this->handle); // close the database connection
	}
}
?>