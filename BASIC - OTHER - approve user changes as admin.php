	<!--USE WITH SCOREBOARD - show scores.php user insert score.pdf-->
	<!--LOOK / USE WITH SCOREBOARD - approve score & BASIC-->

<?php
/*

!!APPROVE USER CHANGES AS ADMIN!!

*isset - determine if a variable is set and is not NULL
	> bool isset ( mixed $var [, mixed $... ] )
	> returns TRUE if var exists and has value other than NULL

*/



/*If submit button has been clicked*/
if(isset($_POST['submit'])) {
	
	/*If confirm (approval) button has been set to yes*/
	/*MySQL approved column TINYINT with default value of 1*/
	if($_POST['confirm'] == 'Yes') {
	/*Code goes here - do update default value of 0 in database to 1*/
	}
}; 
?>