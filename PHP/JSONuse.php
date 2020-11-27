<?php

function JSONin($datain){
//    应该是数组形式
    $first=urlencode($datain);
    $second=json_encode($first);
    return $second;
}
function JSONout($second){
    $third=urldecode($second);
    return $third;
}
//这个是一个防止中文乱码的玩意



?>