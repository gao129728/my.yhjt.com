<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:76:"E:\php_project\my.yhjt.com\public/../application/home/view/member/login.html";i:1637634572;s:75:"E:\php_project\my.yhjt.com\public/../application/home/view/public/head.html";i:1636624294;}*/ ?>
<!DOCTYPE html>
<html lang="en">

<head>    <meta charset="UTF-8">    <meta http-equiv="X-UA-Compatible" content="IE=edge">    <meta name="viewport" content="width=device-width, initial-scale=1.0">    <title><?php echo $web_site_title; ?></title>    <script src="http://www.jq22.com/jquery/angular-1.4.6.js"></script>    <script type="text/javascript" src="__JS__/angular-ui-router.min.js"></script>    <link rel="stylesheet" href="__CSS__/style.css">    <link rel="stylesheet" href="__CSS__/base.css">    <link rel="stylesheet" href="__CSS__/swiper.min.css">    <link rel="stylesheet" href="__CSS__/iconfont/iconfont.css">    <script src="__JS__/jquery-3.1.1.min.js"></script>    <link href="__CSS__/iCheck/custom.css" rel="stylesheet">    <script src="__JS__/iCheck/icheck.min.js"></script>    <script src="__JS__/swiper.min.js"></script>    <script src="__JS__/base.js"></script>    <script src="__JS__/layui/layui.js"></script>    <script src="__JS__/jquery.form.min.js"></script>    <script src="__JS__/shopping.js"></script></head>

<body>
<div class="login">
	<img src="__IMG__/logo-big.png" alt="" class="logo">
	<div class="login__subtitle">Welcome back.</div>
	<form action="/home/member/login" method="post" id="login">
	<div class="form-group">
			<label for="email">Email</label>
			<input class="form-control" autofocus="autofocus" tabindex="1" value="" type="text" name="email"
				   id="email">
		</div>
		<div class="form-group">
			<div class="fsc">
				<label for="password"> Password </label>
				<a href="/home/member/zhmm">Forgot your password?</a>
			</div>
			<input class="form-control" autocomplete="off" tabindex="2" type="password" name="password"
				   id="password">
		</div>
		<div class="form-group">
			<input type="submit" name="commit" value="Login" class="btn" tabindex="3" data-disable-with="···">
			<!--<a href="/home/member/register">Not a member?</a>-->
		</div>
	</form>
</div>

<script type="text/javascript">
	$(function(){
		$('#login').ajaxForm({
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
</body>


</html>