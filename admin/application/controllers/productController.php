<?php
/**
* class productcontroller
*/
class productController extends mainController{
	private $model=null;

	function __construct(){
		$this->model=new productModel;
	}

	// =========================================================
	// method for rendering product Model page
	public function index($parameter=[]){
		
		$data['title']='product';
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
		$data['imageData']=$this->model->getItemImage($item);
		$data['stockProduct']=$this->model->getStock($item);
		$data['category']=$this->model->getCategory();
		$data['brand']=$this->model->getBrand();
		$this->loadView('product',$data);
	}
	// method index end
	// =========================================================

	// ==========================================================
	// method to insert product data into product table
	public function insertdata(){
		$inputdata=$_POST['product'];

		$inputImage=[];
		if(isset($_POST['slider'])){
			$inputImage=$_POST['slider'];
		}
			

		$result=$this->model->insertData($inputdata);
		if($result){

			if(count($inputImage) >0){
				$this->model->insertImage($inputImage,$result,'product_image');
			}

			setcookie('message','Successfully Added',time()+6);
		}else{
			setcookie('message','Can not be added',time()+6);
		}

		header('location:'.link_url.'product/');

	}
	// method insertdata end
	//========================================================= 

	// ==========================================================
	// method for update product data
	public function update($parameter=[]){

		$item='0';
		if(isset($parameter[2])){
			$item=$parameter[2];
		}
		$updatedata=$_POST['product'];
		$inputImage=[];
		if(isset($_POST['slider'])){
			$inputImage=$_POST['slider'];
		}
		
		
		$result=$this->model->updateItem($updatedata,$item);
		if($result){

				if(count($inputImage) > 0){
					$this->model->updateImage($inputImage);
				}
			setcookie('message','Successfully Updated',time()+6,'/');
		}else{
			setcookie('message','Can not be Updated',time()+6,'/');
		}
		header('location:'.link_url.'product/');

	}
	// method update end
	// ==========================================================

	// ==========================================================
	// method for delete product data
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
		header('location:'.link_url.'product/');
	}
	// method delete end
	// ==========================================================

	// ==========================================================
	// method for search data
	public function search(){
		if(isset($_POST['searchby']) && isset($_POST['searchkey'])){
			if(!empty($_POST['searchkey'])){
				$_SESSION['productSearch']=[];
				$_SESSION['productSearch']['searchby']=$_POST['searchby'];
				$_SESSION['productSearch']['searchkey']=$_POST['searchkey'];

				if($_SESSION['productSearch']['searchby'] == 'category'){
					$_SESSION['productSearch']['searchby']='category_id';
					$searchTable='category';
					$keyword=$_SESSION['productSearch']['searchkey'];
					$categoryId=$this->model->getSearchItemsId($searchTable,$keyword);
					$_SESSION['productSearch']['searchkey']=$categoryId->id;
					

				}
				if($_SESSION['productSearch']['searchby'] == 'brand'){
					$_SESSION['productSearch']['searchby']='brand_id';
					$searchTable='brand';
					$keyword=$_SESSION['productSearch']['searchkey'];
					$categoryId=$this->model->getSearchItemsId($searchTable,$keyword);
					$_SESSION['productSearch']['searchkey']=$categoryId->id;
					
				}
			}			
		}
		header('location:'.link_url.'product/');		
	}
	// method search end
	// ==========================================================

	// ==========================================================
	// method to delete the search parameters
	public function viewall(){
		if(isset($_SESSION['productSearch'])){
			$_SESSION['productSearch']=[];
		}
		header('location:'.link_url.'product/view');
	}
	// method viewall end
	// ==========================================================

	// ==========================================================

	// ==========================================================
	// method to add product stock
	public function addstock(){
		$inputData=$_POST;
		$item=$inputData['id'];
		$quantity=$inputData['quantity'];
		$result=$this->model->addStock($item,$quantity);
		if($result==true){
			setcookie('message','Stock Successfully Added',time()+6,'/');
		}else{
			setcookie('message','Stock Can not  be added',time()+6,'/');
		}
		header('location:'.link_url.'product/view');
	}
	// method addstock end
	// ==========================================================
	// method to get the brand for perticular brand

	public function getCategoryBrand(){
		$categoryId=$_POST['categoryId'];
		$result=$this->model->getBrand($categoryId);
		if($result!=false){
			echo json_encode($result);
		}else{
			echo 'false';
		}
	}
}


