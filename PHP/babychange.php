<?php
session_start();
header('Content-type:text/html;charset=utf-8');
include "databases.php";
include "encode-function.php";
$babycon=getconnection();
mysqli_select_db($babycon,'peopinto');

//这个直接覆盖就可以，不用管别的
if($_SERVER['REQUEST_METHOD']=='POST'){
    $babyid=$_POST['babyid'];
    $babyNewname=$_POST['babyNewname'];
    $babyNewprice=onepersoncode($_POST['babyNewprice']);
    $babyNum=onepersoncode($_POST['babyNum']);
    $babyDes=$_POST['babyDes'];
    $flag=1;
    if ($babyNewname){
        $idchan=mysqli_query($babycon,"UPDATE babyinf SET babyname=$babyNewname WHERE babyid=$babyid");
        if (!($idchan)){$flag=0;}else{$flag=2;}
    }
    if ($babyNewprice){
        $pricechan=mysqli_query($babycon,"UPDATE babyinf SET babyprice=$babyNewprice WHERE babyid=$babyid");
        if (!($pricechan)){$flag=0;}else{$flag=2;}
    }
    if ($babyNum){
        $numchan=mysqli_query($babycon,"UPDATE babyinf SET babynum=$babyNum WHERE babyid=$babyid");
        if (!($numchan)){$flag=0;}else{$flag=2;}
    }
    if ($babyDes){
        $deschan=mysqli_query($babycon,"UPDATE babyinf SET babydes=$babyDes WHERE babyid=$babyid");
        if (!($deschan)){$flag=0;}else{$flag=2;}
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















//    $babygo=mysqli_query($babycon,"SELECT babynum,babyprice FROM babyinf WHERE babyname=$babyid");
//    $babyresu=mysqli_fetch_object($babygo);
//    if((!(($babyresu->babynum)==$babyNum))||(!(($babyresu->babyprice)==($babyNewprice)))){
//        $babyUpadate=mysqli_query($babycon,"UPDATE babyinf SET babyname=$babyNewname,babynum=$babyNum WHERE babyid=$babyid ");
//    if ($babyUpadate){$msg=1;echo json_encode($msg);}


}