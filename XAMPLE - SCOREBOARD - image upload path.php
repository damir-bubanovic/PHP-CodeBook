<?php 
   /*Define the upload path i maximum file size constants*/
   /*first define / constant - to send images from temp folder to images folder that you created*/
   /*second define / constant - file size 32kb*/
   /*The best way is to store constants in include files (require once('appgw')), and per use called upon*/
   /*In this way we can share constants among multiple php scripts*/
   define('GW_UPLOADPATH', 'images/');
   define('GW_MAXFILESIZE', 32768);
?>