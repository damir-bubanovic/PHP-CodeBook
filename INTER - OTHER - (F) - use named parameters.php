<?php 
/*

!!USE NAMED PARAMETERS!!

> specify your arguments to a function by name, instead of simply their position in the function invocation
*array_merge - merge one or more arrays

*/


function image($img) {
	$tag = '<img src="' . $img['src'] . '" ';
	$tag .= 'alt="' . (isset($img['alt']) ? $img['alt'] : '') .'"/>';
	return $tag;
}

// $image1 is '<img src="cow.png" alt="cows say moo"/>'
$image1 = image(array('src' => 'cow.png', 'alt' => 'cows say moo'));

// $image2 is '<img src="pig.jpeg" alt=""/>'
$image2 = image(array('src' => 'pig.jpeg'));



/*assign a default value for a parameter*/
function image($img) {
	if (! isset($img['src'])) { $img['src'] = 'cow.png'; }
	if (! isset($img['alt'])) { $img['alt'] = 'milk factory'; }
	if (! isset($img['height'])) { $img['height'] = 100; }
	if (! isset($img['width'])) { $img['width'] = 50; }
	/* ... */
}

/*OR*/

/*use array_merge() to handle this*/
function image($img) {
	$defaults = array(
		'src' => 'cow.png',
		'alt' => 'milk factory',
		'height' => 100,
		'width' => 50
	);
	$img = array_merge($defaults, $img);
	/* ... */
}
?>