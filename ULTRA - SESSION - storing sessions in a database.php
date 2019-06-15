<?php 
/*

!!SESSION - STORING SESSIONS IN A DATABASE!!

> want to store session data in a database instead of in files
	>> If multiple web servers all have access to the same database, 
	the session data is then mirrored across all the web servers
	
> Use a class in conjunction with the session_set_save_handler() function to define database-aware routines for session management

*implements - which methods a class must implement, without having to define how these methods are handled
*time - return current Unix timestamp
*parse_url - parses a URL and returns an associative array containing any of the various components of the URL that are present
*isset - determine if a variable is set and is not NULL
*parse_str - parses string as if it were the query string passed via a URL and sets variables in the current scope
*__DIR__ - the directory of the file. If used inside an include, the directory of the included file is returned
*ini_set - sets the value of a configuration option
*session_set_save_handler - sets user-level session storage functions
*session_start - start new or resume existing session
*$_SESSION - associative array containing session variables available to the current script - session variables

*/


/*Database-backed session handler*/
class DBHandler implements SessionHandlerInterface {
	protected $dbh;
	
	
	public function open($save_path, $name) {
		try {
			$this->connect($save_path, $name);
			return true;
		} catch(PDOException $e) {
			return false;
		}
	}
	
	
	public function close() {
		return true;
	}
	
	
	public function destroy($session_id) {
		$sth = $this->dbh->prepare("DELETE FROM sessions WHERE session_id = ?");
		$sth->execute(array($session_id));
	}
	
	
	public function gc($maxlifetime) {
		$sth = $this->dbh->prepare("DELETE FROM sessions WHERE last_update < ?");
		$sth->execute(array(time() - $maxlifetime));
		return true;
	}
	
	
	public function read($session_id) {
		$sth = $this->dbh->prepare("SELECT session_data FROM sessions WHERE session_id = ?");
		$sth->execute(array($session_id));
		$rows = $sth->fetchAll(PDO::FETCH_NUM);
		
		if(count($rows) == 0) {
			return '';
		} else {
			return $rows[0][0];
		}
	}
	
	
	public function write($session_id, $session_data) {
		$now = time();
		$sth = $this->dbh->prepare("UPDATE sessions SET session_data = ?, last_update = ? WHERE sesson_id = ?");
		$sth->execute(array($session_data, $now, $session_id));
		
		if($sth->rowCount() == 0) {
			$sth2 = $this->dbh->prepare("INSERT INTO sessions (session_id, session_data, last_update) VALUES (?, ?, ?)");
			$sth2->execute(array($session_id, $session_data, $now));
		}
	}
	
	
	public function createTable($save_path, $name, $connect = true) {
		
		if($connect) {
			$this->connect($save_path, $name);
		}

?>

CREATE TABLE sessions (
    session_id VARCHAR(64) NOT NULL,
    session_data MEDIUMTEXT NOT NULL,
    last_update TIMESTAMP NOT NULL,
    PRIMARY KEY (session_id)
)

<?php		

		$this->dbh->exec($sql);
	}
	
	
	protected function connect($save_path) {
		/* Look for user and password in DSN as "query string" params */
		$parts = parse_url($save_path);
		
		if(isset($parts['query'])) {
			parse_str($parts['query'], $query);
			$user = isset($query['user']) ? $query['user'] : null;
			$password = isset($query['password']) ? $query['password'] : null;
			
			$dsn = $parts['scheme'] . ':';
			if(isset($parts['host'])) {
				$dsn .= '//' . $parts['host'];
			}
			$dsn .= $parts['path'];
			
			$this->dbh = new PDO($dsn, $user, $password);
		} else {
			$this->dbh = new PDO($save_path);
		}
		
		$this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		// A very simple way to create the sessions table if it doesn't exist.
		try {
			$this->dbh->query("SELECT 1 FROM sessions LIMIT 1");
		} catch(Exception $e) {
			$this->createTable($save_path, NULL, false);
		}
	}
}



/*The session_set_save_handler() function tells PHP to use different functions for
the various session operations such as saving a session and reading session data*/
/*To use this session handler, instantiate the class and pass it to session_set_save_handler()*/
include __DIR__ . '/db.php';

ini_set('session.save_path', 'sqlite:/tmp/sessions.db');

session_set_save_handler(new DBHandler);
session_start();

if(!isset($_SESSION['visits'])) {
	$_SESSION['visits'] = 0;
}
$_SESSION['visits']++;

print 'You have visited here ' . $_SESSION['visits'] . ' times.';

/*This code block assumes that the DBHandler class is defined in a file called db.php in the same directory as itself*/
?>