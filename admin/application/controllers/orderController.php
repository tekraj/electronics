<?php
/**
* class ordercontroller
*/
class orderController extends mainController{
	private $model=null;
	function __construct(){
		$this->model=new orderModel;
	}
	// ==============================================
	// function to render order page
	public function index($parameter=[]){
	
		$data['title']='order';
		$data['template']='';
		$item='';// variable to hold the id of an item
		$offset='1'; // variable to hold page no for pagination
		$defaultdata='';
		if(isset($parameter[1])){
			$data['template']=$parameter[1];
		}
		if(isset($parameter[2])){
			$item=$parameter[2];
			$offset=$parameter[2];
		}
		$data['tableFields']=$this->model->tableFields();
		$data['orderFields']=$this->model->detailFields();
		$data['tableData']=$this->model->getAllData($offset);
		$data['totalRow']=$this->model->countRow();
		$data['currentPage']=$offset;
		$data['orderDetail']=$this->model->orderDetail($item);
		$data['itemdata']=$this->model->getitemData($item);
		$this->loadView('order',$data);
	}
	// function index end
	// ==============================================
	public function veriyorder(){
		$postdata=$_POST['delivery'];
		$item=$postdata['id'];
		$orderTableData=['status'=>1,'delivery_date'=>date('Y-m-d h:m:s')];
		$updateResult=$this->model->updateItem('ordertable',$orderTableData,$item);

		if($updateResult){			
			$updateOrderResult=$this->model->updateOrderProduct('orderproduct',$item);
		}
		header('location:'.link_url.'order');
	}

		// ==========================================================
	// method for search data
	public function search(){
		if(isset($_POST['searchby']) && isset($_POST['searchkey'])){
			if(!empty($_POST['searchkey'])){
				$_SESSION['orderSearch']=[];
				$_SESSION['orderSearch']['searchby']=$_POST['searchby'];
				$_SESSION['orderSearch']['searchkey']=$_POST['searchkey'];
			}			
		}
		header('location:'.link_url.'order/');		
	}
	// method search end
	// ==========================================================

	// ==========================================================
	// method to delete the search parameters
	public function viewall(){
		if(isset($_SESSION['orderSearch'])){
			$_SESSION['orderSearch']=[];
		}
		header('location:'.link_url.'order/view');
	}

	public function getTodaysDelivery(){
		$result=$this->model->todaysDelivery();

		echo $result;
	}

		public function getTodaysOrder(){
		$result=$this->model->todaysOrder();

		echo $result;
	}


}