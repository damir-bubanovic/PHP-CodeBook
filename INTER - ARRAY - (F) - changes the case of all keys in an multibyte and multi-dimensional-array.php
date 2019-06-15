	<!--LOOK UP array_change_key_case on PHP.net-->

<?php 
/*multibyte and multi-dimensional-array*/
    define('ARRAY_KEY_FC_LOWERCASE', 25); //FOO => fOO
    define('ARRAY_KEY_FC_UPPERCASE', 20); //foo => Foo
    define('ARRAY_KEY_UPPERCASE', 15); //foo => FOO
    define('ARRAY_KEY_LOWERCASE', 10); //FOO => foo
    define('ARRAY_KEY_USE_MULTIBYTE', true); //use mutlibyte functions
    
    /**
    * change the case of array-keys
    *
    * use: array_change_key_case_ext(array('foo' => 1, 'bar' => 2), ARRAY_KEY_UPPERCASE);
    * result: array('FOO' => 1, 'BAR' => 2)
    *
    * @param    array
    * @param    int
    * @return     array
    */
    function array_change_key_case_ext(array $array, $case = 10, $useMB = false, $mbEnc = 'UTF-8') {
        $newArray = array();
        
        //for more speed define the runtime created functions in the global namespace
        
        //get function
        if($useMB === false) {
            $function = 'strToUpper'; //default
            switch($case) {
                //first-char-to-lowercase
                case 25:
                    //maybee lcfirst is not callable
                    if(!function_exists('lcfirst')) 
                        $function = create_function('$input', '
                            return strToLower($input[0]) . substr($input, 1, (strLen($input) - 1));
                        ');
                    else $function = 'lcfirst';
                    break;
                
                //first-char-to-uppercase                
                case 20:
                    $function = 'ucfirst';
                    break;
                
                //lowercase
                case 10:
                    $function = 'strToLower';
            }
        } else {
            //create functions for multibyte support
            switch($case) {
                //first-char-to-lowercase
                case 25:
                    $function = create_function('$input', '
                        return mb_strToLower(mb_substr($input, 0, 1, \'' . $mbEnc . '\')) . 
                            mb_substr($input, 1, (mb_strlen($input, \'' . $mbEnc . '\') - 1), \'' . $mbEnc . '\');
                    ');
                    
                    break;
                
                //first-char-to-uppercase
                case 20:
                    $function = create_function('$input', '
                        return mb_strToUpper(mb_substr($input, 0, 1, \'' . $mbEnc . '\')) . 
                            mb_substr($input, 1, (mb_strlen($input, \'' . $mbEnc . '\') - 1), \'' . $mbEnc . '\');
                    ');
                    
                    break;
                
                //uppercase
                case 15:
                    $function = create_function('$input', '
                        return mb_strToUpper($input, \'' . $mbEnc . '\');
                    ');
                    break;
                
                //lowercase
                default: //case 10:
                    $function = create_function('$input', '
                        return mb_strToLower($input, \'' . $mbEnc . '\');
                    ');
            }
        }
        
        //loop array
        foreach($array as $key => $value) {
            if(is_array($value)) //$value is an array, handle keys too
                $newArray[$function($key)] = array_change_key_case_ex($value, $case, $useMB);
            elseif(is_string($key))
                $newArray[$function($key)] = $value;
            else $newArray[$key] = $value; //$key is not a string
        } //end loop
        
        return $newArray;
    }

?>