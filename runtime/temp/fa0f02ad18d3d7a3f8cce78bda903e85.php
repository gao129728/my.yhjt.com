<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:77:"E:\php_project\my.yhjt.com\public/../application/admin/view/nature/index.html";i:1547620730;s:78:"E:\php_project\my.yhjt.com\public/../application/admin/view/public/header.html";i:1544408304;s:78:"E:\php_project\my.yhjt.com\public/../application/admin/view/public/footer.html";i:1527911724;}*/ ?>
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
<div class="wrapper wrapper-content animated fadeInRight">
    <!-- Panel Other -->
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>内容列表</h5>
        </div>
        <div class="ibox-content">
            <!--搜索框开始-->           
            <div class="row">
                <div class="col-sm-12">   
                <div  class="col-sm-2 ibox-tit" style="width: 100px">
                    <div class="input-group" >  
                        <a href="<?php echo url('add_nature',['nature_id'=>$nature_id]); ?>"><button class="btn btn-primary" type="button">添加内容</button></a>
                    </div>
                </div>                                            
                    <form id="admin_list_sea" class="form-search" method="get" action="<?php echo url('index'); ?>">
                        <div class="col-sm-2">
                            <select class="form-control chosen-select" name="nature_id" id='nature_id'>
                                <option value="0">选择栏目分类</option>
                                <?php if(is_array($cates) || $cates instanceof \think\Collection || $cates instanceof \think\Paginator): $i = 0; $__LIST__ = $cates;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                <option value="<?php echo $vo['id']; ?>" <?php if($vo['id'] == $nature_id): ?>selected<?php endif; ?>><?php echo $vo['name']; ?></option>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                        </div>
                        <div class="col-sm-3" style="padding:0;">
                            <div class="input-group">
                                <input type="text" id="key" class="form-control" name="key" value="<?php echo $val; ?>" placeholder="输入需查询的内容名称" />
                                <span class="input-group-btn"> 
                                    <button type="submit" class="btn btn-blue"><i class="fa fa-search"></i> 搜索</button>
                                </span>
                            </div>
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
                                <!--<th width="2%">&nbsp;</th>-->
                                <th width="3%">序号</th>
                                <th width="18%">标题</th>
                               
                                <th width="5%">所属分类</th>


                                <th width="6%">发布时间</th>
                                <th width="6%">状态</th>
                                <th width="10%">操作</th>
                            </tr>
                        </thead>
                        <script id="list-template" type="text/html">
                            {{# for(var i=0;i<d.length;i++){  }}
                                <tr class="long-td">
                                    <!--<td><input class="ids i-checks" type="checkbox" name="ids[]" data-page="{{d[i].page}}" value="{{d[i].id}}"></td>-->
                                    <td class="edit-td"><div class="updateText" onclick="toggleInput(this,{{d[i].id}},'sortnum','nature')">{{d[i].sortnum}}</div></td>
                                    <td class="edit-td td-left"><div class="updateText" onclick="toggleInput(this,{{d[i].id}},'name','nature')">{{d[i].name}}</div></td>
                                   
                                    <td>{{d[i].catename}}</td>


                                    <td>{{d[i].create_time}}</td>
                                    <td><input type="checkbox" name="status" data-id="{{d[i].id}}" data-table="nature" class="lcs_check lcs_switch lcs_sm" {{d[i].status==1?'checked':''}}/></td>
                                    <td>
                                        <a href="javascript:;" onclick="edit_article({{d[i].id}},{{d[i].page}})" class="btn btn-warning btn-outline btn-xs">
                                            <i class="fa fa-pencil"></i> 编辑</a>&nbsp;&nbsp;
                                        <a href="javascript:;" onclick="del_article({{d[i].id}},{{d[i].page}})" class="btn btn-primary btn-outline btn-xs">
                                            <i class="fa fa-trash-o"></i> 删除</a>
                                    </td>
                                </tr>
                            {{# } }}
                            <!--<tr>-->
                               <!--<td colspan="10" class="handle-tr">-->
                                   <!--<a href="javascript:;" onclick="all_select()" class="btn btn-blue btn-sm">全选</a>-->
                                   <!--<a href="javascript:;" onclick="inverse_select()" class="btn btn-blue btn-sm">反选</a>-->
                                   <!--<a href="javascript:;" onclick="cancel_select()" class="btn btn-blue btn-sm">取消</a>-->
                                   <!--<a href="javascript:;" onclick="batch_delete()" class="btn btn-blue btn-sm">-->
                                       <!--<i class="fa fa-trash-o"></i> 批量删除</a>-->
                               <!--</td>-->
                            <!--</tr>-->
                        </script>
                        <tbody id="list-content"></tbody>
                    </table>
                    <div id="AjaxPage"></div>
                    <div class="pageInfo">
                        共<?php echo $count; ?>条数据<span id="allpage"></span>
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
    $('#nature_id').change(function(){
        $('#admin_list_sea').submit();
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
            $.getJSON('<?php echo url("nature/all_delete"); ?>', {'ids' : ids}, function(res){
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
        var key=$('#key').val();
        var nature_id = $('#nature_id').val();
        $.getJSON('<?php echo url("nature/index"); ?>', {
            page: curr || 1,key:key,nature_id:nature_id
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
                    skin: '#20A0FF',//分页组件颜色
                    curr: curr || 1,
                    groups: 10,//连续显示分页数
                    jump: function(obj, first){
                        if(!first){
                            Ajaxpage(obj.curr)
                        }
                        $('#allpage').html('，第'+ obj.curr +'页，共'+ obj.pages +'页');
                    }
                });
            }
        });
    }
//编辑
function edit_article(id, page){
    var key=$('#key').val();
    var cate_id = $('#nature_id').val();
    location.href = '<?php echo url("nature/edit_nature"); ?>?id='+id+'&nature_id='+cate_id+'&key='+key+'&cur_page='+page;
}

//删除
function del_article(id, page){
    layer.confirm('确认删除此信息?', {icon: 3, title:'提示'}, function(index){
        $.getJSON('<?php echo url("nature/del_nature"); ?>', {'id':id}, function(res){
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
    var key=$('#key').val();

    location.href = '<?php echo url("nature/index"); ?>?key='+key+'&cur_page='+page;
}

</script>
</body>
</html>