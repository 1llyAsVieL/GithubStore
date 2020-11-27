<?php
include "databases.php";
include "encode-function.php";
heaer('Content-type:text/html;charset=utf-8');
$babyinfcheck=getconnection();
if ($_SERVER['REQUEST_METHOD']=='POST'){
    $babyid=$_POST['babyid'];
    $result=mysqli_query($babyinfcheck,"SELECT * FROM babyinf WHERE babyid=$babyid");
    if ($result){
        $sql=mysqli_fetch_array($result);
       $babyid=$sql['babyid'];
       $shopid=$sql['shopid'];
       $babyprice=onepersondecode($sql['babyprice']);
       $babynum=onepersondecode($sql['babynum']);
       $babyname=$sql['babyname'];
       $babydes=$sql['babydes'];
       $json=array(
           'babyid'=>$babyid,
           'shopid'=>$shopid,
           'babyprice'=>$babyprice,
           'babynum'=>$babynum,
           'babyname'=>$babyname,
           'babydes'=>$babydes
       );
//       这个是单次查询，就是一个物品的查询
       echo JSONout(JSONin($json));
    }
}


?>
