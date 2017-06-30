<?php 
include_once 'includes/includes.php';
checklogin();
//查询所有类别
$sql="select * from dy_type";
$typeArr=$dbObj->getall($sql);
//处理添加
if(!empty($_POST)){
	
	if($_FILES['dpic']['name'] != ''){ //当上传文件不为空时（用户选择了要上传的文件时），进行上传
		$arr=array(
				//定义文件上传的路径
				'filepath'=>'./images/'.date('Ym'),
				//定义文件上限（2m）
				'allowsize'=>1024*1024*2,
				//上传文件类型
				'allowmime'=>array('image/jpeg','image/jpg','image/pjpeg','image/gif','image/png')
		);
		//	实例化文件上传类
		$upObj = new fileup($arr);
		$filename = $upObj->up('dpic');//文件域的那么
		if($filename){
			echo $filename;
			$_POST['dpic']='images/'.date('Ym').'/'.$filename;
		}else{
			echo "<script>";
			echo "alert('{$upObj -> geterror()}');";
			echo 'location.href="diarysadd.php";'; 	
			echo "</script>";
			exit();
		}
	}	
	$_POST['timeline']=time();
	$rtn = $dbObj->insert('ty_diary', $_POST);
	if($rtn){
		echo "<script>";
		echo 'alert("日记添加成功!");';
		echo 'location.href="diaryslist.php";';
		echo "</script>";
	}else{
		echo "<script>";
		echo 'alert("日记添加失败!");';
		echo 'location.href="diarys.php";';
		echo "</script>";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>添加日记</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="Css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="Css/bootstrap-responsive.css" />
    <link rel="stylesheet" type="text/css" href="Css/style.css" />
    <script type="text/javascript" src="Js/jquery.js"></script>
    <script type="text/javascript" src="Js/jquery.sorted.js"></script>
    <script type="text/javascript" src="Js/bootstrap.js"></script>
    <script type="text/javascript" src="Js/ckform.js"></script>
    <script type="text/javascript" src="Js/common.js"></script>
    <script type="text/javascript" src="js/showdate.js"></script>
	<script charset="utf-8" src="js/kindeditor-min.js"></script>
	<script charset="utf-8" src="js/lang/zh_CN.js"></script>
    <style type="text/css">
        body {font-size: 20px;
             padding-bottom: 40px;
             background-color:#e9e7ef;
             font-size:17px;
        }
        .sidebar-nav {
            padding: 9px 0;
        }

        @media (max-width: 980px) {
            /* Enable use of floated navbar text */
            .navbar-text.pull-right {
                float: none;
                padding-left: 5px;
                padding-right: 5px;
            }
        }


    </style>
</head>
<form enctype='multipart/form-data' action="diarysadd.php?act=add" method="post">
<table class="table table-bordered table-hover definewidth m10" style="margin-left:3%;margin-top:2%;">
    <tr>
        <td class="tableleft">日记类别</td>
        <td> <div style="margin:0 auto;">
	             <select name="tid">
	           	  <?php foreach ($typeArr as $type){	?>
				     <option value="<?php echo $type['tid']?>"><?php echo $type['tname']?></option>
				    <?php } ?>
				 </select>
             </div> 
        </td>
    </tr> 
    <tr>
        <td class="tableleft">日记标题</td>
        <td> <div style="margin:0 auto;">
		         <input type="text" name="dtitles">
             </div> 
        </td>
    </tr>  
    <tr>
        <td class="tableleft">心情指数</td>
        <td> <div style="margin:0 auto;">
		         <input type="file" name="dpic">
             </div> 
        </td>
    </tr>  	
    <tr>
        <td class="tableleft">日记内容</td>
        <td> <div style="margin:0 auto;">
	<textarea name="dcontent" id="content" style="width:99%;height:300px;display:none;"></textarea>
		<script>
			KindEditor.create('textarea[name="dcontent"]');
		</script>		         
             </div> 
        </td>
    </tr>  	
    <tr>
        <td class="tableleft">是否发布</td>
        <td> <div style="margin:0 auto;">
		         <input type="radio" name="drelease" value="1" checked>是&nbsp;<input type="radio" name="drelease" value="0">否
             </div> 
        </td>
    </tr>  		
    <tr>
        <td class="tableleft"></td>
        <td>
            <button style="margin-left:180px;"type="submit" class="btn btn-primary" type="submit">保存</button>&nbsp;&nbsp;<a href="diaryslist.php">返回列表</a>
        </td>
    </tr>
</table>
</form>
</body>
</html>