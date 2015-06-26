<?php
/**
* class mainModel
*/
class mainModel extends dbConfig{
	function __construct(){
		parent::__construct();
	}
	public function login($table,$username,$password){
		$sql="SELECT fullname,email,id FROM $table WHERE username='$username' AND password='$password' AND status=1";
		if($result=$this->con->query($sql)){
			return $result->fetch_object();
		}else{
			false;
		}
	}
	public function selectall($table,$offset=1,$limit=5,$joinCondition=''){
		$ofset=($offset-1)*$limit;
		

		$sql='';
		
		if(!empty($joinCondition)){
			$sql="$joinCondition ORDER BY id DESC LIMIT $ofset,$limit";
		}else{
			$sql="SELECT * FROM $table ORDER BY id DESC LIMIT $ofset,$limit";
		}
		
		$datas=[];
		if($result=$this->con->query($sql)){
			$datas=[];
			while($row=$result->fetch_object()){
				$datas[]=$row;
			}
				
		}
		return $datas;	
	}
	public function countAllRow($table,$condition=''){
		$totalRows=0;
		$sql="SELECT id FROM $table ";
		if(!empty($condition)){
			$sql.= $condition;
		}
		if($result=$this->con->query($sql)){

			$totalRows= $result->num_rows;
		}
		return $totalRows;
	}
	public function insert($table,$inputdata){
		$keys=array_keys($inputdata);
		$values=array_values($inputdata);
		$sql= "INSERT INTO $table(";
		$sql.=implode(',', $keys);
		$sql.=") VALUES ('";
		$sql.=implode("','", $values);
		$sql.="')";
		if($result=$this->con->query($sql)){
			return $result;
		}else{
			echo $this->con->error;
			
		}

	}
	public function update($table,$inputdata,$item){
		$dataset=[];
		foreach($inputdata as $key=>$value){
			$dataset[]="$key='$value'";
		}
		$sql="UPDATE $table SET ";
		$sql.=implode(',', $dataset);
		$sql.=" WHERE id='$item'";
		if($result=$this->con->query($sql)){
			return $result;
		}else{
			return false;
		}

	}
	public function itemData($table,$item,$joinCondition=''){
		if(!empty($joinCondition)){
			$sql="$joinCondition WHERE $table.id='$item'";
		}else{
			$sql="SELECT * FROM $table WHERE id='$item'";
		}		
		if($result=$this->con->query($sql)){
			return $result->fetch_object();
		}
	}
	public function delete($table,$item){
		$sql="DELETE  FROM $table WHERE id='$item'";
		if($result=$this->con->query($sql)){
			return $result;
		}
	}
}