<?php 
/*

!!IS FILE READABLE, WRITABLE, EXECUTABLE!!

*is_readable - tells whether a file exists and is readable
	> bool is_readable ( string $filename )
	> returns TRUE if the file or directory specified by filename exists and is readable
	> this function may return TRUE for directories. Use is_dir() to distinguish file and directory
*is_writable - tells whether the filename is writable
	> bool is_writable ( string $filename )
	> returns TRUE if the filename exists and is writable. the filename argument may 
	  be a directory name allowing you to check if a directory is writable
*is_executable - tells whether the filename is executable
	> bool is_executable ( string $filename )
	> returns TRUE if the filename exists and is executable

*/


$file_name="file.txt"; 


/*Readable?*/
if(is_readable($file_name)) { 
    print ("The file $file_name is readable.<br />"); 
} else { 
    print ("The file $file_name is not readable.<br />"); 
} 

/*Writable?*/
if(is_writeable($file_name)) { 
    print ("The file $file_name is writeable.<br />"); 
} else { 
    print ("The file $file_name is not writeable.<br />"); 
} 

/*Executable?*/
if(is_executable($file_name)) { 
    print ("The file $file_name is executable.<br />"); 
} else { 
    print ("The file $file_name is not executable.<br />"); 
} 
?> 