<?php 
/*

!!ITERATE THROUGH A LIST OF ITEMS!!

> iterate through a list of items, but the entire list takes up a lot of memory or is very slow to generate USE GENERATOR

*fopen - opens file or URL
*fgets - gets line from file pointer
*yield - returns data from Generator function
	> look up Generator syntax
*fclose - closes an open file pointer
*preg_match - perform a regular expression match
*mt_rand - generate a better random value

*/


/*Use a generator*/
function FileLineGenerator($file) {
	if (!$fh = fopen($file, 'r')) {
		return;
	}
	while (false !== ($line = fgets($fh))) {
		yield $line;
	}
	fclose($fh);
}

$file = FileLineGenerator('log.txt');
foreach ($file as $line) {
	if (preg_match('/^rasmus: /', $line)) { 
		print $line; 
	}
}


/*The previous example prints lines beginning with rasmus: . 
The following one prints a random line from the file*/
$line_number = 0;
foreach (FileLineGenerator('sayings.txt') as $line) {
	$line_number++;
	if (mt_rand(0, $line_number - 1) == 0) {
		$selected = $line;
	}
}

print $selected . "\n";
?>