<?php 
/*

!!COMMAND-LINE - READING PASSWORDS!!

> You need to read a string from the command line without it being echoed as it’s typed
	>> npr. when entering passwords

*chr - return a specific character
*substr_replace - replace text within a portion of a string
*rtrim - strip whitespace (or other characters) from the end of a string
*fgets - gets line from file pointer
*preg_match - perform a regular expression match
*fopen - opens file or URL
*preg_quote - quote regular expression characters
*feof - tests for end-of-file on a file pointer
*fgets - gets line from file pointer
*fclose - closes an open file pointer
*split - split string into array by regular expression
*crypt - one-way string hashing

*/


/*If the ncurses extension is available, use ncurses_getch() to 
read each character, making sure “noecho” mode is turned on*/
$password = '';
ncurses_init();
ncurses_addstr("Enter your password:\n");

/* Do not display the keystrokes as they are typed */
ncurses_noecho();

while(true) {
	// get a character from the keyboard
	$c = chr(ncurses_getch());
	
	if("\r" == $c || "\n" == $c) {
		// if it's a newline, break out of the loop, we've got our password
		break;
	} elseif("\x08" == $c) {
		/* if it's a backspace, delete the previous char from $password */
		$password = substr_replace($password, '', -1, 1);
	} elseif("\x03" == $c) {
		// if it's Control-C, clear $password and break out of the loop
		$password = NULL;
		break;
	} else {
		// otherwise, add the character to the password
		$password .= $c;
	}
}

ncurses_end();


/*Otherwise, on Unix systems, use /bin/stty to toggle echoing of typed characters*/
// turn off echo
`/bin/stty -echo`;
// read password
$password = trim(fgets(STDIN));
// turn echo back on
`/bin/stty echo`;




/*The following code displays Login: and Password: prompts, and compares the entered
password to the corresponding encrypted password stored in /etc/passwd. This requires
that the system not use shadow passwords*/
print "Login: ";

$username = rtrim(fgets(STDIN)) or die($php_errormsg);
preg_match('/^[a-zA-Z0-9]+$/', $username)
or die("Invalid username: only letters and numbers allowed");

print 'Password: ';

`/bin/stty -echo`;
$password = rtrim(fgets(STDIN)) or die($php_errormsg);
`/bin/stty echo`;
print "\n";

// find corresponding line in /etc/passwd
$fh = fopen('/etc/passwd', 'r') or die($php_errormsg);
$found_user = 0;
$pattern = '/^' . preg_quote($username) . ':/';

while(!($found_user || feof($fh))) {
	$passwd_line = fgets($fh,256);
	
	if(preg_match($pattern, $passwd_line)) {
		$found_user = 1;
	}
}
fclose($fh);
$found_user or die ("Can't find user \"$username\"");

// parse the correct line from /etc/passwd
$passwd_parts = split(':', $passwd_line);

/* encrypt the entered password and compare it to the password in /etc/passwd */
$encrypted_password = crypt($password, $password_parts[1]);
if($encrypted_password == $passwd_parts[1]) {
	print "login successful";
} else {
	print "login unsuccessful";
}

?>