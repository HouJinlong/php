<?php 
/**
 * 删除日记类型 处理
 */
include_once 'includes/includes.php';
checklogin();

$tid = isset($_GET['tid'])?$_GET['tid']:'';
$sql="delete from dy_type where tid in ({$tid})";
$rtn =$dbObj ->query($sql);
if($rtn){
	echo "<script>";
	echo 'alert("日记删除成功!");';
	echo 'location.href="diarytype_list.php";';
	echo "</script>";
}else{
	echo "<script>";
	echo 'alert("日记删除失败!\n原因:有的日记是您正在删除的类型,先处理这些日记");';
	echo 'location.href="diarytype_list.php";';
	echo "</script>";
}
?>