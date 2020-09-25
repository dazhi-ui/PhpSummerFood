<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title>食品购买系统</title>
    <link rel="stylesheet" type="text/css" href="../../static/admin/layui/css/layui.css" />
    <link rel="stylesheet" type="text/css" href="../../static/admin/css/admin.css" />
    <script src="../../js/jquery.min.js"></script>
</head>
<body>
<?php
include_once("../../conn/conData.php");
$id = $_GET['id'];
$sqlstr2 = "select * from user where id='".$id."'";
$result2 = mysqli_query($register,$sqlstr2);
$rows = mysqli_fetch_row($result2);
?>
<div class="wrap-container">
    <form class="layui-form" style="width: 90%;padding-top: 20px;">

        <div class="layui-form-item">
            <label class="layui-form-label">用户id：</label>
            <div class="layui-input-block">
                <input type="text" name="id" id="id" required lay-verify="required" disabled value="<?php echo $rows[0];?>" autocomplete="off" class="layui-input">
            </div>

        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">用户名称：</label>
            <div class="layui-input-block">
                <input type="text" name="username" id="username" required lay-verify="required" placeholder="请输入用户名" value="<?php echo $rows[1];?>" autocomplete="off" class="layui-input">
            </div>

        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">手机号：</label>
            <div class="layui-input-block">
                <input type="text" name="phone" id="phone" required lay-verify="required" placeholder="请输入手机号" value="<?php echo $rows[3];?>" autocomplete="off" class="layui-input">
            </div>

        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">登录密码：</label>
            <div class="layui-input-block">
                <input type="text" name="password" id="password" required lay-verify="required" placeholder="请输入密码"  value="<?php echo $rows[2];?>" autocomplete="off" class="layui-input">
            </div>

        </div>

        <div class="layui-form-item">
            <div class="layui-input-block">
                <div class="layui-input-block">
                    <button class="layui-btn layui-btn-normal" lay-submit lay-filter="formDemo">立即修改</button>
                    <button type="reset" class="layui-btn layui-btn-primary">重置信息</button>
                </div>
            </div>
        </div>
    </form>
</div>

<script src="../../static/admin/layui/layui.js" type="text/javascript" charset="utf-8"></script>
<script>
    //Demo


    layui.use(['form'], function() {
        var form = layui.form();
        form.render();
        //监听提交
        form.on('submit(formDemo)', function(data) {
            var username=$("#username").val();
            var password=$("#password").val();
            var phone=$("#phone").val();
            var id=$("#id").val();
            var myreg = /^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1}))+\d{8})$/;
            if(!myreg.test($("#phone").val()))
            {
                alert("手机号格式不正确,修改失败");
                var txt1=document.getElementById("phone");
                txt1.value="";
                txt1.focus();
                return false;
            }

            //检查用户名是否注册过了
            var wen2=false;
            $.ajax({
                url: '../../check/checkRegisterUsername.php',
                type: 'post',
                dataType: 'json',
                data: {"register-username":username},
                success: function (data) {
                    wen2=data.kind2;
                    if(wen2=="true"&&username!=<?php echo $rows[1];?>){
                        alert("用户名已经被注册了,修改失败");
                        var txt1=document.getElementById("username");
                        txt1.value="";
                        txt1.focus();
                        return false;
                    }
                    else {
                        //检查手机号是否注册过了
                        wen2=false;
                        $.ajax({
                            url: '../../check/checkRegisterPhone.php',
                            type: 'post',
                            dataType: 'json',
                            data: {"register-code":phone},
                            success: function (data) {
                                wen2=data.kind2;
                                if(wen2=="true"&&phone!=<?php echo $rows[3];?>){
                                    alert("手机号已经被注册了,修改失败");
                                    var txt1=document.getElementById("phone");
                                    txt1.value="";
                                    txt1.focus();
                                    return false;
                                }
                                else {
                                    //注册
                                    //存入数据库
                                    var wen1=false;
                                    $.ajax({
                                        url: '../../updata/updataUserMessage.php',
                                        type: 'post',
                                        dataType: 'json',
                                        data: {"password":password,"username":username,"phone":phone,"id":id},
                                        success: function (data) {
                                            var wen1=data.kind2;
                                            if(wen1=="false")
                                            {
                                                alert("修改数据失败");
                                                return false;
                                            }
                                            else
                                            {
                                                alert("恭喜修改用户信息成功");
                                                // layer.close(layer.index);
                                                window.location.reload();
                                                return false;
                                            }
                                        }
                                    });
                                }
                            }});
                    }
                }});
            return false;
        });
    });
</script>
</body>

</html>