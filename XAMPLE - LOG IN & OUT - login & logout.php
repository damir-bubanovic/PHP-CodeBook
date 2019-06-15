<!--login.php-->
<?php 
session_start();

/*MySQL database connect variables*/
include('connectvars.php');

$username = $_POST['username'];
$password = $_POST['password'];

/*if username & password are true - if condition in parentasis is true!*/
if($username && $password) {
	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die('Can not connect to database!');
	/* * - select all data*/
	$query = "SELECT * FROM users WHERE username='$username'";
	$data = mysqli_query($dbc, $query) or die('Can not query database!');
	
	$numbrows = mysqli_num_rows();
	/*if there are rows of data matching user input*/
	if($numbrows != 0) {
		/*loop throug every rows and see if the password matches user input*/
		while($row = mysqli_fetch_assoc($query)) {
			$dbusername = $row['username'];
			$dbpassword = row['password'];
		}
		/*if username and password both match user input*/
		if($username == $dbusername && $password == $dbpassword) {
			/*link for members page*/
			print '<p>You are in! <a href="member.php">Click</a> here to enter member page</p>';
			/*session username for the welcome message in member.php*/
			$_SESSION['username'] = $username;
		} else {
			print '<p>Incorrect password</p>';
		}
	} else {
		print '<p>Tha user does not exist!</p>';
	}
	
	mysqli_close($dbc);
} else {
	print '<p>Please enter username & password!</p>';
}
?>


<!--HTML form in login.php-->
<form action="login.php" method="POST"><!--Redirect to login.php-->
	Username: <input type="text" name="username"><br />
	Password: <input type="password" name="password"><br />
	<input type="submit" value="Log in">
</form>


<!--member.php-->
<?php 
session_start();
/*welcome message for the member*/
print '<p>Welcome ' . $_SESSION['username'] . '!</p>';
?>

<!--logout.php-->
<?php 
session_start();

if($_SESSION['username']) {
	print '<p>Welcome, ' . $_SESSION['username'] . '!</p><br /><a href="index.php">Click</a> here to return</p>';
} else {
	die('You must be logged in!');
}

session_destroy();
?>