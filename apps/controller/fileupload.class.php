<?php

class UploadFile
{
	protected $_userID;    // using protected so they can be accessed
	protected $_ipaddress;
	protected $_passcode;
	protected $_sessionid;
	
    protected $_db;       // stores the database handler

	// Login Credentials
    public function __construct(PDO $db, $userID, $sessionid, $ipaddress, $passcode) 
    {
		$this->_db = $db;
		
		$this->_userID = $userID;
		$this->_sessionid = $sessionid;
		$this->_ipaddress = $ipaddress;
		$this->_passcode = $passcode;
    }
	
	public function storeFile($data) {
		$myFile = "/src/custom/img/uploads/test.jpg";
		$fh = fopen($myFile, 'w') or die("can't open file");		
		fwrite($fh, $data);
		fclose($fh);
	}
}

?>