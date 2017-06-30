<?php
/**
 * 处理登录
 */
// 开启session一会会使用
// session_start();  不需要了includes.php里边开启了
include_once 'includes/includes.php';
//账号
$name = isset($_POST['name'])?$_POST['name']:'';
//密码
$pwd = isset($_POST['pwd'])?$_POST['pwd']:'';
//验证码
$auths=isset($_POST['auths'])?$_POST['auths']:'';
//是否记住密码
$isreg=isset($_POST['isreg'])?$_POST['isreg']:'';


// var_dump($_SESSION['code']);
$arr=explode('|',$_SESSION['code']);//获取code.php类生成的验证码
$code=$arr[0];//验证码
// echo $code;
$time=$arr[1];//验证码生成时间
$time=time()-$time;//时差
// // 先判断用户输入的验证码是否有效,再判断是否失效
if($time < 20){ //设置了5秒
	// echo $auths;  转化为大写
	if(strtoupper($auths)==$code){
// 		echo '验证码输入正确';
		//接着比对账号密码
		$sql = "select * from tb_urse where uname='{$name}'";
		$nameArr = $dbObj ->getone($sql); //不存在返回空数组
		if(empty($nameArr)){
			//没找到，即账号错了
			echo "<script>";
			echo 'alert("账号不存在");';
			echo 'location.href="login.php";';
			echo "</script>";
		}else{
			//找到,继续比对密码
			if(md5($pwd) == $nameArr['upwd']){
				//记住用户的名字
				$_SESSION["UNAME"]=$name;
				//密码正确登录成功
				if($isreg == 1) //记住账号
				{
					setcookie("CNAME",$name,time()+60*60*24*7,'/');
// 					echo "<script>";
// 					echo 'alert("我记住了");';
// 					echo "</script>";
				}
				echo "<script>";
				echo 'location.href="index.php";';
				echo "</script>";
			}else{
				//密码不正确
				echo "<script>";
				echo 'alert("密码不正确");';
				echo 'location.href="login.php";';
				echo "</script>";
			}
		}
	}else{
		echo "<script>";
		echo 'alert("验证码不正确");';
		echo 'location.href="login.php";';
		echo "</script>";
	}
}else{
	echo "<script>";
	echo 'alert("验证码失效");';
	echo 'location.href="login.php";';
	echo "</script>";
}



?>