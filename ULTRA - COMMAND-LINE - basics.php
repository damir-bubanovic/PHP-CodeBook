<?php 
/*

!!COMMAND-LINE - Basic!!

> PHP builds include a command-line interface (CLI) version. The CLI binary is similar
to web server modules and the CGI binary but has some important differences that
make it more shell friendly

> To run a script, pass the script filename as an argument
% php scan-discussions.php

> If it’s likely that you’ll use some of your classes and functions both for the Web and for
the command line, abstract the code that needs to react differently in those different
circumstances
> A useful tactic is to check if the return value of php_sa
pi_name() is cli. You can then branch your scripts’ behavior as follows
*/
if('cli' == php_sapi_name()) {
	print "Database error: ".mysql_error()."\n";
} else {
	print "Database error.<br/>";
	error_log(mysql_error());
}
/*
> This code not only adjusts the output formatting based on the context it’s executing in
(\n versus <br>), but also where the information goes

> On the command line, it’s helpful to the person running the program to see the error message 
from MySQL, but on the Web, you don’t want your users to see potentially sensitive data. 
Instead, the code outputs a generic error message and stores the details in the server’s error log 
for private review

> One helpful option on the command line is the -d flag, which lets you specify custom
INI entries without modifying your php.ini file. For example, here’s how to turn on
output buffering
% php -d output_buffering=1 scan-discussions.php


> The CLI binary also takes an -r argument. When followed by some PHP code without
<?php and ?> script tags, the CLI binary runs the code. For example, here’s how to print
the current time
% php -r 'print strftime("%c");'

For a list of complete CLI binary options, pass the -h command:
% php -h

Finally, the CLI binary defines handles to the standard I/O streams as the constants
STDIN, STDOUT, and STDERR. You can use these instead of creating your own filehandles
with fopen()
*/
// read from standard in
$input = fgets(STDIN,1024);
// write to standard out
fwrite(STDOUT,$jokebook);
// write to standard error
fwrite(STDERR,$error_code);

?>