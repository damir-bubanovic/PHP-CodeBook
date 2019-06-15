	<!--LOOK UP - _INTER(M) - export data for excell or database.php, import data from excell or database.php-->

<?php 
/*Formatiraj data kao comma-separated values (CSV) tako da ga može printati*/

/*$sales array filled with data arrays*/
$sales = array( 
	array('Northeast','2005-01-01','2005-02-01',12.54),
	array('Northwest','2005-01-01','2005-02-01',546.33),
	array('Southeast','2005-01-01','2005-02-01',93.26),
	array('Southwest','2005-01-01','2005-02-01',945.21),
	array('All Regions','--','--',1597.34) 
	);

/*fopen - open url in our case file 'w' - write only*/
$fh = fopen('php://output','w');
/*Loop through entire sales array and print data*/
foreach ($sales as $sales_line) {
	/*fputcsv - print line by line to browser with \n (newline) at end*/
	if (fputcsv($fh, $sales_line) === false) {
		die("Can't write CSV line");
	}
}
/*fclose - close URL*/
fclose($fh);
?>