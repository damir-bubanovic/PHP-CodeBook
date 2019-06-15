<?php 
/*

!!METHOD POLYMORPHISM!!

> VISIBILITY
	- public		can be accessed everywhere
	- private		can only be accessed by the class that defines it
	- protected		can be accessed only within the class itself and by inherited classes (children)
	- static		properties or methods as static makes them accessible without needing an instantiation of the class
						> pseudo-variable $this is not available inside the method

> Execute different code depending on the number and type of arguments passed to a method

*is_int - finds whether the type of the given variable is integer
*is_float - finds whether the type of the given variable is float
*is_string - find whether the type of a variable is string
*is_array - finds whether the given variable is an array
*is_bool - finds out whether a variable is a boolean
*pathinfo - returns information about path: either an associative array or a string, depending on options
*strtolower - returns string with all alphabetic characters converted to lowercase
*is_resource - finds whether the given variable is a resource

*/


/*
Execute different code depending on the number and type of arguments passed to a method
- combine() adds numbers, concatenates strings, merges arrays, and ANDs bitwise and boolean arguments
*/
function combine($a, $b) {
	if (is_int($a) && is_int($b)) {
		return $a + $b;
	}
	
	if (is_float($a) && is_float($b)) {
		return $a + $b;
	}
	
	if (is_string($a) && is_string($b)) {
		return "$a$b";
	}
	
	if (is_array($a) && is_array($b)) {
		return array_merge($a, $b);
	}
	
	if (is_bool($a) && is_bool($b)) {
		return $a & $b;
	}
	
	return false;
}

/*image class to be able to pass in either the location of the image (remote or local) or the handle PHP has assigned to an existing image stream*/
class Image {
	protected $handle;

	function ImageCreate($image) {
		if (is_string($image)) {
		// simple file type guessing
		// grab file suffix
		$info = pathinfo($image);
		$extension = strtolower($info['extension']);
		switch ($extension) {
			case 'jpg':
			case 'jpeg':
				$this->handle = ImageCreateFromJPEG($image);
				break;
			case 'png':
				$this->handle = ImageCreateFromPNG($image);
				break;
			default:
				die('Images must be JPEGs or PNGs.');
			}
		} elseif (is_resource($image)) {
			$this->handle = $image;
		} else {
			die('Variables must be strings or resources.');
		}
	}
}
?>