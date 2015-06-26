<?php
/**
* class cartModel extends mainModel
*/
class cartModel extends mainModel{

	private $cartTable='cart';
	private $productTable='product';

	function __construct(){
		parent::__construct();	
	}

	// function to get  data for a  product 

	public function insertInto($productId){

		if(isset($_SESSION['productCart'])){
			if(in_array($productId, $_SESSION['productCart'])){
				return false;
				exit;
			}else{
				$_SESSION['productCart'][]=$productId;
			}
		}

		if(!isset($_SESSION['productCart'])){
			$_SESSION['productCart']=[];
			$_SESSION['productCart'][]=$productId;
		}

		$productSql="SELECT id,category_id,brand_id FROM $this->productTable WHERE id='$productId'";

		if($productResult=$this->con->query($productSql)){

			$productData=$productResult->fetch_object();

			$cartId=round(microtime(true) * 1000);
			$client_ip=$ip = getenv('HTTP_CLIENT_IP')?:
				getenv('HTTP_X_FORWARDED_FOR')?:
				getenv('HTTP_X_FORWARDED')?:
				getenv('HTTP_FORWARDED_FOR')?:
				getenv('HTTP_FORWARDED')?:
				getenv('REMOTE_ADDR');

			$cartId= $cartId+$client_ip+$productData->id;

			if(isset($_SESSION['cartId'])){
				$_SESSION['cartId'][]=$cartId;
			}else{
				$_SESSION['cartId']=[];
				$_SESSION['cartId'][]=$cartId;
			}


			$cartSql="INSERT INTO $this->cartTable(product_id,product_category_id,product_brand_id,unique_cart_id) VALUES($productData->id,$productData->category_id,$productData->brand_id,$cartId)";
				if($result=$this->con->query($cartSql)){
					return $result;
			}

		}
	}

	public function cartData($cartItem){

			$sql="SELECT $this->cartTable.*,$this->productTable.name AS name ,$this->productTable.price AS price FROM $this->cartTable LEFT JOIN $this->productTable ON $this->cartTable.product_id=$this->productTable.id WHERE $this->cartTable.unique_cart_id='$cartItem' LIMIT 1";
			if($result=$this->con->query($sql)){
				return $result->fetch_object();
			}
	}

	public function updatequantity($datas){
		$inputdata=['quantity'=>$datas['quantity']];
		$item=$datas['id'];
		$result=$this->update($this->cartTable,$inputdata,$item);
		return $result;
	}

	
	private function alreadyIncart($cartId){
		$sql="SELECT * FROM $this->cartTable WHERE unique_cart_id='$cartId' LIMIT 1";
		if($result=$this->con->query($sql)){
			return $result->fetch_object();
		}else{
			return false;
		}
	}

}