<?php if (!defined('THINK_PATH')) exit(); /*a:8:{s:79:"E:\php_project\my.yhjt.com\public/../application/home/view/category/detail.html";i:1635911410;s:75:"E:\php_project\my.yhjt.com\public/../application/home/view/public/head.html";i:1636624294;s:77:"E:\php_project\my.yhjt.com\public/../application/home/view/public/header.html";i:1637549535;s:83:"E:\php_project\my.yhjt.com\public/../application/home/view/public/extra_header.html";i:1637638016;s:86:"E:\php_project\my.yhjt.com\public/../application/home/view/detail-module/module_0.html";i:1637548039;s:80:"E:\php_project\my.yhjt.com\public/../application/home/view/public/left_menu.html";i:1637547992;s:86:"E:\php_project\my.yhjt.com\public/../application/home/view/detail-module/module_1.html";i:1637562242;s:77:"E:\php_project\my.yhjt.com\public/../application/home/view/public/footer.html";i:1637995283;}*/ ?>
﻿<!doctype html><html lang="en"><head>    <meta charset="UTF-8">    <meta http-equiv="X-UA-Compatible" content="IE=edge">    <meta name="viewport" content="width=device-width, initial-scale=1.0">    <title><?php echo $web_site_title; ?></title>    <script src="http://www.jq22.com/jquery/angular-1.4.6.js"></script>    <script type="text/javascript" src="__JS__/angular-ui-router.min.js"></script>    <link rel="stylesheet" href="__CSS__/style.css">    <link rel="stylesheet" href="__CSS__/base.css">    <link rel="stylesheet" href="__CSS__/swiper.min.css">    <link rel="stylesheet" href="__CSS__/iconfont/iconfont.css">    <script src="__JS__/jquery-3.1.1.min.js"></script>    <link href="__CSS__/iCheck/custom.css" rel="stylesheet">    <script src="__JS__/iCheck/icheck.min.js"></script>    <script src="__JS__/swiper.min.js"></script>    <script src="__JS__/base.js"></script>    <script src="__JS__/layui/layui.js"></script>    <script src="__JS__/jquery.form.min.js"></script>    <script src="__JS__/shopping.js"></script></head><body><div class="nav-box inner">
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


<!--news--><?php if(($cate['info_state'] == 4||$cate['info_state'] == 6)): ?>    <!--news_details-->
<div class="container w1200">
    <div class="crumbs">
    Your location：<a href="/">Home</a> &gt;
    <a href="<?php echo getCateUrl($navCate['id'],$navCate['website']); ?>">
        <?php echo $navCate['name']; ?>
    </a> &gt;
        <?php echo $cate['name']; ?>
</div>
    <div class="con_title"> <b><?php echo $navCate['en_name']; ?></b> </div>
    <!--<div class="nav">
        <ul class="fcc">
            <?php if(is_array($sub_menu) || $sub_menu instanceof \think\Collection || $sub_menu instanceof \think\Paginator): $i = 0; $__LIST__ = $sub_menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <li <?php if($vo['isCurrent'] == 1): ?>class="cur"<?php else: ?>class=""<?php endif; ?>><a href="<?php echo $vo['url']; ?>" title=""><?php echo $vo['name']; ?></a></li>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
    </div>-->
    <div class="news-details">
        <?php if($cate['info_state'] == 6): ?>
        <div class="title"><?php echo $info['title']; ?></div>
        <div style="text-align: center">
            <img src="__UPLOAD_PATH__/<?php echo $info['photo']; ?>">
        </div>
        <?php else: ?>

        <div class="title"><?php echo $info['title']; ?></div>
        <div class="date"> <span>Sources: <?php echo $info['source']; ?> | Date: <?php echo date("Y-m-d",$info['create_time']); ?> | Views: <?php echo $info['views']; ?></span></div>
        <div class="details-cont">
            <?php echo $info['content']; ?>
        </div>
        <?php endif; ?>
        <div class="FastMove">
            <?php if($page['prev_id'] == 0): ?>
            <div class="Prev"> <b>Prev: </b><a title="">No More</a> </div>
            <?php else: ?>
            <div class="Prev"> <b>Prev: </b><a href="<?php echo $page['prev_url']; ?>" title=""><?php echo $page['prev_title']; ?></a> </div>
            <?php endif; if($page['next_id'] == 0): ?>
            <div class="Prev"> <b>Next: </b><a title="">No More</a> </div>
            <?php else: ?>
            <div class="Next"> <b>Next: </b><a href="<?php echo $page['next_url']; ?>"><?php echo $page['next_title']; ?></a></div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php elseif(($cate['info_state'] == 2)): ?>    <!--product detail-->
