$(document).ready(function(){
    //修改用户信息
    $("#userinf").click(function(){
        var uid = $("#user-id").val()
        var uname = $("#user-name").val()
        var upwd = $("#user-pwd").val()
        var umail = $("#uset-mail").val()
    $("#usubmit").click(function(){
        $ajax({
            url:"userchange.php",
            type:"post",
            dataType:"json",
            async:'true',
            data:{
                userid:uid,
                newUsername:uname,
                passwordchange:upwd,
                //没有写密码二次确认....
                emailchange:umail
            },
            success:function(data){
                if(data==1){
                    alert("修改成功！")
                    location.href="infchange.html"
                }
                if(data==0){
                    alert("修改失败，请核对信息！")
                }
            },
            error:function(){
                alert("连接失败，请重试！")
            }
        })
    })

    })

    //修改店铺信息
    $("#shopinfchange").click(function(){
        var shopID =$("#shop-id").val()
        var NSname = $("#shop-name").val()
        var NSdes = $("#shop-des").val()
        $("#shopsub").click(function(){
            $ajax({
                url:"shopchange.php",
                type:"post",
                dataType:"json",
                async:'true',
                data:{
                    Shopid:shopID,
                    Shopnamechange:NSname,
                    Shopdeschange:NSdes,
                },
                success:function(data){
                   if(data==1){
                    alert("商店修改成功！")
                    location.href="infchange.html"
                   }
                   if(data==0){

                       alert("hjfkajlsdhfaljk");
                   }
                },
                error:function(){
                    alert("连接失败，请重试！")
                }
            })
        })
    })

    //修改商品信息
    $(document).ready(function(){
        $("#babyinf").click(function(){
            var bdes=$("#baby-des").val()
            var gid=$("#good-id").val()
            var bpri=$("#baby-pri").val()
            var bnum=$("#baby-num").val()
            var bname=$("#baby-name").val()

            $("goodsub").click(function(){
                $ajax({
                    url:"babychange.php",
                    type:"post",
                    dataType:"json",
                    async:'true',
                    data:{
                        babyid:gid,
                        babyNewname:bname,
                        babyNewprice:bpri,
                        babyNum:bnum,
                        //少一个商品简介的更改！！！！！！！后端没写
                    },
                    success:function(data){
                        if(data==1){
                            alert("修改成功！")
                            location.href="infchange.html"
                        }
                        if(data==0){
                            alert("修改失败，请检查信息！")
                        }
                    },
                    error:function(){
                        alert("请求错误，请稍后重试！")
                    }
                })
            })
        })
    })
    
})