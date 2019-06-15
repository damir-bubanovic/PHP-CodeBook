<?php 
/*

!!DIRECTORIES - GETTING A LIST OF FILENAMES MATCHING A PATTERN!!

> You want to find all filenames that match a pattern

> Use a FilterIterator subclass with DirectoryIterator. 
	>> The FilterIterator subclass needs its own accept() method that 
	decides whether or not a particular value is acceptable


> VISIBILITY
	- public		can be accessed everywhere
	- private		can only be accessed by the class that defines it
	- protected		can be accessed only within the class itself and by inherited classes (children)
	- static		properties or methods as static makes them accessible without needing an instantiation of the class
						> pseudo-variable $this is not available inside the method

*preg_match - perform a regular expression match
*htmlentities - convert all applicable characters to HTML entities
*glob - find pathnames matching a pattern
*file_get_contents - reads entire file into a string

*/


/*To only accept filenames that end with common extensions for images*/
class ImageFilter extends FilterIterator {
	public function accept() {
		return preg_match('@\.(gif|jpe?g|png)$@i',$this->current());
	}
}

foreach(new ImageFilter(new DirectoryIterator('/usr/local/images')) as $img) {
	print "<img src='" . htmlentities($img) . "'/>\n";
}



/*If your pattern can be expressed as a simple shell glob (e.g., *.*), use the glob() 
function to get the matching filenames. 
	>> npr. to find all the text files in a particular directory*/
foreach(glob('/usr/local/docs/*.txt') as $file) {
	$contents = file_get_contents($file);
	print "$file contains $contents\n";
}

?>