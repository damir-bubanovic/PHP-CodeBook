<?php 
/*PDO - Represents a connection between PHP and a database server. , pogledaj database connection*/
$db = new PDO('sqlite:/usr/local/data/sales.db');
/*PDO::FETCH_NUM - PDO specific fetch method like mysqli_fetch_assoc in PHP*/
$query = $db->query('SELECT region, start, end, amount FROM sales', PDO::FETCH_NUM);
$sales_data = $db->fetchAll();

/* Open filehandle for fputcsv()*/
/*Open file*/
$output = fopen('php://output','w') or die("Can't open php://output");
$total = 0;

/*Tell browser to expect a CSV file*/
/*We are sending 2 headers to ensure browser handles CSV output properly*/
header('Content-Type: application/csv'); // tells browser output in not HTML, but CSV
header('Content-Disposition: attachment; filename="sales.csv"'); // tells browsrer not to display output but attempt to load external program

/*Print header row*/
fputcsv($output,array('Region','Start Date','End Date','Amount'));
/*Print each data row and increment $total*/
foreach ($sales_data as $sales_line) {
	fputcsv($output, $sales_line);
	$total += $sales_line[3];
}

/*Print total row and close file handle*/
fputcsv($output,array('All Regions','--','--',$total));
/*Close file*/
fclose($output) or die("Can't close php://output");




/*Dynamic CSV or HTML*/
/*format query string variable controls whether the results of an SQL SELECT query are returned as an HTML table or CSV*/
/*PDO - Represents a connection between PHP and a database server. , pogledaj database connection*/
$db = new PDO('sqlite:/usr/local/data/sales.db');
/*PDO::FETCH_NUM - PDO specific fetch method like mysqli_fetch_assoc in PHP*/
$query = $db->query('SELECT region, start, end, amount FROM sales', PDO::FETCH_NUM);
$sales_data = $db->fetchAll();
$total = 0;
$column_headers = array('Region','Start Date','End Date','Amount');

/*Decide what format to use*/
$format = $_GET['format'] == 'csv' ? 'csv' : 'html';

/*Print format-appropriate beginning*/
if ($format == 'csv') {
	/*We are sending 2 headers to ensure browser handles CSV output properly*/
	$output = fopen('php://output','w') or die("Can't open php://output");
	header('Content-Type: application/csv');
	header('Content-Disposition: attachment; filename="sales.csv"');
	fputcsv($output,$column_headers);
} else {
	echo '<table><tr><th>';
	echo implode('</th><th>', $column_headers);
	echo '</th></tr>';
}

foreach ($sales_data as $sales_line) {
/*Print format-appropriate line*/
	if ($format == 'csv') {
		fputcsv($output, $sales_line);
	} else {
		echo '<tr><td>' . implode('</td><td>', $sales_line) . '</td></tr>';
	}
	$total += $sales_line[3];
}
$total_line = array('All Regions','--','--',$total);

/*Print format-appropriate footer*/
if ($format == 'csv') {
	fputcsv($output,$total_line);
	fclose($output) or die("Can't close php://output");
} else {
	echo '<tr><td>' . implode('</td><td>', $total_line) . '</td></tr>';
	echo '</table>';
}
?>