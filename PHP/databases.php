<?php
session_start();
$coon=null;
function getconnection(){

    $username="49.232.161.11:3306";
    $userserver="root";
    $password="tju_ok";
    $coon=mysqli_connect($username,$userserver,$password)or die("错误原因是:".mysqli_error());
    mysqli_query($coon,"set names 'utf8");
    return $coon;
}
?>