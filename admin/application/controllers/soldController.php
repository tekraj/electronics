<?php
/**
* class ordercontroller
*/
class soldController extends mainController{
	private $model=null;
	function __construct(){
		$this->model=new soldModel;
	}
	public function index($parameter=[]){
		$data['title']='sold';
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
		$this->loadView('sold',$data);
	}

		// ==========================================================
	// method for search data
	public function search(){
		if(isset($_POST['searchby']) && isset($_POST['searchkey'])){
			if(!empty($_POST['searchkey'])){
				$_SESSION['soldSearch']=[];
				$_SESSION['soldSearch']['searchby']=$_POST['searchby'];
				$_SESSION['soldSearch']['searchkey']=$_POST['searchkey'];

				if($_SESSION['soldSearch']['searchby'] == 'category'){
					$_SESSION['soldSearch']['searchby']='cart_product_category_id';
					$searchTable='category';
					$keyword=$_SESSION['soldSearch']['searchkey'];
					$categoryId=$this->model->getSearchItemsId($searchTable,$keyword);
					$_SESSION['soldSearch']['searchkey']=$categoryId->id;
				}


				if($_SESSION['soldSearch']['searchby'] == 'brand'){
					$_SESSION['soldSearch']['searchby']='cart_product_brand_id';
					$searchTable='brand';
					$keyword=$_SESSION['soldSearch']['searchkey'];
					$categoryId=$this->model->getSearchItemsId($searchTable,$keyword);
					$_SESSION['soldSearch']['searchkey']=$categoryId->id;
					
				}

				if($_SESSION['soldSearch']['searchby'] == 'name' || $_SESSION['soldSearch']['searchby']=='price'){
					$_SESSION['soldSearch']['searchby']='cart_product_id';
					$searchTable='product';
					$keyword=$_SESSION['soldSearch']['searchkey'];
					$categoryId=$this->model->getSearchItemsId($searchTable,$keyword);
					$_SESSION['soldSearch']['searchkey']=$categoryId->id;
					
				}
			}			
		}
		header('location:'.link_url.'sold/');		
	}
	// method search end
	// ==========================================================

	// ==========================================================
	// method to delete the search parameters
	public function viewall(){
		if(isset($_SESSION['soldSearch'])){
			$_SESSION['soldSearch']=[];
		}
		header('location:'.link_url.'sold/view');
	}

}