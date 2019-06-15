<?php 
/*

!!GRAPHICS - DRAWING TEXT!!

> want to draw text as a graphic. This allows you to make dynamic buttons or hit counters

> To use TrueType fonts, you must install the FreeType library and configure PHP
during installation to use FreeType. 
	>> To enable FreeType 2.x, use --with-freetypedir=DIR

*ImageString - draw a string horizontally
*ImageFTText - write text to the image using fonts using FreeType 2
*ImageStringUp - draw a string vertically
*ImageCreateTrueColor - create a new true color image
*ImageFilledRectangle - draw a filled rectangle
*ImagePNG - output a PNG image to either the browser or a file
*header - send a raw HTTP header

*/


/*For built-in GD fonts, use ImageString()*/
ImageString($image, 1, $x, $y, 'I love PHP Cookbook', $text_color);

/*For TrueType fonts, use ImageFTText():*/
ImageFTText($image, $size, 0, $x, $y, $text_color, '/path/to/font.ttf', 'I love PHP Cookbook');


/*To draw text vertically instead of horizontally, use the function ImageStringUp() instead*/
ImageStringUp($image, 1, $x, $y, 'I love PHP Cookbook', $text_color);



/*Like ImageString(), ImageFTText() prints a string to a canvas*/
$image = ImageCreateTrueColor(200, 50);
ImageFilledRectangle($image, 0, 0, 199, 49, 0xFFFFFF); // white

$size = 20;
$angle = 0;
$x = 20;
$y = 35;
$text_color = 0x000000; // black
$text = 'Hello PHP!';
$fontpath = __DIR__ . '/stocky/stocky.ttf';

ImageFTText($image, $size, $angle, $x, $y, $text_color, $fontpath, $text);

header('Content-type: image/png');
ImagePNG($image);

/*The $size argument is the font size in pixels; $angle is an angle of rotation, in degrees
going counterclockwise; and /path/to/font.ttf is the pathname to the TrueType font file*/

?>