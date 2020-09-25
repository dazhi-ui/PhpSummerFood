<?php
header("Content-type:text/html;charset=utf-8");

include_once("../conn/conData.php");
session_start();
$username=$_SESSION['val'];
$id=$_POST['id'];

$sql="select * from shopping where prodid = ".$id;
$result=mysqli_query($register,$sql)or die("数据查询失败");
if($row=mysqli_fetch_array($result)) {

    echo "<script>alert('已经收藏过此产品。可到购物车查看');history.back();</script>";
}
else{
    $sqlstr1 = "insert into shopping values('0','".$username."','".$id."')";
    $result2 = mysqli_query($register,$sqlstr1);
    if ($result2){
        echo "<script>alert('加入购物车成功,详细信息请查看购物车');history.back();</script>";

    }
}


