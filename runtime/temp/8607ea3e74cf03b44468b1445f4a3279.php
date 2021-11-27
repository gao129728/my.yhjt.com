<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:83:"E:\php_project\my.yhjt.com\public/../application/admin/view/member/edit_member.html";i:1590394216;s:78:"E:\php_project\my.yhjt.com\public/../application/admin/view/public/header.html";i:1544408304;s:78:"E:\php_project\my.yhjt.com\public/../application/admin/view/public/footer.html";i:1527911724;}*/ ?>
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
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>编辑会员</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <form class="form-horizontal" name="edit_member" id="edit_member" method="post" action="<?php echo url('edit_member'); ?>">
                        <input type="hidden" name="id" value="<?php echo $member['id']; ?>">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">账号：</label>
                            <div class="input-group col-sm-4">
                                <input id="account" type="text" class="form-control" name="account" value="<?php echo $member['account']; ?>" placeholder="请输入账号">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">密码：</label>
                            <div class="input-group col-sm-3">
                                <input id="password" type="password" class="form-control" name="password" placeholder="密码不修改，请为空">
                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 密码不修改，请为空</span>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">会员组：</label>
                            <div class="input-group col-sm-3">
                                <select class="form-control m-b chosen-select" name="group_id" id="group_id">
                                    <option value="">==请选择会员组==</option>
                                    <?php if(!empty($group)): if(is_array($group) || $group instanceof \think\Collection || $group instanceof \think\Paginator): if( count($group)==0 ) : echo "" ;else: foreach($group as $key=>$vo): ?>
                                    <option value="<?php echo $vo['id']; ?>" <?php if($member['group_id'] == $vo['id']): ?>selected<?php endif; ?>><?php echo $vo['group_name']; ?></option>
                                    <?php endforeach; endif; else: echo "" ;endif; endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">手机号：</label>
                            <div class="input-group col-sm-3">
                                <input id="mobile" type="number" class="form-control" name="mobile" value="<?php echo $member['mobile']; ?>" placeholder="请输入手机号码">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">邮箱：</label>
                            <div class="input-group col-sm-3">
                                <input id="email" type="number" class="form-control" name="email" value="<?php echo $member['email']; ?>" placeholder="请输入邮箱">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">缩略图：</label>
                            <div class="input-group col-sm-4">
                                <div class="uploadImg-box">
                                    <input type="file" name="head_img" id="head_img" class="imgFile" onchange="previewImage(this)"/>
                                    <div class="up-img <?php if($member['head_img'] != ''): ?>hidden-box<?php endif; ?>"><i class="fa fa-cloud-upload"></i><p>点击上传头像</p></div>
                                    <?php if($member['head_img'] != ''): ?>
                                    <input type="checkbox" name="delHeadImg" class="input-del" value="1" />
                                    <div class="imgView"><img src="__UPLOAD_FACE__/<?php echo $member['head_img']; ?>"/></div>
                                    <?php endif; ?>
                                    <div class="uploadCover">
                                        <div class="ulinfo clearfix">
                                            <span class="up-btn"><i class="fa fa-cloud-upload"></i></span>
                                            <span class="up-del"><i class="fa fa-close"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">真实姓名：</label>
                            <div class="input-group col-sm-3">
                                <input id="realname" type="text" class="form-control" name="realname" value="<?php echo $member['realname']; ?>" placeholder="请输入真实姓名">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">状&nbsp;态：</label>
                            <div class="col-sm-6">
                                <div class="radio i-checks">
                                    <input type="radio" name='status' value="1" <?php if($member['status'] == 1): ?>checked<?php endif; ?>/>开启&nbsp;&nbsp;
                                    <input type="radio" name='status' value="0" <?php if($member['status'] == 0): ?>checked<?php endif; ?>/>关闭
                                </div>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2 button-group">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> 保存</button>&nbsp;&nbsp;&nbsp;
                                <a class="btn btn-danger" href="<?php echo $backUrl; ?>"><i class="fa fa-close"></i> 返回</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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
    //提交
    $(function(){
        $('#edit_member').ajaxForm({
            beforeSubmit: checkForm, 
            success: complete, 
            dataType: 'json'
        });
        
        function checkForm(){
            if( '' == $.trim($('#account').val())){
                layer.msg('请输入账号',{icon:2,time:1500,shade: 0.1}, function(index){
                    layer.close(index);
                });
                return false;
            }

            if( '' == $.trim($('#group_id').val())){
                layer.msg('请选择会员组',{icon:2,time:1500,shade: 0.1}, function(index){
                    layer.close(index);
                });
                return false;
            }
        }

        function complete(data){
            if(data.code==1){
                layer.msg(data.msg, {icon: 6,time:1500,shade: 0.1}, function(index){
                    window.location.href="<?php echo $backUrl; ?>";
                });
            }else{
                layer.msg(data.msg, {icon: 5,time:1500,shade: 0.1});
                return false;   
            }
        }   
    });

</script>
</body>
</html>