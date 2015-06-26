<?php
/**
* class memberModel
*/
class memberModel extends mainModel{
	private $table='member';

	// ===============================================
	// function to return the tableFields required  to show the data in datalist
	public function tableFields(){
		return [
				'id'=>"Id",
				'name'=>'Name',
				'email'=>'Email',
				'mobile'=>'Mobile',
				'last_login_ip'=>'Last Login Id',
				'date'=>'Date',
				'status'=>'Stauts'
				];
	}
	// =========================================================

	// ============================================================
	// function to insertData into database table
	public function insertData($inputdata){
		$result=$this->insert($this->table,$inputdata);
		return $result;
	}
	// =============================================================

	// ===========================================================
	// function to getAllData supporting pagination
	public function getAllData($offset='1'){
		$limit=5;

		$joinCondition="SELECT * FROM $this->table WHERE status='1' ";
		
		if(isset($_SESSION['memberSearch']) && !empty($_SESSION['memberSearch'])){
		 	$searchby=$_SESSION['memberSearch']['searchby'];
		 	$searchkey=$_SESSION['memberSearch']['searchkey'];
		 	$joinCondition.="  AND $searchby LIKE '%$searchkey%' ";
	 	}

		$result=$this->selectall($this->table,$offset,$limit,$joinCondition);
		return $result;
	}
	// =======================================================

	// =======================================================
	// function to find the total no of row in member table for pagination
		public function countRow(){
				$condition="WHERE status='1' ";

				if(isset($_SESSION['memberSearch']) && !empty($_SESSION['memberSearch'])){
				 	$searchby=$_SESSION['memberSearch']['searchby'];
				 	$searchkey=$_SESSION['memberSearch']['searchkey'];
				 	$condition.=" AND $searchby LIKE '%$searchkey%'";
				 }
				$result=$this->countAllRow($this->table,$condition);
				return $result;
		}
	// ========================================================

	// ========================================================
	public function getitemData($item){
		$result=$this->itemData($this->table,$item);
		return $result;
	}
	// =========================================================

	// ========================================================
	public function updateItem($inputdata,$item){
		$result=$this->update($this->table,$inputdata,$item);
		return $result;
	}
	// ==========================================================

	// ===========================================================
	public function  deleteItem($item){
		$result=$this->delete($this->table,$item);
		return $result;
	}

}