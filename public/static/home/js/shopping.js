
//添加购物车
function add_to_cart(id){
    if(isNaN(id)){
        layer.msg("参数错误", {icon: 5,time:2000,shade: 0.5}, function(index){
            layer.close(index);
        
        });
        return false;
    }
    var num =$('#number').val();
    $.ajax({
        type: "POST",
        url:"/home/member/addshopping",
        data:"method=add&id=" + id+'&num='+num,
        dataType:"json",
        success:function(result){
            if(result && result.code==1){
                layer.msg(result.msg, {icon: 6,time:1000,shade: 0.5}, function(index){
                    layer.close(index);
                });
                // window.location = "/home/member/shopping";
            } else {
                layer.msg(result.msg, {icon: 5,time:2000,shade: 0.5}, function(index){
                    layer.close(index);
                    window.location = "/home/member/login";
                });
            }
        }
    });
}


//立即购买
function buy_now(id){
    if(isNaN(id)){
        layer.msg("参数错误", {icon: 5,time:2000,shade: 0.5}, function(index){
            layer.close(index);
        });
        return false;
    }
    var num =$('#number').val();
    $.ajax({
        type: "POST",
        url:"/home/member/addshopping",
        data:"method=add&id=" + id+'&num='+num,
        dataType:"json",
        success:function(result){
            if(result && result.code==1){
                window.location = "/home/member/shopping";
            } else {
                layer.msg(result.msg, {icon: 5,time:2000,shade: 0.5}, function(index){
                    layer.close(index);
                     window.location = "/home/member/login";

                });
            }
        }
    });
}

//增减商品数量
function change_num(goods_id, method){
    if(isNaN(goods_id)){
        layer.msg("参数错误", {icon: 5,time:2000,shade: 0.5}, function(index){
            layer.close(index);
        });
        return false;
    }
    method = parseInt(method);
    this_obj = $("#number");
    p_price = $("#goods_price").text();
    if(p_price !==''){
        goods_price = $("#goods_price").text();
    }else{
        goods_price = 0;
    }
    num = this_obj.val();
    if (method ==2 && !/^[1-9]\d*$/.test(num)){
        this_obj.val(1);
        $("#goods_total_price").text('$'+toDecimal2(goods_price));
        layer.msg("No less than 1", {icon: 5,time:2000,shade: 0.5}, function(index){
            layer.close(index);
        });
        return false;
    }
    c_num =1;
    if(method == 1){
        c_num = parseInt(num)+1;
    }else if(method == 2){
        c_num = parseInt(num);
    }else{
        if(num > 1 ) c_num = parseInt(num)-1;
    }
    this_obj.val(c_num);
    totalPrice = ((parseFloat(goods_price) * 100) * c_num)/100;
    $("#goods_total_price").text('$'+toDecimal2(totalPrice));
}


//强制保留2位小数，如：2，会在2后面补上00.即2.00
function toDecimal2(x) {
    var f = parseFloat(x);
    if (isNaN(f)) return false;
    var f = Math.round(x*100)/100;
    var s = f.toString();
    var rs = s.indexOf('.');
    if (rs < 0) {
        rs = s.length;
        s += '.';
    }
    while (s.length <= rs + 2) {
        s += '0';
    }
    return s;
}

//购物车增减商品数量
function change_num_cart(id, method){
    if(isNaN(id)){
        layer.msg("参数错误", {icon: 5,time:2000,shade: 0.5}, function(index){
            layer.close(index);
        });
        return false;
    }
    method = parseInt(method);
    this_obj = $("#goods_num_"+id);
    goods_price = $("#goods_price").text();
    num = this_obj.val();
    if (method ==2 && !/^[1-9]\d*$/.test(num)){
        num = 1;
        this_obj.val(1);
        layer.msg("No less than 1", {icon: 5,time:2000,shade: 0.5}, function(index){
            layer.close(index);
        });
    }
    if(method == 1){
        handle = "add";
        c_num = parseInt(num)+1;
    }else if(method == 2){
        handle = "change";
        c_num = parseInt(num);
    }else{
        handle = "minus";
        if(num > 1 ){
            c_num = parseInt(num)-1;
        }else{
            return false;
        }
    }

    $.ajax({
        type: "POST",
        url:"/home/member/addshopping",
        data:"method=update&id=" +id+"&num="+c_num,
        dataType:"json",
        success:function(result){
            if(result.code==1){
                this_obj.val(c_num);
                //单类商品总价
                this_obj.parents('td').siblings('.subtotal').text('$'+result.s_price);
                //所有商品总数
                $("#t_num").text(result.t_num);
                //所有商品总价
                $("#t_price").text('$'+result.t_price);
            }else{
                layer.msg(result.msg, {icon: 5,time:2000,shade: 0.5}, function(index){
                    layer.close(index);
                });
            }
        }
    });
}

//删除购物车商品
function del_cart_goods(id){
    goodsId = (typeof(id) == "undefined") ? 0 : parseInt(id);
    goodsDel_msg = 	(typeof(id) == "undefined") ? "Empty the cart？" : "Delete this item？";
    layer.confirm(goodsDel_msg, {icon: 3, title:'Caution',btn : [ 'OK', 'Cancel' ]}, function(index){
        $.getJSON('/home/member/delcart', {'product_id' : goodsId}, function(res){
            if(res.code == 1){
                location.reload();
            }else{
                layer.msg(res.msg,{icon:0,time:1500,shade: 0.1});
            }
        });
        layer.close(index);
    })
}


