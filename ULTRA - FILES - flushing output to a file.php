<?php 
/*

!!FILES - FLUSHING OUTPUT TO A FILE!!

> You want to force all buffered data to be written to a filehandle

> Flushing output can be particularly helpful when generating an access or activity log.
> Calling fflush() after each message to the logfile makes sure that any person or program
monitoring the logfile sees the message as soon as possible

*fwrite - binary-safe file write
*fflush - flushes the output to a file

*/


/*Use fflush()*/
fwrite($fh,'There are twelve pumpkins in my house.');
fflush($fh);

?>