<div class="container w1200">
    <div class="crumbs">
    Your location：<a href="/">Home</a> &gt;
    <a href="<?php echo getCateUrl($navCate['id'],$navCate['website']); ?>">
        <?php echo $navCate['name']; ?>
    </a> &gt;
        <?php echo $cate['name']; ?>
</div>
    <div class="con_title"> <b><?php echo $navCate['en_name']; ?></b> </div>
    <div class="product clearfix">
        <div class="side_pro row clearfix">
            <ul>
                <?php if(is_array($sub_menu) || $sub_menu instanceof \think\Collection || $sub_menu instanceof \think\Paginator): $i = 0; $__LIST__ = $sub_menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <li class="dir156 yiji <?php if($vo['isCurrent'] == 1): ?>cur<?php endif; ?>"><a href="<?php echo $vo['url']; ?>"><?php echo $vo['name']; ?></a>
                    <span class="spams"><?php if($subCur == $vo['id']): ?>-<?php else: ?>+<?php endif; ?></span>
                    <ul class="xiala">
                        <?php if(is_array($vo['child']) || $vo['child'] instanceof \think\Collection || $vo['child'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$td): $mod = ($i % 2 );++$i;?>
                        <a href="<?php echo getCateUrl($td['id'],''); ?>" class="drt165"><?php echo $td['name']; ?></a>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </li>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
        <div class="con pro_cont">
            <ul class="clearfix">
                <li class="pro_l">
                    <img src="__UPLOAD_PATH__/<?php echo $info['photo']; ?>">
                </li>
                <li class="pro_r">
                    <div class="pror_title">
                        <b><?php echo $info['title']; ?></b>
                        <a href="javascript:history.go(-1)">Back</a>
                    </div>
                    <div class="pror_b">
                        <?php echo $info['intro']; ?>
                        <div class="quantity"><b>Quantity:</b>
                            <div class="input-box">
                                <button id="reduce" onclick="change_num(<?php echo $info['id']; ?>, 0);">-</button>
                                <input type="text" value="1" id="number" onblur="change_num(<?php echo $info['id']; ?>, 2);">
                                <button id="add" onclick="change_num(<?php echo $info['id']; ?>, 1)">+</button>
                            </div>
                            <div style="display: none" id="goods_price"><?php echo $info['price']; ?></div>
                            <b>Price:</b><span id="goods_total_price">$<?php if($info['price']): ?><?php echo $info['price']; else: ?>0.00<?php endif; ?></span>
                        </div>
                    </div>
                    <div class="inquiry_link" id="to_top">
                        <div class="btn add"><span class="iconfont icon-gouwuche"></span>
                            <a style="color: #fff" href="javascript:add_to_cart(<?php echo $info['id']; ?>)">Add to cart</a>
                        </div>
                        <div class="btn"><span class="iconfont icon-piliangxiadan"></span>
                            <a style="color: #255583" href="javascript:buy_now(<?php echo $info['id']; ?>)">Buy now</a>
                        </div>
                    </div>
                </li>
            </ul>
            <div class="share-box">
                <div><span class="iconfont icon-fenxiang"></span>share</div>
                <div class="collection" onclick="collect(<?php echo $info['id']; ?>)"><span class="iconfont <?php if($info['is_collect'] == 1): ?>icon-shoucang1<?php else: ?>icon-shoucang<?php endif; ?>"></span>Collection</div>
            </div>
            <div class="pro_show">
                <div class="pro_show_t clearfix">
                    <span class="on">Product details</span>
                    <span>Product consulting</span>
                </div>
                <div class="procontent">
                    <ul>
                        <?php echo $info['content']; if(is_array($info['piclist']) || $info['piclist'] instanceof \think\Collection || $info['piclist'] instanceof \think\Paginator): $i = 0; $__LIST__ = $info['piclist'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <p>
                            <img src="__UPLOAD_PATH__/<?php echo $vo['pic']; ?>" alt="">
                        </p>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                    <ul class="content">
                        <script type="text/javascript">
                            $(function () {
                                //初始化form表单
                                AjaxInitForm('#order_form', '#btnSubmit', 1);
                            });
                        </script>
                        <form action="/home/form/consult" method="post" id="consult">
                            <input type="hidden" id="product" name="product" value="<?php echo $info['title']; ?>">
                            <input type="hidden" name="isMessage" name="isMessage" value="0">
                            <p>
                                <span>Name: </span>
                                </span><input type="text" id="name" name="name"> <b>*</b>
                            </p>
                            <p><span>E-Mail: </span><input type="text" id="email" name="email"> <b>*</b></p>
                            <p><span>Subject: </span><input type="text" id="topic" name="topic"> <b>*</b></p>
                            <!--<p><span>Fax: </span><input type="text" id="fax" name="fax"> <b>*</b></p>-->
                            <p><span>Message: </span>
                                <textarea id="content" name="content" cols="30" rows="10"></textarea>
                                <strong>Enter between 1 to 3000 characters.</strong>
                            </p>
                    <!--        <p><span>Verification code: </span><input type="text" name="code" id="code">-->
                    <!-- <img id="captcha" src="./captcha.html" onclick="this.src='./captcha.html?id='+Math.random()+''" alt="captcha">-->
                    <!--            <img src="/home/form/code_img.html" class="codeImg" onclick="this.src='/home/form/code_img.html?time='+Math.random();" alt=""/>-->
                    <!--        </p>-->
                            <input type="submit" name="Submit" value="Inquire" class="insubmit">
                        </form>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
<script type="text/javascript">
<!--    收藏-->
    function collect(id){
        if(isNaN(id)){
            layer.msg("参数错误", {icon: 5,time:2000,shade: 0.5}, function(index){
                layer.close(index);
            });
            return false;
        }
        $.ajax({
            type: "POST",
            url:"/home/member/addcollection",
            data:"id=" + id,
            dataType:"json",
            success:function(result){
                if(result && result.code==1){
                    layer.msg(result.msg, {icon: 6,time:1000,shade: 0.5}, function(index){
                        layer.close(index);
                    });
                    // window.location = "/home/member/shopping";
                } else {
                    layer.msg(result.msg, {icon: 5,time:2000,shade: 0.5}, function(index){
                        layer.close(index);
                    });
                }
            }
        });
    }


</script>

<script type="text/javascript">
    $(function(){
        $('#consult').ajaxForm({
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

    $(function () {
        $('.procontent ul').eq(0).show();
        $('.pro_show_t span').click(function () {
            var index = $(this).index();
            $(this).addClass('on').siblings().removeClass('on');
            $('.procontent ul').eq(index).show().siblings().hide();
        })
    })

   $('.collection').click(function () {
        if ($(this).find('span').hasClass('icon-shoucang')) {
            $(this).find('span').removeClass('icon-shoucang').addClass('icon-shoucang1')
        } else {
            $(this).find('span').removeClass('icon-shoucang1').addClass('icon-shoucang')
        }
    })
</script>
<?php endif; ?><div class="footer">
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
</script></body></html>