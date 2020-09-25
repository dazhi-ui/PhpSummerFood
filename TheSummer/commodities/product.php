<?php

include('../conn/conData.php');
include('top.php');
$sql="select * from food where 1=1 ";
if(!empty($_GET)){
    $cid=$_GET["cid"];
    $sql=$sql."and cid=".$cid;
}
$result=mysqli_query($register,$sql)or die("数据查询失败");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>商品列表</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css" />
    <script src="../js/jquery-3.3.1.min.js" type="text/javascript"></script>
    <script src="../js/bootstrap.min.js" type="text/javascript"></script>
    <style>
        .div{
            width: 200px;
            height: 250px;
            float: left;
            padding: 10px 0px;
            text-align: center;
            margin: auto;
        }
        .img{
            width: 130px;
            height: 130px;
            display: inline-block;
        }
    </style>
</head>
<body>
<div class="row" style="width: 80%;margin-left: 10%">
    <?php
        while($row=mysqli_fetch_array($result)){
    ?>
            <div class="col-md-2 div" >
                <a href="product_info.php?pid=<?php echo $row['pid'];?>"><img  class="img" src="<?php echo $row['pimage'];?>"></a>
                <p ><a style="color: #2fab31" href="product_info.php?pid=<?php echo $row['pid'];?>"><?php echo $row['pname'];?></a></p>
                <p style="color: #FF0000">商场价：<?php echo $row['shop_price']."￥";?></p>
            </div>
            <?php
        }
    ?>
</div>
<?php include('bottom.php');?>
</body>
</html>

