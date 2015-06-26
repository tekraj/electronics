<?php
/**
* class orderModel
*/
class orderModel extends mainModel{
	public $orderTable='ordertable';
	public $memberTable='member';
	function __construct(){
		parent::__construct();
	}

	// ==========================================
	// function to set the tableFields for showing data in datalist
	public function tableFields(){
		return [
				'id'=>"Id",
				'order_id'=>'Order ID',
				'totalprice'=>'Total Amount',
				'email'=>'Member Email',
				'paymentmethod'=>'Payment Method',
				'date'=>'Date'
				];
	}
	// functiont to return the table fields for viewDetail about ordered products
		public function detailFields(){
		return [
				'id'=>"Id",
				'productName'=>'Product Name',
				'brandName'=>'Brand',
				'categoryName'=>'Category',
				'price'=>'Price',
				'quantity'=>'Quantity',
				'date'=>'Sold Date'
				];
	}
	// ==========================================


	// ===================================================
	// function to get all data of order table supporting pagination
	// @param $offset for pagination indicaties the page no
	public function getAllData($offset='1'){
		$limit=5;

		$categoryTable='category';
		$joinCondition="SELECT $this->orderTable.*,$this->memberTable.email AS email FROM $this->orderTable LEFT JOIN $this->memberTable ON $this->orderTable.member_id=$this->memberTable.id";

		if(isset($_SESSION['orderSearch']) && !empty($_SESSION['orderSearch'])){
		 	$searchby=$_SESSION['orderSearch']['searchby'];
		 	$searchkey=$_SESSION['orderSearch']['searchkey'];
		 	$joinCondition.="  AND this->orderTable.$searchby LIKE '%$searchkey%' ";
	 	}

		$result=$this->selectall($this->orderTable,$offset,$limit,$joinCondition);
		return $result;
	}
	// =======================================

	// =================================================
	// function to count the total no of row for pagination from orderTable
		public function countRow(){
				$condition="WHERE 1 ";

				if(isset($_SESSION['orderSearch']) && !empty($_SESSION['orderSearch'])){
				 	$searchby=$_SESSION['orderSearch']['searchby'];
				 	$searchkey=$_SESSION['orderSearch']['searchkey'];
				 	$condition.=" AND $searchby LIKE '%$searchkey%'";
				 }
				$result=$this->countAllRow($this->orderTable,$condition);
				return $result;
		}
	// =====================================================

	// =========================================================
	// function to get the data of a single item
	// @param $item represents the id of the item
	public function getitemData($item){
		$result=$this->itemData($this->orderTable,$item);
		return $result;
	}

	// ==============================================
	// function to update the data
	public function updateItem($table,$inputdata,$item){
		$result=$this->update($table,$inputdata,$item);
		return $result;
	}
	// =====================================================

	// function to update order product (Generally for verifying the delivery and payment of an order)
	public function updateOrderProduct($table,$item){
		$sql="UPDATE $table SET status='1' WHERE ordertable_id='$item'";
		if($this->con->query($sql)){
			return true;
		}else{
			return ($this->con->error);
		}
	}
	// ====================================================
	// function to get all products of a perticular order
	public function orderDetail($item){
		$table='orderproduct';
		$productTable='product';
		$brandTable='brand';
		$categoryTable='category';
		$sql="SELECT $table.*,$productTable.name AS productName,$productTable.price AS price,$brandTable.name AS brandName,$categoryTable.title AS categoryName FROM $table
		LEFT JOIN $productTable ON $table.cart_product_id=$productTable.id
		LEFT JOIN $brandTable ON $table.cart_product_brand_id=$brandTable.id
		LEFT JOIN $categoryTable ON $table.cart_product_category_id=$categoryTable.id
		 WHERE $table.ordertable_id='$item'";

		 $data=[];
		if($result=$this->con->query($sql)){
			while($row=$result->fetch_object()){
				$data[]=$row;
			}
		}

		return $data;

	}


	public function todaysDelivery(){
		$table='ordertable';
		$startdate=date('Y').'/'.date('m').'/'.date('d').'  01:0:0';
		$startdate=strtotime($startdate);
		$startdate=date('Y-m-d h:m:s',$startdate);

		$now=date('Y').'/'.date('m').'/'.date('d').' '.date('h').':00:00';
		$now=strtotime($now);
		$now=date('Y-m-d h:m:s',$now);
		
		$sql="SELECT id FROM $table WHERE  status='1' AND delivery_date BETWEEN '$startdate' AND '$now' ";
		
		if($result=$this->con->query($sql)){
			
			return $result->num_rows;
		}
	}
	public function todaysOrder(){
		$table='ordertable';
		$currentHour=date('h');

		$startdate=date('Y').'/'.date('m').'/'.date('d').' 01:0:0';
		$startdate=strtotime($startdate);
		$startdate=date('Y-m-d h:m:s',$startdate);

		$now=date('Y').'/'.date('m').'/'.date('d').' '.date('h').':00:00';
		$now=strtotime($now);
		$now=date('Y-m-d h:m:s',$now);
		
		$sql="SELECT id FROM $table WHERE  date BETWEEN '$startdate' AND '$now'";
		
		$data=[];
		if($result=$this->con->query($sql)){
			
			return $result->num_rows;
		}
	}


}