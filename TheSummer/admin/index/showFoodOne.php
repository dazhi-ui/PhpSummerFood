<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>食品购买系统</title>
    <link href="../../css/libiao.css" type="text/css" rel="stylesheet">
</head>

<body>
<section class="main_box">
    <div class="box">
        <ul>
            <?php
            include_once("../../conn/conData.php");
            $kind=$_GET['kind'];
            session_start();
            $_SESSION['kind']=$kind;
            $sqlstr2 = "select * from food where kind='".$_GET['kind']."'order by id";
            $result2 = mysqli_query($register,$sqlstr2);
            while ($rows = mysqli_fetch_row($result2)){
                echo "<li>
                    <a href=\"../../commodities/product_info.php?pid=$rows[0]\">
                   <p >$rows[1]</p>
                    <h3>单价：$rows[2]</h3>
                    <h3 style='text-decoration:line-through'>原价：$rows[2] 元</h3>
                    <img src=\"$rows[5]\" alt=\"img\">
                 </a>
            </li>";
            }?>
            <div style="clear: both"></div>
        </ul>
    </div>
</section>
<script src="../../js/jquery-1.12.1.min.js"></script>
<script>
    $(".box ul li").hover(function(){
        $(this).addClass('on').siblings().removeClass('on');
    });
</script>
</body>
</html>
