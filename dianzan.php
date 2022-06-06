<?php
//检测用户是否登录
include 'islogin.php';
$chatid=$_POST['chatid'];
$uid=$_SESSION['uid'];
$time = date('Y-m-d H:i:s');

include 'conn.php';
$sql='insert into dianzan (uid,chatid,dztime) values (?,?,?,?)';
$stmt=$conn->prepare($sql);
$stmt->bind_param("sss",$uid,$chatid,$time);
$rs=1
try {
    $stmt->execute();

}catch (Exception $err){
    echo $rs;
}
//json_decode() 把数据转换成json格式
echo json_decode(['code'=>$rs]);
