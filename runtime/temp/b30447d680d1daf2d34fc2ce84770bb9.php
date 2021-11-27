<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:76:"E:\php_project\my.yhjt.com\public/../application/home/view/member/login.html";i:1637634572;s:75:"E:\php_project\my.yhjt.com\public/../application/home/view/public/head.html";i:1636624294;}*/ ?>
<!DOCTYPE html>
<html lang="en">

<head>

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