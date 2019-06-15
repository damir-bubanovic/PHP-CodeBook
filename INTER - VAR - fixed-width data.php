<?php
/*

!!FIXED WIDTH DATA!!

*pack - pack data into binary string
*fopen - opens file or URL
*fgets - gets line from file pointer
*substr - return part of a string
*array_map - applies the callback FUNCTION to the elements of the given arrays
*fclose - closes an open file pointer

*/

/*CREATE FIXED WIDTH DATA*/
/*Data array*/
$books = array( 
	array('Elmer Gantry', 'Sinclair Lewis', 1927),
	array('The Scarlatti Inheritance','Robert Ludlum', 1971),
	array('The Parsifal Mosaic','William Styron', 1979) 
	);

/*Loop through each data and print*/
foreach ($books as $book) {
	/*pack - format data as... (code language, HEX, NULL...)*/
	print pack('A25A15A4', $book[0], $book[1], $book[2]) . "\n";
}


/*PARSE FIXED WIDTH DATA*/
/*Open file, 'r' - read only*/
$fp = fopen('fixed-width-records.txt','r',true) or die ("can't open file");

/*fgets - gets line from file with length 1024*/
while ($s = fgets($fp, 1024)) {
	/*substr - return string with start and end*/
	$fields[1] = substr($s,0,25); // first field: first 25 characters of the line
	$fields[2] = substr($s,25,15); // second field: next 15 characters of the line
	$fields[3] = substr($s,40,4); // third field: next 4 characters of the line
	/*array_map - run each element of the array*/
	$fields = array_map('rtrim', $fields); // strip the trailing whitespace

	// a function to do something with the fields
	process_fields($fields);
}

/*Close file*/
fclose($fp) or die("can't close file");

?>