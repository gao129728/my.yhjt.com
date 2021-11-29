<?php if (!defined('THINK_PATH')) exit(); /*a:16:{s:78:"E:\php_project\my.yhjt.com\public/../application/home/view/category/index.html";i:1636104736;s:75:"E:\php_project\my.yhjt.com\public/../application/home/view/public/head.html";i:1636624294;s:77:"E:\php_project\my.yhjt.com\public/../application/home/view/public/header.html";i:1637549535;s:83:"E:\php_project\my.yhjt.com\public/../application/home/view/public/extra_header.html";i:1637638016;s:84:"E:\php_project\my.yhjt.com\public/../application/home/view/cate-module/module_1.html";i:1637990340;s:80:"E:\php_project\my.yhjt.com\public/../application/home/view/public/left_menu.html";i:1637547992;s:79:"E:\php_project\my.yhjt.com\public/../application/home/view/public/sub_menu.html";i:1635908056;s:84:"E:\php_project\my.yhjt.com\public/../application/home/view/cate-module/module_2.html";i:1636072986;s:84:"E:\php_project\my.yhjt.com\public/../application/home/view/cate-module/module_3.html";i:1636072640;s:84:"E:\php_project\my.yhjt.com\public/../application/home/view/cate-module/module_4.html";i:1637547956;s:84:"E:\php_project\my.yhjt.com\public/../application/home/view/cate-module/module_5.html";i:1636011188;s:84:"E:\php_project\my.yhjt.com\public/../application/home/view/cate-module/module_6.html";i:1636072760;s:84:"E:\php_project\my.yhjt.com\public/../application/home/view/cate-module/module_7.html";i:1635149502;s:77:"E:\php_project\my.yhjt.com\public/../application/home/view/public/banner.html";i:1634787342;s:77:"E:\php_project\my.yhjt.com\public/../application/home/view/public/footer.html";i:1637995283;s:84:"E:\php_project\my.yhjt.com\public/../application/home/view/cate-module/module_8.html";i:1635150286;}*/ ?>
﻿<!DOCTYPE html><html lang="en"><head>    <meta charset="UTF-8">    <meta http-equiv="X-UA-Compatible" content="IE=edge">    <meta name="viewport" content="width=device-width, initial-scale=1.0">    <title><?php echo $web_site_title; ?></title>    <script src="http://www.jq22.com/jquery/angular-1.4.6.js"></script>    <script type="text/javascript" src="__JS__/angular-ui-router.min.js"></script>    <link rel="stylesheet" href="__CSS__/style.css">    <link rel="stylesheet" href="__CSS__/base.css">    <link rel="stylesheet" href="__CSS__/swiper.min.css">    <link rel="stylesheet" href="__CSS__/iconfont/iconfont.css">    <script src="__JS__/jquery-3.1.1.min.js"></script>    <link href="__CSS__/iCheck/custom.css" rel="stylesheet">    <script src="__JS__/iCheck/icheck.min.js"></script>    <script src="__JS__/swiper.min.js"></script>    <script src="__JS__/base.js"></script>    <script src="__JS__/layui/layui.js"></script>    <script src="__JS__/jquery.form.min.js"></script>    <script src="__JS__/shopping.js"></script></head><body><div class="nav-box inner">
    <div class="w1200 fsc">
        <div class="pic-box">
            <img src="__IMG__/logo2.png" alt="">
        </div>
        <div class="">
    <div class="sign_in_box fec">
        <?php if($isLogin == false): ?>
        <div class="register_box fsc">
            <div class="register fcc"><span class="iconfont icon-moban"></span>
                <a <?php if($navCur == 'index'): ?>style="color: #fff"<?php else: ?>style="color: #000"<?php endif; ?> href="/home/member/register"> Register</a>
            </div>
            <div class="line"></div>
            <div class="sign_in">
                <a <?php if($navCur == 'index'): ?>style="color: #fff"<?php else: ?>style="color: #000"<?php endif; ?> href="/home/member/login">Sign in</a>
            </div>
        </div>
        <?php else: ?>
        <!-- 登录后 -->
        <div class="register_box fsc">
            <div class="register fcc"><span class="iconfont icon-moban"></span>
                <a <?php if($navCur == 'index'): ?>style="color: #fff"<?php else: ?>style="color: #000"<?php endif; ?> href="<?php echo url('home/member/myorder'); ?>"><?php echo $member['email']; ?></a>
            </div>
            <div class="line"></div>
            <div class="sign_in">
                <a <?php if($navCur == 'index'): ?>style="color: #fff"<?php else: ?>style="color: #000"<?php endif; ?> href="/home/member/loginOut">Login Out</a>
            </div>
        </div>
        <?php endif; ?>
        <div class="lag_box fcc">
            <div class="down_box fcc">English<span class="iconfont icon-CaretDown"></span></div>
            <ul class="lag_list">
                <li><a href="http://yhjt.fr.cfsite4.ahcfkj.com">Français</a></li>
                <li><a href="http://yhjt.ita.cfsite4.ahcfkj.com">Italiano</a></li>
                <li><a href="http://yhjt.pt.cfsite4.ahcfkj.com">Português</a></li>
            </ul>
        </div>
    </div>
    <div class="nav fec">
        <ul class="fec">
            <li><a href="/">Home</a></li>
            <?php if(is_array($nav_cate) || $nav_cate instanceof \think\Collection || $nav_cate instanceof \think\Paginator): $k = 0;$__LIST__ = is_array($nav_cate) ? array_slice($nav_cate,0,4, true) : $nav_cate->slice(0,4, true); if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?>
            <li><a href="<?php echo $vo['url']; ?>"><?php echo $vo['name']; ?></a></li>
            <?php endforeach; endif; else: echo "" ;endif; ?>
            <li class="last"><a href="javascript:;">Contact</a></li>
        </ul>
        <div class="search_box">
            <div class="iconfont icon-sousuo- search_icon" ></div>
            <div class="search">
                <form method="get" action="<?php echo url('home/search/index'); ?>"
                      onsubmit="if(this.keys.value == '' || this.keys.value == 'Search...'){alert('Keyword cannot be empty!'); this.keys.focus(); return false; }">
                    <input name="keys" placeholder="Search..." class="inp inptet">
                    <button type="submit" href="" id="search_btn" class="search_btn">
                        <img src="__IMG__/search2.png" alt="">
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="dialogBg"></div>
<div id="dialog">
     <a href="<?php echo getCateUrl(83,''); ?>"><img src="__IMG__/dialogClose.png" alt="" class="dialogClose1"></a>
    <?php echo $config['web_sales']; ?>
 </div>

    </div>
