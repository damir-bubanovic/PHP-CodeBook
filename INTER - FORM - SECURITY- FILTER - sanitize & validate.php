<?php
/*
!!INTER - FORM - SECURITY - FILTER - SANITIZE & VALIDATE!!

> used to validate and filter data coming from insecure sources, like user input
> filter functions are enabled by default. There is no installation needed to use these functions

*/
?>

<?php 
/*
filter.default
> Filter all $_GET, $_POST, $_COOKIE, $_REQUEST and $_SERVER data by this filter. 
Accepts the name of the filter you like to use by default. See the filter list for 
the list of the filter names
> not sure about usage
*/
?>

<?php 
/*
filter.default_flags
> Default flags to apply when the default filter is set. This is set to 
FILTER_FLAG_NO_ENCODE_QUOTES by default for backwards compatibility reasons
> not sure about usage
*/
?>

<?php 
/*
filter_has_var()
> Checks if a variable of a specified input type exist
>> Check if the input variable "email" is sent to the PHP page, through the "get" method
*/
if (!filter_has_var(INPUT_GET, "email")) {
    echo("Email not found");
} else {
    echo("Email found");
}
?>

<?php 
/*
filter_id()
> Returns the filter ID of a specified filter name
>> Return the filter ID of the VALIDATE_EMAIL filter
*/
$echo(filter_id("validate_email"));
?>

<?php 
/*
filter_input()
> Gets an external variable (e.g. from form input) and optionally filters it
>> Check if the external variable "email" is sent to the PHP page, through the "get" method, 
and also check if it is a valid email address
*/
if (!filter_input(INPUT_GET, "email", FILTER_VALIDATE_EMAIL)) {
    echo("Email is not valid");
} else {
    echo("Email is valid");
}
?>

<?php 
/*
filter_input_array()
> Gets external variables (e.g. from form input) and optionally filters them
>> Check if the external variable "email" is sent to the PHP page, through the "get" method, 
and also check if it is a valid email address
*/
if (!filter_input(INPUT_GET, "email", FILTER_VALIDATE_EMAIL)) {
    echo("Email is not valid");
} else {
    echo("Email is valid");
}
?>

<?php 
/*
filter_list()
> Returns a list of all supported filters
>> The filter_list() function can be used to list the name and ID of all available filters
*/
?>
<table>
  <tr>
    <td>Filter Name</td>
    <td>Filter ID</td>
  </tr>
  <?php
  foreach (filter_list() as $id =>$filter) {
    echo '<tr><td>' . $filter . '</td><td>' . filter_id($filter) . '</td></tr>';
  }
?>
</table>

<?php 
/*
filter_var_array()
> Gets multiple variables and filter them
>> useful for filtering many values without calling filter_var() over and over
*/
?>
<?php
$arr = array(
  "name" => "peter griffin",
  "age" => "41",
  "email" => "peter@example.com",
);

$filters = array(
  "name" => array(
    "filter"=>FILTER_CALLBACK,
    "flags"=>FILTER_FORCE_ARRAY,
    "options"=>"ucwords"
  ),
  "age" => array(
    "filter"=>FILTER_VALIDATE_INT,
    "options"=>array(
      "min_range"=>1,
      "max_range"=>120
      )
  ),
  "email"=> FILTER_VALIDATE_EMAIL,
);

print_r(filter_var_array($arr, $filters));
/*
Array (
  [name] => Peter Griffin
  [age] => 41
  [email] => peter@example.com
)
*/
?>

<?php 
/*
filter_var()
> Filters a variable with a specified filter
>> Check if the variable $email is a valid email address
*/
$email = "john.doe@example.com";

if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
  echo("$email is a valid email address");
} else {
  echo("$email is not a valid email address");
}


$email = "john.doe@example.com";

// Remove all illegal characters from email
$email = filter_var($email, FILTER_SANITIZE_EMAIL);

// Validate e-mail
if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
    echo("$email is a valid email address");
} else {
    echo("$email is not a valid email address");
}
?>

<?php 
/*
FILTER_VALIDATE_BOOLEAN
> Validates a boolean
*/
$var="yes";

var_dump(filter_var($var, FILTER_VALIDATE_BOOLEAN));
// bool(true)
?>

<?php 
/*
FILTER_VALIDATE_EMAIL
> Validates an e-mail address
*/
$email = "john.doe@example.com";

if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
  echo("$email is a valid email address");
} else {
  echo("$email is not a valid email address");
}
?>

