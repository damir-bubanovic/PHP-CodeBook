<?php 
/*

!!PROGRAM: SITE SEARCH!!

> You can use site-search.php as a search engine for a small-to-medium, file-based, site


> VISIBILITY
	- public		can be accessed everywhere
	- private		can only be accessed by the class that defines it
	- protected		can be accessed only within the class itself and by inherited classes (children)
	- static		properties or methods as static makes them accessible without needing an instantiation of the class
						> pseudo-variable $this is not available inside the method

*realpath - returns canonicalized absolute pathname
*file_get_contents - reads entire file into a string
*preg_match - perform a regular expression match
*substr_replace - replace text within a portion of a string
*$_SERVER - array containing information such as headers, paths, and script locations
*strlen - returns the length of the given string
*array_push - push one or more elements onto the end of array
*strcmp - binary safe string comparison
*preg_quote - quote regular expression characters
*$_GET - associative array of variables passed to the current script via the URL parameters
*array_merge - merge one or more arrays
*count - count all elements in an array, or something in an object
*usort - sort an array by values using a user-defined comparison function
*sprintf - return a formatted string

*/


class SiteSearch {
	
	public $bodyRegex = '';
	protected $seen = array();
	
	public function searchDir($dir) {
		// array to hold pages that match
		$pages = array();
		// array to hold directories to recurse into
		$dirs = array();
		// mark this directory as seen so we don't look in it again
		$this->seen[realpath($dir)] = true;
		
		try {
			foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir)) as $file) {
				if($file->isFile() && $file->isReadable() && (!isset($this->seen[$file->getPathname()]))) {
					/*mark this as seen so we skip it if we come to it again*/
					$this->seen[$file->getPathname()] = true;
					// load the contents of the file into $text
					$text = file_get_contents($file->getPathname());
					
					// if the search term is inside the body delimiters
					if(preg_match($this->bodyRegex, $text)) {
						/*construct the relative URI of the file by removing
						the document root from the full path*/
						$uri = substr_replace($file->getPathname(), '', 0, strlen($_SERVER['DOCUMENT_ROOT']));
					}
					
					// if the page has a title, find it
					if(preg_match('#<title>(.*?)</title>#Sis', $text, $match)) {
						// and add the title and URI to $pages
						array_push($pages, array($uri, $match[1]));
					} else {
						array_push($pages, array($uri, $uri));
					}
				}
			}
		} catch(Exception $e) {
			// There was a problem opening the directory
		}
		
		return $pages;
	}
}


// helper function to sort matched pages alphabetically by title
function by_title($a, $b) {
	return ($a[1] == $b[1]) ? strcmp($a[0], $b[0]) : ($a[1] > $b[1]);
}

// SiteSearch object to do the searching
$search = new SiteSearch();

// array to hold the pages that match the search term
$matching_pages = array();

// directories underneath the document root to search
$search_dirs = array('sports','movies','food');

/*egular expression to use in searching files. The "S" pattern
modifier tells the PCRE engine to "study" the regex for greater
efficiency*/
$search->bodyRegex = '#<body>(.*' . preg_quote($_GET['term'],'#'). '.*)</body>#Sis';

// add the files that match in each directory to $matching pages
foreach($search_dirs as $dir) {
	$matching_pages = array_merge($matching_pages, $search->searchDir($_SERVER['DOCUMENT_ROOT']. '/' .$dir));
}
if(count($matching_pages)) {
	// sort the matching pages by title
	usort($matching_pages,'by_title');
	print '<ul>';

	// print out each title with a link to the page
	foreach($matching_pages as $k => $v) {
		print sprintf('<li> <a href="%s">%s</a>',$v[0],$v[1]);
	}
	
	print '</ul>';
} else {
	print 'No pages found.';
}

?>