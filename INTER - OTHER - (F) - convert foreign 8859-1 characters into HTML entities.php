	<!--LOOK UP _BASIC - string replace.php-->

<?php 
/*Work on this a little bit more*/

function convert_chars_to_entities( $str ) { 
    $str = str_replace( 'À', '&#192;', $str ); 
    $str = str_replace( 'Á', '&#193;', $str ); 
    $str = str_replace( 'Â', '&#194;', $str ); 
    $str = str_replace( 'Ã', '&#195;', $str ); 
    $str = str_replace( 'Ä', '&#196;', $str ); 
    $str = str_replace( 'Å', '&#197;', $str ); 
    $str = str_replace( 'Æ', '&#198;', $str ); 
    $str = str_replace( 'Ç', '&#199;', $str ); 
    $str = str_replace( 'È', '&#200;', $str ); 
    $str = str_replace( 'É', '&#201;', $str ); 
    $str = str_replace( 'Ê', '&#202;', $str ); 
    $str = str_replace( 'Ë', '&#203;', $str ); 
    $str = str_replace( 'Ì', '&#204;', $str ); 
    $str = str_replace( 'Í', '&#205;', $str ); 
    $str = str_replace( 'Î', '&#206;', $str ); 
    $str = str_replace( 'Ï', '&#207;', $str ); 
    $str = str_replace( 'Ð', '&#208;', $str ); 
    $str = str_replace( 'Ñ', '&#209;', $str ); 
    $str = str_replace( 'Ò', '&#210;', $str ); 
    $str = str_replace( 'Ó', '&#211;', $str ); 
    $str = str_replace( 'Ô', '&#212;', $str ); 
    $str = str_replace( 'Õ', '&#213;', $str ); 
    $str = str_replace( 'Ö', '&#214;', $str ); 
    $str = str_replace( '×', '&#215;', $str );  // Yeah, I know.  But otherwise the gap is confusing.  --Kris 
    $str = str_replace( 'Ø', '&#216;', $str ); 
    $str = str_replace( 'Ù', '&#217;', $str ); 
    $str = str_replace( 'Ú', '&#218;', $str ); 
    $str = str_replace( 'Û', '&#219;', $str ); 
    $str = str_replace( 'Ü', '&#220;', $str ); 
    $str = str_replace( 'Ý', '&#221;', $str ); 
    $str = str_replace( 'Þ', '&#222;', $str ); 
    $str = str_replace( 'ß', '&#223;', $str ); 
    $str = str_replace( 'à', '&#224;', $str ); 
    $str = str_replace( 'á', '&#225;', $str ); 
    $str = str_replace( 'â', '&#226;', $str ); 
    $str = str_replace( 'ã', '&#227;', $str ); 
    $str = str_replace( 'ä', '&#228;', $str ); 
    $str = str_replace( 'å', '&#229;', $str ); 
    $str = str_replace( 'æ', '&#230;', $str ); 
    $str = str_replace( 'ç', '&#231;', $str ); 
    $str = str_replace( 'è', '&#232;', $str ); 
    $str = str_replace( 'é', '&#233;', $str ); 
    $str = str_replace( 'ê', '&#234;', $str ); 
    $str = str_replace( 'ë', '&#235;', $str ); 
    $str = str_replace( 'ì', '&#236;', $str ); 
    $str = str_replace( 'í', '&#237;', $str ); 
    $str = str_replace( 'î', '&#238;', $str ); 
    $str = str_replace( 'ï', '&#239;', $str ); 
    $str = str_replace( 'ð', '&#240;', $str ); 
    $str = str_replace( 'ñ', '&#241;', $str ); 
    $str = str_replace( 'ò', '&#242;', $str ); 
    $str = str_replace( 'ó', '&#243;', $str ); 
    $str = str_replace( 'ô', '&#244;', $str ); 
    $str = str_replace( 'õ', '&#245;', $str ); 
    $str = str_replace( 'ö', '&#246;', $str ); 
    $str = str_replace( '÷', '&#247;', $str );  // Yeah, I know.  But otherwise the gap is confusing.  --Kris 
    $str = str_replace( 'ø', '&#248;', $str ); 
    $str = str_replace( 'ù', '&#249;', $str ); 
    $str = str_replace( 'ú', '&#250;', $str ); 
    $str = str_replace( 'û', '&#251;', $str ); 
    $str = str_replace( 'ü', '&#252;', $str ); 
    $str = str_replace( 'ý', '&#253;', $str ); 
    $str = str_replace( 'þ', '&#254;', $str ); 
    $str = str_replace( 'ÿ', '&#255;', $str ); 
    
    return $str; 
}
?>