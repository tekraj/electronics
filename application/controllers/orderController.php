<?php
/**
* class orderController
*/
class orderController extends mainController{	
	public function index($parameter=[]){
		$model=new cartModel;
		$data['title']="order";
		$data['cartProduct']=[];
		if(isset($_SESSION['cartId'])){

			foreach($_SESSION['cartId'] as $cartItem){
				$data['cartProduct'][]=$model->cartData($cartItem);
			}					
		}
		
		$this->loadView('order',$data);	
	}
	public function placeorder(){
		$model=new orderModel;
		$result=$model->productOrder($_POST);
		if($result==1){
			$_SESSION['cartId']=[];
			$_SESSION['cartData']=[];
			$_SESSION['productCart']=[];
			$message=['status'=>true];
			echo json_encode($message);
		}else{
			$message=['status'=>false];
			echo json_encode($message);
		}
	}

	public function verifyPaypal(){
		$model=new orderModel;
		$result=$model->insertpayPalInfo($_POST);
		if($result){
			$message=['status'=>true];
			echo json_encode($message);
		}else{
			$message=['status'=>false];
			echo json_encode($message);
		}
	}


}
