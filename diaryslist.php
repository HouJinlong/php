<?php 
include_once 'includes/includes.php';
checklogin();
/**
 * 搜索接值
 */
$gnames=isset($_GET['gnames'])?$_GET['gnames']:'';
$gtype=isset($_GET['gtype'])?$_GET['gtype']:'';
//根据搜索的条件，改变下边的查询sql的$wheres
//___________________________________________________________________________
//查询所有数据条数
$wheres='';
if($gnames!=''){
	$wheres= "where dtitles like '%{$gnames}%'";
};
if($gtype!=''){  //再多也是按这个往下走   关键点 where 只第一次出现
	if($wheres!=''){ //判断where出现过吗
		$wheres.= " and t.tid={$gtype}";
	}else{
		$wheres= "where t.tid={$gtype}";
	}	
};
$sql ="select count(*) as n from ty_diary as t {$wheres}";
$total = $dbObj-> getone($sql)[n];
//创建分页类
$page=new Page($total,3);
//查询所有数据
$sql ="select did,tname,dtitles,dpic,drelease,timeline from ty_diary as t left join dy_type as d on d.tid=t.tid {$wheres} order by did desc limit {$page->limit()}";
$diaryArr = $dbObj-> getall($sql);
//查询所有类别
$sql="select * from dy_type";
$typeArr=$dbObj->getall($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>我的日记</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="Css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="Css/bootstrap-responsive.css" />
    <link rel="stylesheet" type="text/css" href="Css/style.css" />
    <script type="text/javascript" src="Js/jquery2.js"></script>
    <script type="text/javascript" src="Js/jquery2.sorted.js"></script>
    <script type="text/javascript" src="Js/bootstrap.js"></script>
    <script type="text/javascript" src="Js/ckform.js"></script>
    <script type="text/javascript" src="Js/common.js"></script>

    <style type="text/css">
        body {font-size: 20px;
		font-size: 20px;
            padding-bottom: 40px;
            background-color:#e9e7ef;
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
<body >
<form class="form-inline definewidth m20" action="diaryslist.php" method="get">
    <font color="#777777"><strong>日记标题：</strong></font>
    <input type="text" name="gnames" id="gnames"class="abc input-default" placeholder="" value="">&nbsp;&nbsp; 
	日记类别：<select name="gtype" id="gtype">
			<option value="">-请选择-</option>
		 <?php foreach ($typeArr as $type){	?>
				     <option value="<?php echo $type['tid']?>"><?php echo $type['tname']?></option>
				    <?php } ?>
	</select>&nbsp;&nbsp;
    <button type="submit" class="btn btn-primary">查询</button>&nbsp;&nbsp; 
</form>
<table class="table table-bordered table-hover definewidth m10">
    <thead>
    <tr>
	    <th>ID<input type="checkbox" id="all" ></th>
		<th>日记类别</th>
        <th>日记标题</th>
		<th>心情指数</th>
        <th>是否发布</th>
        <th>发布日期</th>
		<th>动作</th>
    </tr>
    </thead>
 		<?php foreach ($diaryArr as $diary){	?>
        <tr>
                <td><?php echo $diary['did']?><input type="checkbox" value="<?php echo $diary['did']?>" name='did' class="curid"></td>
                <td><?php echo $diary['tname']?></td>
                <td><?php echo $diary['dtitles']?></td>
                <td><img width="40px" src="<?php echo $diary['dpic']?>"></td>
				<td><a href="#"><?php echo $diary['drelease']==1?'是':'否';?></a></td>
				<td><?php echo date("Y-m-d",$diary['timeline'])?></td>
                <td> <a href="diary_update.php?did=<?php echo  $diary['did']?>">修改</a> &nbsp;
                <!-- <a href="diary_delete.php?did=<?php echo $diary['did']?>">删除</a> -->
                <!-- ajax实现删除 -->
                <a href="javascript:;" onclick='delone(<?php echo $diary['did']?>)'>删除</a>
                </td>
               
        </tr>
		<?php } ?>
		<tr>
		        <td colspan="8" >
		        	 <a href="javascript:;" id='delall';>全删</a>
		       		 <?php echo $page->pageBar(1)?>
		        </td>
		</tr>
           
       
       </table>

</body>
</html>
<script>
$(function(){
	$('#all').click(function(){
		$('[name="did"]').prop("checked",$(this).prop("checked"));
	});
	$('#delall').click(function(){
		var selval='';
		$('[name="did"]').each(function(){
			var $cur=$(this);
			selval+=$cur.prop("checked")?$cur.val()+",":'';
			});
		if(selval=='')return;
		selval=selval.substr(0,selval.length-1);		
		$.get('diary_delete.php',{'did':selval},function(d){			
			if(d.rtn){//删除成功
				location.href='diaryslist.php';
			}else{//失败
				alert('删除失败');
				}
		},'json');
	});

	
});
function delone(did){
	$.get('diary_delete.php',{'did':did},function(d){			
			if(d.rtn){//删除成功
				location.href='diaryslist.php';
			}else{//失败
				alert('删除失败');
				}
		},'json');
		
	}
</script>