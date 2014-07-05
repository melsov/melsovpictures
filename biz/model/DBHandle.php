<?php
class DBHandle
{
	private $host = "scoob.matthewpoindexter.com";
	private $user = "newsom123";
	private $pass = "owlowl123";
	private $database = "newsomsdatabase";
	private $default_table = "caps";
	
	private $_mysqli = null;
	
	function __construct() {
		$this->getMySQLi();	
	}
	
	public function query($query_string='')
	{
		if ($this->_mysqli== null) $this->getMySQLi();
		
		if ($query_string == '') $query_string = "SELECT * FROM ".$this->default_table;
		
		$result = $this->_mysqli->query($query_string);
		if ($result == null) {
			throw new Exception("db handler query error. query string: $query_string", 1);
		}
		
		//TODO: THIS DOESN'T GIVE US THE WHOLE RESULT.
		return $result; 
	}
	
	private function getMySQLi() {
		if ($this->_mysqli == null) {
			$this->_mysqli = mysqli_connect($this->host, $this->user, $this->pass, $this->database);
			if ($this->_mysqli->connect_errno) {
			    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
			}
		}
		return $this->_mysqli;
	}
	
}
?>