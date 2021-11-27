<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:81:"E:\php_project\my.yhjt.com\public/../application/admin/view/article/add_cate.html";i:1637557818;s:78:"E:\php_project\my.yhjt.com\public/../application/admin/view/public/header.html";i:1544408304;s:78:"E:\php_project\my.yhjt.com\public/../application/admin/view/public/footer.html";i:1527911724;}*/ ?>
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
<link rel="stylesheet" type="text/css" href="/static/admin/webUploader/css/webuploader.css" />
<link rel="stylesheet" type="text/css" href="/static/admin/webUploader/css/style.css" />
<style>
    .multi-img li {
        background-color: #f8f8f8;
        border: 1px solid #ddd;
        height: auto;
        margin-bottom: 10px;
        overflow: hidden;
        padding: 7px 10px 10px;
        position: relative;
        transition: none 0s ease 0s ;
        width: 100%;
        float:left;
    }
    .multi-img .handle {
        color: #999;
        margin-bottom: 7px;
    }
    .multi-img .upload-list .img {
        border-radius: 5px;
        height: 78px;
        position: relative;
        vertical-align: middle;
        width: 120px;
        z-index: 1;
    }
    .multi-img .upload-list .control-label {
        font-weight: 100;
        padding: 7px 0 0;
    }
    .multi-img .status-label, .multi-img .status-move {
        display: block;
    }
    .multi-img .status-label, .multi-img .status-move {
        background: #13ce66 none repeat scroll 0 0;
        box-shadow: 0 1px 1px #ccc;
        height: 26px;
        position: absolute;
        right: -17px;
        text-align: center;
        top: -7px;
        transform: rotate(45deg);
        width: 46px;
    }
    .multi-img .status-move {
        background: #666 none repeat scroll 0 0;
        cursor: pointer;
        display: none;
    }
    .multi-img .status-label i, .multi-img .status-move i {
        color: #fff;
        font-size: 14px;
        font-weight: normal;
        margin-top: 9px;
        transform: rotate(-45deg) scale(0.8);
    }
    .multi-img li:hover .status-move {
        display: block;
    }
    .multi-img li:hover .status-label {
        display: none;
    }
