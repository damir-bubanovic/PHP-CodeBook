<?php 
/*

!!INTER & LOCAL - LOCALIZING IMAGES!!

> want to display images that have text in them and have that text in a 
Localeappropriate language

> Make an image directory for each locale you want to support, as well as a global image directory for 
images that have no locale-specific information in them. 
	>> Create copies of each locale-specific image in the appropriate locale-specific directory. 
	>> Make sure that the images have the same filename in the different directories. 
	>> Instead of printing out image URLs directly, treat their paths as localizable strings, either by 
	explicitly storing them in your message catalogs or by computing the right path at runtime

> VISIBILITY
	- public		can be accessed everywhere
	- private		can only be accessed by the class that defines it
	- protected		can be accessed only within the class itself and by inherited classes (children)
	- static		properties or methods as static makes them accessible without needing an instantiation of the class
						> pseudo-variable $this is not available inside the method

*is_readable - tells whether a file exists and is readable
*error_log - send an error message to the defined error handling routines

*/


/*The img() wrapper function looks for a locale-specific version of an image first, 
then a global one. If neither are present, it prints a message to the error log*/
/*Finding locale-specific images*/
function img($locale, $f) {
	static $image_base_path = '/usr/local/www/images';
	static $image_base_url = '/images';
	
	if(is_readable("$image_base_path/$locale/$f")) {
		return "$image_base_url/$locale/$f";
	} elseif(is_readable("$image_base_path/global/$f")) {
		return "$image_base_url/global/$f";
	} else {
		error_log("l10n error: $locale, image: '$f'");
	}
}


/*Don’t forget that the alt text you display in your image tags also needs to be localized*/
/*A localized <img> element*/
print '<img src="' . img($locale, 'cancel.png') . '" ' .
	'alt="' . $messages[$locale]['CANCEL'] . '"/>';


/*If the localized versions of a particular image have varied dimensions, store image height
and width in the message catalog as well*/
/*A localized <img/> element with height and width*/
print '<img src="' . img($locale, 'cancel.png') . '" ' .
	'alt="' . $messages[$locale]['CANCEL'] . '" ' .
	'height="' . $messages[$locale]['CANCEL_IMG_HEIGHT'] . '" ' .
	'width="' . $messages[$locale]['CANCEL_IMG_WIDTH'] . '"/>';

?>