</div>
<div class="inner-banner">
    <img src="__UPLOAD_PATH__/<?php echo $banner_img; ?>" alt="" srcset="">
</div>


<?php switch($cate['info_state']): case "1": ?><!--aboutus图文-->
<div class="container w1200">
    <div class="crumbs">
    Your location：<a href="/">Home</a> &gt;
    <a href="<?php echo getCateUrl($navCate['id'],$navCate['website']); ?>">
        <?php echo $navCate['name']; ?>
    </a> &gt;
        <?php echo $cate['name']; ?>
</div>
    <div class="con_title"><b><?php echo $navCate['en_name']; ?></b> </div>
<div class="nav">
    <ul class="fcc">
        <?php if(is_array($sub_menu) || $sub_menu instanceof \think\Collection || $sub_menu instanceof \think\Paginator): $i = 0; $__LIST__ = $sub_menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <li <?php if($subCur == $vo['id']): ?>class="cur"<?php else: ?>class=""<?php endif; ?>><a href="<?php echo $vo['url']; ?>" title=""><?php echo $vo['name']; ?></a></li>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>
</div>
    <div class="cont-box">
        <?php echo $lists['content']; ?>
    </div>
</div>
<?php break; case "2": ?><!--product-->
<div class="container w1200">
    <div class="crumbs">
    Your location：<a href="/">Home</a> &gt;
    <a href="<?php echo getCateUrl($navCate['id'],$navCate['website']); ?>">
        <?php echo $navCate['name']; ?>
    </a> &gt;
        <?php echo $cate['name']; ?>
