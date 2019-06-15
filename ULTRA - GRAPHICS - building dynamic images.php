<?php 
/*

!!GRAPHICS - BUILDING DYNAMIC IMAGES!!

> want to create an image based on an existing image template and dynamic data (typically text).
	>> npr. you want to create a hit counter

*ImageCreateFromPNG - create a new image from file or URL
*ImageFTCenter - function to center text in another file
*ImageFTText - write text to the image using fonts using FreeType 2
*ImageColorTransparent - define a color as transparent
*ImageColorAllocateAlpha - allocate a color for an image
*ImageAlphaBlending - set the blending mode for an image
*ImageSaveAlpha - Set the flag to save full alpha channel information 
				(as opposed to single-color transparency) when saving PNG images
*header - send a raw HTTP header
*ImagePNG - output a PNG image to either the browser or a file
*ImagePSFreeFont - free memory used by a PostScript Type 1 font
*ImageDestroy - destroy an image
*$_GET - associative array of variables passed to the current script via the URL parameters
*ImageCreateFromPNG - create a new image from file or URL
*htmlentities - convert all applicable characters to HTML entities

*/


/*Load the template image, find the correct position to properly center your text, 
add the text to the canvas, and send the image to the browser*/

include 'imageftcenter.php';

// Configuration settings
$image = ImageCreateFromPNG('/path/to/button.png'); // Template image
$size = 24;
$angle = 0;
$color = 0x000000;
$fontfile = '/path/to/font.ttf'; // Edit accordingly
$text = $_GET['text']; // Or any other source

// Print-centered text
list($x, $y) = ImageFTCenter($image, $size, $angle, $fontfile, $text);
ImageFTText($image, $size, $angle, $x, $y, $color, $fontfile, $text);

// Preserve Transparency
ImageColorTransparent($image,
ImageColorAllocateAlpha($image, 0, 0, 0, 127));
ImageAlphaBlending($image, false);
ImageSaveAlpha($image, true);

// Send image
header('Content-type: image/png');
ImagePNG($image);

// Clean up
ImagePSFreeFont($font);
ImageDestroy($image);



/*EXAMPLE - code generates a page of HTML and image tags using dynamic buttons*/
if (isset($_GET['button'])) {
	
	// Configuration settings
	$image = ImageCreateFromPNG(__DIR__ . '/button.png');
	$text = $_GET['button']; // dynamically generated text
	$font = '/Library/Fonts/Hei.ttf';
	$size = 24;
	$color = 0x000000;
	$angle = 0;
	
	// Print-centered text
	list($x, $y) = ImageFTCenter($image, $size, $angle, $font, $text);
	ImageFTText($image, $size, $angle, $x, $y, $color, $font, $text);
	
	// Preserve Transparency
	ImageColorTransparent($image,
		ImageColorAllocateAlpha($image, 0, 0, 0, 127));
	ImageAlphaBlending($image, false);
	ImageSaveAlpha($image, true);
	
	// Send image
	header('Content-type: image/png');
	ImagePNG($image);
	// Clean up
	
	ImagePSFreeFont($font);
	ImageDestroy($image);
} else {
	$url = htmlentities($_SERVER['PHP_SELF']);
?>

<html>
<head>
<title>Sample Button Page</title>
</head>
<body>
<img src="<?php echo $url; ?>?button=Previous" alt="Previous" width="132" height="46">
<img src="<?php echo $url; ?>?button=Next" alt="Next" width="132" height="46">
</body>
</html>

<?php
}
?>