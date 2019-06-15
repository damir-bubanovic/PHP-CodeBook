<?php 
/*

!!GRAPHICS - GETTING & SETTING A TRANSPARENT COLOR!!

> want to set one color in an image as transparent. 
	>> When the image is overlayed on a background, the background shows 
		through the transparent section of the image

*ImageColorTransparent - define a color as transparent
*ImageSetStyle - set the style for line drawing
*ImageColorsForIndex - get the colors for an index

*/


/*Use ImageColorTransparent()*/
$color = 0xFFFFFF;
ImageColorTransparent($image, $color);


/*Make a dashed line that alternates between black and transparent*/
// make a two-pixel thick black and white dashed line
$style = array($black, $black, IMG_COLOR_TRANSPARENT, IMG_COLOR_TRANSPARENT);
ImageSetStyle($image, $style);


/*Find the current transparency setting*/
$transparent = ImageColorsForIndex($image, ImageColorTransparent($image));
print_r($transparent);
/*The ImageColorsForIndex() function returns an array with the red, green, and blue
values. In this case, the transparent color is white*/

?>