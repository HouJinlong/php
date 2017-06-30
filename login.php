<?php 
session_start();
//退出系统并删除账号
$act = isset($_GET['act'])?$_GET['act']:'';
if($act=='logout'){	
	unset($_SESSION['UNAME']);
}
//取出记住的账号
$cname = isset($_COOKIE['CNAME'])?$_COOKIE['CNAME']:'';
?>
<!DOCTYPE html>
<html lang="zh">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>后台登录</title>

<link rel="stylesheet" type="text/css" href="css/styles.css">

</head>
<body>


<div class="wrapper">

	<div class="container">
		<h1>后台管理</h1>
		<form class="form" action="login_act.php" method="post">
			<input type="text" placeholder="Username" name="name" value="<?php echo $cname?>">
			<input type="password" placeholder="Password" name='pwd'>
			<div style="width:250px; margin:0 auto;">
				<input type="text" style="width:160px;position: relative; top: -16px; display:inline-block; margin:0;" placeholder="验证码" name="auths"><img id="img" src="code.php" alt="" style="width:80px; height: 43px; display:inline-block;margin-left:10px;" /><br>
				<p style="text-align:right; font-size:12px;"><a href="javascript:;" onclick="document.getElementById('img').src='code.php?'+new Date().getTime();" style="color:red; position: relative; top: -10px;">看不清,换一张</a></p>
			</div>
			<input type="checkbox" name="isreg" value="1" style="width:43px;position: relative; top: 0px; display:inline-block;"/>记住账号<br /><br />
			<button type="submit" id="login-button"><strong>登陆</strong></button>			
		</form>
	</div>
	
	<ul class="bg-bubbles">
		<li></li>
		<li></li>
		
	</ul>
	
</div>



</body>
</html>