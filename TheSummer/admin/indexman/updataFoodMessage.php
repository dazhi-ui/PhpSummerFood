<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>注册图书</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="https://ajax.aspnetcdn.com/ajax/bootstrap/4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">
    <link rel="stylesheet" href="../../css/style.default.css" id="theme-stylesheet">
</head>
<body>
<?php
include_once("../../conn/conData.php");//包含数据库连接文件
    $sqlstr = "select * from food where id = " . $_GET['id'];//定义查询语句
    $wen= $_GET['id'];
    $result = mysqli_query($register, $sqlstr);//执行查询语句
    $rows = mysqli_fetch_row($result);//将查询结果返回为数组
?>
<div class="page login-page">
    <div class="container d-flex align-items-center">
        <div class="form-holder has-shadow">
            <div class="row">
                <!-- Logo & Information Panel-->
                <div class="col-lg-6">
                    <div class="info d-flex align-items-center">
                       <img src="<?php echo $rows[5];?>" style="width: 500px;height: 600px">
                    </div>
                </div>
                <!-- Form Panel    -->
                <div class="col-lg-6 bg-white">
                    <div class="form d-flex align-items-center">
                        <div class="content">
                            <div class="form-group">
                                <p style="color: #3b25e6">商品名称</p><input id="title" class="input-material" type="text" name="title" value="<?php echo $rows[1];?>" >
                            </div>
                            <div class="form-group">
                                <p style="color: #3b25e6">现在价格</p> <input id="newprice" class="input-material" type="number" name="newprice" value="<?php echo $rows[2];?>"   >
                            </div>
                            <div class="form-group">
                                <p style="color: #3b25e6">原来价格</p> <input id="oldprice" class="input-material" type="number" name="oldprice" value="<?php echo $rows[3];?>" >
                            </div>

                            <div class="form-group">
                                <p style="color: #3b25e6">库存数量</p> <input id="salenumber" class="input-material" type="number" name="salenumber"  value="<?php echo $rows[4];?>"  >
                            </div>
                            <div class="form-group">
                                <input name="kind" type="radio" value=肉类零食 <?php if($rows[6]=='肉类零食') echo 'checked'?> />肉类零食
                                <input name="kind" type="radio" value=素类零食 <?php if($rows[6]=='素类零食') echo 'checked'?>/>素类零食
                                <input name="kind" type="radio" value=甘果类零食 <?php if($rows[6]=='甘果类零食') echo 'checked'?>/>甘果类零食
                            </div>
                            <div class="form-group">
                                <button id="regbtn" type="button" name="registerSubmit" class="btn btn-primary" onclick="xiugai()">立即修改</button>
                            </div>
                            <!--                            <small>已有账号?</small><a href="index.html" class="signup">&nbsp;登录</a>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- JavaScript files-->
<script src="https://libs.baidu.com/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript" src="../../js/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="../../js/Treatment.js"></script>
<script src="https://ajax.aspnetcdn.com/ajax/bootstrap/4.2.1/bootstrap.min.js"></script>
<script type="text/javascript" src="../../layui/layui.js"></script>
<link href="../../layui/css/layui.css" rel="stylesheet" type="text/css" />

<script>
    function xiugai()
    {
        var id=<?php echo $rows[0];?>;
        var title=document.getElementById('title').value;
        var newprice=document.getElementById('newprice').value;
        var oldprice=document.getElementById('oldprice').value;
        var salenumber=document.getElementById('salenumber').value;
        var New=document.getElementsByName("kind");
        var kind;
        for(var i=0;i<New.length;i++) {
            if (New.item(i).checked) {
                kind = New.item(i).getAttribute("value");
                break;
            } else {
                continue;
            }
        }
        alert(kind);
        if(title==""||newprice==""||oldprice==""||salenumber==""||kind=="")
        {
            alert("请将信息填写齐全，修改失败");
            return false;
        }
        else
        {
            $.ajax({
                url: '../../updata/updataFood.php',
                type: 'post',
                dataType: 'json',
                data: {"id":id,"title":title,"newprice":newprice,"oldprice":oldprice,"salenumber":salenumber,"kind":kind},
                success: function (data) {
                    var wen1=data.kind1;
                    if(wen1=="true")
                    {
                        alert("商品信息修改成功");
                    }
                },
                error :function(data){
                    alert("商品信息修改成功");
                }});
        }
    }
</script>
</body>
</html>