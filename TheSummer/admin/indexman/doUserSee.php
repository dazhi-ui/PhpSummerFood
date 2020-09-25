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
                <input type="text" name="username" id="username" required lay-verify="required" disabled value="<?php echo $rows[1];?>" autocomplete="off" class="layui-input">
            </div>

        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">手机号：</label>
            <div class="layui-input-block">
                <input type="text" name="phone" id="phone" required lay-verify="required" disabled value="<?php echo $rows[3];?>" autocomplete="off" class="layui-input">
            </div>

        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">登录密码：</label>
            <div class="layui-input-block">
                <input type="text" name="password" id="password" required lay-verify="required" disabled value="<?php echo $rows[2];?>" autocomplete="off" class="layui-input">
            </div>

        </div>

        <div class="layui-form-item">
            <div class="layui-input-block">
                <button style="background-color: #00FFFF;width: 100px;height: 40px" disabled>确定</button>
            </div>
        </div>
    </form>
</div>

<script src="../../static/admin/layui/layui.js" type="text/javascript" charset="utf-8"></script>
</body>

</html>