<?php 
/*
FILTER_VALIDATE_FLOAT
> Validates a float
*/
$var=12.3;

var_dump(filter_var($var, FILTER_VALIDATE_FLOAT));
// float(12.3)
?>

<?php 
/*
FILTER_VALIDATE_INT
> Validates an integer
*/
$int = 100;

if (!filter_var($int, FILTER_VALIDATE_INT) === false) {
    echo("Variable is an integer");
} else {
    echo("Variable is not an integer");
}
?>

<?php 
/*
FILTER_VALIDATE_IP
> Validates an IP address
*/
$ip = "127.0.0.1";

if (!filter_var($ip, FILTER_VALIDATE_IP) === false) {
    echo("$ip is a valid IP address");
} else {
    echo("$ip is not a valid IP address");
}
?>

<?php 
/*
FILTER_VALIDATE_REGEXP
> Validates a regular expression
*/
$string = "Match this string";

var_dump(filter_var($string, FILTER_VALIDATE_REGEXP,
array("options"=>array("regexp"=>"/^M(.*)/"))))
// string(17) "Match this string"
?>

<?php 
/*
FILTER_VALIDATE_URL
> Validates a URL
*/
$url = "http://www.w3schools.com";

if (!filter_var($url, FILTER_VALIDATE_URL) === false) {
    echo("$url is a valid URL");
} else {
    echo("$url is not a valid URL");
}
?>

<?php 
/*
FILTER_SANITIZE_EMAIL
> Removes all illegal characters from an e-mail address
*/
$email = "john(.doe)@exa//mple.com";

$email = filter_var($email, FILTER_SANITIZE_EMAIL);
echo $email;
?>

<?php 
/*
FILTER_SANITIZE_ENCODED
> Removes/Encodes special characters
*/
$url="http://www.w3schoolsÅÅ.com";

$url = filter_var($url, FILTER_SANITIZE_ENCODED);
echo $url;
?>

<?php 
/*
FILTER_SANITIZE_MAGIC_QUOTES
> Apply addslashes()
*/
$var="Peter's here!";

var_dump(filter_var($var, FILTER_SANITIZE_MAGIC_QUOTES));
// string(14) "Peter\'s here!"
?>

<?php 
/*
FILTER_SANITIZE_NUMBER_FLOAT
> Remove all characters, except digits, +- and optionally .,eE
*/
$number="5-2f+3.3pp";

var_dump(filter_var($number, FILTER_SANITIZE_NUMBER_FLOAT,
FILTER_FLAG_ALLOW_FRACTION));
// string(7) "5-2+3.3"
?>

<?php 
/*
FILTER_SANITIZE_NUMBER_INT
> Removes all characters except digits and + -
*/
$number="5-2+3pp";

var_dump(filter_var($number, FILTER_SANITIZE_NUMBER_INT));
// string(5) "5-2+3"
?>

<?php 
/*
FILTER_SANITIZE_SPECIAL_CHARS
> Removes special characters
*/
$url="Is Peter <smart> & funny?";

var_dump(filter_var($url,FILTER_SANITIZE_SPECIAL_CHARS));
// string(37) "Is Peter <smart> & funny?"
?>

<?php 
/*
FILTER_SANITIZE_STRING
> Removes tags/special characters from a string
*/
$str = "<h1>Hello World!</h1>";

$newstr = filter_var($str, FILTER_SANITIZE_STRING);
echo $newstr;
// Hello World!
?>

<?php 
/*
FILTER_SANITIZE_STRIPPED
> Alias of FILTER_SANITIZE_STRING
*/
$var="<b>Peter Griffin<b>";

var_dump(filter_var($var, FILTER_SANITIZE_STRIPPED));
// string(13) "Peter Griffin"
?>

<?php 
/*
FILTER_SANITIZE_URL
> Removes all illegal character from s URL
*/
$var="http://www.w3schoo��ls.co�m";

var_dump(filter_var($var, FILTER_SANITIZE_URL));
// string(24) "http://www.w3schools.com"
?>

<?php 
/*
FILTER_UNSAFE_RAW
> Do nothing, optionally strip/encode special characters
*/
?>

<?php 
/*
FILTER_CALLBACK
> Call a user-defined function to filter data
*/
function convertSpace($string) {
	return str_replace(" ", "_", $string);
}

$string = "Peter is a great guy!";

echo filter_var($string, FILTER_CALLBACK,
array("options"=>"convertSpace"));
// Peter_is_a_great_guy!
?>