</div>
    <div class="con_title"><b><?php echo $navCate['en_name']; ?></b> </div>
    <div class="product clearfix">
        <div class="side_pro row clearfix">
            <ul>
                <?php if(is_array($sub_menu) || $sub_menu instanceof \think\Collection || $sub_menu instanceof \think\Paginator): $i = 0; $__LIST__ = $sub_menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <li class="dir156 yiji <?php if($vo['isCurrent'] == 1): ?>cur<?php endif; ?>"><a href="<?php echo $vo['url']; ?>"><?php echo $vo['name']; ?></a>
                    <span class="spams"><?php if($vo['isCurrent'] == 1): ?>-<?php else: ?>+<?php endif; ?></span>
                    <ul class="xiala">
                        <?php if(is_array($vo['child']) || $vo['child'] instanceof \think\Collection || $vo['child'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$td): $mod = ($i % 2 );++$i;?>
                        <a href="<?php echo getCateUrl($td['id'],''); ?>" class="drt165"><?php echo $td['name']; ?></a>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </li>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
        <div class="con pro_cont mb20">
            <ul class="pro_lt clearfix">
                <?php if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <li>
                    <div style="border: 1px solid #ccc;margin:0px auto;">
                        <a href="<?php echo getDetailUrl($vo['id'],$vo['website']); ?>">
                            <img src="__UPLOAD_PATH__/<?php echo $vo['photo']; ?>" class="img-responsive"
                                 style="margin-top: 27px; margin-bottom: 27px;">
                        </a>
                    </div>
                    <a href="<?php echo getDetailUrl($vo['id'],$vo['website']); ?>">
                        <p><?php echo $vo['title']; ?></p><em>More →</em>
                    </a>
                </li>
                <?php endforeach; endif; else: echo "" ;endif; ?>

            </ul>
            <div class="page-box">
                <?php echo $lists->render(); ?>
            </div>
        </div>
    </div>
</div>

<script>
    $(function () {
        $('.side_pro li span').each(function () {
            var $html = $.trim($(this).parent(".yiji").find('.xiala').text());
            if ($html == '') {
                $(this).hide();
            }
        })
        $(".side_pro li span").click(function () {
            console.log($(this));
            var _this = $(this).parent(".yiji").find('.xiala');
            var _siblings = $(this).parent(".yiji").siblings('li').find('.xiala');
            var $html = $.trim($(this).parent(".yiji").find('.xiala').text());

            if ($html !== '') {
                if ($(this).parent(".yiji").find('.xiala').is(':hidden')) {
                    $(".yiji").find('.spams').text('+');
                    $(this).parent(".yiji").find('.spams').text('-');
                } else {
                    $(this).parent(".yiji").find('.spams').text('+');
                }
                _this.slideToggle(500);
                _siblings.slideUp(500);
            }
        });
    });
</script>
<?php break; case "3": ?><!--service图文-->
<div class="container w1200">
    <div class="crumbs">
    Your location：<a href="/">Home</a> &gt;
    <a href="<?php echo getCateUrl($navCate['id'],$navCate['website']); ?>">
        <?php echo $navCate['name']; ?>
    </a> &gt;
        <?php echo $cate['name']; ?>
</div>
    <div class="con_title"><b><?php echo $navCate['en_name']; ?></b> </div>
    <div class="cont-box">
        <?php echo $lists['content']; ?>
    </div>
</div>
<?php break; case "4": ?><!--news-->
<div class="container w1200">
    <div class="crumbs">
    Your location：<a href="/">Home</a> &gt;
    <a href="<?php echo getCateUrl($navCate['id'],$navCate['website']); ?>">
        <?php echo $navCate['name']; ?>
    </a> &gt;
        <?php echo $cate['name']; ?>
</div>
      <div class="con_title"><b><?php echo $navCate['name']; ?></b> </div>
    <!--<div class="con_title"><b><?php echo $navCate['en_name']; ?></b> </div>
<div class="nav">
    <ul class="fcc">
        <?php if(is_array($sub_menu) || $sub_menu instanceof \think\Collection || $sub_menu instanceof \think\Paginator): $i = 0; $__LIST__ = $sub_menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <li <?php if($subCur == $vo['id']): ?>class="cur"<?php else: ?>class=""<?php endif; ?>><a href="<?php echo $vo['url']; ?>" title=""><?php echo $vo['name']; ?></a></li>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>
</div>-->
    <!--新闻列表-->
    <ul class="news-list">
        <?php if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <li>
            <a href="<?php echo getDetailUrl($vo['id'],$vo['website']); ?>" class="clearfix">
                <div class="pic-box">
                    <img src="__UPLOAD_PATH__/<?php echo $vo['photo']; ?>" alt="">
                </div>
                <div class="time">
                    <div class="num"><?php echo date("d",$vo['create_time']); ?></div>
                    <div><?php echo date("M",$vo['create_time']); ?></div>
                </div>
                <div class="cont-box">
                    <div class="title"><?php echo $vo['title']; ?></div>
                    <div class="cont">
                        <?php echo $vo['content']; ?>
                    </div>
                </div>
            </a>
        </li>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>
    <div class="page-box">
        <?php echo $lists->render(); ?>
    </div>
</div>
<?php break; case "5": ?><!--message-->
<div class="container w1200">
    <div class="crumbs">
    Your location：<a href="/">Home</a> &gt;
    <a href="<?php echo getCateUrl($navCate['id'],$navCate['website']); ?>">
        <?php echo $navCate['name']; ?>
    </a> &gt;
        <?php echo $cate['name']; ?>
</div>
    <div class="con_title"><b><?php echo $navCate['en_name']; ?></b> </div>
<div class="nav">
    <ul class="fcc">
        <?php if(is_array($sub_menu) || $sub_menu instanceof \think\Collection || $sub_menu instanceof \think\Paginator): $i = 0; $__LIST__ = $sub_menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <li <?php if($subCur == $vo['id']): ?>class="cur"<?php else: ?>class=""<?php endif; ?>><a href="<?php echo $vo['url']; ?>" title=""><?php echo $vo['name']; ?></a></li>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>
</div>
    <div class="register-box">
        <form action="/home/form/message" method="post" id="message">
            <input type="hidden" name="isMessage" name="isMessage" value="1">
            <div class="input-line">
                <label for="name" class="tit"><i>*</i>Name:</label>
                <input type="text" name="name" id="name">
            </div>
            <div class="input-line">
                <label for="company" class="tit"><i>*</i>Company: </label>
                <input type="text" name="company" id="company">
            </div>
            <div class="input-line">
                <label for="address" class="tit">Add: </label>
                <input type="text" name="address" id="address">
            </div>
            <div class="input-line">
                <label for="phone" class="tit"><i>*</i>Tel: </label>
                <input type="text" name="phone" id="phone">
            </div>
            <div class="input-line">
                <label for="fax" class="tit">Fax: </label>
                <input type="text" name="fax" id="fax">
            </div>
            <div class="input-line">
                <label for="email" class="tit"><i>*</i>E-mail: </label>
                <input type="text" name="email" id="email">
            </div>
            <div class="input-line">
                <label for="topic" class="tit"><i>*</i>Topic: </label>
                <input type="text" name="topic" id="topic">
            </div>
            <div class="input-line">
                <label for="content" class="tit"><i>*</i>Message: </label>
                <textarea name="content" id="content" cols="30" rows="10"></textarea>
            </div>
            <div class="input-line">
                <label for="code" class="tit">Verification: </label>
                <input type="text" name="code" id="code" class="code-input">
                <img src="/home/form/code_img.html" class="codeImg" onclick="this.src='/home/form/code_img.html?time='+Math.random();" alt=""/>
            </div>
            <div class="input-line " style="padding-top: 10px;">
                <div class="tit"></div>
                <div class="btn-box">
                    <button type="submit" class="btn submit">Submit</button>
                    <button type="reset" class="btn">Reset</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    $('#message')[0].reset();
    $(function(){
        $('#message').ajaxForm({
            beforeSubmit: checkForm, // 此方法主要是提交前执行的方法，根据需要设置
            success: complete, // 这是提交后的方法
            dataType: 'json'
        });

        function checkForm(){

        }
        function complete(data){
            if(data.code == 1){
                layer.msg(data.msg, {icon: 6,time:1500,shade: 0.1}, function(index){
                    layer.close(index);
                    window.location.reload();
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
<?php break; case "6": ?><!--honor-->
<div class="container w1200">
    <div class="crumbs">
    Your location：<a href="/">Home</a> &gt;
    <a href="<?php echo getCateUrl($navCate['id'],$navCate['website']); ?>">
        <?php echo $navCate['name']; ?>
    </a> &gt;
        <?php echo $cate['name']; ?>
</div>
    <div class="con_title"><b><?php echo $navCate['en_name']; ?></b> </div>
<div class="nav">
    <ul class="fcc">
        <?php if(is_array($sub_menu) || $sub_menu instanceof \think\Collection || $sub_menu instanceof \think\Paginator): $i = 0; $__LIST__ = $sub_menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <li <?php if($subCur == $vo['id']): ?>class="cur"<?php else: ?>class=""<?php endif; ?>><a href="<?php echo $vo['url']; ?>" title=""><?php echo $vo['name']; ?></a></li>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>
</div>
    <div class="cont-box">
    </div>
    <ul class="honor clearfix">
        <?php if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <li class="fl">
            <a href="<?php echo getDetailUrl($vo['id'],$vo['website']); ?>" rel="lightbox" title=" ">
                <div class="pic-box">
                    <img src="__UPLOAD_PATH__/<?php echo $vo['photo']; ?>" alt="">
                </div>
                <div class="pic-title"><?php echo $vo['title']; ?></div>
            </a>
        </li>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>
    <div class="page-box">
        <?php echo $lists->render(); ?>
    </div>
</div>

<?php break; case "7": ?><!--科研详情-->
<body class="ins_body thr_body">
<div class="nav-box inner">
    <div class="w1200 fsc">
        <div class="pic-box">
            <img src="__IMG__/logo2.png" alt="">
        </div>
        <div class="">
    <div class="sign_in_box fec">
        <?php if($isLogin == false): ?>
        <div class="register_box fsc">
            <div class="register fcc"><span class="iconfont icon-moban"></span>
                <a <?php if($navCur == 'index'): ?>style="color: #fff"<?php else: ?>style="color: #000"<?php endif; ?> href="/home/member/register"> Register</a>
            </div>
            <div class="line"></div>
            <div class="sign_in">
                <a <?php if($navCur == 'index'): ?>style="color: #fff"<?php else: ?>style="color: #000"<?php endif; ?> href="/home/member/login">Sign in</a>
            </div>
        </div>
        <?php else: ?>
        <!-- 登录后 -->
        <div class="register_box fsc">
            <div class="register fcc"><span class="iconfont icon-moban"></span>
                <a <?php if($navCur == 'index'): ?>style="color: #fff"<?php else: ?>style="color: #000"<?php endif; ?> href="<?php echo url('home/member/myorder'); ?>"><?php echo $member['email']; ?></a>
            </div>
            <div class="line"></div>
            <div class="sign_in">
                <a <?php if($navCur == 'index'): ?>style="color: #fff"<?php else: ?>style="color: #000"<?php endif; ?> href="/home/member/loginOut">Login Out</a>
            </div>
        </div>
        <?php endif; ?>
        <div class="lag_box fcc">
            <div class="down_box fcc">English<span class="iconfont icon-CaretDown"></span></div>
            <ul class="lag_list">
                <li><a href="http://yhjt.fr.cfsite4.ahcfkj.com">Français</a></li>
                <li><a href="http://yhjt.ita.cfsite4.ahcfkj.com">Italiano</a></li>
                <li><a href="http://yhjt.pt.cfsite4.ahcfkj.com">Português</a></li>
            </ul>
        </div>
    </div>
    <div class="nav fec">
        <ul class="fec">
            <li><a href="/">Home</a></li>
            <?php if(is_array($nav_cate) || $nav_cate instanceof \think\Collection || $nav_cate instanceof \think\Paginator): $k = 0;$__LIST__ = is_array($nav_cate) ? array_slice($nav_cate,0,4, true) : $nav_cate->slice(0,4, true); if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?>
            <li><a href="<?php echo $vo['url']; ?>"><?php echo $vo['name']; ?></a></li>
            <?php endforeach; endif; else: echo "" ;endif; ?>
            <li class="last"><a href="javascript:;">Contact</a></li>
        </ul>
        <div class="search_box">
            <div class="iconfont icon-sousuo- search_icon" ></div>
            <div class="search">
                <form method="get" action="<?php echo url('home/search/index'); ?>"
                      onsubmit="if(this.keys.value == '' || this.keys.value == 'Search...'){alert('Keyword cannot be empty!'); this.keys.focus(); return false; }">
                    <input name="keys" placeholder="Search..." class="inp inptet">
                    <button type="submit" href="" id="search_btn" class="search_btn">
                        <img src="__IMG__/search2.png" alt="">
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="dialogBg"></div>
<div id="dialog">
     <a href="<?php echo getCateUrl(83,''); ?>"><img src="__IMG__/dialogClose.png" alt="" class="dialogClose1"></a>
    <?php echo $config['web_sales']; ?>
 </div>

    </div>
</div>
<div class="inner-banner">
    <img src="__UPLOAD_PATH__/<?php echo $banner_img; ?>" alt="" srcset="">
</div>



<div class="ind_banner_box">
    <span id="scr">
        <label>Start</label>
        <b></b>
        <b></b>
        <b></b>
    </span>
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <!--视频banner&弹出视频-->
            <div class="swiper-slide" data-swiper-autoplay="13000">
                <div class="ind_video_case">
                    <!--data-map4Src  放完整视频地址-->
                    <div class="ind_ban_vid_box ban_video_src"
                         data-map4Src="__UPLOAD_FILE__/<?php echo $vbanner['annex']; ?>">
                        <video preload="auto" id="video1" loop muted playsinline="" x-webkit-airplay=""
                               webkit-playsinline="" x5-video-player-type="h5"
                               src="__UPLOAD_FILE__/<?php echo $popvideo['annex']; ?>"></video>
                    </div>
                    <div class="ind_video_box">
                        <div class="can_video">
                            <video loop muted playsinline="" x-webkit-airplay="" webkit-playsinline=""
                                   x5-video-player-type="h5" src="__UPLOAD_FILE__/<?php echo $popvideo['annex']; ?>"></video>
                        </div>
                        <div class="can_video">
                            <video loop muted playsinline="" x-webkit-airplay="" webkit-playsinline=""
                                   x5-video-player-type="h5" src="__UPLOAD_FILE__/<?php echo $popvideo['annex']; ?>"></video>
                        </div>
                        <div class="can_video">
                            <video loop muted playsinline="" x-webkit-airplay="" webkit-playsinline=""
                                   x5-video-player-type="h5" src="__UPLOAD_FILE__/<?php echo $popvideo['annex']; ?>"></video>
                        </div>
                        <div class="can_video">
                            <video loop muted playsinline="" x-webkit-airplay="" webkit-playsinline=""
                                   x5-video-player-type="h5" src="__UPLOAD_FILE__/<?php echo $popvideo['annex']; ?>"></video>
                        </div>
                    </div>
                    <div class="banner_sha">
                        <img src="__IMG__/banner_sha.png" alt="">
                        <div class="video_line"></div>
                    </div>
                    <div class="ind_ban_text_box">
                        <div class="ban_title_en">
                            <div class=" glow in tlt"></div>
                        </div>
                        <div class="ban_title">
                            <div class=" glow in tlt">Compound Semiconductor</div>
                        </div>
                        <div class="ban_info">

                            <div class=" glow in tlt">R&amp;D,manufacturing and service provider.</div>
                        </div>
                        <div class="ban_num_box" style="display:none;">
                            <div class="ban_num scroll-animate" data-delay="1.5" data-effect="fadeInUpSmall">01
                            </div>
                            <div class="ban_num_info">

                                <div class=" glow in tlt"></div>
                            </div>
                        </div>
                    </div>
                    <div class="circleProgress_wrapper ban_vid_btn">
                        <div class="btn_vid_icon"><i class="newiconfont">&#xe6a5;</i></div>
                    </div>
                </div>
            </div>
            <!--banner-->
            <?php if(is_array($banner) || $banner instanceof \think\Collection || $banner instanceof \think\Paginator): $i = 0; $__LIST__ = $banner;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <div class="swiper-slide">
                <div class="ind_video_case">
                    <div class="ind_ban_vid_box">
                        <div class="ban_img"
                             style="background-image: url(__UPLOAD_PATH__/<?php echo $vo['photo']; ?>)"></div>
                    </div>

                    <div class="ind_video_box">

                        <div class="can_video">
                            <div class="ban_img"
                                 style="background-image: url(__UPLOAD_PATH__/<?php echo $vo['photo']; ?>)">
                            </div>
                        </div>
                        <div class="can_video">
                            <div class="ban_img"
                                 style="background-image: url(__UPLOAD_PATH__/<?php echo $vo['photo']; ?>)">
                            </div>
                        </div>
                        <div class="can_video">
                            <div class="ban_img"
                                 style="background-image: url(__UPLOAD_PATH__/<?php echo $vo['photo']; ?>)">
                            </div>
                        </div>
                        <div class="can_video">
                            <div class="ban_img"
                                 style="background-image: url(__UPLOAD_PATH__/<?php echo $vo['photo']; ?>)">
                            </div>
                        </div>
                    </div>
                    <div class="banner_sha"><img src="__IMG__/banner_sha.png" alt=""></div>
                    <div class="ind_ban_text_box">
                        <div class="ban_title_en">
                            <div class=" glow in tlt"></div>
                        </div>

                        <div class="ban_title">
                            <div class=" glow in tlt">Compound Semiconductor</div>
                        </div>
                        <div class="ban_info">

                            <div class=" glow in tlt">R&amp;D,manufacturing and service provider.</div>
                        </div>
                        <div class="ban_num_box" style="display: none">
                            <div class="ban_num scroll-animate" data-delay="1.5" data-effect="fadeInUpSmall">02
                            </div>
                            <div class="ban_num_info">
                                <div class=" glow in tlt"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
        <!-- 如果需要分页器 -->
        <div class="swiper-pagination  scroll-animate" data-delay="1" data-effect="fadeInUpSmall"
             style="display: none"></div>
    </div>
</div>
<div class="ind_video_box ">
    <div class="can_video">
    </div>
    <div class="can_video">
    </div>
    <div class="can_video">
    </div>
    <div class="can_video">
    </div>
    <span></span>
    <span></span>
    <span></span>
</div>

<div class="uix-ajax-load__loader"><span></span></div>
<div id="ind_con_box" class="ind_con_box ">
    <div class="uix-ajax-load__fullpage-container">
        <section class="uix-height--100 is-mobile-still">
            <div class="ajax-container" data-ajax-method="POST" data-ajax-page-id="1">
                <div class="js-uix-ajax-load__container">
                    <div class="uix-ajax-load__container">
                        <div class="pub_pad_left pure">
                        </div>
                        <div class="fou_ban_img_box">
                            <img src="__UPLOAD_PATH__/<?php echo $banner_img; ?>" alt="">
                            <div class="fou_ban_sty scroll-animate classGo" data-Tclass="removeAn"></div>
                            <div class="thr_name scroll-animate" data-delay="2" data-effect="fadeInUpSmall">
                                <?php if($third_id == 77): ?>
                                <?php echo $gaas['title']; elseif($third_id == 78): ?>
                                <?php echo $sawfilter['title']; elseif($third_id == 59): ?>
                                <?php echo $fsp['title']; elseif($third_id == 72): ?>
                                <?php echo $solutionone['title']; elseif($third_id == 60): ?>
                                <?php echo $fs['title']; elseif($third_id == 73): ?>
                                <?php echo $solutiontwo['title']; endif; ?>
                            </div>
                        </div>
                        <div class="pub_pad_left pub_pad_right pure fou_info_box  none_bg gaa_info_box">
                            <?php if($third_id == 77): ?>
                            <img class="gaa_img_left" src="__UPLOAD_PATH__/<?php echo $gaas['photo']; ?>" alt="">
                            <?php elseif($third_id == 78): ?>
                            <img class="gaa_img_left" src="__UPLOAD_PATH__/<?php echo $sawfilter['photo']; ?>" alt="">
                            <?php elseif($third_id == 59): ?>
                            <img class="gaa_img_left" src="__UPLOAD_PATH__/<?php echo $fsp['photo']; ?>" alt="">
                            <?php elseif($third_id == 72): ?>
                            <img class="gaa_img_left" src="__UPLOAD_PATH__/<?php echo $solutionone['photo']; ?>" alt="">
                            <?php elseif($third_id == 60): ?>
                            <img class="gaa_img_left" src="__UPLOAD_PATH__/<?php echo $fs['photo']; ?>" alt="">
                            <?php elseif($third_id == 73): ?>
                            <img class="gaa_img_left" src="__UPLOAD_PATH__/<?php echo $solutiontwo['photo']; ?>" alt="">
                            <?php endif; ?>
                            <div class="scroll-animate thr_title gaa_text_right fou_info_font_sty"
                                 data-effect="fadeInUpSmall">
                                <?php if($third_id == 77): ?>
                                <?php echo $gaas['content']; elseif($third_id == 78): ?>
                                <?php echo $sawfilter['content']; elseif($third_id == 59): ?>
                                <?php echo $fsp['content']; elseif($third_id == 72): ?>
                                <?php echo $solutionone['content']; elseif($third_id == 60): ?>
                                <?php echo $fs['content']; elseif($third_id == 73): ?>
                                <?php echo $solutiontwo['content']; endif; ?>
                            </div>
                        </div>
                        <?php if($third_id == 77): ?>
                        <div class="pub_pad_left pub_pad_right pure fou_con_box pad_top0">
                            <div class="thr_tab_box">

                                <div class="thr_tab_nav_box thr_tab_nav_box_4 pure scroll-animate father"
                                     data-child=".at_on" data-delay=".05" data-effect="fadeInUpSmall">

                                    <a class="on at_on"><span>GaAs-InGaP HBT</span></a>
                                    <a class=" at_on"><span>GaAs-pHEMT</span></a>
                                    <a class=" at_on"><span>GaAs-IPD</span></a>
                                    <a class=" at_on"><span>GaAs-BiHEMT</span></a>
                                    <span class="tab_nav_line"></span>

                                </div>
                                <div class="thr_tab_case">
                                    <div class="thr_tab_con">
                                        <div class="thr_title_l_box">
                                            <img src="__IMG__/1550193375669.jpg" alt="">
                                            <span class="thr_title_l thr_name"><span class="scroll-animate" data-effect="fadeInUpSmall">Introduction</span></span>
                                        </div>
                                        <div class="fon_num_tex_box scroll-animate father pure" data-child=".at_on"
                                             data-delay=".05" data-effect="fadeInUpSmall">
                                            <span class="fon_num at_on">01</span>
                                            <div class="fon_tex fou_info_font_sty font_regular at_on">SAIC provide a
                                                complete range of applications in different fields of products on
                                                HBT process development to meet the diversity of wireless
                                                communication needs. In terms of market application, 5G products are
                                                also developed in the technical field along with the application of
                                                handheld wireless communication to the Internet of things(IoT).
                                            </div>
                                        </div>
                                        <div class="thr_data_box scroll-animate father" data-child=".at_on"
                                             data-delay=".05" data-effect="fadeInUpSmall">
                                            <div class="at_on">

                                                <table>
                                                    <tbody>
                                                    <tr>
                                                        <th>Process</th>
                                                        <th>Application</th>
                                                        <th>Features</th>
                                                        <th>PDK Download</th>
                                                    </tr>
                                                    <tr>
                                                        <td>H20HG6</td>
                                                        <td>3G/4G/Wi-Fi PA/Sub-6G/TX module,Gain Block</td>
                                                        <td>1. High current gain up to 120<br />
                                                            2. High Linearity and high ruggedness;<br />
                                                            3. 5G product application; sub-6G range</td>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td>H20HG7</td>
                                                        <td>3G/4G/Wi-Fi PA/Sub-6G/TX module,Gain Block</td>
                                                        <td>1. High current gain up to 120<br />
                                                            2. High Linearity and high ruggedness;<br />
                                                            3. 5G product application; sub-6G range</td>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td>H20HP1</td>
                                                        <td>5G NR PA</td>
                                                        <td>InGaP HBT - 4G+ /5G NR HPUE/APT PA</td>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td>H20HP2</td>
                                                        <td>5G NR PA</td>
                                                        <td>InGaP HBT - 4G+ /5G NR HPUE/APT PA</td>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="thr_tab_con">
                                        <div class="thr_title_l_box">
                                            <img src="__IMG__/1550193375669.jpg" alt="">
                                            <span class="thr_title_l thr_name"><span class="scroll-animate" data-effect="fadeInUpSmall">Introduction</span></span>
                                        </div>
                                        <div class="fon_num_tex_box scroll-animate father pure" data-child=".at_on"
                                             data-delay=".05" data-effect="fadeInUpSmall">
                                            <span class="fon_num at_on">02</span>
                                            <div class="fon_tex fou_info_font_sty font_regular at_on">SAIC provides
                                                a complete range of products in different application fields on GaAs
                                                pHEMT process development, and the application frequency covers Ka
                                                band. With product variety, to meet the diversity of market demand.
                                                0.15μm T-gate technology uses variable shaped electron beam to
                                                achieve good wafer consistency and high productivity, and has the
                                                ability to extend to smaller line width.</div>
                                        </div>
                                        <div class="thr_data_box scroll-animate father" data-child=".at_on"
                                             data-delay=".05" data-effect="fadeInUpSmall">
                                            <div class="at_on">
                                                <table>
                                                    <tbody>
                                                    <tr>
                                                        <th>Process</th>
                                                        <th>Application</th>
                                                        <th>Features</th>
                                                        <th>PDK Download</th>
                                                    </tr>
                                                    <tr>
                                                        <td>P25ED3</td>
                                                        <td>LNA/Logic/RF Switch/PA</td>
                                                        <td>1. 0.5&mu;m E-Mode &amp; 1.0&mu;m D-Mode pHEMT for
                                                            logic<br />
                                                            2. 0.25&mu;m D-Mode T-gate pHEMT for PA, LNA and
                                                            switch<br />
                                                            3. NFmin &lt; 0.65dB @6GHz<br />
                                                            4. Power density &gt; 900 mW/mm. (@10GHz)<br />
                                                            5. High fT (~45 GHz) &amp; fMax (~120 GHz)</td>
                                                        <td><a href="https://mysaic.sanan-ic.com/"
                                                               target="_blank">PDK Download</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>P25ED5</td>
                                                        <td>LNA/Logic/RF Switch/PA</td>
                                                        <td>1. 0.5&mu;m E-Mode &amp; 1.0&mu;m D-Mode pHEMT for
                                                            logic<br />
                                                            2. 0.25&mu;m D-Mode T-gate pHEMT for PA, LNA and
                                                            switch<br />
                                                            3. NFmin &lt; 0.65dB @6GHz<br />
                                                            4. Power density &gt; 900 mW/mm. (@10GHz)<br />
                                                            5. High fT (~45 GHz) &amp; fMax (~120 GHz)</td>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td>P15LN2</td>
                                                        <td>Low noise amplifier &amp; LNB</td>
                                                        <td>1. 0.15&mu;m D-mode T-gate process with Air
                                                            Bridge<br />
                                                            2. NFmin &lt; 0.4dB, and Ga &gt;14dB @12GHz<br />
                                                            3. 0.5&mu;m E/D-mode gate process for logic</td>
                                                        <td><a href="https://mysaic.sanan-ic.com/"
                                                               target="_blank">PDK Download</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>P10PA1</td>
                                                        <td>W bands power amplifier</td>
                                                        <td>&nbsp;0.15&mu;m D-mode pHEMT-PA and LNA up to W band
                                                        </td>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="thr_tab_con">
                                        <div class="thr_title_l_box">
                                            <img src="__IMG__/1550193375669.jpg" alt="">
                                            <span class="thr_title_l thr_name"><span class="scroll-animate" data-effect="fadeInUpSmall">Introduction</span></span>
                                        </div>
                                        <div class="fon_num_tex_box scroll-animate father pure" data-child=".at_on"
                                             data-delay=".05" data-effect="fadeInUpSmall">
                                            <span class="fon_num at_on">03</span>
                                            <div class="fon_tex fou_info_font_sty font_regular at_on">SAIC IPD is a
                                                customization process, base material has the feature of high
                                                insulation and high impedance, so it can provide RF wtih integrated
                                                passive components required for high performance requirements, such
                                                as resistance, inductance, capacitance, etc.</div>
                                        </div>
                                        <div class="thr_data_box scroll-animate father" data-child=".at_on"
                                             data-delay=".05" data-effect="fadeInUpSmall">
                                            <div class="at_on">
                                                <table>
                                                    <tbody>
                                                    <tr>
                                                        <th>Process</th>
                                                        <th>Application</th>
                                                        <th>Features</th>
                                                        <th>PDK Download</th>
                                                    </tr>
                                                    <tr>
                                                        <td>IPDPI</td>
                                                        <td>High Q RF Passive - Filter and Matching/Bias Network
                                                        </td>
                                                        <td>Multiple metal layers inter-connection with
                                                            polyimide dielectric and integrated Resistance,
                                                            capacitance, inductance circuit components</td>
                                                        <td><a href="https://mysaic.sanan-ic.com/"
                                                               target="_blank">PDK Download</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>IPDAB</td>
                                                        <td>High Q RF Passive - Filter and Matching/Bias Network
                                                        </td>
                                                        <td>Multiple metal layers inter-connection with air
                                                            bridge structure and integrated Resistance,
                                                            capacitance, inductance circuit components</td>
                                                        <td><a href="https://mysaic.sanan-ic.com/"
                                                               target="_blank">PDK Download</a></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="thr_tab_con">
                                        <div class="thr_title_l_box">
                                            <img src="__IMG__/1550193375669.jpg" alt="">
                                            <span class="thr_title_l thr_name"><span class="scroll-animate" data-effect="fadeInUpSmall">Introduction</span></span>
                                        </div>
                                        <div class="fon_num_tex_box scroll-animate father pure" data-child=".at_on"
                                             data-delay=".05" data-effect="fadeInUpSmall">
                                            <span class="fon_num at_on">04</span>
                                            <div class="fon_tex fou_info_font_sty font_regular at_on">The design of
                                                BiHEMT is based on the concept of the silicon-based BiCMOS, but the
                                                difference lies in BiHEMT through the circuit design with the aid of
                                                epitaxial growth and the chip technology to InGaP our HBT linear
                                                power amplifier, AlGaAs pHEMT frequency switch, AlGaAs pHEMT logic
                                                control circuit, AlGaAs pHEM low noise power amplifier, passive
                                                components and internal connection integration in a single gallium
                                                arsenide chip. BiHEMT has recently become a new trend in GaAs
                                                microwave circuits due to its ability to improve chip integration,
                                                reduce chip size and reduce material and manufacturing costs.</div>
                                        </div>
                                        <div class="thr_data_box scroll-animate father" data-child=".at_on"
                                             data-delay=".05" data-effect="fadeInUpSmall">
                                            <div class="at_on">
                                                <table>
                                                    <tbody>
                                                    <tr>
                                                        <th>Process</th>
                                                        <th>Application</th>
                                                        <th>Features</th>
                                                        <th>PDK Download</th>
                                                    </tr>
                                                    <tr>
                                                        <td>B25ED</td>
                                                        <td>Wi-Fi PA/LNA/RF Switch</td>
                                                        <td>1. 0.25μm T-gate E-mode by e-beam writer<br />
                                                            2. Lower NFmin of 0.4dB<br />
                                                            3. Lower switching time and less than 250 fs</td>
                                                        <td><a href="https://mysaic.sanan-ic.com/"
                                                               target="_blank">PDK Download</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>B50ED</td>
                                                        <td>Wi-Fi PA/LNA/RF Switch</td>
                                                        <td>1. 0.5μm T-gate E-mode by e-beam writer<br />
                                                            2. Lower NFmin of 0.5dB</td>
                                                        <td><a href="https://mysaic.sanan-ic.com/"
                                                               target="_blank">PDK Download</a></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php else: endif; ?>
                        <div class="footer">
    <div class="clearfix w1200">
        <div class="footer_left">
            <div class="foot_logo">
                <h1><img src="__UPLOAD_PATH__/<?php echo $config['web_site_logo']; ?>" alt=""></h1>
            </div>
            <div class="csc-textpic">
                <ul class="clearfix">
                    <?php if(is_array($link) || $link instanceof \think\Collection || $link instanceof \think\Paginator): $i = 0; $__LIST__ = $link;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <li><a href="<?php echo $vo['url']; ?>" target="_blank" rel="nofollow" class="<?php echo $vo['font_family']; ?>"></a></li>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </div>
        </div>
        <div class="footer_right">
            <div class="f_email">
                <form action="/home/form/subscribe" method="post" id="subscribe">
                    <button class="f_btn" type="submit" value="Submit" name="submit"
                            style="border:none;">GO</button>
                    <input type="hidden" name="isSubscribe" id="isSubscribe" value="1">
                    <input type="text" name="email" id="email" placeholder="E-mail">
                </form>
            </div>
            <div class="foot_toptt">
                <p>Subscribe</p><span>Subscribe immediately to yuuhuan</span>
            </div>
        </div>
    </div>
    <div class="foot_btm">
        <div class="w1200">
            <div class="f_nav clearfix">
                <?php if(is_array($nav_cate) || $nav_cate instanceof \think\Collection || $nav_cate instanceof \think\Paginator): $i = 0;$__LIST__ = is_array($nav_cate) ? array_slice($nav_cate,0,4, true) : $nav_cate->slice(0,4, true); if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nav): $mod = ($i % 2 );++$i;?>
                <ul>
                    <h4><?php echo $nav['name']; ?></h4>
                    <?php if(is_array($nav['sub']) || $nav['sub'] instanceof \think\Collection || $nav['sub'] instanceof \think\Paginator): $i = 0; $__LIST__ = $nav['sub'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <li><a href="<?php echo $vo['url']; ?>"><?php echo $vo['name']; ?></a></li>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
                <?php endforeach; endif; else: echo "" ;endif; ?>
                <ul class="f_contact">
                    <h4>Contact Us</h4>
                    <li>
                        <p>Phone: <?php echo $config['web_serviceLine']; ?></p>
                        <p>Email: <?php echo $config['web_email']; ?></p>
                        <p>Address: <?php echo $config['web_site_address']; ?></p>
                        <a class="n" href="<?php echo getCateUrl(83,''); ?>">Get a Quote</a>
                    </li>
                </ul>
            </div>
            <div class="num">You are the <?php if(is_array($chars) || $chars instanceof \think\Collection || $chars instanceof \think\Paginator): $k = 0; $__LIST__ = $chars;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><span><?php echo $chars[$k-1]; ?></span><?php endforeach; endif; else: echo "" ;endif; ?> visitor</div>
            <div class="copy"><?php echo $config['web_site_copy']; ?></div>
        </div>
    </div>
</div>

<!--<script src="__JS__/jquery-3.1.1.min.js"></script>-->
<script src="__JS__/jquery.form.min.js"></script>
<script src="__JS__/layui/layui.js"></script>

<script type="text/javascript">
    $(function(){
        $('#subscribe').ajaxForm({
            beforeSubmit: checkForm, // 此方法主要是提交前执行的方法，根据需要设置
            success: complete, // 这是提交后的方法
            dataType: 'json'
        });

        function checkForm(){

        }
        function complete(data){
            if(data.code == 1){
                layer.msg(data.msg, {icon: 6,time:1500,shade: 0.1}, function(index){
                    layer.close(index);
                    window.location.reload();
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
<script type="text/javascript">
        var w, h, className;
        function getSrceenWH() {
            w = $(window).width();
            h = $(window).height();
            $('#dialogBg').width(w).height(h);
        }
        window.onresize = function () {
            getSrceenWH();
        }
        $(window).resize();
        $(function () {
            getSrceenWH();
            //  弹出框 
            $('.last').click(function () {
                className = $(this).attr('class');
                $('#dialogBg').fadeIn(300);
                $('#dialog').removeAttr('class').addClass('animated ' + className + '').fadeIn();
                $('body').addClass('noroll')
            });
            $('.claseDialogBtn').click(function () {
                $('#dialogBg').fadeOut(300, function () {
                    $('#dialog1').addClass('bounceOutUp').fadeOut();
                });
                $('body').removeClass('noroll')
            });
            $('.dialogClose1').click(function () {
                $('#dialogBg').fadeOut(300, function () {
                    $('#dialog').addClass('bounceOutUp').fadeOut();
                });
                $('body').removeClass('noroll')
            });
        });
</script>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<!--视频弹窗-->
<div class="video_sha sha_bg">
    <div class="sha_btn_close"><i class="newiconfont">&#xe635;</i></div>
    <div class="sha_vid">
        <video class="scroll-animate" data-delay=".5" data-effect="flipInX_slow" controls loop
               playsinline="" x-webkit-airplay="" webkit-playsinline="" x5-video-player-type="h5"></video>
    </div>
</div>
<!--轮播-->
<script type="text/javascript" src="__JS__/swiper.min.js"></script>
<!--监听滚动条-->
<script type="text/javascript" src="__JS__/jquery.waypoints.min.js"></script>
<script type="text/javascript" src="__JS__/main.js"></script>
<!--滚动条-->
<script type="text/javascript" src="__JS__/jquery.jscrollpane.min.js"></script>
<script type="text/javascript" src='__JS__/classie.js'></script>
<script type="text/javascript" src="__JS__/jquery.mousewheel.js"></script>
<script type="text/javascript" src='__JS__/classie.js'></script>
<!--<script type="text/javascript" src='__JS__/jquery.parallax.js'></script>-->
<script type="text/javascript" src='__JS__/app.js'></script>
<script type="text/javascript" src='__JS__/smooth.js'></script>


<script src="__JS__/jquery.lettering.js"></script>


<script src="__JS__/jquery.textillate.js"></script>
<script src="__JS__/run.js"></script>
<script src="__JS__/TweenMax.js"></script>
<script src="__JS__/mo.min.js"></script>

<script src="__JS__/public.js"></script>
<!--<script src="__JS__/ajax-page-loader.js"></script>-->
</body>
<?php break; case "8": break; default: ?>default<?php endswitch; ?><div class="footer">
    <div class="clearfix w1200">
        <div class="footer_left">
            <div class="foot_logo">
                <h1><img src="__UPLOAD_PATH__/<?php echo $config['web_site_logo']; ?>" alt=""></h1>
            </div>
            <div class="csc-textpic">
                <ul class="clearfix">
                    <?php if(is_array($link) || $link instanceof \think\Collection || $link instanceof \think\Paginator): $i = 0; $__LIST__ = $link;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <li><a href="<?php echo $vo['url']; ?>" target="_blank" rel="nofollow" class="<?php echo $vo['font_family']; ?>"></a></li>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </div>
        </div>
        <div class="footer_right">
            <div class="f_email">
                <form action="/home/form/subscribe" method="post" id="subscribe">
                    <button class="f_btn" type="submit" value="Submit" name="submit"
                            style="border:none;">GO</button>
                    <input type="hidden" name="isSubscribe" id="isSubscribe" value="1">
                    <input type="text" name="email" id="email" placeholder="E-mail">
                </form>
            </div>
            <div class="foot_toptt">
                <p>Subscribe</p><span>Subscribe immediately to yuuhuan</span>
            </div>
        </div>
    </div>
    <div class="foot_btm">
        <div class="w1200">
            <div class="f_nav clearfix">
                <?php if(is_array($nav_cate) || $nav_cate instanceof \think\Collection || $nav_cate instanceof \think\Paginator): $i = 0;$__LIST__ = is_array($nav_cate) ? array_slice($nav_cate,0,4, true) : $nav_cate->slice(0,4, true); if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nav): $mod = ($i % 2 );++$i;?>
                <ul>
                    <h4><?php echo $nav['name']; ?></h4>
                    <?php if(is_array($nav['sub']) || $nav['sub'] instanceof \think\Collection || $nav['sub'] instanceof \think\Paginator): $i = 0; $__LIST__ = $nav['sub'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <li><a href="<?php echo $vo['url']; ?>"><?php echo $vo['name']; ?></a></li>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
                <?php endforeach; endif; else: echo "" ;endif; ?>
                <ul class="f_contact">
                    <h4>Contact Us</h4>
                    <li>
                        <p>Phone: <?php echo $config['web_serviceLine']; ?></p>
                        <p>Email: <?php echo $config['web_email']; ?></p>
                        <p>Address: <?php echo $config['web_site_address']; ?></p>
                        <a class="n" href="<?php echo getCateUrl(83,''); ?>">Get a Quote</a>
                    </li>
                </ul>
            </div>
            <div class="num">You are the <?php if(is_array($chars) || $chars instanceof \think\Collection || $chars instanceof \think\Paginator): $k = 0; $__LIST__ = $chars;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><span><?php echo $chars[$k-1]; ?></span><?php endforeach; endif; else: echo "" ;endif; ?> visitor</div>
            <div class="copy"><?php echo $config['web_site_copy']; ?></div>
        </div>
    </div>
</div>

<!--<script src="__JS__/jquery-3.1.1.min.js"></script>-->
<script src="__JS__/jquery.form.min.js"></script>
<script src="__JS__/layui/layui.js"></script>

<script type="text/javascript">
    $(function(){
        $('#subscribe').ajaxForm({
            beforeSubmit: checkForm, // 此方法主要是提交前执行的方法，根据需要设置
            success: complete, // 这是提交后的方法
            dataType: 'json'
        });

        function checkForm(){

        }
        function complete(data){
            if(data.code == 1){
                layer.msg(data.msg, {icon: 6,time:1500,shade: 0.1}, function(index){
                    layer.close(index);
                    window.location.reload();
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
<script type="text/javascript">
        var w, h, className;
        function getSrceenWH() {
            w = $(window).width();
            h = $(window).height();
            $('#dialogBg').width(w).height(h);
        }
        window.onresize = function () {
            getSrceenWH();
        }
        $(window).resize();
        $(function () {
            getSrceenWH();
            //  弹出框 
            $('.last').click(function () {
                className = $(this).attr('class');
                $('#dialogBg').fadeIn(300);
                $('#dialog').removeAttr('class').addClass('animated ' + className + '').fadeIn();
                $('body').addClass('noroll')
            });
            $('.claseDialogBtn').click(function () {
                $('#dialogBg').fadeOut(300, function () {
                    $('#dialog1').addClass('bounceOutUp').fadeOut();
                });
                $('body').removeClass('noroll')
            });
            $('.dialogClose1').click(function () {
                $('#dialogBg').fadeOut(300, function () {
                    $('#dialog').addClass('bounceOutUp').fadeOut();
                });
                $('body').removeClass('noroll')
            });
        });
</script></body></html>