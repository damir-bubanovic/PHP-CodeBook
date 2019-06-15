<?php 
/*

!!COMMAND-LINE - PARSING PROGRAM ARGUMENTS WITH GETOPT!!

> You want to parse program options that may be specified as short 
or long options, or they may be grouped

*/


/*Use the built-in getopt() function. It supports long options, 
optional values, and other convenient features*/
// accepts -a, -b, and -c
$opts1 = getopt('abc');

// accepts --alice and --bob
$opts2 = getopt('', array('alice','bob'));



/*To parse short-style options, pass getopt() the array of command-line arguments and
a string specifying valid options. This example allows -a, -b, or -c as arguments, alone
or in groups*/
$opts = getopt('abc');


/*For the previous option string abc, these are valid sets of options to pass*/
% program.php -a -b -c
% program.php -abc
% program.php -ab -c

?>