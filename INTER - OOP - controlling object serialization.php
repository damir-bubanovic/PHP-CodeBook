<?php 
/*

!!CONTROLING OBJECT SERIALIZATION!!

> VISIBILITY
	- public		can be accessed everywhere
	- private		can only be accessed by the class that defines it
	- protected		can be accessed only within the class itself and by inherited classes (children)
	
> control how the object behaves when you serialize() & unserialite() it
	- npr. when you need to establish and close connections to remote resources, such as databases, files, and web services

*__construct - this function creates an object (function to do something)
*__destruct - this function destroys an object
*__sleep - checks if your class has a function with the magic name __sleep(). If so, that function is executed prior to any serialization.
*__wakeUp - reestablish any database connections that may have been lost during serialization and perform other reinitialization tasks

*fopen - Opens file or URL
	> a - Open for writing only, if the file does not exist create it

*/

class logFile {
	
	protected $filName;
	protected $hangle;
	
	public function __construct($fileName) {
		$this->filName = $fileName;
		$this->open();
	}
	
	private function open() {
		$this->handle = fopen($this->filName, 'a');
	}
	
	public function __destruct($fileName) {
		fclose($this->handle);
	}
	
	// called when object is serialized
	// should return an array of object properties to serialize
	public function __sleep() {
		return array($fileName);
	}
	
	// called when object is unserialized
	public function __wakeup() {
		$this->open();
	}
	
}
?>