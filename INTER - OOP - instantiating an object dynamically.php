<?php 
/*

!!INSTANTIATING AN OBJECT DYNAMICALLY!!

> You want to instantiate an object, but you don’t know the name of the class until your code is executed
	- npr. localize your site by creating an object belonging to a specific language. However, until the page is requested, you don’t know which language to select

*isset - determine if a variable is set and is not NULL
*class_exists - checks if the class has been defined

*/


$language = $_REQUEST['language'];
$valid_langs = array(
	'en_US'	=>	'US English',
	'en_UK'	=>	'British English',
	'es_US'	=>	'US Spanish',
	'fr_CA'	=>	'Canadian French'
);

if(isset($valid_langs[$language]) && class_exists($language)) {
	$lang = new $language;
}
?>