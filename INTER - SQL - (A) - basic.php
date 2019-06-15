<?php 
/*

!!SQL - DATABASES!!

> Typical PHP programs capture information from HTML form fields and store that information in the database. 
	>> Some characters, such as the apostrophe and backslash, have special meaning in SQL, so you have to 
	be careful if your form data contains those characters

*/

/*The SQL database examples in this chapter use PHP 5’s PDO database access layer*/



/*Sample table structure*/
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
);


/*Sample table data*/
INSERT INTO zodiac VALUES (1,'Aries','Ram','Mars','fire',3,21,4,19);
INSERT INTO zodiac VALUES (2,'Taurus','Bull','Venus','earth',4,20,5,20);
INSERT INTO zodiac VALUES (3,'Gemini','Twins','Mercury','air',5,21,6,21);
INSERT INTO zodiac VALUES (4,'Cancer','Crab','Moon','water',6,22,7,22);
INSERT INTO zodiac VALUES (5,'Leo','Lion','Sun','fire',7,23,8,22);
INSERT INTO zodiac VALUES (6,'Virgo','Virgin','Mercury','earth',8,23,9,22);
INSERT INTO zodiac VALUES (7,'Libra','Scales','Venus','air',9,23,10,23);
INSERT INTO zodiac VALUES (8,'Scorpio','Scorpion','Mars','water',10,24,11,21);
INSERT INTO zodiac VALUES (9,'Sagittarius','Archer','Jupiter','fire',11,22,12,21);
INSERT INTO zodiac VALUES (10,'Capricorn','Goat','Saturn','earth',12,22,1,19);
INSERT INTO zodiac VALUES (11,'Aquarius','Water Carrier','Uranus','air',1,20,2,18);
INSERT INTO zodiac VALUES (12,'Pisces','Fishes','Neptune','water',2,19,3,20);
?>