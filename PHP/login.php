<?php
heaer('Content-type:text/html;charset=utf-8');
include "databases.php";
if ($_COOKIE['username']){
    $msg=1;
    echo json_encode($msg);
}
else {
    $logincon = getconnection();
    $msg = 0;
    $_SESSION['username'] = null;
    $_SESSION['userpassword'] = null;
    mysqli_select_db($logincon, 'peopinto');
//这里首先判断是不是管理员账号，如果是session多存一个验证，作为二级令牌跳转
//MD5加密管理员二级密码
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['peoNum'];
//    查验管理员列表里是否有匹配的账号
        $loginsql = "SELECT root FROM rootint WHERE root=$username";
        $loginto = mysqli_query($logincon, $loginsql);
//    这里就是先查看输入的是不是管理员账号，如果是管理员账号就直接去管理员二级页面。
        if ($loginto) {
//        这里就是判断管理员是不是真正管理员（即为了排除用户和管理员重名的情况）
            $rootchar = "SELECT password FROM rootint WHERE root=$username ";
            $rootgo = mysqli_query($logincon, $rootchar);
            $rootresult = mysqli_fetch_object($rootgo);
            if (($rootresult->password) == md5(sha1(md5(onepersondecode($_POST['Peopass']))))) {
                //        给二级页面传输数值
//     后期进行一个token验证，然后把数据库的数据表里的文件操作！
                $_SESSION['rootname'] = $_POST['peoNum'];
                setcookie("rootname", $username, time() + 3600);
                $msg = 2;
            }
        }
        if (empty($_POST['peoNum']) && empty($_POST['Peopass'])) {
            $userfind = "SELECT userpassword FROM userinf WHERE username=$username";
            $usergo = mysqli_query($logincon, $userfind);
            $userNet = mysqli_fetch_object($logincon, $usergo);
            $userpass = $userNet->userpassword;
//            把密码抽调出来赋值
            if ($_POST['Peopass'] == $userpass) {
                $_SESSION['username'] = $_POST['peoNum'];
                $_SESSION['userpassword'] = $_POST['Peopass'];
                sleep(3);
                setcookie("username", "$username", time() + 3600);
//                把cookie送到用户的服务器里
                $msg = 1;
            }

        }
        echo json_encode($msg);


    }

}
?>