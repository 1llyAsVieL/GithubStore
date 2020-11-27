<?php
header('Content-type:text/html;charset=utf-8');
include "databases.php";
include "encode-function.php";
//引入加密包
session_start();
$shopids=$_SESSION['shopid'];
$babycon=getconnection();
mysqli_select_db($babycon,'peopinto');
 if ($_SERVER['REQUEST_METHOD']=='POST'){
     $findName=$_POST['babyname'];
     $reapetFind=mysqli_query($babycon,"SELECT babyname FROM babyinf WHERE babyname=$findName");
     if(!($reapetFind)) {
         $babyname = $_POST['babyname'];
         $yes=1;
     }else{
         $yes=0;
     }
     $shopid=$_POST['shopid'];
     $babyprice=onepersoncode($_POST['babyprice']);
     $babynum=onepersoncode($_POST['babynum']);
     $babydes=$_POST['babydes'];
     $babycona="INSERT INTO babyinf (shopid,babyname,babyprice,babynum,babydes) VALUES 
   ('.$shopid.','.$babyname.','.$babyprice.','.$babynum.','.$babydes.') ";
     $babygo=mysqli_query($babycon,$babycona);
     if ($babygo&&($yes==1)){
         $msg=1;
         echo json_encode($msg);
     }
 }else{
     $msg=0;
     echo json_encode($msg);
 }







?>