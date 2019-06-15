<?php 
/*

!!COMMAND-LINE - READING FROM THE KEYBOARD!!

> You need to read in some typed user input

*fgets - gets line from file pointer
*ord - return ASCII value of character
*chr - return a specific character
*is_readable - tells whether a file exists and is readable

*/


/*Read from the special filehandle STDIN*/
print "Type your message. Type '.' on a line by itself when you're done.\n";

$last_line = false; 
$message = '';

while(!$last_line) {
	$next_line = fgets(STDIN, 1024);
	
	if(".\n" == $next_line) {
		$last_line = true;
	} else {
		$message .= $next_line;
	}
}

print "\nYour message is:\n$message\n";



/*If the Readline extension is installed, use readline()*/
$last_line = false; 
$message = '';

while(!$last_line) {
	$next_line = readline();
	
	if('.' == $next_line) {
		$last_line = true;
	} else {
		$message .= $next_line . "\n";
	}
}

print "\nYour message is:\n$message\n";



/*If the ncurses extension is installed, use ncurses_getch()*/
$line = '';
ncurses_init();
ncurses_addstr("Type a message, ending with !\n");

/* Display the keystrokes as they are typed */
ncurses_echo();
while(($c = ncurses_getch()) != ord("!")) {
	$line .= chr($c);
}
ncurses_end();

print "You typed: [$line]\n";



/*The Readline extension provides an interface to the GNU Readline library. The read
line() function returns a line at a time, without the ending newline. Readline allows
Emacs- and vi-style line editing by users. You can also use it to keep a history of previously
entered commands*/
$command_count = 1;

while(true) {
	$line = readline("[$command_count]--> ");
	readline_add_history($line);
	
	if(is_readable($line)) {
		print "$line is a readable file.\n";
	}
	$command_count++;
}

?>