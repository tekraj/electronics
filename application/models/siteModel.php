<?php
/**
* class siteModel extends mainModel
*/
class siteModel extends mainModel{
	
	private $productTable='product';
	private $brandTable='brand';


	function __construct(){
		parent::__construct();
	}


	// =======================================


	// function to get all new products
	public function getProducts($page=1){
		$imageTable='product_image';
		$limit=8;
		$offset=($page-1) * 8;

		$sql="SELECT * FROM $this->productTable  WHERE status='1' LIMIT $offset,$limit";
	
		$result=$this->con->query($sql);
		$data=[];

		if($result){
			
			while($row=$result->fetch_object()){
				$data[]=$row;
			}			
		}
		return $data;		
	}
	// function getProducts end


	// ========================================


	// function to get the featured porducts
	public function getFeaturedProduct(){
		$imageTable='product_image';
		$brands=$this->getBrands();
		$data=[];
		foreach($brands as $brand){
			$sql="SELECT * FROM $this->productTable WHERE brand_id='$brand->id' LIMIT 1";
			if($result=$this->con->query($sql)){
				$data[]= $result->fetch_object();
			}
		}
		
		return $data;
		
	}
	// function getFeaturedProduct end


	// ========================================

	// function to  get all brands
	public function getBrands(){
		$sql="SELECT * FROM $this->brandTable  WHERE status='1' GROUP BY name";
		$data=[];
		if($result=$this->con->query($sql)){
			while($row=$result->fetch_object()){
				$data[]=$row;
			}
		} 
		return $data;
	}
	// function getBrands end

	// ====================================

	// function to get the total no of Products
	public function totalProducts(){
		$sql="SELECT id FROM $this->productTable WHERE status='1'";
		if($result=$this->con->query($sql)){
			return $result->num_rows;
		}
	}

	// ================================================



}