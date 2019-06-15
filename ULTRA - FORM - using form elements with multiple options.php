<?php 
/*

!!FORM - USING FORM ELEMENTS WITH MULTIPLE OPTIONS!!

> You have form elements that let a user select multiple choices, such as a drop-down
menu or a group of checkboxes, but PHP sees only one of the submitted values

> End the form element’s name with a pair of square brackets
	>> Putting [] at the end of the form element name tells PHP to treat the incoming data as an array instead of a scalar
	>> When PHP sees more than one submitted value assigned to that variable, it keeps them all
	>> A similar syntax also works with multidimensional arrays

*$_POST - associative array of variables passed to the current script via the HTTP POST (HTTP POST variables)
*join - Alias of implode() - Join array elements with a string

*/


/*Naming a checkbox group*/
?>

<input type="checkbox" name="boroughs[]" value="bronx"> The Bronx
<input type="checkbox" name="boroughs[]" value="brooklyn"> Brooklyn
<input type="checkbox" name="boroughs[]" value="manhattan"> Manhattan
<input type="checkbox" name="boroughs[]" value="queens"> Queens
<input type="checkbox" name="boroughs[]" value="statenisland"> Staten Island

<?php 
/*Then, treat the submitted data as an array inside of $_GET or $_POST*/
print 'I love ' . join(' and ', $_POST['boroughs']) . '!';


/*Code equivalent of a multiple-value form element submission*/
$_POST['boroughs'][] = "bronx";
$_POST['boroughs'][] = "brooklyn";
$_POST['boroughs'][] = "manhattan";

?>