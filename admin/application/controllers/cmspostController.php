<?php
/**
* class cmscontroller
*/
class cmspostController extends mainController{
	private $model=null;

	function __construct(){
		$this->model=new cmspostModel;
	}

	// public function index for default routing
	// =========================================================
	// method to display the post page
	public function index($parameter=[]){
		
		$data['title']='cmspost';
		$data['template']='';
		if(isset($parameter[1])){
			$data['template']=$parameter[1];
		}

		$item='';
		if(isset($parameter[2])){
			$item=$parameter[2];
		}

		$data['tableFields']=$this->model->tableFields();
		$data['allData']=$this->model->getAllPost();
		$data['category']=$this->model->getCategory();
		$data['itemdata']=$this->model->getitemData($item);
		$this->loadView('cmspost',$data);
	}
	// method index end
	// =========================================================
	// function to add/update content
	public function addContent(){

		$inputData=$_POST['content'];


		$result=$this->model->createPost($inputData);
		if($result){
			$message=['status'=>true];
			echo json_encode($message);
			setcookie('message','Content Successfully Created',time()+6,'/');
		}else{
			$message=['status'=>false];
			echo json_encode($message);
			setcookie('message','Content Can not be Created',time()+6,'/');
		}
		header('location:'.link_url.'cmspost');
	}


	// ===========================================

	// function to create new slider post 
	public function addSlider(){

		$inputData=$_POST;


		$result=$this->model->createPost($inputData);
		if($result){
			$message=['status'=>true];
			echo json_encode($message);
		}else{
			$message=['status'=>false];
			echo json_encode($message);
		}
	}
	// function to update cms content
	public function updateContent($parameter=[]){

		$item='0';
		
		if(isset($parameter[2])){

			$item=$parameter[2];
		}

		$updateData=$_POST['content'];

		$result=$this->model->updateItem($item,$updateData);
		if($result){
			$message=['status'=>true];
			echo json_encode($message);
			setcookie('message','Successfully Updated',time()+6,'/');
		}else{
			$message=['status'=>false];
			echo json_encode($message);
			setcookie('message','Can not be Updated',time()+6,'/');
		}
		header('location:'.link_url.'cmspost/');

	}
	// method updateContent end
	// ==========================================================

	// functiont to update slider post
		public function updateSlider($parameter=[]){

		$item=$_POST['item'];

		$updateData=$_POST['content'];

		$result=$this->model->updateItem($item,$updateData);
		if($result){
			$message=['status'=>true];
			echo json_encode($message);
		}else{
			$message=['status'=>false];
			echo json_encode($message);
		}
	}

	// ==========================================================
	// method for delete articles
	public function delete($parameter=[]){
		$item='';

		if(isset($parameter[2])){
			$item=$parameter[2];
		}

		$result=$this->model->deleteItem($item);
		if($result){
			setcookie('message','Successfully Deleted',time()+6,'/');
		}else{
			setcookie('message','Can not be Deleted',time()+6,'/');
		}
		header('location:'.link_url.'cmspost/');
	}


	// ===============================================================
	// function to update cms content
	
}


