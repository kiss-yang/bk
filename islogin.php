<?php
session_start();
if(empty($_SESSION['udi'])){
//    查看会话是否存在，不存在表示没有登录
    die('<script>alert("对不起你还没有登录，请登录!");history.back();</script>');
}