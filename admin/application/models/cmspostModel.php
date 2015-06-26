<?php
/**
* class cmsModel
*/
class cmspostModel extends mainModel{
	private $table='cms_post';
	function __construct(){
		parent::__construct();
	}
	// =========================================
	//  function to return the tableFields required to display data in datalist
	public function tableFields(){
		return [
				'id'=>"Id",
				'heading'=>'Heading',
				'type'=>'Type',
				'category'=>'Category',
				'date'=>'Date',
				'status'=>'Stauts'
				];
	}
	// function to add articles
	public function createPost($inputData){
		$result=$this->insert($this->table,$inputData);
		return $result;
	}
	// =========================================
	// function to get all data form cms tables
	public function getAllPost(){
		$categoryTable='cms_category';
		$data=[];
		$sql="SELECT $this->table.*,$categoryTable.title AS category FROM $this->table LEFT JOIN $categoryTable ON $this->table.cms_category_id=$categoryTable.id ORDER BY $this->table.id DESC";
		if($result=$this->con->query($sql)){
			while($row=$result->fetch_object()){
				$data[]=$row;
			}
		}

		return $data;

	}
	// =======================================================

	// =======================================================
	public function getitemData($item){		
		$joinCondition="";
		$result=$this->itemData($this->table,$item,$joinCondition);
		return $result;
	}
	// =========================================================


	// =========================================================
	public function updateItem($item,$updateData){
		$result=$this->update($this->table,$updateData,$item);
		return $result;
	}
	// ========================================================

	// ========================================================
	public function  deleteItem($item){
		$result=$this->delete($this->table,$item);
		return $result;
	}

	public function getCategory(){
		$categoryTable='cms_category';
		$sql="SELECT id,title FROM $categoryTable";
		$result=$this->con->query($sql);
		$datas=[];
		while($row=$result->fetch_object()){
			$datas[]=$row;
		}
		return $datas;
	}


}
