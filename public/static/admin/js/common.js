//检查参数是否是非负整数
function isPositiveNum(num)
{
    var reg = /^\d+$/;
    if(reg.test(num))
    {
        return true;
    }
    else
    {
        return false;
    }
}

function toggleInput(obj, id, name, table,type){
    if(type==''){
        type=0;
    }
    var text = $(obj).text();
    $(obj).html("<input class='form-control'>");
    input = $(obj).find('input');
    input.focus().val(text);
    input.click(function(event){
        event.stopPropagation();
    });
    input.blur(function(){
        var val = input.val();
        if(val == '' || val == text){
            $(obj).html(text);
        }else{
            check_type = $(obj).attr('data-check');
            if(typeof(check_type) != 'undefined' && check_type == 'number' && !isPositiveNum(val)){
                $(obj).html(text);
                return false;
            }
            $.post('/cfwl_system.php/operate/update_text',{id:id,name:name,table:table,val:val}, function(res){
                if(res.code == 1){
                    $(obj).html(val);
                    if(type==1){
                        location.reload();
                    }

                }else{
                    $(obj).html(text);
                }
            });
        }
    })
};

$('body').delegate('.lcs_switch', 'lcs-statuschange', function() {
    var name = $(this).attr('name');
    var id = $(this).attr('data-id');
    var table = $(this).attr('data-table');
    $.post('/cfwl_system.php/operate/status_switch', {name:name, id:id, table:table}, function(data){
        if(data.code == 1){
            layer.msg(data.msg,{icon:2,time:1000,shade: 0.1});
        }else{
            layer.msg(data.msg,{icon:1,time:1000,shade: 0.1});
        }
        return false;
    });
});

$(function(){
    $("[data-toggle='tooltip']").tooltip();
});