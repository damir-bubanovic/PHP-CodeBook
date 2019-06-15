<?php 
/*

!!GRAPHICS - EXTRACT METAINFORMATION FROM IMAGE - READING EXIF DATA!!

> want to extract metainformation from an image file. 
	>> This lets you find out when the photo was taken, the image size, and the MIME type
	
> The Exchangeable Image File Format (EXIF) is a standard for embedding metadata inside of pictures. 
> Most digital cameras use EXIF, so it’s an popular way of providing rich data in photo galleries

> PHP - must be enabled by passing the --enable-exif configuration flag.
	
*exif_read_data - reads the EXIF headers from JPEG or TIFF
*exif_thumbnail - retrieve the embedded thumbnail of a TIFF or JPEG image
*image_type_to_mime_type - get Mime-Type for image-type returned by getimagesize, 
							exif_read_data, exif_thumbnail, exif_imagetype
*header - send a raw HTTP header

*/


/*Use the exif_read_data() function*/
$exif = exif_read_data('beth-and-seth.jpeg');
print_r($exif);


/*
Use the html value to directly embed height and width attributes within an <img> source tag.

You can also use the EXIF functions to retrieve a thumbnail image associated with the
picture. To access this, call exif_thumbnail()
*/
$thumb = exif_thumbnail('beth-and-seth.jpeg', $width, $height, $type);





/*To serve up the image directly, use the image_type_to_mime_type() to get the correct
MIME type. Pass that along as an HTTP header and then display the image*/
$thumb = exif_thumbnail('beth-and-seth.jpeg', $width, $height, $type);

if ($thumb !== false) {
	$mime = image_type_to_mime_type($type);
	header("Content-type: $mime");
	print $thumb;
} else {
	print "Sorry. No thumbnail.";
}


/*OR*/


/*you can create an <img> link*/
$file = 'beth-and-seth.jpeg';
$thumb = exif_thumbnail($file, $width, $height, $type);

if ($thumb !== false) {
	$img = "<img src=\"$file\" alt=\"Beth and Seth\"width=\"$width\" height=\"$height\">";
	print $img;
}

?>