<?php
header('Content-type:text/html;charset=utf-8');
session_start();
include "databases.php";
include "encode-function.php";
include "JSONuse.php";
$getin=getconnection();
mysqli_select_db($getin,'peopinto');
$userid=$_SESSION['userid'];
$address=$_POST['useraddress'];
$babyid=$_POST['babyid'];
$snum=mysqli_query($getin,"SELECT shopid,babynum FROM babyinf WHERE babyid=$babyid");
//把相对的店家找出来，然后库存找出来，加一减一之类的，然后找到对应的商家id
$shopre=mysqli_fetch_array($snum);
$babynum=$shopre['babynum'];
$shopid=$shopre['shopid'];
if ($snum){
    $shopdata=mysqli_query($getin,"UPDATE babyinf SET babynum=($shopid-1) WHERE babyid=$babyid");
    if ($shopdata){
        $babysure=mysqli_query($getin,"INSERT INTO shopsure (userid,shopid,babyid,address) VALUES 
 ('.$userid.','.$shopid.','.$babyid.','.$address.')   ");
        if($babysure){
            $msg=1;
            echo JSONout(JSONin($msg));
        }
    }
}
//这个是购买页面
//这个还得继续改






?>