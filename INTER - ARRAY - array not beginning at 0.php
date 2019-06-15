<?php 
/*

!!ARRAY NOT BEGINNING AT 0!!

> assign multiple elements to an array in one step, but you don’t want the first index to be 0

*/


$cats = array(4 => 'Tabitha', 'Micika', 'Ljubica');
// var_dump($cats);

$presidents = array(1 => 'Washington', 'Adams', 'Jefferson', 'Madison');

$reconstruction_presidents = array(16 => 'Lincoln', 'Johnson', 'Grant');

$us_leaders = array(-1 => 'George II', 'George III', 'Washington');

$presidents = array(1 => 'Washington', 'Adams', 'Honest' => 'Lincoln', 'Jefferson');


/*Jednostavnije je napraviti sljedeće*/
foreach ($presidents as $number => $president) {
	print "$number: $president\n";
}
/*Umjesto*/
foreach ($presidents as $number => $president) {
	$number++;
	print "$number: $president\n";
}
?>