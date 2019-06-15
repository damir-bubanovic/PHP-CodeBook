<?php 
/*Code comes at top of page before !doctype*/
if(isset($_POST['submit'])) {
	echo "File Name ".$_FILES['upload_file']['name'];
}
?>

<!--Code comes in body-->
<!--htmlspecialchars when printing data in html-->
<!--self processing page-->
<!--encryption necessary when uploading data-->
<form action="<?php echo(htmlspecialchars($_SERVER['PHP_SELF']))?>"  
method="post" enctype="multipart/form-data">  
    <br /><br />  
    Choose a file to upload:<br />  
    <input type="file" name="upload_file">  
    <br />  
    <input type="submit" name="submit" value="submit">  
</form>