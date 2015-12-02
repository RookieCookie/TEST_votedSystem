<?php session_start();$iipp=$_SERVER["REMOTE_ADDR"];?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>会员注册</title>
</head>
<body>
<?php
include_once("js/headPHP.php");
include_once('connect.php');
/* 执行数据库操作  */

if($_GET['action'] == 'regist'){  //注册
	$sql = "select * from userlist where userName = '".$_POST['username']."'";    //建立用户名查询
	$result = $dbh->query($sql);   //MYSQL查询表中内容
	$num = $result->rowCount();   //查询内容数目
	if($num){
		echo "<script language='javascript'>alert('这个用户名已被占用！');history.back();</script>";
		exit;
	};
	
	//如果为假则开始想表中写入数据
	$fav1 = '';
	foreach($_POST['fav'] as $vavle){
			$fav1 .= $vavle;
	};   //对爱好这个数组遍历存储在 fav1 变量
	$sql = " insert into userlist (userName, passWord, hobby,headImg,ip) value ('".$_POST['username']."','".md5($_POST['pw'])."','".$fav1."','".$_POST['pic']."','$iipp')";
	$result = $dbh->exec($sql);
	if($result->rowCount() > 0){
		echo "<script language='javascript'>alert('注册成功！登录试试吧');location.href = 'index.php'</script>";
		}
	else{
		echo "<script language='javascript'>alert('注册失败！go die！！');location.href = 'index.html'</script>";
		}
}
else if($_GET['action'] == 'login'){    //登陆
	$username = $_POST['username_lo'];
	$pwd = md5($_POST['pw_lo']);
	$sql = "select * from userlist where userName = '$username' and passWord = '$pwd'";
	$result = $dbh->query($sql);
	$userad = $result->fetch();    // 建立一个存放着admin 的值的数组

	if($result->rowCount()){
		$_SESSION['admin'] = $userad['admin'];    // 将admin的值传递给session
		$_SESSION['usersid'] = $userad['id'];    //存放用户的ID
		$_SESSION['user'] = $username;
		echo $_SESSION['user'];
		if($_SESSION['admin']){    //判断是否管理员
		//echo $_SESSION['admin'];  //查看是否管理员
			echo "<script>alert('欢迎管理员');location.href = 'adminList.php';</script>";
			exit;
		}
	echo "<script>alert('登录成功！！');location.href = 'index.php'</script>";
	}
	else
	echo "<script>alert('你输入的账号或密码有错！go die!!!');history.back()</script>";
	}

?>
</body>
</html>