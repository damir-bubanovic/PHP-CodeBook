<?php 
/*

!!EXTRACT PORTION OF STRING WITHOUT ACTUAL CHARACTERS YOU SEARCHED FOR!!

> To extract your portion of a string without the actual character you searched for, you can use

*substr - return part of a string
*strrchr - find the last occurrence of a character in a string

*/


$path = '/www/public_html/index.html';
$filename = substr(strrchr($path, "/"), 1);
print $filename; // "index.html"

?>