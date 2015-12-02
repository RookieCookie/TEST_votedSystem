<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
<title>会员管理系统</title>
</head>
<!-- 新 Bootstrap 核心 CSS 文件 -->
<link rel="stylesheet" href="./css/bootstrap.min.css">

<!-- 可选的Bootstrap主题文件（一般不用引入） -->
<link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

<link rel="stylesheet" href="indexStyle.css">

<!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
<script src="./js/jquery-1.10.2.js"></script>

<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
<script src="./js/bootstrap.min.js"></script>
<?php
include_once('js/headPHP.php');
include_once('page.php');
include_once("connect.php");

if(!$_SESSION['admin']){
	echo "<script>alert('你不是管理员！');location.href = 'index.php'</script>";
	exit;
}

$sql = "select * from userlist";
$result = $dbh->query($sql);
/*$result = mysql_query($sql);*/
/*$cout_rows = mysql_num_rows($result);*/
$cout_rows = $result->rowCount();
//引用分页函数
$pagecount = 3;   //每页条数
pageft($cout_rows, $pagecount, $cout_rows);
$sql .= " limit $firstcount, $displaypg";

/*$result = mysql_query($sql);*/
$result = $dbh->query($sql);

?>
<body>
<h2 style="text-align: center;padding-bottom: 20px;">会员管理系统</h2>
<div class="container">
	<div style="height: 400px">
<table border="1" align="center" cellpadding="8" cellspacing="0" style="background-color: #fff;"  class="table table-hover table-condensed table-bordered">

	<tr align="center" style=" font-weight: bold" width="100%">
			<td width="10%">序号</td>
			<td width="20%">用户名</td>
			<td width="30%">爱好</td>
			<td width="15%">是否管理员</td>
			<td width="25%">操作</td>
		</tr>
	<tbody>
<?
$j = $firstcount+1;
//细节 -> 这个数组不能放在while外面不然就成为常量了，循环就不会断
while($userarr = $result->fetch()/*$userarr = mysql_fetch_array($result)*/){?>
	<tr align="center">
			<td><?php echo $j ?></td>
			<td><?php echo $userarr['userName']?></td>
			<td><? echo $userarr['hobby']?></td>
			<td><?php echo $userarr['admin']?'是':'否'?></td>
			<td><?php if($userarr['userName'] !='admin') {?><a href="reset.php?username=<?php echo $userarr['userName']?>">重置密码</a>&nbsp&nbsp<?php if($userarr['admin']){?><a href="Setadminpage.php?username=<?php echo $userarr['userName']?>&admin=0">取消管理员</a><?php } else{?><a href="Setadminpage.php?username=<?php echo $userarr['userName']?>&admin=1">设为管理员</a><?php } ?><?php } else echo "超级管理员";?> &nbsp&nbsp<?php if($userarr['userName'] != 'admin') { ?><a href="del.php?username=<?php echo $userarr['userName'] ?>">删除</a> <?php } ?></td>
		</tr>

<?php
$j++;
}
?>
	</tbody>
</table>
</div>
<table width="90%" align="right">
<tr align ="right">
<td>
<?php
//页尾显示
echo $pagenav;   
//phpinfo();
?>
</td>
</tr>
    <tr align ="right">
        <td>
			<a href="voted_list.php">投票管理</a>&nbsp;
			<a href="index.php" >返回投票列表</a>&nbsp;
          <a href="logout.php" >注销</a>
        </td>
    </tr>
</table>

</div>


</body>
</html>