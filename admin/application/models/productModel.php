<?php
/**
* class productModel
*/
class productModel extends mainModel{

	private $table='product';

	function __construct(){
		parent::__construct();
	}
	
	// =========================================
	// function tot set table fields for showing data in datalis
	public function tableFields(){
		return [
				'id'=>"Id",
				'name'=>'Name',
				'price'=>'Price',
				'brand'=>'Brand',
				'category'=>'Category',
				'date'=>'Date',
				'status'=>'Stauts'
				];
	}
	// ===========================================

	// ================================================
	// function to insert data into product table
	// @param $inputdata represents the data that we have to insert
	public function insertData($inputdata){
		$result=$this->insert($this->table,$inputdata);
		if($result==true){
			return $this->con->insert_id;
		}else{
			return false;
		}
	}
	// ====================================================

	// ====================================================
	// function getAllData to get the data from product table and supports pagination
	// @param $offset represents the page no
	public function getAllData($offset='1'){
		$categoryTable='category';
		$brandTable='brand';
		$limit=5;
		$joinCondition='';
		
		$joinCondition="SELECT $this->table.*,$categoryTable.title AS category,$brandTable.name AS brand FROM $this->table
		 LEFT JOIN $categoryTable ON $this->table.category_id=$categoryTable.id 
		 LEFT JOIN $brandTable ON $this->table.brand_id=$brandTable.id WHERE $this->table.status='1' ";

		 if(isset($_SESSION['productSearch']) && !empty($_SESSION['productSearch'])){
		 	$searchby=$_SESSION['productSearch']['searchby'];
		 	$searchkey=$_SESSION['productSearch']['searchkey'];
		 	$joinCondition.="  AND $this->table.$searchby LIKE '%$searchkey%' ";
		 }

		$result=$this->selectall($this->table,$offset,$limit,$joinCondition);
		return $result;
	}
	// ====================================================

	// =====================================================
	// 
	public function countRow(){
		$condition="WHERE status='1' ";

		if(isset($_SESSION['productSearch']) && !empty($_SESSION['productSearch'])){
		 	$searchby=$_SESSION['productSearch']['searchby'];
		 	$searchkey=$_SESSION['productSearch']['searchkey'];
		 	$condition.=" AND $searchby LIKE '%$searchkey%'";
		 }
		$result=$this->countAllRow($this->table,$condition);
		return $result;
	}
	// =======================================================

	// =======================================================
	public function getitemData($item){
		$categoryTable='category';
		$brandTable='brand';
		$joinCondition="SELECT $this->table.*,$categoryTable.title AS category,$brandTable.name AS brand  FROM $this->table
		 LEFT JOIN $categoryTable ON $this->table.category_id=$categoryTable.id 
		 LEFT JOIN $brandTable ON $this->table.brand_id=$brandTable.id";
		$result=$this->itemData($this->table,$item,$joinCondition);
		return $result;
	}
	// =========================================================


	// =========================================================
	public function updateItem($inputdata,$item){
		$result=$this->update($this->table,$inputdata,$item);
		return $result;
	}
	// ========================================================

	// ========================================================
	public function  deleteItem($item,$table=''){
		$table = !empty($table) ? $table : $this->table;
		$result=$this->delete($table,$item);
		return $result;
	}
	// ========================================================
	public function getCategory(){
		$sql="SELECT id,title FROM category";
		$result=$this->con->query($sql);
		$datas=[];
		while($row=$result->fetch_object()){
			$datas[]=$row;
		}
		return $datas;
	}
	// =========================================================
	public function getBrand($catId=''){
		$sql='';
		if(!empty($catId)){
			$sql="SELECT id,name FROM brand WHERE category_id='$catId' AND status='1'";
		}else{
			$sql="SELECT id,name FROM brand WHERE status='1'";
		}
		
		$result=$this->con->query($sql);
		$datas=[];
		while($row=$result->fetch_object()){
			$datas[]=$row;
		}
		return $datas;
	}
	// =======================================================

	// =========================================================
	// function to get the ids of category or brand table if searched with category or brand option
	public function getSearchItemsId($searchTable,$keyword){
		$sql="SELECT * FROM $searchTable WHERE status='1' AND url LIKE '%$keyword%' LIMIT 1";
		
		if($result=$this->con->query($sql)){
			return $result->fetch_object();
		}
	}
	// ========================================================
	public function insertImage($images,$lastId,$table){
		$imageCond=false;
		foreach($images as $image){
			$inputData=['image'=>$image,'product_id'=>$lastId];
			$result=$this->insert($table,$inputData);
			if($result){
				$imageCond=true;
			}else{
				$imageCond=false;
			}
		}

		return $imageCond;
	}
	// ============================================================

	public function updateImage($images){
		$table='product_image';
		print_r($images);
		for($i=1;$i<=4;$i++){
			$updateData=['image'=>$images['image'.$i]];
			$id=$images['id'.$i];
			$this->update($table,$updateData,$id);
		}
	}
	// ==============================================================

	public function getItemImage($item){
		$product_imageTable='product_image';
		$sql="SELECT * FROM $product_imageTable WHERE product_id='$item' LIMIT 4";
		$imgData=[];
		if($result=$this->con->query($sql)){
			while ($row=$result->fetch_object()) {
				$imgData[]=$row;
			}
		}

		return $imgData;
	}
	// ===============================================================
	public function getStock($item){
		$stockTable='product_stock';
		$orderproduct='orderproduct';
		$sql="SELECT sum(stock) AS stock FROM $stockTable WHERE product_id='$item'";
		if($result=$this->con->query($sql)){

			$productStock=$result->fetch_object();
			$orderSql="SELECT sum(quantity) AS quantity FROM $orderproduct WHERE cart_product_id='$item'";
			if($orderResult=$this->con->query($orderSql)){

				$orderStock=$orderResult->fetch_object();
				return ($productStock->stock - $orderStock->quantity);
			}else{
				return false;
			}
		}else{
			return false;
		}
		
	}
	// ================================================================

	// ==================================================================
	public function addStock($item,$quantity){
		$stockTable='product_stock';
		$sql="INSERT INTO $stockTable(product_id,stock) VALUES($item,$quantity)";
		$result=$this->con->query($sql);
		return $result;
	}

}