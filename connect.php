<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-10-23
 * Time: 上午10:13
 */
$user='root';      //数据库连接用户名
$pass='123456';          //对应的密码
$dsn = "mysql:host=localhost;dbname=votedsystem";
$dbh = new PDO($dsn, $user, $pass); //初始化一个PDO对象
$dbh->query("set names utf8");
?>