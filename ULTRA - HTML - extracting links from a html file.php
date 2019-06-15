<?php 
/*

!!EXTRACTING LINKS FROM AN HTML FILE!!

> need to extract the URLs that are specified inside an HTML document

> Use Tidy to convert the document to XHTML, then use an XPath query to find all the links

*tidy_repair_string - repair a string using an optionally provided configuration file
*preg_match_all - perform a global regular expression match

*/


/*Extracting links with Tidy and XPath*/
$html=<<<_HTML_
<p>Some things I enjoy eating are:</p>
<ul>
<li><a href="http://en.wikipedia.org/wiki/Pickle">Pickles</a></li>
<li><a href="http://www.eatingintranslation.com/2011/03/great_ny_noodle.html">
Salt-Baked Scallops</a></li>
<li><a href="http://www.thestoryofchocolate.com/">Chocolate</a></li>
</ul>
_HTML_;

$doc = new DOMDocument();
$opts = array(
	'output-xhtml'	  =>	true,
	// Prevent DOMDocument from being confused about entities
	'numeric-entities'  =>	true
);
$doc->loadXML(tidy_repair_string($html, $opts));
$xpath = new DOMXPath($doc);
// Tell $xpath about the XHTML namespace
$xpath->registerNamespace('xhtml','http://www.w3.org/1999/xhtml');

foreach($xpath->query('//xhtml:a/@href') as $node) {
	$link = $node->nodeValue;
	print $link . "\n";
}



/*If Tidy isn’t available, use the pc_link_extractor()*/
$html=<<<_HTML_
<p>Some things I enjoy eating are:</p>
<ul>
<li><a href="http://en.wikipedia.org/wiki/Pickle">Pickles</a></li>
<li><a href="http://www.eatingintranslation.com/2011/03/great_ny_noodle.html">
Salt-Baked Scallops</a></li>
<li><a href="http://www.thestoryofchocolate.com/">Chocolate</a></li>
</ul>
_HTML_;

$links = pc_link_extractor($html);

foreach($links as $link) {
	print $link[0] . "\n";
}


function pc_link_extractor($html) {
	$links = array();
	preg_match_all('/<a\s+.*?href=[\"\']?([^\"\' >]*)[\"\']?[^>]*>(.*?)<\/a>/i', $html,$matches, PREG_SET_ORDER);
	
	foreach($matches as $mathc) {
		$links[] = array($match[1], $match[2]);
	}
	return $links;
}



/*Extracting links and anchors with Tidy and XPath*/
$html=<<<_HTML_
<p>Some things I enjoy eating are:</p>
<ul>
<li><a href="http://en.wikipedia.org/wiki/Pickle">Pickles</a></li>
<li><a href="http://www.eatingintranslation.com/2011/03/great_ny_noodle.html">
Salt-Baked Scallops</a></li>
<li><a href="http://www.thestoryofchocolate.com/">Chocolate</a></li>
</ul>
_HTML_;

$doc = new DOMDocument();
$opts = array(
	'output-xhtml'		=>	true,
	'wrap'				=>	0,
	// Prevent DOMDocument from being confused about entities
	'numeric-entities'	=>	true
);

$doc->loadXML(tidy_repair_string($html, $opts));
$xpath = new DOMXPath($doc);
// Tell $xpath about the XHTML namespace
$path->registerNamespace('xhtml', 'http://www.w3.org/1999/xhtml');

foreach($xpath->query('//xhtml:a') as $node) {
	$anchor = trim($node->textContent);
	$link = $node->getAttribute('href');
	print "$anchor -> $link\n";
}

/*XPath query finds all the <a/> element nodes*/

?>