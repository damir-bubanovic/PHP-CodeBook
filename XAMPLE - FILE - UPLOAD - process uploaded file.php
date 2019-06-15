<?php 
/*This shoul be in aplication constats seperate file maxsize*/
$maxsize=28480; //set the max upload size in bytes 
if (!$HTTP_POST_VARS['submit']) { 
    //print_r($_FILES); 
    //$error=" ";  
   //this will cause the rest of the processing to be skipped 
   //and the upload form displays 
} 
/*Remove uploaded file if it does not fit the criteria*/
if (!is_uploaded_file($_FILES['upload_file']['tmp_name']) AND 
!isset($error)) { 
    $error = "<b>You must upload a file!</b><br /><br />"; 
    unlink($_FILES['upload_file']['tmp_name']); 
} 
if ($_FILES['upload_file']['size'] > $maxsize AND !isset($error)) { 
    $error = "<b>Error, file must be less than $maxsize bytes.</b><br /><br />"; 
    unlink($_FILES['upload_file']['tmp_name']); 
} 
if($_FILES['upload_file']['type'] != "image/gif" AND 
$_FILES['upload_file']['type'] != "image/pjpeg" AND 
$_FILES['upload_file']['type'] !="image/jpeg" AND !isset($error)) { 
    $error = "<b>You may only upload .gif or .jpeg files.</b><br /><br />"; 
    unlink($_FILES['upload_file']['tmp_name']); 
} 
/*Accepting upload file*/ 
if (!isset($error)) { 
    move_uploaded_file($_FILES['upload_file']['tmp_name'], 
                       "uploads/".$_FILES['upload_file']['name']); 
    print "Thank you for your upload."; 
    exit; 
} 
else 
{ 
    echo ("$error"); 
} 
?>