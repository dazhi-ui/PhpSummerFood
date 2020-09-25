<?php
header("Content-type:text/html;charset=utf-8");
function _check_username($id,$register,$username,$address,$number)
{
    //查出用户信息
    $sqlstr0="select * from user where username='".$username."'";
    $result0=mysqli_query($register,$sqlstr0);
    $rows0 = mysqli_fetch_row($result0);
    //查出商品的id
    $sqlstr1="select * from shopping where id='".$id."'";
    $result1=mysqli_query($register,$sqlstr1);
    $rows1 = mysqli_fetch_row($result1);
    //查出商品的信息
    $sqlstr2="select * from food where id='".$rows1[2]."'";
    $result2=mysqli_query($register,$sqlstr2);
    $rows2=mysqli_fetch_row($result2);

    if($rows2[4]<$number)
    {
        return false;
    }
    else
    {
        $allmoney=$rows2[2]*$number+10;
        $state="未发货";
        //增加购买的商品
        $sqlstr3="insert into foodorder values('0','" . $rows0[0] . "','" . $rows2[0] . "','" . $address . "','" . $allmoney . "','" . $number . "','" . $state . "')";
        $result3=mysqli_query($register,$sqlstr3);
        //删除购物车里的数据
        $sqlstr4="delete from shopping where id='".$id."'";
        $result4=mysqli_query($register,$sqlstr4);
        //更新商品数量
        $number=$rows2[4]-$number;
        $sqlstr5="update food set salenumber='".$number."'where id='".$rows2[0]."'";
        $result5=mysqli_query($register,$sqlstr5);
        return true;
    }
}
include_once("../conn/conData.php");
session_start();
$username=$_SESSION['val'];
$id=$_POST['id'];
$address=$_POST['address'];
$number=$_POST['number'];
$resultresult="false";
if(_check_username($id,$register,$username,$address,$number))
{
    $resultresult="true";
}
$json_arr = array("kind2" => $resultresult);
$json_obj = json_encode($json_arr);
echo $json_obj;


