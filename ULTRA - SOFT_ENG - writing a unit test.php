<?php 
/*

!!SOFT_ENG - WRITING A UNIT TEST!!

> You’re working on a project that extends a set of core functionality, and you 
want an easy way to make sure everything still works as the project grows

> Write a unit test that tests the core functionality of a function or class and 
alerts you if something breaks

> LOOK UP - http://qa.php.net/write-test.php.

*/


/*A sample test using PHP-QA’s .phpt testing system is*/
?>
--TEST--
str_replace() function
--FILE--
<?php 
$str = 'Hello, all!';
var_dump(str_replace('all', 'world', $str));
?>
--EXPECT--
string(13) "Hello, world!"
<?php 
/*sample test using the powerful and popular PHPUnit package is*/
class StrReplaceTest extends PHPUnit_Framework_TestCase {
	
	public function testStrReplaceWorks() {
		$str = 'Hello, all!';
		$this->assertEquals('Hello, world!', str_replace('all', 'world', $str));
	}
}



/*
> There are a number of ways to write unit tests in PHP. A series of simple .phpt tests
may be adequate for your needs, or you may benefit from a more structured testing solution 
such as PHPUnit


> Writing an application from scratch in any language is a lot like peeling an onion, only in reverse. 
> You start with the center of the onion, and build layers on top of layers until you get to the finished 
product: an onion
> The easiset way to ensure that the core of an application continues functioning as expected, 
especially after modifications, is through unit tests

*/



/*The easiest way to run the .phpt test is to save it in a file ending in .phpt (str_re
place.phpt, for example), and then use PEAR’s built-in .phpt execution tool, like this*/
?>
% pear run-tests str_replace.phpt
<?php 
/*
OUTPUT:
Running 1 tests
PASS str_replace() function[str_replace.phpt]
TOTAL TIME: 00:00
1 PASSED TESTS
0 SKIPPED TESTS
*/

?>