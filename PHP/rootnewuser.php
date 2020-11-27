<?php
heaer('Content-type:text/html;charset=utf-8');
include "databases.php";
include "encode-function.php";
$rootNewuser=getconnection();
mysqli_select_db($rootNewuser,'peopinto');
$phone=$_POST['rootphone'];

if ($_SERVER['REQUEST_METHOD']=='POST'){
    $flag=1;
//    先加密写入账户
    if ((preg_match('/^[A-Za-z0-9]/',$_POST['rootnew'])&&preg_match('/^[^<>]/',$_POST['rootnew']))){
        $rootname=$_POST['rootnew'];
//        名字不能加密，因为要做基础验证
    }else{
        $flag=0;
    }
    if (preg_match('/^[0-9a-zA-Z]/',$_POST['rootpass'])){
        $rootPass=$_POST['rootpass'];
        $rootPass=onepersoncode($rootPass);
//        直接加密就可以了，我不需要知道密码明文是什么！
        $rootusr=md5(sha1(md5($rootPass)));
    }else{
        $flag=0;
    }
    if (preg_match('/^[0-9A-Za-z]/',$_POST['sepassword'])){
        if ($_POST['rootpass']!=$_POST['sepassword']){
            $sepassword=$_POST['sepassword'];
            $sepassword=onepersoncode($sepassword);
            $sepassword=md5(sha1(md5($sepassword)));
        }else{
            $flag=0;
        }
    }else{
        $flag=0;
    }
    if($flag==1){
        $rootnewusercon="INSERT INTO rootinf (root,passord,sepassword)
  VALUES ('.$rootname.','..$rootPass','.$sepassword.') ";
        $rootnewcon=mysqli_query($rootNewuser,$rootnewusercon);
        if ($rootnewcon){
            $c=1;
            echo json_encode($c);

        }
    }

}else{
    $a='表单设计出错，请重试';
    echo json_encode($a);
}








?>