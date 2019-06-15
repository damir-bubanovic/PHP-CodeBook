<?php 
/*Koristimo query method call i pohranjujemo return info u varijablu $result*/
$mydb = new mysqli('localhost', 'petermac', '1q2w3e4r', 'website');
$sql = "SELECT * FROM Guests ORDER BY lname, fname";
$result = $mydb->query($sql);
/*sa fetch_assoc pružamo jedan po jedan red podataka i pohranjujemo u var $row */
while( $row = $result->fetch_assoc() ){
	echo $row['fname'] . " " . $row['lname'] ;
	/*Dumpaš content u browser*/
	echo " made these comments: " . substr($row['comments'],0,150) ;
	echo "<br/>";
}
/*Zatvaramo result i database objects*/
$result->close();
$mydb->close ();
?>