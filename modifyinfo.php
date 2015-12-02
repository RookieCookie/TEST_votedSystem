<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>

<body>
<?php 
if($_SESSION['user'] == null){    //session登陆验证
	echo "<script>alert('错误的登陆!:(');location.href = 'index.php'</script>";
}
include_once("js/headPHP.php");//连接数据库服务器

$username = $_POST['username'];
$passWord = $_POST['pw'];
$fav = $_POST['fav'];
$headimg = $_POST['pic'];
$fav1 = '';//对数值赋初值
foreach($fav as $value){
	$fav1 .= $value;
}
if($passWord){   //如果修改密码
	$sql = "update userinfo set passWord = '".md5($passWord)."',hobby = '$fav1',pic = '$headimg' where userName = '$username' ";
}
	else{    //如果不修改密码
	$sql = "update userinfo set hobby = '$fav1',pic = '$headimg' where userName = '$username'";
	}
$result = mysql_query($sql);
echo mysql_error();
if(mysql_affected_rows() == -1){  //查询是否更改数据行数
echo "<script>alert('数据更新失败:(');history.back();</script>";
}
else{
    if($_SESSION['admin'])
        echo "<script>alert('修改成功:)');location.href = 'adminList.php'</script>";
    else
	echo "<script>alert('修改成功:)');location.href = 'modify.php'</script>";
	}
?> 

</body>
</html>