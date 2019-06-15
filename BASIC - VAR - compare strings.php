<?php 
/*

!!COMPARE STRINGS!!

TIPS & INSTRUCTIONS:
*strcmp - Binary safe string comparison
	> int strcmp ( string $str1 , string $str2 )
	> returns < 0 if str1 is less than str2; > 0 if str1 is greater than str2, and 0 if they are equal
	> ALERT < 
		comparison is case sensitive, be sure the string you are comparing 
		has no special characters like '\n' or something like that


*/


$cats = 'Tabitha';
$dogs = 'Tabitha';
$mice = 'Timmy';

if(strcmp($cats, $dogs) === 0) {
	print 'Strings are identical!';
} else {
	print 'Strings are not identical!';
}

/*All options*/
strcmp("5", 5) => 0
strcmp("15", 0xf) => 0
strcmp(61529519452809720693702583126814, 61529519452809720000000000000000) => 0
strcmp(NULL, false) => 0
strcmp(NULL, "") => 0
strcmp(NULL, 0) => -1
strcmp(false, -1) => -2
strcmp("15", NULL) => 2
strcmp(NULL, "foo") => -3
strcmp("foo", NULL) => 3
strcmp("foo", false) => 3
strcmp("foo", 0) => 1
strcmp("foo", 5) => 1
strcmp("foo", array()) => NULL + PHP Warning
strcmp("foo", new stdClass) => NULL + PHP Warning
strcmp(function(){}, "") => NULL + PHP Warning
?>