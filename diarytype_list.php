<?php 
include_once 'includes/includes.php';
checklogin();

$sql ='select count(*) as n from dy_type';
$total = $dbObj-> getone($sql)[n];
//创建分页类
$page=new Page($total,3);

$sql ="select * from dy_type order by tid asc limit {$page->limit()}";
$diaryArr = $dbObj-> getall($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>日记类别列表</title>
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
<table class="table table-bordered table-hover definewidth m10">
    <thead>
    <tr>
	    <th>ID<input type="checkbox"></th>
        <th>日记类别</th>
        <th>添加日期</th>
		<th>动作</th>
    </tr>
    </thead>
	<?php foreach ($diaryArr as $type){	?>
        <tr>
                <td><?php echo $type['tid']?><input type="checkbox" class="tids"></td>
                <td><?php echo $type['tname']?></td>
				<td><?php echo date("Y-m-d",$type['tdate'])?></td>
                 <td> <a href="diarytype_update.php?tid=<?php echo  $type['tid']?>">修改</a> &nbsp;<a href="diarytype_delete.php?tid=<?php echo $type['tid']?>">删除</a></td>           
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