<?php 
/*

!!ENCAPSULATING COMPLEX DATA TYPES IN STRING!!

> string representation of an array or object for storage in a file or database

*fopen - opens file or URL
*fputs - binary-safe file write (*fwrite)
*serialize - generates a storable representation of a value
*unserialize - creates a PHP value from a stored representation
*fclose -  closes an open file pointer
*file_get_contents - reads entire file into a string
*json_encode - returns the JSON representation of a value
*json_decode - decodes a JSON string
*urlencode - URL-encodes string

*/


/*Use serialize() to encode variables and their values into a textual form*/
$pantry = array(
	'sugar' => '2 lbs.',
	'butter' => '3 sticks' 
);
$fp = fopen('/tmp/pantry', 'w') or die('Can not open pantry');
fputs($fp, serialize($pantry));
fclose($fp);

/*To re-create the variables, use unserialize()*/
// $new_pantry will be the array:
// array('sugar' => '2 lbs.','butter' => '3 sticks'
$new_pantry = unserialize(file_get_contents('/tmp/pantry'));



/*For easier interoperability with other languages - json - to serialize data*/
$pantry = array(
	'sugar' => '2 lbs.',
	'butter' => '3 sticks'
);
$fp = fopen('/tmp/pantry.json','w') or die ("Can't open pantry");
fputs($fp,json_encode($pantry));
fclose($fp);

/*Use json_decode() to re-create the variables*/
// $new_pantry will be the array:
// array('sugar' => '2 lbs.','butter' => '3 sticks')
$new_pantry = json_decode(file_get_contents('/tmp/pantry.json'), TRUE);


/*When passing serialized data from page to page in a URL - make sure URL metacharacters are escaped in it*/
$shopping_cart = array(
	'Poppy Seed Bagel' => 2,
	'Plain Bagel' => 1,
	'Lox' => 4
);
print '<a href="next.php?cart=' . urlencode(serialize($shopping_cart)) . '">Next</a>';
?>