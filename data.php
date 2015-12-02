<?php
/**
 * Created by PhpStorm.
 * User: Mr.z
 * Date: 2015/12/2
 * Time: 10:53
 */
include_once('connect.php');
$sql = "select * from voted_count";
$result = $dbh->query($sql);
$a=array();
while($b = $result->fetch()){
    $c = array();
    $c['name'] = $b['voted_name'];
    $c['counts'] = $b['counts'];
    array_push($a,$c);
}
echo json_encode($a);
/*print_r($a);*/