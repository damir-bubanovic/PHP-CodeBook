<?php 
/*

!!REDIRECT TO DIFFERENT LOCATION - PAGE!!

> automatically send a user to a new URL
	npr. after successfully saving form data, you want to redirect a user to a page that confirms that the data has been saved

*/



/*Before any output is printed, use header() to send a Location header with the new URL, and then call exit() so that nothing else is printed*/
header('Location: http://www.example.com/confirm.html');
exit();


/*Redirecting with query string variables*/
header('Location: http://www.example.com/$monkey=turtle');
exit();


/*Redirect URLs must include the protocol and hostname*/
header('Location: http://www.example.com/catalog/food/pemmican.php');
exit();



/*The URL that you are redirecting a user to is retrieved with GET. You can’t redirect
someone to retrieve a URL via POST. With JavaScript, however, you can simulate a redirect
via POST by generating a form that gets submitted (via POST) automatically*/
?>
<!--Redirecting via a posted form-->
<html>
<body onload="document.getElementById('redirectForm').submit()">
<form id='redirectForm' method='POST' action='/done.html'>
    <input type='hidden' name='status' value='complete'/>
    <input type='hidden' name='id' value='0u812'/>
    <input type='submit' value='Please Click Here To Continue'/>
</form>
</body>
</html>