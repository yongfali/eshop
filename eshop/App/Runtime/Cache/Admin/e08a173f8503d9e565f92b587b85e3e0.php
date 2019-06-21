<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<title>后台登录</title>
	<link rel="stylesheet" type="text/css" href="/eshop/Public/Admin/Css/Common/common.css">
	<link rel="stylesheet" type="text/css" href="/eshop/Public/Admin/Css/Login/login.css">
</head>
<body>
	<div class="login-box">
		<h3>
			欢迎使用eshop后台管理系统
		</h3>
		<form id="loginForm" autocomplete="off">
			<div class="items">
				<label for="account">用户名</label>
				<input class="inputs" id="account" type="text" name="account" placeholder="管理员账号"/>
			</div>
			<div class="items">
				<label for="pwd">密码</label>
				<input class="inputs" id="pwd" type="password" name="pwd" placeholder="密码"/>
			</div>
			<div class="items">
				<label for="verify-img">验证码</label>
				<input class="inputs" id="verify-img" type="text" placeholder="请输入验证码" name="verify1"/>
				<img src="<?php echo U('verify');?>" id="verifyCode" onclick = "changeVerify()"/>
			</div>
			<input type="submit" class="login-btn" value="登录"/>
		</form>
	</div>
</body>
<script src="/eshop/Public/Common/Js/jquery-2.1.1.min.js"></script>
<script src="/eshop/Public/Common/Js/jquery.validate.js"></script>
<script src="/eshop/Public/Common/layer/layer.js"></script>
<script src="/eshop/Public/Admin/Js/Login/login.js"></script>
<script type="text/javascript">
	var index = "<?php echo U('Admin/Index/index');?>";
</script>
</html>