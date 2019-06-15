	<!--USE with - _FORM - REGISTRATION - with resume.php-->
	<!--LOOK UP - _BASIC - REGEX - validate numbers.php, validate phone numbers.php, validate email.php-->

<?php
/*Regular expressions ili regex - to je pattern of characters to match*/
/^\d\d\d\d\d\d\d\d\d\d$/ ili /^\d{10}$/ - 10 characters
/ - početak i / kraj stringa
^ - start matching at the begining of string
\d - digit (broj ili slovo)
$ - kraj stringa
{10} - jednostavan način za napisati 10 digits
{ } - ovo označava ponavljanje


/*Metacharacters - za poboljšanje patterna možeš koristiti (regex) metacharacters*/
• \d - predstavlja bilo koji broj 0-9
• \w - predstavlja ili slovo ili broj
• \s - predstavlja whitespace ( space, tab, newline, return/enter )
• ^ - predstavlja početak stringa
• . - predstavlja bilo koji character osim newline
• $ - predstavlja kraj stringa
• Ako želiš točno određeni character onda /707-827-7000/  - (“707-827-7000”)
• {min,max} - kada imaš 2 broja unutar { } koji su odvojeni , onda to predstavlja koliko puta
se character ispred može ponavljati u nizu ( \d{2,4} - brojka se može ponavljati 2 do 4 puta)
• + - character ili metacharacter iza ovog simbola mora se ponoviti jedan ili više puta
• ? - character ili metacharacter iza ovog simbola mora se ponoviti jednom ili uopće ne
• * - character ili metacharacter iza ovog simbola mora se ponoviti jednom ili više puta ili uopće ne

/*Phone number*/
/^\d{3}\s\d{7}$/ === 555 6364652;
/^\d{3}\s\d{3}\s\d{4}$/ === 555 636 4652;
/^\d{3}\d{3}-\d{4}$/ === 555636-4652;
/^\d{3}-\d{3}-\d{4}$/ === 555-636-4652;
/^\d{3}\s\w\w\s\w{5}$/ === 555 ME NINJA;
/^\d{10}$/ === 5556364652;
/^[3-6]{4}/ === 3456;
/*Pripazi na zagrade - to je grupa koju u našem slučaju ponavljaš 2x*/
/^([A-Z]\d){2}$/ === B5C9;
/*korištenje reserved characters kao . $ + ? \... ( ) je (\ \)*/
/^\(\d{3}\)\d{3}-\d{4}$/ === (555)636-4652;
/*(-\d{4})?$ - zadnje 4 brojke mogu se ponoviti jednom ili uopće ne*/
/^\d{3}-\d{3}-\d{4}(-\d{4})?$/;
/*Kombinacije*/
/ ^ \ ( ? [ 2 - 9 ] \ d { 2 } \ ) ? [ - \ s ] \ d { 3 } - \ d { 4 } $ /
=== 555-636-4652 === 555 636-4652 === (555)-636-4652 === (555) 636-4652


/*Character Class - match characters sa specifičnim setom vrijednosti, [] oznala za character class*/
• [0-2] - matches raspon brojeva 0, 1, 2
• [A-D] - matches slova A, B, C, D
• [^b-f] - match sva slova osim b, c, d, e, f
• [aeiouAEG] - match samo slova a, e, i, o, u, A, E, G

/*Ovo pogledati bolje nisam baš siguran*/
PREG_MATCH - /^[+][2-9]\d\d{1,2}\s\d{1,2}\s\d{3}-\d{3,4}$/ === +385 98 345-3425;
PREG_REPLACE - /[\+\s\-]/
/*[+] / + mora bit u zagradama, internacionalni može miti 2-3 broja, prvi broj nikad nije 0, 
gradski ili mobilni broj, 6-7 brojeva u telefonu, sve provjeriti jer to je za samo za hr*/

/*Preg_match i Preg_replace ORIGINAL u knjizi*/
preg_match - /^\(?[2-9]\d{2}\)?[-\s]\d{3}-\d{4}$/
preg_replace - /[\(\)\-\s]/

/*Email*/
'/^[a-zA-Z0-9][a-zA-Z0-9\._\-&!?=#]*/'
?>