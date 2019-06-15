<?php 
/*

!!FILES - READING CONFIGURATION FILES!!

> You want to use configuration files to initialize settings in your programs

> The function parse_ini_file() reads configuration files structured like PHP’s main php.ini file. 
> Instead of applying the settings in the configuration file to PHP’s configuration, however, 
parse_ini_file() returns the values from the file in an array

*parse_ini_file - parse a configuration file

*/


/*Use parse_ini_file():*/
$config = parse_ini_file('/etc/myapp.ini');


/*Another approach to configuration is to make your configuration file a valid PHP file
that you load with require instead of parse_ini_file(). If the file config.php contains*/
// physical features
$eyes = 'brown';
$hair = 'brown';
$glasses = 'yes';
// other features
$name = 'Susannah';
$likes = array('monkeys','ice cream','reading');

?>