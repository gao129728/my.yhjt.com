
<!DOCTYPE html>
<html>
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<meta content="IE=edge" http-equiv="X-UA-Compatible">
<meta content="webkit" name="renderer">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta content="portrait" name="screen-orientation">
<meta content="portrait" name="x5-orientation">
<title>页面错误</title>
<style type="text/css">
html{height:100%; font-size:62.5%;}
body, p, h1{margin: 0; padding:0;}
body{color:#444; height:100%; overflow-x:hidden; -webkit-text-size-adjust:none; font-family: Microsoft YaHei,Arial; background:#f2f2f2 url("/static/home/images/error_blueprint.png") repeat;}
div#da-wrapper {height:100%; position:relative; overflow-x: hidden; max-width: 640px; margin: 0 auto;}
div#da-wrapper, div#da-wrapper.fluid {width:100%;}
div#da-error-wrapper {padding:10% 0 0; position:relative; text-align:center;}
div#da-error-wrapper .da-error-heading {color:#e15656; text-align:center; font-size:1.8rem; font-weight:100; line-height:2;}
div#da-error-wrapper .tips{font-size:1.4rem; line-height:1.8; padding:4px 0 8px;}
div#da-error-wrapper .btn{font-size:1.2rem; line-height:1.8;}
div#da-error-wrapper .btn a {margin:5px; color:#fff; background:#54b801;text-decoration:none; padding:3px 10px;display:inline-block;-webkit-border-radius:4px;-o-border-radius:4px; -moz-border-radius:4px; border-radius:4px}
div#da-error-wrapper #da-error-code{
	width:48%;
	position:relative;
	margin:0 auto;
	padding-bottom:5px;
	-webkit-transform-origin:center top;
	-moz-transform-origin:center top;
	transform-origin:center top;
	-webkit-animation:error-swing infinite 2s ease-in-out alternate;
	-moz-animation:error-swing infinite 2s ease-in-out alternate;
	animation:error-swing infinite 2s ease-in-out alternate
}
div#da-error-wrapper #da-error-code img{width:100%; vertical-align:top}
div#da-error-wrapper #da-error-code span {font-size:96px;display:block}

@-webkit-keyframes error-swing{
0% {-webkit-transform:rotate(1deg)}
100% {-webkit-transform:rotate(-2deg)}
}
@-moz-keyframes error-swing {
0% {-moz-transform:rotate(1deg)}
100% {-moz-transform:rotate(-2deg)}
}
@keyframes error-swing {
0% {transform:rotate(1deg)}
100% {transform:rotate(-2deg)}
}
</style>
</head>
<body> 
	<div id="da-wrapper" class="fluid">
    	<div id="da-error-wrapper">
            <div id="da-error-code"><img src="/static/home/images/error-hanger.png"></div>
        	<h1 class="da-error-heading">页面错误！请稍后再试～</h1>
            <p class="tips">您可能输入了错误的网址，或者该网页已删除或移动</p>
            <p class="btn"><a href="javascript:history.back();location.reload();">返回上一页</a> <a href="http://<?php echo $_SERVER['HTTP_HOST'];?>">网站首页</a></p>
        </div>
    </div>  
</body>
</html>
