<?php 
/*

!!LDAP - USING LDAP FOR USER AUTHENTIFICATION!!

> want to restrict parts of your site to authenticated users. 
	>> Instead of verifying people against a database or using HTTP Basic Authorization, 
	you want to use an LDAP server

> LDAP servers are designed for address storage, lookup, and retrieval, and so are better
to use than standard databases like MySQL or Oracle (LDAP are very fast)

*htmlentities - convert all applicable characters to HTML entities

*/


/*Use PEAR’s Auth class, which supports LDAP authentication*/
$options = array(
	'host'		=>	'ldap.example.com',
	'base'		=>	'389',
	'userattr'	=>	'uid'
);

$auth = new Auth('LDAP', $options);

// begin validation
// print login screen for anonymous users
$auth->start();

if($auth->getAuth()) {
	// content for validated users
} else {
	// content for anonymous users
}

// log users out
$auth->logout();


/*The Auth::auth() method also takes an optional third parameter—the name 
of a function that displays the sign-in form.*/
$options = array(
	'host' => 'ldap.example.com',
	'port' => '389',
	'base' => 'o=Example Inc., c=US',
	'userattr' => 'uid'
);

function pc_auth_ldap_signin() {
	$action = htmlentities($_SERVER['PHP_SELF']);
	print<<<_HTML_
<form method="post" action="$action">
	Name: <input name="username" type="text"><br />
	Password: <input name="password" type="password"><br />
<input type="submit" value="Sign In">
</form>
_HTML_;
}

$auth = new Auth('LDAP', $options, 'pc_auth_ldap_signin');

/*Once the Auth object is instantiated, authenticate a user by calling Auth::start():*/
$auth->start();

/*Search username*/
$options['userattr'] = $_POST['username'];


/*You can call Auth::getAuth() to return a boolean value describing a user’s status*/
if ($auth->getAuth()) {
	print 'Welcome member! Nice to see you again.';
} else {
	print 'Welcome guest. First time visiting?';
}

?>