<?php 
/*

!!PREVENTING CROSS-SITE SCRIPTING!!

> want to securely display user-entered data on an HTML page. 
	> npr. you want to allow users to add comments to a blog post without worrying that HTML or JavaScript in a comment will cause problems

*htmlspecialchars - convert all applicable characters to HTML entities
	> escapes four characters: < > " and &.
*htmlentities - convert all applicable characters to HTML entities
	> encodes any character that has an HTML entity

*/


/*Pass user input through htmlentities() before displaying it*/
/*Escaping HTML*/
print 'The comment was: ';
print htmlentities($_POST['comment']);


/*Escaping HTML entities*/
$html = "<a href='fletch.html'>Stew's favorite movie.</a>\n";
print htmlspecialchars($html); // double-quotes
print htmlspecialchars($html, ENT_QUOTES); // single- and double-quotes
print htmlspecialchars($html, ENT_NOQUOTES); // neither
/*
prints:
<a href='fletch.html'>Stew's favorite movie.</a>
<a href='fletch.html'>Stew's favorite movie.</a>
<a href='fletch.html'>Stew's favorite movie.</a>
*/

?>