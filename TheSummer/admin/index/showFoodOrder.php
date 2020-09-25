<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>显示订单信息</title>
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/popper.js/1.15.0/umd/popper.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <style type="text/css">
        #col{
            color: red;
        }
    </style>
</head>
<body>
<?php
include_once("../../conn/conData.php");
?>
<table class="table table-hover table-striped table-bordered table-sm" id="resultshow" style="cellspacing="0"">

    <?php
    session_start();
    $username=$_SESSION['val'];
    //先获取id
    $first="select * from user  where username='". $username ."' order by id";
    $resultfirst = mysqli_query($register, $first);
    $rowsfirst = mysqli_fetch_row($resultfirst);
    if($_GET['action'] == "未发货"){
        $sql = "select * from foodorder   where state='未发货' and userid='". $rowsfirst[0] ."'  order by id";
    }
    else if($_GET['action'] == "运输中"){
        $sql = "select * from foodorder   where state='运输中'and userid='". $rowsfirst[0] ."'  order by id";
    }else if($_GET['action'] == "已送达"){
        $sql = "select * from foodorder   where state='已送达' and userid='". $rowsfirst[0] ."' order by id";
    }
    $result = mysqli_query($register, $sql);
    while ($rows = mysqli_fetch_row($result)) {
        //查询其他两个表显示全部的订单信息
        $sqluser = "select * from user  where id='". $rows[1] ."' order by id";
        $resultuser = mysqli_query($register, $sqluser);
        $rowsuser = mysqli_fetch_row($resultuser);

        $sqlbook = "select * from food  where id='". $rows[2] ."' order by id";
        $resultbook = mysqli_query($register, $sqlbook);
        $rowsbook = mysqli_fetch_row($resultbook);
        echo "<div>";
        echo "<tr>";
        echo"<td height='50' width='50' rowspan='8' align='center'><img src=" . $rowsbook[5] . " height='300' width='220'></td>";
        echo "<td height='25' align='center'>产品名称</td>";
        echo "<td height='25' align='center'>" . $rowsbook[1] . "</td></tr><tr>";
        echo"<td height='25' align='center' width='150'>产品单价</td>";
        echo "<td height='25' align='center' >" . $rowsbook[2] . " &nbsp; &nbsp;人民币</td></tr><tr>";
        echo "<td height='25' align='center'width='150'>订单价格</td>";
        echo "<td height='25' align='center'>" . $rows[4] . " &nbsp; &nbsp;人民币（+10元运费）</td></tr><tr>";
        echo "<td height='25' align='center'width='150'>商品数量</td>";
        echo "<td height='25' align='center'>" . $rows[5] . "&nbsp; &nbsp;个</td></tr><tr>";
        echo "<td height='25' align='center'width='150'>订单用户名</td>";
        echo "<td height='25' align='center'>" . $rowsuser[1] . "&nbsp; &nbsp;</td></tr><tr>";
        echo "<td height='25' align='center'width='150'>客户联系电话</td>";
        echo "<td height='25' align='center'>" . $rowsuser[3] . "&nbsp; &nbsp;</td></tr><tr>";
        echo "<td height='25' align='center'width='150'>客户目标地址</td>";
        echo "<td height='25' align='center'>" . $rows[3] . "&nbsp; &nbsp;</td></tr><tr>";
        echo "<td height='25' align='center'width='150' >订单当前状态</td>";
        echo "<td height='25' align='center' id='col'>" . $rows[6] . "&nbsp; &nbsp;</td></tr><tr>";
        echo "</td></tr>";
        echo "</div>";
    }
    ?>
</table>
</body>
<script>
    function del1(){
        if(!window.confirm('是否申请退款终止发货??'))
            return false;
    }
</script>
</html>