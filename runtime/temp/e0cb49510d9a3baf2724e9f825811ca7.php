<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:70:"E:\php_project\my.yhjt.com\public/../application/admin/view/index.html";i:1545125914;s:78:"E:\php_project\my.yhjt.com\public/../application/admin/view/public/header.html";i:1544408304;s:78:"E:\php_project\my.yhjt.com\public/../application/admin/view/public/footer.html";i:1527911724;}*/ ?>
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
<body class="fixed-sidebar full-height-layout gray-bg" style="overflow:hidden">
<div id="wrapper">
    <!--左侧导航开始-->
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="nav-close"><i class="fa fa-times-circle"></i>
        </div>
        <div class="sidebar-collapse">
            <ul class="nav" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                        <span><img alt="image" class="img-circle" width="70px" height="70px" src="<?php echo $portrait; ?>" onerror="this.src='/static/admin/images/head_default.gif'"/></span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear">
                                <span class="block m-t-xs"><strong class="font-bold"><?php echo $username; ?></strong></span>
                                <span class="text-muted text-xs block"><?php echo $rolename; ?><b class="caret"></b></span>
                            </span>
                        </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a href="javascript:;" id="cache">清除缓存</a></li>
                            <li><a href="<?php echo url('admin/login/loginOut'); ?>">安全退出</a></li>
                        </ul>
                    </div>
                </li>
                <?php if(!empty($menu)): if(is_array($menu) || $menu instanceof \think\Collection || $menu instanceof \think\Paginator): if( count($menu)==0 ) : echo "" ;else: foreach($menu as $key=>$vo): ?>
                        <li class="menu">
                            <a href="#">
                                <i class="<?php echo $vo['css']; ?>"></i>
                                <span class="nav-label"><?php echo $vo['title']; ?> </span>
                                <span class="fa arrow"></span>
                            </a>
                            <ul class="nav nav-second-level">
                                <?php if(!empty($vo['child'])): if(is_array($vo['child']) || $vo['child'] instanceof \think\Collection || $vo['child'] instanceof \think\Paginator): if( count($vo['child'])==0 ) : echo "" ;else: foreach($vo['child'] as $key=>$v): ?>
                                <li>
                                    <?php if(!empty($v['child'])): ?>
                                    <a href="#"><?php echo $v['title']; ?> <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <?php if(is_array($v['child']) || $v['child'] instanceof \think\Collection || $v['child'] instanceof \think\Paginator): if( count($v['child'])==0 ) : echo "" ;else: foreach($v['child'] as $key=>$third): ?>
                                        <li>
                                            <a class="J_menuItem" href="<?php echo url($third['name']); ?>"><?php echo $third['title']; ?></a>
                                        </li>
                                        <?php endforeach; endif; else: echo "" ;endif; ?>
                                    </ul>
                                    <?php else: ?>
                                    <a class="J_menuItem" href="<?php echo url($v['name']); ?>"><?php echo $v['title']; ?></a>
                                    <?php endif; ?>
                                </li>
                                <?php endforeach; endif; else: echo "" ;endif; endif; ?>
                            </ul>
                        </li>
                    <?php endforeach; endif; else: echo "" ;endif; endif; if($uid == 0): ?>
                <li class="menu">
                    <a href="#">
                        <i class="fa fa-cogs"></i>
                        <span class="nav-label">隐藏管理</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li><a class="J_menuItem" href="<?php echo url('menu/index'); ?>">菜单管理</a></li>
                        <li><a class="J_menuItem" href="<?php echo url('menu/articlecate'); ?>">文章分类功能管理</a></li>
                    </ul>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
    <!--左侧导航结束-->
    <!--右侧部分开始-->
    <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#">
                        <i class="fa fa-bars"></i> 
                    </a>
                </div>
                <ul class="nav navbar-top-links navbar-right">
                    <li class="dropdown hidden-xs">
                        <a class="right-sidebar-toggle" aria-expanded="false">
                            <i class="fa fa-tasks"></i> 主题
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="row content-tabs">
            <button class="roll-nav roll-left J_tabLeft"><i class="fa fa-backward"></i>
            </button>
            <nav class="page-tabs J_menuTabs">
                <div class="page-tabs-content">
                    <a href="javascript:backHome();" class="active J_menuTab" data-id="index.html">首页</a>
                </div>
            </nav>
            <button class="roll-nav roll-right J_tabRight"><i class="fa fa-forward"></i>
            </button>
            <div class="btn-group roll-nav roll-right">
                <button class="dropdown J_tabClose" data-toggle="dropdown">常用操作<span class="caret"></span></button>
                <ul role="menu" class="dropdown-menu dropdown-menu-right">
                    <li class="J_tabGo"><a>前进</a></li>
                    <li class="J_tabBack"><a>后退</a></li>
                    <li class="J_tabFresh"><a>刷新</a></li>
                    <!--<li class="divider"></li>
                    <li class="J_tabShowActive"><a>定位当前选项卡</a></li>-->
                    <li class="divider"></li>
                    <li class="J_tabCloseAll"><a>关闭全部选项卡</a></li>
                    <li class="J_tabCloseOther"><a>关闭其他选项卡</a></li>
                </ul>
            </div>
            <a href="javascript:;" id="logout" class="roll-nav roll-right J_tabExit">
                <i class="fa fa fa-sign-out"></i>退出
            </a>
        </div>
        <div class="row J_mainContent" id="content-main">
            <iframe class="J_iframe" id="iframe0_home" name="iframe0" width="100%" height="100%" src="<?php echo url('Index/indexPage'); ?>" frameborder="0" data-id="index.html" seamless></iframe>
        </div>
        <div class="footer">
            <div class="pull-right">Copyright © 2018 后台管理系统 All rights reserved.</div>
        </div>
    </div>
    <!--右侧部分结束-->
    <!--右侧边栏开始-->
    <div id="right-sidebar">
        <div class="sidebar-container">
            <ul class="nav nav-tabs navs-3">
                <li class="active">
                    <a data-toggle="tab" href="#tab-1">
                        <i class="fa fa-gear"></i> 主题
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div id="tab-1" class="tab-pane active">
                    <div class="sidebar-title">
                        <h3> <i class="fa fa-comments-o"></i> 主题设置</h3>
                        <small><i class="fa fa-tim"></i> 你可以从这里选择和预览主题的布局和样式，这些设置会被保存在本地，下次打开的时候会直接应用这些设置。</small>
                    </div>
                    <div class="skin-setttings">
                        <div class="title">主题设置</div>
                        <div class="setings-item">
                            <span>收起左侧菜单</span>
                            <div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="collapsemenu">
                                    <label class="onoffswitch-label" for="collapsemenu">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="setings-item">
                            <span>固定顶部</span>
                            <div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" name="fixednavbar" class="onoffswitch-checkbox" id="fixednavbar">
                                    <label class="onoffswitch-label" for="fixednavbar">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="setings-item">
                            <span>固定宽度</span>
                            <div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" name="boxedlayout" class="onoffswitch-checkbox" id="boxedlayout">
                                    <label class="onoffswitch-label" for="boxedlayout">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--右侧边栏结束-->
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
<script src="__JS__/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="__JS__/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="__JS__/hplus.min.js?v=4.1.0"></script>
<script src="__JS__/contabs.js"></script>
<script src="__JS__/plugins/pace/pace.min.js"></script>
<script type="text/javascript">
    function backHome(){
        document.getElementById('iframe0_home').src="<?php echo url('Index/indexPage'); ?>";
    }
    //退出登录
    $(document).ready(function(){
        $("#logout").click(function(){
            layer.confirm('你确定要退出吗？', {icon: 3}, function(index){
                layer.close(index);
                window.location.href="<?php echo url('admin/login/loginOut'); ?>";
            });
        });
    });

    //清除缓存
    $(function(){
        $("#cache").click(function(){
            layer.confirm('你确定要清除缓存吗？', {icon: 3, title:'提示'}, function(index){
                $.getJSON("<?php echo url('admin/index/clear'); ?>",function(res){
                    if(res.code == 1){
                        layer.msg(res.msg,{icon:1,time:2000,shade: 0.1});
                    }else{
                        layer.msg(res.msg,{icon:0,time:2000,shade: 0.1});
                    }
                });
                layer.close(index);
            })
        });
    });
</script>
</body>
</html>
