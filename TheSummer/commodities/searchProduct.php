<?php


//获取指定页商品
function getProductByPage($name,$page){
    $register = mysqli_connect("localhost", "root", "511924", "summerperiod") or die("连接数据库服务器失败！".mysqli_error()); //连接MySQL服务器，选择数据库
    mysqli_query($register,"set names utf8");
    $sql="select * from food where title like '%$name%' limit ".(($page-1)*18).",18";
    $result =  mysqli_query($register,$sql)or die("数据查询失败");
    return $result;
}
//获取总数
function getSumNum($name){
    $register = mysqli_connect("localhost", "root", "511924", "summerperiod") or die("连接数据库服务器失败！".mysqli_error()); //连接MySQL服务器，选择数据库
    mysqli_query($register,"set names utf8");
    $sql="select * from food where title like '%$name%'";
    $result2 =  mysqli_query($register,$sql)or die("数据查询失败");
    $sum = ceil(mysqli_num_rows($result2)/18);
    return $sum;
}
$name = $_GET['name'];
$result = getProductByPage($name,1);
$sum = getSumNum($name);
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
            width: 220px;
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
        .product_info{
            width: 170px;
            height: 60px;
            color: #2fab31;
            overflow: hidden;
            text-overflow: ellipsis;
            position: relative;
            left: 20px;
            display: block;
        }
        body{
            background:;
        }
    </style>
</head>
<body>
<div class="row" style="width: 80%;margin-left: 8%;">

    <?php
    include('../commodities/head.php');
    $i = 0;
    while($row=mysqli_fetch_array($result)){
        $i++;
        ?>
        <div class="col-md-2 div" >
            <a href="product_info.php?pid=<?php echo $row['id'];?>"><img  class="img" src="<?php echo $row['img'];?>"></a>
            <p class="product_info"><a  href="product_info.php?pid=<?php echo $row['id'];?>"><?php echo $row['title'];?></a></p>
            <p style="color: #FF0000">商场价：<?php echo $row['newprice']."￥";?></p>
        </div>
        <?php
    }
    while ($i<=18){
        $i++;
        echo "<div class='col-md-2 div'></div>";
    }
    ?>
    <div class="col-md-2"></div>
    <div class="col-md-6" style="position: relative;">
        <nav aria-label="Page navigation">
            <ul class="pagination pagination-lg">
                <li>
                    <a href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <li class='active'><a href="#">1</a></li>
                <?php
                $length = 5;
                if ($sum<5){
                    $length = $sum;
                }
                for ($i=2;$i<=$sum;$i++){
                    echo "<li><a href='../commodities/searchProductPage.php?page=$i&sum=$sum&name=$name' >$i</a></li>";
                }
                ?>
                <li>
                    <a href="../commodities/searchProductPage.php?page=2&sum=<?php echo "$sum&name=$name";?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>

</body>
</html>

