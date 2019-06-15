<?php 
/*

!!XML - PARSING BASIC XML DOCUMENTS!!

> want to parse a basic XML document that follows a known schema, and you don’t need 
access to more esoteric XML features, such as processing instructions

> Use the SimpleXML extension
	>> When you want to read a configuration file written in XML, parse an RSS feed, or process the 
	result of a REST request, SimpleXML excels at these tasks. 
	>> It doesn’t work well for more complex XML-related jobs, such as reading a document where you 
	don’t know the format ahead of time or when you need to access processing instructions or comments

*simplexml_load_file - interprets an XML file into an object

*/


$sx = simplexml_load_file(__DIR__ . '/address-book.xml');

foreach($sx->person as $person) {
	$firstname_text_value = $person->firstname;
	$lastname_text_value = $person->lastname;
	print "$firstname_text_value $lastname_text_value\n";
}


/*To access a single value, reference it directly using object method notation*/
<firstname>David</firstname>

/*If you have this in a SimpleXML object, $firstname, here’s all you need to do to access David:*/
$firstname


/*Attributes are stored as array elements. For example, this prints out the id attribute for the first person element*/
$ab = simplexml_load_file(__DIR__ . '/address-book.xml');

// the id attribute of the first person
print $ab->person['id'] . "\n";


/*complete example based on this simple address book in XML*/
?>

<?xml version="1.0"?>
    <address-book>
    <person id="1">
        <!--David Sklar-->
        <firstname>David</firstname>
        <lastname>Sklar</lastname>
        <city>New York</city>
        <state>NY</state>
        <email>sklar@php.net</email>
    </person>
    <person id="2">
        <!--Adam Trachtenberg-->
        <firstname>Adam</firstname>
        <lastname>Trachtenberg</lastname>
        <city>San Francisco</city>
        <state>CA</state>
        <email>amt@php.net</email>
    </person>
</address-book>

<?php 
/*Use SimpleXML to pull out all the first and last names*/
$sx = simplexml_load_file(__DIR__ . '/address-book.xml');

foreach ($sx->person as $person) {
	$firstname_text_value = $person->firstname;
	$lastname_text_value = $person->lastname;
	print "$firstname_text_value $lastname_text_value\n";
}


/*When you use SimpleXML, you can directly iterate over elements using foreach. 
Here, the iteration occurs over $sx->person, which holds all the person nodes*/


/*directly print SimpleXML objects*/
foreach ($sx->person as $person) {
	print "$person->firstname $person->lastname\n";
}

?>