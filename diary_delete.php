<?php 
include_once 'includes/includes.php';
checklogin();
/**
 * 删除日记 处理
 */
//单删
$did = isset($_GET['did'])?$_GET['did']:'';//要删除的记录id
$sql="delete from ty_diary where did in ({$did})";
$rtn =$dbObj ->query($sql);

// 配合练习ajax
// php json_encode()将数组转化成json 
//		json_decode($json)将json对象转换成php对象
$arr = array('rtn' => $rtn);
echo json_encode($arr);
// if($rtn){
// 	echo "<script>";
// 	echo 'alert("日记删除成功!");';
// 	echo 'location.href="diaryslist.php";';
// 	echo "</script>";
// }else{
// 	echo "<script>";
// 	echo 'alert("日记删除失败!");';
// 	echo 'location.href="diaryslist.php";';
// 	echo "</script>";
// }
?>