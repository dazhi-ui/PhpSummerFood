<?php
header("Content-type:text/html;charset=utf-8");
function _check_username($username,$password1, $register)
{ $sqlstr2 = "select * from user where username='".$username."'and password='".$password1."'";
    $result2 = mysqli_query($register,$sqlstr2);
    while ($rows = mysqli_fetch_row($result2)){
        return true;
    }
    return false;
}
include_once("../conn/conData.php");
$username = $_POST['login-username'];
$password1=$_POST['login-password'];
$resultresult="false";
if(_check_username($username,$password1,$register))
{
    $resultresult="true";

    session_start();
//会话开始，这样你才可以调用session
    $_SESSION['val'] = $username;
}
$json_arr = array("kind2" => $resultresult);
$json_obj = json_encode($json_arr);
echo $json_obj;


