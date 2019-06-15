<?php 
/*

!!INTER & LOCAL - MANAGING LOCALIZATION RESOURCES!!

> You need to keep track of your various message catalogs and images

*file_put_contents - write a string to a file
*serialize - generates a storable representation of a value
*define - defines a named constant
*unserialize - creates a PHP value from a stored representation

*/


/*
Store each message catalog as a serialized PHP array that maps message keys to 
localespecific message values. Or, if you need interoperability with ICU-aware tools 
or other languages, use the ResourceBundle class

At its heart, a message catalog is just a mapping from keys to values

A simple way to manage these catalogs is to treat them as PHP arrays and then load
them from files (and save them to files) as serialized arrays
*/

/*Saving message catalogs as serialized arrays*/
$messages = array();

$messages['en_US'] = array(
	'FAVORITE_FOODS' =>	'My favorite food is {0}.',
	'FRIES'		  =>	'french fries',
	'CANDY'		  =>	'candy',
	'CHIPS'		  =>	'potato chips',
	'EGGPLANT'	   =>	'eggplant'
);
$messages['en_GB'] = array(
	'FAVORITE_FOODS' =>	'My favourite food is {0}.',
	'FRIES'		  =>	'chips',
	'CANDY'		  =>	'sweets',
	'CHIPS'		  =>	'crisps',
	'EGGPLANT'	   =>	'aubergine'
);

foreach($messages as $locale => $entries) {
	file_put_contents(__DIR__ . "/$locale.ser", serialize($entries));
}


/*Given a message catalog saved, this shows how to load and use it in your program*/
/*Using message catalogs from serialized arrays*/

/* This might come from user input or the browser */
define('LOCALE', 'en_US');

/*If you can't trust the locale, add some error checking in case the file doesn't 
exist or can't be unserialized.*/
$messages = unserialize(file_get_contents(__DIR__ . '/' . LOCALE . '.ser'));
$candy = new MessageFormatter(LOCALE, $messages['CANDY']);
$favs = new MessageFormatter(LOCALE, $messages['FAVORITE_FOODS']);

print $favs->format(array($candy->format(array()))) . "\n";



/*retrieves message catalog entries from this bundle 
and prints out the same text*/
/*Using message catalogs from resource bundles*/
define('LOCALE', 'en_US');
$bundle = new ResourceBundle(LOCALE, __DIR__);

$candy = new MessageFormatter(LOCALE, $bundle->get('CANDY'));
$favs = new MessageFormatter(LOCALE, $bundle->get('FAVORITE_FOODS'));
print $favs->format(array($candy->format(array()))) . "\n";

?>