<?php
/**
* class site controller
*/
class siteController extends mainController{

	private $model=null;

	function __construct(){
		$this->model=new siteModel;
	}

	public function index($parameter=[]){
		$data['title']='index';
		$data['parameter']=$parameter;
		$this->loadView('index',$data);
	}

	public function getGraphData(){
		$type=$_POST;
		
		$result=$this->model->getDateData($type);

		echo json_encode($result);

	}

	// function to find the no of members online currently
	public function onlineMember(){
		$result=$this->model->memberOnline();
		echo $result;
	}

	// function to detect the new message

	public function detectMessage(){

		$result=$this->model->newMessageDetection();

		if($result!==false){
			echo json_encode($result);
		}else{
			echo 'false';
		}
	}

	public function sendMessage(){
		$messageData=$_POST;
		$result=$this->model->messageSend($messageData);
		if($result==true){
			echo 'true';
		}else{
			echo "false";
		}
	}

	public function singleMessageCheck(){
		$memberId=$_POST['memberId'];
		$result=$this->model->singleMessageDetection($memberId);
		if($result!=false){
			echo json_encode($result);
		}else{
			echo 'false';
		}
		
	}

	public function chatHistory(){
		$memberId=$_POST['memberId'];
		$result=$this->model->getChatHistory($memberId);
		if($result!=false){
			echo json_encode($result);
		}else{
			echo 'false';
		}
		
	}
}