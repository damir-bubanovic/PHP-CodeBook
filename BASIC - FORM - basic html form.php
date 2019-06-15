<?php 
/*

!!BASIC HTML FORM!!

> The name of the text input element inside the form is first_name. Also, the method of the form is post. 
This means that when the form is submitted, $_POST['first_name'] will hold whatever string the user typed in.

*/
?>

<!--BASIC HTML FORM-->
<form action="hello.php" method="post">
<p>What is your first name?</p>
<input type="text" name="first_name" />
<input type="submit" value="Say Hello" />
</form>


<?php 
/*Basic PHP form processing*/
print 'Hello, ' . $_POST['first_name'] . '!';
?>