<?php
session_start();
heaer('Content-type:text/html;charset=utf-8');
include "databases.php";
include "encode-function.php";
$recon=getconnection();
mysqli_select_db($recon,'userinf');
//我们假设前端的限制条件已经可以满足需求，那么就可以直接进行传值
if ($_SERVER['REMOTE_HOST']=='POST'){
    if ($_POST['userPassword']==$_POST['userPasswordTrue']){
        $namereapet=$_POST['username'];
        $reapetgo=mysqli_query($recon,"SELECT username FROM userinf WHERE username=$namereapet");
        if(!($reapetgo)) {
            $username = $_POST['username'];
        }else{
            $msg="存在相同的姓名";
            echo json_encode($msg);
        }
        $userPassword=urlencode(base64_encode($_POST['userPassword']));
//        这里要单写一个验证不能重名的php脚本
        $userphone=urlencode(base64_encode($_POST['userphone']));
        $userfamle=$_POST['famle'];
        $useremail=urlencode(base64_encode($_POST['userEmail']));
//        这里利用base64进行简单加密，然后解密也要对象base64
        if($_POST['famle']=="woman"){
            $femal='01';
        }else if ($_POST['famle']=='man'){
            $femal='02';
        }
        if ($_POST['userstyle']=='customer'){
              $style='001';
        }else if ($_POST['userstyle']=='shop'){
                $style='100';
        }
        $phone=substr($_POST['userphone'],0,3);
        $server=rand(100,999);
          $userid=$femal.$style.$phone.$server;
        $registersql="INSERT INTO userinf (inputid,username,userpassword,userphone,userfamle,useremail,userphone) VALUES 
     ('.$userid.','.$username.','.$userPassword.','.$userphone.','.$userfamle.','.$useremail.','.$userphone.')";
        $result=mysqli_query($recon,$registersql);
        if (!$result){
             echo json_encode("数据传输失败");
        }else{
//            这里如果执行成功那么就需要写一个token返回给前端储存，可以利用jwt方法。
            $msg=1;
            echo json_encode($msg);
//            因为返回格式全都是json所以数组也用json来写
        }
    }else{
        $msg=0;
        echo json_encode($msg);
    }
}else{
    $msg=0;
    echo json_encode($msg);
}


?>