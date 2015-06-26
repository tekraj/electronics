<?php
/**
* class memberController extends mainController 
*/
class memberController extends mainController{
	
	private $model=null;
	function __construct(){
		$this->model=new memberModel;
	}
	// ============================
	// method for loading index page
	// ===========================
	public function index($parameter=[]){
		$data['title']='member';
		$data['role']='signup';
				
		$this->loadView('member',$data);
	}

	// index end

	// method for login
	public function login(){
		
		$data['title']='member';
		$data['role']='login';		
		$this->loadView('member',$data);
	}


	public function memberRegister(){
		$result=$this->model->registerMember($_POST);
		if($result===true){
			$message=['status'=>true];
			echo json_encode($message);
		}else{
			
			$message=['status'=>false];
			echo json_encode($message);
		}
	}


	public function validateMember(){
		
		$result=$this->model->loginMember($_POST);
		if($result->num_rows == 1 ){
			$resultData=$result->fetch_object();
			$client_ip=$ip = getenv('HTTP_CLIENT_IP')?:
				getenv('HTTP_X_FORWARDED_FOR')?:
				getenv('HTTP_X_FORWARDED')?:
				getenv('HTTP_FORWARDED_FOR')?:
				getenv('HTTP_FORWARDED')?:
				getenv('REMOTE_ADDR');
			
			$last_login_date=date('Y-m-d h:m:s');
			$updateData=['last_login_ip'=>$client_ip,'last_login_time'=>$last_login_date];
			$id=$resultData->id;
			$ipResult=$this->model->updateMemberTable($updateData,$id);
			
			$_SESSION['member']=$resultData;
			$message=['status'=>true];
			echo json_encode($message);
			
		}else{

			$message=['status'=>false];
			echo json_encode($message);
		}
	}



	public function logout(){

		$_SESSION['member']=null;

		header('location:'.link_url);
	}

	
	// ==================================================
	// function for forget password option
	 public function forgetpassword(){

		$data['title']='member';
		$data['role']='forget';		
		$this->loadView('member',$data);
	 }

	// function to send the mail for reset password link
	 public function sendResetMail(){
	 	$email=$_POST['email'];
	 	$result=$this->model->searchMember($email);
	 	if($result==true){
	 		$message=['status'=>true];
			echo json_encode($message);
	 	}
	 }

	 public function keepalive(){
	 	$inputData=$_POST;

	 	$result=$this->model->keepMemberOnline($inputData);
	 	if($result==true){
	 		echo 'true';
	 	}else{
	 		echo 'false';
	 	}

	 }

	 // function to send message
	 public function sendMessage(){
	 	$result=$this->model->messageSend($_POST);

	 	if($result==true){
	 		echo 'true';
	 	}else{
	 		echo 'false';
	 	}
	 }
	
	public function checkMessage(){

		$memberId=$_POST['memberId'];

		$result=$this->model->getMessage($memberId);

		if($result!=false){
			echo json_encode($result);
		}else{
			echo 'false';
		}

	}
}