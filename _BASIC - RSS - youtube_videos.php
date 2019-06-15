	<!--LOOK UP - _BASIC - RSS - youtube video example.php, objects explained.php, _RSS - newsfeed youtube videos.php, _RSS - newsfeed.php-->

<?php 
REST request (REpresentational State Transfer)
- ovo je custom URL koji vodi do određenih resursa na drugoj stranici
- ti konstruiraš URL koji identificira videe koje želiš, a Youtube tada returna info o njima putem XML dokumenta
	☼ ti zapravo queriaš videos

/*Ovo se mijenja i pogledaj moderne načine za ovo*/
/*Gledaj source code za videe i na temelju toga radi*/
/*ovo je temelj za sve youtube videe, tj započinje ovako*/
http://gdata.youtube.com/feeds/api/

/*tražiš videe od određenog korisnika i to favorites (username je custom)*/
http://gdata.youtube.com/feeds/api/users/username/favorites
<!--Primjer:-->
http://gdata.youtube.com/feeds/api/users/elmerpriestley/favorites

/*traži videe u youtube searchu sa određenim keywords*/
/*redosljed keywordsa je bitan, prvi jako, drugi slabije, kao google search, od opcih do specifičnih - igraj se*/
http://gdata.youtube.com/feeds/api/videos/-/keyword1/keyword2/...
<!--Primjer:-->
http://gdata.youtube.com/feeds/api/videos/-/elvis/impersonator
<!--Primjer2:-->
/*Svaki individualni video se onda pojavljuje unutar <entry></entry> tagova*/
/*Video dođe zbrčkani no pogledaj detaljna objašnjenja što pojedini dijelovi koda znače u illustratoru*/
define('YOUTUBE_URL', 'http://gdata.youtube.com/feeds/api/videos/-/alien/abduction/head/first');
$xml = simplexml_load_file(YOUTUBE_URL);

?>