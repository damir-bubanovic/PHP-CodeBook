<?php 
/*

!!XML - GENERATING XML WITH DOM!!

> want to generate XML but want to do it in an organized way instead of using print and loops

> Use the DOM extension to create a DOMDocument object. 
	>> After building up the document, call DOMDocument::save() or DOMDocument::saveXML() to generate a well-formed XML document

*/


// create a new document
$dom = new DOMDocument('1.0');

// create the root element, <book>, and append it to the document
$book = $dom->appendChild($dom->createElement('book'));

// create the title element and append it to $book
$title = $book->appendChild($dom->createElement('title'));

// set the text and the cover attribute for $title
$title->appendChild($dom->createTextNode('PHP Cookbook'));
$title->setAttribute('edition', '3');

// create and append author elements to $book
$sklar = $book->appendChild($dom->createElement('author'));

// create and append the text for each element
$sklar->appendChild($dom->createTextNode('Sklar'));
$trachtenberg = $book->appendChild($dom->createElement('author'));
$trachtenberg->appendChild($dom->createTextNode('Trachtenberg'));

// print a nicely formatted version of the DOM document as XML
$dom->formatOutput = true;
print $dom->saveXML();
?>

<?xml version="1.0"?>
<book>
    <title edition="3">PHP Cookbook</title>
    <author>Sklar</author>
    <author>Trachtenberg</author>
</book>