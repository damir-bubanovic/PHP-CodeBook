<?php 
/*

!!INTER & LOCAL - SORTING IN A LOCALE-AWARE ORDER!!

> You need to sort text in a way that respects a particular locale’s rules for character ordering

*sort - sort an array

*/


/*Instantiate a Collator object for your locale, and then call its sort() method*/
$words = array('Малина', 'Клубника', 'Огурец');
$collator = new Collator('ru_RU');
// Sorts in-place, just like sort()
$collator->sort($words);

?>