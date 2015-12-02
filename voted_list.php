<? session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>投票后台管理</title>
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
<script>
    function manage(data,id){
        switch (data){
            case 'delete':
                $.ajax({
                    url: "manage.php",
                    type: "POST",
                    dataType: "json",
                    data: {type:data,id:id},
                    success: function (msg) {
                        alert(msg['msg']);
                        window.location.reload();
                    }
                });
                break;
            case 'modify':
                $.ajax({

                });
                break;
            case 'add':
                $.ajax({

                });
                break;
            default :
                alert('操作失败！');
        }
    }
</script>
<?php
if(!$_SESSION['admin']){
    echo "<script>alert('你不是管理员！');location.href = 'index.php'</script>";
    exit;
}
?>
<body>
<h2 align="center">投票后台管理</h2>
<div class="container">
    <table class="table table-hover table-condensed table-bordered" style="background-color: #ffffff;height: 400px">
   <tr class="active">
       <td align="center"><b>投票人</b></td>
       <td align="center"><b>操作</b></td>
   </tr>
        <tbody>
    <?php
    include_once('connect.php');
    $sql = "select * from voted_count";
    $result = $dbh->query($sql);
    while($votePeople = $result->fetch()){?>

            <tr>
                <td align="center"><?echo $votePeople['voted_name']?></td>&nbsp;
                <td align="right">
                    <a href="manage.php?id=<?echo $votePeople['id']?>&ac=de">删除</a>&nbsp;
                    <a href="manage.php?id=<?echo $votePeople['id']?>&ac=xg">修改</a>&nbsp;
                    <a href="manage.php?ac=add">增加</a>&nbsp;
                </td>
            </tr>

    <?}?>
        </tbody>
    </table>
    <table align="right">
        <tr align ="right">
            <td>
                <a href="adminList.php">会员管理</a>&nbsp;
                <a href="index.php" >返回投票列表</a>&nbsp;
                <a href="logout.php" >注销</a>
            </td>
        </tr>
    </table>
</div>

</body>
</html>