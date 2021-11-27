<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:85:"E:\php_project\my.yhjt.com\public/../application/admin/view/article/edit_article.html";i:1638001171;s:78:"E:\php_project\my.yhjt.com\public/../application/admin/view/public/header.html";i:1544408304;s:78:"E:\php_project\my.yhjt.com\public/../application/admin/view/public/footer.html";i:1527911724;}*/ ?>
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
    a[class="button-selectimg"]{color:#00A2D4;padding:4px 6px;border:1px dashed #00A2D4;border-radius:2px;}

    input[id="avatval"]{padding:3px 6px;padding-left:10px;border:1px solid #E7EAEC;width:230px;height:25px;line-height:25px;border-left:3px solid #3FB7EB;background:#FAFAFB;border-radius:2px;}
    #avatar{border:0px;display:none;}
</style>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>编辑文章</h5>
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
                            <?php if($cate_info['is_piclist'] == 1 ||$cate_info['is_annex'] == 1): ?><li><a data-toggle="tab" href="#tab-3" aria-expanded="false">其它设置</a></li><?php endif; ?>
                        </ul>
                    </div>
                    <form class="form-horizontal m-t" name="edit" id="edit" method="post" action="edit_article">
                        <input type="hidden" name="id" value="<?php echo $article['id']; ?>">
                        <div class="tab-content">
                            <div id="tab-1" class="tab-pane active">
                                <!--<div class="form-group">-->
                                    <!--<label class="col-sm-2 control-label">所属分类：</label>-->
                                    <!--<div class="input-group col-sm-4">-->
                                        <!--<select class="form-control m-b chosen-select" name="cate_id" id="cate_id">-->
                                            <!--<option value="">==请选择==</option>-->
                                            <!--<?php if(!empty($cateList)): ?>-->
                                            <!--<?php if(is_array($cateList) || $cateList instanceof \think\Collection || $cateList instanceof \think\Paginator): if( count($cateList)==0 ) : echo "" ;else: foreach($cateList as $key=>$vo): ?>-->
                                            <!--<option value="<?php echo $vo['id']; ?>" <?php if($article['cate_id'] == $vo['id']): ?>selected<?php endif; ?>><?php echo $vo['lefthtml']; ?><?php echo $vo['name']; ?></option>-->
                                            <!--<?php endforeach; endif; else: echo "" ;endif; ?>-->
                                            <!--<?php endif; ?>-->
                                        <!--</select>-->
                                    <!--</div>-->
                                <!--</div>-->
                                <!--<div class="hr-line-dashed"></div>-->
                                <input name="cate_id" value="<?php echo $article['cate_id']; ?>" type="hidden" id="cate_id">
                                <?php if(($article['cate_id'] == 95||$article['cate_id'] == 103||$article['cate_id'] == 97||$article['cate_id'] == 100)): ?>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">产品名称：</label>
                                    <div class="input-group col-sm-4">
                                        <input id="title" type="text" class="form-control" name="title" value="<?php echo $article['title']; ?>">
                                    </div>
                                </div>
                                <?php else: ?>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">标题：</label>
                                    <div class="input-group col-sm-4">
                                        <input id="title" type="text" class="form-control" name="title" value="<?php echo $article['title']; ?>">
                                    </div>
                                </div>
                                <?php endif; ?>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">序号：</label>
                                    <div class="input-group col-sm-4">
                                        <input id="sortnum" type="text" class="form-control input_wd1" name="sortnum" placeholder="输入序号" value="<?php echo $article['sortnum']; ?>">
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">发布日期：</label>
                                    <div class="input-group col-sm-4">
                                        <input type="text" class="form-control input_wd2" id="create_time" name="create_time" value="<?php echo date('Y-m-d H:i:s',$article['create_time']); ?>" readonly="readonly" style="background:url(__IMG__/WdatePicker.jpg) no-repeat 97% center">
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">访问量：</label>
                                    <div class="input-group col-sm-4">
                                        <input type="text" name="views" id="views" class="form-control input_wd1" value="<?php echo $article['views']; ?>">
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">缩略图：</label>
                                    <div class="input-group col-sm-4">
                                        <div class="uploadImg-box">
                                            <input type="file" name="photo" id="photo" class="imgFile" onchange="previewImage(this)"/>
                                            <div class="up-img <?php if($article['photo'] != ''): ?>hidden-box<?php endif; ?>"><i class="fa fa-cloud-upload"></i><p>点击上传图片</p></div>
                                            <?php if($article['photo'] != ''): ?>
                                            <input type="checkbox" name="delPhoto" class="input-del" value="1" />
                                            <div class="imgView"><img src="__UPLOAD_PATH__/<?php echo $article['photo']; ?>"/></div>
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
                                <?php if($cate_info['is_bigpic'] == 1): ?>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">大图：</label>
                                    <div class="input-group col-sm-4">
                                        <div class="uploadImg-box">
                                            <input type="file" name="bigpic" id="bigpic" class="imgFile" onchange="previewImage(this)"/>
                                            <div class="up-img <?php if($article['photo'] != ''): ?>hidden-box<?php endif; ?>"><i class="fa fa-cloud-upload"></i><p>点击上传图片</p></div>
                                            <?php if($article['bigpic'] != ''): ?>
                                            <input type="checkbox" name="delbigpic" class="input-del" value="1" />
                                            <div class="imgView"><img src="__UPLOAD_PATH__/<?php echo $article['bigpic']; ?>"/></div>
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
                                <?php endif; ?>
                                <script src="/static/admin/ueditor/ueditor.config.js" type="text/javascript"></script>
                                <script src="/static/admin/ueditor/ueditor.all.js" type="text/javascript"></script>

                                <?php if($fields_value): ?>
                                <input type="hidden" id="isFields" value="1">
                                <?php if(is_array($fields) || $fields instanceof \think\Collection || $fields instanceof \think\Paginator): $i = 0; $__LIST__ = $fields;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vos): $mod = ($i % 2 );++$i;if(in_array(($vos['id']), is_array($fields_value)?$fields_value:explode(',',$fields_value))): if($vos['style'] == 1): ?>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"><?php echo $vos['name']; ?>：</label>
                                    <div class="input-group col-sm-4">
                                        <input type="text" name="<?php echo $vos['value']; ?>" id="<?php echo $vos['value']; ?>" class="form-control p_price" value="<?php echo $article[$vos['value']]; ?>">
                                    </div>
                                </div>
                                <?php endif; if($vos['style'] == 2): ?>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label " for="myEditor"><?php echo $vos['name']; ?>：</label>
                                    <div class="input-group col-sm-7">

                                        <textarea name="<?php echo $vos['value']; ?>" style="width:100%" id="myEditors<?php echo $i; ?>"><?php echo $article[$vos['value']]; ?></textarea>
                                        <script type="text/javascript">
                                            var editor = new UE.ui.Editor();
                                            editor.render("myEditors<?php echo $i; ?>");
                                        </script>
                                    </div>
                                </div>
                                <?php endif; endif; endforeach; endif; else: echo "" ;endif; endif; if($classifications_list): if(is_array($classifications_list) || $classifications_list instanceof \think\Collection || $classifications_list instanceof \think\Paginator): $j = 0; $__LIST__ = $classifications_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vos): $mod = ($j % 2 );++$j;?>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label " ><?php echo $vos['name']; ?>：</label>
                                    <div class="col-sm-7">
                                         <div class="radio i-checks">
                                            <?php if(is_array($vos['list']) || $vos['list'] instanceof \think\Collection || $vos['list'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vos['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voss): $mod = ($i % 2 );++$i;if($vos['style'] == 1): ?>
                                                
                                                <input type="radio" name='attribute_id[<?php echo $j; ?>]' value="<?php echo $voss['id']; ?>" <?php if(in_array(($voss['id']), is_array($article['attribute_ids'])?$article['attribute_ids']:explode(',',$article['attribute_ids']))): ?>checked<?php endif; ?>/><?php echo $voss['name']; ?>&nbsp;&nbsp;

                                            <?php else: ?>
                                                <input type="checkbox" name='attribute_id[<?php echo $j; ?>][]' value="<?php echo $voss['id']; ?>"  <?php if(in_array(($voss['id']), is_array($article['attribute_ids'])?$article['attribute_ids']:explode(',',$article['attribute_ids']))): ?>checked<?php endif; ?>/><?php echo $voss['name']; ?>&nbsp;&nbsp;

                                            <?php endif; endforeach; endif; else: echo "" ;endif; ?>
                                        </div>
                                    </div>
                                </div>
                         
                                <?php endforeach; endif; else: echo "" ;endif; endif; if($cate_info['is_intro'] == 1): ?>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label " for="myEditor">简介：</label>
                                    <div class="input-group col-sm-7">

                                        <textarea name="intro" style="width:100%" id="myEditor3"><?php echo $article['intro']; ?></textarea>
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
                                <?php endif; ?>

                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label " for="myEditor">详细内容：</label>
                                    <div class="input-group col-sm-7">
                                        <textarea name="content" style="width:100%" id="myEditor"><?php echo $article['content']; ?></textarea>
                                        <script type="text/javascript">
                                            var editor = new UE.ui.Editor();
                                            editor.render("myEditor");
                                        </script>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">状&nbsp;态：</label>
                                    <div class="col-sm-6">
                                        <div class="radio i-checks">
                                            <input type="radio" name='status' value="1" <?php if($article['status'] == 1): ?>checked<?php endif; ?>/>开启&nbsp;&nbsp;
                                            <input type="radio" name='status' value="0" <?php if($article['status'] == 0): ?>checked<?php endif; ?>/>关闭
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="tab-2" class="tab-pane">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">置顶：</label>
                                    <div class="col-sm-6">
                                        <div class="radio i-checks">
                                            <input type="radio" name='isTop' value="1" <?php if($article['isTop'] == 1): ?>checked<?php endif; ?>/>开启&nbsp;&nbsp;
                                            <input type="radio" name='isTop' value="0" <?php if($article['isTop'] == 0): ?>checked<?php endif; ?>/>关闭
                                        </div>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">网页标题：</label>
                                    <div class="input-group col-sm-4">
                                        <input id="seo_title" type="text" class="form-control" name="seo_title" value="<?php echo $article['seo_title']; ?>">
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">网页关键字：</label>
                                    <div class="input-group col-sm-4">
                                        <input id="keyword" type="text" class="form-control" name="keyword" value="<?php echo $article['keyword']; ?>">
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">网页描述：</label>
                                    <div class="input-group col-sm-4">
                                        <textarea type="text" rows="5" name="description" id="description" class="form-control"><?php echo $article['description']; ?></textarea>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">作者：</label>
                                    <div class="input-group col-sm-4">
                                        <input type="text" name="writer" id="writer" class="form-control" value="<?php echo $article['writer']; ?>">
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">来源：</label>
                                    <div class="input-group col-sm-4">
                                        <input type="text" name="source" id="source" class="form-control" value="<?php echo $article['source']; ?>">
                                    </div>
                                </div>
                            </div>
                            <?php if($cate_info['is_piclist'] == 1 || $cate_info['is_annex'] == 1): ?>
                            <div id="tab-3" class="tab-pane">
                                <?php if($cate_info['is_piclist'] == 1): ?>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">多图：</label>
                                    <div class="input-group col-sm-7">
                                        <ul class="multi-img clearfix" id="multi-img-sortable">
                                            <?php if(is_array($imageList) || $imageList instanceof \think\Collection || $imageList instanceof \think\Paginator): $k = 0; $__LIST__ = $imageList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?>
                                            <li>
                                                <input type="hidden" name="img_id[<?php echo $k; ?>]" value="<?php echo $vo['id']; ?>" class="img_id">
                                                <input type="hidden" name="img_src[<?php echo $k; ?>]" value="<?php echo $vo['pic']; ?>" class="img_src">
                                                <div class="handle"><i class="fa fa-arrows"></i></div>
                                                <div class="upload-list">
                                                    <div class="pull-left"><img src="__UPLOAD_PATH__/<?php echo $vo['pic']; ?>" class="img"/></div>
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
                            <?php endif; ?>
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
    $(function(){
        $("#avatsel").click(function(){
            $("#avatar").trigger('click');
        });
        $("#avatval").click(function(){
            $("#avatar").trigger('click');
        });
        $("#avatar").change(function(){
            var ext =$(this).val().substr($(this).val().length - 3).toLowerCase();
            if (ext != "doc" && ext != "ocx" && ext != "rar" && ext != "zip" && ext != "mp4"){
                layer.msg('附件必须是doc、docx、rar、zip或mp4格式！', {icon: 5,time:1500,shade: 0.1}, function(index){
                    layer.close(index);
                });
                return false;
            }
            $("#avatval").val($(this).val());

        });
    });
</script>
<?php if($cate_info['is_piclist']): ?>
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
            $.getJSON("<?php echo url('article/del_banner_img'); ?>", {'img_id':img_id,'img_src':img_src}, function(res){
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
    layui.use('laydate', function(){
        var laydate = layui.laydate;
        laydate.render({
            elem: '#create_time'
            ,type:'datetime'
        });
    });
    $(function(){
        var a = $('#isFields').val();
        $('#edit').ajaxForm({
            beforeSubmit: checkForm, // 此方法主要是提交前执行的方法，根据需要设置
            success: complete, // 这是提交后的方法
            dataType: 'json'
        });

        function checkForm(){
            var pattern = /^(([1-9][0-9]*)|(([0]\.\d{1,2}|[1-9][0-9]*\.\d{1,2})))$/g,
                str = $.trim($('.p_price').val()),
                isright = pattern.test(str);
            if( '' == $.trim($('#title').val())){
                layer.msg('标题不能为空', {icon: 5,time:1500,shade: 0.1}, function(index){
                    layer.close(index);
                });
                return false;
            }
            if ($.trim($('#sortnum').val()) == '' || $.trim($('#sortnum').val()).match(/\D/))
            {
                layer.msg('请输入合法的序号', {icon: 5,time:1500,shade: 0.1}, function(index){
                    layer.close(index);
                });
                return false;
            }

            if ('' == $.trim($('#create_time').val())) {
                layer.msg('发布日期不能为空', {icon: 5, time: 1500, shade: 0.1}, function (index) {
                    layer.close(index);
                });
                return false;
            }

            if(a==1) {
                if (isright == false) {
                    layer.msg('请输入合法的价格', {icon: 5, time: 1500, shade: 0.1}, function (index) {
                        layer.close(index);
                    });
                    return false;
                }
            }
        }

        function complete(data){
            if(data.code == 1){
                layer.msg(data.msg, {icon: 6,time:1500,shade: 0.1}, function(index){
                    layer.close(index);
                    window.location.href="<?php echo $backUrl; ?>";
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
