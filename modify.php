<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
<title>修改个人资料</title>
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
if($_SESSION['user'] == null){    //session登陆验证
    echo "<script>alert('错误的登陆!:(');location.href = 'index.php'</script>";
    exit;
}
include_once("js/headPHP.php");
$username = isset($_GET['username']) ? $_GET['username'] : $_SESSION['user'];

$sql = "select * from userlist where userName = '$username'";
$result = mysql_query($sql);  //返回一个结果集
$num = mysql_num_rows($result);
if(!$num){
    echo "<script>alert('未找到该用户');location.href='index.php';</script>";
    exit;
}
$info = mysql_fetch_array($result );  //从记录集中取得一条记录，并生成一个数组
?>
<body>
<div class="container">
<div id="registWeb">
  <form action="modifyinfo.php?action=modifyinfo" method="post" onSubmit="return Validator.Validate(this,3)" >
    <table width="490" border="0" align="center">
      <tr>
        <td width="86" align="right">账号</td>
        <td width="394"><label for="textfield2"></label>
          <input name="username" type="text" readonly="readonly" dataType="English"  msg="英文名只允许英文字母" value="<?php echo $username?>"/></td>
      </tr>
      <tr>
        <td align="right">密码</td>
        <td><label for="textfield3"></label>
          <input type="password" name="pw" id="textfield3" dataType="SafeString"   msg="密码不符合安全规则"/></td>
      </tr>
      <tr>
        <td align="right">确认密码</td>
        <td><input type="password" name="textfield" id="textfield4" dataType="Repeat" to="pw" msg="两次输入的密码不一致"/></td>
      </tr>
      <tr>
        <td align="right">爱好</td>
        <td><input type="checkbox" name="fav[]" id="fav[]" value="打游戏"<?php if(strpos($info['hobby'],'打游戏') !== false){?> checked="checked"<?php }?>/>
          <label for="fav[]">打游戏
            <input type="checkbox" name="fav[]" id="fav[]" value="听音乐"<?php if(strpos($info['hobby'],'听音乐') !== false){?> checked="checked"<?php }?>/>
            听音乐
            <input type="checkbox" name="fav[]" id="fav[]" value="踢球"<?php if(strpos($info['hobby'],'踢球') !== false){?> checked="checked"<?php }?> dataType="Group" min="2" max="3"  msg="必须选择2~3种爱好"/>
            踢球</label></td>
      </tr>
      <tr>
        <td align="right">头像</td>
        <td>
          <input type="radio" name="pic" value="pic1.jpg" <? if($info['pic'] == "pic1.jpg") {?> checked="checked"<?}?>/><img src="headimg/pic1.jpg" width="50" style="border-radius: 25px;">
          <input type="radio" name="pic" value="pic2.jpg" <? if($info['pic'] == "pic2.jpg") {?> checked="checked"<?}?>/><img src="headimg/pic2.jpg" width="50" style="border-radius: 25px;">
          <input type="radio" name="pic" value="pic3.jpg" <? if($info['pic'] == "pic3.jpg") {?> checked="checked"<?}?>/><img src="headimg/pic3.jpg" width="50" style="border-radius: 25px;">
          <input type="radio" name="pic" value="pic4.jpg" <? if($info['pic'] == 'pic4.jpg') {?> checked="checked"<?}?>/><img src="headimg/pic4.jpg" width="50" style="border-radius: 25px;"><br/>
          <input type="radio" name="pic" value="pic5.jpg" <? if($info['pic'] == "pic5.jpg") {?> checked="checked"<?}?>/><img src="headimg/pic5.jpg" width="50" style="border-radius: 25px;">
          <input type="radio" name="pic" value="pic6.jpg" <? if($info['pic'] == "pic6.jpg") {?> checked="checked"<?}?>/><img src="headimg/pic6.jpg" width="50" style="border-radius: 25px;">
          <input type="radio" name="pic" value="pic7.jpg" <? if($info['pic'] == "pic7.jpg") {?> checked="checked"<?}?>/><img src="headimg/pic7.jpg" width="50" style="border-radius: 25px;">
        </td>
      </tr>
      <tr>
        <td align="right"><input type="reset" name="login_1" id="login_1" value="重置" /></td>
        <td align="center"><input type="submit" name="button" id="button" value="修改" /></td>
      </tr>
    </table>
  </form>
  <a href="index.php" style="float:right">返回投票列表</a>
</div>
</div>
</body>
</html>