<?php 
/*

!!DOES FILE EXIST!!

TIPS & EXPLANATIONS:
*file_exists - Checks whether a file or directory exists
	> bool file_exists ( string $filename )
	> returns TRUE if the file or directory specified by filename exists; FALSE otherwise
	> ALERT <
		This function returns FALSE for files inaccessible due to safe mode restrictions. 
		However these files still can be included if they are located in safe_mode_include_dir

*/


$file_name = "basic.php"; 

/*In this case code works if index.php and basic.php are in the same folder*/
if(file_exists($file_name)) { 
    echo ('$file_name does exist.'); 
} 
else { 
    echo ('$file_name does not exist.'); 
}
?> 