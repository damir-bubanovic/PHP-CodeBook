	<!--USE with _BASIC - CAPTCHA - characters.php, image.php, _CAPTCHA - captcha_script.php-->

<?php
session_start();
?>
<html>
<head>
	<title>Guitar Wars - Add Your High Score</title>
	<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
	<h2>Guitar Wars - Add Your High Score</h2>
<?php
/*Database connection and Other constants*/
require_once('appvars.php');
require_once('connectvars.php');

/*I beleve you have to include captcha script here - look this up / not sure*/
/*Or mayby you can output the image file in img src or alternative*/
require_once('');

if (isset($_POST['submit'])) {
	// Connect to the database
	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	// Grab the score data from the POST
	$name = mysqli_real_escape_string($dbc, trim($_POST['name']));
	$score = mysqli_real_escape_string($dbc, trim($_POST['score']));
	$screenshot = mysqli_real_escape_string($dbc, trim($_FILES['screenshot']['name']));
	$screenshot_type = $_FILES['screenshot']['type'];
	$screenshot_size = $_FILES['screenshot']['size'];
	
	/*Check the CAPTCHA pass-phrase for verification - check this again - user submitted*/
	$user_pass_phrase = mysqli_real_escape_string($dbc, trim(password_hash($_POST['verify'], PASSWORD_DEFAULT)));
	if ($_SESSION['pass_phrase'] == $user_pass_phrase) {
	...
	else {
		echo '<p class="error">Please enter the verification pass-phrase exactly as shown.</p>';
	}
}
?>
<hr />
	<form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo GW_MAXFILESIZE; ?>" />
		<label for="name">Name: </label>
		<input type="text" id="name" name="name" value="<?php if (!empty($name)) echo $name; ?>" /><br />
		<label for="score">Score: </label>
		<input type="text" id="score" name="score" value="<?php if (!empty($score)) echo $score; ?>" /><br />
		<label for="screenshot">Screen shot: </label>
		<input type="file" id="screenshot" name="screenshot" /><br />
		<label for="verify">Verification: </label>
		<!--Input field to enter CAPTCHA characters-->
		<input type="text" id="verify" name="verify" value="Enter the pass-phrase." />
		<!--source of the image is the PHP script captcha.php - where the code above is stored-->
		<!--Automaticly returns image in the source with the captcha.php code-->
		<img src="captcha.php" alt="Verification pass-phrase" />
		<hr />
		<input type="submit" value="Add" name="submit" />
	</form>
</body>
</html>
