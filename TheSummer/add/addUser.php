<?php
header("Content-type:text/html;charset=utf-8");

include_once("../conn/conData.php");
$username = $_POST['register-username'];
$password=$_POST['register-password'];
$phone=$_POST['register-code'];
$resultresult="false";
$sqlstr1 = "insert into user values('0','".$username."','".$password."','".$phone."')";
$result2 = mysqli_query($register,$sqlstr1);
if ($result2){
    $resultresult="true";
}
$json_arr = array("kind1" => $resultresult);
$json_obj = json_encode($json_arr);
echo $json_obj;


