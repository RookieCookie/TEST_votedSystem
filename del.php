<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title></title>
</head>

<body>
<?php
include_once('connect.php');
if(!$_SESSION['admin']){
    echo "<script>alert();location.href='index.php'</script>";
    exit;
}
include_once('js/headPHP.php');
 $sql = "delete from userinfo where userName = '".$_GET['username']."'";
/*mysql_query($sql);*/
$result = $dbh->query($sql);
if(mysql_affected_rows()>0){
    echo "<script>alert('删除成功!:)');location.href='adminList.php'</script>";
}
?>
</body>
</html>