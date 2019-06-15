<?php 
/*

!!GRAPHICS - DRAWING CENTERED TEXT!!

> want to draw text in the center of an image

> Find the size of the image and the bounding box of the text. 
	>> Using those coordinates, compute the correct spot to draw the text

*ImageSX - get image width
*ImageSY - get image height
*ImageFTBBox - give the bounding box of a text using fonts via freetype2
*list - assign variables as if they were an array
*ImageFTText - write text to the image using fonts using FreeType 2
*ImageString - draw a string horizontally
*ImageCreateTrueColor - create a new true color image
*ImageFilledRectangle - draw a filled rectangle

*/


/*For TrueType fonts, use the ImageFTCenter() function*/
function ImageFTCenter($image, $size, $angle, $font, $text, $extrainfo = array()) {
	
	// find the size of the image
	$xi = ImageSX($image);
	$yi = ImageSY($image);
	
	// find the size of the text
	$box = ImageFTBBox($size, $angle, $font, $text, $extrainfo);
	$xr = abs(max($box[2], $box[4]));
	$yr = abs(max($box[5], $box[7]));
	
	// compute centering
	$x = intval(($xi - $xr) / 2);
	$y = intval(($yi + $yr) / 2);
	
	return array($x, $y);
}

list($x, $y) = ImageFTCenter($image, $size, $angle, $font, $text);
ImageFTText($image, $size, $angle, $x, $y, $fore, $font, $text);



/*For built-in GD fonts, use the ImageStringCenter() function*/
function ImageStringCenter($image, $text, $font) {
	
	// font sizes
	$width = array(1 => 5, 6, 7, 8, 9);
	$height = array(1 => 6, 8, 13, 15, 15);
	
	// find the size of the image
	$xi = ImageSX($image);
	$yi = ImageSY($image);
	
	// find the size of the text
	$xr = $width[$font] * strlen($text);
	$yr = $height[$font];
	
	// compute centering
	$x = intval(($xi - $xr) / 2);
	$y = intval(($yi - $yr) / 2);
	
	return array($x, $y);
}

list($x, $y) = ImageStringCenter($image, $text, $font);
ImageString($image, $font, $x, $y, $text, $fore);



/*To center text, put it together like this*/
list($x, $y) = ImageFTCenter($image, $size, $angle, $font, $text);
ImageFTText($image, $size, $angle, $x, $y, $color, $font, $text);



/*example using all five fonts that centers text horizontally*/
$w = 400; $h = 75;
$image = ImageCreateTrueColor($w, $h);
ImageFilledRectangle($image, 0, 0, $w-1, $h-1, 0xFFFFFF);

$color = 0x000000; // black
$text = 'Pack my box with five dozen liquor jugs.';

for ($font = 1, $y = 5; $font <= 5; $font++, $y += 20) {
	list($x) = ImageStringCenter($image, $text, $font);
	ImageString($image, $font, $x, $y, $text, $color);
}

?>