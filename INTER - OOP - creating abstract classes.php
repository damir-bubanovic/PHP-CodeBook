<?php 
/*

!!CREATE ABSTRACT CLASSES!!

> VISIBILITY
	- public		can be accessed everywhere
	- private		can only be accessed by the class that defines it
	- protected		can be accessed only within the class itself and by inherited classes (children)

> abstract class - is not directly instantiable, but acts as a common base for children classes
	 - Abstract classes are best used when you have a series of objects that are related using the is a relationship

*/

/*Basic code*/
abstract class Database {
	// ... code
}

/*You must also define at least one abstract method in your class*/
abstract class Database {
	abstract public function connect();
	abstract public function query();
	abstract public function fetch();
	abstract public function close();
}

/*Create a class that cannot be instantiated*/
abstract class Database {
	abstract public function connect($server, $userbane, $password, $database);
	abstract public function query($sql);
	abstract public function fetch();
	abstract public function close();
}

/*abstract methods are implemented in a child class that extends the abstract parent*/
class MySQL extends Database {
	protected $dbc;
	protected $query;
	
	public function connect($server, $username, $password, $database) {
		$this->dbc = mysqli_connect($server, $username, $password, $database);
	}
	
	public function query($sql) {
		$this->query = mysqli_query($this->dbc, $sql);
	}
	
	public function fetch() {
		return mysqli_fetch_row($this->dbc, $this->query);
	}
	
	public function close() {
		mysqli_close($this->dbc);
	}
}
?>