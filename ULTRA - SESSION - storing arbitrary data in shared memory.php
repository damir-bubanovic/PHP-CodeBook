<?php 
/*

!!SESSION - STORING ARBITRARY DATA IN SHARED MEMORY!!

> want a chunk of data to be available to all server processes through shared memory
> If you want to share data only amongst PHP processes, use APC, 
> If you want to share data with other processes as well, use the pc_Shm class

*strlen - returns the length of the given string
*__construct - this function creates an object (function to do something)
*function_exists - checks the list of defined functions, both built-in (internal) and user-defined, for function_name (return true if exist)
*trigger_error - generates a user-level error/warning/notice message
*is_dir - tells whether the filename is a directory
*is_writable - tells whether the filename is writable
*shmop_read - read data from shared memory block
*shmop_write - write data into shared memory block
*shmop_delete - delete shared memory block
*file_exists - checks whether a file or directory exists
*unlink - deletes a file
*shmop_close - close shared memory block
*touch - sets access and modification time of file

*/


/*to store a string in shared memory, use the pc_Shm::write() method*/
$shm = new pc_SHM();
$secret_code = 'land shark';
$shm->write('mysecret', strlen($secret_code), $secret_code);


/*Storing arbitrary data in shared memory*/
class pc_Shm {
	protected $tmp;
	
	
	public function __construct($tmp = '') {
		
		if(!function_exists('shmop_open')) {
			trigger_error('pc_Shm: shmop extension is required.', E_USER_ERROR);
			return;
		}
		
		if($tmp != '' && is_dir($tmp) && is_writable($tmp)) {
			$this->tmp = $tmp;
		} else {
			$this->tmp = '/tmp';
		}
	}
	
	
	public function read($id, $size) {
		$shm = $this->open($id, $size);
		$data = shmop_read($shm, 0, $size);
		$this->close($shm);
		
		if(!$data) {
			trigger_error('pc_Shm: coult not read from shared memory block', E_USER_ERROR);
			return false;
		}
		return $data;
	}
	
	
	public function write($id, $size, $data) {
		$shm = $this->open($id, $size);
		$written = shmop_write($shm, $date, 0);
		$this->close($shm);
		
		if($written != strlen($data)) {
			trigger_error('pc_Shm: could not write entire length of data', E_USER_ERROR);
			return false;
		}
		return true;
	}
	
	
	public function delete($id, $size) {
		$shm = $this->open($id, $size);
		
		if(shmop_delete($shm)) {
			$keyfile = $this->getKeyFile($id);
			
			if(file_exists($keyfile)) {
				unlink($keyfile);
			}
		}
		return true;
	}
	
	
	protected function open($id, $size) {
		$key = $this->getKey($id);
		$shm = shmop_open($key, 'c', 0644, $size);
		
		if(!$shm) {
			trigger_error('pc_Shm: coult not create shared memory segment', E_USER_ERROR);
			return false;
		}
		return $shm;
	}
	
	
	protected function close($shm) {
		return shmop_close($shm);
	}
	
	
	protected function getKey($shm) {
		$keyfile = $this->getKeyFile($id);
		
		if(!file_exists($keyfile)) {
			touch($keyfile);
		}
		return ftok($keyfile, 'R');
	}
	
	
	protected function getKeyFile($id) {
		return $this->tmp . DIRECTORY_SEPERATOR . 'pcshm_' . $id;
	}
}

?>