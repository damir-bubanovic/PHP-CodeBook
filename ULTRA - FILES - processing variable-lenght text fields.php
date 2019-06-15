<?php 
/*

!!FILES - PROCESSING VARIABLE-LENGTH TEXT FIELDS!!

> You want to read delimited text fields from a file. 
	>> npr. you might have a database program that prints records one per line, 
	with tabs between each field in the record, and you want to parse this data 
	into an array

*fopen - opens file or URL
*feof - tests for end-of-file on a file pointer
*fgetcsv - gets line from file pointer and parse for CSV fields
*fclose - closes an open file pointer
*list - assign variables as if they were an array
*ini_set - sets the value of a configuration option

*/


/*Use fgetcsv() to read in each line and then split the fields based on their delimiter*/
$delim = '|';

$fh = fopen('books.txt', 'r') or die("Can't ope: $pgp_errormsg");
while(!feof($fh)) {
	$fields = fgetcsv($fh, 1000, $delim);
	
	// do something with the data...
	print_r($fields);
}

fclose($fh) or die("Can't close: $php_errormsg");



/*To parse the following data in books.txt...*/
?>

Elmer Gantry|Sinclair Lewis|1927
The Scarlatti Inheritance|Robert Ludlum|1971
The Parsifal Mosaic|Robert Ludlum|1982
Sophie's Choice|William Styron|1979

<?php 
/*...process each record as shown*/
$fh = fopen('books.txt', 'r') or die("Can't open: $php_errormsg");

while(!feof($fh)) {
	list($title, $author, $publication_year) = fgetcsv($fh, 1000, '|');
	// ... do something with the data ...
}
fclose($fh) or die("can't close: $php_errormsg");



/*If any of your records contain your delimiter, fgetcsv() can parse these properly if the
data is enclosed or escaped. By default, this is the double quote and backslash characters,
respectively. You can change this - Here, records are wrapped in single quotes and the 
single-quote character is escaped using an asterisk*/
$fh = fopen('books.txt', 'r') or die("can't open: $php_errormsg");

while(!feof($fh)) {
	list($title,$author,$publication_year) = fgetcsv($fh, 1000, '|', "'", '*');
	// ... do something with the data ...
}
fclose($fh) or die("can't close: $php_errormsg");



/*If lines are not properly detected, enable the auto_detect_line_endings configuration
option prior to opening the file*/
ini_set('auto_detect_line_endings', true);

$fh = fopen('books.txt', 'r') or die("can't open: $php_errormsg");
// rest of processing

?>