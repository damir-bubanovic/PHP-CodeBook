<?php 
/*

!!MARKING UP A WEB PAGE!!

> want to display a web page—for example, a search result—with certain words highlighted

> Build an array replacement for each word you want to highlight. Then, chop up the page into “HTML elements” 
and “text between HTML elements” and apply the replacements to just the text between HTML elements

*preg_split - split string by a regular expression
*isset - determine if a variable is set and is not NULL
*continue - is used within looping structures to skip the rest of the current loop iteration 
and continue execution at the condition evaluation and then the beginning of the next iteration
*str_replace - replace all occurrences of the search string with the replacement string
*implode - join array elements with a string
*preg_quote - quote regular expression characters

*/


/*Marking up a web page*/
$body = '
	<p>I like pickles and herring.</p>
	<a href="pickle.php"><img src="pickle.jpg"/>A pickle picture</>
	I have a herringbone-pattern toaster cozy.
	<herring>Herring is not a real HTML element!</herring>
';

$words = array('pickle', 'herring');
$replacements = array();

foreach($words as $key => $word) {
	$replacements[] = "<span class='word-$i'>$word</span>";
}

/*Split up the page into chunks delimited by a reasonable approximation of what an HTML element looks like.*/
// Unlimited number of chunks
$parts = preg_split("{(<(?:\"[^\"]*\"|'[^']*'|[^'\">])*>)}", $body, -1, PREG_SPLIT_DELIM_CAPTURE);

foreach($parts as $key => $part) {
	// Skip if this part is an HTML element
	if(isset($part[0]) && ($part[0] == '<')) {
		continue;
	}
	$parts[$key] = str_replace($words, $replacements, $part);
}

/*Reconstruct the body*/
$body = implode('', $parts);
print $body;



/*Marking up a web page with regular expressions*/
$body = '
	<p>I like pickles and herring.</p>
	<a href="pickle.php"><img src="pickle.jpg"/>A pickle picture</a>
	I have a herringbone-patterned toaster cozy.
	<herring>Herring is not a real HTML element!</herring>
';

$words = array('pickle', 'herring');
$patterns = array();
$replacements = array();

foreach ($words as $key => $word) {
	$patterns[] = '/' . preg_quote($word) . '/i';
	$replacements[] = "<span class='word-$i'>\\0</span>";
}

/*Split up the page into chunks delimited by a reasonable approximation of what an HTML element looks like.*/
// Unlimited number of chunks
$parts = preg_split("{(<(?:\"[^\"]*\"|'[^']*'|[^'\">])*>)}", $body, -1, PREG_SPLIT_DELIM_CAPTURE);

foreach ($parts as $key => $part) {
	// Skip if this part is an HTML element
	if(isset($part[0]) && ($part[0] == '<')) { 
		continue; 
	}
	// Wrap the words with <span/>s
	$parts[$key] = preg_replace($patterns, $replacements, $part);
}

// Reconstruct the body
$body = implode('', $parts);
print $body;

/*Switching to regular expressions makes it easy to prevent substring matching*/
?>