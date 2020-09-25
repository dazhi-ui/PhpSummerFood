<?php
header("Content-type:text/html;charset=utf-8");
include_once("../conn/conData.php");
session_start();
$kind=$_SESSION['kind'];

$userid=$_POST['userid'];
$prodid=$_POST['prodid'];
$zongqianshu=$_POST['zongqianshu'];
$shuliang=$_POST['shuliang'];
$address=$_POST['address'];
$state="未发货";
$sqlstr2="select * from food where id='".$prodid."'";
$result3 = mysqli_query($register,$sqlstr2);
$rows = mysqli_fetch_row($result3);
if($rows[4]<$shuliang)
{
    echo "<script type='text/javascript'>alert('库存数量不足，付款失败，终止交易');</script>";
    if($kind=="素类零食")
    {
        echo "<script type='text/javascript'>location='../admin/index/showFoodOne.php?kind=素类零食';</script>";
    }
    else if($kind=="肉类零食")
    {
        echo "<script type='text/javascript'>location='../admin/index/showFoodOne.php?kind=肉类零食';</script>";
    }
    else if($kind=="甘果类零食")
    {
        echo "<script type='text/javascript'>location='../admin/index/showFoodOne.php?kind=甘果类零食';</script>";
    }
    else
    {
        echo "<script type='text/javascript'>location='../commodities/commodities.php';</script>";
    }
    return;
}
else {
    $wen=$rows[4]-$shuliang;
    $sqlstr22="update food set salenumber='".$wen."'where id='".$prodid."'";
    $result32 = mysqli_query($register,$sqlstr22);

    $sqlstr1 = "insert into foodorder values('0','" . $userid . "','" . $prodid . "','" . $address . "','" . $zongqianshu . "','" . $shuliang . "','" . $state . "')";
    $result2 = mysqli_query($register, $sqlstr1);
    if ($result2) {
        echo "<script type='text/javascript'>alert('恭喜您购买成功,可以浏览其他产品');</script>";
        if($kind=="素类零食")
        {
            echo "<script type='text/javascript'>location='../admin/index/showFoodOne.php?kind=素类零食';</script>";
        }
        else if($kind=="肉类零食")
        {
            echo "<script type='text/javascript'>location='../admin/index/showFoodOne.php?kind=肉类零食';</script>";
        }
        else if($kind=="甘果类零食")
        {
            echo "<script type='text/javascript'>location='../admin/index/showFoodOne.php?kind=甘果类零食';</script>";
        }
        else
        {
            echo "<script type='text/javascript'>location='../commodities/commodities.php';</script>";
        }
        return;
    } else {
        echo "<script type='text/javascript'>alert('提交订单失败，付款失败，终止交易');</script>";
        if($kind=="素类零食")
        {
            echo "<script type='text/javascript'>location='../admin/index/showFoodOne.php?kind=素类零食';</script>";
        }
        else if($kind=="肉类零食")
        {
            echo "<script type='text/javascript'>location='../admin/index/showFoodOne.php?kind=肉类零食';</script>";
        }
        else if($kind=="甘果类零食")
        {
            echo "<script type='text/javascript'>location='../admin/index/showFoodOne.php?kind=甘果类零食';</script>";
        }
        else
        {
            echo "<script type='text/javascript'>location='../commodities/commodities.php';</script>";
        }
        return;
    }
}


