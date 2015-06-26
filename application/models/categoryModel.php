<?php
/**
* class categoryModel extends Mainmodel
*/
class categoryModel extends mainModel{
	private $categoryTable='category';
	private $brandTable='brand';
	private $productTable='product';

	function __construct(){
		parent::__construct();
	}

	public function getCategory($catUrl=''){
		$data=[];
		$catSql="SELECT * FROM $this->categoryTable WHERE url='$catUrl' LIMIT 1";
		if($catResult=$this->con->query($catSql)){
			$catData=$catResult->fetch_object();
			return $catData;
		}

	}
	

	public function getAllProducts($brandUrl='',$catUrl=''){
		$imageTable='product_image';
		$data=[];
		
		$brandData=$this->getBrandData($brandUrl,$catUrl);
		$categoryData=$this->getCategory($catUrl);
		$brandId=null;
		$catId=null;
		$condition=null;
		if(!empty($categoryData)){
			$catId=$categoryData->id;
		}
		if(!empty($brandData)){
			$brandId=$brandData->id;
			
			
		}
		if(empty($categoryData) && empty($brandData)){
			$condition="1";
		}else{
			if(!empty($brandId)){
				$condition="brand_id=' $brandId ' AND category_id=' $catId '";
			}else{
				$condition=" category_id=' $catId '";
			}
			
		}
		
		

		$productSql="SELECT * FROM $this->productTable WHERE $condition";

		
		if($productResult=$this->con->query($productSql)){
			while($row=$productResult->fetch_object()){
				$data[]=$row;
			}
		}
		
		return $data;
	}

	public function getBrandData($brandUrl='',$catUrl=''){
		$categoryData=$this->getCategory($catUrl);
		$catId='';
		if(!empty($categoryData)){

			$catId=$categoryData->id;

		}
		
		$brandSql="SELECT * FROM $this->brandTable WHERE url='$brandUrl' AND category_id='$catId'";
		//echo $brandSql;
		if($brandResult=$this->con->query($brandSql)){
			$brandData=$brandResult->fetch_object();
			return $brandData;
		}
	}
}