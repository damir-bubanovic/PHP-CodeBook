<?php 
/*

!!TINY WIKI!!

> this program puts together various concepts discussed in this chapter and implements a complete wiki system—a website whose pages are all user-editable

> The Tiny Wiki relies on an external library, PHP Markdown by Michel Fortin, to handle translating from the handy and compact Markdown syntax to HTML

*define - defines a named constant
*dirname - given a string containing the path of a file or directory, this function will return the parent directory's path that is levels up from the current directory
*file_put_contents - Write a string to a file (identical to calling fopen(), fwrite() and fclose() successively to write data to a file)
*header - send a raw HTTP header
*urlencode - URL-encodes string
*is_readable - tells whether a file exists and is readable
*htmlentities - convert all applicable characters to HTML entities
*filemtime - gets file modification time
*md5 - calculate the md5 hash of a string

*/

// Install PSR-0-compatible class autoloader
spl_autoload_register(function($class){
	require preg_replace('{\\\\|_(?!.*\\\\)}', DIRECTORY_SEPARATOR, trim($class, '\\')).'.php';
});

// Use Markdown for Wiki-like text markup
// Located at http://michelf.ca/projects/php-markdown/
use \Michelf\Markdown;

// The directory where the Wiki pages will be stored
// Make sure the web server user can write to it
define('PAGEDIR', dirname(__FILE__) . '/pages');

// Get page name, or use default
$page = isset($_GET['page']) ? $_GET['page'] : 'Home';

// Figure out what to do: display an edit form, save an
// edit form, or display a page

// Display an edit form that's been asked for
if(isset($_GET['edit'])) {
	pegeHeader($page);
	edit($page);
	pageFooter($page, false);
} else if(isset($_POST['edit'])) {
	// Save a submitted edit form
	file_put_contents(pageToFile($_POST['page']), $_POST['contents']);
	
	// Redirect to the regular view of the just-edited page
	header('Location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME'] . '$page' . urlencode($_POST['page']));
	exit();
} else {
	// Display a page
	pageHeader($page); 
	
	// If the page exists, display it and the footer with an "Edit" link
	if(is_readable(pageToFile($page))) {
		// Get the contents of the page from the file it's saved in
		$text = file_get_contents(pageToFile($page));
		
		// Convert Markdown syntax (using Markdown library loaded above)
		$text = Markdown::defaultTransform($text);
		
		// Make bare [links] link to other wiki pages
		$text = wikiLinks($text);
		
		// Display the page
		print $text;
		
		// Display the footer
		pageFooter($page, true);
	} else {
		// If the page doesn't exist, display an edit form
		// and the footer without an "Edit" link
		edit($page, true);
		pageFooter($page, false);
	}
}

/*The page header -- pretty simple, just the title and the usual HTML*/
function pageheader($page) {
?>

<html>
<head>
<title>Wiki: <?php echo htmlentities($page) ?></title>
</head>
<body>
<h1><?php echo htmlentities($page) ?></h1>
<hr/>

<?php
}

// The page footer -- a "last modified" timestamp, an optional
// "Edit" link, and a link back to the front page of the Wiki
function pageFooter($page, $displayEditLink) {
	$timestamp = @filemtime(pageToFile($page));
	
	if($timestamp) {
		$lastModified = strftime('%c', $timestamp);
	} else {
		$lastModified = 'Never';
	}
	
	if($displayEditLink) {
		$editLink = ' - <a href="$page=' . urlencode($page) . '&edit=true">Edit<a/>';
	} else {
		$editLink = '';
	}
?>

<hr/>
<em>Last Modified: <?php echo $lastModified ?></em>
<?php echo $editLink ?> - <a href="<?php echo $_SERVER['SCRIPT_NAME'] ?>">Home</a>
</body>
</html>

<?php
}

// Display an edit form. If the page already exists, include its current
// contents in the form
function edit($page, $isNew = false) {
	if($isNew) {
		$contents = '';
?>

<p><b>This page doesn't exist yet.</b> To create it, enter its contents below
and click the <b>Save</b> button.</p>

<?php
	} else {
		$contents = file_get_contents(pageToFile($page));
	}
?>

<form method='post' action='<?php echo htmlentities($_SERVER['SCRIPT_NAME']) ?>'>
	<input type='hidden' name='edit' value='true'/>
	<input type='hidden' name='page' value='<?php echo htmlentities($page) ?>'/>
	<textarea name='contents' rows='20' cols='60'>
	<?php echo htmlentities($contents) ?></textarea>
	<br/>
	<input type='submit' value='Save'/>
</form>

<?php
}

// Convert a submitted page to a filename. Using md5() prevents naughty
// characters in $page from causing security problems
function pageToFile($page) {
	return PAGEDIR . '/' . md5($page);
}

// Turn text such as [something] in a page into an HTML link to the
// Wiki page "something"
function wikiLinks($page) {
	if(preg_match_all('/\[([^\]]+?)\]/', $page, $matches, PREG_SET_ORDER)) {
		foreach($matches as $match) {
			$page = str_replace($match[0], '<a href="' . $_SERVER['SCRIPT_NAME'] . '?page=' . urlencode($match[1]) . '">' . htmlentities($match[1]) . '</a>', $page);
		}
	}
}
?>