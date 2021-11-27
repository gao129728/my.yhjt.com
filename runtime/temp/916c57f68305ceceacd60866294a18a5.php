<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:77:"E:\php_project\my.yhjt.com\public/../application/admin/view/orders/index.html";i:1637025986;s:78:"E:\php_project\my.yhjt.com\public/../application/admin/view/public/header.html";i:1544408304;s:78:"E:\php_project\my.yhjt.com\public/../application/admin/view/public/footer.html";i:1527911724;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>后台管理中心</title>
    <link href="/static/admin/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="/static/admin/css/font-awesome.min.css?v=4.7.0" rel="stylesheet">
    <link href="/static/admin/css/animate.min.css" rel="stylesheet">
    <link href="/static/admin/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="/static/admin/css/plugins/chosen/chosen.css" rel="stylesheet">
    <link href="/static/admin/css/plugins/switchery/switchery.css" rel="stylesheet">
    <link href="/static/admin/js/plugins/layui/css/layui.css" rel="stylesheet">
    <link href="/static/admin/css/style.min.css?v=4.1.0" rel="stylesheet">
    <link href="/static/admin/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
    <link href="/static/admin/css/lc_switch.css" rel="stylesheet">
    <link href="/static/admin/css/common.css" rel="stylesheet">
    <!--<link rel="stylesheet" type="text/css" href="/static/admin/js/plugins/jquery-ui/jquery-ui.css" />-->
    <style type="text/css">
    .long-tr th{
        text-align: center
    }
    .long-td td{
        text-align: center
    }

    .btn-blue{background: #00B7EE; color:#fff;}
    .btn-blue:hover,.btn-blue:focus{color:#fff;}
    .btn-blue.btn-outline{border-color: #00B7EE;color: #00B7EE; background-color: transparent;}
    .btn-blue.btn-outline:hover{color:#fff; background-color: #00B7EE;}
    .note-content{position: relative;}
    .note-content .note-title{width: 16.7%;padding:0 15px; line-height: 24px; text-align: right; position: absolute; left:0; top: 50%; margin-top:-12px;}
    .note-content .note-box{margin-left:16.7%; position: relative;}
    .note-content .note-ico{color:#f60; position:absolute; left:0; top: 50%; margin-top:-17px;}
    .note-content .note-text{padding-left:55px; line-height: 26px; color:#888;}

    .markModel{display:none; }
    .wm-example{border:1px dashed #ccc; width: 202px; position: relative;}
    .wm-example #wm-text{position:absolute;}
    .wm-example #wm-image{position:absolute;}
    .wm-example .wm-place-1{left:4px;top:1px;}
    .wm-example .wm-place-2{right:4px;top:1px;}
    .wm-example .wm-place-3{top:50%; left:50%; transform: translate(-50%,-50%);}
    .wm-example .wm-place-4{left:4px;bottom:1px;}
    .wm-example .wm-place-5{right:4px;bottom:1px;}
    .wm-example #wm-image.wm-place-1, .wm-example #wm-image.wm-place-2{top:4px;}
    .wm-example #wm-image.wm-place-4, .wm-example #wm-image.wm-place-5{bottom:4px;}
    .onlineModel{display:none;}

    .iColor-Picker{position:relative; float:left; padding-right:40px;}
    .iColor-Picker input{float:left;}
    .tooltip{min-width:200px;}
    .row-dashed-title{ line-height: 42px; color:#333; font-size: 14px; text-align: center; background: #fbfbfb; margin-bottom:10px;}
    .tp-unit{position: absolute; line-height: 30px; top:2px; right:-6px;}
    </style>
</head>
<body class="gray-bg">
<style type="text/css">
    .input-span{float:left; line-height: 34px;}
</style>
<div class="wrapper wrapper-content animated fadeInRight">
    <!-- Panel Other -->
    <div class="row">
        <div class="col-sm-3 ui-sortable">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-info pull-right">月</span>
                    <h5>订单</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins"><?php echo $nopay; ?></h1>
                    <small><a href="javascript:;" class="opFrames" data-name="订单管理" >未支付</a> </small>
                </div>
            </div>
        </div>
        <div class="col-sm-3 ui-sortable">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-info pull-right">月</span>
                    <h5>订单</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins"><?php echo $orderpay; ?></h1>
                    <small><a href="javascript:;" class="opFrames" data-name="订单管理" >已下单</a> </small>
                </div>
            </div>
        </div>
        <div class="col-sm-3 ui-sortable">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-info pull-right">月</span>
                    <h5>已支付</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">$<?php echo $moneyday; ?></h1>
                    <small><a href="javascript:;" class="opFrames" data-name="订单管理" >已支付</a> </small>
                </div>
            </div>
        </div>
        <div class="col-sm-3 ui-sortable">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-info pull-right">总</span>
                    <h5>总收入</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">$<?php echo $moneysum; ?></h1>
                    <small><a href="javascript:;" class="opFrames" data-name="订单管理" >总收入</a> </small>
                </div>
            </div>
        </div>
    </div>
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>订单列表</h5>
        </div>
        <div class="ibox-content">
            <!--搜索框开始-->
            <div class="row">
                <div class="col-sm-12">
                    <form name="admin_list_sea" class="form-search" method="get" action="<?php echo url('index'); ?>">
                        <div class="col-sm-12" style="margin-bottom: 20px">
                            <div class="col-sm-4">
                                <span class="col-sm-4">
                                    <select class="form-control" id="type" name="type" >
                                        <option <?php if($type == 1): ?>selected<?php endif; ?> value="1">订单号</option>
                                        <option <?php if($type == 3): ?>selected<?php endif; ?> value="3">金额</option>
                                    </select>
                                </span>
                                <span class="col-sm-8">
                                   <input type="text" id="val" class="form-control" name="val" value="<?php echo $val; ?>" />
                                </span>
                            </div>
                            <div class="col-sm-2">
                                <select class="form-control" name="status"  id="status">
                                    <option <?php if($param['status'] == 0): ?>selected<?php endif; ?> value="0">订单状态</option>
                                    <option <?php if($param['status'] == 1): ?>selected<?php endif; ?> value="1">未支付</option>
                                    <option <?php if($param['status'] == 2): ?>selected<?php endif; ?> value="2">已下单</option>
                                </select>
                            </div>

                        </div>
                        <div class="col-sm-12" style="margin-bottom: 20px">
                            <div class="col-sm-6">
                                <span class="col-sm-3">
                                    <select class="form-control" id="times" name="times" >
                                        <option <?php if($times == 1): ?>selected<?php endif; ?> value="1">下单时间</option>
<!--                                        <option <?php if($times == 2): ?>selected<?php endif; ?> value="2">付款时间</option>-->
                                    </select>
                                </span>
                                <div class="col-sm-9">
                                    <span class="col-sm-5"><input class="test-item form-control" name="mintime" id="mintime" placeholder="最小值" class="form-control" value="<?php echo $mintime; ?>" readonly="readonly" style="background:url(__IMG__/WdatePicker.jpg) no-repeat 97% center"/></span>
                                    <span style="float:left; line-height: 34px;">—</span>
                                    <span class="col-sm-5"><input class="test-item form-control" name="maxtime" id="maxtime" placeholder="最大值" class="form-control" value="<?php echo $maxtime; ?>" readonly="readonly" style="background:url(__IMG__/WdatePicker.jpg) no-repeat 97% center"/></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12" style="margin-bottom: 20px">
                            <span class="col-sm-4">
                                <span class="col-sm-4">
                                    <span class="input-group-btn ">
                                        <button type="submit" class="btn btn-primary" style="border-radius:3px;"><i class="fa fa-search"></i> 搜索</button>
                                    </span>
                                </span>
                                <span class="col-sm-4">
                                    <span class="input-group-btn ">
                                        <button type="button" class="btn btn-primary" style="border-radius:3px;" onclick="imports()">导出</button>
                                    </span>
                                </span>
                            </span>

                        </div>
                    </form>
                </div>
            </div>
            <!--搜索框结束-->
            <div class="hr-line-dashed"></div>
            <div class="example-wrap">
                <div class="example">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr class="long-tr">
                                <th width="4%">&nbsp;</th>
                                <th width="4%">订单号</th>
                                <th width="12%">商品信息</th>
                                <th width="9%">交易总额</th>
                                <th width="9%">买家</th>
                                <th width="12%">下单时间</th>
                                <th width="7%">状态</th>
                                <th width="10%">操作</th>
                            </tr>
                        </thead>
                        <script id="list-template" type="text/html">
                            {{# for(var i=0;i<d.length;i++){  }}
                                <tr class="long-td">
                                    <td><input class="ids i-checks" type="checkbox" name="ids[]" data-page="{{d[i].page}}" value="{{d[i].id}}"></td>
                                    <td class="edit-td">{{d[i].order_num}}</td>
                                    <td>
                                        {{# for(var k=0;k<d[i].pinfo.length;k++){ }}
                                        <p>{{d[i].pinfo[k].title}}</p>
                                        {{# } }}
                                    </td>
                                    <td>${{d[i].total}}</td>
                                    <td>{{d[i].uemail}}</td>
                                    <td>{{d[i].create_time}}</td>
                                    <td>
                                        {{# if(d[i].status==0){ }}
                                        未支付
                                        {{# }else if(d[i].status==1){ }}
                                        已下单
                                        {{# }else if(d[i].status==3){ }}
                                        已完成
                                        {{# }else{ }}
                                        其它
                                        {{# } }}
                                    </td>
                                    <td>
                                        <a href="javascript:;" onclick="view_message({{d[i].id}},{{d[i].page}})" class="btn btn-primary btn-xs btn-outline">
                                            <i class="fa fa-eye"></i> 查看</a>&nbsp;&nbsp;
                                        <a href="javascript:;" onclick="del_message({{d[i].id}},{{d[i].page}})" class="btn btn-danger btn-xs btn-outline">
                                            <i class="fa fa-trash-o"></i> 删除</a>
                                    </td>
                                </tr>
                            {{# } }}
                            <tr>
                               <td colspan="9" class="handle-tr">
                                   <a href="javascript:;" onclick="all_select()" class="btn btn-primary btn-sm">全选</a>
                                   <a href="javascript:;" onclick="inverse_select()" class="btn btn-primary btn-sm">反选</a>
                                   <a href="javascript:;" onclick="cancel_select()" class="btn btn-primary btn-sm">取消</a>
                                   <a href="javascript:;" onclick="batch_delete()" class="btn btn-danger btn-sm">
                                       <i class="fa fa-trash-o"></i> 批量删除</a>
                               </td>
                            </tr>
                        </script>
                        <tbody id="list-content"></tbody>
                    </table>
                    <div id="AjaxPage" style="text-align:right;"></div>
                    <div style="text-align: right;">
                        共<?php echo $count; ?>条数据，<span id="allpage"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 加载动画 -->
<div class="spiner-example">
    <div class="sk-spinner sk-spinner-three-bounce">
        <div class="sk-bounce1"></div>
        <div class="sk-bounce2"></div>
        <div class="sk-bounce3"></div>
    </div>
</div>

<script src="__JS__/jquery.min.js?v=2.1.4"></script>
<script src="__JS__/bootstrap.min.js?v=3.3.6"></script>
<script src="__JS__/content.min.js?v=1.0.0"></script>
<script src="__JS__/plugins/chosen/chosen.jquery.js"></script>
<script src="__JS__/plugins/iCheck/icheck.min.js"></script>
<script src="__JS__/plugins/layer/laydate/laydate.js"></script>
<script src="__JS__/plugins/switchery/switchery.js"></script><!--IOS开关样式-->
<script src="__JS__/jquery.form.js"></script>
<script src="__JS__/layer/layer.js"></script>
<script src="__JS__/laypage/laypage.js"></script>
<script src="__JS__/laytpl/laytpl.js"></script>
<script src="__JS__/plugins/layui/layui.js"></script>
<script src="__JS__/lc_switch.js"></script>
<script src="__JS__/previewImage.js"></script>
<script src="__JS__/common.js"></script>
<script>
    $(document).ready(function(){$(".i-checks").iCheck({checkboxClass:"icheckbox_square-green",radioClass:"iradio_square-green",})});
    $('.lcs_check').lc_switch();
</script>

<script type="text/javascript">
    $(".chosen-select").chosen({
        width: "100%", //宽度
        search_contains:true//模糊搜索开启
    });
    layui.use('laydate', function(){
        var laydate = layui.laydate;
        lay('.test-item').each(function(){
            laydate.render({
                elem: this
                ,format:'yyyy-MM-dd'
                ,type:'datetime'
                ,trigger: 'click'
            });
        });
    });


    //全选
    function all_select(){
        $('input[name="ids[]"]').iCheck('check');
    }

    //反选
    function inverse_select(){
        $('input[name="ids[]"]').iCheck('toggle');
    }

    //取消
    function cancel_select(){
        $('input[name="ids[]"]').iCheck('uncheck');
    }

    function imports(){
        var type = $('#type').val();
        var val = $('#val').val();
        var times = $('#times').val();
        var mintime = $('#mintime').val();
        var maxtime = $('#maxtime').val();
        var status = $('#status').val();

        location.href='<?php echo url("imports"); ?>?type='+type+'&val='+val+'&times='+times+'&mintime='+mintime+'&maxtime='+maxtime+'&status='+status;
        
    }



    //批量删除
    function batch_delete(){
        var ids = '';
        var page = '';
        var flag=false;
        $('input[name="ids[]"]').each(function(){
            if($(this).is(':checked')){
                ids += ',' + $(this).val();
                page = $(this).attr('data-page');
                flag=true;
            }
        });
        if(!flag){
            layer.msg('请选择需要操作的记录', {icon: 5, time: 1500, shade: 0.1}, function (index) {
                layer.close(index);
            });
            return false;
        }
        layer.confirm('确认删除所选记录吗?', {icon: 3, title:'提示'}, function(index){
            ids = ids.substring(1);
            $.getJSON('<?php echo url("all_del_message"); ?>', {'ids' : ids}, function(res){
                if(res.code == 1){
                    layer.msg(res.msg,{icon:1,time:1500,shade: 0.1},function(){
                        refresh_page(page);
                    });
                }else{
                    layer.msg(res.msg,{icon:0,time:1500,shade: 0.1});
                }
            });
            layer.close(index);
        })
    }
    /**
     * [Ajaxpage laypage分页]
     * @param {[type]} curr [当前页]
     */

    Ajaxpage(<?php echo $cur_page; ?>);

    function Ajaxpage(curr){
        var type = $('#type').val();
        var val = $('#val').val();
        var times = $('#times').val();
        var mintime = $('#mintime').val();
        var maxtime = $('#maxtime').val();
        var status = $('#status').val();
        $.getJSON('<?php echo url("index"); ?>', {
            page: curr || 1,type:type,val:val,times:times,mintime:mintime,maxtime:maxtime,status:status
        }, function(data){      //data是后台返回过来的JSON数据
			$(".spiner-example").css('display','none'); //数据加载完关闭动画
            if(data==''){
                $("#list-content").html('<td colspan="20" style="padding-top:10px;padding-bottom:10px;font-size:14px;text-align:center">暂无数据</td>');
            }else{
                var tpl = document.getElementById('list-template').innerHTML;
                laytpl(tpl).render(data, function(html){
                    document.getElementById('list-content').innerHTML = html;
                });
                $('#list-content').find("input[name='ids[]']").iCheck({checkboxClass:"icheckbox_square-green"});
                $('.lcs_check').lc_switch();
                laypage({
                    cont: $('#AjaxPage'),//容器。值支持id名、原生dom对象，jquery对象,
                    pages:'<?php echo $allpage; ?>',//总页数
                    skip: true,//是否开启跳页
                    skin: '#1AB5B7',//分页组件颜色
                    curr: curr || 1,
                    groups: 10,//连续显示分页数
                    jump: function(obj, first){
                        if(!first){
                            Ajaxpage(obj.curr)
                        }
                        $('#allpage').html('第'+ obj.curr +'页，共'+ obj.pages +'页');
                    }
                });
            }
        });
    }
//查看
function view_message(id, page){
    var name=$('#name').val();
    var phone = $('#phone').val();
    location.href = '<?php echo url("view_message"); ?>?id='+id+'&name='+name+'&phone='+phone+'&cur_page='+page;
}

//删除
function del_message(id, page){
    layer.confirm('确认删除此订单?', {icon: 3, title:'提示'}, function(index){
        $.getJSON('<?php echo url("del_orders"); ?>', {'id':id}, function(res){
            if(res.code == 1){
                layer.msg(res.msg,{icon:1,time:1500,shade: 0.1},function(){
                    refresh_page(page);
                });
            }else{
                layer.msg(res.msg,{icon:0,time:1500,shade: 0.1});
            }
        });
        layer.close(index);
    })
}

//刷新当前页
function refresh_page(page){
    var name=$('#name').val();
    var phone = $('#phone').val();
    location.href = '<?php echo url("index"); ?>?name='+name+'&phone='+phone+'&cur_page='+page;
}

</script>
</body>
</html>