<?php
session_start();
  include "databases.php";
  include "encode-function.php";
  $rootcheck=getconnection();
  mysqli_select_db($rootcheck,'peopinto');
  if ($_SERVER['REQUEST_METHOD']=='POST') {
      if (!empty($_POST['roottwopassword'])) {
           $rootpassword=md5(sh1(md5(onepersoncode($_POST['roottwopassword']))));
//           还原加密来计算
           $rootname=$_SESSION['rootname'];
           $rootfind="SELECT sepassword FROM rootinf WHERE root=$rootname";
           $rootgo=mysqli_query($rootcheck,$rootfind);
           $rootresult=mysqli_fetch_array($rootgo);
           if ($rootresult['sepassword']==$rootpassword){
               $msg=1;
               echo json_encode($msg);
           }
      }


  }
?>