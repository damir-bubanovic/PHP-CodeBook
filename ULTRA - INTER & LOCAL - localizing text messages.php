<?php 
/*

!!INTER & LOCAL - LOCALIZING TEXT MESSAGES!!

> want to display text messages in a locale-appropriate language

*array_keys - return all the keys or a subset of the keys of an array

*/


/*Maintain a message catalog of words and phrases and retrieve the appropriate string
from the message catalog before passing it to a MessageFormatter object to format it
for printing*/
$messages = array();

$messages['en_US'] = array(
	'FAVORITE_FOODS'	=>	'My favorite food is {0}.',
	'FRIES'			 =>	'french fries',
	'CANDY'			 =>	'candy',
	'CHIPS'			 =>	'potato chips',
	'EGGPLANT'		  =>	'eggplant'
);

$messages['en_GB'] = array(
	'FAVORITE_FOODS'	=>	'My favourite food is {0}.',
	'FRIES'			 =>	'chips',
	'CANDY'			 =>	'sweets',
	'CHIPS'			 =>	'crisps',
	'EGGPLANT'		  =>	'aubergine'
);


foreach(array('en_US', 'en_GB') as $locale) {
	$candy = new MessageFormatter($locale, $messages[$locale]['CANDY']);
	$favs = new MessageFormatter($locale, $messages[$locale]['FAVOURITE_FOODS']);
	
	print $favs->format(array($candy->format(array()))) . "\n";
}
/*the {0} in the pattern is replaced by the first
element in the array passed to format()...*/
/*
OUTPUT:
My favorite food is candy.
My favourite food is sweets.
*/



/*EXAMPLE*/
/*"You have twoitems in your shopping cart."*/
$messages = array();

$messages['en_US'] = array(
	'CART' => "You have {0,spellout} " .
	"{0, plural, " .
	" =1 {item} " .
	" other {items} } " .
	"in your shopping cart."
);

$messages['fr_FR'] = array(
	'CART' => "Vous {0, plural, " .
	" =0 {n'avez pas d'articles} ".
	" =1 {avez un article} ".
	" other {avez {0,spellout} articles}} ".
	"dans votre panier."
);

$fmts = array();

foreach(array_keys($messages) as $locale) {
	$fmts[$locale] = new MessageFormatter($locale, $messages[$locale]['CART']);
}

for($i = 0; $i < 10; $i++) {
	foreach($fmts as $locale => $obj) {
		print $obj->format(array($i)) . "\n";
	}
}

/*
OUTPUT:
You have zero items in your shopping cart.
Vous n'avez pas d'articles dans votre panier.
You have one item in your shopping cart.
Vous avez un article dans votre panier.
You have two items in your shopping cart.
... do 9 itema u kolicima
*/



/*EXAMPLE*/
/*The plural argument type lets the message formatter make a choice based on the numerical
value of an argument. The more general select argument type lets the message formatter make 
a choice based on arbitrary values*/
$message = '{0, select, f {She} m {He} other {It}} went to the store.';

$fmt = new MessageFormatter('en_US', $message);

print $fmt->format(array('f')) . "\n";
print $fmt->format(array('m')) . "\n";
print $fmt->format(array('Unknown')) . "\n";

/*
OUTPUt:
She went to the store.
He went to the store.
It went to the store.
*/



/*EXAMPLE*/
/*Named arguments*/
$message = 'I like to eat {food} and {drink}.';

$fmt = new MessageFormatter('en_US', $message);

print $fmt->format(array('food' => 'eggs', 'drink' => 'water'));

/*
OUTPUT:
I like to eat eggs and water.
*/

?>