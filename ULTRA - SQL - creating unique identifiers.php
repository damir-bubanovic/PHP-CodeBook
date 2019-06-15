<?php 
/*

!!SQL - CREATING UNIQUE IDENTIFIERS!!

> want to assign unique IDs to users, articles, or other objects as you add them to your database

> Use PHP’s uniqid() function to generate an identifier. 
	>> To restrict the set of characters in the identifier, pass it through md5(), which returns a 
	string containing only numerals and the letters a through f
	
> You can also use a database-specific method to have the database generate the ID. 
	npr. SQLite 3 and MySQL support AUTOINCREMENT columns that automatically assign increasing integers to a column as rows are inserted
	
*uniqid - generate a unique ID (not very good)
*md5 - calculate the md5 hash of a string

*/


/*Creating unique identifiers*/
$st = $db->prepare("INSERT INTO users (id, name) VALUES (?, ?)");
$st->execute(array(uniqid(), 'Jacob'));
$st->execute(array(md5(uniqid()), 'Ruby'));


/*Creating an auto-increment column with MySQL*/
// the AUTO_INCREMENT tells MySQL to assign ascending IDs
// that column must be the PRIMARY KEY
$db->exec(<<<_SQL_
CREATE TABLE users (
id INT NOT NULL AUTO_INCREMENT,
name VARCHAR(255),
PRIMARY KEY(id)
)
_SQL_
);
// No need to insert a value for 'id' -- MySQL assigns it
$st = $db->prepare('INSERT INTO users (name) VALUES (?)');
// These rows are assigned 'id' values
foreach(array('Jacob','Ruby') as $name) {
	$st->execute(array($name));
}

?>