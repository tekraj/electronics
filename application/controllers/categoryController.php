<?php
/**
* class categoryController
*/
class categoryController extends mainController{

	private $model=null;
	function __construct(){
		$this->model=new categoryModel;
	}
	
	public function index($parameter=[]){
		
		$data['title']='category';
		$catUrl='';
		$brandUrl='';
		if(isset($parameter[1])){
			$catUrl=$parameter[1];
			
		}
		if(isset($parameter[2])){
			$brandUrl=$parameter[2];
		}
		$data['categoryData']=$this->model->getCategory($catUrl);
		$data['brandData']=$this->model->getBrandData($brandUrl,$catUrl);
		$data['allProducts']=$this->model->getAllProducts($brandUrl,$catUrl);
		$this->loadView('category',$data);
	}
}