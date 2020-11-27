<?php
include "databases.php";
include "encode-function.php";
include "JSONuse.php";
heaer('Content-type:text/html;charset=utf-8');
$shopget=getconnection();
mysqli_select_db($shopget,'shopinf');
$get=mysqli_query($shopget,"SELECT * FROM shopinf");
$shopdata=mysqli_fetch_array($get);
$shopid=$shopdata['shopid'];
$userid=onepersondecode($shopdata['userid']);
//解封
$shopname=$shopdata['shopname'];
$shopdes=$shopdata['shopdes'];
$shopstyle=$shopdata['shopstyle'];
$one=$shopdata['one'];
$two=$shopdata['two'];
$three=$shopdata['three'];
//只有userid是封装在加密函数里的
$shopdatas=array(
    "shopid"=>$shopid,
    "userid"=>$userid,
    "shopname"=>$shopname,
    "shopdes"=>$shopdes,
    "shopstyle"=>$shopstyle,
    "one"=>$one,
    "two"=>$two,
    "three"=>$three
);
 $a=JSONin($shopdatas);
 echo JSONout($a);

?>