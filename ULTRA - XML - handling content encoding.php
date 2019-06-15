<?php 
/*

!!XML - HANDLING CONTENT ENCODING!!

> Problem - PHP XML extensions use UTF-8, but your data is in a different content encoding

> For simplicity, the XML extensions all exclusively use the UTF-8 character encoding

> The iconv function supports two special modifiers for the destination encoding: //TRANSLIT and //IGNORE. 
	>> The first option tells iconv that whenever it cannot exactly duplicate a character in the destination encoding, 
	it should try to approximate it using a series of other characters. 
	>> The other option makes iconv silently ignore any unconvertible characters

*/


/*Use the iconv library to convert data before passing it into an XML extension:*/
$utf_8 = iconv('ISO-8859-1', 'UTF-8', $iso_8859_1);

/*Then convert the data back when you are finished:*/
$iso_8859_1 = iconv('UTF-8', 'ISO-8859-1', $utf_8);


/*use the iconv extension to manually encode data back and forth between your character sets and UTF-8. 
npr. to convert from ISO-8859-1 to UTF-8*/
$utf_8 = iconv('ISO-8859-1', 'UTF-8', $iso_8859_1);


/*For example, the string $geb holds the text Gödel, Escher, Bach. A straight conversion to ASCII produces an error*/
echo iconv('UTF-8', 'ASCII', $geb);
PHP Notice: iconv(): Detected an illegal character in input string...

/*Enabling the //IGNORE feature allows the conversion to occur:*/
echo iconv('UTF-8', 'ASCII//IGNORE', $geb);

/*However, the output isn’t nice, because the ö is missing:*/
Gdel, Escher, Bach

/*The best solution is to use //TRANSLIT:*/
echo iconv('UTF-8', 'ASCII//TRANSLIT', $geb);

/*This produces a better-looking string:*/
Godel, Escher, Bach

/*However, be careful when you use //TRANSLIT, because it can increase the number of
characters. For example, the single character ö becomes two characters: " and o*/

?>