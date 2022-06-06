<!-- 首页（显示话题和评论、点赞信息等） -->
<?php
    // 要使用session
    session_start();
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>话题首页</title>
    <!-- 第三方的插件：样式插件 -->
    <link rel="stylesheet" href="libs/bootstrap-5.1.3/css/bootstrap.css">
    <script src="libs/popper.min.js"></script>
    <script src="libs/bootstrap-5.1.3/js/bootstrap.min.js"></script>
    <script src="libs/jquery-3.6.0.js"></script>
    <style>
        .chatbox { 
            display: grid;
            grid-template-columns: 60px auto;
            gap:15px;
        }
        .face {
            width: 60px;
            height: 60px;
            background: #ccc;
            border-radius: 50%;
        }
        .pl-box{
            display: flex;
            align-items: center;
            gap: 40px;
        }
        #dianzan{
            width: 40px;


        }
    </style>
</head>
<body>
    <div class="container">
        <div class='mt-4 mb-4'>
            <?php
                if(empty($_SESSION['uid'])){
            ?>
                <a class="btn btn-success" data-bs-toggle="modal" data-bs-target="#loginModal">登录</a> | 
                <a class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#regModal">注册</a>
            <?php        
                }else{
            ?>
                欢迎：
                <?php
                    echo $_SESSION['nickname'];
                ?>!
                <a href="login_out.php">退出</a>
                <a data-bs-toggle="modal" data-bs-target="#chatModal">发布话题</a>
            <?php
                }
            ?>
        </div>
        <!-- 话题的结构（布局） -->
        <?php
            include 'conn.php';
            $sql="select c.*, u.nickname from chat c, users u where c.uid = u.uid order by pubtime desc";
            $sql1="select * from chat order by pubtime desc";
            $rs=$conn->query($sql1);
            while($row=$rs->fetch_assoc()){
                echo $row['title'];
                ?>
        <div class="chatbox">
            <div class='face'></div>
            <div>
<!--                <h4>--><?php //echo $row['nickname']?><!--</h4>-->
                <h4><?php echo $row['uid']?></h4>
                <span><?php echo $row['pubtime']?></span>
            </div>

            <div></div>
            <div>
                <h3><?php echo  $row['title']?></h3>
                <h3><?php echo $row['content']?></h3>
            </div>

<!--            <div></div>-->
<!--            <a class="showComment">[评论]</a>-->
<!---->
<!--            <div></div>-->

            <div>
            <?php
            $sql2="select c.*, u.nickname from comment c, users u where c.uid=u.uid and c.chatid=".$row['id']." order by comtime desc";

            $rs2=$conn->query($sql2);
                while ($comment=$rs2->fetch_assoc()){
                    echo "<div>";
                    echo "<b>".$comment['nickname']."</b>";
                    echo $comment['comment'];
                    echo $comment['comtime'];
                    echo "</div>";
                }
            ?>
                <div><b>小亮：</b>评论评论评论评论评论评论评论评论</div>
                <div class="pl-box">
                    <img src="img/dianzan1.png" title="点赞" id="dianzan" onclick="dianzan('<?php echo $row['id'];?>')">
                    <img src="img/评论.png" title="评论" id="dianzan">
                </div>

                <form action="commentSave.php" method="post" ">
                    <input type="text" name="chatid" value="">
                    <textarea name="comment" cols="30" rows="3"></textarea>
                    <button class="btn btn-success btn-sm">提交</button>
                </form>
<!--                <div><b>小亮：</b>评论评论评论评论评论评论评论评论</div>-->
<!--                <div><b>小亮：</b>评论评论评论评论评论评论评论评论</div>-->
<!--                <div><b>小亮：</b>评论评论评论评论评论评论评论评论</div>-->
            </div>
        </div>
    </div>
        <?php
            }
            $conn->close();
        ?>



    <!-- 弹窗区域 -->
    <!-- 1. 注册 -->
    <form action="regSave.php" method="post">
        <div class="modal fade" id="regModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="regModalTitle">注册新用户</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 ps-5 pe-5">
                    账号
                    <input type="text" name='uid' class='form-control' required minlength='3' maxlength='20'>
                    密码
                    <input type="password" name='pwd' class='form-control' required minlength='6' maxlength='20'>
                    密码确认
                    <input type="password" name='pwd2' class='form-control' required>
                    昵称
                    <input type="text" name='nickname' class='form-control' required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                    <button class="btn btn-primary">提交</button>
                </div>
                </div>
            </div>
        </div>
    </form>

    <!-- 2.登录 -->
    <form action="checkLogin.php" method="post">
        <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalTitle">用户登录</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 ps-5 pe-5">
                    账号
                    <input type="text" name='uid' class='form-control' required minlength='3' maxlength='20'>
                    密码
                    <input type="password" name='pwd' class='form-control' required minlength='6' maxlength='20'>
                    验证码
                    <input type="text" name='yzm' class='form-control' required>
                    <img src="yzm.php" onclick="this.src+='?'">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                    <button class="btn btn-primary">登录</button>
                </div>
                </div>
            </div>
        </div>
    </form>

    <!-- 3.发布话题 -->
    <form action="chatSave.php" method="post">
        <div class="modal fade" id="chatModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalTitle">发布新话题</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 ps-5 pe-5">
                    标题
                    <input type="text" name="title" class="form-control">
                    内容
                    <textarea name="content" rows="5" class="form-control"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                    <button class="btn btn-primary">提交</button>
                </div>
                </div>
            </div>
        </div>
    </form>

    <script>
        $('.showComment').click(function(){

        $(this).parent().siblings('from').toggle()
        }
        //点赞
        function dianzan(chat_id){
            // alert(chat_id)
            $.ajax(
                {
                    type:"post",
                    url:"dianzan.php",
                    data:{chatid:chat_id},
                    dataType:"json",
                    success:function (response)
                }
            )
        }
    </script>
</body>
</html>