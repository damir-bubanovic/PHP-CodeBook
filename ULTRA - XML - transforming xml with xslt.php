<?php 
/*

!!XML - TRANSFORMING XML WITH XSLT!!

> You have an XML document and an XSL stylesheet. You want to transform the document using XSLT and capture the results. 
This lets you apply stylesheets to your data and create different versions of your content for different media

*/


/*Use PHP’s XSLT extension*/
// Load XSL template
$xsl = new DOMDocument;
$xsl->load(__DIR__ . '/stylesheet.xsl');

// Create new XSLTProcessor
$xslt = new XSLTProcessor();

// Load stylesheet
$xslt->importStylesheet($xsl);

// Load XML input file
$xml = new DOMDocument;
$xsl->load(__DIR__ . '/address-book.xml');

// Transform to string
$results = $xslt->transformToXML($xml);

// Transform to a file
$results = $xslt->transformToURI($xml, 'results.txt');

// Transform to DOM object
$results = $xslt->transformToDoc($xml);



/*XML documents describe the content of data, but they don’t contain any information
about how that data should be displayed. However, when XML content is coupled with
a stylesheet described using XSL (eXtensible Stylesheet Language), the content is displayed
according to specific visual rules*/

/*To begin, load in the stylesheet using DOM. Then, instantiate a new XSLTProcessor
object, and import the XSLT document by passing in your newly created DOM object
to the importStylesheet()*/
// Load XSL template
$xsl = new DOMDocument;
$xsl->load(__DIR__ . '/stylesheet.xsl');

// Create new XSLTProcessor
$xslt = new XSLTProcessor();

// Load stylesheet
$xslt->importStylesheet($xsl);

/*Now the transformer is up and running. You can transform any DOM object in one of
three ways—into a string, into a file, or back into another DOM object*/
// Load XML input file
$xml = new DOMDocument;
$xsl->load(__DIR__ . '/stylesheet.xsl');

// Transform to string
$results = $xslt->transformToXML($xml);

// Transform to a file
$results = $xslt->transformToURI($xml, 'results.txt');

// Transform to DOM object
$results = $xslt->transformToDoc($xml);

/*These methods return false when they fail, so to accurately check for failure, write*/
if (false === ($results = $xslt->transformToXML($xml))) {
	// an error occurred
}

?>