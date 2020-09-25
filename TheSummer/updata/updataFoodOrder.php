<?php
header("Content-type:text/html;charset=utf-8");
function _check_username($id,$state,$register)
{
    $sqlstr2 = "update foodorder set state = '".$state."'where id='".$id."'";
    $result2 = mysqli_query($register,$sqlstr2);
    if($result2!=0)
    {
        return true;
    }
    return false;
}
include_once("../conn/conData.php");
$id=$_POST['id'];
$state=$_POST['state'];
$resultresult="false";
if(_check_username($id,$state,$register))
{
    $resultresult="true";
}
$json_arr = array("kind2" => $resultresult);
$json_obj = json_encode($json_arr);
echo $json_obj;


