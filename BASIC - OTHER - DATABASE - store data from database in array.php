<?php 
/*

!!STORE DATA FROM DATABASE IN ARRAY!!

*mysqli_fetch_assoc - pull arrays or objects directly from a database and place them into an array
	> array mysqli_fetch_assoc ( resource $result )
	> fetch a result row as an associative array, a numeric array, or both

*/


/*array of arrays*/
while ($row = mysqli_fetch_assoc($r)) {
	$fruits[] = $row;
}
/*array of objects*/
while ($obj = mysqli_fetch_object($s)) {
	$vegetables[] = $obj;
}

/*Fetching all the results to array with one liner*/
$result = mysqli_query($r); 
while(($resultArray[] = mysql_fetch_assoc($result)) || array_pop($resultArray)); 
?>