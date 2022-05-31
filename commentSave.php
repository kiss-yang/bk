<?php

// 包含检测是否扽牢固代码
    include 'islogin.php';
    //接受用户传递的数据
    $chatid=$_POST['chatid'];
    $comment=$_POST['comment'];
    if(empty($chatid)||empty($comment)){
        die('<script>alert("请输入评论内容!");history.back();</script>');
    }
    $sql="insert into comment(comment,comtime,uid,chatid) values (?,?,?,?)";
    include 'conn.php';
    $stsm=$conn->prepare($sql);
    $time=date('Y-m-d H:i:s');
    $uid=$_SESSION['uid'];
    $stsm->bind_param("sssi",$comment,$time,$uid,$chatid);
    $stsm->execute();
    echo "评论成功";

    header("Localhost:index.php");


?>