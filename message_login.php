<? session_start();
$ts = time();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
<title>test1</title>
<style>
body{
	color:#fff;
	background-color:#000;}
</style>
  <script src="js/formText.js"></script>
<script src="js/jquery-1.7.2.min.js"></script>
    <script language="JavaScript"><!--
        ts = <?= $ts ?>;
        --></script>
<script>
$(document).ready(function(e) {
    $("#registWeb").hide();
	$("#regist_1").click(function(e) {
        $("#registWeb").show();
		$("#loginWeb").hide();
    });
	$("#login_1").click(function(e) {
        $("#registWeb").hide();
		$("#loginWeb").show();
    });
	
	function changing(){
    document.getElementById('checkpic').src="testpic.php?"+Math.random();
} 
});
</script>
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

<body>
<div class="container">
<h2 align="center" style="color: #ffffff">欢迎来到我的网站</h2>
<div id="registWeb">
  <h3 style="color: #ffffff" align="center">The regist site</h3>
  <form action="loginOrRegist.php?action=regist" method="post" onSubmit="return Validator.Validate(this,3)" >
    <div class="form-group">
       <label style="color: #ffffff">Your account:</label>
      <input type="text" class="form-control bg_alpha " placeholder="accout" name="username" dataType="English"  msg="英文名只允许英文字母" style="width: 300px;color: #FFFFFF">
    </div>
    <div class="form-group">
      <label style="color: #ffffff">Your password:</label>
      <input type="password" class="form-control bg_alpha" placeholder="Password" name="pw"  dataType="SafeString"   msg="密码不符合安全规则" style="width: 300px;color: #FFFFFF">
    </div>
    <div class="form-group">
      <label style="color: #ffffff">Confirm password:</label>
      <input type="password" class="form-control bg_alpha" placeholder="ConfirmPassword" name="pw_re"  dataType="Repeat"   msg="两次输入的密码不一致" style="width: 300px;color: #FFFFFF">
    </div>
    <div class="form-group">
      <label style="color: #ffffff">hobby:</label><br/>
      <input type="checkbox" name="fav[]" id="fav[]" value="打游戏"/><span style="color: #ffffff"> Play game</span>&nbsp;
      <input type="checkbox" name="fav[]" id="fav[]" value="听音乐"/><span style="color: #ffffff"> Listen music</span>&nbsp;
      <input type="checkbox" name="fav[]" id="fav[]" value="踢球" dataType="Group" min="2" max="3"  msg="必须选择2~3种爱好"/><span style="color: #ffffff"> Play football</span>
    </div>
    <div class="form-group" style="height: 154px;">
      <label style="color: #ffffff"> head portrait:</label><br/>
      <ul class="headPic">
          <li><input type="radio" name="pic" value="pic1.jpg"/><img src="headimg/pic1.jpg" width="50" style="border-radius: 25px;"></li>
          <li><input type="radio" name="pic" value="pic2.jpg"/><img src="headimg/pic2.jpg" width="50" style="border-radius: 25px;"></li>
          <li><input type="radio" name="pic" value="pic3.jpg"/><img src="headimg/pic3.jpg" width="50" style="border-radius: 25px;"></li><br/>
          <li><input type="radio" name="pic" value="pic4.jpg"/><img src="headimg/pic4.jpg" width="50" style="border-radius: 25px;"></li>
          <li><input type="radio" name="pic" value="pic5.jpg"/><img src="headimg/pic5.jpg" width="50" style="border-radius: 25px;"></li>
          <li><input type="radio" name="pic" value="pic6.jpg"/><img src="headimg/pic6.jpg" width="50" style="border-radius: 25px;"></li>
      </ul>
    </div>
    <div class="form-group" style="height: 34px;">
      <button type="submit" class="btn  submit_style" name="button" id="button"><span>Regist</span></button>
      <a href="javascript:void(0)"  class="regit_char" name="login_1" id="login_1"><small>Login>></small></a>
    </div>

  </form>
    </div>

<div id="loginWeb" class="loginWeb_style" >
  <h3 style="color: #ffffff" align="center">The login site</h3>
  <form action="loginOrRegist.php?action=login" method="post" onSubmit="return Validator.Validate(this,3)">
    <div class="form-group">
     <!-- <label >Your account:</label>-->
      <input type="text" class="form-control bg_alpha " placeholder="accout" name="username_lo" dataType="English"  msg="英文名只允许英文字母" style="width: 300px;color: #FFFFFF">

    </div>
    <div class="form-group">
      <!--<label for="exampleInputPassword1">Password:</label>-->
      <input type="password" class="form-control bg_alpha" placeholder="Password" name="pw_lo" id="textfield3" dataType="SafeString"   msg="密码不符合安全规则" style="width: 300px;color: #FFFFFF">
    </div>
    <!--<div class="form-group">
      <label for="exampleInputFile">File input</label>
      <input type="file" id="exampleInputFile">
      <p class="help-block">Example block-level help text here.</p>
    </div>-->
    <!--<div class="checkbox" style="float: left" >
      <label>
        <input type="checkbox"> Remember me  cookie记住帐号
      </label>
    </div>-->
    <div class="form-group" style="height: 34px;">
    <button type="submit" class="btn  submit_style"><span>Login</span></button>
      <a href="javascript:void(0)" id="regist_1" class="regit_char"><small>regist>></small></a>
      </div>
  </form>

    <?
    if (isset($_POST['code']))
      if(!(md5(strtoupper($_POST['code'])) == $_SESSION['__img_code__'])){
        echo"<script>alert('错误！');</script>";
      }
       // echo (md5(strtoupper($_POST['code'])) == $_SESSION['__img_code__']) ? "Valid!" : "Invalid!";
    ?>
</div>
</div>
</body>
</html>
