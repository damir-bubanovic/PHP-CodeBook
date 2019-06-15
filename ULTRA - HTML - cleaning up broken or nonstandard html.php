<?php 
/*

!!CLEANING UP BROKEN OR NONSTANDARD HTML!!

> You’ve got some HTML with malformed syntax that you’d like to clean up. This makes
it easier to parse and ensures that the pages you produce are standards compliant

> Use PHP’s Tidy extension. It relies on the popular, powerful, HTML Tidy library to turn
frightening piles of tag soup into well-formed, standards-compliant HTML or XHTML

*tidy_repair_file - repair a file using an optionally provided configuration file
*tidy_repair_string - repair a string using an optionally provided configuration file
*file_put_contents - this function is identical to calling fopen(), fwrite() and fclose() successively to write data to a file
*preg_replace - perform a regular expression search and replace


*/


/*Repairing an HTML file with Tidy*/
$fixed = tidy_repair_file('bad.html');
file_put_contents('good.html', $fixed);


/*Tidy has a large number of configuration options that affect the output it produces. 
Pass configuration to tidy_repair_file() by providing a second argument that is an array
of configuration options and values*/
/*Production of XHTML with Tidy*/
$config = array('output-xhtml' => true);
$fixed = tidy_repair_file('bad.html', $config);
file_put_contents('good.xhtml', $fixed);


/*After the HTML has been converted to a well-formed XHTML document, it can be systematically 
processed and converted by PHP’s DOM functions*/
/*Marking up a web page with Tidy and DOM*/
$body = '
	<p>I like pickles and herring.</p>
	<a href="pickle.php"><img src="pickle.jpg"/>A pickle picture</a>
	I have a herringbone-patterned toaster cozy.
	<herring>Herring is not a real HTML element!</herring>
';

$words = array('pickle','herring');
$patterns = array();
$replacements = array();

foreach($words as $key => $word) {
	$patters[] = '/' . preg_quote($word) . '/i'; // mozda ovdje ide key umjesto i
	$replacements[] = "<span class='word-$i'>$word</span>";
}

/* Tell Tidy to produce XHTML */
$xhtml = tidy_repair_string($body, array('output-xhtml' => true));

/* Load the XHTML as an XML document */
$doc = new DOMDocument;
$doc->loadXml($xhtml);

/*When turning our input HTML into a proper XHTML document, Tidy puts 
the input HTML inside the <body/> element of the XHTML document*/
$body = $doc->getElementsByTagName('body')->item(0);


/* Visit all text nodes and mark up words if necessary */
$xpath = new DOMXpath($doc);

foreach($xpath->query("descendant-or-self::text()", $body) as $textNode) {
	$replaced = preg_replace($patterns, $replacements, $textNode->wholeText);
	
	if($replaced != $textNode->wholeText) {
		$fragment = $textNode->ownerDocument->createDocumentFragment();
		
		/* This makes sure that the <span/> sub-nodes are created properly */
		$fragment->appendXml($replaced);
		$textNode->parentNode->replaceChild($fragment, $textNode);
	}
}

/* Build the XHTML consisting of the content of everything under <body/> */
$markedup = '';

foreach($body->childNodes as $node) {
	$markedup .= $doc->saveXml($node);
}

print $markedup;

/*The downside of this approach is that, depending on how broken your 
input HTML is, the results of Tidy’s conversion may not be what you expect*/

?>