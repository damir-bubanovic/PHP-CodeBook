<?php 
/*

!!XML - PARSING LARGE XML DOCUMENTS!!

> You want to parse a large XML document. 
	>> This document is so large that it’s impractical to use SimpleXML or DOM because you cannot hold the entire document in memory.
	>> Instead, you must load the document in one section at a time
	
> There are two major types of XML parsers:
	1) ones that hold the entire document in memory at once (tree-based parsers - SimpleXML and DOM extensions)
	2) ones that hold only a small portion of the document in memory at any given time (stream-based parser - XMLReader extension)
		>> Stream-based parsers don’t store the entire document in memory; instead, they read in one node at a 
		time and allow you to interact with it in real time. Once you move onto the next node, the old one is 
		thrown away—unless you explicitly store it yourself for later use

> Most of the time, you’ll use the XMLReader::open() method to pull in data from an external source, 
but you can also load it from an existing PHP variable with XMLReader::XML()

*/


/*Use the XMLReader extension*/
$reader = new XMLReader();
$reader->open(__DIR__ . '/card-catalog.xml');

/* Loop through document */
while($reader->read()) {
	/* If you're at an element named 'author' */
	if($reader->nodeType == XMLREADER::ELEMENT && $reader->localName == 'author') {
		/* Move to the text node and print it out */
		$reader->read();
		print $reader->value . "\n";
	}
}



/*Begin by creating a new instance of the XMLReader class and specifying the location of your XML data*/
// Create a new XMLReader object
$reader = new XMLReader();

// Load from a file or URL
$reader->open('document.xml');

// Or, load from a PHP variable
$reader->XML($document);



/*two navigation methods XMLReader provides: XMLReader::read() and XMLReader::next(). 
	- The first method reads in the piece of XML data that immediately follows the current position. 
	- The second method moves to the next sibling element after the current position*/
	
/* Loop through document */
while ($reader->read()) {
	/* Process XML */
}

/* Loop through document */
while ($reader->read()) {
	/* If you're at an element named 'author' */
	if($reader->nodeType == XMLREADER::ELEMENT && $reader->localName == 'author') {
		/* Process author element */
	}
}

?>

XMLReader node-type values
Node-type 	Description
XMLReader::NONE 					No node type
XMLReader::ELEMENT 					Start element
XMLReader::ATTRIBUTE 				Attribute node
XMLReader::TEXT 					Text node
XMLReader::CDATA 					CDATA node
XMLReader::ENTITY_REF 				Entity Reference node
XMLReader::ENTITY 					Entity Declaration node
XMLReader::PI 						Processing Instruction node
XMLReader::COMMENT 					Comment node
XMLReader::DOC 						Document node
XMLReader::DOC_TYPE 				Document Type node
XMLReader::DOC_FRAGMENT 			Document Fragment node
XMLReader::NOTATION 				Notation node
XMLReader::WHITESPACE 				Whitespace node
XMLReader::SIGNIFICANT_WHITESPACE 	Significant Whitespace node
XMLReader::END_ELEMENT 				End Element
XMLReader::END_ENTITY 				End Entity
XMLReader::XML_DECLARATION 			XML Declaration node

<?php 
/*EXAMPLE - we can print out all the author names in the card catalog*/

$reader = new XMLReader();
$reader->open(__DIR__ . '/card-catalog.xml');

/* Loop through document */
while($reader->read()) {
	/* If you're at an element named 'author' */
	if($reader->noteType == XMLREADER::ELEMENT && $reader->localName == 'author') {
		/* Move to the text node and print it out */
		$reader->read();
		print $reader->value . "\n";
	}
}

/*Once you’ve reached the <author> element, call $reader->read() to advance to the
text inside it. From there, you can find the author names inside of $reader->value*/


/*XMLReader object properties, including value*/
?>

XMLReader node-type values
Name 				Type 		Description
attributeCount 		int 		Number of node attributes
baseURI 			string 		Base URI of the node
depth 				int 		Tree depth of the node, starting at 0
hasAttributes 		bool 		If the node has attributes
hasValue 			bool 		If the node has a text value
isDefault 			bool 		If the attribute value is defaulted from DTD
isEmptyElement 		bool 		If the node is an empty element tag
localName 			string 		Local name of the node
name 				string 		Qualified name of the node
namespaceURI 		string 		URI of the namespace associated with the node
nodeType 			int 		Node type of the node
prefix 				string 		Namespace prefix associated with the node
value 				string 		Text value of the node
xmlLang 			string 		xml:lang scope of the node

<?php 
/*The moveToAttribute() method lets you specify an attribute name*/
/*code using the card catalog XML to print out all the ISBN numbers*/
$reader = new XMLReader();
$reader->XML($catalog);

/* Loop through document */
while ($reader->read()) {
	/* If you're at an element named 'book' */
	if ($reader->nodeType == XMLREADER::ELEMENT && $reader->localName == 'book') {
		$reader->moveToAttribute('isbn');
		print $reader->value . "\n";
	}
}



/*code combines pieces of the examples to print out all the data for Perl Cookbook in an efficient fashion*/
$reader = new XMLReader();
$reader->XML($catalog);

// Perl Cookbook ISBN is 0596003137
// Use array to make it easy to add additional ISBNs
$isbns = array('0596003137' => true);

/* Loop through document to find first <book> */
while($reader->read()) {
	/* If you're at an element named 'book' */
	if($reader->noteType == XMLREADER::ELEMENT && $reader->localName == 'book') {
		break;
	}
}

/* Loop through <book>s to find right ISBNs */
do {
	
	if($reader->moveToAttribute('isbn') && isset($isbns[$reader->value])) {
		
		while($reader->read()) {
			
			switch($reader->noteType) {
				case XMLREADER::ELEMENT:
					print $reader->localName . ": ";
				case XMLREADER::TEXT:
					print $reader->value . "\n";
				case XMLREADER::END_ELEMENT:
					
					if($reader->localName == 'book') {
						break 2;
					}
			}
		}
	}
} while($reader->next());


/*
EXPLANATION:
- The first while() iterates sequentially until it finds the first <book> element
- Having lined yourself up correctly, you then break out of the loop and start checking ISBN numbers. 
That’s handled inside a do… while() loop that uses $reader->next() to move down the <book> list
- If the ISBN matches a value in $isbns, then you want to process the data inside the current <book>. 
This is handled using yet another while() and a switch().
- There are three different switch() cases: an opening element, element text, and a closing
element. If you’re opening an element, you print out the element’s name and a colon. If
you’re visiting text, you print out the textual data. And if you’re closing an element, you
check to see whether you’re closing the <book>. If so, then you’ve reached the end of the
data for that particular book, and you need to return to the do… while() loop. This is
handled using a break 2;—while jumps back two levels, instead of the usual one level.
*/
?>