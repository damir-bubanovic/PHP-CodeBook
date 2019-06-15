<?php 
/*
!!INTER - OOP - PDO - TUTORIAL (everything you need to know)!!
https://phpdelusions.net/pdo


***** WGY PDO? *****
> Real PDO benefits:
	- security (prepared statements that are usable)
	- usability (many helper functions to automate routine operations)
	- reusability (unified API to access multitude of databases, from SQLite to Oracle)
	
	*For modern web-application use an ORM with a Query Builder, or any other higher level abstraction library, 
	with fallback to vanilla PDO. 
		>> Good ORMs: Eloquent, RedBean, and Yii:AR.
		

		
***** CONNECTING. DSN *****
> input different configuration directives in three different places:
	- database driver, host, db (schema) name and charset, && (port and unix_socket - go into DSN)
	- username and password go to constructor;
	- all other options go into options array.
*/
	mysql:host=localhost;dbname=test;port=3306;charset=utf8
driver^  ^ colon           ^param=value pair  ^semicolon

/*EXAMPLE FOR MYSQL*/
$host = '127.0.0.1';
$db   = 'test';
$user = 'root';
$pass = '';
$charset = 'utf8';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, $user, $pass, $opt);
/*
1. PDO instance is stored in a regular variable -> it can be inaccessible inside functions 
	- one has to make it accessible, by means of passing it via function parameters or 
	using more advanced techniques, such as IoC container
2. The connection has to be made only once! 
	- No connects in every function. No connects in every class constructor. 
	-< Otherwise, multiple connections will be created, which will eventually kill your database server
3. Set charset through DSN
	-< Forget about running SET NAMES query manually, either via query() or PDO::MYSQL_ATTR_INIT_COMMAND
	-< Only if your PHP version is unacceptably outdated (namely below 5.3.6), do you have to use SET NAMES 
	query and always turn emulation mode off
	
	
	
***** ERROR HANDLING. EXCEPTIONS *****
> only proper mode is PDO::ERRMODE_EXCEPTION
*/
$dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );



/*
***** CATCHING PDO EXCEPTIONS *****
> You don't need a try..catch operator to report PDO errors !!!!!
>> Instead, configure your server properly
*/
/*On a development server just turn displaying errors on*/
ini_set('display_errors', 1);
/*While on a production server turn displaying errors off while logging errors on*/
ini_set('display_errors', 0);
ini_set('log_errors', 1);
/*
+> As a result, you will be always notified of all database errors without a single line of extra code
*/
/*
> What if I want something more complex than just showing/logging?
*/
set_exception_handler('myExceptionHandler');
function myExceptionHandler($e) {
    header('HTTP/1.1 500 Internal Server Error', TRUE, 500);
    error_log($e);
    readfile ('500.html');
    exit;
}
/*
> For a more general handling not only exceptions but all errors
*/
set_error_handler("myErrorHandler");
function myErrorHandler($errno, $errstr, $errfile, $errline) {
    error_log("$errstr in $errfile:$errline");
    header('HTTP/1.1 500 Internal Server Error', TRUE, 500);
    readfile("500.html");
    exit;
}
/*
> Here a case when try..catch can be useful?
	- Just use try..catch only if you going to handle the error itself. Say, there is a code to process uploaded images. 
	An error in such processing is not a fatal one and can be handled - so, that's the right place for the try..catch!
**If your error is recoverable and you have a certain scenario to recover - then use try..catch.**
*/
try {
    processUploadedImage($file);
} catch (Exception $e) {
    $formHandlerErrors[] = "There is an error processing uploaded image";
}



/*
***** RUNNING QUERIES. PDO::query() *****
> If no variables are going to be used in the query, you can use the PDO::query() method
*/
$stmt = $pdo->query('SELECT name FROM users');
while ($row = $stmt->fetch()) {
    echo $row['name'] . "\n";
}



/*
***** PREPARED STATEMENTS. Protection from SQL injections *****
> Prepared statement is the only proper way to run a query, if any variable is going to be used in it
	>> In most cases, you need only two functions - prepare() and execute()
	*USE names placeholders, but can use ?*
	- for the named placeholders, it has to be an associative array
*/
$stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email AND status=:status');
$stmt->execute(['email' => $email, 'status' => $status]);
$user = $stmt->fetch();



