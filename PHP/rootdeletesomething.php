<?php
header('Content-type:text/html;charset=utf-8');
include "databases.php";
include "encode-function.php";
$delecon=getconnection();
mysqli_select_db($delecon,'peopinto');
if ($_SERVER['REQUEST_METHOD']=='POST'){
    $flag=0;
    if ($_POST['delestyle']=='user'){
      $userid=$_POST['userid'];
      $deleUser="DELETE FROM userinf WHERE userid=$userid";
      $usergo=mysqli_query($delecon,$deleUser);
      if ($usergo){$flag=1;}
    }
    if ($_POST['delestyle']=='stop'){
      $stopid=$_POST['userid'];
      $delestop="DELETE FROM stopinf WHERE shopid=$userid";
        $usergo=mysqli_query($delecon,$delestop);
       if ($usergo){$flag=1;}
    }
    if ($_POST['delestyle']=='baby'){
        $babyid=$_POST['userid'];
        $delebaby="DELETE FROM babyinf WHERE babyinf=$userid";
        $usergo=mysqli_query($delecon,$delebaby);
        if($usergo){$flag=1;}
    }
    if ($flag==1){
        $f=1;
        echo json_encode($f);
    }else{
        $f=0;
        echo json_encode($f);
    }
}







?>