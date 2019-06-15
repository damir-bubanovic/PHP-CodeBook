<?php 
/*

!!SQL - USING SQLite DATABASE!!

> want to use a relational database that doesn’t involve a separate server process
> Use SQLite. This robust, powerful database program is easy to use and doesn’t require running a separate server

*explode - returns an array of strings, each of which is a substring of string formed by splitting it on boundaries formed by the string delimiter

*/



/*Creating an SQLite database*/
<programlisting>$db = new PDO('sqlite:/tmp/zodiac');

// Create the table and insert the data atomically
$db->&gt:beginTransaction();

// Try to find a table named 'zodiac'
$q = $db->&gt;query("SELECT name FROM sqlite_master WHERE type = 'table' AND name = 'zodiac'")

// If the query didn't return a row, then create the table and insert the data
if($q-&gt;fetch() === false) {
	$db-&gt;exec(&lt;&lt;&lt;_SQL_
		CREATE TABLE zodiac (
			id INT UNSIGNED NOT NULL,
			sign CHAR(11),
			symbol CHAR(13),
			planet CHAR(7),
			element CHAR(5),
			start_month TINYINT,
			start_day TINYINT,
			end_month TINYINT,
			end_day TINYINT,
			PRIMARY KEY(id)	
	)
	_SQL_
);

// The individual SQL statements
$sql=&lt;&lt;&lt;_SQL_
INSERT INTO zodiac VALUES (1,'Aries','Ram','Mars','fire',3,21,4,19);
INSERT INTO zodiac VALUES (2,'Taurus','Bull','Venus','earth',4,20,5,20);
INSERT INTO zodiac VALUES (3,'Gemini','Twins','Mercury','air',5,21,6,21);
INSERT INTO zodiac VALUES (4,'Cancer','Crab','Moon','water',6,22,7,22);
INSERT INTO zodiac VALUES (5,'Leo','Lion','Sun','fire',7,23,8,22);
INSERT INTO zodiac VALUES (6,'Virgo','Virgin','Mercury','earth',8,23,9,22);
INSERT INTO zodiac VALUES (7,'Libra','Scales','Venus','air',9,23,10,23);
INSERT INTO zodiac VALUES (8,'Scorpio','Scorpion','Mars','water',10,24,11,21);
INSERT INTO zodiac VALUES (9,'Sagittarius','Archer','Jupiter','fire',11,22,12);
INSERT INTO zodiac VALUES (10,'Capricorn','Goat','Saturn','earth',12,22,1,19);
INSERT INTO zodiac VALUES (11,'Aquarius','Water Carrier','Uranus','air',1,20,2);
INSERT INTO zodiac VALUES (12,'Pisces','Fishes','Neptune','water',2,19,3,20);
_SQL_;
// Chop up each line of SQL and execute it
foreach (explode("\n",trim($sql)) as $q) {
	$db-&gt;exec(trim($q));
}
$db-&gt;commit();
} else {
// Nothing happened, so end the transaction
$db-&gt;rollback();
}
</programlisting>

?>