/*
***** BINDING METHODS *****
> Sometimes it's better to set the data type explicitly
	+ LIMIT clause in emulation mode or any other SQL clause that just cannot accept a string operand.
	+ complex queries with non-trivial query plan that can be affected by a wrong operand type
	+ peculiar column types, like BIGINT or BOOLEAN that require an operand of exact type to be bound 
	** In such a case explicit binding have to be used =>> use bindValue (instead of bindParam) **

> only STING and NUMERIC literals can be bound
	-< For all other cases you cannot use PDO prepared statements at all: neither an identifier, 
	or a comma-separated list, or a part of a quoted string literal or whatever else arbitrary 
	query part cannot be bound using a prepared statement
		*Workarounds can be found in the article*
		
		
		
***** PREPARED STATEMENTS - MULTIPLE EXECUTION *****
> no big benefit, rather perform the same query again and again



***** Running SELECT INSERT, UPDATE, or DELETE statements *****
> typical
*/
$stmt = $pdo->prepare("DELETE FROM goods WHERE category = :feline");
$stmt->execute(['feline => '$cat]);



/*
***** GETTING DATA OUT OF STATEMENT. foreach() *****
> most basic and direct way to get multiple rows from a statement
> this method is memory-friendly, as it doesn't load all the resulting rows in the memory, 
but delivers them one by one
*/
$stmt = $pdo->query('SELECT name FROM users');
foreach ($stmt as $row) {
    echo $row['name'] . "\n";
}



/*
***** GETTING DATA OUT OF STATEMENT. fetch() *****
> fetch modes in PDO
	1) PDO::FETCH_NUM - returns enumerated array
	2) PDO::FETCH_ASSOC - returns associative array
	3) PDO::FETCH_BOTH - both of the above
	4) PDO::FETCH_OBJ - returns object
	5) PDO::FETCH_LAZY - allows all three (numeric associative and object) methods without memory overhead.
	
> When only one row is expected - to get that only row
*/
$row = $stmt->fetch(PDO::FETCH_ASSOC);
/*
> When we need to process the returned data somehow before use
*/
$stmt = $pdo->query('SELECT name FROM users');
while ($row = $stmt->fetch()) {
    echo $row['name'] . "\n";
}



/*
***** GETTING DATA OUT OF STATEMENT. fetchColumn() *****
> Function that returns value of the singe field of returned row. 
	- Very handy when we are selecting only one field
*/
// Getting the name based on id
$stmt = $pdo->prepare("SELECT name FROM table WHERE id=?");
$stmt->execute([$id]);
$name = $stmt->fetchColumn();

// getting number of rows in the table utilizing method chaining
$count = $pdo->query("SELECT count(*) FROM table")->fetchColumn();



/*
***** GETTING DATA OUT OF STATEMENT IN DOZENS DIFFERENT FORMATS. fetchAll() *****
> this function can automate many operations otherwise performed manually
> returns an array that consists of all the rows returned by the query

** GETTING A PLAIN ARRAY **
> Row formatting constants, such as PDO::FETCH_NUM, PDO::FETCH_ASSOC, PDO::FETCH_OBJ etc can change the row format
*/
$data = $pdo->query('SELECT name FROM users')->fetchAll();
var_export($data);
/*
array (
  0 => array('John'),
  1 => array('Mike'),
  2 => array('Mary'),
  3 => array('Kathy'),
)*/

/*
** GETTING A COLUMN **
> very handy to get plain one-dimensional array right out of the query, if only one column out of many rows being fetched
*/
$data = $pdo->query('SELECT name FROM users')->fetchAll(PDO::FETCH_COLUMN);
/* array (
  0 => 'John',
  1 => 'Mike',
  2 => 'Mary',
  3 => 'Kathy',
)*/

/*
** GETTING KEY-VALUE PAIRS **
> when we need to get the same column, but indexed not by numbers in order but by another field
*/
$data = $pdo->query('SELECT id, name FROM users')->fetchAll(PDO::FETCH_KEY_PAIR);
/* array (
  104 => 'John',
  110 => 'Mike',
  120 => 'Mary',
  121 => 'Kathy',
)*/

