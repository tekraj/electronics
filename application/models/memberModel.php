<?php
/**
* class memberModel extends mainModel
*/
class memberModel extends mainModel{

	private $memberTable='member';

	function __construct(){
		parent::__construct();	
	}

	public function registerMember($data){
		$data['password']=md5($data['password']);
		$result=$this->insert($this->memberTable,$data);
		return $result;
	}

	public function loginMember($data){

		$email=$data['email'];
		$password=md5($data['password']);
		$sql="SELECT id,email FROM $this->memberTable WHERE email='$email' AND password='$password' AND status='1' LIMIT 1";
		$result=$this->con->query($sql);

		return $result;
	}

	// =============================================
	// function to search the member email for sending link for reset password
	public function searchMember($email){
		$sql="SELECT * FROM $this->memberTable WHERE email='$email' AND status='1' LIMIT 1";
		if($result=$this->con->query($sql)){
			return $result->fetch_object();
		}else{
			return false;
		}
	}

	// function to insert the last login id into member table
	public function updateMemberTable($inputData,$item){
		$result=$this->update($this->memberTable,$inputData,$item);
		return $result;
	}

	// function to keep member online

	public function keepMemberOnline($inputData){
		$id=$inputData['id'];
		$email=$inputData['email'];

		$checkSql="SELECT id FROM $this->memberTable WHERE id='$id' AND email='$email'";
		$checkResult=$this->con->query($checkSql);

		if($checkResult->num_rows==1){
			$updateData=['last_login_time'=>date('Y-m-d h:m:s')];
			$result=$this->update($this->memberTable,$updateData,$id);
			if($result){
				return true;
			}
		}
	}

	// function to store message in membermessage table

	public function messageSend($inputData){
		$table='membermessage';
		$memberId=$inputData['memberId'];
		$message=$inputData['message'];

		$messageData=['message'=>$message,'member_id'=>$memberId];

		$result=$this->insert($table,$messageData);

		return $result;
	}

	// function to receive message

	public function getMessage($memberId){
		$returnData=false;
		$userTable='usermessage';

		if( isset($_SESSION['clientId'.$memberId]) ){

			$oldId=$_SESSION['clientId'.$memberId];

			$sql="SELECT * FROM $userTable WHERE membermessage_member_id='$memberId'";
			$data=[];
			if($result=$this->con->query($sql)){

				while($row=$result->fetch_object()){
					$data[]=$row;
				}
			}

			if(count($data) >0){

				$newId=$data[(count($data)-1)]->id;

				if($newId!=$oldId){

					$_SESSION['clientId'.$memberId]=$newId;

					$returnData=$data[(count($data)-1)];

				}
			}

		}else{

			$sql="SELECT * FROM $userTable WHERE membermessage_member_id='$memberId'";
			$data=[];
			if($result=$this->con->query($sql)){

				while($row=$result->fetch_object()){
					$data[]=$row;
				}
			}

			if(count($data) >0){

				$_SESSION['clientId'.$memberId]=$data[(count($data)-1)]->id;
			}
		}

		return $returnData;

	}
	

}