<?php 
/*

!!WORKING WITH MULTIPAGE FORMS!!

> want to use a form that displays more than one page and preserves data from one page to the next. 
	npr. your form is for a survey that has too many questions to put them all on one page

> USE session tracking to store form information for each stage as well as a variable to keep track of what stage to display

*$_SESSION - associative array containing session variables available to the current script
*session_start - start new or resume existing session
*isset - determine if a variable is set and is not NULL
*max - find highest value
*min - find lowest value
*__DIR__ - The directory of the file. If used inside an include, the directory of the included file is returned. This is equivalent to dirname(__FILE__)


EXPLANATION:
> At the beginning of each stage, all the submitted form variables are copied into $_SESSION. This makes them available 
on subsequent requests, including the code that runs in stage 3, which displays everything that’s been saved

> PHP’s sessions are perfect for this kind of task since all of the data in a session is stored on the server. This keeps 
each request small—no need to resubmit stuff that’s been entered on a previous stage—and reduces the validation overhead. 
You only have to validate each piece of submitted data when it’s submitted


*/


/*displays the four files for a two pageform and showing the collected results*/
/*Making a multipage form*/
/*(0.) stage.php - deciding what to do*/

// Turn on sessions
session_start();

// Figure out what stage to use
if(($_SERVER['REQUEST_METHOD'] == 'GET') || (!isset($_POST['stage']))) {
	$stage = 1;
} else {
	$stage = (int) $_POST['stage'];
}

// Make sure stage isn't too big or too small
$stage = max($stage, 1);
$stage = min($stage, 3);

// Save any submitted data
if($stage > 1) {
	foreach($_POST as $key => $value) {
		$_SESSION[$key] = $value;
	}
}
include __DIR__ . "/stage-$stage.php";




/*(1.) stage-1.php*/
?>
<form action='<?= htmlentities($_SERVER['SCRIPT_NAME']) ?>' method='post'>
    Name: <input type='text' name='name'/> <br/>
    Age: <input type='text' name='age'/> <br/>
    <input type='hidden' name='stage' value='<?= $stage + 1 ?>'/>
    <input type='submit' value='Next'/>
</form>




<?php 
/*(2.) - stage-2.php*/
?>
<form action='<?= htmlentities($_SERVER['SCRIPT_NAME']) ?>' method='post'>
Favorite Color: <input type='text' name='color'/> <br/>
Favorite Food: <input type='text' name='food'/> <br/>
<input type='hidden' name='stage' value='<?= $stage + 1 ?>'/>
<input type='submit' value='Done'/>




<?php 
/*(3.) - stage-3.php*/
?>
Hello <?= htmlentities($_SESSION['name']) ?>.
You are <?= htmlentities($_SESSION['age']) ?> years old.
Your favorite color is <?= htmlentities($_SESSION['color']) ?>
and your favorite food is <?= htmlentities($_SESSION['food']) ?>.