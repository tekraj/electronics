<?php
/**
* class siteController extends mainController 
*/
class siteController extends mainController{
	 
	 private $model=null;
	 function __construct(){
	 	$this->model=new siteModel;
	 }
	// ============================
	// method for loading index page

	public function index(){
		
		$data['title']='index';
		$data['products']=$this->model->getProducts();
		$data['mainBrands']=$this->model->getBrands();
		$data['featured_product']=$this->model->getFeaturedProduct();
		$data['totalProducts']=$this->model->totalProducts();
		$this->loadView('index',$data);
	}

	// index end
	// ===========================

	// function for getProducts for pagination

	public function getProducts(){
		
		$currentPage=$_POST['page'];
		$productData=$this->model->getProducts($currentPage);
		echo json_encode($productData);
	}
	// ==============================================
	// method for contact page
	public function contact(){
		$data['title']='contact';
		$this->loadView('contact',$data);
	}
	// ========================================
	// method for about page
	public function about(){
		$data['title']='about';
		$this->loadView('about',$data);
	}

}