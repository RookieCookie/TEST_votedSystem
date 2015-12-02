<?php
$com = @mysql_connect("localhost","root","123456") or die('数据库服务器连接失败！');//打开数据库服务器 @ 用于屏蔽错误
if(!$com){
    echo "数据库连接失败";
}
mysql_select_db("votedsystem");    //选择数据库
mysql_query("set names utf8");    //设置编码类型
?>