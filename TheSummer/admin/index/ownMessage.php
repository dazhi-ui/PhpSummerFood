<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title>食品购物平台</title>
    <link rel="stylesheet" type="text/css" href="../../static/admin/layui/css/layui.css"/>
    <link rel="stylesheet" type="text/css" href="../../static/admin/css/admin.css"/>
    <script src="../../js/jquery.min.js"></script>
</head>
<body>
<?php
session_start();
$username=$_SESSION['val'];
include_once("../../conn/conData.php");
$sqlstr2 = "select * from user where username='".$username."'";
$result2 = mysqli_query($register,$sqlstr2);
$rows = mysqli_fetch_row($result2);
?>
<div class="layui-tab page-content-wrap">
    <ul class="layui-tab-title">
        <li class="layui-this">查看个人信息</li>
        <li>修改登录密码</li>
    </ul>
    <div class="layui-tab-content">
        <div class="layui-tab-item layui-show">
            <form class="layui-form"  style="width: 90%;padding-top: 20px;">
                <div class="layui-form-item">
                    <label class="layui-form-label">ID：</label>
                    <div class="layui-input-block">
                        <input type="text" name="id" disabled autocomplete="off" class="layui-input layui-disabled" value="<?php echo $rows[0]?>">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">用户名：</label>
                    <div class="layui-input-block">
                        <input type="text" name="username" disabled autocomplete="off" class="layui-input layui-disabled" value="<?php echo $rows[1]?>">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">手机号：</label>
                    <div class="layui-input-block">
                        <input type="text" name="name" disabled  autocomplete="off" class="layui-input layui-disabled" value="<?php echo $rows[3]?>">
                    </div>
                </div>

            </form>
        </div>
        <div class="layui-tab-item">
            <form class="layui-form" v style="width: 90%;padding-top: 20px;">
                <div class="layui-form-item">
                    <label class="layui-form-label">用户名：</label>
                    <div class="layui-input-block">
                        <input type="text" name="username" disabled autocomplete="off" class="layui-input layui-disabled" value="<?php echo $rows[1]?>">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">旧密码：</label>
                    <div class="layui-input-block">
                        <input type="password" name="password1" id="password1wen" required lay-verify="required" placeholder="请输入密码" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">新密码：</label>
                    <div class="layui-input-block">
                        <input type="password" name="password2"  id="password2wen" required lay-verify="required" placeholder="请输入密码" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">重复密码：</label>
                    <div class="layui-input-block">
                        <input type="password" name="password3"  id="password3wen" required lay-verify="required" placeholder="请输入密码" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button class="layui-btn layui-btn-normal" lay-submit lay-filter="adminPassword">立即修改</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="../../static/admin/layui/layui.js" type="text/javascript" charset="utf-8"></script>
<script>
    //Demo
    layui.use(['form','element'], function(){
        var form = layui.form();
        var element = layui.element();
        form.render();
        //监听信息提交
        form.on('submit(adminInfo)', function(data){
            layer.msg(JSON.stringify(data.field));
            return false;
        });
        //监听密码提交

        form.on('submit(adminPassword)', function(data){

            var password1 = document.getElementById('password1wen').value;
            var password2 = document.getElementById('password2wen').value;
            var password3 = document.getElementById('password3wen').value;
            var phone=<?php echo $rows[3];?>;
            var username=<?php echo $username;?>;
            if(<?php echo $rows[2]?>==password1) {
                if (password2 === password3) {
                    //
                    $.ajax({
                        url: '../../updata/updataPassword.php',
                        type: 'post',
                        dataType: 'json',
                        data: {"forget-username":username, "forget-password": password2, "forget-code": phone},
                        success: function (data) {
                            wen2 = data.kind2;
                            if (wen2 == "false") {
                                alert("重置密码失败:数据库错误");
                                return false;
                            } else {
                                alert("密码重置成功。将在下次登录生效");
                            }
                        },
                        error:function(data){alert("cds");}
                    });
                    return false;
                } else {
                    alert("两次新密码输入不一样。重置密码失败");
                    return false;
                }
            }
            else {
                alert("输入的用户密码不正确,重置密码失败");
                return false;
            }
        });

    });

</script>
</body>
</html>