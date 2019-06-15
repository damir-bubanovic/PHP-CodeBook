<?php 
/*

!!COMMAND-LINE - RUNNING PHP CODE ON EVERY LINE OF AN INPUT FILE!!

> You want to read an entire file and execute PHP code on every line.
	>> npr. you want to create a command-line version of grep that uses PHP’s 
	Perl-compatible regular expression engine

*/


/*Use the -R command-line flag to process standard input:*/
?>

% php -R 'if (preg_match("/$argv[1]/", $argn)) print "$argn\n";'
php
< /usr/share/dict/words
ephphatha

<?php
/*To execute a block of code before or after processing the lines, 
use the -B and -E options, respectively*/
?>

% php -B '$count = 0;'
-R 'if (preg_match("/$argv[1]/", $argn)) $count++;'
-E 'print "$count\n";'
php
< /usr/share/dict/words
l

<?php 
/*Sometimes you want to quickly process a file using PHP via the command line, either
as a standalone project or within a sequence of piped commands*/

/*PHP makes that easy using three command-line flags and two special variables: -R, -B,
-E, $argn, and $argi*/


/*PHP script that takes HTML input, strips the tags, and prints out the result*/
?>

php -R 'print strip_tags($argn) . "\n"; ' < index.html

<?php 
/*This slightly more complicated example, which is a simple version of grep, shows how
to accept input arguments via the $argv array*/
?>

% php -R 'if (preg_match("/$argv[1]/", $argn)) print "$argn\n";'
php
< /usr/share/dict/words
ephphatha

<?php 
/*Beyond the individual lines, you sometimes need to execute initialization or clean-up
code. Specify this using the -B and -E flags*/

/*Building on the grep example, this code counts the total number of matching lines:*/
?>

% php -B '$count = 0;'
-R 'if (preg_match("/$argv[1]/", $argn)) $count++;'
-E 'print "$count\n";'
php
< /usr/share/dict/words

<?php 
/*To find out the percentage of matching lines, in addition to the total, use $argi*/
?>

% php -B '$count = 0;'
-R 'if (preg_match("/$argv[1]/", $argn)) $count++;'
-E 'print "$count/$argi\n";'
php
< /usr/share/dict/words
1/234937