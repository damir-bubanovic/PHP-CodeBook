	<!--LOOK UP array_unshift on PHP.net-->

<?php 
/*

!!PRESERVE KEYS & UNSHIFT ARRAY WITH NUMERICAL INDEXES!!

*/


$someArray=array(224=>'someword1', 228=>'someword2', 102=>'someword3', 544=>'someword3',95=>'someword4'); 

$someArray=array(100=>'Test Element 1 ',255=>'Test Element 2')+$someArray; 

/*
array( 
100=>'Test Element 1 ', 
255=>'Test Element 2' 
224=>'someword1', 
228=>'someword2', 
102=>'someword3', 
544=>'someword3', 
95=>'someword4' 
);
*/
?>