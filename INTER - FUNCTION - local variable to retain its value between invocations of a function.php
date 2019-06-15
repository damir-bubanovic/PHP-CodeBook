<?php 
/*

!!LOCAL VARIABLE TO RETAIN ITS VALUE BETWEEN INVOCATIONS OF A FUNCTION!!

*/


/*Declare the variable as static*/
function track_times_called() {
	static $i = 0;
	$i++;
	return $i;
}

/*declaring a variable static causes its value to be remembered by the function*/
/*EXAMPLE*/
function check_the_count($pitch) {
	static $strikes = 0;
	static $balls = 0;

	switch ($pitch) {
	case 'foul':
		if (2 == $strikes) break; // nothing happens if 2 strikes
		// otherwise, act like a strike
	case 'strike':
		$strikes++;
	break;
	case 'ball':
		$balls++;
	break;
	}

	if(3 == $strikes) {
		$strikes = $balls = 0;
		return 'strike out';
	}

	if(4 == $balls) {
		$strikes = $balls = 0;
		return 'walk';
	}
	return 'at bat';
}

$pitches = array('strike', 'ball', 'ball', 'strike', 'foul','strike');
$what_happened = array();
foreach ($pitches as $pitch) {
	$what_happened[] = check_the_count($pitch);
}
// Display the results
var_dump($what_happened);
?>