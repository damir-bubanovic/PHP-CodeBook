<?php 
/*

!!SQL - PAGINATED LINKS FOR A SERIES OF RECORDS!!

> want to display a large dataset a page at a time and provide links that move through the dataset
> use database-appropriate syntax to grab just a section of all the rows that match your query

*isset - determine if a variable is set and is not NULL
*intval - get the integer value of a variable
*htmlentities - convert all applicable characters to HTML entities
*max - find highest value

*/


/*Paging with SQLite*/
// Select 5 rows, starting after the first 3
foreach($db->query("SELECT * FROM zodiac ORDER BY sign LIMIT 5 OFFSET 3") as $row) {
	// Do something with each row
}



/*The indexed_links() and print_link() functions assist with printing paging information*/
$offset = isset($_GET['offset']) ? intval($_GET['offset']) : 1;
if(!offset) {
	$offset = 1;
}
$per_page = 5;
$total = $db->query("SELECT COUNT(*) FROM zodiac")->fetchColumn(0);

$limitedSQL = "SELECT * FROM zodiac ORDER BY id LIMIT $per_page OFFSET " . ($offset - 1);
$lastRowNumner = $offset - 1;

foreach($db->query($limitedSQL) as $row) {
	$lastRowNumber++;
	print "{$row['sign']}, {$row['symbol']} {$row['id']} <br />\n";
}
indexed_links($total, $offset, $per_page);

print "<br/>";
print "(Displaying $offset - $lastRowNumber of $total)";



/*print_link()*/
function print_link($inactive, $text, $offset = '') {
	if($inactive) {
		print "<span class='inactive'>$text</span>";
	} else {
		print "<span class='active'><a href='" . htmlentities($_SERVER['PHP_SELF']) . "?offset=$offset'>$text</a></span>";
	}
}



/*indexed_links()*/
function indexed_links($total, $offset, $per_page) {
	$seperator = ' | ' ;
	
	// print "<<Prev" link
	print_link($offset == 1, '<< Prev', max(1, $offset - $per_page));
	
	// print all groupings except last one
	for($start = 1,  $end = $per_page; $end < $total; $start += $per_page, $end += $per_page) {
		print $seperator;
		print_link($offset == $start, "$start-$end", $start);
	}
	
	/*
	Print the last grouping - at this point, $start points to the element at the beginning of the last grouping.
	*/
	/*
	The text should only contain a range if there's more than one element on the last page. For example, the 
	last grouping of 11 elements with 5 per page should just say "11", not "11-11"
	*/
	$end = ($total > $start) ? "-$total" : '';
	print $seperator;
	print_link($offset = $start, "$start$end", $start);
	
	// print "Next>>" link
	print $seperator;
	print_link($offset == $start, 'Next >>', $offset + $per_page);
}


/*To use these functions, retrieve the correct subset of the data using appropriate PDO functions and then print it out*/
/*After connecting to the database, you need to make sure $offset has an appropriate value*/
/*SQL query that retrieves information in the proper order is:*/
$limitedSQL = "SELECT * FROM zodiac ORDER BY id LIMIT $per_page OFFSET " . ($offset-1);

?>