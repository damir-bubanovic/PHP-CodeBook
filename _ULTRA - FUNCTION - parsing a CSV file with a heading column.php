	<!--LOOK UP array_flip on PHP.net-->

<?php 
/*function is useful when parsing a CSV file with a heading column, but the columns might vary in order or presence*/
$f = fopen("file.csv", "r");

/* Take the first line (the header) into an array, then flip it
so that the keys are the column name, and values are the
column index. */
$cols = array_flip(fgetcsv($f));

while ($line = fgetcsv($f))
{
    // Now we can reference CSV columns like so:
    $status = $line[$cols['OrderStatus']];
}

?>