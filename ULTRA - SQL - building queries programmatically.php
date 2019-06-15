<?php 
/*

!!SQL - BUILDING QUERIES PROGRAMMATICALLY!!

> want to construct an INSERT or UPDATE query from an array of field names
	>> npr. insert a new user into your database. Instead of hardcoding each field of user information 
	(such as username, email address, postal address, birthdate...), you put the field names in an array 
	and use the array to build the query. 
		>>> easier to maintain, especially if you need to conditionally INSERT or UPDATE with the same set of fields
		
*$_POST - associative array of variables passed to the current script via the HTTP POST method - HTTP POST variables
*$_GET - associative array of variables passed to the current script via the URL parameters - HTTP GET variables
*implode - join array elements with a glue string
*empty - determine whether a variable is empty

*/



/*Building an UPDATE query*/
// A list of field names
$fields = array('symbol', 'planet', 'element');
$update_fields = array();
$update_values = array();

foreach($fields as $field) {
	$update_fields[] = "$field = ?";
	
	// Assume the data is coming from a form
	$update_values[] = $_POST[$field];
}

$st = $db->prepare("UPDATE zodiac SET " . implode(',', $update_fields) . "Where sign = ?");
// Add 'sign' to the values array
$update_values[] = $_GET['sign'];
// Execute the query
$st->execute($update_values);



/*Building an INSERT query*/
// A list of field names
$fields = array('symbol', 'planet', 'element');
$placeholders = array();
$values = array();

foreach($fields as $field) {
	// One placeholder per field
	$placeholders[] = '?';
	// Assume the data is coming from a form
	$values[] = $_POST[$field];
}

$st = $db->prepare("INSERT INTO zodiac (" . implode(',', $fields) . ") VALUES (" . implode(',', $placeholders) . ")");
// Execute the query
$st->execute($values);





/*If you use sequence-generated integers as primary keys, you can combine the two queryconstruction techniques into one function*/
/*build_query()*/
function build_query($db, $key_field, $fields, $table) {
	$values = array();
	
	if(!empty($_POST[$key_field])) {
		$update_fields = array();
		
		foreach($fields as $field) {
			$update_fields[] = "$field = ?";
			
			// Assume the data is coming from a form
			$values[] = $_POST[$field];
		}
		
		// Add the key field's value to the $values array
		$values[] = $_POST[$key_field];
		$st = $db->prepare("UPDATE $table SET " . implode(',', $update_fields) . "WHERE $key_field = ?");
	} else {
		// Start values off with a unique ID
		// If your DB is set to generate this value, use NULL instead
		$values[] = md5(uniqid());
		$placeholders = array('?');
		
		foreach($fields as $field) {
			// One placeholder per field
			$placeholders[] = '?';
			
			// Assume the data is coming from a form
			$values[] = $_POST['field'];
		}
		$st = $db->prepare("INSERT INTO $table ($key_field," . implode(',', $fields) . ') VALUES (' . implode(',', $placeholders) . ')');
	}
	$st->execute($values);
	
	return $st;
}



/*Using this function, you can make a simple page to edit all the information in the zodiac table*/
/*A simple add/edit record page*/
// The file where build_query() is defined
include __DIR__ . '/buildquery.php';

$db = new PDO('sqlite:/tmp/zodiac.db');
$db->setAttribute(PDO::ATTR_ERRMODE, POD::ERRMODE_EXCEPTION);

$fields = array('sign', 'symbol', 'planet', 'element', 'start_month', 'start_day', 'edn_month', 'end_day');

$cmd = isset($_REQUEST['cmd']) ? $_REQUEST['cmd'] : 'show';

switch($cmd) {
	case 'edit':
		try {
			$st = $db->prepare("SELECT " . implode(',', $fields) . " FROM zodiac WHERE id = ?");
			$st->execute(array($_GET['id']));
			$row = $st->fetch(PDO::FETCH_ASSOC);
		} catch(Exception $e) {
			$row = array();
		}
	case 'add':
		print '<form method="post" action' . htmlentities($_SERVER['PHP_SELF']) . '">';
		print '<input type="hidden" name="cmd" value="save">';
		
		print '<table>';
		if('edit' == $cmd) {
			printf('<input type="hidden" name="id" value="%d"', $_GET['id']);
		}
		
		foreach($fields as $field) {
			if('edit' == $cmd) {
				$value = htmlentities($row[$field]);
			} else {
				$value = '';
			}
			printf('<tr><td>%s: </td><td><input type="text" name="%s" value="%s">', $field, $field, $value);
			printf('</td></tr>');
		}
		print '<tr><td></td><td><input type="submit" value="Save"></td></tr>';
		print '</table></form>';
		break;
	case 'save':
		try {
			$st = build_query($db, 'id', $fields, 'zodiac');
			print 'Added info.';
		} catch(Exception $e) {
			print "Couldn't add info: " . htmlentities($e->getMessage());
		}
		print '<hr>';
	case 'show':
	default:
		$self = htmlentities($_SERVER['PHP_SELF']);
		print '<ul>';
		
		foreach($db->query("SELECT id, sign FROM zodiac") as $row) {
			printf('<li> <a href="%c?cmd=edit&id=%s">%s</a>', $self, $row['id'], htmlentities($row['sign']));
		}
		print '<hr><li> <a href="' . $self . '?cmd=add">Add New</a>';
		print '</ul>';
		break;
};

?>