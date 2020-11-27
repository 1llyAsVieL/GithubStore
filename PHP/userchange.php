<?php
session_start();
heaer('Content-type:text/html;charset=utf-8');
include "databases.php";
include "encode-function.php";
$userchange=getconnection();
mysqli_select_db($userchange,'peopinto');
if ($_SERVER['REQUEST_METHOD']=='POST'){
//    我们规定，用户只可以改变邮箱，昵称,密码，手机号、性别一经过注册不可再改
    $oldname=$_SESSION['username'];
    $newname=$_POST['newUsername'];
    if (!empty($_POST['newUsername'])){
        $namechange="UPDATE userinf SET username=$newname WHERE username=$oldname";
        $ruc=mysqli_query($userchange,$namechange);
        if ($ruc){$flag=1;}
    }
//    密码比较麻烦因为涉及到加密解密
    if (!empty($_POST['passwordchange'])){
        $passwordfound="SELECT userpassword FROM userinf WHERE username=$oldname";$passresu=mysqli_query($userchange,$passwordfound);$oldpass=mysqli_fetch_object($passresu);
        $newpassword=urlencode(base64_encode($_POST['passwordchange']));
        if (!($newpassword==($oldpass->userpassword))){
            $passup="UPDATE userinf SET userpassword=$newpassword WHERE usernam=$oldname";$passupg=mysqli_query($userchange,$passup);
            if ($passupg){
                    $flag=1;
            }else{
                $passmsg="输入失误";
                echo json_encode($passmsg);
            }
        }else{
            $passmsg="两次输入相等";
            echo  json_encode($passmsg);
        }
    }
    if (!empty($_POST['emailchange'])){
           $emailsql="SELECT userrmail FROM userinf WHERE username=$oldname";$emailgo=mysqli_query($userchange,$emailsql);$emailresu=mysqli_fetch_object($emailgo);
           if ($_POST['emailchange']!=($emailresu->useremail)){
               $emailchange=$_POST['emailchange'];
               $emailup=mysqli_query($userchange,"UPDATE userinf SET useremail=$emailchange WHERE username=$oldname");
           if($emailup){$mailmag="信息传输成功";echo json_encode($mailmag);}else{$mailmag="传输失败";echo json_encode($mailmag);}
           }
//       用户邮件的转换反正就是转换就对了
    }
}else{
    $msg=0;
    echo json_encode($msg);
}