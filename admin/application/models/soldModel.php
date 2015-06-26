<?php
/**
* class orderModel
*/
class soldModel extends mainModel{
	
	private $orderTable='orderproduct';
	private $productOrder='ordertable';
	private $memberTable='member';
	private $categoryTable='category';
	private $brandTable='brand';
	private $productTable='product';
	function __construct(){
		parent::__construct();
	}
	public function tableFields(){
		return [
				'id'=>"Id",
				'name'=>'Product Name',
				'brand'=>'Brand',
				'category'=>'Category',
				'price'=>'Price',
				'quantity'=>'Quantity',
				'email'=>'Member Email',
				'paymentmethod'=>'Payment Method',
				'delivery_date'=>'Sold Date'
				];
	}
	public function getAllData($offset='1'){

		$limit=5;

		$joinCondition="SELECT $this->orderTable.*,
			$this->productOrder.paymentmethod AS paymentmethod,
			$this->productOrder.delivery_date AS delivery_date,
			$this->productTable.name AS name,$this->productTable.price AS price ,
			$this->brandTable.name AS brand,
			$this->categoryTable.title AS category,
			$this->memberTable.email AS email
			FROM $this->orderTable
			LEFT JOIN $this->productOrder ON $this->orderTable.ordertable_id=$this->productOrder.id
			LEFT JOIN $this->productTable ON $this->orderTable.cart_product_id=$this->productTable.id
			LEFT JOIN $this->brandTable ON $this->orderTable.cart_product_brand_id=$this->brandTable.id
			LEFT JOIN $this->categoryTable ON $this->orderTable.cart_product_category_id=$this->categoryTable.id
			LEFT JOIN $this->memberTable ON $this->orderTable.ordertable_member_id=$this->memberTable.id
			  WHERE $this->orderTable.status='1' 
			";

		 if(isset($_SESSION['soldSearch']) && !empty($_SESSION['soldSearch'])){
		 	$searchby=$_SESSION['soldSearch']['searchby'];
		 	$searchkey=$_SESSION['soldSearch']['searchkey'];
		 	$joinCondition.="  AND $this->orderTable.$searchby LIKE '%$searchkey%' ";
		 }

		$result=$this->selectall($this->orderTable,$offset,$limit,$joinCondition);
		return $result;
	}
	public function countRow(){
		$condition="WHERE status='1' ";

		if(isset($_SESSION['soldSearch']) && !empty($_SESSION['soldSearch'])){
		 	$searchby=$_SESSION['soldSearch']['searchby'];
		 	$searchkey=$_SESSION['soldSearch']['searchkey'];
		 	$condition.=" AND $searchby LIKE '%$searchkey%'";
		 }
		$result=$this->countAllRow($this->orderTable,$condition);
		return $result;
	}
	public function getitemData($item){
		$result=$this->itemData($this->orderTable,$item);
		return $result;
	}
	public function updateItem($table,$inputdata,$item){
		$result=$this->update($table,$inputdata,$item);
		return $result;
	}
	public function updateOrderProduct($table,$item){
		$sql="UPDATE $table SET status='1' WHERE ordertable_id='$item'";
		if($this->con->query($sql)){
			return true;
		}else{
			return ($this->con->error);
		}
	}

	// =========================================================
	// function to get the ids of category or brand table if searched with category or brand option
	public function getSearchItemsId($searchTable,$keyword){
		$sql="SELECT * FROM $searchTable WHERE status='1' AND url LIKE '%$keyword%' LIMIT 1";
		
		if($result=$this->con->query($sql)){
			return $result->fetch_object();
		}
	}
	// ========================================================

}