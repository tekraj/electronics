<?php
/**
* class dbConfig for database connection
*/
class dbConfig{
	private $host='localhost';
	private $username='root';
	private $password='';
	private $db='electronics';
	public $con='';
	function __construct(){
		if($this->con=mysqli_connect($this->host,$this->username,$this->password,$this->db)){

		}else{
			echo "Database Error";
		}		
	}

}