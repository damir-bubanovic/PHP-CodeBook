<?php 
/*

!!GRAPHICS - DRAWING ARCS, ELLIPSES & CIRCLES!!

> want to draw open or filled curves. 
	>> npr. you want to draw a pie chart showing the results of a user poll

> ImageArc() function is highly flexible, you can create many types of curves.
	>> first parameter is the canvas. 
	>> next two parameters are the x and y coordinates for the center position of the arc. 
	>> third is arc width and height.
	>> sixth and seventh parameters are the starting and ending angles, in degrees. 
		>>> A value of 0 is at three o’clock. 
		>>> The arc then moves clockwise, so 90 is at six o’clock, 180 is at nine o’clock, 
			and 270 is at the top of the hour
	>> last parameter is the arc color

*ImageArc - draws an arc
*ImageEllipse - draw an ellipse
*ImageCreateTrueColor - create a new true color image
*ImageFilledRectangle - draw a filled rectangle
*ImageEllipse - draw an ellipse
*ImageFilledEllipse - draw a filled ellipse
*ImagePNG - output a PNG image to either the browser or a file
*ImageDestroy - destroy an image

*/


/*To draw an arc, use ImageArc():*/
ImageArc($image, $x, $y, $width, $height, $start, $end, $color);

/*To draw an ellipse, use ImageEllipse():*/
ImageEllipse($image, $x, $y, $width, $height, $color);

/*To draw a circle, use ImageEllipse(), and use the same value for both $width and $height:*/
ImageEllipse($image, $x, $y, $diameter, $diameter, $color);



/*draw an open black circle with a diameter of 100 pixels centered on the canvas*/
$size = 100;
$image = ImageCreateTrueColor($size, $size);

$background_color = 0xFFFFFF; // white
ImageFilledRectangle($image, 0, 0, $size - 1, $size - 1, $background_color);

$black = 0x000000;
ImageEllipse($image, $size / 2, $size / 2, $size - 1, $size - 1, $black);

/*To produce a solid ellipse or circle, call ImageFilledEllipse():*/
ImageFilledEllipse($image, $size / 2, $size / 2, $size - 1, $size - 1, $black);



/*There is also an ImageFilledArc() function. It takes an additional final parameter that
describes the fill style*/
/*This draws an assortment of pie wedges*/
$styles = [
	IMG_ARC_PIE,
	IMG_ARC_CHORD,
	IMG_ARC_PIE | IMG_ARC_NOFILL,
	IMG_ARC_PIE | IMG_ARC_NOFILL | IMG_ARC_EDGED
];

$size = 100;
$image = ImageCreateTrueColor($size * count($styles), $size);

$background_color = 0xFFFFFF; // white
ImageFilledRectangle($image, 0, 0,
	$size * count($styles) - 1, $size * count($styles) - 1, $background_color);
	
$black = 0x000000; // aka 0

for ($i = 0; $i < count($styles); $i++) {
	ImageFilledArc($image, $size / 2 + $i * $size, $size / 2, $size - 1, $size - 1, 0, 135, $black, $styles[$i]);
}

header('Content-type: image/png');
ImagePNG($image);
ImageDestroy($image);

?>