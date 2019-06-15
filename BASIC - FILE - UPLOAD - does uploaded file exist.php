<?php
/*

!!DOES UPLOADED FILE EXIST!!

> place At the top of page before !DOCTYPE
> looking for uploaded file in temporary folder, later transfer to images/ folder
*is_uploaded_file - tells whether the file was uploaded via HTTP POST
	> bool is_uploaded_file ( string $filename )
	> returns TRUE if the file named by filename was uploaded via HTTP POST
> upload_file i tmp_name - they are variables from BASIC - FILE - upload - variables

*/

/*At top of the page*/
if (!is_uploaded_file($_FILES['upload_file']['tmp_name'])) {  
    $message= "You must upload a file!";  
} else {  
	$message= "File Exists";
}  
print $message; 

?>

<!--

!!In body of page!!

> USE htmlspecialchars when printing data in HTML code
> make it a Self referencing page

-->

<form action="<?php print(htmlspecialchars($_SERVER["PHP_SELF"])) ?>"
method="post" enctype="multipart/form-data">
	<br /><br />
    <p>Chose a file to upload:</p><br />
    <input type="file" name="upload_file"><br />
    <input type="submit" name="submit" value="submit">
</form>