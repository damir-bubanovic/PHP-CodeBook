<?php 
/*

!!GRAPHICS - DRAWING LINES, RECTANGLES & POLYGONS!!

> want to draw a line, rectangle, or polygon. 
	>> You also want to be able to control if the rectangle or polygon is open or filled in. 
		>>> npr. you want to be able to draw bar charts or create graphs of stock quotes
		
> The prototypes for all five functions in the Solution are similar. 
	>> The first parameter is the canvas to draw on. 
	>> The next set of parameters are the x and y coordinates to specify where GD should draw the shape. 
		>>> In ImageLine(), the four coordinates are the endpoints of the line, and in ImageRectangle(), 
			they’re the opposite corners of the rectangle
		>>> The ImagePolygon() function is slightly different because it can accept a variable number
			of vertices. Therefore, the second parameter is an array of x and y coordinates
	>> The third parameter is the number of vertices in the shape; since that’s always half of the
	number of elements in the array of points
	>> Last, all the functions take a final parameter that specifies the drawing color

*ImageCreateTrueColor - create a new true color image
*ImageFilledRectangle - draw a filled rectangle
*ImageLine - draw a line
*ImagePNG - output a PNG image to either the browser or a file
*ImageDestroy - destroy an image
*ImageRectangle - draw a rectangle
*ImagePolygon - draws a polygon
*ImageFilledPolygon - draw a filled polygon

*/


/*To draw a line, use ImageLine()*/
$width = 200;
$height = 50;
$image = ImageCreateTrueColor($width, $height);

$background_color = 0xFFFFFF; // white
ImageFilledRectangle($image, 0, 0, $width - 1, $height - 1, $background_color);

$x1 = $y1 = 0 ; // 0
$x2 = $y2 = $height - 1; // 49
$color = 0xCCCCCC; // gray

ImageLine($image, $x1, $y1, $x2, $y2, $color);

header('Content-type: image/png');
ImagePNG($image);
ImageDestroy($image);



/*To draw an open rectangle, use ImageRectangle()*/
ImageRectangle($image, $x1, $y1, $x2, $y2, $color);

/*To draw a solid rectangle, use ImageFilledRectangle():*/
ImageFilledRectangle($image, $x1, $y1, $x2, $y2, $color);

/*To draw an open polygon, use ImagePolygon():*/
$points = array($x1, $y1, $x2, $y2, $x3, $y3);
ImagePolygon($image, $points, count($points)/2, $color);

/*To draw a filled polygon, use ImageFilledPolygon():*/
$points = array($x1, $y1, $x2, $y2, $x3, $y3);
ImageFilledPolygon($image, $points, count($points)/2, $color);



/*To draw a right triangle*/
$size = 50;
$image = ImageCreateTrueColor($size, $size);

$background_color = 0xFFFFFF; // white
ImageFilledRectangle($image, 0, 0, $size - 1, $size - 1, $background_color);

// three points for right triangle
$x1 = $y1 = 0 ; // ( 0, 0)
$x2 = $y2 = $size - 1; // (49,49)
$x3 = 0; $y3 = $size - 1; // ( 0,49)

$gray = 0xCCCCCC; // gray

$points = array($x1, $y1, $x2, $y2, $x3, $y3);
ImagePolygon($image, $points, count($points)/2, $gray);

header('Content-type: image/png');
ImagePNG($image);
ImageDestroy($image);

?>