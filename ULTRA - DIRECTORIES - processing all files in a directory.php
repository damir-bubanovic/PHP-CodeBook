<?php 
/*

!!DIRECTORIES - PROCESSING ALL FILES IN A DIRECTORY!!

> You want to iterate over all files in a directory
	>> npr. you want to create a <select/> box in a form that lists all the 
	files in a directory
	
> A DirectoryIterator yields an object for all directory elements, including . (current
directory) and .. (parent directory). 
> Fortunately, that object has some methods that help us identify what it is. 
> The isDot() method returns true if it’s either . or ...

> LOOK UP - DirectoryIterator object information methods on php.net

*htmlentities - convert all applicable characters to HTML entities

*/


/*Use a DirectoryIterator to get each file in the directory*/
print "<select name='file'>\n";

foreach(new DirectoryIterator('/usr/local/images') as $file) {
	print '<option>' . htmlentities($file) . "</option>\n";
}

print '</select>';


/*isDot() to prevent those two entries from showing up in the output*/
print "<select name='file'>\n";

foreach(new DirectoryIterator('/usr/local/images') as $file) {
	if(!$file->isDot()) {
	print '<option>' . htmlentities($file) . "</option>\n";
	}
}

print '</select>';

?>