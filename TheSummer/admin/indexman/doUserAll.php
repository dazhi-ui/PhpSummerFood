<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title>网站后台管理模版</title>
    <link rel="stylesheet" type="text/css" href="../../static/admin/layui/css/layui.css" />
    <link rel="stylesheet" type="text/css" href="../../static/admin/css/admin.css" />
    <script src="../../js/jquery.min.js"></script>
</head>
<body>
 <?php
    include_once("../../conn/conData.php");
    $sql = "select * from user";
    $result = mysqli_query($register, $sql);
    ?>
<div class="page-content-wrap">
    <form class="layui-form" action="">
        <div class="layui-form-item">
            <div class="layui-inline tool-btn">
                <button class="layui-btn layui-btn-small layui-btn-normal addBtn hidden-xs" data-url="doUserAdd.php"><i class="layui-icon">&#xe654;</i></button>
            </div>
            <div class="layui-inline">
                <p class="layui-input">点击+添加学生信息&nbsp&nbsp</p>
            </div>
            <div class="layui-inline tool-btn">
                <button class="layui-btn layui-btn-small layui-btn-warm listOrderBtn hidden-xs" data-url=""><i class="iconfont">点击刷新页面</button>
            </div>
        </div>
    </form>
    <div class="layui-form" id="table-list">
        <table class="layui-table" lay-even lay-skin="nob">
            <colgroup>
                <col width="50">
                <col class="hidden-xs" width="50">
                <col class="hidden-xs" width="100">
                <col>
                <col width="80">
                <col width="150">
            </colgroup>
            <thead>
            <tr>
                <th><input type="checkbox" name="" lay-skin="primary" lay-filter="allChoose"></th>
                <th class="hidden-xs">ID</th>
                <th class="hidden-xs">用户名称</th>
                <th>手机号</th>
                <th>用户状态</th>
                <th style="text-align: center">操作</th>
            </tr>
            </thead>
            <tbody>
            <?php
            while ($rows = mysqli_fetch_row($result)) {
                echo " <tr>
                <td><input type=\"checkbox\" name=\"\" lay-skin=\"primary\" data-id=\"1\"></td>
                <td class=\"hidden-xs\">$rows[0]</td>
                <td>$rows[1]</td>
                <td>$rows[3]</td>
                <td><button class=\"layui-btn layui-btn-mini layui-btn-normal table-list-status\" data-status='1'>用户正常</button></td>
                <td>
                    <div class=\"layui-inline\" style=\"width: 200px;text-align: center\">
                        <button class=\"layui-btn layui-btn-mini layui-btn-normal add-btn\" data-id=\"$rows[0]\" data-url=\"doUserSee.php\"><i class=\"layui-icon\">(๑¯ω¯๑)</i></button>
                        <button class=\"layui-btn layui-btn-mini layui-btn-normal  edit-btn\" data-id=\"$rows[0]\" data-url=\"doUserUpdata.php\"><i class=\"layui-icon\">&#xe642;</i></button>
                        <button class=\"layui-btn layui-btn-mini layui-btn-danger del-btn\" data-id=\"1\" data-url=\"\" onclick='del($rows[0])'><i class=\"layui-icon\">&#xe640;</i></button>
                    </div>
                </td>
            </tr>";
            }?>

            </tbody>
        </table>
    </div>
</div>
<script src="../../static/admin/layui/layui.js" type="text/javascript" charset="utf-8"></script>
<script src="../../static/admin/js/common.js" type="text/javascript" charset="utf-8"></script>
<script>
    //列表删除
    function del(id) {
        var r=confirm("您确定要进行删除吗？")
        if (r==true)
        {
            //document.write("You pressed OK!")
            $.ajax({
                url: '../../delete/deleteUser.php',
                type: 'post',
                dataType: 'json',
                data: {"id":id},
                success: function (data) {
                    wen2=data.kind2;
                    if(wen2=="false"){
                        alert("数据库删除失败");
                        return false;
                    }
                    else {
                        alert("用户数据删除成功");
                    }
                },
            error:function(){alert("xdc");}});
            layer.msg('用户数据删除成功');

        }
        else
        {
            layer.msg('取消删除操作');
        }
        return false;
    }
</script>
</body>
</html>