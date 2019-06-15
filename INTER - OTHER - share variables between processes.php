<?php 
/*

!!SHARE INFORMATION BETWEEN PROCESSES!!

> share information between processes that provides fast access to the shared data

*apc_fetch - fetch a stored variable from the cache
*ftok - convert a pathname and a project identifier to a System V IPC key
*shmop_open - create or open shared memory block
*shmop_read - read data from shared memory block
*shmop_write - write data into shared memory block
*strlen - get string length
*shmop_close - close shared memory block
*sem_get - get a semaphore id
*sem_acquire - acquire a semaphore
*shm_attach - creates or open a shared memory segment
*shm_has_var - check whether a specific entry exists
*shm_put_var - inserts or updates a variable in shared memory
*shm_detach - disconnects from shared memory segment
*sem_release - release a semaphore

*/


/*Using APC’s data store*/
// retrieve the old value
$population = apc_fetch('population');
// manipulate the data
$population += ($births + $immigrants - $deaths - $emigrants);
// write the new value back
apc_store('population', $population);

/*OR*/

/*Using the shmop shared memory functions*/
// create key
$shmop_key = ftok(__FILE__, 'p');
// create 16384 byte shared memory block
$shmop_id = shmop_open($shmop_key, "c", 0600, 16384);
// retrieve the entire shared memory segment
$population = shmop_read($shmop_id, 0, 0);
// manipulate the data
$population += ($births + $immigrants - $deaths - $emigrants);
// store the value back in the shared memory segment
$shmop_bytes_written = shmop_write($shmop_id, $population, 0);
// check that it fit
if ($shmop_bytes_written != strlen($population)) {
	echo "Can't write all of: $population\n";
}
// close the handle
shmop_close($shmop_id);

/*OR*/

/*Using the System V shared memory functions*/
$semaphore_id = 100;
$segment_id = 200;
// get a handle to the semaphore associated with the shared memory
// segment we want
$sem = sem_get($semaphore_id,1,0600);
// ensure exclusive access to the semaphore
sem_acquire($sem) or die("Can't acquire semaphore");
// get a handle to our shared memory segment
$shm = shm_attach($segment_id,16384,0600);
// Each value stored in the segment is identified by an integer
// ID
$var_id = 3476;
// retrieve a value from the shared memory segment
if (shm_has_var($shm, $var_id)) {
	$population = shm_get_var($shm,$var_id);
}
// Or initialize it if it hasn't been set yet
else {
	$population = 0;
}
// manipulate the value
$population += ($births + $immigrants - $deaths - $emigrants);
// store the value back in the shared memory segment
shm_put_var($shm,$var_id,$population);
// release the handle to the shared memory segment
shm_detach($shm);
// release the semaphore so other processes can acquire it
sem_release($sem);
?>