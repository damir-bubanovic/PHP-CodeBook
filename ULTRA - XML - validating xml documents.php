<?php 
/*

!!XML - VALIDATING XML DOCUMENTS!!

>want to make sure your XML document abides by a schema, such as XML Schema, Relax NG, and DTDs

*/


/*Use the DOM extension*/
$file = __DIR__ . '/address-book.xml';
$schema = __DIR__ . '/address-book.xsd';

$ab = new DOMDocument;
$ab->load($file);

if($ab->schemaValidate($schema)) {
	print "$file is valid.\n";
} else {
	print "$file is invalid.\n";
}


/*To validate a DOM object against a schema stored in a variable, 
call DOMDocument::schemaValidateSource() or DOMDocument::relaxNGValidateSource()*/
$file = __DIR__ . '/address-book.xml';

$ab = new DOMDocument;
$ab->load($file);

$schema = file_get_contents(__DIR__ . '/address-book.xsd');

if($ab->schemaValidateSource($schema)) {
	print "XML is valid.\n";
} else {
	print "XML is invalid.\n";
}


/*Validating any file using DOM is a similar process, regardless of the underlying schema format. 
To validate, call a validation method on a DOM object. For example*/
$file = __DIR__ . '/address-book.xml';
$schema = __DIR__ . '/address-book.xsd';

$ab = new DOMDocument;
$ab->load($file);

if($ab->schemaValidate($schema)) {
	print "$file is valid.\n";
} else {
	print "$file is invalid.\n";
}

?>

DOM schema validation methods
Method name 			Schema type 		Data location
schemaValidate 			XML Schema 			File
schemaValidateSource 	XML Schema 			String
relaxNGValidate 		Relax NG 			File
relaxNGValidateSource 	Relax NG 			String
validate 				DTD 				N/A