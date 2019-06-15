<?php 
/*

!!DIRECTORIES - CHANGING FILE PERMISSIONS OR OWNERSHIP!!

> You want to change a file’s permissions or ownership
	>> npr. you want to prevent other users from being able to look at a 
	file of sensitive data
	
> The superuser can change the permissions, owner, and group of any file. 
	>> Other users are restricted. They can change only the permissions and group of 
	files that they own, and can’t change the owner at all. 
	>> A nonsuperuser can also change only the group of a file to a group to which 
	the user belongs

*chmod - changes file mode
*chown - changes file owner
*chgrp - changes file group

*/


/*Use chmod() to change the permissions of a file*/
chmod('/home/user/secrets.txt', 0400);


/*Use chown() to change a file’s owner and chgrp() to change a file’s group*/
chown('/tmp/myfile.txt','sklar'); // specify user by name
chgrp('/home/sklar/schedule.txt','soccer'); // specify group by name

chown('/tmp/myfile.txt',5001); // specify user by uid
chgrp('/home/sklar/schedule.txt',102); // specify group by gid

?>