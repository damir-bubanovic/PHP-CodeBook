<?php 
/*

!!SOFT_ENG - WRITING A UNIT TEST SUITE!!

> want to be able to run more than one unit test conveniently on a regular basis


> Wrap your unit tests into a group known as a unit test suite

> It’s rare to have a program simple enough that a single unit test will fulfill all the testing
needs that it will have during its lifespan. 
> Over time, as applications grow there is a need to add more and more tests, either to test new 
functionality or verify that fixed bugs stay fixed
> When your library of tests gets larger than a handful, you’ll find it much more convenient
to group your tests into a unit test suite

> VISIBILITY
	- public		can be accessed everywhere
	- private		can only be accessed by the class that defines it
	- protected		can be accessed only within the class itself and by inherited classes (children)
	- static		properties or methods as static makes them accessible without needing an instantiation of the class
						> pseudo-variable $this is not available inside the method

*str_replace - replace all occurrences of the search string with the replacement string
*substr - return part of a string
*array_flip - exchanges all keys with their associated values in an array
*reset - set the internal pointer of an array to its first element
*array_pop - pop the element off the end of array
*sizeof - count all elements in an array, or something in an object - use count instead

*/


/*Using the PHPUnit framework, create a test suite to test more than just the str_re
place function in PHP*/
/*StringTest.php*/
class StringTest extends PHPUnit_Framework_TestCase {
	
	function testStrReplace() {
		$str = 'Hello, all!';
		$this->assertEquals('Hello, world!', str_replace('all', 'world', $str));
	}
	
	function testSubstr() {
		$str = 'Hello, all!';
		$this->assertEquals('e', substr($str, 1, 1));
	}
}



/*Now you have two tests that will be run from the StringTest class. Create a similar 
file called ArrayTest.php, with the following tests defined in it*/
class ArrayTest extends PHPUnit_Framework_TestCase {
	
	function testArrayFlip() {
		$array = array('foo' => 'bar', 'cheese' => 'hotdog');
		$flipped = array_flip($array);
		$this->assertEquals('foo', reset($flipped));
	}
	
	function testArrayPop() {
		$array = array('foo' => 'bar', 'cheese' => 'hotdog');
		$popped = array_pop($array);
		$this->assertEquals('hotdog', $popped);
		$this->assertEquals(1, sizeof($array));
	}
}


/*Assuming you’ve saved those two test files in the testDir directory, your output 
will look something like:*/
?>


PHPUnit 3.7.24 by Sebastian Bergmann.
....
Time: 45 ms, Memory: 5.00Mb
OK (4 tests, 5 assertions)