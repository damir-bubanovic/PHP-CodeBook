<?php 
/*

!!SQL - MODIFYING DATA IN AN SQL DATABASE!!

> want to add, remove, or change data in an SQL database

*/


/*Use PDO::exec() to send an INSERT, DELETE, or UPDATE command*/
/*Using PDO::exec()*/
$db->exec("INSERT INTO family (id, name) VALUES (1, 'Vito')");
$db->exec("DELETE FROM family WHERE name LIKE 'Frodo'");
$db->exec("UPDATE family SET is_naive = 1 WHERE name LIKE 'Key'");


/*Prepare a query with PDO::prepare() and execute it with PDOState ment::execute()*/
/*Preparing and executing a query*/
$st = $db->prepare("INSERT INTO family (id, name) VALUES (?, ?)");
$st->execute(array(1, 'Vito'));
$st = $db->prepare("DELETE FROM family WHERE name LIKE ?");
$st->execute(array('Fredo'));
$st = $db->prepare("UPDATE family SET is_naive = ? WHERE name LIKE ?");
$st->execute(array(1, 'Kay'));


/*The prepare() and execute() methods are especially useful for queries that you want
to execute multiple times. Once you’ve prepared a query, you can execute it with new
values without repreparing it*/
/*Reusing a prepared statement*/
$st = $db->prepare("DELETE FROM family WHERE name LIKe ?");
$st->execute(array('Fredo'));
$st->execute(array('Sony'));
$st->execute(array('Lucas'));

?>