/*
** GETTING ROWS INDEXED BY UNIQUE FIELD **
> Same as above, but getting not one column but full row, yet indexed by an unique field, thanks to PDO::FETCH_UNIQUE constant
*/
$data = $pdo->query('SELECT * FROM users')->fetchAll(PDO::FETCH_UNIQUE);
/* array (
  104 => array (
    'name' => 'John',
    'car' => 'Toyota',
  ),
  110 => array (
    'name' => 'Mike',
    'car' => 'Ford',
  ),
  120 => array (
    'name' => 'Mary',
    'car' => 'Mazda',
  ),
  121 => array (
    'name' => 'Kathy',
    'car' => 'Mazda',
  ),
)*/

/*
** GETTING ROWS INDEXED BY SOME FIELD **
> PDO::FETCH_GROUP will group rows into a nested array, where indexes will be unique values from the first columns, 
and values will be arrays similar to ones returned by regular fetchAll()
> ideal solution for such a popular demand like "group events by date" or "group goods by category"

- separate boys from girls and put them into different arrays
*/
$data = $pdo->query('SELECT sex, name, car FROM users')->fetchAll(PDO::FETCH_GROUP);
array (
  'male' => array (
    0 => array (
      'name' => 'John',
      'car' => 'Toyota',
    ),
    1 => array (
      'name' => 'Mike',
      'car' => 'Ford',
    ),
  ),
  'female' => array (
    0 => array (
      'name' => 'Mary',
      'car' => 'Mazda',
    ),
    1 => array (
      'name' => 'Kathy',
      'car' => 'Mazda',
    ),
  ),
)



/*
***** GETTING ROW COUNT WITH PDO *****
> You don't need it
> Use this instead

> see if there is any user with such a name
*/
$stmt = $pdo->prepare("SELECT 1 FROM users WHERE name=?");
$stmt->execute([$name]);
$userExists = $stmt->fetchColumn();
/*
> getting either a single row or an array with rows
*/
$data = $pdo->query("SELECT * FROM table")->fetchAll();
if ($data) {
    // You have the data! No need for the rowCount() ever!
}
/*
> count rows in database -> and return the result in a single row
*/
$count = $pdo->query("SELECT count(1) FROM t")->fetchColumn();
/*
In essence:
	+ if you need to know how many rows in the table, use SELECT COUNT(*) query.
	+ if you need to know whether your query returned any data - check that data.
	+ if you still need to know how many rows has been returned by some query 
	(though I hardly can imagine a case), then you can either use rowCount() or 
	simply call count() on the array returned by fetchAll() (if applicable).
*/



/*
***** PREPARED STATEMENTS & LIKE CLAUSE *****
> there are some gotchas -> LIKE clause

1) this produces error
*/
$stmt = $pdo->prepare("SELECT * FROM table WHERE name LIKE '%?%'");
/*
2) this is the solution
	-  when working with LIKE, we have to prepare our complete literal first, 
	and then send it to the query the usual way
*/
$search = "%$search%";
$stmt  = $pdo->prepare("SELECT * FROM table WHERE name LIKE ?");
$stmt->execute([$search]);
$data = $stmt->fetchAll();



/*
***** PREPARED STATEMENTS & IN CLAUSE *****
> one must create a set of ?s manually and put them into the query
*/
$arr = [1,2,3];
$in  = str_repeat('?,', count($arr) - 1) . '?';
$sql = "SELECT * FROM table WHERE column IN ($in)";
$stm = $db->prepare($sql);
$stm->execute($arr);
$data = $stm->fetchAll();



/*
***** PREPARED STATEMENTS & TABLE NAMES *****
> PDO has no placeholder for identifiers (table and field names), so a developer must manually format them
> For mysql to format an identifier, follow these two rules:
	+ Enclose identifier in backticks.
	+ Escape backticks inside by doubling them
1) Like this
*/
$table = "`".str_replace("`","``",$table)."`";
/*
2) Also important to always check dynamic identifiers against a list of allowed values
*/
$orders  = ["name","price","qty"]; //field names
$key     = array_search($_GET['sort'],$orders); // see if we have such a name
$orderby = $orders[$key]; //if not, first one will be set automatically. smart enuf :)
$query   = "SELECT * FROM `table` ORDER BY $orderby"; //value is safe
/*
3) Extending this approach for the INSERT/UPDATE statements
*/
$data = ['name' => 'foo','submit' => 'submit']; // data for insert
$allowed = ["name","surname","email"]; // allowed fields
$values = [];
$set = "";
foreach ($allowed as $field) {
    if (isset($data[$field])) {
        $set.="`".str_replace("`","``",$field)."`". "=:$field, ";
        $values[$field] = $source[$field];
    }
}
$set = substr($set, 0, -2); 
/*
> code will produce correct sequence for SET operator that will contain only allowed fields and placeholders
> as well as $values array for execute(), which can be used like this
*/
$stmt = $pdo->prepare("INSERT INTO users SET $set");
$stmt->execute($values);



