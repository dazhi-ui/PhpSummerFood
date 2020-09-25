<?php
header("Content-type:text/html;charset=utf-8");
function _check_username($phone, $register)
{ $sqlstr2 = "select * from user where phone='".$phone."'";
    $result2 = mysqli_query($register,$sqlstr2);
    while ($rows = mysqli_fetch_row($result2)){
        return true;
    }
    return false;
}
include_once("../conn/conData.php");
$phone = $_POST['forget-code'];
$resultresult="false";
if(_check_username($phone,$register))
{
    $resultresult="true";
}
$json_arr = array("kind2" => $resultresult);
$json_obj = json_encode($json_arr);
echo $json_obj;


