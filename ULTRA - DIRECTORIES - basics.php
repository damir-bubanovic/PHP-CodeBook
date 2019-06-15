<?php 
/*

!!DIRECTORIES - Basics!!


> A filesystem stores a lot of additional information about files aside from their actual contents. 
	>> This information includes such particulars as the file size, directory, and access permissions. 
	>> If you’re working with files, you may also need to manipulate this metadata.

> PHP gives you a variety of functions to read and manipulate directories, directory entries,
and file attributes.


> Files are organized with inodes. 
	>> Each file (and other parts of the filesystem, such as directories, devices, and links) has its 
	own inode. 
		>>> That inode contains a pointer to where the file’s data blocks are as well as all the 
		metadata about the file. 
			>>> The data blocks for a directory hold the names of the files in that directory and the 
			inode of each file
			
> PHP provides a few ways to look in a directory to see what files it holds. The Directory-
Iterator class provides a comprehensive object-oriented interface for directory traversal

> The filesystem holds more than just files and directories. On Unix, it can also hold
symbolic links. These are special files whose contents are a pointer to another file. You
can delete the link without affecting the file it points to

> LOOK UP - File information functions on php.net

> On Unix, the file permissions indicate what operations the file’s owner, users in the file’s
group, and all users can perform on the file. 
	>> The operations are reading, writing, and executing
		>>> for directories, executing is the ability to search through the directory and see 
		the files in it
		
> Unix permissions can also contain a setuid bit, a setgid bit, and a sticky bit. 
	+) The setuid bit means that when a program is run, it runs with the user ID of its owner. 
	+) The setgid bit means that a program runs with the group ID of its group. 
		>> For a directory, the setgid bit means that new files in the directory are created by 
		default in the same group as the directory. 
	+) The sticky bit is useful for directories in which people share files because it prevents 
	nonsuperusers with write permission in a directory from deleting files in that directory unless 
	they own the file or the directory

> Ima dosta prouči!


*opendir - open directory handle
*readdir - read entry from directory handle
*closedir - close directory handle
*umask - changes the current umask
*touch - sets access and modification time of file
*umask - changes the current umask

*/


/*This print out the name of each file in a directory*/
foreach(new DirectoryIterator('/usr/local/images') as $file) {
	print $file->getPathname() . "\n";
}


/*The opendir(), readdir(), and closedir() functions offer a procedural approach to the same task.*/
$d = opendir('/usr/local/images') or die($php_errormsg);

while (false !== ($f = readdir($d))) {
	print $f . "\n";
}
closedir($d);


/*To create a symbolic link, use symlink()*/
symlink('/usr/local/images','/www/docroot/images') or die($php_errormsg);


/*EXAMPLE shows how to make the permissions on newly created files prevent
 anyone but the file’s owner (and the superuser) from accessing the file*/
$old_umask = umask(0077);
touch('secret-file.txt');
umask($old_umask);

?>