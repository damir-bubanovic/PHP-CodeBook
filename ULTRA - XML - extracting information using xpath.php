<?php 
/*

!!XML - EXTRACTING INFORMATION USING XPATH!!

> want to make sophisticated queries of your XML data without parsing the document node by node

*/


/*Use XPath*/
/*XPath is available in SimpleXML*/
$s = simplexml_load_file(__DIR__ . '/address-book.xml');

$emails = $s->xpath('/address-book/person/email');

foreach($emails as $email) {
	// do something with $email
}



/*And in DOM*/
$dom = new DOMDocument;
$dom->load(__DIR__ . '/address-book.xml');

$xpath = new DOMXPath($dom);

$emails = $xpath->query('/address-book/person/email');

foreach($emails as $email) {
	// do something with $email
}



/*DOM supports XPath queries, but you do not perform the query directly on the DOM object itself. Instead, you create a DOMXPath object*/
$dom = new DOMDocument;
$dom->load(__DIR__ . '/address-book.xml');

$xpath = new DOMXPath($dom);

$emails = $xpath->query('/address-book/person/email');



/*Instantiate DOMXPath by passing in a DOMDocument to the constructor. To execute the XPath query, call query() 
with the query text as your argument. This returns an iterable DOM node list of matching nodes*/
$dom = new DOMDocument;
$dom->load(__DIR__ . '/address-book.xml');

$xpath = new DOMXPath($dom);

$emails = $xpath->query('/address-book/person/email');

foreach ($emails as $e) {
	$email = $e->firstChild->nodeValue;
	// do something with $email
}



/*By default, DOMXPath::query() operates on the entire XML document. Search a 
subsection of the tree by passing in the subtree as a final parameter to query().*/
$dom = new DOMDocument;
$dom->load(__DIR__ . '/address-book.xml');

$xpath = new DOMXPath($dom);

$people = $xpath->query('/address-book/person');

foreach ($people as $p) {
	$fn = $xpath->query('firstname', $p);
	$firstname = $fn->item(0)->firstChild->nodeValue;
	$ln = $xpath->query('lastname', $p);
	$lastname = $ln->item(0)->firstChild->nodeValue;
	print "$firstname $lastname\n";
}



/*In contrast to DOM, all SimpleXML objects have an integrated xpath() method.*/
/*The method’s one argument is your XPath query*/
/*Here’s how to find all the matching email addresses in the sample address book*/
$s = simplexml_load_file(__DIR__ . '/address-book.xml');

$emails = $s->xpath('/address-book/person/email');

foreach ($emails as $email) {
	// do something with $email
}



/*SimpleXML handles the more complicated example, too. Because xpath() returns SimpleXML objects, you can query them directly*/
$s = simplexml_load_file(__DIR__ . '/address-book.xml');

$people = $s->xpath('/address-book/person');

foreach($people as $p) {
	list($firstname) = $p->xpath('firstname');
	list($lastname) = $p->xpath('lastname');
	print "$firstname $lastname\n";
}

?>