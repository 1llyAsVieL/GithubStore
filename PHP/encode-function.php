<?php

 function onepersoncode($key){
      $key=urlencode(base64_encode($key));
      return $key;
}
function onepersondecode($key){
     $a=urldecode($key);
     $b=base64_decode($a);
     return $b;
}
function totruemassage($message,$num){
     $message=base64_decode(sha1(crypt($message,$num)));
//     这个加密比较低级就加了一层盐，但是也只是可以解密一层;
    return $message;
}
function mostuser($password,$maketrue){
//       要用自己的用户信息作为盐这样最好
     $recode=password_hash($password,PASSWORD_ARGON2I);
     return  crypt($recode,$maketrue);
}

  function usercode($tex){
     return md5(md5(sha1(md5($tex))));
  }








?>