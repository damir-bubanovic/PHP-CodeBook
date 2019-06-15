<?php 
/*

!!FILES - READING STANDARD OUTPUT FROM A PROGRAM!!

> You want to read the output from a program
	>> npr. you want the output of a system utility, such as route(8), 
	that provides network information
	
> If a program generates a lot of output, it is more memory efficient 
to read from a pipe one line at a time.
> If you’re printing formatted data to the browser based on the output
of the pipe, you can print it as you get it

*popen - opens process file pointer
*feof - tests for end-of-file on a file pointer
*fgets - gets line from file pointer
*trim - strip whitespace (or other characters) from the beginning and end of a string
*preg_match - perform a regular expression match
*substr - return part of a string
*substr_replace - replace text within a portion of a string
*pclose - closes process file pointer

*/


/*To read the entire contents of a program’s output, use the backtick (`) operator*/
$routing_table = `/sbin/route`;



/*To read the output incrementally, open a pipe with popen()*/
$ph = popen('/sbin/route','r') or die($php_errormsg);

while(!feof($ph)) {
	$s = fgets($ph) or die($php_errormsg);
}

pclose($ph) or die($php_errormsg);



/*This example prints information about recent Unix system logins formatted as an
HTML table. It uses the /usr/bin/last command*/
// print table header
print<<<_HTML_
<table>
<tr>
<td>user</td><td>login port</td><td>login from</td><td>login time</td>
<td>time spent logged in</td>
</tr>
_HTML_;

// open the pipe to /usr/bin/last
$ph = popen('/usr/bin/last', 'r') or die($php_errormsg);

while(!feof($ph)) {
	$line = fgets($ph) or die($php_errormsg);
	
	// don't process blank lines or the info line at the end
	if(trim($line) && (!preg_match('/^wtmp begins/',$line))) {
		$user = trim(substr($line,0,8));
		$port = trim(substr($line,9,12));
		$host = trim(substr($line,22,16));
		$date = trim(substr($line,38,25));
		$elapsed = trim(substr($line,63,10),' ()');
		
		if('logged in' == $elapsed) {
			$elapsed = 'still logged in';
			$date = substr_replace($date,'',-5);
		}
		
		print "<tr><td>$user</td><td>$port</td><td>$host</td>";
		print "<td>$date</td><td>$elapsed</td></tr>\n";
	}
}

pclose($ph) or die($php_errormsg);
print '</table>';

?>