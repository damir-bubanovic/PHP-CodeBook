<?php 
/*

!!FILES - ESCAPING SHELL METACHARACTERS!!

> You need to incorporate external data in a command line, but you want to escape special
characters so nothing unexpected happens
	>> npr. you want to pass user input as an argument to a program
	
> Using escapeshellarg() ensures that the right process is displayed even if its ID has
an unexpected character (e.g., a space) in it. 
> It also prevents unintended commands from being run

*system - execute an external program and display the output
*escapeshellarg - escape a string to be used as a shell argument
*escapeshellcmd - escape shell metacharacters

*/


/*Use escapeshellarg() to handle arguments and escapeshellcmd() to handle program names*/
system('ls -al '.escapeshellarg($directory));
system(escapeshellcmd($ls_program).' -al');



/*This example uses escapeshellarg() in printing the process status for a particular process*/
system('/bin/ps '.escapeshellarg($process_id));

?>