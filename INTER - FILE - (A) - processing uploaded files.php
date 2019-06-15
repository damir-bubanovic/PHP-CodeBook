<?php 
/*

!!PROCESSING UPLOADED FILES!!

> want to process a file uploaded by a user, npr. you want to store user-supplied photos
> Use the $_FILES array to get information about uploaded files
> This saves an uploaded file to the /tmp directory on the web server

*isset - determine if a variable is set and is not NULL
*basename - returns trailing name component of path (Use basename() to chop off the leading directories if needed)
*move_uploaded_file - moves an uploaded file to a new location (move the file to a permanent location)
*tmp_name - value stored in tmp_name is the complete path to the file

EXPLANATION:
> Uploaded files appear in the $_FILES superglobal array. For each file element in the form, an array is created in $_FILES whose key is the file element’s name
> npr. form has a file element named document, so $_FILES['document'] contains the information about the uploaded file
> Each of these per-file arrays has five elements:
	1) name - The name of the uploaded file. 
		> This is supplied by the browser so it could be a full pathname or just a filename
	2) type - The MIME type of the file, as supplied by the browser
	3) size - The size of the file in bytes, as calculated by the server
	4) tmp_name - The location in which the file is temporarily stored on the server
	5) error - An error code describing what (if anything) went wrong with the file upload
	
> ALERT <
	Always check the tmp_name value before processing it as any other file. 
	This ensures that a malicious user can’t trick your code into processing a system file as an upload.

	Check that PHP has permission to read and write to both the directory in which temporary files are saved 
	(set by the upload_tmp_dir configuration directive) and the location to which you’re trying to copy the file. 
	PHP is often running under a special username such as nobody or apache, instead of your personal username
	
> CHECK <
	> Check that your file isn’t being rejected because it seems to pose a security risk
		1) make sure file_uploads is set to On inside your configuration file
		2) make sure your file size isn’t larger than upload_max_filesize (default 2mb)
			> Additionally, there’s a post_max_size directive, which controls the maximum size 
			of all the post data allowed in a single request; its initial setting is 8 MB
		3) if you don’t see what you expect in $_FILES, make sure you add enctype="multipart/form-data" to the form’s opening tag. 
		PHP needs this to process the file information properly
		4) if no file is selected for uploading, PHP sets tmp_name to the empty string
			> need to make sure tmp_name is set and size is greater than 0

*/


/*Uploading a file*/
if($_SERVER['REQUEST_METHOD'] == 'GET') {
?>

<form method="post" action="<?php echo htmlentities($_SERVER['SCRIPT_NAME']) ?>"
    enctype="multipart/form-data">
    <input type="file" name="document"/>
    <input type="submit" value="Send File"/>
</form>

<?php 
} else {
	
	if(isset($_FILES['document']) && ($_FILES['document']['error'] == UPLOAD_ERR_OK)) {
		$newPath = '/tmp/' . basename($_FILES['document']['name']);
		
		if(move_uploaded_file($_FILES['document']['tmp_name'], $newPath)) {
			print "File saved in $newPath";
		} else {
			print "Couldn't move file to $newPath";
		}
	} else {
		print "No valid file uploaded";
	}
}

?>