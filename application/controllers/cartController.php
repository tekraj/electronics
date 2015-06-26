<?php
/**
* class cartController extends mainController 
*/
class cartController extends mainController{
	
	private $model=null;
	function __construct(){
		$this->model=new cartModel;
	}
	// ============================
	// method for loading index page

	public function index(){
		$data['title']='cart';
		$data['cartData']=[];
		if(isset($_SESSION['cartId'])){
			foreach($_SESSION['cartId'] as $cartItem){
				$data['cartData'][]=$this->model->cartData($cartItem);
			}
			
		}
		
		$this->loadView('cart',$data);
	}

	// index end
	// ===========================

	public function addtocart(){
		$productId=$_POST['id'];
		$cartResult=$this->model->insertInto($productId);
		if($cartResult==true){
			$message=['status'=>true];
			echo json_encode($message);
		}else{
			$message=['status'=>false];
			echo json_encode($message);
		}
		

	}

	public function addquantity(){
		$result=$this->model->updatequantity($_POST);
		if($result==true){
			$message=['status'=>true];
			echo json_encode($message);
		}else{
			$message=['status'=>false];
			echo json_encode($message);
		}

	}

}