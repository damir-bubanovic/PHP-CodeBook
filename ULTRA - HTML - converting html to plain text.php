<?php 
/*

!!CONVERTING HTML TO PLAIN TEXT!!

> need to convert HTML to readable, formatted plain text

*file_get_contents - reads entire file into a string

*/


/*Converting HTML to plain text*/
require_once 'class.html2text.inc';
/* Give file_get_contents() the path or URL of the HTML you want to process */
$html = file_get_contents(__DIR__ . '/article.html');
$converter = new html2text($html);
$plain_text = $converter->get_text();

?>