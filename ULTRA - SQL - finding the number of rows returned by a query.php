<?php 
/*

!!SQL - FINDING THE NUMBER OF ROWS RETURNED BY A QUERY!!

> want to know how many rows a SELECT query returned, or you want to know how many rows an INSERT, UPDATE, or DELETE query changed

> If you’re issuing an INSERT, UPDATE, or DELETE with PDO::exec(), the return value from exec() is the number of modified rows.
> If you’re issuing an INSERT, UPDATE, or DELETE with PDO::prepare() and PDOState ment::execute(), call PDOStatement::rowCount() 
to get the number of modified rows

*count - count all elements in an array, or something in an object

*/


/*Counting rows with rowCount()*/
$st = $db->prepare("DELETE FROM family WHERE name LIKE ?");

$st->execute(array('Frodo'));
print 'Deleted rows: ' . $st->rowCount();

$st->execute(array('Sonny'));
print 'Deleted rows: ' . $st->rowCount();

$st->execute(array('Luca Brasi'));
print "Deleted rows: " . $st->rowCount();



/*If you’re issuing a SELECT statement, the only foolproof way to find out how many rows are returned is 
to retrieve them all with fetchAll() and then count how many rows you have*/
/*Counting rows from a SELECT*/
$st = $db->query("SELECT symbol, planet FROM zodiac");
$all = $st->fetchAll(PDO::FETCH_COLUMN, 1);
print 'Retrieved ' . count($all) . ' rows';

?>