<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>添加关键词</title>
</head>
<link href="indexStyle.css" type="text/css" rel="stylesheet">
<body>
<?php
include_once('js/headPHP.php');
include_once('page.php');
include_once('connect.php');
if (!$_SESSION['admin']) {
    echo "<script>alert('你不是管理员！');location.href = 'index.php'</script>";
    exit;
}
if ($_GET['ac'] == 'de') {    //删除关键词
    if ($_SESSION['user'] == '') {  //是否登录验证
        echo "<script>alert('未登录无权访问');location.href='index.php'</script>";
        exit;
    }
    $id = $_GET['id'];
    $sql = "delete from voted_count where id = '$id'";
    $reslut = $dbh->query($sql);
    if ($reslut) {
        echo "<script>alert('删除成功！');location.href = 'voted_list.php'</script>";
    }
} else if ($_GET['ac'] == 'xg') {    //修改投票者名字
    $sql = "select * from voted_count where id = '" . $_GET['id'] . "'";
    $result = $dbh->query($sql);
    $key = $result->fetch();
    ?>
    <div class="keywordsSubmit">
        <form method="post">
            <table class="tableKeyWords">
                <tr>
                    <td style="text-align: right">原名字:</td>
                    <td style="text-align: left"><span><?echo $key['voted_name'] ?></span></td>
                </tr>
                <tr>
                    <td style="text-align: right">新名字:</td>
                    <td><input type="text" name="words"/></td>
                </tr>
                <tr>
                    <td style="text-align: right"></td>
                    <td>
                        <button type="submit" name="submit">提交</button>
                    </td>
                </tr>

            </table>
        </form>
    </div>
    <?
    if (isset($_POST['submit']) ? 1 : 0) {
        $sql = "update voted_count set words = '" . $_POST['words'] . "' where id = '" . $_GET['id'] . "'";
        $result = $dbh->query($sql);
        if ($result) {
            echo "<script>alert('修改成功');location.href='voted_list.php';</script>";
        }
    }
} else if ($_GET['ac'] == 'add') { ?>  <!--添加投票者-->
    <div class="keywordsSubmit">
        <form method="post">
            <table class="tableKeyWords">
                <tr>
                    <td style="text-align: right"></td>
                    <td style="text-align: left"><span><? echo $key['words'] ?></span></td>
                </tr>
                <tr>
                    <td style="text-align: right">新添投票者:</td>
                    <td><input type="text" name="words"/></td>
                </tr>
                <tr>
                    <td style="text-align: right"></td>
                    <td>
                        <button type="submit" name="submit">提交</button>
                    </td>
                </tr>

            </table>
        </form>
    </div>
    <?
    if (isset($_POST['submit']) ? 1 : 0) {
        $word = $_POST['words'];
        $sql1 = "select * from voted_count where voted_name = '$word'";
        $reslut1 = mysql_query($sql1);
        if (mysql_num_rows($reslut1) > 0) {
            echo "<script>alert('投票者名字重复！');location.href = 'voted_list.php'</script>";
            exit;
        }
        $sql = "insert into voted_count (voted_name) values ('$word')";
        $reslut = mysql_query($sql);
        if ($reslut) {
            echo "<script>alert('添加成功！');location.href = 'voted_list.php'</script>";
        }
    }
} ?>
</body>
</html>