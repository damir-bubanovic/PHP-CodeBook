<?php 
/*

!!GRAPHICS - CREATING THUMBNAIL IMAGES!!

> want to create scaled-down thumbnail images

> Thumbnail images allow you to quickly display a large number of photos in a small amount of space. 
	>> The hardest part is knowing the best algorithm to scale or crop (or both) when your original 
		pictures may be a wide variety of sizes and ratios
	>> Be sure that all your pictures are about the same size and shape

*ImageCreateFromPNG - create a new image from file or URL
*ImageCreateTrueColor - create a new true color image
*ImageSX - get image width
*ImageSY - get image height
*ImageColorTransparent - define a color as transparent
*ImageColorAllocateAlpha - allocate a color for an image
*ImageAlphaBlending - set the blending mode for an image
*ImageSaveAlpha - Set the flag to save full alpha channel information (as opposed to 
					single-color transparency) when saving PNG images
*ImageCopyResampled - copy and resize part of an image with resampling
*ImagePNG - output a PNG image to either the browser or a file
*ImageDestroy - destroy an image

*/


/*Use the ImageCopyResampled() function, scaling the image as needed*/

/*To shrink proportionally*/
$filename = __DIR__ . '/php.png';
$scale = 0.5; // Scale

// Images
$image = ImageCreateFromPNG($filename);
$thumbnail = ImageCreateTrueColor(
ImageSX($image) * $scale,
ImageSY($image) * $scale);

// Preserve Transparency
ImageColorTransparent($thumbnail,
	ImageColorAllocateAlpha($thumbnail, 0, 0, 0, 127));
ImageAlphaBlending($thumbnail, false);
ImageSaveAlpha($thumbnail, true);

// Scale & Copy
ImageCopyResampled($thumbnail, $image, 0, 0, 0, 0,
	ImageSX($thumbnail), ImageSY($thumbnail),
	ImageSX($image), ImageSY($image));

// Send
header('Content-type: image/png');
ImagePNG($thumbnail);
ImageDestroy($image);
ImageDestroy($thumbnail);



/*To shrink to a fixed-size rectangle*/

// Rectangle Version
$filename = __DIR__ . '/php.png';

// Thumbnail Dimentions
$w = 50; $h = 20;

// Images
$original = ImageCreateFromPNG($filename);
$thumbnail = ImageCreateTrueColor($w, $h);
// Preserve Transparency

ImageColorTransparent($thumbnail,
	ImageColorAllocateAlpha($thumbnail, 0, 0, 0, 127));
ImageAlphaBlending($thumbnail, false);
ImageSaveAlpha($thumbnail, true);

// Scale & Copy
$x = ImageSX($original);
$y = ImageSY($original);
$scale = min($x / $w, $y / $h);
ImageCopyResampled($thumbnail, $original,
	0, 0, ($x - ($w * $scale)) / 2, ($y - ($h * $scale)) / 2,
	$w, $h, $w * $scale, $h * $scale);
	
// Send
header('Content-type: image/png');
ImagePNG($thumbnail);
ImageDestroy($original);
ImageDestroy($thumbnail);



/*When scaling to a proportional size, the thumbnail canvas is a factor of the original dimensions. 
The ImageSX() and ImageSY() functions allow you to dynamically extract that data*/
$thumbnail = ImageCreateTrueColor(
	ImageSX($image) * $scale,
	ImageSY($image) * $scale);


/*Then, when it’s time to scale the image, you again use those two 
functions to specify the size of the images*/
// Scale & Copy
ImageCopyResampled($thumbnail, $image, 0, 0, 0, 0,
	ImageSX($thumbnail), ImageSY($thumbnail),
	ImageSX($image), ImageSY($image));


/*When scaling to a constant size, the thumbnail canvas is simple. 
It’s the width and height you choose*/
$thumbnail = ImageCreateTrueColor($w, $h);


/*Code to scale and copy the image is more complicated*/
// Scale & Copy
$x = ImageSX($original);
$y = ImageSY($original);
$scale = min($x / $w, $y / $h);

ImageCopyResampled($thumbnail, $original,
	0, 0, ($x - ($w * $scale)) / 2, ($y - ($h * $scale)) / 2,
	$w, $h, $w * $scale, $h * $scale);

?>