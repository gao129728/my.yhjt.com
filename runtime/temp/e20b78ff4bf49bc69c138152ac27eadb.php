<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:76:"E:\php_project\my.yhjt.com\public/../application/admin/view/index/index.html";i:1528095720;s:78:"E:\php_project\my.yhjt.com\public/../application/admin/view/public/header.html";i:1544408304;s:78:"E:\php_project\my.yhjt.com\public/../application/admin/view/public/footer.html";i:1527911724;}*/ ?>
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
<div class="wrapper wrapper-content">
    <div class="alert alert-danger alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <div>尊敬的会员<span id="weather"></span></div>
    </div>

    <!-- 上方tab -->
    <div class="row">
        <div class="col-sm-3">
            <div class="ibox float-e-margins">
                <div class="ibox-item-number clearfix">
                    <a href="<?php echo url('member/index'); ?>" class="clearfix">
                        <div class="pull-left"><i class="fa fa-user"></i></div>
                        <div class="pull-right">
                            <h2><?php echo $all_member_cnt; ?></h2>
                            <small>会员</small>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="ibox float-e-margins">
                <div class="ibox-item-number clearfix">
                    <a href="<?php echo url('article/index'); ?>" class="clearfix">
                        <div class="pull-left leftBg-1"><i class="fa fa-file-text"></i></div>
                        <div class="pull-right">
                            <h2><?php echo $all_article_cnt; ?></h2>
                            <small>文章</small>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="ibox float-e-margins">
                <div class="ibox-item-number clearfix">
                    <a href="<?php echo url('message/index'); ?>" class="clearfix">
                        <div class="pull-left leftBg-2"><i class="fa fa-comments"></i></div>
                        <div class="pull-right">
                            <h2><?php echo $all_message_cnt; ?></h2>
                            <small>留言</small>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="ibox float-e-margins">
                <div class="ibox-item-number clearfix">
                    <a href="<?php echo url('counter/index'); ?>" class="clearfix">
                        <div class="pull-left leftBg-3"><i class="fa fa-eye"></i></div>
                        <div class="pull-right">
                            <h2><?php echo $all_counter_cnt; ?></h2>
                            <small>访问量</small>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox-counter ibox">
                <div class="counter-tit">
                    <p>最近12天访问统计</p>
                    <h4>访问统计</h4>
                </div>
                <div class="counter-chart">
                    <canvas id="lineChart" height="50"></canvas>
                </div>
            </div>
        </div>
    </div>
    <!-- 中间折线 -->
    <div class="row">
        <div class="col-sm-6">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <i class="fa fa-cogs"></i> 系统信息
                </div>
                <div class="panel-body">
                    <p><i class="fa fa-sitemap"></i> 系统类型：<?php echo $info['web_system']; ?>
                    </p>
                    <p><i class="fa fa-windows"></i> 服务环境：<?php echo $info['web_server']; ?>
                    </p>
                    <p><i class="fa fa-warning"></i> 上传附件限制：<?php echo $info['onload']; ?>
                    </p>
                    <p><i class="fa fa-credit-card"></i> PHP 版本：<?php echo $info['phpversion']; ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <i class="fa fa-cogs"></i> 站点信息
                </div>
                <div class="panel-body">
                    <p><i class="fa fa-desktop"></i> 网站名称：<?php echo $website['web_name']; ?></p>
                    <p><i class="fa fa-support"></i> 网站域名：<a href="<?php echo $website['web_domain']; ?>" target="_blank"><?php echo $website['web_domain']; ?></a></p>
                    <p><i class="fa fa-user-circle"></i> 登录用户：<?php echo $username; ?></p>
                    <p><i class="fa fa-clock-o"></i> 登录时间：<?php echo date("Y-m-d H:i:s",$login_time); ?></p>
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
<script src="__JS__/jquery.leoweather.min.js"></script>
<script src="__JS__/plugins/chartJs/Chart.min.js"></script>
<script type="text/javascript">
    $('#weather').leoweather({format:'，{时段}好！<span id="colock">现在时间是：<strong>{年}年{月}月{日}日 星期{周} {时}:{分}:{秒}</strong></span>'});
</script>
<script>
    $(function(){
        var chart_date=<?php echo $chart_date; ?>;
        var  labels = [
            <?php if(is_array($chart_date) || $chart_date instanceof \think\Collection || $chart_date instanceof \think\Paginator): $i = 0; $__LIST__ = $chart_date;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <?php echo !empty($i) && $i==1?'':','; ?>"<?php echo $vo['date']; ?>"
        <?php endforeach; endif; else: echo "" ;endif; ?>
        ];
        var  data = [
            <?php if(is_array($chart_date) || $chart_date instanceof \think\Collection || $chart_date instanceof \think\Paginator): $i = 0; $__LIST__ = $chart_date;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <?php echo !empty($i) && $i==1?'':','; ?>"<?php echo $vo['val']; ?>"
        <?php endforeach; endif; else: echo "" ;endif; ?>
        ];
        var lineData = {
            labels: labels,
            datasets: [
                {
                    label: "Example dataset",
                    fillColor: "rgba(26,179,148,0.5)",
                    strokeColor: "rgba(26,179,148,0.7)",
                    pointColor: "rgba(26,179,148,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(26,179,148,1)",
                    data: data
                }
            ]
        };

        var lineOptions = {
            scaleShowGridLines: true,
            scaleGridLineColor: "rgba(0,0,0,.05)",
            scaleGridLineWidth: 1,
            bezierCurve: true,
            bezierCurveTension: 0.4,
            pointDot: true,
            pointDotRadius: 4,
            pointDotStrokeWidth: 1,
            pointHitDetectionRadius: 20,
            datasetStroke: true,
            datasetStrokeWidth: 2,
            datasetFill: true,
            responsive: true
        };

        var ctx = document.getElementById("lineChart").getContext("2d");
        var myNewChart = new Chart(ctx).Line(lineData, lineOptions);
    });
</script>
</body>
</html>