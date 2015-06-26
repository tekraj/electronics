<?php
/**
* class mainController
*/
class  mainController{
	public function loadView($page,$data=[]){
		foreach($data as $key=>$value){
			$$key=$value;
		}
		include_once(MAIN_DIR.DS.'application'.DS.'views'.DS.'includes'.DS.'header.php');
		include_once(MAIN_DIR.DS.'application'.DS.'views'.DS.$page.'.php');
		include_once(MAIN_DIR.DS.'application'.DS.'views'.DS.'includes'.DS.'footer.php');
	}
}
