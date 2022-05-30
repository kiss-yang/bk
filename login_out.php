<?php
//只要关于session绘画都要开启
session_start();
//推出操作1，当销毁
//unset($_SESSION['uid']);
//unset($_SESSION['nickname']);
//unset($_SESSION['pud']);
//2.全部销毁
session_unset();
session_destroy();
//3,
//$_SESSION=array();

//header('Location:index.php');
echo '<script>alert("推出成功！");history.back();</script>';