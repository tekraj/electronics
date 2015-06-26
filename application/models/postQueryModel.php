<?php
/**
* class postQuery model to get posts in page
*/
class postQueryModel extends mainModel{
	private $table='cms_post';
	private $catTable='cms_category';
	function __construct()	{
		parent::__construct();
	}

	public function cmsQuery($category,$postPerPage=5,$postOrder='ASC'){

		// array to store the post data
		$data=[];
		// sql to get the id of the category
		$catSql="SELECT * FROM $this->catTable WHERE url='$category' OR id='$category' LIMIT 1";
		if($catResult=$this->con->query($catSql)){
			$catData=$catResult->fetch_object();
			$catId=$catData->id;

			// sql to get the posts

			$postSql="SELECT * FROM $this->table WHERE cms_category_id='$catId' ORDER BY id $postOrder LIMIT $postPerPage";
			if($postResult=$this->con->query($postSql)){
				while($row=$postResult->fetch_object()){
					$data[]=$row;
				}
			}
		}

		return $data;
	}


	// function to get a single post

	public function singlePost($postId){
		$sql="SELECT * FROM $this->table WHERE id='$postId' LIMIT 1";

		if($result=$this->con->query($sql)){
			return $result->fetch_object();
		}
	}
}