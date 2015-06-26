<?php
/**
* class cmscategorycontroller
*/
class cmscategoryController extends mainController{
	private $model=null;
	function __construct(){
		$this->model=new cmscategoryModel;
	}
	// ===============================================

	// =================================================
	// method to render category page
	public function index($parameter=[]){
		
		$data['title']='cmscategory';
		$data['template']='';
		$item='';// variable to hold the id of an item
		$offset='1'; // variable to hold page no for pagination
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
		// $data['mainCat']=$this->model->getMaincat();
		$this->loadView('cmscategory',$data);
	}
	// method index end
	// ===============================================

	// =================================================
	// method to insert  category data to category table
	public function insertdata(){
		$inputdata=$_POST['cmscategory'];
		print_r($inputdata);
		
		$result=$this->model->insertData($inputdata);
		if($result){
			setcookie('message','Successfully Added',time()+6);
		}else{
			setcookie('message','Can not be added',time()+6);
		}
		header('location:'.link_url.'cmscategory/');

	}
	// method insert data end
	// ===============================================

	// =================================================
	// method to update category data
	public function update($parameter=[]){
		$item='0';
		if(isset($parameter[2])){
			$item=$parameter[2];
		}
		$updatedata=$_POST['cmscategory'];
		
		$result=$this->model->updateItem($updatedata,$item);
		if($result){
			setcookie('message','Successfully Updated',time()+6,'/');
		}else{
			setcookie('message','Can not be Updated',time()+6,'/');
		}
		header('location:'.link_url.'cmscategory/');

	}
	// method update end
	// ===============================================

	// =================================================
	// method delete to delete category data
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
		header('location:'.link_url.'cmscategory/');
	}
	// method delete end
	// ===============================================

	// =================================================
	// method to set the search parameter via sessions
	public function search(){
		if(isset($_POST['searchby']) && isset($_POST['searchkey'])){
			if(!empty($_POST['searchkey'])){
				$_SESSION['cmscategorySearch']=[];
				$_SESSION['cmscategorySearch']['searchby']=$_POST['searchby'];
				$_SESSION['cmscategorySearch']['searchkey']=$_POST['searchkey'];
			}			
		}
		header('location:'.link_url.'cmscategory/');		
	}
	// method search end
	// ===============================================

	// =================================================
	// function to destroy the search sessions
	public function viewall(){
		if(isset($_SESSION['cmscategorySearch'])){
			$_SESSION['cmscategorySearch']=[];
		}
		header('location:'.link_url.'cmscategory/view');
		
	}
}
