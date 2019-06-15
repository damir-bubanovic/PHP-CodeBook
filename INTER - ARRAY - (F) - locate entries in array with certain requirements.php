<?php 
/*

!!LOCATE ENTRIES IN ARRAY THAT MEET CERTAIN REQUIREMENTS!!

*array_filter - filters elements of an array using a callback function
*break - ends execution of the current for, foreach, while, do-while or switch structure
	> ALERT <
		A break statement that is in the outer part of a program (e.g. not in a control loop) will end the script. 
		This caught me out when I mistakenly had a break in an if statement

*/



/*locate entries in an array that meet certain requirements*/
$movies = array(/*...*/);
foreach ($movies as $movie) {
	if ($movie['box_office_gross'] < 5000000) { 
		$flops[] = $movie; 
	}
}
/*OR*/
$movies = array(/* ... */);
$flops = array_filter($movies, function ($movie) {
	return ($movie['box_office_gross'] < 5000000) ? 1 : 0;
});

/*If you want only the first such element, exit the loop using break*/
$movies = array(/*...*/);
foreach ($movies as $movie) {
	if ($movie['box_office_gross'] > 200000000) { 
		$blockbuster = $movie; break; 
	}
}

/*return directly from a function*/
function blockbuster($movies) {
	foreach ($movies as $movie) {
		if ($movie['box_office_gross'] > 200000000) { 
			return $movie; 
		}
	}
}
?>