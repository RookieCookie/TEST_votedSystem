<?php
/*
 *
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-9-29
 * Time: 上午9:27
 */
session_start();
session_unset();
session_destroy();
header("location:index.php");
?>