<?php 
/*

!!FORM - HANDLING REMOTE VARIABLES WITH PERIODS IN THEIR NAMES!!

> want to process a variable with a period in its name, but when a form is submitted, you can’t find the variable in $_GET or $_POST

> SOLUTION - Replace the period in the variable’s name with an underscore
	>> if you have a form input element named hot.dog, you access it inside PHP as the variable $_GET['hot_dog'] or $_POST['hot_dog']

*/

?>