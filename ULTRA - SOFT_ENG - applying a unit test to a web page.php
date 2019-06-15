<?php 
/*

!!SOFT_ENG - APPLYING A UNIT TEST TO A WEB PAGE!!

> Your application is not broken down into small testable chunks, or you just want to
apply unit testing to the website that your visitors see

> Use PHPUnit’s Selenium Server integration to write tests that make HTTP requests and
assert conditions on the responses
> The PHPUnit Selenium extension integrates with Selenium Server, a free, crossplatform
tool for doing in-browser testing


> VISIBILITY
	- public		can be accessed everywhere
	- private		can only be accessed by the class that defines it
	- protected		can be accessed only within the class itself and by inherited classes (children)
	- static		properties or methods as static makes them accessible without needing an instantiation of the class
						> pseudo-variable $this is not available inside the method

*/


/*These tests make assertions about the structure of www.example.com*/
class ExampleDotComTest extends PHPUnit_Extensions_SeleniumTestCase {
	
	function setUp() {
		$this->setBrowser('firefox');
		$this->setBrowserUrl('http://www.example.com');
	}
	
	// basic homepage loading
	function testHomepageLoading() {
		$this->open('http://www.example.com/');
		$this->assertTitle('Example Domain');
	}
	
	// test clicking on a link and getting the right page
	function testClick() {
		$this->open('http://www.example.com/');
		$this->clickAndWait('link=More information...');
		$this->assertTitle('IANA — IANA-managed Reserved Domains');
	}
}
/*
OUTPUT:
*/
?>

PHPUnit 3.7.24 by Sebastian Bergmann.
..
Time: 9.05 seconds, Memory: 3.50Mb
OK (2 tests, 2 assertions)

<?php 
/*running tests against the real web-server output of your code lets 
you verify UI elements, proper links, and other user-facing features*/
?>