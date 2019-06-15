<?PHP 
/*

!!BUTTON CLICKED!!

> detect if button has been clicked
> in our case submit button

TIPS & EXPLANATIONS:
*isset - variable set & not NULL
	> can use var_dump() for more information about a variable 
	> return true
	> isset() only works with variables as passing anything else will result in a error
	> for checking if constants are set use the defined() function
*$_POST - An associative array of variables passed to the current script via the HTTP POST method
	> ALERT <
		Make sure your html form input items have the NAME attribute
	> $_POST
		> for -> Content-Type: application/x-www-form-urlencoded (standard web forms)
		> not -> Content-Type: text/xml (generic HTTP POST operation)

*/

if(isset($_POST['submit'])) {
	/*Execute code here*/
}
?>