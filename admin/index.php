<?php
session_start();
if(!isset($_SESSION['user'])){
	header('location:/electronics/login.php');
}

define('MAIN_DIR',__DIR__);
define('PARENT_DIR',dirname(MAIN_DIR));
define('DS',DIRECTORY_SEPARATOR);
define('link_url','http://'.$_SERVER['HTTP_HOST'].'/electronics/admin/');
include_once('config/adminapp.php');
include_once 'ckeditor/ckeditor.php';
$ckeditor = new CKEditor();
$ckeditor->basePath = '/ckeditor/';
$ckeditor->config['filebrowserBrowseUrl'] = '/ckfinder/ckfinder.html';
$ckeditor->config['filebrowserImageBrowseUrl'] = '/ckfinder/ckfinder.html?type=Images';
$ckeditor->config['filebrowserFlashBrowseUrl'] = '/ckfinder/ckfinder.html?type=Flash';
$ckeditor->config['filebrowserUploadUrl'] = '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
$ckeditor->config['filebrowserImageUploadUrl'] = '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
$ckeditor->config['filebrowserFlashUploadUrl'] = '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';
$app=new Adminapp;

$checkController=new userController;
$result=$checkController->sessionCheck($_SESSION['user']);
if($result==false):
 ?>
<script>
	window.location.assign(' /electronics/login.php');
</script>
<?php endif;
