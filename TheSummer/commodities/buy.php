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
    <link rel="stylesheet" href="../css/style.default.css" id="theme-stylesheet">
    <link rel="stylesheet" href="../css/cityselect.css">
    <script type="text/javascript" src="../js/cityselect.js"></script>
</head>
<body>
<?php
include_once("../conn/conData.php");//包含数据库连接文件
$geshu=$_POST['buynum'];
$prodid=$_POST['id'];
session_start();
$username=$_SESSION['val'];

//查询其他两个表显示全部的订单信息
$sqluser = "select * from user  where username='". $username."' order by id";
$resultuser = mysqli_query($register, $sqluser);
$rowsuser = mysqli_fetch_row($resultuser);

$sqlbook = "select * from food  where id='".$prodid."' order by id";
$resultbook = mysqli_query($register, $sqlbook);
$rowsbook = mysqli_fetch_row($resultbook);
$zongqianshu=(double)$rowsbook[2]*$geshu+10;
?>
<div class="page login-page">
    <div class="container d-flex align-items-center">
        <div class="form-holder has-shadow">
            <div class="row">
                <!-- Logo & Information Panel-->
                <div class="col-lg-6">
                    <div class="info d-flex align-items-center">
                        <img src="<?php echo $rowsbook[5];?>" style="width: 500px;height: 600px">
                    </div>
                </div>
                <!-- Form Panel    -->
                <div class="col-lg-6 bg-white">
                    <div class="form d-flex align-items-center">
                        <form method="post" action="../add/addOrderMessage.php" autocompete="off">
                        <div class="content">
<!--                            <div class="form-group">-->
<!--                                <p style="color: #3b25e6">商品名称</p><input id="title" class="input-material" type="text" name="title" value="--><?php //echo $rows[1];?><!--" >-->
<!--                            </div>-->
                            <div class="form-group">
                                <p style="color: #3b25e6">产品名称</p><input type="text"  name="title"  class="input-material" placeholder="" required="" value="<?php echo $rowsbook[1] ?>">
                            </div>
                            <div class="form-group">
                                <p style="color: #3b25e6">产品单价</p><input type="text" name="danjia" placeholder=""  class="input-material" required="" value="<?php echo $rowsbook[2] ?>元">
                            </div>
                            <div class="form-group">
                                <p style="color: #3b25e6">购买数量</p><input type="text"  name="shuliang" placeholder=""  class="input-material" required="" value="<?php echo $geshu ?>">
                            </div>
                            <div class="form-group">
                                <p style="color: #3b25e6">运费</p><input type="text"  name="yunfei" placeholder="" required=""  class="input-material"  value="<?php echo "10 元" ?>">
                            </div>
                            <div class="form-group">
                                <p style="color: #3b25e6">应付钱数</p><input type="text"  name="zongqianshu" placeholder=""  class="input-material" required=""  value="<?php echo $zongqianshu ?>">
                            </div>
                            <div class="form-group">
                                <p style="color: #3b25e6">本人名字</p><input type="text" name="username" placeholder=""  class="input-material" required="" value="<?php echo $rowsuser[1] ?>">
                            </div>
                            <div class="form-group">
                                <p style="color: #3b25e6">练习电话</p><input type="text"  name="phone" placeholder=""  class="input-material" required="" value="<?php echo $rowsuser[3] ?>">
                            </div>
                            <div class="form-group">
                                <p style="color: #3b25e6">本人地址</p><input type="text"  id="citySelect"  autocomplete="off" name="address" placeholder=""  class="input-material" required="" value="">
                            </div>
                                <input type="hidden" class="text" name="userid" value="<?php echo $rowsuser[0] ?>">
                                <input type="hidden" class="text" name="prodid" value="<?php echo $rowsbook[0] ?>">
                            <div class="form-group">
                                <button id="regbtn" type="submit" name="registerSubmit" class="btn btn-primary" >提交订单并付款</button>
                            </div>
                            <!--                            <small>已有账号?</small><a href="index.html" class="signup">&nbsp;登录</a>-->
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- JavaScript files-->
<script src="https://libs.baidu.com/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript" src="../js/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="../js/Treatment.js"></script>
<script src="https://ajax.aspnetcdn.com/ajax/bootstrap/4.2.1/bootstrap.min.js"></script>
<script type="text/javascript" src="../layui/layui.js"></script>
<link href="../layui/css/layui.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
    var test=new Vcity.CitySelector({input:'citySelect'});
</script>

</body>
</html>