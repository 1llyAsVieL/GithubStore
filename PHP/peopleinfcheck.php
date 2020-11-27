<?php
header('Content-type:text/html;charset=utf-8');
include "databases.php";
include "encode-function.php";
include "JSONuse.php";
$checkfound=getconnection();
mysqli_select_db($checkfound,'peopinto');
$username=$_COOKIE['username'];
$usercheck=mysqli_query($checkfound,"SELECT * FROM userinf WHERE username=$username");
$result=mysqli_fetch_array($usercheck);

$userid=$result['userid'];
$inputid=$result['inputid'];
//这个是用户自己生成的11位id。
$username=$result['username'];
$userphone=$result['userphone'];
$usermanorwoman=$result['usermanorwoman'];
$useremail=$result['useremail'];
$peopdata=array(
    "userid"=>$userid,
    "inputid"=>$inputid,
    "username"=>$username,
    "userphone"=>$userphone,
    "famles"=>$usermanorwoman,
     "useremail"=>$useremail
);
echo JSONout(JSONin($peopdata));


