<?php
//这是通过ajax对重复账号进行的异步验证；
heaer('Content-type:text/html;charset=utf-8');
include "databases.php";
$renorecon=getconnection();
mysqli_select_db($renorecon,'userinf');
$usernamenore=$_POST['username'];
 $passFirst=$_POST['userPassword'];
 $nore1="SELECT username FROM userinf WHERE username=$usernamenore";
$sqlnore1=mysqli_query($renorecon,$nore1);
  if($sqlnore1){
      echo json_encode(1);
  }
  else{
      echo json_encode(0);
  }





?>
