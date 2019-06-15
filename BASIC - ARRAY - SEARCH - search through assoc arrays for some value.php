	<!--LOOK UP each in PHP.net-->

<?php 
/*

!!SEARCH THROUGH ASSOC ARRAY FOR SOME VALUE!!

> ALERT <
	Use foreach instead of while, list and each. Foreach is:
		- easier to read
		- faster
		- not influenced by the array pointer, so it does not need reset()

*/


$arr = array('foo', 'bar');
foreach ($arr as $value) {
    print "The value is $value.";
}

$arr = array('key' => 'value', 'foo' => 'bar');
foreach ($arr as $key => $value) {
    print "Key: $key, value: $value";
}
?>