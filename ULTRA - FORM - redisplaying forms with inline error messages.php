<?php 
/*

!!REDISPLAYING FORMS WITH INLINE ERROR MESSAGES!!

> When there’s a problem with data entered in a form, you want to print out error messages alongside the problem fields
> You also want to preserve the values the user entered in the form, so they don’t have to redo the entire thing

*$_SERVER - array containing information such as headers, paths, and script locations (Server and execution environment information)
*count - count all elements in an array, or something in an object
*isset - determine if a variable is set and is not NULL
*strlen - returns the length of the given string
*in_array - checks if a value exists in an array

*/


/*Redisplaying a form with error messages and preserved input - main logic and validation function*/
// Set up some options for the drop-down menu
$flavors = array(
	'Vanilla', 
	'Chocolate', 
	'Rhinoceros'
);

// Set up empty defaults when nothing is chosen
$defaults = array(
	'name'	=>	'',
	'age'	 =>	'',
	'flavor'  =>	array()
);

foreach($flavors as $flavor) {
	$defaults['flavor'][$flavor] = '';
}


if($_SERVER['REQUEST_METHOD'] == 'GET') {
	$errors = array();
	
	include __DIR__ . '/show-form.php';
} else {
	// The request is a POST, so validate the form
	$errors = validate_form();
	
	if(count($errors)) {
		// If there were errors, redisplay the form with the errors,
		// preserving defaults
		if(isset($_POST['name'])) {
			$defaults['name'] = $_POST['name'];
		}
		
		if(isset($_POST['age'])) {
			$defaults['age'] = "checked='checked'";
		}
		
		foreach($flavors as $flavor) {
			if(isset($_POST['flavor']) && ($_POST['flavor'] == $flavor)) {
				$defaults['flavor'][$flavor] = "selected='selected'";
			}
		}
		
		include __DIR__ . '/show-form.php';
	} else {
		// The form data was valid, so congratulate the user. In "real life"
		// perhaps here you'd redirect somewhere else or include another
		// file to display
		print 'The form is submitted!';
	}
	
	
	function validate_form() {
		global $flavors;
		
		// Start out with no errors
		$errors = array();
		
		// name is required and must be at least 3 characters
		if(!isset($_POST['name']) && (strlen($_POST['name']) > 3)) {
			$errors['name'] = 'Enter a name of at least 3 letters';
		}
		
		if(isset($_POST['age']) && ($_POST['age'] != '1')) {
			$errors['age'] = 'Invalid age checkbox value.';
		}
		
		// flavor is optional but if submitted must be in $flavors
		if(isset($_POST['flavor']) && (!in_array($_POST['flavor'], $flavors))) {
			$errors['flavor'] = 'Choose a valid flavor.';
		}
		
		return $errors;
	}
}




/*FORM*/
/*show-form.php*/
?>

<form action='<?= htmlentities($_SERVER['SCRIPT_NAME']) ?>' method='post'>
    <dl>
    <dt>Your Name:</dt>
    <?php if (isset($errors['name'])) { ?>
    <dd class="error"><?= htmlentities($errors['name']) ?></dd>
    <?php } ?>
    <dd><input type='text' name='name'
    value='<?= htmlentities($defaults['name']) ?>'/></dd>
    <dt>Are you over 18 years old?</dt>
    <?php if (isset($errors['age'])) { ?>
    <dd class="error"><?= htmlentities($errors['age']) ?></dd>
    <?php } ?>
    <dd><input type='checkbox' name='age' value='1'
    <?= $defaults['age'] ?>/> Yes</dd>
    <dt>Your favorite ice cream flavor:</dt>
    <?php if (isset($errors['flavor'])) { ?>
    <dd class="error"><?= htmlentities($errors['flavor']) ?></dd>
    <?php } ?>
    <dd><select name='flavor'>
    <?php foreach ($flavors as $flavor) { ?>
    <option <?= isset($defaults['flavor'][$flavor]) ?
    $defaults['flavor'][$flavor] :
    "" ?>><?= htmlentities($flavor) ?></option>
    <?php } ?>
    </select></dd>
    </dl>
    <input type='submit' value='Send Info'/>
</form>