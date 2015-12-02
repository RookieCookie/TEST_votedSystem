<?php session_start();
include_once("connect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>投票系统</title>
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
<script src="./js/Chart.js"></script>

<script>
    $(function () {
     $(".imgContents").hover(function () {
     $(this).stop().animate({height: "280px"});
     }, function () {
     $(this).stop().animate({height: "200px"});
     })
     })
</script>
<script>
   function voted(toid, forid, name,counts) {           /*toid 投票人的ID   forid 投给那个人的ID   name 投给那个人的名字*/
     $.ajax({
     url: "votePage.php",
     type: "POST",
     dataType: "json",
     data: {toid: toid,forid: forid,counts: counts},
     success: function (data) {
     if (data['error']) {
     alert(data['msg']);
     window.location.href=('message_login.php');
     }
     else {
     alert(data['msg']);
     window.location.reload();
     }
     }
     })
     }

</script>
<body>
<header class="col-lg-12">
    <div id="login">
        <?
        echo $_SESSION['user'];
        if ($_SESSION['user'] != '') {  //如果用户名不为空，登录
            ?>
            <span style="color: #5E5E5E">欢迎，</span><a href="modify.php" class="linkStyle" title="查看修改资料"><?echo $_SESSION['user']?></a>&nbsp;| <a
                href="logout.php" class="linkStyle">注销</a>
            <? if ($_SESSION['user'] == 'admin') { ?>
                | <a href="adminList.php" style="color: red;text-decoration: none">返回后台</a>
            <? } ?>
            <?
        } else {  //已登录
            ?>
            <a href="message_login.php" class="linkStyle">注册或登录</a>
        <? }
        $type = $_GET['num'];
        ?>
    </div>   <!--登录注册-->
    <div class="dropdown nav_borderStyle navbar nav_border">
        <span class="stqh">投票视图切换</span>
        <button id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav_sty ">
            投票视图
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu list" aria-labelledby="dLabel">
            <li ><a href="index.php?num=0" style="color: #5E5E5E">票数由高到低排列</a> </li>
            <li><a href="index.php?num=1" style="color: #5E5E5E">票数由低到高排列</a> </li>
            <li><a href="index.php?num=2" style="color: #5E5E5E">未得票对象</a> </li>
            <li><a href="index.php?num=3" style="color: #5E5E5E">柱状图显示</a> </li>
            <li><a href="index.php?num=4" style="color: #5E5E5E">曲线图显示</a> </li>
            <li ><a href="index.php?num=5" style="color: #5E5E5E">默认排序</a> </li>
        </ul>
    </div>  <!--下拉列表-->
    <div class="searchBox">
        <form class="navbar-form navbar-left" role="search" action="index.php" method="post">
            <div class="form-group">
            <input type="text" placeholder="search" name="search">
                <input value="1" name="hide" type="hidden">
            </div>
            <button class="btn btn_search" type="submit">search</button>
        </form>
    </div>    <!--搜索-->
</header>
<div class="container">
    <h2 align="center" style="color: #ffffff">最受欢迎动物投票</h2>
   <?php
   $type = $_GET['num'];
   $char = $_POST['search'];
   $ar = array();


   function ran($type){
       $str ='';
       switch ($type){
           case 0:  /*升序*/
               $str = "select * from voted_count order by counts desc limit 0,10;";
               break;
           case 1:  /*降序*/
               $str = "select * from voted_count order by counts asc limit 0,10;";
               break;
           case 2:  /*无得票*/
               $str = "select * from voted_count where counts = '0'limit 0,10;";
               break;
           case 3:  /*柱状图*/
               $str = 1;
               break;

           case 4:  /*曲线图*/
               $str = 2;
               break;
           default:  /*默认*/
               $str = "select * from voted_count limit 0,10;";
               break;
       }
       return $str;
   }  /*排序函数*/
   if($_POST['hide']){
       $sql = "select * from voted_count where voted_name like '%".$_POST['search']."%'";
   }  /*搜索*/
   else{
       $sql = ran($type);
   }
   if($sql == 1 || $sql == 2){  /*显示模式为柱状图或者曲线图*/
       if($sql == 1){?>
           <h2 align="center">投票柱状图</h2>
           <div style="width: 50%">
               <canvas id="canvas" height="600" width="800"></canvas>
           </div>
           <script src="picform.js">
           </script>
       <?}
       else{?>
           <h2 align="center">投票曲线图</h2>
           <div style="width:30%">
               <div>
                   <canvas id="canvas" height="450" width="600"></canvas>
               </div>
           </div>
           <script src="picform1.js"></script>
       <?}
       exit;
   }
   /*$result = mysql_query($sql);*/
   $result = $dbh->query($sql);
   $toid = isset($_SESSION['usersid'])?$_SESSION['usersid']:0;   /*判断是否登录产生session避免传参数出现错误*/
    while ($vote_a = $result->fetch()/*$vote_a = mysql_fetch_a  rray($result)*/) {
        ?>   <!--循环投票目标数组-->
        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3" style="height: 280px;width: 285px">
            <div class="imgContents" >
                <a onclick="voted(<? echo $toid ?>,<? echo $vote_a['id'] ?>,'<? echo $vote_a['voted_name'] ?>',<? echo $vote_a['counts']?>)" href="javascript:void(0)" > <img src="./img/<? echo $vote_a['pic'] ?>" class="img-circle center-block picSize"></a>
                <h4><? echo $vote_a['voted_name'] ?><br><small>票数：<span class="count<?echo $vote_a['id']?>"><? echo $vote_a['counts']?></span></small></h4>
                <small>Hi!this is a pro test;make you mouse hover on to show more message or vote</small>
                <div class="hide_box display_hide ">
                    <a onclick="voted(<? echo $toid ?>,<? echo $vote_a['id'] ?>,'<? echo $vote_a['voted_name'] ?>',<? echo $vote_a['counts']?>)" href="javascript:void(0)" class="btn btn-success btn">投一票</a>
                </div>
            </div>
        </div>
   <? }
   ?>
</div>
</body>
</html>