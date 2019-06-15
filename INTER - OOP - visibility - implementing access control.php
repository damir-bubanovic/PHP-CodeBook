<?php 
/*

!!IMPLEMENTING ACCESS CONTROL!!

> VISIBILITY
	- public		can be accessed everywhere
					(USED OFTEN)
	- private		can only be accessed by the class that defines it
					(USED VERY RARELY)
	- protected		can be accessed only within the class itself and by inherited classes (children)
					(USED COMMONLY)
	- static		properties or methods as static makes them accessible without needing an instantiation of the class
						> pseudo-variable $this is not available inside the method



*/

public $streetAddress1;
public $streetAddress2;

public $cityName;

public $subdivisionName;

public $postalCode;

public $countryName;

protected $_address_id;
protected $_created_at;
protected $_updated_at;


/*assign a visibility to methods and properties so they can only be accessed
within classes that have a specific relationship to the object*/

/*Use the public, protected, and private keywords*/
class Person {
	public $name; // accessible anywhere
	protected $age; // accessible within the class and child classes
	private $salary; // accessible only within this specific class
	public function __construct() {
		// ...
	}
	protected function set_age() {
		// ...
	}
	private function set_salary() {
		// ...
	}
}


/*A program with good encapsulation accesses the table with function 
whenever it needs to fetch a person’s email address*/
function getEmail($name) {
	$sqlite = new PDO("sqlite:/usr/local/users.db");
	
	$rows = $db->query("SELECT email FROM users WHERE name LIKE '$name'");
	$row = $rows->fetch();
	$email = $row['email'];
	return $email;
}
$email = getEmail('Rasmus Lerdorf');

?>