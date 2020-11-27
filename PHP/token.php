<?php

  include "encode-function.php";

//   当函数名字为灰色的时候，是因为从来没有被引用过
    function token($array,$textincode){
        if(preg_match('/^[0-9A-Za-z]/',$textincode)){
            if (preg_match('/^[0-9]/',$textincode)){
                $textincode=$textincode+1;
            }else{
                return $array.onepersoncode($textincode);
            }
        }
    }






?>