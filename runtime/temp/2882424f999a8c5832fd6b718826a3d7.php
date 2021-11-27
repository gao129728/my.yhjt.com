<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:78:"E:\php_project\my.yhjt.com\public/../application/admin/view/website/index.html";i:1637634104;s:78:"E:\php_project\my.yhjt.com\public/../application/admin/view/public/header.html";i:1544408304;s:78:"E:\php_project\my.yhjt.com\public/../application/admin/view/public/footer.html";i:1527911724;}*/ ?>
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
                    <h5>网站配置</h5>
                </div>
                <div class="ibox-content">
                    <form action="<?php echo url('save'); ?>" method="post" class="form-horizontal" id="config">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">网站Logo：</label>
                            <div class="col-sm-2" style="padding:0;">
                                <div class="uploadImg-box">
                                    <input type="file" name="web_site_logo" id="web_site_logo" class="imgFile" onchange="previewImage(this)"/>
                                    <div class="up-img <?php if($config['web_site_logo'] != ''): ?>hidden-box<?php endif; ?>"><i class="fa fa-cloud-upload"></i><p>点击上传图片</p></div>
                                    <?php if($config['web_site_logo'] != ''): ?>
                                    <input type="checkbox" name="delLogo" class="input-del" value="1" />
                                    <div class="imgView"><img src="__UPLOAD_PATH__/<?php echo $config['web_site_logo']; ?>"/></div>
                                    <?php endif; ?>
                                    <div class="uploadCover">
                                        <div class="ulinfo clearfix">
                                            <span class="up-btn"><i class="fa fa-cloud-upload"></i></span>
                                            <span class="up-del"><i class="fa fa-close"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 仅支持jpg、png、gif</span>
                            </div>
                            <label class="col-sm-1 control-label">ico：</label>
                            <div class="col-sm-2" style="padding:0;">
                                <div class="uploadImg-box" style="width:80px">
                                    <input type="file" name="web_site_ico" id="web_site_ico" class="imgFile" onchange="previewImage(this,'ico')"/>
                                    <div class="up-img <?php if($config['web_site_ico'] != ''): ?>hidden-box<?php endif; ?>"><i class="fa fa-cloud-upload"></i><p>点击上传图片</p></div>
                                    <?php if($config['web_site_ico'] != ''): ?>
                                    <input type="checkbox" name="delIco" class="input-del" value="1" />
                                    <div class="imgView"><img src="__UPLOAD_PATH__/<?php echo $config['web_site_ico']; ?>"/></div>
                                    <?php endif; ?>
                                    <div class="uploadCover">
                                        <div class="ulinfo clearfix">
                                            <span class="up-btn"><i class="fa fa-cloud-upload"></i></span>
                                            <span class="up-del"><i class="fa fa-close"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i>仅支持ico，<a href="http://www.bitbug.net" target="_blank">推荐格式在线转换地址</a></span>
                            </div>
                            <label class="col-sm-1 control-label">二维码：</label>
                            <div class="col-sm-2" style="padding:0;">
                                <div class="uploadImg-box">
                                    <input type="file" name="web_site_qrcode" id="web_site_qrcode" class="imgFile" onchange="previewImage(this)"/>
                                    <div class="up-img <?php if($config['web_site_qrcode'] != ''): ?>hidden-box<?php endif; ?>"><i class="fa fa-cloud-upload"></i><p>点击上传图片</p></div>
                                    <?php if($config['web_site_qrcode'] != ''): ?>
                                    <input type="checkbox" name="delQrcode" class="input-del" value="1" />
                                    <div class="imgView"><img src="__UPLOAD_PATH__/<?php echo $config['web_site_qrcode']; ?>"/></div>
                                    <?php endif; ?>
                                    <div class="uploadCover">
                                        <div class="ulinfo clearfix">
                                            <span class="up-btn"><i class="fa fa-cloud-upload"></i></span>
                                            <span class="up-del"><i class="fa fa-close"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 仅支持jpg、png、gif</span>
                            </div>
                        </div>
                        <?php if($wap_state == 1): ?>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">手机网站Logo：</label>
                            <div class="col-sm-2" style="padding:0;">
                                <div class="uploadImg-box">
                                    <input type="file" name="web_site_waplogo" id="web_site_waplogo" class="imgFile" onchange="previewImage(this)"/>
                                    <div class="up-img <?php if($config['web_site_waplogo'] != ''): ?>hidden-box<?php endif; ?>"><i class="fa fa-cloud-upload"></i><p>点击上传图片</p></div>
                                    <?php if($config['web_site_waplogo'] != ''): ?>
                                    <input type="checkbox" name="delwapLogo" class="input-del" value="1" />
                                    <div class="imgView"><img src="__UPLOAD_PATH__/<?php echo $config['web_site_waplogo']; ?>"/></div>
                                    <?php endif; ?>
                                    <div class="uploadCover">
                                        <div class="ulinfo clearfix">
                                            <span class="up-btn"><i class="fa fa-cloud-upload"></i></span>
                                            <span class="up-del"><i class="fa fa-close"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 仅支持jpg、png、gif</span>
                            </div>
                            <label class="col-sm-1 control-label">手机二维码：</label>
                            <div class="col-sm-2" style="padding:0;">
                                <div class="uploadImg-box">
                                    <input type="file" name="web_site_wapqrcode" id="web_site_wapqrcode" class="imgFile" onchange="previewImage(this)"/>
                                    <div class="up-img <?php if($config['web_site_wapqrcode'] != ''): ?>hidden-box<?php endif; ?>"><i class="fa fa-cloud-upload"></i><p>点击上传图片</p></div>
                                    <?php if($config['web_site_wapqrcode'] != ''): ?>
                                    <input type="checkbox" name="delwapqrcode" class="input-del" value="1" />
                                    <div class="imgView"><img src="__UPLOAD_PATH__/<?php echo $config['web_site_wapqrcode']; ?>"/></div>
                                    <?php endif; ?>
                                    <div class="uploadCover">
                                        <div class="ulinfo clearfix">
                                            <span class="up-btn"><i class="fa fa-cloud-upload"></i></span>
                                            <span class="up-del"><i class="fa fa-close"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 仅支持jpg、png、gif</span>
                            </div>
                        </div>
                        <?php endif; ?>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">网站标题：</label>
                            <div class="input-group col-sm-4">
                                <input type="text" class="form-control" id="web_site_title" name="config[web_site_title]" value="<?php echo $config['web_site_title']; ?>">
                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 网站标题</span>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">网站描述：</label>
                            <div class="input-group col-sm-4">
                                <textarea class="form-control" type="text" rows="3" name="config[web_site_description]"><?php echo $config['web_site_description']; ?></textarea>
                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 网站搜索引擎描述</span>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">网站关键字：</label>
                            <div class="input-group col-sm-4">
                                <textarea class="form-control" type="text" rows="3" name="config[web_site_keyword]"><?php echo $config['web_site_keyword']; ?></textarea>
                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 网站搜索引擎关键字</span>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">服务热线：</label>
                            <div class="input-group col-sm-4">
                                <input type="text" class="form-control" name="config[web_serviceLine]" value="<?php echo $config['web_serviceLine']; ?>">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">电子邮箱：</label>
                            <div class="input-group col-sm-4">
                                <input type="text" class="form-control" name="config[web_email]" value="<?php echo $config['web_email']; ?>">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">客服QQ：</label>
                            <div class="input-group col-sm-4">
                                <input type="text" class="form-control" name="config[web_qq]" value="<?php echo $config['web_qq']; ?>">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">公司地址：</label>
                            <div class="input-group col-sm-4">
                                <input type="text" class="form-control" name="config[web_site_address]" value="<?php echo $config['web_site_address']; ?>">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">联系我们：</label>
                            <div class="input-group col-sm-6">
                                <script src="/static/admin/ueditor/ueditor.config.js" type="text/javascript"></script>
                                <script src="/static/admin/ueditor/ueditor.all.js" type="text/javascript"></script>
                                <textarea name="config[web_contact]" id="myEditor3" style="width:100%"><?php echo $config['web_contact']; ?></textarea>
                                <script type="text/javascript">
                                    var editor1 = UE.getEditor('myEditor3', {
                                        toolbars: [
                                            ['fullscreen', 'source', 'undo', 'redo', 'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc','fontfamily','fontsize','lineheight','justifyleft','justifycenter','justifyright','justifyjustify', '|','link','unlink']
                                        ],
                                        autoHeightEnabled: true,
                                        autoFloatEnabled: true,
                                        initialFrameHeight:200,
                                        wordCount:false //是否开启字数统计
                                         ,maximumWords:100000
                                    });
                                </script>
                            </div>
                        </div>
                         <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">优惠信息：</label>
                            <div class="input-group col-sm-6">
                                <textarea name="config[web_sales]" id="myEditor4" style="width:100%"><?php echo $config['web_sales']; ?></textarea>
                                <script type="text/javascript">
                                    var editor1 = UE.getEditor('myEditor4', {
                                        toolbars: [
                                            ['fullscreen', 'source', 'undo', 'redo', 'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc','fontfamily','fontsize','lineheight','justifyleft','justifycenter','justifyright','justifyjustify', '|','link','unlink']
                                        ],
                                        autoHeightEnabled: true,
                                        autoFloatEnabled: true,
                                        initialFrameHeight:200,
                                        wordCount:false //是否开启字数统计
                                         ,maximumWords:100000
                                    });
                                </script>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">版权信息：</label>
                            <div class="input-group col-sm-6">
                                <textarea name="config[web_site_copy]" id="myEditor2" style="width:100%"><?php echo $config['web_site_copy']; ?></textarea>
                                <script type="text/javascript">
                                    var editor1 = UE.getEditor('myEditor2', {
                                        toolbars: [
                                            ['fullscreen', 'source', 'undo', 'redo', 'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc','fontfamily','fontsize','lineheight','justifyleft','justifycenter','justifyright','justifyjustify', '|','link','unlink']
                                        ],
                                        autoHeightEnabled: true,
                                        autoFloatEnabled: true,

                                        initialFrameHeight:200,
                                        wordCount:false //是否开启字数统计
                                    });
                                </script>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">头部Javascript代码：</label>
                            <div class="input-group col-sm-4">
                                <textarea class="form-control" type="text" rows="3" name="config[web_head_javascript]"><?php echo $config['web_head_javascript']; ?></textarea>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">底部Javascript代码：</label>
                            <div class="input-group col-sm-4">
                                <textarea class="form-control" type="text" rows="3" name="config[web_footer_javascript]"><?php echo $config['web_footer_javascript']; ?></textarea>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2 button-group">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> 保存信息</button>&nbsp;&nbsp;&nbsp;
                                <a class="btn btn-danger" href="javascript:history.go(-1);"><i class="fa fa-close"></i> 返回</a>
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
    $(function(){
        $('#config').ajaxForm({
            beforeSubmit: checkForm,
            success: complete, // 这是提交后的方法
            dataType: 'json'
        });
        function checkForm(){
            if($('#web_site_title').val() == ''){
                layer.msg('请输入网站标题！', {icon: 5,time:1500,shade: 0.1}, function(index){
                    layer.close(index);
                });
                return false;
            }
        }

        function complete(data){
            if(data.code == 1){
                layer.msg(data.msg, {icon: 6,time:1500,shade: 0.1}, function(index){
                    layer.close(index);
                    location.reload();
                });
            }else{
                layer.msg(data.msg, {icon: 5,time:1500,shade: 0.1}, function(index){
                    layer.close(index);
                });
                return false;
            }
        }

    });
</script>
</body>
</html>
