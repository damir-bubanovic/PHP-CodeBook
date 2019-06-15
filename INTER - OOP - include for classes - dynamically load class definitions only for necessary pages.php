<?php 
/*

!!LIKE INCLUDE - DEFINING LOAD CLASS DEFINITIONS ONLY FOR NECESSARY PAGES!!

> You don’t want to include all your class definitions within every page. 
Instead, you want to dynamically load only the ones necessary in that page

*__autoload -  define this function to enable classes autoloading

*/

function __autoload($className) {
	include "$className.php";
}

$person = new Person;
?>