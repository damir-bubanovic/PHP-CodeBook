	<!--LOOK UP _BASIC - strip whitespace.php-->

<?php 
// turn some HTML with non-breaking spaces into a "normal" string 
/*
array_flip - Exchanges all keys with their associated values in an array
get_html_translation_table - Returns the translation table used by htmlspecialchars() and htmlentities()
HTML_ENTITIES - Convert all applicable characters to HTML entities
ENT_QUOTES - Convert both double and single quotes
*/

$myHTML = "&nbsp;abc"; 
$converted = strtr($myHTML, array_flip(get_html_translation_table(HTML_ENTITIES, ENT_QUOTES))); 

// UTF encodes it as chr(0xC2).chr(0xA0) 
$converted = trim($converted,chr(0xC2).chr(0xA0)); // works!
?>