/*
***** PROBLEM WITH LIMIT CLAUSE *****
> bind these variables explicitly while setting the proper param type
*/
$stmt = $pdo->prepare('SELECT * FROM table LIMIT ?, ?');
$stmt->bindParam(1, $offset,PDO::PARAM_INT);
$stmt->bindParam(2, $limit,PDO::PARAM_INT);
$stmt->execute();
$data = $stmt->fetchAll();
/*
> One peculiar thing about PDO::PARAM_INT: for some reason it does not enforce the type casting. 
Thus, using it on a number that has a string type will cause the aforementioned error:
	>> But change "1" in the example to 1 - and everything will go smooth.
*/
$stmt = $pdo->prepare("SELECT 1 LIMIT ?");
$stmt->bindValue(1, "1", PDO::PARAM_INT);
$stmt->execute();



/*
***** CALLING STORED PROCEDURES IN PDO *****
> every stored procedure always returns one extra result set
	- one (or many) results with actual data and one just empty
> Thus, after calling a stored procedure that is intended to return only one result set, 
just call PDOStatement::nextRowset()
*/
$stmt = $pdo->prepare("CALL bar()");
$stmt->execute();
$data = $stmt->fetchAll();
$stmt->nextRowset();
/*
> While for the stored procedures
*/
$stmt = $pdo->prepare("CALL foo()");
$stmt->execute();
do {
    $data = $stmt->fetchAll();
    var_dump($data);
} while ($stmt->nextRowset() && $stmt->columnCount());



/*
***** RUNNING MULTIPLE QUERIES WITH PDO *****
> When in emulation mode, PDO can run mutiple queries in the same statement
*/
$stmt = $pdo->prepare("SELECT ?;SELECT ?");
$stmt->execute([1,2]);
do {
    $data = $stmt->fetchAll();
    var_dump($data);
} while ($stmt->nextRowset());



/*
***** MYSQLND & BUFFERING QUERIES. HUGE DATASETS *****
> But with mysqlnd things got changed, and the resultset returned by the buffered query will be count 
towards both memory_get_usage() and memory_limit, no matter which way you choose to get the result
*/
$pdo->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, FALSE);
$stmt = $pdo->query("SELECT * FROM Board");
$mem = memory_get_usage();
while($row = $stmt->fetch());
echo "Memory used: ".round((memory_get_usage() - $mem) / 1024 / 1024, 2)."M\n";

$pdo->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, TRUE);
$stmt = $pdo->query("SELECT * FROM Board");
$mem = memory_get_usage();
while($row = $stmt->fetch());
echo "Memory used: ".round((memory_get_usage() - $mem) / 1024 / 1024, 2)."M\n";
/*
> will give you (for my data)
Memory used: 0.02M
Memory used: 2.39M
> which means that with buffered query the memory is consumed even if you're fetching rows one by one!

!! So, keep in mind that if you are selecting a really huge amount of data, always set PDO::MYSQL_ATTR_USE_BUFFERED_QUERY to FALSE. !!

DRAWBACK OF THIS METHOD
> While an unbufferered query is active, you cannot execute any other query. So, use this mode wisely
*/




/*
***** SANITIZE UZER INPUT *****
*/
$stmt->bindParam(':animal_id', $animal_id, PDO::PARAM_INT);
$stmt->bindParam(':animal_name', $animal_name, PDO::PARAM_STR, 5);
$stmt->bindParam(':id', $id, PDO::PARAM_INT); // <-- Automatically sanitized for SQL by PDO
$stmt->bindParam(':name', $name, PDO::PARAM_STR); // <-- Automatically sanitized for SQL by PDO



?>
