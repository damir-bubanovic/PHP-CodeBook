<?php 
/*

!!COMMAND-LINE - PARSING PROGRAM ARGUMENTS!!

> You want to process arguments passed on the command line

*filesize - gets the size for the given file

*/


/*Look in $argc for the number of arguments and $argv for their values. 
The first argument, $argv[0], is the name of script that is being run*/
if($argc != 2) {
	die("Wrong number of arguments: I expect only 1.");
} 

$size = filesize($argv[1]);

print "I am $argv[0] and report that the size of $argv[1] is $size bytes.";



/*To set options based on flags passed from the command line, 
loop through $argv from 1 to $argc*/
/*Parsing commmand-line arguments*/
for($i = 1; $i < $argc; $i++) {
	switch ($argv[$i]) {
		case '-v':
			// set a flag
			$verbose = true;
			break;
		case '-c':
			// advance to the next argument
			$i++;
			
			// if it's set, save the value
			if(isset($argv[$i])) {
				$config_file = $argv[$i];
			} else {
				// quit if no filename specified
				die("Must specify a filename after -c");
			}
			break;
		case '-q':
			$quiet = true;
			break;
		default:
			die('Unknown argument: '.$argv[$i]);
			break;
	}
}

?>