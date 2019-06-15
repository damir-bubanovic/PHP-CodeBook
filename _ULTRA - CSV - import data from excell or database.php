	<!--LOOK UP - _INTER(M) - export data for excell or database.php, print data for browser.php-->

<?php 
/*Open file, 'r' - reading only*/
$fp = fopen($filename,'r') or die("can't open file");

print "<table>\n";
/*Gets lines from spreadsheets (from CSV fields)*/
/*if average line length is more than 8,192 bytes program runs faster if you specific line length (default - PHP decides)*/
while($csv_line = fgetcsv($fp)) {
	print '<tr>';
		/*Loop through each line in file*/
		for ($i = 0, $j = count($csv_line); $i < $j; $i++) {
			/*Convert all applicable characters to HTML entities for HTML table*/
			print '<td>' .htmlentities($csv_line[$i]). '</td>';
		}
	print "</tr>\n";
}
print "</table>\n";

/*Close file*/
fclose($fp) or die("can't close file");
?>