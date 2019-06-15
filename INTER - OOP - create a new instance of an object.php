<?php 
/*

!!CREATE NEW OBJECT!!

*/

class User {
	function load_info($username) {
		// load profile from database
	}
}

$user = new User;
$user->load_info($_GET['username']);


/*instantiate multiple instances of the same object*/
$adam = new User;
$adam->load_info('adam');

$dave = new User;
$dave->load_info('dave');
?>