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
$sqlstr2 = "select * from admin where username='".$username."'";
$result2 = mysqli_query($register,$sqlstr2);
$rows = mysqli_fetch_row($result2);
?>
<div class="layui-tab page-content-wrap">
    <ul class="layui-tab-title">
        <li class="layui-this">查看个人信息</li>
        <li>修改手机号</li>
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
                    <label class="layui-form-label">旧手机号：</label>
                    <div class="layui-input-block">
                        <input type="text" name="password1" id="password1wen" required lay-verify="required" placeholder="请输入旧手机号" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">新手机号：</label>
                    <div class="layui-input-block">
                        <input type="text" name="password2"  id="password2wen" required lay-verify="required" placeholder="请输入新手机号" autocomplete="off" class="layui-input">
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

            var phone=<?php echo $rows[3];?>;
            var username=<?php echo $username;?>;
            if(phone==password1) {

                    //
                    $.ajax({
                        url: '../../updata/updataManPhone.php',
                        type: 'post',
                        dataType: 'json',
                        data: {"forget-username":username,  "forget-code": password2},
                        success: function (data) {
                            wen2 = data.kind2;
                            if (wen2 == "false") {
                                alert("更换手机号失败:数据库错误");
                                return false;
                            } else {
                                alert("更换手机号成功。将在下次登录生效");
                            }
                        },
                        error:function(data){alert("cds");}
                    });
                    return false;

            }
            else {
                alert("输入旧手机号不对,更换手机号失败");
                return false;
            }
        });

    });

</script>
</body>
</html>