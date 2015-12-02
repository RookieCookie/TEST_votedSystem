<?php
header('Content-type: text/html;charset=utf-8');
$iipp = $_SERVER['REMOTE_ADDR'];
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/11/18
 * Time: 16:15
 */
include_once("connect.php");
$a = array();
$toid = $_POST['toid'];        /*获取当前用户ID*/
$forid = $_POST['forid'];      /*获取目标ID*/
$counts = $_POST['counts'];    /*获取当前票数*/
$counts++; /* 票数+1*/
/*echo $sql_time;*/
if($toid == 0){
    $a['error']=1;
    $a['msg']="请登录后再投票！";
    echo json_encode($a);
    exit;
}
else {
    $a['error'] = 0;
    $a['msg'] = "投票成功！";
    /**计算时间**/
    $sql_time = "select * from voted_notes";
    $result_time = $dbh->query($sql_time);
    $ipCounts = $result_time->fetch();
    $time = $ipCounts['voting_time'];
    $res = (time() - $time)/86400;   /*判断投票天数间隔是否大于1*/
    $sql_forid = "select * from voted_notes where votedGoal_id = '$forid' ";
    $result_forid = $dbh->query($sql_forid);
    $vNum = $result_forid->rowCount();
    if($res < 1 and $vNum > 0){   /*一个用户一天只能给同一个人投一次*/
        $a['error'] = 0;
        $a['msg'] = "抱歉，一个用户一天只能给同一个人投一次！";
        echo json_encode($a);
        exit;
    }
    $sql_counts = "select * from voted_notes where votedPeople_id = '$toid'";
    $result_counts = $dbh->query($sql_counts);
    $vCou = $result_counts->rowCount();
    if($vCou > 2){    /*3 == 0—1—2*/
        $a['error'] = 0;
        $a['msg'] = "抱歉，一个用户一天最多只能投三次！";
        echo json_encode($a);
        exit;
    }
    $sql = "update voted_count set counts ='$counts'  where id = '$forid'";  //更新票数
    $sql1 = "insert into voted_notes (votedPeople_id,votedGoal_id,voting_time,voted_ip) value ('$toid','$forid','" . time() . "','$iipp')";  //记录投票
    $result = $dbh->query($sql);
    $result1 = $dbh->query($sql1);
    echo json_encode($a);
}
?>