</style>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>添加分类</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="form_basic.html#">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="panel-options">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#tab-1" aria-expanded="true">基本设置</a></li>
                            <li><a data-toggle="tab" href="#tab-2" aria-expanded="false">高级设置</a></li>
                            <?php if($cate_config['other'] == 1): ?><li><a data-toggle="tab" href="#tab-3" aria-expanded="false">栏目其它设置</a></li><?php endif; if($cate_config['wap_photo'] == 1 || $cate_config['web_website'] == 1): ?><li><a data-toggle="tab" href="#tab-4" aria-expanded="false">手机栏目设置</a></li><?php endif; ?>

                        </ul>
                    </div>
                    <form class="form-horizontal" name="add_cate" id="add_cate" method="post" action="<?php echo url('add_cate'); ?>">
                        <div class="tab-content">
                            <div id="tab-1" class="tab-pane active">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">所属父级：</label>
                                    <div class="input-group col-sm-4">
                                        <select name="parent_id" class="form-control">
                                            <option value="0">-- 默认顶级 --</option>
                                            <?php if(is_array($cate_tree) || $cate_tree instanceof \think\Collection || $cate_tree instanceof \think\Paginator): if( count($cate_tree)==0 ) : echo "" ;else: foreach($cate_tree as $key=>$v): if($v['lvl'] < \think\Config::get('max_cate_class')): ?>
                                            <option value="<?php echo $v['id']; ?>" <?php if($cate_id == $v['id']): ?>selected<?php endif; ?> style="margin-left:55px;"><?php echo $v['lefthtml']; ?><?php echo $v['name']; ?></option>
                                            <?php endif; endforeach; endif; else: echo "" ;endif; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">分类名称：</label>
                                    <div class="input-group col-sm-4">
                                        <input id="name" type="text" class="form-control" name="name" >
                                    </div>
                                </div>
                                <?php if($cate_config['en_name'] == 1): ?>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">分类英文名称：</label>
                                    <div class="input-group col-sm-4">
                                        <input id="en_name" type="text" class="form-control" name="en_name" >
                                        <span class="help-block m-b-none"><i class="fa fa-info-circle"></i>&nbsp;若无,请忽视</span>
                                    </div>

                                </div>
                                <?php endif; if($cate_config['catedir'] == 1): ?>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">栏目目录：</label>
                                    <div class="input-group col-sm-4">
                                        <input id="catedir" type="text" class="form-control" name="catedir" >
                                        <span class="help-block m-b-none"><i class="fa fa-info-circle"></i>&nbsp;若无,请忽视</span>
                                    </div>

                                </div>
                                <?php endif; if($cate_config['website'] == 1): ?>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">链接：</label>
                                    <div class="input-group col-sm-4">
                                        <input id="website" type="text" class="form-control" name="website" >
                                        <span class="help-block m-b-none"><i class="fa fa-info-circle"></i>&nbsp;若无,请忽视</span>
                                    </div>

                                </div>
                                <?php endif; ?>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">排&nbsp;&nbsp;序：</label>
                                    <div class="input-group col-sm-4">
                                        <input id="orderby" type="text" class="form-control" name="orderby" value="<?php echo $orderby; ?>">
                                    </div>
                                </div>
                                <?php if($cate_config['photo'] == 1): ?>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">栏目Banner：</label>
                                    <div class="input-group col-sm-4">
                                        <div class="uploadImg-box">
                                            <input type="file" name="photo" id="photo" class="imgFile" onchange="previewImage(this)"/>
                                            <div class="up-img"><i class="fa fa-cloud-upload"></i><p>点击上传图片</p></div>
                                            <div class="uploadCover">
                                                <div class="ulinfo clearfix">
                                                    <span class="up-btn"><i class="fa fa-cloud-upload"></i></span>
                                                    <span class="up-del"><i class="fa fa-close"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; if($cate_config['pic'] == 1): ?>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">缩略图：</label>
                                    <div class="input-group col-sm-4">
                                        <div class="uploadImg-box">
                                            <input type="file" name="pic" id="pic" class="imgFile" onchange="previewImage(this)"/>
                                            <div class="up-img"><i class="fa fa-cloud-upload"></i><p>点击上传图片</p></div>
                                            <div class="uploadCover">
                                                <div class="ulinfo clearfix">
                                                    <span class="up-btn"><i class="fa fa-cloud-upload"></i></span>
                                                    <span class="up-del"><i class="fa fa-close"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; if($cate_config['info_state'] == 1): ?>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">内容排版：</label>
                                    <div class=" col-sm-4">
                                        <div class="radio i-checks">
                                            <input type="radio" name='info_state' value="1"  checked="checked"/>关于我们&nbsp;
                                            <input type="radio" name='info_state' value="2" />产品中心&nbsp;
                                            <input type="radio" name='info_state' value="3" />服务支持&nbsp;
                                            <input type="radio" name='info_state' value="4" />新闻资讯&nbsp;
                                            <input type="radio" name='info_state' value="5" />联系我们&nbsp;
                                            <input type="radio" name='info_state' value="6" />产业荣誉&nbsp;
                                           <!-- <input type="radio" name='info_state' value="7" />技术平台详情页&nbsp;-->
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">文章属性：</label>
                                    <div class=" col-sm-8">
                                        <div class="radio i-checks">
                                            <input type="checkbox" name='is_bigpic'  value="1" />大图&nbsp;
                                            <input type="checkbox" name='is_annex'   value="1" />附件&nbsp;
                                            <input type="checkbox" name='is_piclist' value="1" />多图&nbsp;
                                            <input type="checkbox" name='is_intro'   value="1" />简介&nbsp;
                                            <?php if(is_array($fields) || $fields instanceof \think\Collection || $fields instanceof \think\Paginator): $i = 0; $__LIST__ = $fields;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                            <input type="checkbox" name='fields[]' value="<?php echo $vo['id']; ?>"  /><?php echo $vo['name']; ?>&nbsp;
                                            <?php endforeach; endif; else: echo "" ;endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <?php if($classifications): ?>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">筛选属性：</label>
                                    <div class=" col-sm-8">
                                        <div class="radio i-checks">
                                            <?php if(is_array($classifications) || $classifications instanceof \think\Collection || $classifications instanceof \think\Paginator): $i = 0; $__LIST__ = $classifications;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                            <input type="checkbox" name='classification_id[]' value="<?php echo $vo['id']; ?>"  /><?php echo $vo['name']; ?>&nbsp;
                                            <?php endforeach; endif; else: echo "" ;endif; ?>
                                        </div>
                                    </div>
                                </div>

                                <?php endif; ?>




                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">状&nbsp;态：</label>
                                    <div class="col-sm-6">
                                        <div class="radio i-checks">
                                            <input type="radio" name='status' value="1" checked="checked"/>开启&nbsp;&nbsp;
                                            <input type="radio" name='status' value="0" />关闭
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div id="tab-2" class="tab-pane">
                                <?php if($cate_config['target'] == 1): ?>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">新窗口打开：</label>
                                    <div class="col-sm-6 input-group">
                                        <input type="checkbox" name="is_Target" value="1" class="lcs_check" lcs-text="是|否" autocomplete="off"/>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <?php endif; if($cate_config['nav'] == 1): ?>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">导航栏显示：</label>
                                    <div class="col-sm-6 input-group">
                                        <input type="checkbox" name="is_nav" value="1" class="lcs_check" lcs-text="是|否" autocomplete="off" />
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <?php endif; ?>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">网页标题：</label>
                                    <div class="input-group col-sm-4">
                                        <input id="seo_title" type="text" class="form-control" name="seo_title">
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">网页关键字：</label>
                                    <div class="input-group col-sm-4">
                                        <input id="keyword" type="text" class="form-control" name="keyword">
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">网页描述：</label>
                                    <div class="input-group col-sm-4">
                                        <textarea type="text" rows="3" name="description" id="description" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            <?php if($cate_config['other'] == 1): ?>
                            <div id="tab-3" class="tab-pane">
                                <?php if($cate_config['pic_list'] == 1): ?>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">多图：</label>
                                    <div class="input-group col-sm-7">
                                        <ul class="multi-img clearfix" id="multi-img-sortable">
                                            <?php if(is_array($imageList) || $imageList instanceof \think\Collection || $imageList instanceof \think\Paginator): $k = 0; $__LIST__ = $imageList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?>
                                            <li>
                                                <input type="hidden" name="img_id[<?php echo $k; ?>]" value="<?php echo $vo['id']; ?>" class="img_id">
                                                <input type="hidden" name="img_src[<?php echo $k; ?>]" value="<?php echo $vo['photo']; ?>" class="img_src">
                                                <div class="handle"><i class="fa fa-arrows"></i></div>
                                                <div class="upload-list">
                                                    <div class="pull-left"><img src="__UPLOAD_PATH__/<?php echo $vo['photo']; ?>" class="img"/></div>
                                                    <div class="pull-left col-sm-8">
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">标题</label>
                                                            <div class="col-sm-6">
                                                                <input type="text" name="img_name[<?php echo $k; ?>]" value="<?php echo $vo['title']; ?>" placeholder="请输入标题" class="form-control">
                                                            </div>

                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">链接</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" name="img_url[<?php echo $k; ?>]" value="<?php echo $vo['url']; ?>" placeholder="请输入链接地址" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <label class="status-label"><i class="fa fa-check"></i></label>
                                                <label class="status-move"><i class="fa fa-remove"></i></label>
                                            </li>
                                            <?php endforeach; endif; else: echo "" ;endif; ?>
                                        </ul>
                                        <div id="wrapper">
                                            <div id="container" style="width:100%;height:230px">
                                                <div id="uploader">
                                                    <div class="queueList">
                                                        <div id="dndArea" class="placeholder">
                                                            <div id="filePicker"></div>
                                                            <p class="tips">或将照片拖到这里，单次最多可选16张</p>
                                                        </div>
                                                    </div>
                                                    <div class="statusBar" style="display:none;">
                                                        <div class="progress">
                                                            <span class="text">0%</span>
                                                            <span class="percentage"></span>
                                                        </div><div class="info"></div>
                                                        <div class="btns">
                                                            <div id="filePicker2"></div><div class="uploadBtn">开始上传</div><div class="delAll">清空</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>
                            <?php endif; if($cate_config['wap_photo'] == 1 || $cate_config['web_website'] == 1): ?>
                            <div id="tab-4" class="tab-pane">
                                <?php if($cate_config['wap_photo'] == 1): ?>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">手机栏目Banner：</label>
                                    <div class="input-group col-sm-4">
                                        <div class="uploadImg-box">
                                            <input type="file" name="wap_photo" id="wap_photo" class="imgFile" onchange="previewImage(this)"/>
                                            <div class="up-img"><i class="fa fa-cloud-upload"></i><p>点击上传图片</p></div>
                                            <div class="uploadCover">
                                                <div class="ulinfo clearfix">
                                                    <span class="up-btn"><i class="fa fa-cloud-upload"></i></span>
                                                    <span class="up-del"><i class="fa fa-close"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; if($cate_config['web_website'] == 1): ?>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">手机链接：</label>
                                    <div class="input-group col-sm-4">
                                        <input id="web_website" type="text" class="form-control" name="web_website" >
                                        <span class="help-block m-b-none"><i class="fa fa-info-circle"></i>&nbsp;若无,请忽视</span>
                                    </div>

                                </div>
                                <?php endif; ?>
                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2 button-group">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> 保存</button>&nbsp;&nbsp;&nbsp;
                                <a class="btn btn-danger" href="javascript:history.back();"><i class="fa fa-close"></i> 返回</a>
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
<?php if($cate_config['pic_list'] == 1): ?>
<script type="text/javascript" src="/static/admin/webUploader/webuploader.min.js"></script>
<script type="text/javascript" src="/static/admin/webUploader/upload_img.js"></script>
<script type="text/javascript" src="/static/admin/js/plugins/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript">
    $("#multi-img-sortable").sortable();
    $("#multi-img-sortable").disableSelection();
    $('#multi-img-sortable').on('click','.status-move', function(){
        var _this = $(this);
        layer.confirm('确认删除此图片吗?', {icon: 3, title:'提示'}, function(index){
            var img_id = _this.siblings('.img_id').val();
            var img_src = _this.siblings('.img_src').val();
            $.getJSON("<?php echo url('article/del_banner_imgs'); ?>", {'img_id':img_id,'img_src':img_src}, function(res){
                if(res.code == 1){
                    _this.parent().remove();
                }else{
                    layer.msg(res.msg,{icon:0,time:1500,shade: 0.1});
                }
            });
            layer.close(index);
        });
    });
    $('#filePicker').on('click','.webuploader-pick', function(){
        $(this).next().find('label').click();
    });

</script>
<?php endif; ?>
<script type="text/javascript">

    $(function(){
        $('#add_cate').ajaxForm({
            beforeSubmit: checkForm,
            success: complete,
            dataType: 'json'
        });

        function checkForm(){
            if( '' == $.trim($('#name').val())){
                layer.msg('请输入分类名称',{icon:2,time:1500,shade: 0.1}, function(index){
                    layer.close(index);
                });
                return false;
            }
            if ($.trim($('#orderby').val()) == '' || $.trim($('#orderby').val()).match(/\D/))
            {
                layer.msg('请输入合法的序号', {icon: 5,time:1500,shade: 0.1}, function(index){
                    layer.close(index);
                });
                return false;
            }
        }

        function complete(data){
            if(data.code==1){
                layer.msg(data.msg, {icon: 6,time:1500,shade: 0.1}, function(index){
                    window.location.href="<?php echo url('article/index_cate'); ?>";
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