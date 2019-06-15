<?php 
/*

!!XML - PARSING COMPLEX XML DOCUMENTS!!

> You have a complex XML document, such as one where you need to introspect the document to determine its schema, 
or you need to use more esoteric XML features, such as processing instructions or comments

> Use the DOM extension. It provides a complete interface to all aspects of the XML specification

> The W3C’s DOM provides a platform- and language-neutral method that specifies the structure and content of a document. 
	>> Using DOM, you can read an XML document into a tree of nodes and then maneuver through the tree to locate information 
	about a particular element or elements that match your criteria. >> This is called tree-based parsing
	
> One of the major advantages of DOM is that by following the W3C’s specification, many languages implement DOM functions in a similar manner. 
Therefore, the work of translating logic and instructions from one application to another is considerably simplified

> DOM functions in PHP are object oriented. To move from one node to another, access properties such as $node->childNodes, which contains 
an array of node objects, and $node->parentNode, which contains the parent node object. 
	>> Therefore, to process a node, check its type and call a corresponding method

*/


// $node is the DOM parsed node <book cover="soft">PHP Cookbook</book>
$type = $node->nodeType;

switch($type) {
	case XML_ELEMENT_NODE:
		// I'm a tag. I have a tagname property.
		print $node->tagName; // prints the tagname property: "book"
		break;
	case XML_ATTRIBUTE_NODE:
		// I'm an attribute. I have a name and a value property.
		print $node->name; // prints the name property: "cover"
		print $node->value; // prints the value property: "soft"
		break;
	case XML_TEXT_NODE:
		// I'm a piece of text inside an element.
		// I have a name and a content property.
		print $node->nodeName; // prints the name property: "#text"
		print $node->nodeValue; // prints the text content: "PHP Cookbook"
		break;
	default:
		// another type
		break;
		
}

?>

book

<?php 
/*to process a node, check its type and call a corresponding method*/

// $node is the DOM parsed node <book cover="soft">PHP Cookbook</book>
$type = $node->nodeType;

switch($type) {
	case XML_ELEMENT_NODE:
		// I'm a tag. I have a tagname property.
		print $node->tagName; // prints the tagname property: "book"
		break; 
	case XML_ATTRIBUTE_NODE:
		// I'm an attribute. I have a name and a value property.
		print $node->name; // prints the name property: "cover"
		print $node->value; // prints the value property: "soft"
		break;
	case XML_TEXT_NODE:
		// I'm a piece of text inside an element.
		// I have a name and a content property.
		print $node->nodeName; // prints the name property: "#text"
		print $node->nodeValue; // prints the text content: "PHP Cookbook"
		break;
	default:
		// another type
		break;
} 


/*To automatically search through a DOM tree for specific elements, use getElements ByTagname(). 
Here’s how to do so with multiple book records*/
?>

<books>
    <book>
        <title>PHP Cookbook</title>
        <author>Sklar</author>
        <author>Trachtenberg</author>
        <subject>PHP</subject>
    </book>
    <book>
        <title>Perl Cookbook</title>
        <author>Christiansen</author>
        <author>Torkington</author>
        <subject>Perl</subject>
    </book>
</books>

<?php 
/*And to find all authors*/

// find and print all authors
$authors = $dom->getElementByTagname('author');

// loop through author elements
foreach($authors as $author) {
	// childNodes holds the author values
	$text_nodes = $author->childNodes;
	
	foreach($text_nodes as $text) {
		print $text->nodeValue . "\n";
	}
}


/*The getElementsByTagname() method returns an array of element node objects. By looping through each element’s children, 
you can get to the text node associated with that element. From there, you can pull out the node values, which in this case 
are the names of the book authors, such as Sklar and Trachtenberg*/
?>