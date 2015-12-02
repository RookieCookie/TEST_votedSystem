<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
</head>

<body>
<?php 
include_once('js/headPHP.php');
include_once('connect.php');
include_once('page.php');

if(!$_SESSION['admin']){
	echo "<script>alert('你不是管理员！');location.href = 'index.php'</script>";
    exit;
}

$sql = "select * from userinfo";

/*$result = mysql_query($sql);*/

$cout_rows = mysql_num_rows($result);  

//引用分页函数
$pagecount = 3;   //每页条数
pageft($cout_rows, $pagecount, $cout_rows);
$sql .= " limit $firstcount, $displaypg";

/*$result = mysql_query($sql);*/
$result = $dbh->query($sql);
?>

<h1 style="text-align: center;">会员列表</h1>
<table border="1" align="center" cellpadding="8" cellspacing="0" style="border-color:#000; border-collapse:collapse;" width="80%">

	<tr align="center" style=" font-weight: bold" width="100%">
			<td width="10%">序号</td>
			<td width="20%">用户名</td>
			<td width="30%">爱好</td>
			<td width="15%">是否管理员</td>
			<td width="25%">操作</td>
		</tr>

<?
$j = $firstcount+1;
//细节 -> 这个数组不能放在while外面不然就成为常量了，循环就不会断
while($userarr = $result->fetch()/*$userarr = mysql_fetch_array($result)*/){?>
	<tr align="center" style=" font-weight: bold">
			<td><?php echo $j ?></td>
			<td><?php echo $userarr['userName']?></td>
			<td><? echo $userarr['hobby']?></td>
			<td><?php echo $userarr['admin']?'是':'否'?></td>
			<td><?php if($userarr['userName'] !='admin') {?><a href="reset.php?username=<?php echo $userarr['userName']?>">重置密码</a>&nbsp&nbsp<?php if($userarr['admin']){?><a href="adminpage.php?username=<?php echo $userarr['userName']?>&admin=0">取消管理员</a><?php } else{?><a href="adminpage.php?username=<?php echo $userarr['userName']?>&admin=1">设为管理员</a><?php } ?><?php } else echo "超级管理员";?> &nbsp&nbsp<?php if($userarr['userName'] != 'admin') { ?><a href="del.php?username=<?php echo $userarr['userName'] ?>">删除</a> <?php } ?></td>
		</tr>

<?php
$j++;
}
?>
</table>

<table width="90%">
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
			<a href="index.php" >返回留言列表</a>&nbsp;
          <a href="logout.php" >注销</a>
        </td>
    </tr>
</table>



</body>
</html>