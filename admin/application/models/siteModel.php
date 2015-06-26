<?php
/**
* class siteModel extends mainModel
*/
class siteModel extends mainModel{

	
	function __construct(){
		parent::__construct();
	}

	public function getDateData($post){
		$type=$post['type'];
		$orderTable='orderproduct';
		$data=[];
		$data=[];
		$currentYear=date('Y');
		$currentMonth=date('m');
		$thisDay=date('d');
		$curretWeekDay=date('w');

		if($type=='week'){
			$weekFirstDay=($thisDay-($curretWeekDay+1))-7;
			$weekLastDay=$thisDay-($curretWeekDay+1);

			for($weekFirstDay; $weekFirstDay<$weekLastDay; $weekFirstDay++){
				$data[$weekFirstDay]=[];
				$nextDay=intval($weekFirstDay)-1;


				$tstring1=$currentMonth.'/'.$weekFirstDay.'/'.$currentYear;
				$time1=strtotime($tstring1);
				$date1=date('Y-m-d',$time1);

				$tstring2=$currentMonth.'/'.$nextDay.'/'.$currentYear;
				$time2=strtotime($currentYear.'/'.$currentMonth.'/'.$nextDay);
				$date2=date('Y-m-d',$time2);

				$sql="SELECT sum(quantity) AS quantity FROM $orderTable WHERE  date BETWEEN '$date2' AND '$date1' ";
				if($result=$this->con->query($sql)){
					while($row=$result->fetch_object()){
						$data[$weekFirstDay][]=$row;
					}
				}


			}
		}

		elseif($type=='month'){

			$firstMonth=1;
			for($firstMonth; $firstMonth<=$currentMonth; $firstMonth++){
				$data[$firstMonth]=[];
				$nextMonth=($firstMonth+1);


				$tstring1=$firstMonth.'/1/'.$currentYear;
				$time1=strtotime($tstring1);
				$date1=date('Y-m-d',$time1);

				

				$tstring2=$nextMonth.'/1/'.$currentYear;;
				$time2=strtotime($tstring2);
				$date2=date('Y-m-d',$time2);


				$sql="SELECT sum(quantity) AS quantity FROM $orderTable WHERE  date BETWEEN '$date1' AND '$date2' ";
				if($result=$this->con->query($sql)){
					while($row=$result->fetch_object()){
						$data[$firstMonth][]=$row;
					}
				}
			}
			
		}

		elseif($type=='year'){
			$firstYear=2010;

			for($firstYear; $firstYear<=$currentYear; $firstYear++){
				$data[$firstYear]=[];
				$nextYear=intval($firstYear)-1;


				$tstring1='01/1/'.$firstYear;
				$time1=strtotime($tstring1);
				$date1=date('Y-m-d',$time1);

				$tstring2='01/1/'.$nextYear;
				$time2=strtotime($tstring2);
				$date2=date('Y-m-d',$time2);

				$sql="SELECT sum(quantity) AS quantity FROM $orderTable WHERE  date BETWEEN '$date2' AND '$date1' ";
					
				if($result=$this->con->query($sql)){
					while($row=$result->fetch_object()){
						$data[$firstYear][]=$row;
					}
				}
			}
		
		}	

		return $data;

	}

	// function to find the no of members online currently

	public function memberOnline(){

		$currentDate=date('Y-m-d h:m:s');
		$lastLoginTime=date('Y').'-'.date('m').'-'.date('d').'  '.date('h').':'.(date('m')-3).':'.date('s');
		$sql="SELECT id FROM member WHERE last_login_time BETWEEN '$lastLoginTime' AND '$currentDate'";

		if($result=$this->con->query($sql)){
			return $result->num_rows;
		}


	}

	// function to detect new message
	public function newMessageDetection(){
		$memberChatTable='membermessage';
		$userChatTable='usermessage';
		$data=[];
		if(isset($_SESSION['oldMessage'])){

			$oldId=$_SESSION['oldMessage'];

			$messageSql="SELECT * FROM $memberChatTable WHERE status='1'";
			
			if($messageResult=$this->con->query($messageSql)){
				while($row=$messageResult->fetch_object()){
					$data[]=$row;
				}
			}
			$newId='';
			if(count($data)>0){
				$newId=$data[(count($data)-1)]->id;

			}
			
			if($oldId!=$newId){
				$memberId=$data[(count($data)-1)]->member_id;
				$sql="SELECT id,email FROM member WHERE id='$memberId' LIMIT 1";
				if($result=$this->con->query($sql)){
					$memberDetail=$result->fetch_object();
				}
				$data[]=['memberdetail'=>$memberDetail];

			}else{

				$data=false;
			}	

			$_SESSION['oldMessage']=$newId;

		}else{
			$messageSql="SELECT * FROM $memberChatTable WHERE status='1'";
			$data=[];
			if($messageResult=$this->con->query($messageSql)){
				while($row=$messageResult->fetch_object()){
					$data[]=$row;
				}
			}
			$_SESSION['oldMessage']=$data[(count($data)-1)]->id;

			$data=false;
		}

		return $data;
	}

	// function to send  message to the client

	public function messageSend($messageData){
		
		$table='usermessage';

		$result=$this->insert($table,$messageData);
		return $result;

	}

	// function to return a single message from a perticular member
	public function singleMessageDetection($memberId){
		$memberChatTable='membermessage';
		$returnData=false;
		if(isset($_SESSION['singleMember'.$memberId])){

			$oldId=$_SESSION['singleMember'.$memberId];

			$sql="SELECT * FROM $memberChatTable WHERE member_id='$memberId' ";
			$data=[];

			if($result=$this->con->query($sql)){
				while($row=$result->fetch_object()){
					$data[]=$row;
				}
			}

			if(count($data)>0){

				$newId=$data[(count($data)-1)]->id;
				if($newId !=$oldId){
					$_SESSION['singleMember'.$memberId]=$newId;
					$returnData= $data[(count($data)-1)];
				}
			}
			
		}else{
			$sql="SELECT * FROM $memberChatTable WHERE member_id='$memberId'";
			// echo $sql;
			$data=[];
			if($result=$this->con->query($sql)){

				while($row=$result->fetch_object()){
					$data[]=$row;
				}
			}

			if(count($data) >0 ){
				$_SESSION['singleMember'.$memberId]=$data[(count($data)-1)]->id;
				echo $_SESSION['singleMember'.$memberId];
			}
		}

		return $returnData;
		
	}
	/*
	* functiont to get the chat history
	*/
	public function getChatHistory($memberId){
		$memberChatTable='membermessage';
		$userChatTable='usermessage';

		$sql="SELECT $memberChatTable.*,$userChatTable.message AS sendmessage FROM $memberChatTable LEFT JOIN  $userChatTable ON $memberChatTable.id=$userChatTable.membermessage_id  WHERE $memberChatTable.member_id='$memberId' ";
		$data=[];

		if($result=$this->con->query($sql)){
			while($row=$result->fetch_object()){
				$data[]=$row;
			}
			return $data;
		}else{
			return false;
		}		
		
	}



}