<?php
session_start();
define('MAIN_DIR',__DIR__);
define('DS',DIRECTORY_SEPARATOR);
define('link_url','http://'.$_SERVER['HTTP_HOST'].'/electronics/');
include_once('config/mainapp.php');
$app=new Mainapp;


