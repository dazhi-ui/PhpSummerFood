<?php
include('../conn/conData.php');
    session_start();
      $username=$_SESSION['val'];
    if(!empty($_GET)){
        $id = $_GET['pid'];
        $sql="select * from food where id = ".$id;
        $result=mysqli_query($register,$sql)or die("数据查询失败");
        $row=mysqli_fetch_array($result);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>商品详情</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css" />
    <script src="../js/jquery-3.3.1.min.js" type="text/javascript"></script>
    <script src="../js/bootstrap.min.js" type="text/javascript"></script>
    <style>
        .imgInfo{
            position: relative;
            width: 480px;
            height: 480px;
            float: left;
            left: 20px;
            top: 10px;
        }
        .product_info{
            width:550px ;
            height: 600px;
            float: right;
        }
        .price{
            width: 550px;
            height: 40px;
            background: #e9e9e9;;
        }
        #buynum{
            width: 40px;
            height: 40px;
            font-size: 15px;
        }
        .btnBuy{
            height: 15px;
            font-size:2px ;
            text-align: center;
        }
        #reduce{
            position: relative;
            right: 28px;
            top: 22px;
        }
    </style>
</head>
<script>
    // 增加商品数量
    function addNum() {
        let buynum = document.getElementById("buynum");
        buynum.value = parseInt(buynum.value)+1;
    }
    // 减少商品数量
    function reduceNum() {
        let buynum = document.getElementById("buynum");
        let value = parseInt(buynum.value)-1;
        if (value<=1){
            value = 1;
        }
        buynum.value = value;
    }

</script>
<body>
<form action="buy.php" method="post">
    <div style="width:1100px;height: 600px;border: 2px solid blueviolet">
        <div>
            <img src="<?php echo $row['img'];?>" class="imgInfo">
        </div>
        <div class="product_info">
            <h2><?php echo $row['title'];?></h2>
            <div class="price" style="position:relative;top: 20px;">
                <span class="text-info" style="font-size: 15px">价格：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <font color="#FF0036" size="5"><?php echo $row['newprice'];?></font></span>
            </div>
            <br>
            <div style="position:relative;top: 20px;">
                <span class="text-info" style="font-size: 15px">运费：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <font color="#FF0036" size="5">10元</font></span>
            </div>
            <br>
            <div style="position:relative;top: 20px;">
                <span class="text-info" style="font-size: 15px">数量</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="number" class="text-info" id="buynum" value="1" name="buynum">
                <div style="float: right;position: relative;right: 350px">
                    <input type="button" value="∧" onclick="addNum()" class="btnBuy" id="add">
                    <input type="button" value="∨" onclick="reduceNum()" class="btnBuy" id="reduce">
                </div>
            </div>
            <br>
            <div style="position:relative;top: 20px;">
                <input type="submit" id="buyBtn" class="btn btn-success" value="立即购买"  style="position: relative;left: 87px">
                <input type="submit" class="btn btn-danger" value="加入购物车" style="position: relative;left: 100px"  formaction="../add/addShopping.php">
            </div>
            <input type="hidden"  name="id" value="<?php echo $row['id']; ?>">
            <br>
            <div style="position:relative;top: 20px;">
                <span style="font-size: 15px">服务承诺</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <span style="font-size: 15px"><a href="#">正品保证</a></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <span style="font-size: 15px"><a href="#">急速退款</a></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <span style="font-size: 15px"><a href="#">七天无理由退款</a></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            </div>
        </div>
    </div>
</form>
</body>
</html>