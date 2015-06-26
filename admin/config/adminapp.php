<?php
/**
* class mainapp for routing
*/
class Adminapp{
	private $controller='siteController';
	private $method='index';
	private $parameter=[];
	function __construct(){
		$url=$this->parseUrl();
		if(isset($url[0])){
			if(file_exists(MAIN_DIR.DS.'application'.DS.'controllers'.DS.$url[0].'Controller.php')){
				$this->controller=$url[0].'Controller';
				unset($url[0]);
			}
		}
		$controller=new $this->controller;
		if(isset($url[1])){
			if(method_exists($controller, $url[1])){
				$this->method=$url[1];
				unset($url[1]);
			}
		}
		$this->parameter= $url ? $url :[];
		$method=$this->method;
		$controller->$method($this->parameter);
	}
	private function parseUrl(){
		$url=[];
		if(isset($_GET['url'])){
			$url= explode('/',filter_var(rtrim($_GET['url']),FILTER_SANITIZE_URL));
		}
		return $url;
	}
}
function __autoload($class){
	if(file_exists(MAIN_DIR.DS.'application'.DS.'controllers'.DS.$class.'.php')){
		include_once(MAIN_DIR.DS.'application'.DS.'controllers'.DS.$class.'.php');
	}
	if(file_exists(MAIN_DIR.DS.'application'.DS.'models'.DS.$class.'.php')){
		include_once(MAIN_DIR.DS.'application'.DS.'models'.DS.$class.'.php');
	}
	if(file_exists(PARENT_DIR.DS.'framework'.DS.$class.'.php')){
		include_once(PARENT_DIR.DS.'framework'.DS.$class.'.php');
	}
}
