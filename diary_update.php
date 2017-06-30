<?php 
require_once 'includes/includes.php';
checklogin();
if(!empty($_POST)){
	/**
	 * 修改日记 处理
	 */
	$did = isset($_POST[did])?$_POST[did]:'';
	unset($_POST[did]);
	$rtn = $dbObj -> update('ty_diary', $_POST, $where = "did={$did}");
	if($rtn){
		echo "<script>";
		echo 'alert("修改成功!");';
		echo 'location.href="diaryslist.php";';
		echo "</script>";
	}else{
		echo "<script>";
		echo 'alert("修改失败!");';
		echo "location.href='diarys_update.php?id={$id}';";
		echo "</script>";
	}
}else{
	// 修改日记
	$did = isset($_GET['did'])?$_GET['did']:'';
	$sql ="select did,t.tid,dtitles,dpic,drelease,dcontent from ty_diary as t left join dy_type as d on d.tid=t.tid where did={$did}";
	$diaryArr=$dbObj->getone($sql);
	$sql="select * from dy_type";
	$typeArr=$dbObj->getall($sql);
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
<form action="diary_update.php" method="post">
	<input type="hidden" name='did' value="<?php echo $diaryArr['did'];?>" />
<table class="table table-bordered table-hover definewidth m10" style="margin-left:3%;margin-top:2%;">
    <tr>
        <td class="tableleft">日记类别</td>
        <td> <div style="margin:0 auto;">
	             <select name="tid">
	           	  <?php foreach ($typeArr as $type){	?>
				     <option <?php if($diaryArr['tid'] == $type['tid']){ echo 'selected';}?> value="<?php echo $type['tid']?>"><?php echo $type['tname']?></option>
				    <?php } ?>
				 </select>
             </div> 
        </td>
    </tr> 
    <tr>
        <td class="tableleft">日记标题</td>
        <td> <div style="margin:0 auto;">
		         <input type="text" name="dtitles" value="<?php echo $diaryArr['dtitles'];?>">
             </div> 
        </td>
    </tr>  
    <tr>
        <td class="tableleft">心情指数</td>
        <td> <div style="margin:0 auto;">
		         <input type="file" name="dpic" value="<?php echo $diaryArr['dpic'] ?>">
             </div> 
        </td>
    </tr>  	
    <tr>
        <td class="tableleft">日记内容</td>
        <td> <div style="margin:0 auto;">
	<textarea name="dcontent" id="content" style="width:99%;height:300px;display:none;"><?php echo $diaryArr['dcontent'] ?></textarea>
		<script>
			KindEditor.create('textarea[name="dcontent"]');
		</script>		         
             </div> 
        </td>
    </tr>  	
    <tr>
        <td class="tableleft">是否发布</td>
        <td> <div style="margin:0 auto;">
		         <input type="radio" name="drelease" value="1" <?php echo $diaryArr['drelease']==1?'checked':'';?>>是&nbsp;<input type="radio" name="drelease" <?php echo $diaryArr['drelease']==0?'checked':'';?> value="0">否
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