<?php
//开启session
session_start();

define('IN_PHP', '1');
include_once 'mysql.class.php'; //数据库的类
include_once 'Page.class.php';	//分页的类
include_once 'Upload.class.php';	//文件上传的类

//实例化 操作数据库的类
$dbObj = new db_mysql('127.0.0.1','root','lblp82nlf','php');




function checklogin(){
	// 判断是否有用户登录
	//取登录后保存的$_SESSION['UNAME']值，取的到就对，取为空就非法	
	global $uname;
	$uname=isset($_SESSION['UNAME'])?$_SESSION['UNAME']:'';
	if($uname == '')
	{
		echo "<script>";
		echo 'alert("非法访问");';
		echo 'location.href="login.php";';
		echo "</script>";
	}
}
?>