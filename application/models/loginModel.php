<?php
session_start();
/**
* class usermodel for user page
*/
class loginModel extends mainModel{
	function __construct(){
		parent::__construct();
	}
	public function checkLogin(){
		$table='user';
		$username=$_POST['username'];
		$password=md5($_POST['password']);
		$result=$this->login($table,$username,$password);
		if($result){
			$_SESSION['user']=$result;
			return true;
		}else{
			return false;
		}
	}


}