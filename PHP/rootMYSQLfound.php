<?php
heaer('Content-type:text/html;charset=utf-8');
include "databases.php";
include "encode-function.php";
$usercon=getconnection();
  $userre=mysqli_query($usercon,"SELECT * FROM userinf");
  $use=array();
   for ($a=0;$sqluser=mysqli_fetch_array($userre);$a++){
          $inputid=$sqluser['inputid'];
          $username=$sqluser['username'];
          $userphone=base64_decode(urldecode($sqluser['userphone']));
          $usermanorwo=$sqluser['usermanorwoman'];
          $email=base64_decode(urldecode($sqluser['useremail']));
          $json=array(
              'inputid'=>$inputid,
              'username'=>$username,
              'userphone'=>$userphone,
              'usermanorwoman'=>$usermanorwo,
              'useremail'=>$email
          );
              $use[$a]=$json;
   }
   echo JSONout(JSONin($use));
//   这个类型也是json传值，解决了中文乱码的问题