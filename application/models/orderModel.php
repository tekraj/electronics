<?php
/**
* class orderModel extends Mainmodel
*/
class orderModel extends mainModel{
	public $orderTable='ordertable';
	public $cartTable='cart';
	public $productTable='product';
	public $orderProductTable='orderProduct';
	function __construct(){
		parent::__construct();
	}
	
	public function getProductDetail($products=[]){
		$productDatas=[];
		if(is_array($products)){
			foreach($products as $ids){
				$sql="SELECT $this->productTable.*,$this->cartTable.id AS c_id,$this->cartTable.quantity as quantity FROM $this->productTable   INNER JOIN $this->cartTable ON $this->productTable.id=$this->cartTable.product_id WHERE $this->productTable.id='$ids'";
				if($result=$this->con->query($sql)){
					$productDatas[]=$result->fetch_object();
				}
			}			
		}

		return $productDatas;
	}

	public function productOrder($inputData=[]){
		$condition=1;
		$orderId=round(microtime(true) * 1000);
		$client_ip=$ip = getenv('HTTP_CLIENT_IP')?:
			getenv('HTTP_X_FORWARDED_FOR')?:
			getenv('HTTP_X_FORWARDED')?:
			getenv('HTTP_FORWARDED_FOR')?:
			getenv('HTTP_FORWARDED')?:
			getenv('REMOTE_ADDR');
		$member_id=$_SESSION['member']->id;
		$orderId=$orderId.$member_id.$client_ip;

		$orderDetail=$inputData['orderDetail'];
		$orderDetail['order_id']=$orderId;
		$cartId=$inputData['cartId'];
		if($result=$this->insert($this->orderTable,$orderDetail)){

			$_SESSION['orderId']=$orderId;

			foreach($cartId as $item){
				$updatedata=['status'=>1];
				if($this->update($this->cartTable,$updatedata,$item)){
				}else{
					$condition=$this->con->error;
				}

			}
			$orderSql="SELECT id,member_id FROM $this->orderTable WHERE order_id='$orderId' LIMIT 1";
			if($oData=$this->con->query($orderSql)){
				$orderData=$oData->fetch_object();
				$orderProductId=$orderData->id;
				$orderProductMember=$orderData->member_id;
				foreach($cartId as $item){
					$cartSql="SELECT $this->cartTable.*,$this->productTable.price AS price FROM $this->cartTable INNER JOIN $this->productTable ON $this->cartTable.product_id=$this->productTable.id WHERE $this->cartTable.id='$item' LIMIT 1";
					if($cartResult=$this->con->query($cartSql)){
						$cartData=$cartResult->fetch_object();
						$cart_id=$cartData->id;
						$cart_quantity=$cartData->quantity;
						$price=$cartData->price;
						$totalprice=($cart_quantity * $price);
						$cart_product_id=$cartData->product_id;
						$cart_category_id=$cartData->product_category_id;
						$cart_brand_id=$cartData->product_brand_id;
						$productOrdersql="INSERT INTO $this->orderProductTable(order_id,quantity,totalprice,cart_id,cart_product_id,cart_product_category_id,cart_product_brand_id,ordertable_id,ordertable_member_id ) VALUES('$orderId','$cart_quantity','$totalprice','$cart_id','$cart_product_id','$cart_category_id','$cart_brand_id','$orderProductId','$orderProductMember')";
						if($this->con->query($productOrdersql) ==false){
							$condition=$this->con->error;
						}
					}else{
						$condition=$this->con->error;
					}
					
				}
			}else{
				$condition=$this->con->error;
			}			
				
		}else{
			$condition=$result;
		}
		return $condition;		
		
	}
	// Function to insert paypal info into database

	function insertpayPalInfo($paypalData){
		$orderTable='ordertable';
		$orderId=$_SESSION['orderId'];
		$orderSql="SELECT id FROM $orderTable WHERE order_id='$orderId' LIMIT 1";
		if($orderResult=$this->con->query($orderSql)){
			$orderData=$orderResult->fetch_object();
			$result=$this->update($orderTable,$paypalData,$orderData->id);
			if($result){
				$_SESSION['orderId']=null;
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
		
	}
}