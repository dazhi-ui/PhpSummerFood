<?php
header("Content-type:text/html;charset=utf-8");
function _check_username($title,$id,$oldprice,$newprice,$kind,$salenumber,$register)
{
    $sqlstr2 = "update food set title = '".$title."',oldprice = '".$oldprice."',newprice = '".$newprice."',kind = '".$kind."',salenumber = '".$salenumber."'where id='".$id."'";
    $result2 = mysqli_query($register,$sqlstr2);
    if($result2!=0)
    {
        return true;
    }
    return false;
}
include_once("../conn/conData.php");
$title = $_POST['title'];
$id=$_POST["id"];
$oldprice=$_POST["oldprice"];
$newprice=$_POST["newprice"];
$kind=$_POST["kind"];
$salenumber=$_POST["salenumber"];
$resultresult="false";
if(_check_username($title,$id,$oldprice,$newprice,$kind,$salenumber,$register))
{
    $resultresult="true";
}
$json_arr = array("kind2" => $resultresult);
$json_obj = json_encode($json_arr);
echo $json_obj;


