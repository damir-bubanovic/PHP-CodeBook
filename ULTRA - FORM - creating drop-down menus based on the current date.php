<?php 
/*

!!FORM - CREATING DROP-DOWN MENUS BASED ON THE CURRENT DATE!!

> want to create a series of drop-down menus that are based automatically on the current date

> create a DateTime object and then loop through the days you care about, modifying the object with its modify() method

> Using DateTime#modify() and DateTime#format() frees you from any concerns about time zone math. 
	>> Whatever the appropriate summer time transitions are for the relevant time zone will be handled properly

*/


/*Generating date-based drop-down menu options*/
$options = array();
$when = new DateTime();

// print out one week's worth of days
for($i = 0; $i < 7; $i++) {
	$options[$when->getTimestamp()] = $when->format('D, F j, Y');
	$when->modify('+1 day');
}

foreach($options as $value => $label) {
	print "<option value='$value'>$label</option>\n";
}


/*Prints:*/
?>

<option value='1365450257'>Mon, April 8, 2013</option>
<option value='1365536657'>Tue, April 9, 2013</option>
<option value='1365623057'>Wed, April 10, 2013</option>
<option value='1365709457'>Thu, April 11, 2013</option>
<option value='1365795857'>Fri, April 12, 2013</option>
<option value='1365882257'>Sat, April 13, 2013</option>
<option value='1365968657'>Sun, April 14, 2013</option>