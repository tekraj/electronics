<?php
/**
* class productModel extends mainModel
*/
class productModel extends mainModel{

	private $productTable='product';

	function __construct(){
		parent::__construct();	
	}

	// function to get  data for a  aproduct 

	public function productDetail($url){
		$sql="SELECT * FROM $this->productTable WHERE url='$url' LIMIT 1";

		if($result=$this->con->query($sql)){
			return $result->fetch_object();
		}else{
			return false;
		}

	}

	public function getProductImage($productUrl){
		$imageTable='product_image';
		$productDetail=$this->productDetail($productUrl);
		$productId=$productDetail->id;
		$sql="SELECT * FROM $imageTable WHERE product_id='$productId'";
		$data=[];
		if($result=$this->con->query($sql)){
			while ($row=$result->fetch_object()) {
				$data[]=$row;
			}
		}
		return $data;
	}



	

}