<?php 
/*

!!PROCESSING FORM INPUT!!

> use the same HTML page to emit a form and then process the data entered into it. In other words, 
you’re trying to avoid a proliferation of pages that each handle different steps in a transaction

> ALERT <
	Forms can be easier to maintain when all parts live in the same file (or are referenced
	by the same file) and context dictates which sections to display
	
EXPLANATION $_POST & $_GET
	> $_GET method (what your browser uses when you just type in a URL or click on a link) 
			> means ‘Hey, server, give me something you’ve got.
			> response to a get request is the HTML form
	> $_POST method (what your browser uses when you submit a form whose method attribute is set to post) 
			> means ‘Hey, server, here’s some data that changes something.
			> response to the post request is the results of processing that form
			
TIP:
	> don’t hardcode the path to your page directly into the form action. Instead, use the $_SERVER['SCRIPT_NAME'] variable
	as the form action. This is set up by PHP on each request to contain the filename (relative to the document root) of the current script

	
FORM CODE & LOGIC (1. 2. 3.)
> The deciding-what-to-do logic assumes that the form display code is saved as getpostget.
php, that the form processing code is saved as getpost-post.php and that all three files
are in the same directory. The __DIR__ constant tells the program to look in the same
directory as the executing code for the files being included

*/

/*Use the $_SERVER['REQUEST_METHOD'] variable to determine whether the request was submitted with the get or post method*/
/*Deciding what to do based on request method*/

?>

<?php 
if($_SERVER['REQUEST_METHOD'] == 'GET') {
?>

<form action="<?php echo htmlentities($_SERVER['SCRIPT_NAME']) ?>" method="post">
    <p>What is your first name?</p>
    <input type="text" name="first_name" />
    <input type="submit" value="Say Hello" />
</form>

<?php 
} else {
	 print 'Hello, ' . $_POST['first_name'] . '!';
}
?>




<?php 
/*(1.)*/
/*form display code*/
?>
<form action="<?= htmlentities($_SERVER['SCRIPT_NAME']) ?>" method="post">
    <p>What is your first name?</p>
    <input type="text" name="first_name" />
    <input type="submit" value="Say Hello" />
</form>


<?php 
/*(2.)*/
/*form processing logic*/
?>
Hello, <?php $_POST['first_name'] ?>


<?php 
/*(3.)*/
/*logic that decides what to do*/
if($_SERVER['REQUEST_METHOD'] == 'GET') {
	include __DIR__ . '/getpost-get.php';
} else {
	include __DIR__ . '/getpost-post.php';
}
?>