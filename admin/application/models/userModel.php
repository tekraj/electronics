<?php
/**
* class userModel
*/
class userModel extends mainModel{
	public $table='user';
	public function tableFields(){
		return [
				'id'=>"Id",
				'fullname'=>'Full Name',
				'username'=>'User Name',
				'email'=>'Email',
				'date'=>'Date',
				'status'=>'Stauts'
				];
	}
	public function insertData($inputdata){
		$result=$this->insert($this->table,$inputdata);
		return $result;
	}
	public function getAllData($offset='1'){
		$limit=5;

		$joinCondition="SELECT * FROM $this->table WHERE status='1' ";
		
		if(isset($_SESSION['userSearch']) && !empty($_SESSION['userSearch'])){
		 	$searchby=$_SESSION['userSearch']['searchby'];
		 	$searchkey=$_SESSION['userSearch']['searchkey'];
		 	$joinCondition.="  AND $searchby LIKE '%$searchkey%' ";
	 	}

		$result=$this->selectall($this->table,$offset,$limit,$joinCondition);
		return $result;
	}
	public function countRow(){
		$condition="WHERE status='1' ";

		if(isset($_SESSION['userSearch']) && !empty($_SESSION['userSearch'])){
		 	$searchby=$_SESSION['userSearch']['searchby'];
		 	$searchkey=$_SESSION['userSearch']['searchkey'];
		 	$condition.=" AND $searchby LIKE '%$searchkey%'";
		 }
		$result=$this->countAllRow($this->table,$condition);
		return $result;
	}
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

	public function getSessionData($sessionData){

		$id=$sessionData->id;
		$fullname=$sessionData->fullname;
		$email=$sessionData->email;
		$sql="SELECT id,fullname,email FROM $this->table WHERE id='$id' AND fullname='$fullname' AND email='$email' ";
		if($result=$this->con->query($sql)){
			return true;
		}else{
			return false;
		}
	}

}