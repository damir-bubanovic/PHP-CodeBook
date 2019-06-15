<html>
<body>
<table>
<form method='post' action='chap8_listing2.php'>
<tr>
<td> First Name:</td>
<td> <input type='text' name='firstname' size=35> </td>
</tr>
<tr>
<td> Last Name:</td>
<td> <input type='text' name='lastname' size=45> </td>
</tr>
<tr>
<td> Phone:</td>
<td> <input type='text' name='phone' size=10> </td>
</tr>
<tr>
<td colspan=2><input type='submit' value='Submit'></td>
</tr>
</table>
</body>
</html>

<?php
$trusted = array() ;
if (strlen($_POST['firstname']) <= 35) $trusted['firstname'] =
$_POST['firstname'] ;
if (strlen($_POST['lastname']) <= 45) $trusted['lastname'] = $_POST['lastname'] ;
if (strlen($_POST['phone']) <= 10 && is_numeric($_POST['phone']) ){
$trusted['phone'] = $_POST['phone'] ;
}
var_dump($trusted);
?>