	<!--LOOK UP - PHP relative path in Google-->

	
<!--index.php (head.php is in pages folder)-->
<?php include(ROOT_DIR.'/pages/head.php'); ?> <!--old code-->
<!--OR-->
<?php include($_SERVER["DOCUMENT_ROOT"] . '/pages/head.php'); ?> <!--new code A-->
<!--OR-->
<?php include(dirname(__FILE__) . '/pages/head.php'); ?> <!--new code B - best option use like html code-->



<!--Put everything static in head to head.php like scripts, google analytics...-->
<head>
<!--HTML Head code - head.php-->
	<!--calling seo function with values, make sure filename.php in root dir matches meta array element names-->
	<title>Jezični atelier - <?php seo($filename, 'title'); ?></title>
	<meta name="description" content="<?php seo($filename, 'description'); ?>" />
	<meta name="keywords" content="<?php seo($filename, 'keywords'); ?>" />
</head>


<?php
/*PHP code - seo.php*/
/*make sure meta array element names matches filename.php in root dir*/
$meta = array(
	/*we have array inside of array*/
	'druzenja-petkom' => array(
		title => 'Druženja petkom',
		description => 'Didaktička druženja petkom, utvrđivanje gradiva, francuski filmovi, didaktičke igre',
		keywords => 'atelier, škola stranih jezika, tečaj,  kulturni centar, francuski, francuski jezik, radionice, francuska kultura, druženje, petak, francuski film, didaktičke igre',
	),
	'prijevodi' => array(
		title => 'Kvalitetni prijevodi tekstova strani jezik i hrvatski',
		description => 'Prijevodi tekstova sa stranog jezika na hrvatski i obratno',
		keywords => 'atelier, škola stranih jezika, tečaj,  kulturni centar, francuski, francuski jezik, radionice, francuska kultura',
	),
	'galerija' => array(
		title => 'Galerija slika',
		description => 'Galerija slika, Atelier u nastajanju',
		keywords => 'atelier, škola stranih jezika, tečaj,  kulturni centar, francuski, francuski jezik, radionice, francuska kultura, galerija, slike',
	),
	/*............ For every page*/
	
	/*default value at bottom, the rest are specific for different pages*/
	'default' => array(
		title => 'Tečajevi: francuski, ruski, španjolski, engleski, norveški, talijanski, poslovni, pravni, turistički, individualni, hrvatski za strance',
		description => 'tečaj, francuski, ruski, španjolski, engleski, norveški, talijanski, poslovni, pravni, turistički, individualni, hrvatski za strance, opći, opći poslovni, pravni, turistički, individualni, hrvatski za strance, DELF, za umirovljenike, pripreme za maturu',
		keywords => 'atelier, škola stranih jezika, tečaj,  kulturni centar, francuski, francuski jezik, radionice, francuska kultura',
	),
);

/*custom seo function - 2 parameters $filename & $element*/
function seo($filename, $element){
	/*global variable meta defined outside seo function*/
	global $meta;
	/*if page has defined filename use specific meta array element*/
	if ( isset($meta[$filename][$element]) ){
		print $meta[$filename][$element];
	} else{
		print $meta['default'][$element];
	}
}
?>