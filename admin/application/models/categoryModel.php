<?php
/**
* class categorymodel
*/
class categoryModel extends mainModel{
	private $table='category';

	function __construct(){
		parent::__construct();
	}
	// ================================================


	// ================================================
	// function to return the tableFields required to display data in datalist
	public function tableFields(){
		return [
				'id'=>"Id",
				'title'=>'Title',
				'url'=>'URL',
				'date'=>'Date',
				'status'=>'Stauts'
				];
	}

	// ================================================


	// ================================================
	// 
	public function insertData($inputdata){


		$result=$this->insert($this->table,$inputdata);
		return $result;
	}

	// ================================================


	// ================================================
	// funciton to get all data of category table supporting paginatio
	public function getAllData($offset='1'){
		$result=$this->selectall($this->table,$offset);
		return $result;
	}
	// ================================================


	// ================================================
	// function to get the total no of row in category table for pagination
		public function countRow(){
			$condition="WHERE status='1' ";

			if(isset($_SESSION['categorySearch']) && !empty($_SESSION['categorySearch'])){
			 	$searchby=$_SESSION['categorySearch']['searchby'];
			 	$searchkey=$_SESSION['categorySearch']['searchkey'];
			 	$condition.=" AND $searchby LIKE '%$searchkey%'";
			 }
			$result=$this->countAllRow($this->table,$condition);
			return $result;
		}

	// ================================================


	// ================================================
	// function to get the data of a perticular item
	public function getitemData($item){
		$result=$this->itemData($this->table,$item);
		return $result;
	}


	public function updateItem($inputdata,$item){
		$result=$this->update($this->table,$inputdata,$item);
		return $result;
	}


	public function  deleteItem($item){
		$result=$this->delete($this->table,$item);
		return $result;
	}
}