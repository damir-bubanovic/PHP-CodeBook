<?php 
/*

!!ASSIGNING OBJECT REFERENCES - LINK OBJECTS!!

*/

/*link two objects, so when you update one, you also update the other*/
$adam = new User;
$dave = $adam;

/*$dave and $adam are two names for the exact same object*/
$adam = new User;
$adam->load_info('adam');

$dave = $adam;
?>