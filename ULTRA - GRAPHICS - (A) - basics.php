<?php 
/*

!!GRAPHICS - BASICS!!

> With the GD library, you can use PHP to create applications that use dynamic images to display 
	1) stock quotes
	2) reveal poll results
	3) monitor system performance
	4) create games
> GD has an existing API, and PHP tries to follows its syntax and function-naming conventions
> GD can support GIFs, JPEGs, PNGs, and WBMPs. 
	>> GD reads in PNGs and JPEGs with almost no loss in quality. 
	>> GD supports PNG alpha channels, which allow you to specify a transparency level for each pixel
> GD lets you draw pixels, lines, rectangles, polygons, arcs, ellipses, and circles in any color you want
> You can also draw text using a variety of font types, including built-in and TrueType fonts
> You can add a watermark to identify yourself by overlaying text or an image on top of the picture

> GD is bundled with PHP
	>> There are two easy ways to see which version, if any, of GD is installed on your server 
	and how it’s configured
		1) call phpinfo() - look for -with-gd
		2) check the return value of function_exists('imagecreate'). 
			> If it returns true, GD is installed

*ImageCreateTrueColor - create a new true color image
*ImageFilledRectangle - draw a filled rectangle
*ImagePNG - output a PNG image to either the browser or a file
*ImageDestroy - destroy an image
*ImageCreateFromPNG - create a new image from file or URL
*ImageCreateFromJPEG - create a new image from file or URL
*ImageColorAllocate - allocate a color for an image
			
*/


/*The basic image-generation process has three steps: creating the image, 
adding graphics and text to the canvas, and displaying or saving the image*/
$image = ImageCreateTrueColor(200, 50);	// defaults to black

// color the background grey
$grey = 0xCCCCCC;
ImageFilledRectangle($image, 0, 0, 200 - 1, 50 - 1, $grey);

// draw a white rectangle on top
$white = 0xFFFFFF;
ImageFilledRectangle($image, 50, 10, 150, 40, $white);

// send it as PNG
header('Content-type: image/png');
ImagePNG($image);
ImageDestroy($image);
/*output of this code, which prints a white rectangle on a grey background*/


/*In addition to creating a new image, you can also edit existing images*/
// open a PNG from the local machine
$graph = ImageCreateFromPNG('/path/to/graph.png');

// open a JPEG from a remote server
$icon = ImageCreateFromJPEG('http://www.example.com/images/icon.jpeg');


/*The color is a number representing its RGB values
Another option is to use the ImageAllocate() function, which takes a canvas, and the red, green, and blue values*/
$color = ImageAllocate($image, $r, $g, $b);

// For example, white
$white = ImageAllocate($image, 0xFF, 0xFF, 0xFF); // hex
$white = ImageAllocate($image, 255, 255, 255); // decimal

// Or...
$grey = ImageColorAllocate($image, 204, 204, 204);
$orange = ImageColorAllocate($image, 0xE9, 0x52, 0x22);


/*To paint over the default background color of black*/
// color the background grey
$grey = 0xCCCCCC;
ImageFilledRectangle($image, 0, 0, 200 - 1, 50 - 1, $grey);


/*draw a rectangle on $image, starting at (50,10) and going to (150,40), in the color white*/
// draw a white rectangle on top
$white = 0xFFFFFF;
ImageFilledRectangle($image, 50, 10, 150, 40, $white);


/*Now that the image is all ready to go, you can serve it up. First, send a Content-Type
header to let the browser know what type of image you’re sending. In this case, display
a PNG. Next, have PHP write the PNG image out using ImagePNG()*/
header('Content-type: image/png');
ImagePNG($image);


/*To write the image to disk instead of sending it to the browser, provide a second argument
to ImagePNG() with where to save the file*/
ImagePNG($image, '/path/to/your/new/image.png');


/*PHP cleans up the image when the script ends, but to manually deallocate the memory
used by the image, call ImageDestroy($image) and PHP immediately gets rid of it*/
ImageDestroy($image);

?>