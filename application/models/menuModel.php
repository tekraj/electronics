<?php
/**
* class menuModel extends mainModel
*/
class menuModel extends mainModel{

	private $catTable='category';
	private $brandTable='brand';

	function __construct(){
		parent::__construct();	
	}

	// function to get category for menu
	public function getCategory(){
		$catSql="SELECT * FROM $this->catTable";
		$catResult=$this->con->query($catSql);

		if($catResult){

			$catData=[];
			while($row=$catResult->fetch_object()){
				$catData[]=$row;
			}
			return $catData;

		}else{
			echo "Database Error";
			// echo $this->con->error;
		}
	}

	// function to get brands

	public function getBrands(){
		$brandData=[];
		$category=$this->getCategory();
		foreach($category as $cat){
			$brandData[$cat->id]=[];
			$brandSql="SELECT * FROM $this->brandTable WHERE category_id='$cat->id'";
			$brandResult=$this->con->query($brandSql);
			while($brands=$brandResult->fetch_object()){
				$brandData[$cat->id][]=$brands;
			}
		}

		return $brandData;
	}

	// 
	public function getAllBrands(){
		$sql="SELECT * FROM $this->brandTable WHERE status='1'";
		$data=[];
		if($result=$this->con->query($sql)){
			while($row=$result->fetch_object()){
				$data[]=$row;
			}
		}
		return $data;
	}
}