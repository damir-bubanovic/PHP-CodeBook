<?php 
/*

!!INTER & LOCAL - LOCALIZING INCLUDED FILES!!

> want to include locale-specific files in your pages

> Modify include_path once you’ve determined the appropriate locale

*ini_get - gets the value of a configuration option
*ini_set - sets the value of a configuration option

*/


/*Modifying include_path for localization*/
$base = '/usr/local/php-include';
$locale = 'en_US';
$include_path = ini_get('include_path');
ini_set('include_path', "$base/$locale:$base/global:$include_path");

/*$base variable holds the name of the base directory for your included localized files. 
Files that are not locale-specific go in the global subdirectory of $base, and locale-specific 
files go in a subdirectory named after their locale (e.g., en_US)*/

/*For maximum utility, reset include_path as early as possible in your code, preferably at 
the top of a file loaded via auto_prepend_file on every request*/

?>