<?php 
/*

!!GRAPHICS - OVERLAYING WATERMARKS!!

> want to overlay a watermark stamp on top of images

*ImageCreateFromPNG - create a new image from file or URL
*ImageCopy - copy part of an image
*imagesx - get image width
*imagesy - get image height
*ImageCreateFromJPEG - create a new image from file or URL
*ImageCreateTrueColor - create a new true color image
*ImageFilledRectangle - draw a filled rectangle
*ImageString - draw a string horizontally
*ImageCopyMerge - copy and merge part of an image
*header - send a raw HTTP header
*ImagePNG - output a PNG image to either the browser or a file
*ImageDestroy - destroy an image

*/


/*If your watermark stamp has a transparent background, use ImageCopy() 
to use alpha channels*/
$image = ImageCreateFromPNG('/path/to/image.png');
$stamp = ImageCreateFromPNG('/path/to/stamp.png');

$margin = ['right' => 10, 'bottom' => 10]; // offset from the edge

ImageCopy(
	$image, $stamp,
	imagesx($image) - imagesx($stamp) - $margin['right'],
	imagesy($image) - imagesy($stamp) - $margin['bottom'],
	0, 0, imagesx($stamp), imagesy($stamp)
);


/*OR*/


/*Otherwise, use ImageCopyMerge() with an opacity*/
$image = ImageCreateFromPNG('/path/to/image.png');
$stamp = ImageCreateFromPNG('/path/to/stamp.png');

$margin = ['right' => 10, 'bottom' => 10]; // offset from the edge
$opacity = 50; // between 0 and 100%

ImageCopyMerge($image, $stamp,
	imagesx($image) - imagesx($stamp) - $margin['right'],
	imagesy($image) - imagesy($stamp) - $margin['bottom'],
	0, 0, imagesx($stamp), imagesy($stamp), $opacity
);



/*Putting all this together in action*/
$image = ImageCreateFromJPEG(__DIR__ . '/iguana.jpg');

// Stamp
$w = 400; $h = 75;
$stamp = ImageCreateTrueColor($w, $h);
ImageFilledRectangle($stamp, 0, 0, $w-1, $h-1, 0xFFFFFF);

// Attribution text
$color = 0x000000; // black
ImageString($stamp, 4, 10, 10, 'Galapagos Land Iguana by Nicolas de Camaret', $color);
ImageString($stamp, 4, 10, 28, 'http://flic.kr/ndecam/6215259398', $color);
ImageString($stamp, 2, 10, 46, 'Licence at http://creativecommons.org/licenses/by/2.0.', $color);

// Add watermark
$margin = ['right' => 10, 'bottom' => 10]; // offset from the edge
$opacity = 50; // between 0 and 100%
ImageCopyMerge($image, $stamp,
	imagesx($image) - imagesx($stamp) - $margin['right'],
	imagesy($image) - imagesy($stamp) - $margin['bottom'],
	0, 0, imagesx($stamp), imagesy($stamp), $opacity
);

// Send
header('Content-type: image/png');
ImagePNG($image);
ImageDestroy($image);
ImageDestroy($stamp);
/*This all adds transparetn text box with text at the bottom right of image*/

?>