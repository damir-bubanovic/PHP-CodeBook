<?php 
/*

!!OOP - MAGIC METHODS!!

 __construct()
 	> Classes which have a constructor method call this method on each newly-created 
	object, so it is suitable for any initialization that the object may need before 
	it is used
 
 __destruct()
 	> The destructor method will be called as soon as there are no other references 
	to a particular object, or in any order during the shutdown sequence
 
 __call()
 	> Is triggered when invoking inaccessible methods in an object context
 
 __callStatic()
 	> Is triggered when invoking inaccessible methods in a static context
 
 __get()
 	> Is utilized for reading data from inaccessible properties
 
 __set()
 	> Is run when writing data to inaccessible properties
 
 __isset()
 	> Is triggered by calling isset() or empty() on inaccessible properties
 
 __unset()
 	> Is invoked when unset() is used on inaccessible properties
 
 __sleep()
 	> Use to commit pending data or perform similar cleanup tasks. Also, the function is 
	useful if you have very large objects which do not need to be saved completely
 
 __wakeup()
 	> This function can reconstruct any resources that the object may have.
	> Use to to reestablish any database connections that may have been lost 
	during serialization and perform other reinitialization tasks
 
 __toString()
 	> Allows a class to decide how it will react when it is treated like a string
 
 __invoke()
 	> Is called when a script tries to call an object as a function
 
 __set_state()
 	> Is called for classes exported by var_export()
 
 __clone()
 	> Creating a copy of an object
	> Cloned Object will perform a shallow copy of all of the object's properties
		> Any properties that are references to other variables will remain references
 
 __debugInfo()
 	> This method is called by var_dump() when dumping an object to get the properties 
	that should be shown. If the method isn't defined on an object, then all 
	public, protected and private properties will be shown

*/

?>