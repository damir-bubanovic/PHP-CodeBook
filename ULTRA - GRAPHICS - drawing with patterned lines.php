<?php 
/*

!!GRAPHICS - DRAWING WITH PATTERNED LINES!!

> want to draw shapes using line styles other than the default, a solid line

> The line pattern is defined by an array of colors. 
	>> Each element in the array is another pixel in the brush. 
	>> often useful to repeat the same color in successive elements because this increases the 
		size of the stripes in the pattern

*ImageSetStyle - set the style for line drawing
*ImageLine - draw a line
*ImageFilledRectangle - draw a filled rectangle

*/


/*To draw shapes with a patterned line, use ImageSetStyle() 
and pass in IMG_COLOR_STYLED as the image color*/
// make a two-pixel thick black and white dashed line
$black = 0x000000;
$white = 0xFFFFFF;

$style = array($black, $black, $white, $white);
ImageSetStyle($image, $style);

ImageLine($image, 0, 0, 50, 50, IMG_COLOR_STYLED);
ImageFilledRectangle($image, 50, 50, 100, 100, IMG_COLOR_STYLED);



/*Square drawn with alternating white and black pixels*/
// make a two-pixel thick black and white dashed line
$style = array($white, $black);
ImageSetStyle($image, $style);
ImageFilledRectangle($image, 0, 0, 49, 49, IMG_COLOR_STYLED);


/*Same square, but drawn with a style of five white pixels followed by five black ones*/
// make a five-pixel thick black and white dashed line
$style = array(
	$white, $white, $white, $white, $white,
	$black, $black, $black, $black, $black
);
ImageSetStyle($image, $style);
ImageFilledRectangle($image, 0, 0, 49, 49, IMG_COLOR_STYLED);

?>