<?php
/**
* class brandModel
*/
class brandModel extends mainModel{
	private $table='brand';

	function __construct(){
		parent::__construct();
	}

	// =================================================
	// =================================================
	// function to get the table fields for rendering data
	public function tableFields(){
		return [
				'id'=>"Id",
				'name'=>'Name',
				'url'=>'URL',
				'category'=>'Category',
				'date'=>'Date',
				'status'=>'Stauts'
				];
	}
	// function tableFields end
	// =================================================

	// =================================================
	// function to insert data
	public function insertData($inputdata){
		$result=$this->insert($this->table,$inputdata);
		return $result;
	}
	// =================================================
	// =================================================
	// function to getAll data and supports pagination
	public function getAllData($offset='1'){
		$categoryTable='category';
		$limit=5;

		$joinCondition="SELECT $this->table.*,$categoryTable.title AS category FROM $this->table LEFT JOIN $categoryTable ON $this->table.category_id=$categoryTable.id WHERE $this->table.status='1' ";

			if(isset($_SESSION['brandSearch']) && !empty($_SESSION['brandSearch'])){

			 	$searchby=$_SESSION['brandSearch']['searchby'];
			 	$searchkey=$_SESSION['brandSearch']['searchkey'];
			 	$joinCondition.="  AND $this->table.$searchby LIKE '%$searchkey%' ";
		 	}

		$result=$this->selectall($this->table,$offset,$limit,$joinCondition);
		return $result;
	}
	// =================================================

	// =================================================
	// function to get the total no of rows in the table
	public function countRow(){
		$condition="WHERE status='1'";

		if(isset($_SESSION['brandSearch']) && !empty($_SESSION['brandSearch'])){
		 	$searchby=$_SESSION['brandSearch']['searchby'];
		 	$searchkey=$_SESSION['brandSearch']['searchkey'];
		 	$condition.=" AND $searchby LIKE '%$searchkey%'";
		 }
		$result=$this->countAllRow($this->table,$condition);
		return $result;
	}
	// =================================================

	// =================================================
	// function to get the data of a perticular item
	public function getitemData($item){
		$result=$this->itemData($this->table,$item);
		return $result;
	}
	// =================================================

	// =================================================
	// function for update perticular item
	public function updateItem($inputdata,$item){
		$result=$this->update($this->table,$inputdata,$item);
		return $result;
	}
	// =================================================
	// =================================================
	public function  deleteItem($item){
		$result=$this->delete($this->table,$item);
		return $result;
	}
	// =================================================

	// function to get the ids of category or brand table if searched with category or brand option
	public function getSearchItemsId($searchTable,$keyword){
		$sql="SELECT * FROM $searchTable WHERE status='1' AND url LIKE '%$keyword%' LIMIT 1";
		
		if($result=$this->con->query($sql)){
			return $result->fetch_object();
		}
	}
	// ========================================================
	// function to get all categories
		public function getCategory(){
		$catTable='category';
		$sql="SELECT id,title FROM $catTable WHERE status='1'";
		if($result=$this->con->query($sql)){
			$datas=[];
			while($row=$result->fetch_object()){
				$datas[]=$row;
			}
			return $datas;

		}
	}
}