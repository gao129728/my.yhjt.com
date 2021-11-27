<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:75:"E:\php_project\my.yhjt.com\public/../application/home/view/index/index.html";i:1637827622;s:75:"E:\php_project\my.yhjt.com\public/../application/home/view/public/head.html";i:1636624294;s:83:"E:\php_project\my.yhjt.com\public/../application/home/view/public/header_index.html";i:1636419676;s:83:"E:\php_project\my.yhjt.com\public/../application/home/view/public/extra_header.html";i:1637638016;s:77:"E:\php_project\my.yhjt.com\public/../application/home/view/public/footer.html";i:1637995280;}*/ ?>
<!DOCTYPE html>
<html lang="en">

<head>    <meta charset="UTF-8">    <meta http-equiv="X-UA-Compatible" content="IE=edge">    <meta name="viewport" content="width=device-width, initial-scale=1.0">    <title><?php echo $web_site_title; ?></title>    <script src="http://www.jq22.com/jquery/angular-1.4.6.js"></script>    <script type="text/javascript" src="__JS__/angular-ui-router.min.js"></script>    <link rel="stylesheet" href="__CSS__/style.css">    <link rel="stylesheet" href="__CSS__/base.css">    <link rel="stylesheet" href="__CSS__/swiper.min.css">    <link rel="stylesheet" href="__CSS__/iconfont/iconfont.css">    <script src="__JS__/jquery-3.1.1.min.js"></script>    <link href="__CSS__/iCheck/custom.css" rel="stylesheet">    <script src="__JS__/iCheck/icheck.min.js"></script>    <script src="__JS__/swiper.min.js"></script>    <script src="__JS__/base.js"></script>    <script src="__JS__/layui/layui.js"></script>    <script src="__JS__/jquery.form.min.js"></script>    <script src="__JS__/shopping.js"></script></head>

<body>

<div class="nav-box index">
    <div class="w1200 fsc">
        <div class="pic-box">
            <img src="__UPLOAD_PATH__/<?php echo $config['web_site_logo']; ?>" alt="">
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

<!--banner-->
<div class="banner">
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <?php if(is_array($banner) || $banner instanceof \think\Collection || $banner instanceof \think\Paginator): $i = 0; $__LIST__ = $banner;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <div class="swiper-slide">
                <a href=""><img src="__UPLOAD_PATH__/<?php echo $vo['photo']; ?>" class="PcBan" /></a>
            </div>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
        <div class="swiper-pagination"></div>
    </div>
</div>
<!--product-->
<div class="part part1">
    <div class="title">Our products</div>
    <div class="line"></div>
    <div class="pro_box  w1200">
        <ul class="clearfix">
            <?php if(is_array($topiclists) || $topiclists instanceof \think\Collection || $topiclists instanceof \think\Paginator): $i = 0;$__LIST__ = is_array($topiclists) ? array_slice($topiclists,0,4, true) : $topiclists->slice(0,4, true); if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$top): $mod = ($i % 2 );++$i;?>
            <li class="fl">
                <div class="show_box">
                    <div class="pic_box">
                        <img src="__UPLOAD_PATH__/<?php echo $top['photo']; ?>" alt="">
                    </div>
                    <div class="tit"><?php echo $top['title']; ?></div>
                </div>
                <div class="hide_box">
                    <div class="cont_box">
                        <div class="tit"><?php echo $top['title']; ?></div>
                        <div class="cont">
                            <?php echo $top['content']; ?>
                        </div>
                        <a href="<?php echo getCateUrl($top['cate_id'],''); ?>" class="more">View More</a>
                    </div>
                    <div class="back"></div>
                </div>
            </li>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
    </div>
</div>
<!--aboutus-->
<div class="part part2">
    <div class="title">ABOUT US</div>
    <div class="line"></div>
    <div class="cont">
        <?php echo $aboutus['content']; ?>
    </div>
    <div class="video_box">
        <video id="video"muted controls poster="__UPLOAD_PATH__/<?php echo $aboutus['photo']; ?>">
            <source src="__UPLOAD_FILE__/<?php echo $aboutus['annex']; ?>" type="video/mp4">
        </video>
    </div>
</div>
<!--news-->
<div class="part part3">
    <div class="title">News information</div>
    <div class="line"></div>
    <ul class="news-list w1200">
        <?php if(is_array($news) || $news instanceof \think\Collection || $news instanceof \think\Paginator): $i = 0; $__LIST__ = $news;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <li class="clearfix">
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
</div>
<div class="footer">
    <div class="clearfix w1200">
        <div class="footer_left">
            <div class="foot_logo">
                <h1><img src="__UPLOAD_PATH__/<?php echo $config['web_site_logo']; ?>" alt=""></h1>
            </div>
            <div class="csc-textpic">
                <ul class="clearfix">
                    
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
<script>
    window.addEventListener("scroll", function (e) {
        let total = $('body, html').scrollTop();
        if (total > 760) {
            $(".nav-box").css("background-color", "rgba(0,0,0,.5)");
        } else {
            $(".nav-box").css("background-color", "transparent");
        }
    });
    
    

</script>
</body>

</html>