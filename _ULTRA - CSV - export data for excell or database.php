	<!--LOOK UP - _INTER(M) - import data from excell or database.php, print data for browser.php-->

<?php 
/*Formatiraj data kao comma-separated values (CSV) tako da ga može importati kao spreadsheet ili database*/

/*$sales array filled with data arrays*/
$sales = array( 
	array('Northeast','2005-01-01','2005-02-01',12.54),
	array('Northwest','2005-01-01','2005-02-01',546.33),
	array('Southeast','2005-01-01','2005-02-01',93.26),
	array('Southwest','2005-01-01','2005-02-01',945.21),
	array('All Regions','--','--',1597.34) 
	);

/*Filename of the spreadsheet npr. excell*/	
$filename = './sales.csv';
/*fopen - open file or url in our case file 'w' - write only*/
$fh = fopen($filename,'w') or die("Can't open $filename");

/*Loop through entire sales array and write data in file*/
foreach ($sales as $sales_line) {
	/*fputcsv - write line by line with \n (newline) at end*/
	if (fputcsv($fh, $sales_line) === false) {
		die("Can't write CSV line");
	}
}
/*fclose - close file or url*/
fclose($fh) or die("Can't close $filename");
?>