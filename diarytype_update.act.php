<?php 
/**
 * 修改日记类型 处理
 */
include_once 'includes/includes.php';
checklogin();
$tid = isset($_POST[tid])?$_POST[tid]:'';
unset($_POST[tid]);
$rtn = $dbObj -> update('dy_type', $_POST, $where = "tid={$tid}");
if($rtn){
	echo "<script>";
	echo 'alert("修改成功!");';
	echo 'location.href="diarytype_list.php";';
	echo "</script>";
}else{
	echo "<script>";
	echo 'alert("修改失败!");';
	echo "location.href='diarytype_update.php?id={$id}';";
	echo "</script>";
}
?>