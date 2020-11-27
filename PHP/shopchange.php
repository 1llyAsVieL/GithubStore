<?php
session_start();
header('Content-type:text/html;charset=utf-8');
include "databases.php";
include "encode-function.php";
$shopch=getconnection();
mysqli_select_db($shopch,'peopinto');
  if($_SERVER['REQUEST_METHOD']=='POST'){
      $flag=1;
       $userid=onepersoncode($_SESSION['userid']);
       $shopid=$_POST['shopid'];
       $shopnameUP=$_POST['shopnamechange'];
       $shopdeschange=$_POST['shopdeschange'];
       if ($shopnameUP){
           $idchan=mysqli_query($shopch,"UPDATE shopinf SET shopname=$shopnameUP WHERE shopid=$shopid");
           if (!($idchan)){$flag=0;}else{$flag=2;}
       }
       if ($shopdeschange){
           $deschan=mysqli_query($shopch,"UPDATE shopinf SET shopdes=$shopdeschange WHERE shopid=$shopid");
           if (!($idchan)){$flag=0;}else{$flag=2;}
       }
         if ($flag==2){
             $msg=2;
//             有传值
         }
         if ($flag==1){
             $msg=1;
//             没有错误，但是没有传值，值为空
         }
         if ($flag==0){
             $mag=0;
//             错误
         }
         echo json_encode($msg);


  }