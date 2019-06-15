<?php 
/*

!!INTER & LOCAL - MANIPULATING UTF-8 TEXT!!

> You want to work with UTF-8–encoded text in your programs.
	>> npr. you want to properly calculate the length of multibyte strings and 
	make sure that all text is output as proper UTF-8–encoded characters

> Use a combination of PHP functions for the variety of tasks that UTF-8 
compliance demands

*mb_internal_encoding - Set/Get internal character encoding
*strlen - returns the length of the given string
*mb_strlen - get string length
*iconv_strlen - returns the character count of string
*iconv_substr - cut out part of a string
*htmlspecialchars - convert special characters to HTML entities
*htmlentities - convert all applicable characters to HTML entities
*preg_match_all - perform a global regular expression match

*/


/*Using mb_strlen( )*/
// Set the encoding properly
mb_internal_encoding('UTF-8');
// ö is two bytes
$name = 'Kurt Gödel';
// Each of these Hangul characters is three bytes
$dinner = '불고기';

$name_len_bytes = strlen($name);
$name_len_chars = mb_strlen($name);

$dinner_len_bytes = strlen($dinner);
$dinner_len_chars = mb_strlen($dinner);

print "$name is $name_len_bytes bytes and $name_len_chars chars\n";
print "$dinner is $dinner_len_bytes bytes and $dinner_len_chars chars\n";
/*
OUTPUT:
Kurt Gödel is 11 bytes and 10 chars
불고기 is 9 bytes and 3 chars
*/


/*OR*/


/*Using iconv*/
// Set the encoding properlyiconv_set_encoding('internal_encoding','UTF-8');

// ö is two bytes
$name = 'Kurt Gödel';
// Each of these Hangul characters is three bytes
$dinner = '불고기';

$name_len_bytes = strlen($name);
$name_len_chars = iconv_strlen($name);

$dinner_len_bytes = strlen($dinner);
$dinner_len_chars = iconv_strlen($dinner);

print "$name is $name_len_bytes bytes and $name_len_chars chars\n";
print "$dinner is $dinner_len_bytes bytes and $dinner_len_chars chars\n";
print "The seventh character of $name is " . iconv_substr($name,6,1) . "\n";
print "The last two characters of $dinner are " . iconv_substr($dinner,-2);


/*OR*/


/*Use the optional third argument to functions such as htmlentities() and htmlspe
cialchars() that instructs them to treat input as UTF-8 encoded*/
/*UTF-8 HTML encoding*/
$encoded_name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
$encoded_dinner = htmlentities($_POST['dinner'], ENT_QUOTES, 'UTF-8');


/*OR*/


/*UTF-8 regular expression matching*/
$name = 'Kurt Gödel';
$dinner = '불고기';

$name_lower = preg_match_all('/\p{Ll}/u',$name,$match);
$dinner_lower = preg_match_all('/\p{Ll}/u',$dinner,$match);

print "There are $name_lower lowercase letters in $name.\n";
print "There are $dinner_lower lowercase letters in $dinner.\n";
/*
OUTPUT:
There are 7 lowercase letters in Kurt Gödel.
There are 0 lowercase letters in 불고기.
*/




/*Applying UTF-8 encoding to ISO-8859-1 strings*/
$lang = isset($_GET['lang']) ? $_GET['lang'] : 'en';
$word = isset($_GET['word']) ? $_GET['word'] : 'asparagus';

$ps = pspell_new($lang);
$check = pspell_check($ps, $word);

print htmlspecialchars($word,ENT_QUOTES,'UTF-8');
print $check ? ' is ' : ' is not ';
print ' found in the dictionary.';
print '<hr/>';

if(!$check) {
	$suggestions = pspell_suggest($ps, $word);
	
	if(count($suggestions)) {
		print 'Suggestions: <ul>';
		
		foreach ($suggestions as $suggestion) {
			$utf8suggestion = utf8_encode($suggestion);
			$safesuggestion = htmlspecialchars($utf8suggestion, ENT_QUOTES,'UTF-8');
			
			print "<li>$safesuggestion</li>";
		}
		print '</ul>';
	}
}

?>