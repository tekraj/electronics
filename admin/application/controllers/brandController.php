<?php
/**
* class brandcontroller
*/
class brandController extends mainController{

	private $model=null;
	function __construct(){
		$this->model=new brandModel;
	}
	
	// ===================================================
	// method to render brand page
	public function index($parameter=[]){
	
		$data['title']='brand';
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
		$data['category']=$this->model->getCategory();
		$data['itemdata']=$this->model->getitemData($item);
		$this->loadView('brand',$data);
	}
	// method index end
	// ==================================================

	// ===================================================
	// method to insert brand data to brand table
	public function insertdata(){
		$inputdata=$_POST['brand'];
		
		if(isset($_FILES['image'])){
			$ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
			$tmpName=$_FILES['image']['tmp_name'];
			$dupliName=$inputdata['url'].'.'.$ext;
			$newName=PARENT_DIR.DS.'uploads'.DS.'images'.DS.$dupliName;
			if(move_uploaded_file($tmpName,$newName)){
				$inputdata['image']='http://'.$_SERVER['HTTP_HOST'].'/electronics/uploads/images/'.$dupliName;
			}
		}
		$result=$this->model->insertData($inputdata);
		if($result){
			setcookie('message','Successfully Added',time()+6);
		}else{
			setcookie('message','Can not be added',time()+6);
		}
		header('location:'.link_url.'brand/');

	}
	// method insertdata end
	// ==================================================

	// ===================================================
	// method to update brand data
	public function update($parameter=[]){
		$item='0';
		if(isset($parameter[2])){
			$item=$parameter[2];
		}
		$updatedata=$_POST['brand'];
		
		if(isset($_FILES['image'])){
			$ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
			$tmpName=$_FILES['image']['tmp_name'];
			$dupliName=$updatedata['url'].'.'.$ext;
			$newName=PARENT_DIR.DS.'uploads'.DS.'images'.DS.$dupliName;
			if(move_uploaded_file($tmpName,$newName)){
				$updatedata['image']='http://'.$_SERVER['HTTP_HOST'].'/electronics/uploads/images/'.$dupliName;
			}
		}
		$result=$this->model->updateItem($updatedata,$item);
		if($result){
			setcookie('message','Successfully Updated',time()+6,'/');
		}else{
			setcookie('message','Can not be Updated',time()+6,'/');
		}
		header('location:'.link_url.'brand/');

	}
	// method update end
	// ==================================================

	// ===================================================
	// method to delete brand data
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
		header('location:'.link_url.'brand/');
	}
	// method delete end
	// ==================================================

	// ===================================================
	// method to set parameters for search
	public function search(){
		if(isset($_POST['searchby']) && isset($_POST['searchkey'])){
			if(!empty($_POST['searchkey'])){
				$_SESSION['brandSearch']=[];
				$_SESSION['brandSearch']['searchby']=$_POST['searchby'];
				$_SESSION['brandSearch']['searchkey']=$_POST['searchkey'];

				if($_SESSION['brandSearch']['searchby'] == 'category'){
					$_SESSION['brandSearch']['searchby']='category_id';
					$searchTable='category';
					$keyword=$_SESSION['brandSearch']['searchkey'];
					$categoryId=$this->model->getSearchItemsId($searchTable,$keyword);
					$_SESSION['brandSearch']['searchkey']=$categoryId->id;
				}	
			}


		}
		header('location:'.link_url.'brand/');		
	}
	// method search end
	// ==================================================

	// ===================================================
	// method to destroy the search parameter
	public function viewall(){
		if(isset($_SESSION['brandSearch'])){
			$_SESSION['brandSearch']=[];
		}
		
		header('location:'.link_url.'brand/view');
	}
	// ===================================================

}