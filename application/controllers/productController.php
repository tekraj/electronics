<?php
/**
* class productController extends mainController 
*/
class productController extends mainController{
	

	private $model=null;
	function __construct(){
		$this->model=new productModel;
	}
	// ============================
	// method for loading index page

	public function index($parameter=[]){
		$productUrl='';
		if(isset($parameter[1])){
			$productUrl=$parameter[1];
		}
		
		$data['title']='product';
		$data['productDetail']=$this->model->productDetail($productUrl);
		$data['productImages']=$this->model->getProductImage($productUrl);
		$this->loadView('product',$data);
	}

	// index end
	// ===========================

}