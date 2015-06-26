<?php
/**
* class logincontroller for login
*/
class loginController extends mainController{

	private $model=null;
	function __construct(){
		$this->model=new loginModel;
	}
	public function index(){
		
		$result=$this->model->checkLogin();
		if($result!=false){
			header('location:admin/index.php');
		}else{
			setcookie('message','Invalid Email or Username',time()+6);
			header('location:login.php');
		}
	}
	public function logout(){
		session_destroy();
		session_unset();
		header('location:/electronics/login.php');
	}


}