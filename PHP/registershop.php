<?php
header('Content-type:text/html;charset=utf-8');
session_start();
include "databases.php";
include "encode-function.php";
$shopcon=getconnection();
mysqli_select_db($shopcon,'peopinf');
if ($_SERVER['REQUEST_METHOD']=='POST'){
    $flag=1;
    if (!preg_match('/^[^<>]/',$_POST['userid'])) {
        $userid = onepersoncode($_POST['userid']);
    }else{
        $flag=0;
    }
    if (!preg_match('/^[^<>]/',$_POST['shopname'])){
        $shopname = $_POST['shopname'];
    }else{
        $flag=0;
    }
    if (!preg_match('/^[^<>]/',$_POST['shopdes'])) {
        $shopdes = $_POST['shopdes'];
    }else{
        $flag=0;
    }
    if (!preg_match('/^[^<>]/',$_POST['shopstyle'])) {
        $shopstyle = $_POST['shopstyle'];
    }else{
        $flag=0;
    }
    if (!(preg_match('/^[<>]/',$_POST['one'])&&preg_match('/^[<>]/',$_POST['two'])&&preg_match('/^[<>]/',$_POST['three']))){
        $one=onepersoncode($_POST['one']);
        $two=onepersoncode($_POST['two']);
        $three=onepersoncode($_POST['three']);
    }else{
        $flag=0;
    }
    if ($flag==1){
        $shopinto="INSERT INTO shopinf (userid,shopname,shopdes,shopstyle,one,two,three)
   VALUES ('.$userid.','.$shopname.','.$shopdes.','.$shopstyle.')";
        $shopgo=mysqli_query($shopinto,$shopcon);
        if ($shopgo){
            echo "<script> alert('注册成功') </script>";
            echo  "<script> location.href='peopleweb.html' </script>";
        }
    }
}
?>