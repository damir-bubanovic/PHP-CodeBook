<?php 
/*

!!GENERATE RANDOM NUMBERS!!

USAGE:
> display a random image on a page, randomize the starting position of a game, select a 
random record from a database, generate a unique session identifier

> ALERT < 
	Instead rand() use mt_rand() because it is less predictable and faster

*/


$lower = 65;
$upper = 97;
// random number between $upper and $lower, inclusive
$random_number = mt_rand($lower, $upper);



/*GENERATE PREDICTABLE RANDOM NUMBERS*/
/*generate predictable random numbers so you can guarantee repeatable behavior*/
function pick_color() {
	$colors = array('red','orange','yellow','blue','green','indigo','violet');
	$i = mt_rand(0, count($colors) - 1);
	return $colors[$i];
}
/*generate 2 colors*/
mt_srand(34534);
$first = pick_color();
$second = pick_color();

// Because a specific value was passed to mt_srand(), we can be
// sure the same colors will get picked each time: red and yellow
print "$first is red and $second is yellow.";



/*GENERATE BIASED RANDOM NUMBERS*/
/*numbers in certain ranges appear more frequently than others*/
// returns the weighted randomly selected key
function rand_weighted($numbers) {
	$total = 0;
	foreach ($numbers as $number => $weight) {
		$total += $weight;
		$distribution[$number] = $total;
	}
	$rand = mt_rand(0, $total - 1);
	foreach ($distribution as $number => $weights) {
		if ($rand < $weights) { return $number; }
	}
}
/*Usage - for aray of ads and some to be generated more frequently*/
$ads = array(
	'ford' => 12234, // advertiser, remaining impressions
	'att' => 33424,
	'ibm' => 16823);
$ad = rand_weighted($ads);
?>