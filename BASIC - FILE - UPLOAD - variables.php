<?php 
/*LOOK WITH SCOREBOARD - user insert scores & show scores.php & add score*/
/*USE WITH BASIC - upload file.html*/


/*picture is name of input field*/
/*use standard method for name input field*/

/*Name of the uploaded file - cat.jpg*/
$_FILES['picture']['name'];

/*Type of the uploaded file - image/gif*/
$_FILES['picture']['type'];

/*Size of the uploaded file - 12233 (bytes)*/
$_FILES['picture']['size'];

/*Temporary storage location - /tmp/phe3df4ff*/
/*Important to transfer uploaded files to temp folder to real folder*/
$_FILES['picture']['tmp_name'];

/*Error code for file upload - 0 is sucess, other num is failure*/
$_FILES['picture']['error'];
?>