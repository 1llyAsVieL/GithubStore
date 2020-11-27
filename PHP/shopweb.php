<?php
header('Content-type:text/html;charset=utf-8');
include "databases.php";
include "encode-function.php";

  if ($_COOKIE['username']) {
      $con = getconnection();
      $username=$_COOKIE['username'];
//     做一个循环
      $result = mysqli_query($con, "SELECT * FROM babyinf ");
          $use=array();
          for($a=1;$sql=mysqli_fetch_array($result);$a++) {
              $babyid = $sql['babyid'];
              $shopid = $sql['shopid'];
              $babyprice = onepersondecode($sql['babyprice']);
              $babynum = onepersondecode($sql['babynum']);
              $babyname = $sql['babyname'];
              $babydes = $sql['babydes'];
              $json = array(
                  'babyid' => $babyid,
                  'shopid' => $shopid,
                  'babyprice' => $babyprice,
                  'babynum' => $babynum,
                  'babyname' => $babyname,
                  'babydes' => $babydes
              );
              $use[$a]=$json;
          }
          echo JSONout(JSONin($use));
//          文件数组的文件解密之后转成array数组，然后封装成json
      }else{
      $msg=0;
  }


?>