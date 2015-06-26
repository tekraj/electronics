<?php
/**
* class usercontroller
*/
class userController extends mainController{
	private $model=null;
	function __construct(){
		$this->model=new userModel;
	}

	// ===============================================

	// ===============================================
	// index function 
	public function index($parameter=[]){
		$data['title']='user';
		$data['template']='';
		$item='';// variable to hold the id of an item
		$offset=1; // variable to hold page no for pagination
		$defaultdata='';
		
		if(isset($parameter[1])){
			$data['template']=$parameter[1];
		}
		if(isset($parameter[2])){
			$item=$parameter[2];
			$offset=$parameter[2];
		}
		$data['tableFields']=$this->model->tableFields();
		$data['tableData']=$this->model->getAllData($offset);
		$data['totalRow']=$this->model->countRow();
		$data['currentPage']=$offset;
		$data['itemdata']=$this->model->getitemData($item);
		$this->loadView('user',$data);
	}
	// ===============================================

	// ===============================================
	// function to insert data
	public function insertdata(){
		$inputdata=$_POST['user'];
		$inputdata['password']=md5($inputdata['password']);
		$result=$this->model->insertData($inputdata);
		if($result){
			setcookie('message','Successfully Added',time()+6);
		}else{
			setcookie('message','Can not be added',time()+6);
		}
		header('location:'.link_url.'user/');

	}
	// ===============================================

	// ===============================================
	// function to update user data
	public function update($parameter=[]){
		$item='0';
		if(isset($parameter[2])){
			$item=$parameter[2];
		}
		$updatedata=$_POST['user'];
		if($updatedata['password'] !=$updatedata['oldpassword']){
			$updatedata['password']=md5($updatedata['password']);
		}
		unset($updatedata['oldpassword']);
		
		$result=$this->model->updateItem($updatedata,$item);
		if($result){
			setcookie('message','Successfully Updated',time()+6,'/');
		}else{
			setcookie('message','Can not be Updated',time()+6,'/');
		}
		header('location:'.link_url.'user/');

	}
	//===============================================

	// =============================================== 
	// funciton to delete data
	public function delete($parameter=[]){
		$item='0';
		if(isset($parameter[2])){
			$item=$parameter[2];
		}
		
		$result=$this->model->deleteItem($item);
		if($result){
			setcookie('message','Successfully Deleted',time()+6,'/');
		}else{
			setcookie('message','Can not be Deleted',time()+6,'/');
		}
		header('location:'.link_url.'user/');
	}
	// ===============================================

	// ===============================================
	// function to set the search parmaters
	public function search(){
		if(isset($_POST['searchby']) && isset($_POST['searchkey'])){
			if(!empty($_POST['searchkey'])){
				$_SESSION['userSearch']=[];
				$_SESSION['userSearch']['searchby']=$_POST['searchby'];
				$_SESSION['userSearch']['searchkey']=$_POST['searchkey'];
			}			
		}
		header('location:'.link_url.'user/');		
	}
	// ===============================================

	// ===============================================
	// function to destroy the search parameters
	public function viewall(){
		if(isset($_SESSION['userSearch'])){
			$_SESSION['userSearch']=[];
		}
		
		header('location:'.link_url.'user/view');
	}
	// ===============================================
	// function to check the session data to match with database
	public function sessionCheck($sessionData){

		$result=$this->model->getSessionData($sessionData);
		if($result == true){
			return true;
		}else{
			return false;
		}
	}

}