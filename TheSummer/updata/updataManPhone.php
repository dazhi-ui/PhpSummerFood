<?php
header("Content-type:text/html;charset=utf-8");
function _check_username($username, $phone,$register)
{
    $sqlstr2 = "update admin set phone = '".$phone."'where username='".$username."'";
    $result2 = mysqli_query($register,$sqlstr2);
    if($result2!=0)
    {
        return true;
    }
    return false;
}
include_once("../conn/conData.php");
$username = $_POST['forget-username'];
$phone = $_POST['forget-code'];
$resultresult="false";
if(_check_username($username,$phone,$register))
{
    $resultresult="true";
}
$json_arr = array("kind2" => $resultresult);
$json_obj = json_encode($json_arr);
echo $json_obj;


