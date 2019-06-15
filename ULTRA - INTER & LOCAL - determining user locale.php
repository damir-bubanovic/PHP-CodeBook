<?php 
/*

!!INTER & LOCAL - DETERMINING THE USER'S LOCALE!!

> want to use the correct locale as specified by a user’s web browser

*isset - determine if a variable is set and is not NULL
*$_SERVER - array containing information such as headers, paths, and script locations,
			server and execution environment information

*/


/*Pass the incoming Accept-Language HTTP header value to the Locale::accept
FromHttp() function to get the proper locale identifier*/
if(isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
	$localeToUse = Locale::acceptFromHttp($_SERVER['HTTP_ACCEPT_LANGUAGE']);
} else {
	$localeToUse = Locale::getDegault();
}

?>