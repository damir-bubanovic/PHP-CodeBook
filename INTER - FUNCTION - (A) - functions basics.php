<?php 
/*

!!FUNCTIONS BASIC!!

*/

/*Access the values passed to a function*/
function commercial_sponsorship($letter, $number) {
	print "This episode of Sesame Street is brought to you by ";
	print "the letter $letter and number $number.\n";
}
commercial_sponsorship('G', 3);
$another_letter = 'X';
$another_number = 15;
commercial_sponsorship($another_letter, $another_number);

/*ANOTHER EXAMPLE*/
function add_one($number) {
	$number++;
}
$number = 1;
add_one($number);
print $number;



/*Call different functions depending on a variable’s value*/
function get_file($filename) { 
	return file_get_contents($filename); 
}

$function = 'get_file';
$filename = 'graphic.png';
// calls get_file('graphic.png')
call_user_func($function, $filename);


/*Use call_user_func_array() when your functions accept differing argument counts*/
function get_file($filename) { 
	return file_get_contents($filename); 
}
function put_file($filename, $d) {
	return file_put_contents($filename, $d); 
}
if ($action == 'get') {
	$function = 'get_file';
	$args = array('graphic.png');
} elseif ($action == 'put') {
	$function = 'put_file';
	$args = array('graphic.png', $graphic);
}

// calls get_file('graphic.png')
// calls put_file('graphic.png', $graphic)
call_user_func_array($function, $args);



/*Invoking a callback inside a function that can accept a variable number of arguments*/
// logging function that accepts printf-style formatting
// it prints a time stamp, the string, and a new line
function logf() {
	$date = date(DATE_RSS);
	$args = func_get_args();
	
	return print "$date: " . call_user_func_array('sprintf', $args) . "\n";
}
logf('<a href="%s">%s</a>','http://developer.ebay.com','eBay Developer Program');



/*If you have more than two possibilities to call, use an associative array of function names*/
$dispatch = array(
	'add' => 'do_add',
	'commit' => 'do_commit',
	'checkout' => 'do_checkout',
	'update' => 'do_update'
);

$cmd = (isset($_REQUEST['command']) ? $_REQUEST['command'] : '');

if (array_key_exists($cmd, $dispatch)) {
	$function = $dispatch[$cmd];
	call_user_func($function); // call function
} else {
	error_log("Unknown command $cmd");
}
?>